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

<table cellpadding="5" cellspacing="3">
<tr>
<td width="1%" style="vertical-align: top; background-color: #ffffbf;">
  <table style="color: black;">
  <tr><td width="20%"><a href="pagina_iniziale.php" alt="aa">HOME PAGE</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.sci.php" alt="aa">SCI</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.snowboard.php" alt="aa">SNOWBOARD</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.scarponi.php" alt="aa">SCARPONI</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.caschi.php" alt="aa">CASCHI</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.elimina.php" alt="aa">ELIMINA OGGETTI</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.paga.php" alt="aa">PAGA</a><hr /></td></tr>
  <tr><td width="20%"><a href="mysql.logout.php" alt="aa">LOGOUT</a><hr /></td></tr>
  </table>
</td>

<td width="20%">
<table>
<tr>
  <td style="text-align: center;"><h1>NOLEGGIO SCI/SNOWBOARD, SCARPONI E CASCHI</h1></td>
  <td width="1%"><img style="float: right;" src="sci.gif" height = "150" width = "150"
  alt = "sci" /></td>
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
Nel menu a sinistra sono presenti i collegamenti per riempire il carrello, eliminare gli oggetti dal carrello, pagare o eseguire il logout!
</p>
<hr />
<img style="margin-left: auto; margin-right: auto; display: block" src="sci2.gif" height = "360" width = "550"
 alt = "sci2" />
</td>

</tr>
</table>
</body>
</html>
