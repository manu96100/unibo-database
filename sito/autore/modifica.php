<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$sql = "SELECT * FROM autori WHERE id =".$_GET["id"].";";
$risultato = $connessione->query($sql);

if ($risultato->num_rows > 0) {
    // output data of each row
    $row = $risultato->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();
    $sql = "UPDATE autori SET cognome='".$_POST['cognome']."', nome='".$_POST['nome']."', data_nascita='".$_POST['data_nascita']."' WHERE id=".$_GET["id"].";";
    $connessione->query($sql);
    header("location: ./index.php");
}
?>
<html>
<head>
    <title>Progetto Basi di Dati</title>
</head>
<body>
<form action="#" method="post">
    <label>Cognome</label>
    <input type="text" name="cognome" value="<?php echo $row["cognome"]?>">

    <label>Nome</label>
    <input type="text" name="nome" value="<?php echo $row["nome"]?>">

    <label>Data di nascita</label>
    <input type="date" name="data_nascita" value="<?php echo $row["data_nascita"]?>">
    <button>Modifica</button>
</form>

</body>
</html>
