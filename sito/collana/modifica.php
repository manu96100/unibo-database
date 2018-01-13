<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$record = $connessione->select('collane', '*', 'WHERE id=' . $_GET['id']);

if (empty($record)) {
    die("Record non trovato.");
}
$record = $record[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $risultato = $connessione->update('collane', [
        'nome'        => $_POST['nome'],
        'descrizione' => $_POST['descrizione'],
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
    <h3>Modifica Collana</h3>
    <a href="index.php" class="btn btn-link">Lista collane</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome" required
               value="<?php echo $record["nome"] ?>">
    </div>
    <div class="form-group">
        <label>Descrizione</label>
        <textarea class="form-control" name="descrizione" required><?php echo $record["descrizione"] ?></textarea>
    </div>
    <button class="btn btn-primary">Modifica</button>
</form>

<?php require '../partials/footer.php' ?>
