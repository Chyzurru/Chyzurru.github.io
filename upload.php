<?php
if (isset($_POST['submit'])) {
    $folderName = $_POST['folder'];
    $targetDir = "uploads/" . $folderName . "/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar atau bukan
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Cek apakah file sudah ada di server
    if (file_exists($targetFile)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Batasi ukuran file yang diunggah
    $maxFileSize = 5000000; // 5MB
    if ($_FILES["photo"]["size"] > $maxFileSize) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan hanya beberapa format gambar tertentu
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, foto tidak dapat diunggah.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            echo "Foto berhasil diunggah: <a href='$targetFile'>$targetFile</a>";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah foto.";
        }
    }
}
?>
