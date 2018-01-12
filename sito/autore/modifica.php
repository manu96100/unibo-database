<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$sql = "SELECT * FROM autori WHERE id =" . $_GET["id"] . ";";
$risultato = $connessione->query($sql)->fetch_assoc();

if (is_null($risultato)) {
    die("Record non trovato.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();
    $risultato = $connessione->update('autori', [
        'cognome' => $_POST['cognome'],
        'nome' => $_POST['nome'],
        'data_nascita' => $_POST['data_nascita'],
    ], ['id' => $_GET['id']]);
    if ($risultato) {
        header("location: ./index.php");
    } else {
        $errore = "Si è verificato un errore.";
    }
}
?>

<?php require '../partials/head.php' ?>

<?php require '../partials/error.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Modifica Autore</h3>
    <a href="index.php" class="btn btn-link">Lista autori</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>Cognome</label>
        <input class="form-control" type="text" name="cognome" required
               value="<?php echo $risultato["cognome"] ?>">
    </div>
    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome" required
               value="<?php echo $risultato["nome"] ?>">
    </div>
    <div class="form-group">
        <label>Data di nascita</label>
        <input class="form-control" type="date" name="data_nascita" required
               value="<?php echo $risultato["data_nascita"] ?>">
    </div>
    <button class="btn btn-primary">Modifica</button>
</form>

<?php require '../partials/footer.php' ?>
