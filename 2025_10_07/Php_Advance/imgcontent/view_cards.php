<?php
$conn = new mysqli("localhost", "root", "", "image_upload_db");
$result = $conn->query("SELECT * FROM cards");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Card List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-4">Cards</h2>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <?php
                        if ($row['image_type'] == 'base64' || $row['image_type'] == 'url') {
                            $imgSrc = $row['image_data'];
                        } else {
                            $imgSrc = $row['image_data'];
                        }
                    ?>
                    <img src="<?= htmlspecialchars($imgSrc) ?>" class="card-img-top" alt="Card Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
