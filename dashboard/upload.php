<?php
require_once(__DIR__ . '/../core/core.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file and insert into database
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;

            // Insert into database
 $sql = "INSERT INTO cakes (name, price, category, image, description) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdsss", $name, $price, $category, $image_path, $description);


            if ($stmt->execute()) {
                $success = "Cake uploaded successfully.";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Cake</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Upload Cake</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="upload" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Cake Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Cake Category:</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Upload Cake</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if you need JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>