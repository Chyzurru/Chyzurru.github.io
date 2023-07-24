<!DOCTYPE html>
<html>
<head>
    <title>Penyimpanan Foto</title>
    <style>
          /* CSS untuk ukuran layar yang lebih kecil */
          @media (max-width: 768px) {
            body {
                margin: 10px; /* Ubah margin untuk tampilan layar kecil */
            }

            h1 {
                font-size: 24px; /* Ubah ukuran font judul untuk tampilan layar kecil */
            }

            .galeri-foto {
                display: block; /* Ubah tampilan galeri menjadi tampilan blok pada layar kecil */
            }

            .gallery-item {
                margin-bottom: 20px; /* Ubah margin antar item galeri pada layar kecil */
            }
        }

        /* CSS untuk ukuran layar yang lebih besar */
        @media (min-width: 769px) {
            body {
                margin: 20px; /* Gunakan margin lebih besar untuk tampilan layar besar */
            }

            h1 {
                font-size: 36px; /* Gunakan ukuran font judul lebih besar untuk tampilan layar besar */
            }

            .galeri-foto {
                display: flex; /* Gunakan tampilan flex untuk galeri pada layar besar */
                flex-wrap: wrap; /* Wrap item galeri ke baris baru jika lebar layar terlalu kecil */
            }

            .gallery-item {
                margin-bottom: 30px; /* Berikan margin antar item galeri lebih besar pada layar besar */
                flex: 0 0 calc(33.33% - 20px); /* Tentukan lebar item galeri menjadi 33.33% minus margin */
            }
        }

        /* CSS umum untuk semua ukuran layar */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        select,
        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            max-width: 200px;
            display: block;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        p {
            color: #666;
        }

        .folder-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .folder-list li {
            margin-bottom: 10px;
        }

        .folder-list li a {
            display: block;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.2s ease;
        }

        .folder-list li a:hover {
            background-color: #f0f0f0;
        }

        .folder-list li a::before {
            content: "\f07b";
            font-family: FontAwesome;
            margin-right: 10px;
        }

       /* CSS for gallery and folder list */
.gallery-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.gallery-item {
    flex: 0 0 calc(25% - 20px);
    margin-bottom: 20px;
}

.gallery-image {
    width: 100%;
}

.gallery-buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 5px;
}

.gallery-button {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 8px 12px;
    margin-right: 5px;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.gallery-button:hover {
    background-color: #45a049;
}

.delete-button {
    background-color: #f44336;
}

.delete-button:hover {
    background-color: #d32f2f;
}

.gallery-empty {
    text-align: center;
    margin-top: 20px;
}

.folder-list-title {
    width: 100%;
    text-align: center;
    margin-bottom: 20px;
}

.folder-link {
    display: block;
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.2s ease;
    text-align: center;
}

.folder-link:hover {
    background-color: #f0f0f0;
}

    </style>
</head>
<body>
    <h1>Penyimpanan Foto nekoflix</h1>

    <!-- Form untuk mengunggah foto -->
    <div class="form-container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="photo">Pilih Foto:</label>
            <input type="file" name="photo" id="photo">
            <select name="folder" id="folder">
                <?php
                $folderDir = "uploads/";
                $folders = scandir($folderDir);
                foreach ($folders as $folder) {
                    if ($folder !== '.' && $folder !== '..' && is_dir($folderDir . $folder)) {
                        echo "<option value='$folder'>$folder</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" value="Unggah Foto" name="submit">
        </form>
    
        <!-- Form untuk membuat folder -->
        <form action="create_folder.php" method="post">
            <label for="new_folder">Nama Folder Baru:</label>
            <input type="text" name="new_folder" id="new_folder" required>
            <input type="submit" value="Buat Folder" name="submit">
        </form>
    </div>

  <!-- Daftar foto yang telah diunggah di folder terpilih -->
<div class="galeri-foto">
    
<?php
   if (isset($_GET['folder'])) {
    $selectedFolder = $_GET['folder'];
    $folderDir = "uploads/" . $selectedFolder . "/";
    $photos = scandir($folderDir);
    if (count($photos) > 2) {
        echo "<h2 class='gallery-title'>Foto dalam Folder \"$selectedFolder\"</h2>";
        echo "<div class='gallery-container'>";
        foreach ($photos as $photo) {
            if ($photo !== '.' && $photo !== '..') {
                $photoUrl = $folderDir . $photo;
                $fullPhotoUrl = "http://nekoflixstorage.byethost22.com/" . $photoUrl;
                echo "<div class='gallery-item'>";
                echo "<img class='gallery-image' src='$photoUrl' alt='$photo'>";
                echo "<div class='gallery-buttons'>";
                echo "<button class='gallery-button' onclick='salinAlamatGambar(\"$fullPhotoUrl\")'>Copy Link</button>";
                echo "<button class='gallery-button delete-button' onclick='deletePhoto(\"$photoUrl\")'>Delete</button>";
                echo "</div>";
                echo "</div>";
            }
        }
        echo "</div>";
    } else {
        echo "<p class='gallery-empty'>Tidak ada foto dalam Folder \"$selectedFolder\".</p>";
    }
    } else {
        // Show the list of folders to select from
        echo "<h2 class='folder-list-title'>Pilih Folder:</h2>";
        echo "<ul class='folder-list'>";
        $folderDir = "uploads/";
        $folders = scandir($folderDir);
        foreach ($folders as $folder) {
            if ($folder !== '.' && $folder !== '..' && is_dir($folderDir . $folder)) {
                echo "<li><a class='folder-link' href=\"?folder=$folder\">$folder</a></li>";
            }
        }
        echo "</ul>";
    }
    ?>
</div>

   

    <script>

function salinAlamatGambar(alamatGambar) {
        const el = document.createElement('textarea'); // Buat elemen textarea sementara
        el.value = alamatGambar; // Setel nilai textarea dengan URL gambar
        document.body.appendChild(el); // Tambahkan elemen textarea ke dalam DOM

        el.select(); // Pilih teks di dalam textarea
        document.execCommand('copy'); // Salin teks yang dipilih ke clipboard

        document.body.removeChild(el); // Hapus elemen textarea sementara

        alert("Alamat gambar telah disalin: " + alamatGambar); // Tampilkan pesan konfirmasi
    }
        function copyToClipboard(text) {
            const el = document.createElement('textarea');  // Create a temporary textarea element
            el.value = text;  // Set the textarea value to the text we want to copy
            document.body.appendChild(el);  // Append the textarea to the DOM
            el.select();  // Select the text in the textarea
            document.execCommand('copy');  // Copy the selected text
            document.body.removeChild(el);  // Remove the temporary textarea
            alert("Link copied to clipboard: " + text);  // Show a confirmation message
        }

        function deletePhoto(photoUrl) {
        // Send an AJAX request to the server to delete the photo
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // The photo has been deleted successfully, you can update the UI or perform any necessary actions.
                    alert("Photo deleted successfully!");
                } else {
                    // Handle any errors that occurred during the deletion process.
                    alert("An error occurred while deleting the photo.");
                }
            }
        };

        // Modify 'delete_photo.php' to the actual server-side script responsible for photo deletion
        xhr.open("POST", "delete_photo.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("photo_url=" + encodeURIComponent(photoUrl));
    }
    </script>
</body>
</html>
