<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $risultato = $connessione->insert('espositori', [
        'nome' => $_POST['nome'],
        'id_stanza' => $_POST['id_stanza'],
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
    <h3>Inserisci Espositore</h3>
    <a href="index.php" class="btn btn-link">Lista espositori</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>Nome</label>
        <input class="form-control" type="text" name="nome">
    </div>

    <div class="form-group">
        <label>Stanza</label>
        <select class="form-control" name="id_stanza">
            <?php
            $stanze = $connessione->select('stanze');
            foreach ($stanze as $row) {
                ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php echo $row["nome"] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>

    <button class="btn btn-primary">Inserisci</button>
</form>

<?php require '../partials/footer.php' ?>
