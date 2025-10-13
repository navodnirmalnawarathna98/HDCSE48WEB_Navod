<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2>Add New Card</h2>
    <form action="save_card.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Card Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Card Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image Type</label>
            <select name="image_type" class="form-select" required>
                <option value="folder">Upload Image to Folder</option>
                <option value="url">Provide Image URL</option>
                <option value="base64">Convert to Base64</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Image or Paste URL</label>
            <input type="file" name="image_file" class="form-control">
            <input type="text" name="image_url" class="form-control mt-2" placeholder="Or enter image URL">
        </div>
        <button type="submit" class="btn btn-primary">Save Card</button>
    </form>
</div>

</body>
</html>
