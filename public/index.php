<?php
include '../src/config.php';

// Fetch tabs
$tabs = [];
$tabs_result = $conn->query("SELECT * FROM tabs ORDER BY id ASC");
while($row = $tabs_result->fetch_assoc()) {
    $tabs[] = $row;
}

// Fetch slides grouped by tab
$slides_by_tab = [];
foreach($tabs as $tab) {
    $tab_id = $tab['id'];
    $slides_result = $conn->query("SELECT * FROM slides WHERE tab_id = $tab_id ORDER BY id ASC");
    $slides = [];
    while($slide = $slides_result->fetch_assoc()) {
        $slides[] = $slide;
    }
    $slides_by_tab[$tab_id] = $slides;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Slider CRUD Demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
<link rel="stylesheet" href="./assets/style.css"/>

</head>
<body>
<div class="header-section">
  <h1>DelphianLogic in Action</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo</p>
</div>
<div class="container">
  <div class="main-content">
    <div class="sidebar">
      <?php foreach($tabs as $index => $tab): ?>
        <button class="tab-btn<?php if($index==0) echo ' active'; ?>" data-tab="<?php echo $tab['id']; ?>">
          <?php if (!empty($tab['icon_svg'])): ?>
            <img src="<?php echo htmlspecialchars($tab['icon_svg']); ?>" class="tab-icon" alt="icon" width="40px" height="40px"/>
          <?php endif; ?>
          <?php echo htmlspecialchars($tab['name']); ?>
        </button>
      <?php endforeach; ?>
    </div>
    <div class="slider-section">
      <?php foreach($tabs as $index => $tab): ?>
        <div class="slider slider-<?php echo $tab['id']; ?>" style="<?php if($index!=0) echo 'display:none;'; ?>">
          <?php foreach($slides_by_tab[$tab['id']] as $slide): ?>
            <div class="mid-align height-300">
              <h6 class="bg-gray text-center br-sm inline"><?php echo strtoupper(htmlspecialchars($slide['title'])); ?></h4>
              <h4 class=" text-center"><?php echo nl2br(htmlspecialchars($slide['description'])); ?></h4>
              <div class="flex"><button>Learn More</button><img class="btn-icon" src="./assets/right-arrow.svg" alt="icon" width="15px" height="15px"> </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="image-section">
      <div class="slider-image" id="imageDisplay" style="background-image: url('');"></div>
    </div>
  </div>
  <div>
    <a href="admin.php" class="btn btn-primary mt-3">Manage Tabs and Slides (Admin)</a>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
  var slidesData = {};
  <?php foreach($tabs as $tab): ?>
    slidesData[<?php echo $tab['id']; ?>] = [
      <?php foreach($slides_by_tab[$tab['id']] as $slide): ?>
        '<?php echo addslashes($slide['image']); ?>',
      <?php endforeach; ?>
    ];
  <?php endforeach; ?>

  var firstTabId = <?php echo $tabs[0]['id'] ?? 0; ?>;
</script>
<script defer src="./assets/script.js"></script>

</body>
</html>