<?php require '../partials/head.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Autori</h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Cognome</th>
            <th>Nome</th>
            <th>Data di nascita</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        require "../ConnessioneSQL.php";
        $connessione = new ConnessioneSQL();
        $sql = "SELECT * FROM autori";
        $risultato = $connessione->query($sql);
        if ($risultato->num_rows > 0) {
            // output data of each row
            while ($row = $risultato->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["cognome"] ?></td>
                    <td><?php echo $row["nome"] ?></td>
                    <td><?php echo $row["data_nascita"] ?></td>
                    <td><a href="modifica.php?id=<?php echo $row["id"] ?>">Modifica</a></td>
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
