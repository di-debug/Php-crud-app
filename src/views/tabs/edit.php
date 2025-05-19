<?php
include_once '../../config.php';
include_once '../models/Tab.php';

$tabId = $_GET['id'] ?? null;
$tab = null;

if ($tabId) {
    $tabModel = new Tab($conn);
    $tab = $tabModel->find($tabId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tabName = $_POST['name'] ?? '';
    $tabModel = new Tab($conn);
    $tabModel->update($tabId, $tabName);
    header('Location: list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tab</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Tab</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Tab Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($tab['name']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Tab</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>