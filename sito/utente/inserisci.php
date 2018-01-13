<?php
require "../ConnessioneSQL.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();
    $risultato = $connessione->insert('utenti', [
        'cognome'      => $_POST['cognome'],
        'nome'         => $_POST['nome'],
        'data_nascita' => $_POST['data_nascita'],
        'citta'        => $_POST['citta'],
        'indirizzo'    => $_POST['indirizzo'],
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
    <h3>Inserisci Utente</h3>
    <a href="index.php" class="btn btn-link">Lista utenti</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>Cognome</label>
        <input class="form-control" type="text" name="cognome">
    </div>

    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome">
    </div>

    <div class="form-group">
        <label>Data di nascita</label>
        <input class="form-control" type="date" name="data_nascita">
    </div>

    <div class="form-group">
        <label>Città</label>
        <input class="form-control" type="text" name="citta">
    </div>

    <div class="form-group">
        <label>Indirizzo</label>
        <input class="form-control" type="text" name="indirizzo">
    </div>

    <button class="btn btn-primary">Inserisci</button>
</form>

<?php require '../partials/footer.php' ?>
