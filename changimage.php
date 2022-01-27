<?php
// Start the session
session_start();
  include 'header.php';

 $histoire_id="";  
 $ageid="";  
 $titre="";  
 $typehistoire="";  
 $description="";  
 $image="";  
 $texthistoire2="";  
 $datepub="";  

 if (isset($_GET['id'])) {  

     $id_utilisateur =  $_SESSION["id"];
     $idhistoire = $_GET['id'];

      $id=$_GET['id'];  
      $select=mysqli_query($conn,"SELECT * FROM histoire LEFT JOIN type ON histoire.type_histoire_id=type.id WHERE histoire.id = $id");  
     
     //  $select=mysqli_query($conn,"SELECT * FROM histoire WHERE histoire.id = $id");  
      $row=mysqli_fetch_assoc($select);  
      $histoire_id=$row['id'];  
      $ageid=$row['limite_age_id'];  
      $titre=$row['titre'];  
      $typehistoire=$row['type_histoire_id'];  
      $description=$row['description'];  
      $image=$row['image'];
      $texthistoire1 = $row['text_histoire']; 
      $datepub=$row['date_pub'];  
 }  
 if (isset($_POST['update'])) {  
      //echo "<pre>";  
      //print_r($_POST);   

            //ajout d'image
        $target_dir = "imgs/";//dossier de reception
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        //if(isset($_POST["submit"])) {
        $query = getimagesize($_FILES["image"]["tmp_name"]);
        if($query !== false) {
            echo "Le fichier est une bonne image - " . $query["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "ceci n'est pas une bonne image.";
            $uploadOk = 0;
        }
        //renomer l'image
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $image = $target_dir. $newfilename;
        //}
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], "".$image)) {
                echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }




     //  $datepub=$_POST['date_pub'];  
      if (isset($_GET['id'])) {  
         

           $update=mysqli_query($conn,"UPDATE histoire SET image ='$image' WHERE id='$id'");  
           if ($update) {  
                header("index.php");  
                die();  
           }  
      }else{  
           $insert=mysqli_query($conn,"INSERT INTO `histoire`( `image`) VALUES ('$image', NOW())");  
           if ($insert) {  
                $msg="Data inserted successfully";  
           }else{  
                $msg="Something Error, Try after sometime !";  
           }  
      }  
 }  
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="imgs/1641483390.jpg">
    <link rel="stylesheet" href="mehdy.css">
    <title>Mehdy Stories Book</title>
    <style> 
 
</style>
</head>
<body>
<main class="container-fluid mb-4">

<form action="" method="post"  enctype="multipart/form-data">
            
     <div class="form-row">
              

            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="titre">Titre</label>
                <input type="text" value="<?php echo $titre ?>" class="form-control" id="titre" name="titre" placeholder="entrer votre titre">   
                </div>
            </div>

            <div class="form-row">
                <label for="image"> Choisir une Couverture</label>
                <input type="file" class="form-control" aria-label="file example" id="image" placeholder="ajouter une image" name="image" required>

            </div>
    </div>
            
            <br /> <br />

            <button type="submit" class="btn btn-primary" name="update">update</button>

  </form>


 </main>
     
<?php
include 'footer.php';
?>

</body>
</html>