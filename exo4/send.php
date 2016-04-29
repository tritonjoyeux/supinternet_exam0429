<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="send.php">Send</a>
<a href="read.php">Read</a>
<br>
Send mail :
<?php
session_start();
if (isset($_SESSION["user"])) {
    if (isset($_POST["deco"])) {
        echo "<META http-equiv=\"refresh\" content=\"0; URL=../exo4.php\">";
        session_destroy();
    }

    if(isset($_POST["send"])){
        if (file_exists($_POST["destinataire"] . "@supmail.fr.txt")) {
            $file = fopen($_POST["destinataire"] . "@supmail.fr.txt", "a");
            fputs($file, "\n".$_SESSION["user"]."\n".$_POST["content"]. "\n----Separa" . md5("separa"));
            fclose($file);
        }else{
            echo "Destinataire introuvable";
        }
    }

    ?>
    <form method="post">
        <input type="text" name="destinataire" placeholder="For"><br>
        <textarea name="content" placeholder="Content"></textarea><br>
        <input type="submit" name="send" value="Send">
    </form>
    <br>

    <form method="post">
        <input type="submit" name="deco" value="Log Out">
    </form>
    <?php
} else {
    echo "<META http-equiv=\"refresh\" content=\"0; URL=../exo4.php\">";
}
?>
</body>
</html>