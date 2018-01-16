<?php
require "../ConnessioneSQL.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connessione = new ConnessioneSQL();

    $prestiti = $connessione->query("SELECT COUNT(*) AS count FROM prestiti WHERE id_utente=" . $_POST['id_utente'])->fetch_assoc()['count'];

    if ($prestiti < 3) {
        $risultato = $connessione->query("INSERT INTO prestiti (id_libro,id_utente,id_personale,data_inizio,data_fine)
    VALUES ('" . $_POST['id_libro'] . "','" . $_POST['id_utente'] . "','" . $_POST['id_personale'] . "',
    CURRENT_DATE,DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY))");

        if ($risultato) {
            header("location: ./index.php");
        } else {
            $errore = " Si è verificato un'errore.";
        }
    } else {
        $errore = "Sono già attivi 3 prestiti";
    }
}
?>

<?php require '../partials/head.php' ?>

<?php require '../partials/error.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Crea Prestito</h3>
    <a href="index.php" class="btn btn-link">Lista prestiti</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>ID Libro</label>
        <input class="form-control" type="text" name="id_libro">
    </div>

    <div class="form-group">
        <label>ID Utente</label>
        <input class="form-control" type="text" name="id_utente">
    </div>

    <div class="form-group">
        <label>ID Personale</label>
        <input class="form-control" type="text" name="id_personale">
    </div>

    <button class="btn btn-primary">Inserisci</button>
</form>

<?php require '../partials/footer.php' ?>
