<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
session_start();

if(!isset($_SESSION["user"])) {
    ?>
    Sign In :
    <br>
    <?php
    $connec = "";

    chdir('./exo4/');

    if (isset($_POST['signIn'])) {
        if (file_exists($_POST["pseudo"] . "@supmail.fr.txt")) {

        } else {
            $file = fopen($_POST["pseudo"] . "@supmail.fr.txt", "a+");
            fputs($file, password_hash($_POST["password"], PASSWORD_DEFAULT) . "\n----Separa" . md5("separa"));
            fclose($file);
        }
    }

    if (isset($_POST['logIn'])) {

        if (file_exists($_POST["pseudo"] . "@supmail.fr.txt")) {
            $file = fopen($_POST["pseudo"] . "@supmail.fr.txt", "r+");
            $password = 0;
            while (($line = fgets($file, 4096)) !== false) {
                if ($password == 0) {
                    $hash = substr($line, "0", "-1");
                    if (password_verify($_POST["password"], $hash)) {
                        $connec = "Succes";
                        $_SESSION["user"] =$_POST["pseudo"];
                        echo "<META http-equiv=\"refresh\" content=\"0; URL=exo4/read.php\">"; //commentcamarche.fr
                    } else {
                        $connec = "Echec";
                    }

                }
                $password++;
            }
            fclose($file);
        } else {
            $connec = "Echec";
        }
    }
    ?>
    <form method="post">
        <input type="text" name="pseudo" placeholder="Pseudo"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" value="Insrtiption" name="signIn">
    </form>
    <br><br><br>
    Log In : <?php echo $connec; ?>
    <form method="post">
        <input type="text" name="pseudo" placeholder="Pseudo"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" value="Connexion" name="logIn">
    </form>
    <?php
}
?>
</body>
</html>
