<?php
include "db_conn.php";

if (isset($_FILES['vehicleImage1']) && isset($_FILES['vehicleImage2']) && isset($_FILES['vehicleImage3']) && isset($_FILES['vehicleImage4']) && isset($_FILES['vehicleImage5'])) {
    $allowed_exs = array("jpg", "jpeg", "png");
    $images = [];

    for ($i = 1; $i <= 5; $i++) {
        $img_name = $_FILES['vehicleImage' . $i]['name'];
        $img_size = $_FILES['vehicleImage' . $i]['size'];
        $tmp_name = $_FILES['vehicleImage' . $i]['tmp_name'];
        $error = $_FILES['vehicleImage' . $i]['error'];

        if ($error === 0) {
            if ($img_size > 2097152) {                                         //2mb
                echo "<script>
                        alert('Sorry, your file $i is too large');
                        window.location.href='photo.php';
                      </script>";
                exit();
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $images[] = $new_img_name;
                } else {
                    $em = "You can't upload files of this type";
                    header("Location: index.php?error=$em");
                    exit();
                }
            }
        } else {
            $em = "unknown error occurred!";
            header("Location: index.php?error=$em");
            exit();
        }
    }

    // Insert into Database
    $name = $_POST['name1'];
    $vehicle_num = $_POST['vehicle1'];
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO image2 (cname, vehicle_num, image1, image2, image3, image4, image5,date_time)
            VALUES ('$name', '$vehicle_num','$images[0]', '$images[1]', '$images[2]', '$images[3]', '$images[4]','$date')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to view.php with parameters
            header("Location: view.php?name=" . urlencode($name) . "&vehicle_num=" . urlencode($vehicle_num)."&date=".urldecode($date));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    mysqli_close($conn);
} else {
    header("Location: photo.php");
    exit();
}
?>
