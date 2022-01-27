<?php

include 'connexion.php';
include 'session.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="icon" href="imgs/mehdy.png">
  
    <link rel="stylesheet" href="mehdy.css">
    <title>Mehdy Stories Book</title>
</head>
<body>
<nav>
    <div class="navbar navbar-expand-md ">
        <a href="ecrire.php" class="navbar-brand">
            <img src="imgs/mehdy.png" alt="Mehdy" width="50" height="40"/> 
        </a>
        <span class="navbar-text d-flex" >Ik'ra  </span> 
        <small class="navbar-text d-flex" >Koun fa Yakoun </small>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-content">
            <span class="navbar-toggler-icon" ></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-content">
            <ul class="navbar-nav nav-pills ml-auto ">
                <!-- <div class="container mt-3">
                 <ul class="nav nav-pills flex-column flex-md-row"> -->
                    <li class="nav-item"><a href="index.php" class="nav-link active"> ACCUEIL</a>
                    <li class="nav-item"><a href="tous.php" class="nav-link"> Voir Mes livres</a>
                    <li class="nav-item dropdown"><a href="biens.php" class="nav-link dropdown-toggle" data-toggle="dropdown"> NOS PROPRIETES</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="">LIVRES</a></li>
                            <li class="dropdown-item"><a href="">BASE DE DONNEES ACCIDENTS</a></li>
                            <li class="dropdown-item"><a href="">MAQUETTE JUMIA</a></li>
                        </ul>
                    <!-- <li class="nav-item"><a href="lire.php" class="nav-link">Lire</a> -->
                    <li class="nav-item"><a href="ecrire.php" class="nav-link">Ecrire</a>
                    <li class="nav-item"><a href="#" class="nav-link disabled"> FAVORIS</a>
                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $photo; ?>" width="30" height="30" class="d-inline-block align-top" alt=""> <?php echo $nom_prenoms ; ?></a>
                         <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="">Mon Profil</a></li>
                            <li class="dropdown-item"><a href="index.php">Voir Mes livres</a></li>
                            <li class="dropdown-item"><a href="logout.php">Déconnexion</a></li>
                        </ul>
              
                </ul>
        </div>
    </div>
</nav>
</body>
</html>