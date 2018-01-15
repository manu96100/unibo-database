<?php require '../partials/head.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Espositori</h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Stanza</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    require "../ConnessioneSQL.php";
    $connessione = new ConnessioneSQL();
    $risultato = $connessione->query("SELECT espositori.id AS esp_id,espositori.nome AS espositore, stanze.nome AS stanza
        FROM espositori
	      JOIN stanze ON espositori.id_stanza=stanze.id")->fetch_all(MYSQLI_ASSOC);

    if (count($risultato) > 0) {
        // output data of each row
        foreach ($risultato as $row) {
            ?>
            <tr>
                <td><?php echo $row["espositore"] ?></td>
                <td><?php echo $row["stanza"] ?></td>

                <td><a href="modifica.php?id=<?php echo $row["esp_id"] ?>">Modifica</a></td>
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
