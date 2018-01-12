<html>
<head>
    <title>Progetto Basi di Dati</title>
</head>
<body>
<form action="#" method="post">
    <label>Cognome</label>
    <input type="text" name="cognome">

    <label>Nome</label>
    <input type="text" name="nome">

    <label>Data di nascita</label>
    <input type="date" name="data_nascita">
    <button>Inserisci</button>
</form>

</body>
</html>
<?php
require "../ConnessioneSQL.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();
    $sql = "INSERT INTO autori (cognome, nome, data_nascita) VALUES ('".$_POST['cognome']."','".$_POST['nome']."','".$_POST['data_nascita']."');";
    $asd = $connessione->query($sql);
    header("location: ./index.php");
}