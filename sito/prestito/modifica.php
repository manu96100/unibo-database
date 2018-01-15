<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$record = $connessione->select('prestiti JOIN libri ON prestiti.id_libro=libri.id',
    'libri.titolo AS titolo, prestiti.restituito AS restitito',
  'WHERE prestiti.id=' . $_GET['id']);

if (empty($record)) {
    die("Record non trovato.");
}
$record = $record[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $risultato = $connessione->update('prestiti', [
        'restituito' => '1',
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
    <h3>Modifica Prestito</h3>
    <a href="index.php" class="btn btn-link">Lista prestiti</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <h4>Titolo</h4>
        <label><?php echo $record["titolo"] ?></label>
    </div>

    <button class="btn btn-primary">Restituisci</button>
</form>

<?php require '../partials/footer.php' ?>
