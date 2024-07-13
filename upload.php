<?php

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tempName = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    move_uploaded_file($tempName, 'uploads/' . $fileName); // Save file to uploads folder
    echo 'File uploaded successfully';
} else {
    echo 'Error uploading file';
}
?>
