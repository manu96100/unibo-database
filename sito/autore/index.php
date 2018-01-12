<html>
<head>
    <title>Progetto Basi di Dati</title>
</head>
<body>
<table>
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
            echo "<tr><td>" . $row["cognome"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["data_nascita"] . "</td><td><a href='modifica.php?id=".$row["id"]."'>Modifica</a></td></tr>";
        }
    }
    ?>
    </tbody>
</table>
<a href="inserisci.php">Inserisci</a>
</body>
</html>

