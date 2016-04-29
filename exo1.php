<?php

class Nim
{
    private $allumettes;
    private $player1;
    private $player2;

    public function __construct($name, $allumettes)
    {
        $this->allumettes = $allumettes;
        $this->player1 = $name;
        $this->player2 = "Bot";
    }

    public function getAllumettes()
    {
        return $this->allumettes;
    }

    public function whoWin()
    {
        return "Ze bot";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nim</title>
    <link rel="stylesheet" href="exo1/style.css">
</head>
<body>
<div class="content">
<?php


$historique = [];
$erreurAllumettes = true;

if (empty($_POST['allumettes'])) {
    $allumettes = 13;
    $historique[0] = "Debut de la partie";
} else {
    $historique = $_POST['historique'];
    if (!empty($_POST['getAll'])) {
        if (count($_POST["getAll"]) > 3) {
            $erreurAllumettes = true;
            $allumettes = $_POST['allumettes'];
        } else {
            $allumettes = $_POST['allumettes'];
            $erreurAllumettes = false;
        }
    } else {
        $erreurAllumettes = true;
        $allumettes = $_POST['allumettes'];
    }
}

if ($erreurAllumettes == false) {
    $allumettes = $allumettes - count($_POST["getAll"]);
    array_push($historique, "Julien tire " . count($_POST["getAll"]) . " allumettes");
    if ($allumettes != 0) {
        if (count($_POST["getAll"]) == 1) {
            $allumettes = $allumettes - 3;
            array_push($historique, "Le bot tire 3 allumettes");
        }
        if (count($_POST["getAll"]) == 2) {
            $allumettes = $allumettes - 2;
            array_push($historique, "Le bot tire 2 allumettes");
        }
        if (count($_POST["getAll"]) == 3) {
            $allumettes = $allumettes - 1;
            array_push($historique, "Le bot tire 1 allumettes");
        }
    }
}


$game = new Nim("Julien", $allumettes);

?>
<h1>Il reste <?php echo $allumettes; ?> allumettes.</h1>
<br>
<form method="post">
    <?php
    for ($i = 0; $i < $game->getAllumettes(); $i++) {
        echo('<input type="checkbox" class="allumettes" name="getAll[]" value="1">');
    }
    ?>
    <input type="hidden" name="allumettes" value="<?php echo $game->getAllumettes(); ?>">
    <?php
    for ($a = 0; $a < count($historique); $a++) {
        ?>
        <input type="hidden" name="historique[]" value="<?php echo $historique[$a] ?>">
        <?php
    }
    ?>

    <br>
    <input type="submit" value="Tirer" name="tirer">
</form>

<?php
if (isset($historique)) {
    echo "<u>Historique</u> :";
    for ($j = 0; $j < count($historique); $j++) {
        echo "<br> - " . $historique[$j];
    }
}
?>
<br>
Gagnant ?
<?php
if ($allumettes == 0) {
    echo $game->whoWin();
}
?>
</div>
</body>
</html>
