<?php

if (isset($_POST['submit']))
{
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed))
    {
        if ($fileError === 0)
        {
            if ($fileSize < 1000000)
            {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/$'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php");
            }
            else
            {
                echo "Your file is too large.";
            }
        }
        else
        {
            echo "There was an error uploading your file.";
        }
    }
    else
    {
        echo "You cannot upload files of this type.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>