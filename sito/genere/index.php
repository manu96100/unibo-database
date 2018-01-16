<?php require '../partials/head.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Generi</h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        require "../ConnessioneSQL.php";
        $connessione = new ConnessioneSQL();
        $risultato = $connessione->select('generi');

        if (count($risultato) > 0) {
            // output data of each row
            foreach ($risultato as $row) {
                ?>
                <tr>
                    <td><?php echo $row["nome"] ?></td>
                    <td>
                        <a href="libri.php?id_genere=<?php echo $row["id"] ?>" class="mr-2">Libri</a>
                        <a href="modifica.php?id=<?php echo $row["id"] ?>">Modifica</a>
                    </td>
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
