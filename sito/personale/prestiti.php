<?php require '../partials/head.php' ?>

<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$id_personale = isset($_GET['id_personale']) && strlen($_GET['id_personale']) > 0 ? $_GET['id_personale'] : die("Richiesto id personale");
$personale = $connessione->select('personale', '*', "WHERE id=$id_personale")[0];

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Personale: <?php echo $personale['nome'] . ' ' . $personale['cognome'] ?></h3>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Libro</th>
        <th>Utente</th>
        <th>Data di inizio</th>
        <th>Data di fine</th>
        <th>restituito</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $risultato = $connessione->query(
        "SELECT titolo, CONCAT(utenti.cognome, ' ', utenti.nome) AS utente, data_inizio, data_fine, restituito
            FROM prestiti
              JOIN libri ON prestiti.id_libro = libri.id
              JOIN utenti ON prestiti.id_utente = utenti.id
            WHERE id_personale = $id_personale"
    )->fetch_all(MYSQLI_ASSOC);

    if (count($risultato) > 0) {
        // output data of each row
        foreach ($risultato as $row) {
            ?>
            <tr>
                <td><?php echo $row["titolo"] ?></td>
                <td><?php echo $row["utente"] ?></td>
                <td><?php echo $row["data_inizio"] ?></td>
                <td><?php echo $row["data_fine"] ?></td>
                <td><?php echo $row["restituito"] ? 'Si' : 'No' ?></td>
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
