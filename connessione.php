<?php
$host="localhost";
$user="archer";
$pass="archer";
$db_name = "NOLdb";
$NOLuser_table_name = "NOLuser";
$NOLsci_table_name = "NOLsci";
$NOLsnowboard_table_name = "NOLsnowboard";
$NOLscarponi_table_name = "NOLscarponi";
$NOLcaschi_table_name = "NOLcaschi";
///////////////////////////////////////////////////////////////////////////////
// effettuazione della connessione al database
//
$mysqliConnection = new mysqli("localhost", "archer", "archer", $db_name);

if (mysqli_connect_errno()) {
    printf("Oops, abbiamo problemi con la connessione al db: %s\n", mysqli_connect_error());
//    exit();
}
?>
