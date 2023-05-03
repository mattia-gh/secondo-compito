<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>creazione e popolamento STdb</title></head>

<body>
<h3>creazione e popolazione NOLEGGIOdb</h3>

<?php
error_reporting(E_ALL &~E_NOTICE);

$db_name = "NOLdb";

///////////////////////////////////////////////////////////////////////////////
// effettuazione della connessione al database
$mysqliConnection = new mysqli("localhost", "archer", "archer");

// controllo della connessione
if (mysqli_connect_errno()) {
    printf("Oops, abbiamo problemi con la connessione al db: %s\n", mysqli_connect_error());
//    exit();
}
// creazione del database
//
$queryCreazioneDatabase = "CREATE DATABASE $db_name";
// il risultato della query va in $resultQ
if ($resultQ = mysqli_query($mysqliConnection, $queryCreazioneDatabase)) {
    printf("Database creato ...\n");
}
else {
    printf("Whoops! niente creazione del db! Che sara successo??.\n");
//  exit();
}

// ok, adesso chiudiamo la connessione
$mysqliConnection->close();
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// e la riapriamo con il collegamento alla base di dati
require_once('./connessione.php');

$sqlQuery = "CREATE TABLE if not exists $NOLuser_table_name (";
$sqlQuery.= "userId int NOT NULL auto_increment, primary key (userId), ";
$sqlQuery.= "userName varchar (50) NOT NULL, ";
$sqlQuery.= "password varchar (50) NOT NULL, ";
$sqlQuery.= "nome varchar (50) NOT NULL, ";
$sqlQuery.= "cognome varchar (50) NOT NULL, ";
$sqlQuery.= "email varchar (50) NOT NULL, ";
$sqlQuery.= "numeroTel varchar (50) NOT NULL, ";
$sqlQuery.= "sommeSpese float";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella utenti creata ...\n");
else {
    printf("Whoops! niente creazione Tabella utenti! Che sara' successo??.\n");
  exit();
}

$sqlQuery = "CREATE TABLE if not exists $NOLsci_table_name (";
$sqlQuery.= "sciId int NOT NULL auto_increment, primary key (sciId), ";
$sqlQuery.= "tipoSci varchar (100) NOT NULL, ";
$sqlQuery.= "descr varchar (100) NOT NULL, ";
$sqlQuery.= "costoSci float";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella sci creata ...\n");
else {
    printf("Whoops! niente creazione Tabella sci! Che sara' successo??.\n");
  exit();
}

$sqlQuery = "CREATE TABLE if not exists $NOLsnowboard_table_name (";
$sqlQuery.= "snowboardId int NOT NULL auto_increment, primary key (snowboardId), ";
$sqlQuery.= "tipoSnowboard varchar (100) NOT NULL, ";
$sqlQuery.= "descr varchar (100) NOT NULL, ";
$sqlQuery.= "costoSnowboard float";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella snowboard creata ...\n");
else {
    printf("Whoops! niente creazione Tabella snowboard! Che sara' successo??.\n");
  exit();
}

$sqlQuery = "CREATE TABLE if not exists $NOLscarponi_table_name (";
$sqlQuery.= "scarponiId int NOT NULL auto_increment, primary key (scarponiId), ";
$sqlQuery.= "tipoScarponi varchar (100) NOT NULL, ";
$sqlQuery.= "descr varchar (100) NOT NULL, ";
$sqlQuery.= "costoScarponi float";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella scarponi creata ...\n");
else {
    printf("Whoops! niente creazione Tabella scarponi! Che sara' successo??.\n");
  exit();
}

$sqlQuery = "CREATE TABLE if not exists $NOLcaschi_table_name (";
$sqlQuery.= "caschiId int NOT NULL auto_increment, primary key (caschiId), ";
$sqlQuery.= "tipoCasco varchar (100) NOT NULL, ";
$sqlQuery.= "descr varchar (100) NOT NULL, ";
$sqlQuery.= "costoCasco float";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella caschi creata ...\n");
else {
    printf("Whoops! niente creazione Tabella caschi! Che sara' successo??.\n");
  exit();
}

echo mysqli_errno($mysqliConnection);
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// popolamento NOLsci_table_name
//
$sql = "INSERT INTO $NOLsci_table_name
	(tipoSci, descr, costoSci)
	VALUES
	(\"SCI-BAMBINO\", \"(fino a 5 anni)\", \"9\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsci eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsci.\n");
  exit();
}

$sql = "INSERT INTO $NOLsci_table_name
	(tipoSci, descr, costoSci)
	VALUES
	(\"SCI-JUNIOR\", \"(6-11 anni)\", \"13\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsci eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsci.\n");
  exit();
}

