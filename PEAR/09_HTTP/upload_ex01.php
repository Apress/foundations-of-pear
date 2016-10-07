<html>
<body>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" 
method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="20000" />
    File to upload: <input name="myFile" type="file" />
    <input type="submit" name="submit" value="Upload" />
</form>
<?php
require_once('HTTP/Upload.php');
if (isset($_POST['submit']) && $_POST['submit'] == 'Upload') {
            $upload = new HTTP_Upload('en');
            $file = $upload->getFiles('myFile');
            if (PEAR::isError($file)) {
                        die ($file->getMessage());
            }
            if ($file->isValid()) {
                 $upload_directory = 'c:/xampp/htdocs/Apress/uploads/';
                 $file->setName('safe');
                 $upload_name = $file->moveTo($upload_directory);
                 if (PEAR::isError($upload_name)) {
                                    die ($upload_name->getMessage());
                 }
                 echo 'The file <strong>' . $file->getProp('real') 
                 . '</strong> has been uploaded to the <em>' 
                 . $upload_directory . '</em> directory and renamed to <strong>' 
                 . $upload_name . '</strong>.';
            }
}
?>
</body>
</html>
