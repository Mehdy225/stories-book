<?php
// Start the session
session_start();
  include 'header.php';
  if (isset($_GET['id'])){

    $id_utilisateur =  $_SESSION["id"];
    $idhistoire = $_GET['id'];

    
    $id_user = addslashes ($_POST['utilisateur_id']);
    $type_histoire = addslashes ($_POST['type_histoire']);
    $limite_age = addslashes ($_POST['limite_age']);
    $titre = addslashes($_POST['titre']);
    $description =addslashes($_POST['description']);
    $image =addslashes($_POST['image']);
    $text_histoire = addslashes($_POST['text_histoire']);
    $date_pub = date("Y/m/d H:i:s");
    $req = "UPDATE histoire SET type_histoire_id= '$type_histoire' ,limite_age_id='$limite_age',titre='$titre',description=' $description',image='$image',text_histoire='$text_histoire',date_pub='$date_pub ' WHERE histoire.id = $idhistoire";

    $sql = mysqli_query($conn, $req);

    if($sql){
      echo "Effectué";
      echo "<script>document.location='lire.php';</script>";
    }else{
      echo "<script>alert('Grosse Erreur');</script>";
    }

  }
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
        <form action="modifier.php" method="post"  enctype="multipart/form-data">
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="hidden" value="<?= $idhistoire ?>" class="form-control" id="idhistoire" name="idhistoire">
                </div>
            
                <div class="form-group col-md-6">
                    <label for="type_histoire">Type d'histoire</label>
                    <select class="form-control" id="type_histoire" name="type_histoire">
                     <option value="<?php  ?>"><?php  ?></option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="limite_age">Limite age</label>
                    <select class="form-control" id="limite_age" name="limite_age">
                      <option value="<?php  ?>"><?php  ?></option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="titre">Titre</label>
                <input type="text" value="<?php ?>" class="form-control" id="titre" name="titre" placeholder="entrer votre titre">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" value="<?php ?>"  id="description" name="description" ><?php ?></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label for="image"> Choisir une Couverture</label>
                <input type="file"  class="form-control" id="image" placeholder="ajouter une image" name="image">
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="summernote">Summernote</label>
                <textarea type="text" value="<?php  ?>"  class="form-control" id="summernote" name="text_histoire" placeholder="entrer votre texte d'histoire"><?php  ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="update">update</button>

        </form>
    </div>
</main>
<a href="https://spectrocoin.com/fr/integration/buttons/50131-LD8E23k0ru.html" style="display:inline-block;padding: 12px 15px; font-weight: 800; font-size: 18px; text-transform: uppercase; text-align: center; background-color: rgb(239, 239, 239); border: 0px none rgb(51, 51, 51);border: 1px solid rgb(189, 189, 189);margin-left: 70%;">
<span>Faire un don</span>
<span style="display: inline-block;vertical-align: middle;margin-left: 10px;margin-top: -4px;width: 24px;height: 25px;background-image: url(
	
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
//fin login
     <?php  mysqli_close($conn); ?>
</body>
</html>