<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_libro = $connessione->insert('libri', [
        'ISBN' => $_POST['ISBN'],
        'titolo' => $_POST['titolo'],
        'anno_pubblicazione' => $_POST['anno_pubblicazione'],
        'quantita' => $_POST['quantita'],
        'id_editore' => $_POST['id_editore'],
        'id_collana' => $_POST['id_collana'] ?: NULL,
        'id_espositore' => $_POST['id_espositore']
    ]);

    if ($id_libro) {
        foreach ($_POST["id_autore"] as $id_autore) {
            $connessione->insert('libri_autori', [
                'id_libro' => $id_libro,
                'id_autore' => $id_autore
            ]);
        }

        foreach ($_POST["id_genere"] as $id_genere) {
            $connessione->insert('libri_generi', [
                'id_libro' => $id_libro,
                'id_genere' => $id_genere
            ]);
        }

        header("location: ./index.php");
    } else {
        $errore = " Si è verificato un'errore.";
    }
}
?>

<?php require '../partials/head.php' ?>

<?php require '../partials/error.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Inserisci Libro</h3>
    <a href="index.php" class="btn btn-link">Lista libri</a>
</div>

<form action="#" method="post">
    <div class="form-group">
        <label>ISBN</label>
        <input class="form-control" type="text" name="ISBN">
    </div>

    <div class="form-group">
        <label>Titolo</label>
        <input class="form-control" type="text" name="titolo">
    </div>

    <div class="form-group">
        <label>Anno Pubblicazione</label>
        <input class="form-control" type="text" name="anno_pubblicazione">
    </div>

    <div class="form-group">
        <label>Quantità</label>
        <input class="form-control" type="number" name="quantita">
    </div>

    <div class="form-group">
        <label>Editore</label>
        <select class="form-control" name="id_editore">
            <?php
            $editori = $connessione->select('casa_editrice');
            foreach ($editori as $row) {
                ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php echo $row["nome"] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Collana</label>
        <select class="form-control" name="id_collana">
            <option value=""></option>
            <?php
            $collane = $connessione->select('collane');
            foreach ($collane as $row) {
                ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php echo $row["nome"] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Autore</label>
        <select multiple class="form-control" name="id_autore[]">
            <?php
            $autori = $connessione->select('autori');
            foreach ($autori as $row) {
                ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php echo $row["cognome"] . " " . $row["nome"] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Genere</label>
        <select multiple class="form-control" name="id_genere[]">
            <?php
            $generi = $connessione->select('generi');
            foreach ($generi as $row) {
                ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php echo $row["nome"] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Stanza - Espositore</label>
        <select class="form-control" name="id_espositore">
            <?php
            $espositori = $connessione->query("SELECT espositori.id AS esp_id, CONCAT(stanze.nome, ' - ', espositori.nome) AS espositore
            FROM espositori JOIN stanze ON espositori.id_stanza=stanze.id");
            foreach ($espositori as $row) {
                ?>
                <option value="<?php echo $row["esp_id"] ?>">
                    <?php echo $row["espositore"] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>

    <button class="btn btn-primary">Inserisci</button>
</form>

<?php require '../partials/footer.php' ?>
