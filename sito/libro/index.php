<?php require '../partials/head.php' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Libri</h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<form action="#" method="get" class="form-inline">
    <label class="mr-2">Cerca libro:</label>
    <input type="text" class="form-control mr-2" placeholder="Titolo" name="titolo">
    <button class="btn btn-primary">Cerca</button>
</form>

<table class="table">
    <thead>
    <tr>
        <th>Id</th>
        <th>ISBN</th>
        <th>Titolo</th>
        <th>Anno</th>
        <th>Quantità</th>
        <th>Collana</th>
        <th>Autore</th>
        <th>Genere</th>
        <th>Casa Editrice</th>
        <th>Stanza</th>
        <th>Espositore</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    require "../ConnessioneSQL.php";
    $connessione = new ConnessioneSQL();
    $sql = "SELECT libri.id AS lib_id,ISBN,titolo, anno_pubblicazione, quantita,
        collane.nome AS collana, casa_editrice.nome AS casa_editrice, CONCAT(autori.cognome, ' ', autori.nome) AS autore,
        generi.nome AS genere, stanze.nome AS stanza, espositori.nome AS espositore
        FROM libri
	      JOIN collane ON libri.id_collana=collane.id
          JOIN casa_editrice ON libri.id_editore=casa_editrice.id
          JOIN libri_autori ON libri.id=libri_autori.id_libro
          JOIN autori ON libri_autori.id_autore=autori.id
          JOIN libri_generi ON libri.id=libri_generi.id_libro
          JOIN generi ON libri_generi.id_genere=generi.id
          JOIN espositori ON espositori.id=libri.id_espositore
          JOIN stanze ON stanze.id=espositori.id_stanza";

    if (isset($_GET['titolo']) && strlen($_GET['titolo']) > 0) {
        $sql .= " AND libri.titolo like '%" . $_GET['titolo'] . "%'";
    }

    $ris = $connessione->query($sql)->fetch_all(MYSQLI_ASSOC);
    $risultato = [];
    foreach ($ris as $row) {
        if (isset($risultato[$row["ISBN"]])) {
            if (!in_array($row["autore"], $risultato[$row["ISBN"]]["autore"])) {
                array_push($risultato[$row["ISBN"]]["autore"], $row["autore"]);
            }
            if (!in_array($row["genere"], $risultato[$row["ISBN"]]["genere"])) {
                array_push($risultato[$row["ISBN"]]["genere"], $row["genere"]);
            }
        } else {
            $risultato[$row["ISBN"]] = $row;
            $risultato[$row["ISBN"]]["autore"] = [$row["autore"]];
            $risultato[$row["ISBN"]]["genere"] = [$row["genere"]];
        }
    }

    if (count($risultato) > 0) {
        // output data of each row
        foreach ($risultato as $row) {
            ?>
            <tr>
                <td><?php echo $row["lib_id"] ?></td>
                <td><?php echo $row["ISBN"] ?></td>
                <td><?php echo $row["titolo"] ?></td>
                <td><?php echo $row["anno_pubblicazione"] ?></td>
                <td><?php echo $row["quantita"] ?></td>
                <td><?php echo $row["collana"] ?></td>
                <td><?php foreach ($row["autore"] as $autore) echo $autore . (next($row["autore"]) ? ", " : "") ?></td>
                <td><?php foreach ($row["genere"] as $genere) echo $genere . (next($row["genere"]) ? ", " : "") ?></td>
                <td><?php echo $row["casa_editrice"] ?></td>
                <td><?php echo $row["stanza"] ?></td>
                <td><?php echo $row["espositore"] ?></td>

                <td><a href="modifica.php?id=<?php echo $row["lib_id"] ?>">Modifica</a></td>
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
