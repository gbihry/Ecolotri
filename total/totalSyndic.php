<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/ed629eedcd.js" crossorigin="anonymous"></script>
    <title>Ecolotri - Total Syndicat</title>
</head>
<body>
<div class="nav">
        <a href="../menu.html" class="returnarrow"><i class="fa-solid fa-arrow-left"></i><p>Retour</p></a>
        <a href="../index.html" ><img src="../image/ecolotri.png" alt="logo"></a>
    </div>
<?php
include '../entity/Connexion.php';

if(isset($_GET['dechet'])) {
    $dechet = $_GET['dechet'];
    $requete =  Connexion::getInstance()->prepare("SELECT * from typedechet where id = :dechet");
    $requete->bindParam(':dechet', $dechet);
    $requete->execute();
    $resultat = $requete->fetch();
    $libelle = $resultat['libelle'];
    echo('<h1>Total pour le ' . $libelle .'</h1>');
} else {
    echo('<h1>Total par Type de Dechet</h1>');
}

?>
    <div class="containerTable">
        <form action="totalSyndic.php" method="get">
            <select name="dechet">
                <?php 
                    try{

                        $requete =  Connexion::getInstance()->prepare("SELECT *
                                    from typedechet");

                        $requete->execute();
                    
                        $curseur = $requete->fetchAll();
                    
                    }catch (PDOException $e) {
                        echo "ça marche pas" . $e->getMessage();
                    }
                    foreach($curseur as $row) {
                        if(isset($_GET['dechet'])) {
                            if($row['id'] == $_GET['dechet']) {
                                echo('<option value="' . $row['id'] . '" selected>' . $row['libelle'] . '</option>');
                            } else {
                                echo('<option value="' . $row['id'] . '">' . $row['libelle'] . '</option>');
                            }
                        } else {
                            echo "<option value='" . $row['id'] ."'>".$row['libelle']."</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" class="submit" value="Valider">
        </form>
    </div>

    <div class="container">
        
        <?php
                
                if(isset($_GET['dechet'])) {
                    echo('<div class="row">
                    <div class="cell3">
                        <p>Syndicat</p>
                    </div>
                    <div class="cell3">
                        <p>Total</p>
                    </div>
                </div>');
                    $query = Connexion::getInstance()->prepare("SELECT syndicat.nom, SUM(pesee.poidArrivee - pesee.poidDepart) AS TOTAL 
                    FROM pesee 
                    INNER JOIN typedechet ON typedechet.id = pesee.idDechet
                    INNER JOIN syndicat ON syndicat.id= pesee.idSyndicat
                    WHERE typedechet.id = :id 
                    GROUP BY syndicat.nom 
                    ORDER BY TOTAL DESC");
                    $query->bindParam(':id', $_GET['dechet']);
                    $query->execute();
                    $result = $query->fetchAll();
                    foreach($result as $row) {
                        if($row['TOTAL'] != 0) {
                            echo "<div class='row'>";
                            echo "<div class='cell3'>";
                            echo "<p>".$row['nom']."</p>";
                            echo "</div>";
                            echo "<div class='cell3'>";
                            echo "<p>".$row['TOTAL']." tonnes</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
            ?>
    </div>
    <footer>
        <p>Guillaume Bihry </p>
    </footer>
</body>
</html>