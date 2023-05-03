Componente: Mattia Bove
Indirizzo repository: https://github.com/mattia-gh/secondo-compito.git

L'esercizio fa riferimento a "PHP-15" del documento "lweb-part06-PHP2.pdf " 
nella directory delle lezioni.

Nell'esercizio si vuole sperimentare l'uso di PHP, MySQL e delle variabili $_SESSION.

Ho modificato l'esercizio prendendo spunto da "carrello.della.spesa"(cartella "PHP2") e creando un piccolo 
sito web per noleggio di SCI/SCARPONI, SNOWBORD e CASCHI. Il sito presenta una pagina 
di login per effettuare l'accesso. Prima però bisogna registrarsi tramite un collegamento
che si trova nella pagina di login. Una volta registrati(non sono ammessi stessi username) 
si può accedere. Una volta effettuato l'accesso si arriva nella pagina principale, 
in cui viene visualizzato un messaggio di benvenuto con il numero di volte che 
quell'utente ha effettuato un accesso ("PHP-8" del documento "lweb-part06-PHP2.pdf ").
In alto ci sono dei collegamenti per riempire il carrello con sci, snowboard, scarponi e caschi.
L'utente può scegliere vari tipi di sci,snowboard ecc... e selezionarne 
le quantità(1 di default se non viene selezionata). C'è anche una pagina 
per eliminare gli oggetti dal carrello e un'altra per eseguire il logout. Infine nella pagina 
per il pagamento viene riepilogato il costo totale e c'è una form per selezionare la durata del noleggio.
Cliccando paga viene visualizzato un messaggio con il costo totale*durata noleggio
(messaggio di errore se non viene selezionata la durata).

Modificare utente riga 19 in "install.php" e in "connessione.php".



