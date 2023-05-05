<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();
require_once('./connessione.php');
require_once("./stile.interno.php");

if (!isset($_SESSION['accessoPermesso']))
header('Location: login.php');

if ($_POST['invioPagamento']!="Procedi con il pagamento") {
header('Location: pagina_iniziale.php');
}
if (!empty($_POST['durata'])) {
  $_SESSION['durata']=$_POST['durata'];
}
if (empty($_POST['durata']) && $_SESSION['spesaFinora']!=0) {
  $str="<p style=\"color: red;\">INSERIRE DURATA !!!</p>";
  $str.="<p>Torna alla <a href=\"mysql.paga.php\">PAGINA PRECDENTE </a>!!!</p>";
}
$outputTable="";
// se ci siamo ancora, ora entriamo nel vivo:
// se la spesa corrispondente all''acquisto e'' nulla ...
if (!$_SESSION['spesaFinora']) {
   $outputTable.= " Che ci fai qui con una spesa nulla?\n";
} else { // ok, c''e'' da pagare qualcosa, cioe'' annotarla sul db
         // questa e'' la query di update
         if (isset($_SESSION['durata']) && $_SESSION['accessoDaPaga']==1 && !empty($_POST['durata'])) {
           // preparazione della stringa di output che verra'' inclusa nella pagina di risposta
           $_SESSION['accessoDaPaga']=0;
           $outputTable="<h3>Gentile cliente " . $_SESSION['userName'];
           $tot=$_SESSION['spesaFinora']*$_SESSION['durata'];
           $_SESSION['spesaFinora']=$tot;
           $sql1 = "UPDATE $NOLuser_table_name
                    SET sommeSpese=\"$tot\"
                    WHERE userName = \"{$_SESSION['userName']}\"
           ";
           // eseguiamo la query, e la controlliamo
           if (!mysqli_query($mysqliConnection, $sql1)) {
               printf("Oops, errore nella gestione della query: %s\n",
                       mysqli_error($mysqliConnection));
               exit();
           }
               // chiusura connessione (versione procedurale)
               mysqli_close($mysqliConnection);

               // completamento della stringa di output
          		 $outputTable.=" hai appena speso $tot &euro;</h3>\n";

          		 // il carrello pagato va svuotato
               foreach ($_SESSION['carrello'] as $k=>$v) {
                 $aux='quantita' .$v;
                 unset($_SESSION[$aux]);
               }
               unset($_SESSION['durata']);
          		 $_SESSION['carrello']=array();
           }
}
//
//
//
//
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>zona pagamento</title>
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

<td width="20%" style="vertical-align:top;">
<?php if (isset($str)) {
  echo $str;
}
?>
<h2>Zona pagamenti</h2>

<?php
if (isset($outputTable)) echo $outputTable;
echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
?>
</td>

</tr>
</table>

</body>
</html>
