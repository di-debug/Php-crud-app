<?php
include_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tab_name = trim($_POST['tab_name']);

    if (!empty($tab_name)) {
        $stmt = $conn->prepare("INSERT INTO tabs (name) VALUES (?)");
        $stmt->bind_param("s", $tab_name);

        if ($stmt->execute()) {
            header("Location: list.php?success=Tab created successfully");
            exit;
        } else {
            $error = "Error creating tab: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Tab name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tab</title>
    <link href="../../public/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Create New Tab</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="create.php" method="post">
            <div class="form-group">
                <label for="tab_name">Tab Name:</label>
                <input type="text" name="tab_name" id="tab_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Tab</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>