<?php
include_once '../../config.php';

// Fetch slides for a specific tab
$tab_id = $_GET['tab_id'] ?? 0;
$slides = [];
if ($tab_id) {
    $slides_result = $conn->query("SELECT * FROM slides WHERE tab_id = $tab_id ORDER BY id ASC");
    while ($slide = $slides_result->fetch_assoc()) {
        $slides[] = $slide;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slides List</title>
    <link href="/public/assets/css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Slides for Tab ID: <?php echo htmlspecialchars($tab_id); ?></h1>
    <a href="create.php?tab_id=<?php echo $tab_id; ?>" class="btn btn-primary">Add New Slide</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($slides)): ?>
                <tr>
                    <td colspan="5">No slides found for this tab.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($slide['id']); ?></td>
                        <td><?php echo htmlspecialchars($slide['title']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($slide['description'])); ?></td>
                        <td><img src="<?php echo htmlspecialchars($slide['image']); ?>" alt="<?php echo htmlspecialchars($slide['title']); ?>" width="100"></td>
                        <td>
                            <a href="edit.php?id=<?php echo $slide['id']; ?>&tab_id=<?php echo $tab_id; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $slide['id']; ?>&tab_id=<?php echo $tab_id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>