<?php 

    $currentDirectory = getcwd(); 
    $uploadDirectory = "/uploads/"; 

    $errors = []; 

    $fileExtensionsAllowed = ['mp3']; 

    $fileName = pathinfo($_FILES['songFile']['name']);
    $ext = $fileName['extension']; 
    $newName = "song.".$ext;  
    $fileSize = $_FILES['songFile']['size']; 
    $fileTmpName = $_FILES['songFile']['tmp_name']; 
    $fileType = $_FILES['songFile']['type']; 
    $tmp = explode('.', $newName); 
    $fileExtension = end($tmp);
    // $fileExtension = strtolower(end(explode('.', $fileName))); 

    $uploadPath = $currentDirectory . $uploadDirectory . basename($newName); 

    if(isset($_POST['submit'])) {
        if(! in_array($fileExtension, $fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file (image), MP3 or MP4 file (song)"; 
        }
        }
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if($didUpload) {
                Header('Location: index.html');
                exit();
                // echo "The file " . basename($newName) . " has been uploaded"; 
            } else {
                echo "An error occured.";
            }
        } else {
            foreach($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
