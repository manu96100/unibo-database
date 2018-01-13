<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$record = $connessione->select('utenti', '*', 'WHERE id=' . $_GET['id']);

if (empty($record)) {
    die("Record non trovato.");
}
$record = $record[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $risultato = $connessione->update('utenti', [
        'cognome'      => $_POST['cognome'],
        'nome'         => $_POST['nome'],
        'data_nascita' => $_POST['data_nascita'],
        'citta'        => $_POST['citta'],
        'indirizzo'    => $_POST['indirizzo'],
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
    <h3>Modifica Utente</h3>
    <a href="index.php" class="btn btn-link">Lista utenti</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>Cognome</label>
        <input class="form-control" type="text" name="cognome" required
               value="<?php echo $record["cognome"] ?>">
    </div>
    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome" required
               value="<?php echo $record["nome"] ?>">
    </div>
    <div class="form-group">
        <label>Data di nascita</label>
        <input class="form-control" type="date" name="data_nascita" required
               value="<?php echo $record["data_nascita"] ?>">
    </div>
    <div class="form-group">
        <label>Città</label>
        <input class="form-control" type="text" name="citta"
               value="<?php echo $record["citta"] ?>">
    </div>
    <div class="form-group">
        <label>Indirizzo</label>
        <input class="form-control" type="text" name="indirizzo"
               value="<?php echo $record["indirizzo"] ?>">
    </div>
    <button class="btn btn-primary">Modifica</button>
</form>

<?php require '../partials/footer.php' ?>
