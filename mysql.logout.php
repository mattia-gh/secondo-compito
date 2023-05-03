<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('./connessione.php');
require_once("./stile.interno.php");


unset($_SESSION['dataLogin']);
unset($_SESSION['numeroUtente']);
unset($_SESSION['spesaFinora']);
unset($_SESSION['accessoDaLogin']);
unset($_SESSION['accessoPermesso']);

if (isset($_SESSION['carrello'])) {
  foreach($_SESSION['carrello'] as $k=>$v) {
    $aux='quantita' .$v;
    unset($_SESSION[$aux]);
  }
  unset($_SESSION['carrello']);
}

if (isset($_SESSION['accessoDaPaga'])) {
  unset($_SESSION['accessoDaPaga']);
}

if (isset($_SESSION['durata'])) {
  unset($_SESSION['durata']);
}

?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>logout</title>
<?php echo $stileInterno; ?>
</head>

<body>
<h3>
<hr />
Grazie della visita, ciao ciao
<hr />
<li>Torna alla pagina di <a href="login.php" alt="aa">login</a></li>
<hr />

</body>
</html>
