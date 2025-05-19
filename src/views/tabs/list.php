<?php
include_once '../../config.php';

// Fetch all tabs from the database
$result = $conn->query("SELECT * FROM tabs ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tab List</title>
    <link href="../../public/assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Tabs List</h1>
        <a href="create.php" class="btn btn-primary">Create New Tab</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tab = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tab['id']); ?></td>
                        <td><?php echo htmlspecialchars($tab['name']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $tab['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $tab['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tab?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>