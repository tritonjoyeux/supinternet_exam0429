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
Read mail :
<br><br>
<?php
session_start();
if (isset($_SESSION["user"])) {
    if (isset($_POST["deco"])) {
        echo "<META http-equiv=\"refresh\" content=\"0; URL=../exo4.php\">";
        session_destroy();
    }

    if (isset($_POST["purge"])) {

        if (file_exists($_SESSION["user"] . "@supmail.fr.txt")) {
            $file = fopen($_SESSION["user"] . "@supmail.fr.txt", "r+");
            $password = 0;
            $content = "";

            while (($line = fgets($file, 4096)) !== false) {
                if ($password == 0 || $password == 1) {
                    $content .= $line;
                }
                $password++;
            }
            fclose($file);

            $file = fopen($_SESSION["user"] . "@supmail.fr.txt", "a");
            ftruncate($file,0); //php.net
            fputs($file,$content);
            fclose($file);


        }
    }

    if (file_exists($_SESSION["user"] . "@supmail.fr.txt")) {
        $file = fopen($_SESSION["user"] . "@supmail.fr.txt", "r+");
        $lineStart = 0;
        $champ = "destinataire";
        while (($line = fgets($file, 4096)) !== false) {
            if ($lineStart == 0 || $lineStart == 1 || substr($line, "0", "-1") == '----Separa864c890975843f6d75e63a5ca5a314e9' || $line == '----Separa864c890975843f6d75e63a5ca5a314e9') {
            } else {
                if ($champ == "destinataire") {
                    echo "From : " . $line . "<br>";
                    $champ = "content";
                } else {
                    echo "Content : " . $line . "<br><br>";
                    $champ = "destinataire";
                }
            }
            $lineStart++;
        }
        fclose($file);
    }

    ?>
    <form method="post">
        <input type="submit" name="purge" value="Clean">
    </form>
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