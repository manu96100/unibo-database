<?php require '../partials/head.php' ?>

<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();

$sql = "SELECT collane.nome AS collana, titolo, quantita, quantita - COUNT(prestiti.id_libro) AS disponibili
FROM prestiti
  JOIN libri ON prestiti.id_libro = libri.id
  JOIN collane ON collane.id = libri.id_collana
WHERE restituito = 0
GROUP BY collana, titolo, quantita";

$risultato = $connessione->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Inventario</h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Collana</th>
        <th>Libro</th>
        <th>Quantità Totale</th>
        <th>Disponibili</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($risultato) > 0) {
        // output data of each row
        foreach ($risultato as $row) {
            ?>
            <tr>
                <td><?php echo $row["collana"] ?></td>
                <td><?php echo $row["titolo"] ?></td>
                <td><?php echo $row["quantita"] ?></td>
                <td><?php echo $row["disponibili"] ?></td>
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
