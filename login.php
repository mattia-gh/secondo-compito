<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('./connessione.php');

// una volta che siamo nel db, verichiamo cosa e' stato passato come username
// e pwd e facciamo una quesry per controllare
//
if (isset($_POST['invio']))          // abbiamo appena inviato dati attraverso la form di login
  if (empty($_POST['userName']) || empty($_POST['password'])) {
    $str="DATI MANCANTI!!!";
    if (!empty($_POST['userName'])) {
      $str1=$_POST['userName'];
    }
    if (!empty($_POST['password'])) {
      $str2=$_POST['password'];
    }
  }
  else {
    $sql = "SELECT *
            FROM $NOLuser_table_name
  WHERE userName = \"{$_POST['userName']}\" AND password =\"{$_POST['password']}\"";

    if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
        printf("Oops, la query non ha risultato !!\n");
    exit();
    }

    $row = mysqli_fetch_array($resultQ);

    if ($row) {   // utente esiste valido
      session_start();
      $usr=$_POST['userName'];
      $_SESSION['userName']=$_POST['userName'];
      $_SESSION['dataLogin']=time();
      $_SESSION['numeroUtente']=$row['userId'];
      $_SESSION['spesaFinora']=$row['sommeSpese'];
      if (!isset($_SESSION[$usr])) {
        $_SESSION[$usr]=0;             //numero di accessi
      }
      $_SESSION['accessoDaLogin']=1;
      $_SESSION['accessoPermesso']=1000;
      header('Location: pagina_iniziale.php');    // accesso alla pagina iniziale
      exit();
    }
    else
    $str1=$_POST['userName'];
    $str2=$_POST['password'];
    $str="ACCESSO NEGATO, UTENTE NON REGISTRATO o DATI ERRATI!!!";
  }
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>login sito per noleggio sci/snowboard/scarponi/caschi</title>
</head>

<body>
<h3>Accesso mediante username e password</h3>
<hr />
<p><a href="area_registrazione.php">Registrati</a> prima di accedere!<br />
Se gi&agrave; sei registrato, accedi con username e password!</p>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<h4 style="border: solid; border-color: olive; border-width: 4px; padding: 1ex; width:35%; margin-left: 10%;">
  <p>USERNAME: <input type="text" name="userName" size="30" value="<?php if (isset($str1)) {echo $str1;}  if (isset($_POST['reset'])) {echo "";} ?>" /></p>
  <p>PASSWORD: <input type="text" name="password" size="30" value="<?php if (isset($str2)) {echo $str2;} if (isset($_POST['reset'])) {echo "";} ?>"/></p>

<input type="submit" name="invio" value="Accedi">
<input type="submit" name="reset" value="Reset">
</h4>
</form>
<?php if (isset($str)) echo "<p style=\"color:red;\">" .$str ."</p>" ?>
<hr />
</body>
</html>
