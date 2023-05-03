<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('./connessione.php');
require_once('./stile.interno.php');
//
//
if (isset($_POST['invio'])) {
  if (empty($_POST['userName']) || empty($_POST['password']) || empty($_POST['nome']) || empty($_POST['cognome']) || empty($_POST['email']) || empty($_POST['nTel'])) {
    $str="DATI MANCANTI!!!";
    if (!empty($_POST['userName'])) {
      $str1=$_POST['userName'];
    }
    if (!empty($_POST['password'])) {
      $str2=$_POST['password'];
    }
    if (!empty($_POST['nome'])) {
      $str3=$_POST['nome'];
    }
    if (!empty($_POST['cognome'])) {
      $str4=$_POST['cognome'];
    }
    if (!empty($_POST['email'])) {
      $str5=$_POST['email'];
    }
    if (!empty($_POST['nTel'])) {
      $str6=$_POST['nTel'];
    }
  }
  else {
    $sql = "SELECT *
            FROM $NOLuser_table_name
            WHERE userName = \"{$_POST['userName']}\"";

    $resultQ = mysqli_query($mysqliConnection, $sql);
    $row = mysqli_fetch_array($resultQ);

    if (!$row) {
      $sql = "INSERT INTO $NOLuser_table_name
      	(userName, password, nome, cognome, email, numeroTel, sommeSpese)
      	VALUES
      	('".$_POST["userName"]."', '".$_POST["password"]."', '".$_POST["nome"]."', '".$_POST["cognome"]."', '".$_POST["email"]."', '".$_POST["nTel"]."', \"0\")
      	";
        if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
          printf("Whoops! Couldn't populate user.\n");
          exit();
        }
        $strstr="REGISTRAZIONE EFFETTUATA";
    }
    else {
      $str="USERNAME GIA' UTILIZZATO !!!";
      if (!empty($_POST['userName'])) {
        $str1=$_POST['userName'];
      }
      if (!empty($_POST['password'])) {
        $str2=$_POST['password'];
      }
      if (!empty($_POST['nome'])) {
        $str3=$_POST['nome'];
      }
      if (!empty($_POST['cognome'])) {
        $str4=$_POST['cognome'];
      }
      if (!empty($_POST['email'])) {
        $str5=$_POST['email'];
      }
      if (!empty($_POST['nTel'])) {
        $str6=$_POST['nTel'];
      }
    }
  }
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>registrazione sito per noleggio sci/snowboard/scarponi/caschi</title>
  <?php echo $stileInterno; ?>
</head>

<body>
<h3>AREA REGISTRAZIONE</h3>
<hr />
<p>Compilare tutti i campi!</p>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<h4 style="border: solid; border-color: olive; border-width: 4px; padding: 1ex; width:35%; margin-left: 10%;">
  <p>USERNAME: <input type="text" name="userName" size="30" value="<?php if (isset($str1)) {echo $str1;}  if (isset($_POST['reset'])) {echo "";} ?>" /></p>
  <p>PASSWORD: <input type="text" name="password" size="30" value="<?php if (isset($str2)) {echo $str2;} if (isset($_POST['reset'])) {echo "";} ?>"/></p>
  <p>NOME: <input type="text" name="nome" size="30" value="<?php if (isset($str3)) {echo $str3;}  if (isset($_POST['reset'])) {echo "";} ?>" /></p>
  <p>COGNOME: <input type="text" name="cognome" size="30" value="<?php if (isset($str4)) {echo $str4;} if (isset($_POST['reset'])) {echo "";} ?>"/></p>
  <p>EMAIL: <input type="text" name="email" size="30" value="<?php if (isset($str5)) {echo $str5;}  if (isset($_POST['reset'])) {echo "";} ?>" /></p>
  <p>N.TELEFONO: <input type="text" name="nTel" size="30" value="<?php if (isset($str6)) {echo $str6;} if (isset($_POST['reset'])) {echo "";} ?>"/></p>

<input type="submit" name="invio" value="Registrati">
<input type="submit" name="reset" value="Reset">
</h4>
</form>
<?php if (isset($str)) echo "<p style=\"color:red;\">" .$str ."</p>" ?>
<?php if (isset($strstr)) echo "<p style=\"color:blue;\">" .$strstr ."</p>\n" ."Torna alla pagina di <a href=\"login.php\"> login</a>" ?>
<hr />
</body>
</html>
