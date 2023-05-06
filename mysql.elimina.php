<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();
require_once('./connessione.php');
require_once("./stile.interno.php");

if (!isset($_SESSION['accessoPermesso']))
   header('Location: login.php');

?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>eliminazione elementi</title>
  <?php echo $stileInterno; ?>
</head>

<body>
<table cellpadding="5" cellspacing="3">
<tr>

<td width="1%" style="vertical-align: top; background-color: #ffffbf;">
    <table style="color: black; ">
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

<td style="vertical-align: top;" width="20%">
<h2>Remove Things</h2>

<?php
if (empty($_SESSION['carrello'])) {
   echo "<p> - carrello vuoto - </p>";
} else {
   if ( !isset($_POST['eliminandi'])) {
      echo "<p>Seleziona quel che vuoi eliminare dal carrello:</p>";
   }
   else { // bisogna eliminare le cose selezionate in eliminandi[]
     foreach ($_POST['eliminandi'] as $k=>$nomeDaEliminare) {
       $aux='quantita' .$nomeDaEliminare;
       unset($_SESSION[$aux]);
       $key=array_search($nomeDaEliminare, $_SESSION['carrello']);
       if (isset($key)) {
         unset($_SESSION['carrello'][$key]);
       }
     }
   }
 }
?>

<form action="<?php $_SERVER['PHP_SELF']?>"  method="post" >
  <table>
    <tr>
     <td width="35%">
       <p style="margin-bottom: 15%">
	    <input type="reset" name="annulla" value="Annulla le selezioni"/>
	   </p>
       <p style="margin-top: 15%">
        <input type="submit" name="Cancella i selezionati" value="Cancella i selezionati"/>
       </p>
     </td>

     <td>
	 <?php
   if(!empty($_SESSION['carrello'])) {
	      foreach ($_SESSION['carrello'] as $k=>$v) {
            $aux='quantita' .$v;
            if (isset($_SESSION[$aux])) {
              echo "<input type=\"checkbox\" name=\"eliminandi[]\" value=\"$v\" > $v x" .$_SESSION[$aux] ."<br />";
            }
          }
    }
    ?>
     </td>
    </tr>
  </table>
</form>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</td>

</tr>
</table>

</body>
</html>




















	 <?php
	 /* forse, se sei qui hai visto che chiamando l'eliminazione su un carrello non creato si ottiene un warning ... prova a correggere. La soluzione e' in fondo.
	 if (!isset($_SESSION['carrello'])) {
	    echo "\n<div style=\"background: lime; margin-left:40%; text-align: center;\">";
	    echo "\nNessun carrello!";
	    echo "\n</div>\n\n";
      } else
	      foreach ($_SESSION['carrello'] as $k=>$v)
            echo "<input type=\"checkbox\" name=\"eliminandi[]\" value=\"$k\" > $v<br />";
     */
	 ?>
