<?php
// Start the session
session_start();
// session_start();
// ob_start();
include 'connexion.php';
include 'header.php';

if(isset($GET['delid'])) {

  $id = intval($GET['delid']);
  $query = mysqli_query($conn, "DELETE FROM histoire WHERE id ='$id'" );
  echo"<script>alert('Record effectué');</script>";
  echo"<script>window.location='ecrire.php';</script>";
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="mehdy.css">
    <title>Mehdy Stories Book</title>
    <style> 
  
.scroll-div{
    background: peachpuff;
    width: 100%;
    height: 100%;
    overflow: hidden;
    overflow: scroll;
}

</style>
</head>
<body>
    
    <h2>Choisir les livres</h2>
    <input class="form-control" id="myInput" name="keyup" type="text" placeholder="Recherche...">
 
    <br>
    <div id="tri">
        <?php

        // requete flitre
        $results_per_page = 3;

        $query =  "SELECT *
        FROM Histoire
        INNER JOIN Age ON Histoire.limite_age_id=Age.id
        INNER JOIN Type ON Histoire.type_histoire_id=Type.id
        INNER JOIN Utilisateur ON Histoire.utilisateur_id=Utilisateur.id
        ";
        $r = mysqli_query($conn, $query);

        $number_of_results = mysqli_num_rows($r);
        
$number_of_pages = ceil($number_of_results/$results_per_page);


if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}


$this_page_first_result = ($page-1)*$results_per_page;

$query = "SELECT * FROM Histoire
INNER JOIN Age ON Histoire.limite_age_id=Age.id
INNER JOIN Type ON Histoire.type_histoire_id=Type.id LIMIT " . $this_page_first_result . ',' . $results_per_page;
$r = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($r)) {

        ?>
<div class="card" style="width: 60% " >
  <img src="<?php echo $row['image']?>" class="card-img-top" alt="..." width="400px" height="424px">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['titre'] ?></h5>
    <div class="scroll-div" width="900px">
      <?php echo $row['text_histoire'] ?>
    </div>
  </div>
   
</div>

<table class="table table-bordered table-striped " >
      <thead>
        <tr>
          <th>#</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Image</th>
          <th>Texte histoire</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="myTable">

        <?php

        // requete flitre

        $r = mysqli_query($conn, $query);

        $i = 0;
        while ($row = mysqli_fetch_assoc($r)) {
          $i++;
        ?>
        <form>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['titre'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><img src="<?php echo $row['image']?>" class="img-fluid rounded-start" alt="image"></td> 
            <td><?php echo $row['text_histoire'] ?></td>
            <td>
            <ul>
              <!-- <li> <button type="submit" class="btn btn-warning" name="modifier">Modifier le texte</button> </li>
              <li> <button type="submit" class="btn btn-info" name="changer">Changer l'image</button></li>
              <li><button type="submit" class="btn btn-danger" name="effacer">Effacer l'histoire</button></li> -->
              <a href="lire.php?modifierid=<?php echo htmlentities($row['id']);?>" class="btn btn-warning"> <span class="glyphicon glyphicon-pencil"></span>Modifier le texte</a>
              <a href="edit.php?editid=<?php echo htmlentities($row['id']);?>" class="btn btn-info"> <span class="glyphicon glyphicon-pencil"></span>Changer l'image</a>
              <a href="edit.php?editid=<?php echo htmlentities($row['id']);?>" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Effacer l'histoire</a>

            </ul>
            </td>

          </tr>
          </form>
        <?php
        }
        ?>
      </tbody>
    </table>
        <?php
        }
        for ($page=1;$page<=$number_of_pages;$page++) {
            echo '<a href="lire.php?page=' . $page . '">' . $page . '</a> ';
        }
        ?>
     </div> 

    <br>
    <p>Vous avez des difficultés? Envoyez nous un mail en cliquant <a href="mailto:mehdy225@gmail.com">ici</a></p>
   
    <br>
    <p></p>
    <?php 
       //edition
       if (isset($_POST['modifier'])) {
           //collecte information

           $type_histoire = addslashes ($_POST['type_histoire']);
           $id_user = addslashes ($_POST['utilisateur_id']);
           $limite_age = addslashes ($_POST['limite_age']);
           $titre = addslashes($_POST['titre']);
           $description =addslashes($_POST['description']);
           $text_histoire = addslashes($_POST['text_histoire']);
           $date_pub = date("Y/m/d H:i:s");

    //mise a jour nom, prenom, genre,classe,matricule,photo,date_poste,motdepasse
if ($id_user==""){
    $sql = "UPDATE histoire SET type_histoire='$type_histoire',utilisateur_id='$id_user', limite_age ='$limite_age',titre='$titre',description='$description',image='$image',text_histoire='$text_histoire',date_pub='$date_pub' WHERE id='$id'";
}else{
    $sql = "UPDATE histoire SET type_histoire='$type_histoire',utilisateur_id='$id_user', limite_age ='$limite_age',titre='$titre',description='$description',image='$image',text_histoire='$text_histoire',date_pub='$date_pub' WHERE id='$id'";
}
    
    
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        header('Location: lire.php');
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }
      

       }
       //fin edition


/// delete
if (isset($GET['supprimer'])) {
    $sql = "DELETE FROM histoire WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header('Location: lire.php');
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
    }


 }else{ 
    header('Location: lire.php');
 }


 mysqli_close($conn); //fermer la connexion

 include 'footer.php';

    ?>

 
  <script src="tri.js"></script>

</body>
</html>
