<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/ed629eedcd.js" crossorigin="anonymous"></script>
    <title>Ecolotri - Liste</title>
</head>
<body>
    <?php 
        include 'entity/Connexion.php';
    ?>
    <div class="nav">
        <a href="index.html" class="returnarrow"><i class="fa-solid fa-arrow-left"></i><p>Retour</p></a>
        <a href="index.html" ><img src="image/ecolotri.png" alt="logo"></a>
    </div>
    <h1>Liste des Pesées</h1>
    <div class="container">
        <div class="row">
            <div class='cell'>
                <p>Identifiant</p>
            </div>
            <div class='cell'>
                <p>Date depot</p>
            </div>
            <div class='cell'>
                <p>Heure</p>
            </div>
        </div>
    
    <?php
        $requete =  Connexion::getInstance()->prepare("SELECT id, dateDepot, heure
        from pesee ORDER BY dateDepot DESC, heure DESC");

        $requete->execute();

        $curseur = $requete->fetchAll();

        foreach($curseur as $r) {
            echo "<div class='row'>";
            echo "<div class='cell'>";
            echo "<p><a href='detail.php?id=".$r['id']."' style='font-weight: bold;'>".$r['id']."</a></p>";
            echo "</div>";
            echo "<div class='cell'>";
            echo "<p>".date('d/m/Y',strtotime($r['dateDepot']))."</p>";
            echo "</div>";
            echo "<div class='cell'>";
            echo "<p>".$r['heure']."</p>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    </div>
    <footer>
        <p>Guillaume Bihry </p>
    </footer>
</body>
</html>