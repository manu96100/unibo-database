SELECT prestiti.id AS pres_id, libri.titolo AS titolo, CONCAT(utenti.cognome, ' ',utenti.nome) AS utente,
            CONCAT(personale.cognome, ' ', personale.nome) AS person, data_inizio, data_fine, restituito
        FROM prestiti
        JOIN libri ON libri.id=prestiti.id_libro
        JOIN utenti ON utenti.id=prestiti.id_utente
        JOIN personale ON personale.id=prestiti.id_personale
WHERE prestiti.id_utente=1;