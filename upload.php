<?php

    if(isset($_POST["submit"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["myfile"]["name"]);
        $documentFiletype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); 
        $allowedExtensions = array("txt", "pdf", "doc", "docx");

        $maxFileSize = 3 * 1024 * 1024;

        if(in_array($documentFiletype, $allowedExtensions) && $_FILES["myfile"]["size"] <= $maxFileSize) {
            if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetFile)) {
                echo "Dokumen berhasil diunggah.";
            } else {
                echo "Gagal mengunggah Dokumen.";
            }
        } else {
            echo "Dokumen tidak valid atau melebihi ukuran maksimum yang diizinkan.";
        }
    }

?>
