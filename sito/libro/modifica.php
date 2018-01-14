<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$record = $connessione->select('libri', '*', 'WHERE id=' . $_GET['id']);

if (empty($record)) {
    die("Record non trovato.");
}
$record = $record[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $risultato = $connessione->update('libri', [
        'titolo' => $_POST['titolo'],
        'quantita' => $_POST['quantita'],
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
    <h3>Modifica Libro</h3>
    <a href="index.php" class="btn btn-link">Lista libri</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>Titolo</label>
        <input class="form-control" type="text" name="titolo" required
               value="<?php echo $record["titolo"] ?>">
    </div>
    <div class="form-group">
        <label>Quantità</label>
        <input class="form-control" type="text" name="quantita" required
               value="<?php echo $record["quantita"] ?>">
    </div>
    <button class="btn btn-primary">Modifica</button>
</form>

<?php require '../partials/footer.php' ?>
