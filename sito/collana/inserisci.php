<?php
require "../ConnessioneSQL.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();
    $risultato = $connessione->insert('collane', [
            'nome' => $_POST['nome'],
            'descrizione' => $_POST['descrizione'],
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
    <h3>Inserisci Collana</h3>
    <a href="index.php" class="btn btn-link">Lista collane</a>
</div>

<form action="#" method="post">

    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome">
    </div>

    <div class="form-group">
        <label>Descrizione</label>
        <textarea class="form-control"  name="descrizione"></textarea>
    </div>

    <button class="btn btn-primary">Inserisci</button>
</form>

<?php require '../partials/footer.php' ?>