$sql = "INSERT INTO $NOLsci_table_name
	(tipoSci, descr, costoSci)
	VALUES
	(\"SCI-BRONZO-RAGAZZO\",  \"(12-16 anni)\", \"17\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsci eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsci.\n");
  exit();
}

$sql = "INSERT INTO $NOLsci_table_name
	(tipoSci, descr, costoSci)
	VALUES
	(\"SCI-ARGENTO\",  \"(principiante)\", \"26\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsci eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsci.\n");
  exit();
}

$sql = "INSERT INTO $NOLsci_table_name
	(tipoSci, descr, costoSci)
	VALUES
	(\"SCI-ORO\", \"(intermedio)\", \"30\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsci eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsci.\n");
  exit();
}

$sql = "INSERT INTO $NOLsci_table_name
	(tipoSci, descr, costoSci)
	VALUES
	(\"SCI-PLATINO\", \"(esperto)\", \"36\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsci eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsci.\n");
  exit();
}

///////////////////////////////////////////////////////////////////////////////
// popolamento NOLsnowboard
//
$sql = "INSERT INTO $NOLsnowboard_table_name
	(tipoSnowboard, descr, costoSnowboard)
	VALUES
	(\"SNOWBOARD-BAMBINO\", \"(fino a 5 anni)\", \"9\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsnowboard eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsnowboard.\n");
  exit();
}

$sql = "INSERT INTO $NOLsnowboard_table_name
	(tipoSnowboard, descr, costoSnowboard)
	VALUES
	(\"SNOWBOARD-JUNIOR\", \"(6-11 anni)\", \"13\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsnowboard eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsnowboard.\n");
  exit();
}

$sql = "INSERT INTO $NOLsnowboard_table_name
	(tipoSnowboard, descr, costoSnowboard)
	VALUES
	(\"SNOWBOARD-BRONZO-RAGAZZO\", \"(12-16 anni)\", \"17\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsnowboard eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsnowboard.\n");
  exit();
}

$sql = "INSERT INTO $NOLsnowboard_table_name
	(tipoSnowboard, descr, costoSnowboard)
	VALUES
	(\"SNOWBOARD-ARGENTO\", \"(principiante)\", \"26\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsnowboard eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsnowboard.\n");
  exit();
}

$sql = "INSERT INTO $NOLsnowboard_table_name
	(tipoSnowboard, descr, costoSnowboard)
	VALUES
	(\"SNOWBOARD-ORO\", \"(intermedio)\", \"30\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsnowboard eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsnowboard.\n");
  exit();
}

$sql = "INSERT INTO $NOLsnowboard_table_name
	(tipoSnowboard, descr, costoSnowboard)
	VALUES
	(\"SNOWBOARD-PLATINO\", \"(esperto)\", \"36\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLsnowboard eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLsnowboard.\n");
  exit();
}

///////////////////////////////////////////////////////////////////////////////
// popolamento NOLscarponi
//
$sql = "INSERT INTO $NOLscarponi_table_name
	(tipoScarponi, descr, costoScarponi)
	VALUES
	(\"SCARPONI-BAMBINO\", \"(fino a 5 anni)\", \"7\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLscarponi eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLscarponi.\n");
  exit();
}

$sql = "INSERT INTO $NOLscarponi_table_name
	(tipoScarponi, descr, costoScarponi)
	VALUES
	(\"SCARPONI-JUNIOR\", \"(6-11 anni)\", \"8\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLscarponi eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLscarponi.\n");
  exit();
}

$sql = "INSERT INTO $NOLscarponi_table_name
	(tipoScarponi, descr, costoScarponi)
	VALUES
	(\"SCARPONI-RAGAZZO-ADULTO\", \"(>11 anni)\", \"13\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLscarponi eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLscarponi.\n");
  exit();
}

///////////////////////////////////////////////////////////////////////////////
// popolamento NOLcaschi
//
$sql = "INSERT INTO $NOLcaschi_table_name
	(tipoCasco, descr, costoCasco)
	VALUES
	(\"CASCO-JUNIOR\", \"(fino a 11 anni)\", \"8\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLcaschi eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLcaschi.\n");
  exit();
}

$sql = "INSERT INTO $NOLcaschi_table_name
	(tipoCasco, descr, costoCasco)
	VALUES
	(\"CASCO-ADULTO\", \"(>11 anni)\", \"8\")
	";
echo $sql;

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento NOLcaschi eseguito ...\n");
else {
    printf("Whoops! Couldn't populate NOLcaschi.\n");
  exit();
}

//
mysqli_close($mysqliConnection);
?>
</body></html>
