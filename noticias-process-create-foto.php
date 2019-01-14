 <?php
 $file_title = $_POST['file_title'];
 $target_dir = "./noticias/fotos/";
 $target_name = "./noticias/fotos/" .$file_title;
 $rand = rand(10000000, 999999999);
 $time = time();
 $file_name = $rand.$time.$_FILES["fileToUpload"]["name"];
 $target_file = $target_name . '.jpg';
 // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 // Check if image file is a actual image or fake image
 if(isset($_POST["submit"])) {
     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
     if($check !== false) {
 //        echo "File is an image - " . $check["mime"] . ".";
         $uploadOk = 1;
     } else {
 //        echo "File is not an image.";
         $uploadOk = 0;
     }
 }
 // Check if file already exists
 if (file_exists($target_file)) {
     echo "Sorry, file already exists.";
     $uploadOk = 0;
 }
 // Check file size
 //if ($_FILES["fileToUpload"]["size"] > 500000) {
 //    echo "Sorry, your file is too large.";
 //    $uploadOk = 0;
 // }
 // Allow certain file formats
 if($imageFileType != "jpg") {
     echo "Sorry, only JPG files are allowed.";
     $uploadOk = 0;
 }
 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
     echo "Sorry, your file was not uploaded.";
 // if everything is ok, try to upload file
 } else {
     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
         file_put_contents('noticias/textos/'.$_POST['file_title'],$_POST['file_detalle']);
         $result = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded......" ;
         $url = './noticias-admin-fotos.php';
         header( "Location: $url?rmessage=$result" );
     } else {
         echo "Sorry, there was an error uploading your file.";
     }
 }
 ?>
