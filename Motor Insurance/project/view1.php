<?php
include "db_conn.php";
require_once __DIR__ . '/vendor1/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;

// Retrieve parameters from URL
if (isset($_GET['name']) && isset($_GET['vehicle_num']) && isset($_GET['date'])) {
    $name = $_GET['name'];
    $vehicle_num = $_GET['vehicle_num'];
    $date = $_GET['date'];
} else {
    header("Location: 1.php");                   /////////////////////
    exit();
}

function getDominantColor($imagePath) {
    $imageType = exif_imagetype($imagePath);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $image = @imagecreatefrompng($imagePath);
            if (!$image) {
                throw new Exception("Unable to open PNG image.");
            }
            break;
        default:
            throw new Exception("Unsupported image type.");
    }

    $width = imagesx($image);
    $height = imagesy($image);
    $colorCount = [];

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $colorKey = sprintf('%02x%02x%02x', $r, $g, $b);

            if (isset($colorCount[$colorKey])) {
                $colorCount[$colorKey]++;
            } else {
                $colorCount[$colorKey] = 1;
            }
        }
    }

    arsort($colorCount);
    $dominantColor = array_key_first($colorCount);
    imagedestroy($image);

    return [
        hexdec(substr($dominantColor, 0, 2)),
        hexdec(substr($dominantColor, 2, 2)),
        hexdec(substr($dominantColor, 4, 2))
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motor Insurance  View Uploaded Images for <?php echo htmlspecialchars($name); ?></title>
<link rel=" shortcut icon" type="x-icon" href="logo.png">
<style>
        body {
            background: url('final1111.jpg') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover; 
            z-index: -1;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .container {
            position: absolute;
            top: 18%;
            width: 100%;
            max-width: 1200px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .image-container {
            position: relative;
            width: 200px;
            margin: 10px;
            text-align: center;
        }
        .image-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
        .image-text {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        button {
            padding: 10px 20px;
            color: white;
            background: linear-gradient(to bottom, #336699 0%, #33cccc 100%);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        button:hover {
            background: linear-gradient(to bottom, #009999 0%, #00cc99 100%);
        }
        .b {
            padding: 10px 20px;
            color: white;
            background: linear-gradient(to bottom, #f08989 0%, #cc335f 100%);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        .b:hover {
            background: linear-gradient(to bottom, #cc335f 0%, #f08989 100%);
        }
        .header {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        .notice {
            color: #ff3434;
            font-size: 24px;
            text-align: center;
        }
        .home-icon {
            position: fixed;
            top: 6%;
            left: 6%;
            z-index: 10;
        }

        .home-icon img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .home-icon img:hover {
            transform: scale(1.1);
        }

        .back-icon {
            position: fixed;
            top: 6%;
            left: 88%;
            z-index: 10;
        }

        .back-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .back-icon .back-img:hover {
            transform: scale(1.1);
        }
        @media (max-width: 768px) {
            .home-icon {
                top: 4%;
                left: 4%;
            }
            .home-icon img {
                width: 70px;
                height: 70px;
            }
            
            .container {
                width: 90%;
                padding: 10px;
                height: 95%;
            }
            .button-container{
                position: absolute;
                top:86%;
            }
        }
        @media (max-width: 480px) {
            .home-icon {
                top: 4%;
                left: 4%;
            }
            .home-icon img {
                width: 40px;
                height: 40px;
            }
           
            .image-container {
                width: 150px;
            }
            .image-text {
                font-size: 14px;
            }
            .notice {
                font-size: 80%;
            }
            .button-container{
                position: absolute;
                top:84.5%;
            }
            .container {
                position: absolute;
                top: 7%;
                width: 90%;
                height: 133%;
                padding: 10px;
            }
           
        }
    </style>
</head>
<body>
    
    <a href="new1.html" class="home-icon">
        <img src="home.jpg" alt="Home">
    </a>
   
    <div class="container">
        <h1 class="header">Viewing Uploaded Images from <?php echo htmlspecialchars($name); ?><br></h1>
        <div class="gallery">
            <?php
            $stmt = $conn->prepare("SELECT * FROM image3 WHERE cname = ? AND vehicle_num = ? AND date_time = ? ORDER BY id DESC");
            $stmt->bind_param('sss', $name, $vehicle_num, $date);
            $stmt->execute();
            $result = $stmt->get_result();

            $dominantColors = [];
            $firstImageText = null;
            $secondImageText = null;

            if ($result->num_rows > 0) {
                $imageCount = 0;
                while ($row = $result->fetch_assoc()) {
                    $imagePaths = [];
                    for ($i = 1; $i <= 5; $i++) {
                        if (!empty($row['image' . $i])) {
                            $imagePaths[] = 'uploads1/' . $row['image' . $i];
                        }
                    }
                    foreach ($imagePaths as $index => $imagePath) {
                        if (!file_exists($imagePath)) {
                            echo "<div class='image-container'>";
                            echo "<p class='error-message'>Image not found: " . htmlspecialchars($imagePath) . "</p>";
                            echo "</div>";
                            continue;
                        }

                        echo "<div class='image-container'>";
                        echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Uploaded Image'>";

                        if (in_array($index, [0, 2, 3, 4])) {
                            try {
                                $dominantColor = getDominantColor($imagePath);
                                $dominantColors[$index] = $dominantColor;
                                //echo "<p class='image-text'>Dominant Color: RGB(" . $dominantColor[0] . ", " . $dominantColor[1] . ", " . $dominantColor[2] .  ")</p>";
                            } catch (Exception $e) {
                                echo "<p class='error-message'>Error extracting dominant color: " . htmlspecialchars($e->getMessage()) . "</p>";
                            }
                        }

                        if ($imageCount < 2) {
                            try {
                                $ocr = new TesseractOCR($imagePath);
                                $ocr->executable('C:\\Program Files\\Tesseract-OCR\\tesseract.exe');
                                $text = $ocr->run();

                                if ($imageCount === 0) {
                                    echo "<h2 class='image-text'><strong>VEHICLE NUMBER:<br><br>" . htmlspecialchars($text) . "</strong></h2>";
                                    $firstImageText = $text;
                                } elseif ($imageCount === 1) {
                                    $secondImageText = $text;
                                }

                                $imageCount++;
                            } catch (Exception $e) {
                                echo "<p class='error-message'>Error extracting text: " . htmlspecialchars($e->getMessage()) . "</p>";
                            }
                        }
                        echo "</div>";
                    }
                }

                $colorsMatch = count($dominantColors) === 4 && count(array_unique($dominantColors, SORT_REGULAR)) === 1;
                $textsMatch = $firstImageText === $secondImageText;

                echo '<div class="button-container">';
                if ($colorsMatch && $textsMatch) {
                    echo '<button onclick="note()">NEXT</button>';
                } else {
                    echo "<p class='notice'><strong>FAILED</strong></p>";
                    echo '<button class="b" onclick="ret()">BACK</button>';
                }
                echo '</div>';
            } else {
                echo "<p>No images found in the database for this claim.</p>";
            }
            ?>
        </div>
    </div>
    <script>
            function note() {
    const name = "<?php echo addslashes($name); ?>";
    const vehicle_num = "<?php echo addslashes($vehicle_num); ?>";
    const date = "<?php echo addslashes($date); ?>";
    const request = 1;

    console.log(`Name: ${name}, Vehicle Number: ${vehicle_num}, Date: ${date}`); // Debugging


    // This part belongs to insurance claim
    // not needed in view1.php
                
    // fetch('insert_data.php', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/x-www-form-urlencoded',
    //     },
    //     body: new URLSearchParams({
    //         'name': name,
    //         'vehicle_num': vehicle_num,
    //         'date': date,
    //         'request': request
    //     })
    // })


    .then(response => response.text())
    .then(data => {
        if (data === 'Success') {
            alert("Photo's uploaded");
            location.href = `addons.php?vehicle_num=${encodeURIComponent(vehicle_num)}&name=${encodeURIComponent(name)}&date=${encodeURIComponent(date)}`;
        } else {
            alert('Error: ' + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
            function ret() {
                location.href = "photo1.php";
            }

      
    </script>
</body>
</html>
