<?php
if (isset($_POST['submit'])) {
    $folderName = $_POST['new_folder'];
    $targetDir = "uploads/" . $folderName . "/";
    
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
        echo "Folder \"$folderName\" berhasil dibuat.";
    } else {
        echo "Maaf, folder \"$folderName\" sudah ada.";
    }
}
?>
