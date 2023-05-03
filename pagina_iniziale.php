<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("./stile.interno.php");
require_once("./connessione.php");

	/*questo e' il controllo di accesso: se non e' stata prima effettuata
	l'autenticazione, la variabile SESSION accessoPermesso non esiste ... */
if (!isset($_SESSION['accessoPermesso'])) {
  header('Location: login.php');
}
else {
  $str=$_SESSION['userName'];
  if ($_SESSION['accessoDaLogin']==1) {
    $_SESSION[$str]+=1;
    $_SESSION['accessoDaLogin']=0;
  }
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>pagina iniziale del sito per noleggio sci/snowboard/scarponi/caschi</title>
<?php echo $stileInterno; ?>
</head>

<body>
<table>
<tr>
  <td><h1>NOLEGGIO SCI/SNOWBOARD, SCARPONI E CASCHI</h1></td>
 <td width="1%"><img style="float: right;" src="sci.gif" height = "150" width = "150"
  alt = "sci" /></td>
</tr>
</table>


<table style="color: black; background: lime;" border="1">
<tr>
 <td width="20%"><a href="pagina_iniziale.php" alt="aa">HOME PAGE</a></td>
 <td width="20%"><a href="mysql.sci.php" alt="aa">SCI</a></td>
 <td width="20%"><a href="mysql.snowboard.php" alt="aa">SNOWBOARD</a></td>
 <td width="20%"><a href="mysql.scarponi.php" alt="aa">SCARPONI</a></td>
 <td width="20%"><a href="mysql.caschi.php" alt="aa">CASCHI</a></td>
 <td width="20%"><a href="mysql.elimina.php" alt="aa">ELIMINA OGGETTI</a></td>
 <td width="20%"><a href="mysql.paga.php" alt="aa">PAGA</a></td>
 <td width="20%"><a href="mysql.logout.php" alt="aa">LOGOUT</a></td>
</tr>
</table>

<hr />


<h3>
Benvenuto <?php echo $_SESSION['userName'];?> !!!
</h3>
<p>
<?php echo "Ti sei collegato alle " .date('g:i a', $_SESSION['dataLogin']) .", per la " .$_SESSION[$str] ."<sup>a</sup> volta";?>
</p>
<p style="font-family: Garamond;">
Questo &egrave; un sito per noleggiare SCI/SNOWBOARD, SCARPONI E CASCHI.<br />
Nella sezione in verde nella parte superiore sono presenti i collegamenti per riempire il carrello, eliminare gli oggetti dal carrello, pagare o eseguire il logout!
</p>
<hr />
<img style="margin-left: auto; margin-right: auto; display: block" src="sci2.gif" height = "335" width = "500"
 alt = "sci2" />

</body>
</html>
