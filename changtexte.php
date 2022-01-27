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
 $texthistoire="";  
 $datepub="";  

 if (isset($_GET['id'])) {  

     $id_utilisateur =  $_SESSION["id"];
     $idhistoire = $_GET['id'];

      $id=$_GET['id'];  
      $select=mysqli_query($conn,"SELECT * FROM histoire LEFT JOIN type ON histoire.type_histoire_id=type.id WHERE histoire.id = $idhistoire");  
     
     //  $select=mysqli_query($conn,"SELECT * FROM histoire WHERE histoire.id = $id");  
      $row=mysqli_fetch_assoc($select);  
      $histoire_id=$row['id'];  
      $ageid=$row['limite_age_id'];  
      $titre=$row['titre'];  
      $typehistoire=$row['type_histoire_id'];  
      $description=$row['description'];  
      $image=$row['image'];
      $texthistoire = $row['text_histoire']; 
      $datepub=$row['date_pub'];  
 }  
 if (isset($_POST['update'])) {    
      $typehistoire=$_POST['type_hist']; 
      $ageid=$_POST['limite_age'];  
      $titre=$_POST['titre'];   
      $description=$_POST['description'];  
      $texthistoire = $_POST['text_histoire']; 

     //  $datepub=$_POST['date_pub'];  
      if (isset($_GET['id'])) {  
           $update=mysqli_query($conn,"UPDATE histoire SET type_histoire_id ='$typehistoire',limite_age_id ='$ageid',titre='$titre',description ='$description',text_histoire ='$texthistoire' WHERE id='$id'");  
           if ($update) {  
                header("lire.php");  
                die();  
           }  
      }else{  
           $insert=mysqli_query($conn,"INSERT INTO `histoire`(`type_histoire_id`, `limite_age_id`, `titre`, `description`,  `text_histoire`, `date_pub`) VALUES ('$typehistoire','$ageid','$titre','$description','$texthistoire', NOW())");  
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
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
     <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> -->
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
                <div class="form-group col-md-12">
                    <input type="hidden" value="<?= $idhistoire ?>" class="form-control" id="idhistoire" name="id">
                </div>
            
                <div class="form-group col-md-6">
                    <label for="type_histoire">Type d'histoire</label>
                    <select class="form-control" id="type_histoire" name="type_hist">
                     <option value="<?php echo $typehistoire ;?>">Choisir</option>
                     <?php
                    $sql = "SELECT * FROM type" ;
                    $r2 = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($r2) > 0) {
                      // output data of each row
                      while ($row = mysqli_fetch_assoc($r2)) {
                           ?>
                       <option value="<?php echo $row["id"] ;?>"> <?php echo $row["type_histoire"] ;?> </option>
                    <?php
                        }
                    }
                 ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="limite_age">Limite age</label>
                    <select class="form-control" id="limite_age" name="limite_age">
                    <option value="<?php echo $ageid ;?>">Choisir</option>
                     <?php
                $sql = "SELECT * FROM age" ;
                $r2 = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($r2) > 0) {
                      // output data of each row
                      while ($row = mysqli_fetch_assoc($r2)) {
                           ?>
                           <option value="<?php echo $row["id"] ;?>"> <?php echo $row["limite_age"] ;?> </option>
                           <?php
                    }
                }
              ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="titre">Titre : <?php echo $titre ?> </label>
                <input type="text" value="<?php echo $titre ?>" class="form-control" id="titre" name="titre" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="description">Description: <?php echo $description ?> </label>
                <textarea type="text" class="form-control" value="<?php echo $description ?>"  id="description" name="description" ><?php echo $description ?></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label for="image"> Choisir une Couverture</label>
                <?php echo $image ?>"       
                 </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="summernote">Summernote</label>
                <textarea type="text"  class="form-control"  id="summernote" name="text_histoire" ><?php echo $texthistoire?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="update">update</button>

        </form>
        </main>
     
<?php
include 'footer.php';
?>
<script>
      $('#summernote').summernote({
        placeholder: 'Bonjour, écrivez votre histoire...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['view', ['fullscreen','help']]
        ]
      });
    </script>
<script src="js/fontawesome-all.min.js"></script>
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="summernote/summernote.min.js"></script>
</body>
</html>