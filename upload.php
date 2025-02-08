<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    $userId = 1; // For testing purpose, hardcoded user id

    $imageName = basename($_FILES["image"]["name"]);
    $targetFile = "assets/images/" . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $stmt = $pdo->prepare("INSERT INTO images (image_path, category, tags, user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$imageName, $category, $tags, $userId]);
        echo "<p class='success'>Image uploaded successfully!</p>";
    } else {
        echo "<p class='error'>Image upload failed!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f3f4f7, #e1e8f0);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Form Styles */
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #007bff;
        }

        input[type="file"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <h1>Upload Image</h1>
        <input type="file" name="image" required><br>
        <input type="text" name="category" placeholder="Category" required><br>
        <input type="text" name="tags" placeholder="Tags (comma separated)" required><br>
        <button type="submit">Upload Image</button>
    </form>
</body>
</html>
