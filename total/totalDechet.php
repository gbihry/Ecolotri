<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/ed629eedcd.js" crossorigin="anonymous"></script>
    <title>Ecolotri - Total Dechet</title>
</head>
<body>
<div class="nav">
        <a href="../menu.html" class="returnarrow"><i class="fa-solid fa-arrow-left"></i><p>Retour</p></a>
        <a href="../index.html" ><img src="../image/ecolotri.png" alt="logo"></a>
    </div>
<?php
include '../entity/Connexion.php';

if(isset($_GET['syndicat'])) {
    $syndicat = $_GET['syndicat'];
    $requete =  Connexion::getInstance()->prepare("SELECT nom, id from syndicat where id = $syndicat");
    $requete->execute();
    $resultat = $requete->fetch();
    $nomSyndicat = $resultat['nom'];
    echo('<h1>Total Dechet de ' . $nomSyndicat .'</h1>');
} else {
    echo('<h1>Total dechet par Syndicat</h1>');
}

?>
    <div class="containerTable">
        <form action="totalDechet.php" method="get">
            <label for="syndicat">Choisir le syndicat:</label>
            <select name="syndicat">
                <?php 
                    try{

                        $requete =  Connexion::getInstance()->prepare("SELECT nom, id
                                    from syndicat");

                        $requete->execute();
                    
                        $curseur = $requete->fetchAll();
                    
                    }catch (PDOException $e) {
                        echo "ça marche pas" . $e->getMessage();
                    }
                    foreach($curseur as $row) {
                        if(isset($_GET['syndicat'])){
                            if($row['id'] == $_GET['syndicat']){
                                echo('<option value="' . $row['id'] . '" selected>' . $row['nom'] . '</option>');
                            } else {
                                echo('<option value="' . $row['id'] . '">' . $row['nom'] . '</option>');
                            }
                        } else {
                            echo('<option value="' . $row['id'] . '">' . $row['nom'] . '</option>');
                        }
                    }
                ?>
            </select>
            <input type="submit" class="submit" value="Valider">
        </form>
    </div>

    <div class="container">
        <?php
                if(isset($_GET['syndicat'])){
                    echo('<div class="row">
                            <div class="cell3">
                                <p>Type Dechet</p>
                            </div>
                            <div class="cell3">
                                <p>Total</p>
                            </div>
                        </div>'
                    );
                    $query = Connexion::getInstance()->prepare(" SELECT typedechet.libelle, 
                    SUM(pesee.poidArrivee - pesee.poidDepart) AS TOTAL 
                    FROM `pesee` 
                    INNER JOIN typedechet ON typedechet.id = pesee.idDechet
                    INNER JOIN syndicat ON syndicat.id = pesee.idSyndicat
                    WHERE syndicat.id = :id 
                    GROUP BY typedechet.libelle");
                    $query->bindParam(':id', $_GET['syndicat']);
                    $query->execute();
                    $result = $query->fetchAll();
                    foreach($result as $row) {
                        echo "<div class='row'>";
                        echo "<div class='cell3'>";
                        echo "<p>".$row['libelle']."</p>";
                        echo "</div>";
                        echo "<div class='cell3'>";
                        echo "<p>".$row['TOTAL']." tonnes</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
    </div>
    <footer>
        <p>Guillaume Bihry </p>
    </footer>
</body>
</html>