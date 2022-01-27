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
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="nom_prenoms"><b>Nom & Prenoms</b></label>
      <input type="text" placeholder="Enter nom_prenoms" name="nom_prenoms" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="photo"><b>Photo</b></label>
      <input type="file" placeholder="Enter photo" name="photo" required>
       <hr>

      <label for="mdp"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="mdp" required>
<!-- 
      <label for="mdp-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="mdp-repeat" required>
       -->
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="delete" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" name="inscrire">S'inscrire</button>
      </div>
    </div>
  </form>
  <?php
  
  //enregistrement
  if (isset($_POST['inscrire'])) {
      $nom_prenoms = addslashes ($_POST['nom_prenoms']);
      $email = addslashes ($_POST['email']);
      $photo = addslashes($_POST['photo']);
      $mdp = addslashes($_POST['mdp']); //pour crypter:   md5(addslashes($_POST['password']));
      $date_arrivee = date("Y/m/d H:i:s");

  

     

//ajout d'photo
$target_dir = "imgs/";//dossier de reception
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["photo"]["tmp_name"]);
if($check !== false) {
  echo "File is an photo - " . $check["mime"] . ".";
  $uploadOk = 1;
} else {
  echo "File is not an photo.";
  $uploadOk = 0;
}
//renomer la photo
$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$photo = $target_dir. $newfilename;
//}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  //delacer la photo vers le dossier
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], "".$photo)) {
        echo "The file ". htmlspecialchars(basename($_FILES["photo"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
 //check user
 $check = "SELECT * FROM utilisateur WHERE email ='$email'";
 $result = mysqli_query($conn, $check);
 $nombre = mysqli_num_rows($result);
 //a = 2
 //si a = 0 display 5 sinon display 4
 echo $email . ' - ';

      if ($nombre == 0) {
          //insertion
          $sql = "INSERT INTO utilisateur (nom_prenoms, email, photo, mdp, date_arrivee)
                  VALUES ('$nom_prenoms', '$email', '$photo', '$mdp', '$date_arrivee')";
            $resultat2=  mysqli_query($conn, $sql);

          if ($resultat2) {
              echo "Nouvelle information sauvegardée avec succès";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
      } else {
          echo 'Cet email existe';
      }
  }
  //fin enregistrement
     //fin login
     ?>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
