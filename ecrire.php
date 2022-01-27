<?php
// Start the session
session_start();
include 'connexion.php';
include 'header.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link rel="icon" href="imgs/1641483390.jpg">

    <link rel="stylesheet" href="mehdy.css">
    <title>Mehdy Stories Book</title>
</head>
<body>

<main class="container-fluid mb-4">
<div class="container">
 <h1>Ecrire une histoire ce <?php echo date('d/m/Y h:i:s'); ?></h1>
        <form action="" method="post"  enctype="multipart/form-data">
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="type_histoire">Type d'histoire</label>
                    <select class="form-control" id="type_histoire" name="type_histoire_id">
                        <?php
                        $queryt = "SELECT * FROM type ";

                        $rt = mysqli_query($conn, $queryt);
                        if (mysqli_num_rows($rt) > 0) {
                            while ($rowt = mysqli_fetch_array($rt)) {

                        ?>
                                <option value="<?php echo $rowt['id'] ?>"><?php echo $rowt['type_histoire'] ?></option>

                        <?php }}  ?>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="limite_age">Limite age</label>
                    <select class="form-control" id="limite_age" name="limite_age_id">
                    <?php
                        $querya = "SELECT * FROM age ";

                        $ra = mysqli_query($conn, $querya);
                        if (mysqli_num_rows($ra) > 0) {
                            while ($rowa = mysqli_fetch_array($ra)) {

                        ?>
                                <option value="<?php echo $rowa['id'] ?>"><?php echo $rowa['limite_age'] ?></option>

                        <?php }}  ?>

                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="entrer votre titre">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="entrer votre description"></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label for="image"> Choisir une Couverture</label>
                <input type="file" class="form-control" id="image" placeholder="ajouter une image" name="image">
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="summernote">Summernote</label>
                <textarea type="text" class="form-control" id="summernote" name="text_histoire" placeholder="entrer votre texte d'histoire"></textarea>
                </div>
            </div>

           
            <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>

        </form>
        <?php
  
    //enregistrement
    if (isset($_POST['enregistrer'])) {
        $type_histoire = addslashes ($_POST['type_histoire_id']);
        $limite_age = addslashes ($_POST['limite_age_id']);
        $titre = addslashes($_POST['titre']);
        $description =addslashes($_POST['description']);
        $text_histoire = addslashes($_POST['text_histoire']);
        $date_pub = date("Y/m/d H:i:s");
        
 
    
//DEBUT COMM
        // //check user
        // $query = "SELECT * FROM Histoire
        // INNER JOIN Age ON Histoire.limite_age_id=Age.id
        // INNER JOIN Type ON Histoire.type_histoire_id=Type.id
        // INNER JOIN Utilisateur ON Histoire.utilisateur_id=Utilisateur.id WHERE titre ='$titre'";
        // $r = mysqli_query($conn, $query);
        // // $nombre = mysqli_num_rows($r);
        // //a = 2
        // //si a = 0 display 5 sinon display 4
        // echo $titre . ' - ';    

//FIN COMM

//ajout d'image
$target_dir = "imgs/";//dossier de reception
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
  $query = getimagesize($_FILES["image"]["tmp_name"]);
  if($query !== false) {
    echo "File is an image - " . $query["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
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

        // if ($nombre == 0) {
            //insertion
            $query = "INSERT INTO histoire (type_histoire_id, utilisateur_id, limite_age_id, titre, description, image, text_histoire, date_pub)
VALUES ('$type_histoire', '$id_session_sauv', '$limite_age', '$titre', '$description', '$image','$text_histoire','$date_pub')";

 


            if (mysqli_query($conn, $query)) {
                echo "Nouvelle information sauvegardée avec succès";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        // } else {
        //     echo 'Cette info existe';
        // }
    }
    // //fin enregistrement

    // $query =  "SELECT *
    //     FROM Histoire
    //     INNER JOIN Age ON Histoire.limite_age_id=Age.id
    //     INNER JOIN Type ON Histoire.type_histoire_id=Type.id
    //     INNER JOIN Utilisateur ON Histoire.utilisateur_id=Utilisateur.id
    //     ";
    //     $r = mysqli_query($conn, $query);


       //fin login
       mysqli_close($conn);
       ?>
    </div>
    
</main>
<a href="https://spectrocoin.com/fr/integration/buttons/50131-LD8E23k0ru.html" style="display:inline-block;padding: 12px 15px; font-weight: 800; font-size: 18px; text-transform: uppercase; text-align: center; background-color: rgb(239, 239, 239); border: 0px none rgb(51, 51, 51);border: 1px solid rgb(189, 189, 189); margin-left: 70%; ">
<span>Faire un don</span>
<span style="display: inline-block;vertical-align: middle; margin-left: 10px;margin-top: -4px;width: 24px;height: 25px;background-image: url(
	
			https://spectrocoin.com/assets/images/btc.png
		
);background-size: contain;background-repeat: no-repeat;background-position: 50%;"></span>
</a>
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