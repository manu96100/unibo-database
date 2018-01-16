<?php require '../partials/head.php' ?>

<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();

$sql = "SELECT prestiti.id AS pres_id, libri.titolo AS titolo, CONCAT(utenti.cognome, ' ',utenti.nome) AS utente, 
            CONCAT(personale.cognome, ' ', personale.nome) AS person, data_inizio, data_fine, restituito
        FROM prestiti
        JOIN libri ON libri.id=prestiti.id_libro
        JOIN utenti ON utenti.id=prestiti.id_utente
        JOIN personale ON personale.id=prestiti.id_personale";

if (isset($_GET['id_utente']) && strlen($_GET['id_utente']) > 0) {
    $sql .= " WHERE prestiti.id_utente=" . $_GET['id_utente'];
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Prestiti</h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<form action="#" class="form-inline" method="get">
    <label class="mr-2">Cerca utente:</label>
    <input type="text" class="form-control mr-2" placeholder="ID Utente" name="id_utente">
    <button class="btn btn-primary">Filtra</button>
</form>

<table class="table">
    <thead>
    <tr>
        <th>Cod.</th>
        <th>Titolo libro</th>
        <th>Nome utente</th>
        <th>Nome personale</th>
        <th>Data inizio</th>
        <th>Data fine</th>
        <th>Restituito</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql_prestiti = $sql . " ORDER BY data_inizio DESC";

    $prestiti = $connessione->query($sql_prestiti)->fetch_all(MYSQLI_ASSOC);

    if (count($prestiti) > 0) {
        // output data of each row
        foreach ($prestiti as $row) {
            ?>
            <tr>
                <td><?php echo $row["pres_id"] ?></td>
                <td><?php echo $row["titolo"] ?></td>
                <td><?php echo $row["utente"] ?></td>
                <td><?php echo $row["person"] ?></td>
                <td><?php echo $row["data_inizio"] ?></td>
                <td><?php echo $row["data_fine"] ?></td>
                <td><?php echo $row["restituito"] ? 'Si' : 'No' ?></td>
                <td><a href="modifica.php?id=<?php echo $row["pres_id"] ?>">Modifica</a></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td rowspan="4">Non ci sono record.</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <h5>Prestiti non restituiti</h5>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Cod.</th>
        <th>Titolo libro</th>
        <th>Nome utente</th>
        <th>Nome personale</th>
        <th>Data inizio</th>
        <th>Data fine</th>
        <th>Restituito</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql_non_restituiti = $sql . " AND restituito = 0 ORDER BY data_inizio DESC";

    $prestiti = $connessione->query($sql_non_restituiti)->fetch_all(MYSQLI_ASSOC);

    if (count($prestiti) > 0) {
        // output data of each row
        foreach ($prestiti as $row) {
            ?>
            <tr>
                <td><?php echo $row["pres_id"] ?></td>
                <td><?php echo $row["titolo"] ?></td>
                <td><?php echo $row["utente"] ?></td>
                <td><?php echo $row["person"] ?></td>
                <td><?php echo $row["data_inizio"] ?></td>
                <td><?php echo $row["data_fine"] ?></td>
                <td><?php echo $row["restituito"] ? 'Si' : 'No' ?></td>
                <td><a href="modifica.php?id=<?php echo $row["pres_id"] ?>">Modifica</a></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td rowspan="4">Non ci sono record.</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<?php require '../partials/footer.php' ?>
