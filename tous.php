<?php
// Start the session
session_start();
include 'connexion.php';
include 'session.php';
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <link rel="icon" href="imgs/wha.svg">

    <link rel="stylesheet" href="mehdy.css">
    <title>Mehdy Stories Book</title>
</head>
<body>
    
  <div class="container">
    <h2>Choisir les livres</h2>
    <input class="form-control" id="myInput" name="keyup" type="text" placeholder="Recherche...">
 
    <br>
    <div id="tri">
        <?php

       //pargination
       $check = "SELECT * FROM histoire";
        $result = mysqli_query($conn, $check);
        $nombre = mysqli_num_rows($result);
        // définir combien de résultats vous voulez par page
        $results_per_page = 3;

        //DEBUT DE LA PAGINATION
        // déterminer le nombre total de pages disponibles
        $number_of_pages = ceil($nombre / $results_per_page);


        // déterminer sur quel numéro de page se trouve actuellement le visiteur
        if (!isset($_GET['page'])) {
          $page = 2;
        } else {
          $page = $_GET['page'];
        }

        // déterminer le numéro de départ sql LIMIT pour les résultats sur la page d'affichage
        $this_page_first_result = ($page - 1) * $results_per_page;

          $sql = "SELECT * FROM histoire ORDER BY id DESC LIMIT $this_page_first_result,$results_per_page" ;

          $rr = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($rr)) {
              $histoire_id = $row['id'];
              $ageid = $row['limite_age_id'];
              $typehistoire= $row['type_histoire_id'];
              $description = $row['description'];
              $datepub = $row['date_pub'];
              $image = $row['image'];
        ?>
       
       <div class="card mb-3" style="max-width: 540px;" id="te">
        <div class="row g-0">
          
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['titre'] ?></h5>
              <h6 class="card-subtitle mb-2">Age : <?php
              $sql = "SELECT * FROM age WHERE age.id = $ageid" ;
              $r1 = mysqli_query($conn, $sql);
                if (mysqli_num_rows($r1) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($r1)) {
                        echo $row["limite_age"];
                    }
                }
              ?></h6>
              <h6 class="card-subtitle mb-2">Genre : <?php
                $sql = "SELECT * FROM type WHERE type.id = $typehistoire" ;
                $r2 = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($r2) > 0) {
                      // output data of each row
                      while ($row = mysqli_fetch_assoc($r2)) {
                          echo $row["type_histoire"];
                      }
                  }
              ?></h6>
              <h6 class="card-subtitle mb-2">Description : <?php echo $description ?></h6>
              <a href="lire.php?id=<?php echo $histoire_id ?> " class="btn btn-primary">Lire l'histoire</a>
      
              <p class="card-text"><small class="text-muted">Publié le <?php echo $datepub ?> </small></p>
            </div>
          </div>
          <div class="col-md-4">
            <img src="<?php echo $image?>" class="img-fluid rounded-start" alt="image">
          </div>
        </div>
        
      </div>
       
        <?php
        }
       
        ?>
     </div>
        <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php
        for ($page=1;$page<=$number_of_pages;$page++) {
         ?>
          <li class="page-item">
            <a class="page-link" href="tous.php?page=<?php echo $page; ?>" aria-label="Previous" type="submit" ><?php echo $page;?> </a>
          </li>
         <?php
    }
        ?>
        
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <br>
    <p>Vous avez des difficultés? Envoyez nous un mail en cliquant <a href="mailto:mehdy225@gmail.com">ici</a></p>
   
    <br>
    <p></p>

    </div>
    <?php
  include 'footer.php';
  ?>
  <script src="tri.js"></script>

</body>
</html>
