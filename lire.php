<?php
// Start the session
session_start();
// session_start();
ob_start();
include 'connexion.php';
include 'header.php';

$id_utilisateur =  $_SESSION["id"];

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
    <h2>Choisir un livre</h2>
    <!-- <input class="form-control" id="myInput" name="keyup" type="text" style="width:60%; margin-left: 10%" placeholder="Recherche..."> -->
    <br>
   <div id="tri">
   <?php 
    $id= $_GET['id'];
      $sql = "SELECT * FROM histoire WHERE histoire.id = $id" ;
      $rr = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rr);
            $histoire_id = $row['id'];
            $titre = $row['titre'];
            $ageid = $row['limite_age_id'];
            $typehistoire= $row['type_histoire_id'];
            $description = $row['description'];
            $datepub = $row['date_pub'];
            $image = $row['image']; 
            $texthistoire = $row['text_histoire'];
    ?>
   
          <div class="card" style="width: 60% ; margin-left: 11% ;" >
            <img src="<?php echo $image?>" class="card-img-top" alt="..." width="400px" height="424px">
            <div class="card-body">
              <h5 class="card-title"><?php echo $titre ?></h5>
              <div class="scroll-div" width="900px">
                <?php echo $texthistoire ?>
              </div>
            </div>
          </div>
     

        
      <form>
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
            $sql = "SELECT * FROM histoire WHERE histoire.utilisateur_id = $id_utilisateur ORDER BY id DESC" ;

            $rr = mysqli_query($conn, $sql);
            $i = 0;

              while ($row = mysqli_fetch_array($rr)) {  
                $i++;
                $histoire_id = $row['id'];
                $ageid = $row['limite_age_id'];
                $typehistoire= $row['type_histoire_id'];
                $description = $row['description'];
                $datepub = $row['date_pub'];
                $image = $row['image'];
                $titre = $row['titre'];
                $texthistoire2 = $row['text_histoire'];
            ?>
            
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $titre ?></td>
                <td><?php echo $description ?></td>
                <td ><img src="<?php echo $image ?>" class="img-fluid rounded-start" alt="image" width="100"  ></td> 
                <td><?php echo $texthistoire2 ?></td>
                <td>
                <ul>
                  
                  <a href="changtexte.php?id=<?php echo htmlentities($histoire_id);?>" class="btn btn-secondary" > <span class="glyphicon glyphicon-pencil"></span>Modifier le texte </a> 
                  <!-- <a href="coder.php?id=<?php echo htmlentities($histoire_id);?>" class="btn btn-warning" > <span class="glyphicon glyphicon-pencil"></span>Modifier l'histoire </a>  -->
                  <a href="changimage.php?id=<?php echo htmlentities($histoire_id);?>" class="btn btn-info" style="margin: 2% 5% 5% 5%;" > <span class="glyphicon glyphicon-pencil"></span>Changer l'image</a>
                  <form action="" method="post" class="">
                  <a href="delete.php?id=<?php echo htmlentities($histoire_id);?> "onClick = "return confirm('Veux-tu supprimer');" class="btn btn-danger" type="submit" value="delete" > Effacer l'histoire </a>
                  </form>

                </ul>
                </td>

              </tr>
              
            <?php
            }
            ?>
          </tbody>
        </table>
      </form>
    </div> 

    <br>
    <p>Vous avez des difficultés? Envoyez nous un mail en cliquant <a href="mailto:mehdy225@gmail.com">ici</a></p>
   
    <br>
    <p></p>
    <?php 
    if(isset($_POST['delete'])) {

      $query = mysqli_query($conn, "DELETE FROM `histoire` WHERE id ='$histoire_id'" );    

 
    }  ?>

  <script src="tri.js"></script>

</body>
</html>
