<?php
// Start the session
session_start();
include 'connexion.php';
?>
<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="mehdy.css">
    <title>Mehdy Stories Book</title>
</head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>
 <form class="modal-content" action="" method="post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container">
      <h1>Se connecter</h1>
      <p>Veuillez remplir ce formulaire pour se connecter.</p>
      <hr>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

    
      <label for="mdp"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="mdp" required>
<!-- 
      <label for="mdp-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="mdp-repeat" required>
       -->
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">Souviens-toi de moi
      </label>

      <p>En se connectant, vous acceptez nos <a href="#" style="color:dodgerblue">Conditions & confidentialité</a>.</p>

      <div class="clearfix">
        <button type="close" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" name="connect">Se connecter</button>
      </div>
    </div>
  </form>
  <?php
  
  //enregistrement
  if (isset($_POST['connect'])) {
      $email = addslashes ($_POST['email']);
      $mdp = addslashes($_POST['mdp']); //Pour crypter:   md5(addslashes($_POST['mdp']));
      $date_arrivee = date("Y/m/d H:i:s");

  

      //check user
      $check = "SELECT * FROM utilisateur WHERE email ='$email' AND mdp ='$mdp'";
      $result = mysqli_query($conn, $check);
      $nombre = mysqli_num_rows($result);
       
   

     
    if ($nombre == 1) {
        //aller à la page 
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
       //Création de la session
      $_SESSION["id"] = $id;
      $_SESSION['nom_prenoms'] = $row['nom_prenoms'];
      $_SESSION['email'] = $row['email'];
     //  $_SESSION['mdp'] = $row['mdp'];
      $_SESSION['photo'] = $row['photo'];
      $_SESSION['date_arrivee'] = $row['date_arrivee'];
      echo "correct";
        header('Location: ecrire.php');
    } else {
        //afficher message d'erreure
        echo "mot de passe eronné";
      }
    }
  
  
    //fin login
    mysqli_close($conn);
    ?>
</body>
</html>
