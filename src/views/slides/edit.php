<?php
include_once '../../../src/config.php';
include_once '../../models/Slide.php';

$slideId = $_GET['id'] ?? null;
$slide = null;

if ($slideId) {
    $slideModel = new Slide($conn);
    $slide = $slideModel->getSlideById($slideId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_FILES['image'] ?? null;

    if ($slide) {
        $slideModel->updateSlide($slideId, $title, $description, $image);
        header('Location: /php-crud-app/public/admin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slide</title>
    <link rel="stylesheet" href="/php-crud-app/public/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Slide</h2>
        <?php if ($slide): ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($slide['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required><?php echo htmlspecialchars($slide['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">
                    <img src="<?php echo htmlspecialchars($slide['image']); ?>" alt="Current Image" style="max-width: 200px;">
                </div>
                <button type="submit">Update Slide</button>
            </form>
        <?php else: ?>
            <p>Slide not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>