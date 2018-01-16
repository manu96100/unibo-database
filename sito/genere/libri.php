<?php require '../partials/head.php' ?>

<?php
require "../ConnessioneSQL.php";
$connessione = new ConnessioneSQL();
$id_genere = isset($_GET['id_genere']) && strlen($_GET['id_genere']) > 0 ? $_GET['id_genere'] : die("Richiesto id autore");
$genere = $connessione->select('generi', '*', "WHERE id=$id_genere")[0];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Libri <?php echo $genere['nome'] ?></h3>
    <a href="inserisci.php" class="btn btn-primary">Inserisci</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th>ISBN</th>
        <th>Titolo</th>
        <th>Anno</th>
        <th>Quantità</th>
        <th>Collana</th>
        <th>Autore</th>
        <th>Casa Editrice</th>
        <th>Stanza</th>
        <th>Espositore</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $ris = $connessione->query(
        "SELECT libri.id AS lib_id,ISBN,titolo, anno_pubblicazione, quantita, collane.nome AS collana, 
          casa_editrice.nome AS casa_editrice, CONCAT(autori.cognome, ' ', autori.nome) AS autore, 
          stanze.nome AS stanza, espositori.nome AS espositore
        FROM libri
	      JOIN collane ON libri.id_collana=collane.id
          JOIN casa_editrice ON libri.id_editore=casa_editrice.id
          JOIN libri_autori ON libri.id=libri_autori.id_libro
          JOIN autori ON libri_autori.id_autore=autori.id
          JOIN libri_generi ON libri.id=libri_generi.id_libro
          JOIN espositori ON espositori.id=libri.id_espositore
          JOIN stanze ON stanze.id=espositori.id_stanza
        WHERE libri_generi.id_genere=$id_genere"
    )->fetch_all(MYSQLI_ASSOC);
    $risultato = [];
    foreach ($ris as $row) {
        if (isset($risultato[$row["ISBN"]])) {
            if (!in_array($row["autore"], $risultato[$row["ISBN"]]["autore"])) {
                array_push($risultato[$row["ISBN"]]["autore"], $row["autore"]);
            }
        } else {
            $risultato[$row["ISBN"]] = $row;
            $risultato[$row["ISBN"]]["autore"] = [$row["autore"]];
        }
    }

    if (count($risultato) > 0) {
        // output data of each row
        foreach ($risultato as $row) {
            ?>
            <tr>
                <td><?php echo $row["ISBN"] ?></td>
                <td><?php echo $row["titolo"] ?></td>
                <td><?php echo $row["anno_pubblicazione"] ?></td>
                <td><?php echo $row["quantita"] ?></td>
                <td><?php echo $row["collana"] ?></td>
                <td><?php foreach ($row["autore"] as $genere) echo $genere . (next($row["autore"]) ? ", " : "") ?></td>
                <td><?php echo $row["casa_editrice"] ?></td>
                <td><?php echo $row["stanza"] ?></td>
                <td><?php echo $row["espositore"] ?></td>
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
