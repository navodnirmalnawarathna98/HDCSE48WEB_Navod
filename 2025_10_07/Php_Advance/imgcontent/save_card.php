<?php
$conn = new mysqli("localhost", "root", "", "image_upload_db");

$title = $_POST['title'];
$description = $_POST['description'];
$image_type = $_POST['image_type'];
$image_data = '';

if ($image_type == 'folder' && isset($_FILES['image_file'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir);
    $fileName = basename($_FILES["image_file"]["name"]);
    $targetFile = $targetDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFile)) {
        $image_data = $targetFile;
    }
} elseif ($image_type == 'url' && !empty($_POST['image_url'])) {
    $image_data = $_POST['image_url'];
} elseif ($image_type == 'base64' && isset($_FILES['image_file'])) {
    $imgData = file_get_contents($_FILES['image_file']['tmp_name']);
    $base64 = 'data:' . $_FILES['image_file']['type'] . ';base64,' . base64_encode($imgData);
    $image_data = $base64;
}

$stmt = $conn->prepare("INSERT INTO cards (title, description, image_type, image_data) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $description, $image_type, $image_data);
$stmt->execute();

header("Location: view_cards.php");
?>
