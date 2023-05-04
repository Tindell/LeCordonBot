<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = 'wp-content/uploads/test_upload/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploadfile = $upload_dir . basename($_FILES['userfile']['name']);

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "File was successfully uploaded.\n";
    } else {
        echo "File upload failed.\n";
        echo 'Error code: ' . $_FILES['userfile']['error'] . "\n";
        echo 'Temp file path: ' . $_FILES['userfile']['tmp_name'] . "\n";
        echo 'Upload file path: ' . $uploadfile . "\n";
        echo 'File permissions: ' . substr(sprintf('%o', fileperms($upload_dir)), -4) . "\n";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Test</title>
</head>
<body>
    <form enctype="multipart/form-data" action="upload_test.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
        Choose a file to upload: <input name="userfile" type="file" /><br />
        <input type="submit" value="Upload File" />
    </form>
</body>
</html>

