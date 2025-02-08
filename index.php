<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery with Filters and Modal Viewer</title>
    <style>
        /* General Page Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f7f7f7, #e9f1f7);
            color: #333;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #007bff;
        }

        select {
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        /* Gallery Layout */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .image-card {
            cursor: pointer;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .image-card img {
            width: 100%;
            height: auto;
        }

        .image-card:hover {
            transform: scale(1.05);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
        }

        #imageCaption {
            color: #fff;
            text-align: center;
            margin: 15px 0;
            font-size: 16px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }

        .nav-btn {
            color: white;
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
        }

        #prevBtn {
            left: 5%;
        }

        #nextBtn {
            right: 5%;
        }
/* Upload Button with Rounded Borders and Color Animation */
.upload-btn {
    background-color: #ff7b7b;
    color: white;
    padding: 12px 25px;
    border: none;
    text-decoration: none;
    cursor: pointer;
    border-radius: 30px;
    font-size: 16px;
    font-weight: bold;
    display: inline-block;
    animation: colorChange 4s infinite;
    transition: transform 0.3s ease;
}

.upload-btn:hover {
    transform: scale(1.1);
}

@keyframes colorChange {
    0% { background-color: #ff7b7b; }
    25% { background-color: #ffbb7b; }
    50% { background-color: #7bffad; }
    75% { background-color: #7bb5ff; }
    100% { background-color: #ff7b7b; }
}

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .modal-content {
                max-width: 95%;
            }
        }
    </style>
</head>
<body>
    <h1>Image Gallery</h1>

<!-- Category and Tag Filters -->
<select id="categoryFilter">
    <option value="">All Categories</option>
    <?php
    $stmt = $pdo->query("SELECT DISTINCT category FROM images");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['category']}'>{$row['category']}</option>";
    }
    ?>
</select>

<select id="tagFilter">
    <option value="">All Tags</option>
    <?php
    $stmt = $pdo->query("SELECT DISTINCT tags FROM images");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['tags']}'>{$row['tags']}</option>";
    }
    ?>
</select>
<a href="upload.php" class="upload-btn">Upload Image</a>


    <!-- Gallery Section -->
    <div id="gallery" class="gallery"></div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
        <div id="imageCaption"></div>
        <button id="prevBtn" class="nav-btn">❮ Prev</button>
        <button id="nextBtn" class="nav-btn">Next ❯</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentImageIndex = 0;
        let imagesData = [];

        // Fetch images initially
fetchImages();

// Category filter
$('#categoryFilter').on('change', function () {
    fetchImages($('#categoryFilter').val(), $('#tagFilter').val());
});

// Tag filter
$('#tagFilter').on('change', function () {
    fetchImages($('#categoryFilter').val(), $('#tagFilter').val());
});

// Fetch images based on category and tag
function fetchImages(category = '', tag = '') {
    $.ajax({
        url: 'fetch_images.php',
        method: 'GET',
        data: { category: category, tag: tag },
        success: function (data) {
            imagesData = JSON.parse(data);
            $('#gallery').empty();

            if (imagesData.length === 0) {
                $('#gallery').html('<p>No images found for the selected category or tag.</p>');
            }

            imagesData.forEach((image, index) => {
                $('#gallery').append(`
                    <div class="image-card" onclick="openModal(${index})">
                        <img src="assets/images/${image.image_path}" alt="${image.tags}">
                        <p>${image.category} - ${image.tags}</p>
                    </div>
                `);
            });
        }
    });
}


        // Open the modal and display the selected image
        function openModal(index) {
            currentImageIndex = index;
            displayImage(currentImageIndex);
            $('#imageModal').css('display', 'block');
        }

        // Close the modal
        $('.close').on('click', function () {
            $('#imageModal').css('display', 'none');
        });

        // Display the current image
        function displayImage(index) {
            const image = imagesData[index];
            $('#modalImage').attr('src', `assets/images/${image.image_path}`);
            $('#imageCaption').text(`${image.category} - ${image.tags}`);
        }

        // Navigate to the previous image
        $('#prevBtn').on('click', function (e) {
            e.stopPropagation();
            currentImageIndex = (currentImageIndex - 1 + imagesData.length) % imagesData.length;
            displayImage(currentImageIndex);
        });

        // Navigate to the next image
        $('#nextBtn').on('click', function (e) {
            e.stopPropagation();
            currentImageIndex = (currentImageIndex + 1) % imagesData.length;
            displayImage(currentImageIndex);
        });

        // Close modal on outside click
        $(window).on('click', function (event) {
            if (event.target.id === 'imageModal') {
                $('#imageModal').css('display', 'none');
            }
        });
    </script>
</body>
</html>
