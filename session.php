<?php

if(isset($_SESSION["id"])){
    $id_session_sauv = $_SESSION["id"];
    //Information Etudiant
    $check = "SELECT * FROM utilisateur WHERE id ='$id_session_sauv'";
    $r = mysqli_query($conn, $check);// execution requet check
    $nombre = mysqli_num_rows($r);// nombre de resultat
    $row = mysqli_fetch_assoc($r);// sauv information des champs de la table dans row
    $id = $row['id'];
    $nom_prenoms = $row['nom_prenoms'];
    $email = $row['email'];
    $mdp = md5($row['mdp']);
    $photo = $row['photo'];
    $date_arrivee = date("Y/m/d H:i:s");

    
    // echo '    Bienvenue '.$nom_prenoms.'<br>';
    // echo date("Y/m/d"). " Il est  " . date("h:i:sa");
    // echo date("Y-m-d h:i:sa");

}else{
    header('Location: connect.php');
}

?>