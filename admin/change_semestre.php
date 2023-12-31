<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
</head>
<body>
<?php
    include_once "../connexion.php";
    $semestre = "SELECT * FROM semestre ";
    $semestre_qry = mysqli_query($conn, $semestre);
    
?>
<?php
            function test_input($data){
                $data = htmlspecialchars($data);
                $data = trim($data);
                $data = htmlentities($data);
                $data = stripcslashes($data);

                return $data;
            }
       if(isset($_POST['submit'])){
        $semestre1 = test_input($_POST['semestre1']);
        $semestre2 = test_input($_POST['semestre2']);
   if( !empty($semestre1) && !empty($semestre2) ){
        $req = "UPDATE etudiant set id_semestre = '$semestre2' where id_semestre = '$semestre1' ";
                        
        $req = mysqli_query($conn , $req);
        if($req){
            header("location: etudiant.php");
        }else {
            $message = "Semestre  non changer";
        }

   }else {
       $message = "Veuillez remplir tous les champs !";
   }
}
include "../nav_bar.php";

?>
</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des utisateurs</li>
                    <li>Changement de semestre</li>
            </ol>
        </div>
    </div>
   
    <div class="form-horizontal">
    <br /><br />

    <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <form action="" method="POST">
        <div class="form-group">
            <label class="col-md-1" >Semester</label>
            <div class="col-md-6" >
            <select class = "form-control" id="academic" value="Semestres" name="semestre1">
                    <option selected disabled> Semesters </option>
                            <?php while ($row = mysqli_fetch_assoc($semestre_qry)) : ?>
                        <option value="<?= $row['id_semestre']; ?>"> <?= $row['nom_semestre']; ?> </option>
                    <?php endwhile; ?> 
                </select>            
               </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Nouveau Semester</label>
            <div class="col-md-6" >
            <?php
                    // Exécuter à nouveau la requête pour récupérer les résultats
                    $semestre_qry = mysqli_query($conn, $semestre);
            ?>
            <select class = "form-control" id="academic" value="Semestres" name="semestre2">
                    <option selected disabled> Semesters </option>
                            <?php while ($row = mysqli_fetch_assoc($semestre_qry)) : ?>
                        <option value="<?= $row['id_semestre']; ?>"> <?= $row['nom_semestre']; ?> </option>
                    <?php endwhile; ?> 
                </select>            
               </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="submit" value=Enregistrer class="btn-primary"  />
            </div>
        </div>

        </form>

</div>
</div>


</body>
</html>