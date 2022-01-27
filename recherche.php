<?php
// Start the session
session_start();
include 'connexion.php';
include 'session.php';
include 'header.php';

$id_utilisateur =  $_SESSION["id"];

if(isset($_GET['search']))
{
$key=$_GET["search"];  //key=pattern to be searched

$result=mysqli_query($conn,"select * from histoire where `id` like '%$histoire_id%'"); 
$histoire_id = $row['id'];

while($row=mysqli_fetch_assoc($result))
{
// Print your search variables 
}
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
