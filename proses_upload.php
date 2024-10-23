<?php
$targetDirectory = "uploads/";

if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

if ($_FILES['files']['name'][0]) {
    $totalFile = count($_FILES['files']['name']);

    echo "<div style='display: flex; flex-wrap: wrap;'>"; 

  
    for ($i = 0; $i < $totalFile; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $targetFile = $targetDirectory . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($fileType, $allowedExtensions) && $_FILES["files"]["size"][$i]) {
    
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
                echo "File $fileName berhasil diunggah. <br>";

            
                list($width, $height) = getimagesize($targetFile);
                $newWidth = 200;
                $newHeight = ($height / $width) * $newWidth;
                echo "<div style='margin: 10px;'> <img src='$targetFile' alt='$fileName' width='$newWidth' height='$newHeight'> </div>";
            } else {
                echo "Gagal mengunggah file $fileName. <br>";
            }
        } else {
            echo "File $fileName tidak valid atau gagal diunggah. <br>";
        }
    }

    echo "</div>";
} else {
    echo "Tidak ada file yang diunggah.";
}
?>