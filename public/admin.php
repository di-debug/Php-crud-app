<?php
include '../src/config.php';
include '../src/controllers/CrudController.php';

$crudController = new CrudController($conn);

// Handle form submissions for adding new tabs and slides
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_tab'])) {
        $tabName = $_POST['tab_name'];
        $iconSvgPath = '';

        if (isset($_FILES['tab_icon_svg']) && $_FILES['tab_icon_svg']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = uniqid('svg_') . '.svg';
            $uploadFile = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['tab_icon_svg']['tmp_name'], $uploadFile)) {
                $iconSvgPath = 'uploads/' . $fileName; // Save relative path for use in HTML
            }
        }

        $crudController->createTab($tabName, $iconSvgPath);
    } elseif (isset($_POST['add_slide'])) {
        $slideTitle = $_POST['title'];
        $slideDescription = $_POST['description'];
        $tabId = $_POST['tab_id'];
        $slideImage = $_FILES['image'];

        // Handle file upload
        if ($slideImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = uniqid() . '-' . basename($slideImage['name']);
            $uploadFile = $uploadDir . $fileName;
            if (move_uploaded_file($slideImage['tmp_name'], $uploadFile)) {
                $relativePath = 'uploads/' . $fileName;
                $crudController->createSlide($slideTitle, $slideDescription, $relativePath, $tabId);
            }
        }
    }
}

// Fetch existing tabs and slides for display
$tabs = $crudController->getAllTabs();
$slides = $crudController->getAllSlides();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin - Manage Tabs and Slides</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
  <h2>Manage Tabs and Slides</h2>

  <div class="row mt-4">
    <div class="col-md-6">
      <h4>Add Tab</h4>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Tab Name</label>
          <input type="text" class="form-control" name="tab_name" required />
        </div>
        <div class="mb-3">
          <label>Tab Icon (SVG file)</label>
          <input type="file" class="form-control" name="tab_icon_svg" accept=".svg" required />
        </div>
        <button type="submit" name="add_tab" class="btn btn-success">Add Tab</button>
      </form>
    </div>

    <div class="col-md-6">
      <h4>Add Slide</h4>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Select Tab</label>
          <select class="form-control" name="tab_id" required>
            <option value="">-- Select --</option>
            <?php foreach($tabs as $tab): ?>
            <option value="<?php echo $tab['id']; ?>"><?php echo htmlspecialchars($tab['name']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Slide Title</label>
          <input type="text" class="form-control" name="title" required />
        </div>
        <div class="mb-3">
          <label>Description</label>
          <textarea class="form-control" name="description"></textarea>
        </div>
        <div class="mb-3">
          <label>Image (upload)</label>
          <input type="file" class="form-control" name="image" required />
        </div>
        <button type="submit" name="add_slide" class="btn btn-primary">Add Slide</button>
      </form>
    </div>
  </div>

  <hr>
  <a href="index.php" class="btn btn-secondary">Back to Frontend</a>
</div>
</body>
</html>