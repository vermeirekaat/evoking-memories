<?php 

    $currentDirectory = getcwd(); 
    $uploadDirectory = "/uploads/"; 

    $errors = []; 

    $fileExtensionsAllowed = ['jpeg', 'jpg', 'png']; 

    $fileName = pathinfo($_FILES['imageFile']['name']);
    $ext = $fileName['extension']; 
    $newName = "image.".$ext;  
    $fileSize = $_FILES['imageFile']['size']; 
    $fileTmpName = $_FILES['imageFile']['tmp_name']; 
    $fileType = $_FILES['imageFile']['type']; 
    $tmp = explode('.', $newName); 
    $fileExtension = end($tmp);


    $uploadPath = $currentDirectory . $uploadDirectory . basename($newName); 

    if(isset($_POST['submit'])) {
        if(! in_array($fileExtension, $fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG"; 
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

?> 
