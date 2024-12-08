<?php
    if(isset($_FILES['file'])){
        $file_name = $_FILES['file']['name'];
        $file_path = $_FILES["file"]["tmp_name"];
        $uploads_dir='/files';
        
        move_uploaded_file($file_path, $uploads_dir . '/'. $file_name);     

        //move_uploaded_file($file_tmp, "/files/".$file_name);
        $pdf = file_get_contents($uploads_dir . '/' . $file_name);
        $number = preg_match_all("/\/Page\W/", $pdf, $dummy);

        echo "<br><h1>The number of pages inside pdf document is :". $number . "</h1> <br>";
    }

?>


<!DOCTYPE html>
<html lang="en">

<body>

<!-- File input form -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file" accept=".pdf"/>
    <input type="submit" value="count pages"/>
</form>

</body>
</htmml>