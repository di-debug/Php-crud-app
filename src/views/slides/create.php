<?php
include_once '../../../src/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $tab_id = $_POST['tab_id'] ?? '';
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = $target_file;
    }

    $stmt = $conn->prepare("INSERT INTO slides (title, description, image, tab_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $description, $image, $tab_id);
    $stmt->execute();
    $stmt->close();

    header("Location: list.php?tab_id=" . $tab_id);
    exit();
}

$tabs_result = $conn->query("SELECT * FROM tabs ORDER BY id ASC");
$tabs = [];
while ($row = $tabs_result->fetch_assoc()) {
    $tabs[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Slide</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Create New Slide</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="tab_id">Select Tab:</label>
                <select name="tab_id" id="tab_id" required>
                    <?php foreach ($tabs as $tab): ?>
                        <option value="<?php echo $tab['id']; ?>"><?php echo htmlspecialchars($tab['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <button type="submit">Create Slide</button>
        </form>
        <a href="list.php" class="btn btn-secondary">Back to Slides List</a>
    </div>
</body>
</html>