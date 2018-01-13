<?php
require "../ConnessioneSQL.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();
    $risultato = $connessione->insert('generi', [
            'nome' => $_POST['nome'],
    ]);
    if ($risultato) {
        header("location: ./index.php");
    } else {
        $errore = " Si è verificato un'errore.";
    }
}
?>

<?php require '../partials/head.php' ?>

<?php require '../partials/error.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Inserisci Genere</h3>
    <a href="index.php" class="btn btn-link">Lista generi</a>
</div>

<form action="#" method="post">

    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome">
    </div>

    <button class="btn btn-primary">Inserisci</button>
</form>

<?php require '../partials/footer.php' ?>
