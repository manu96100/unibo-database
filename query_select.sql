#Ricerca prestiti per utenti
SELECT
  prestiti.id                                    AS pres_id,
  libri.titolo                                   AS titolo,
  CONCAT(utenti.cognome, ' ', utenti.nome)       AS utente,
  CONCAT(personale.cognome, ' ', personale.nome) AS person,
  data_inizio,
  data_fine,
  restituito
FROM prestiti
  JOIN libri ON libri.id = prestiti.id_libro
  JOIN utenti ON utenti.id = prestiti.id_utente
  JOIN personale ON personale.id = prestiti.id_personale
WHERE prestiti.id_utente = 1;

#Ricerca libri per autore
SELECT
  libri.id           AS lib_id,
  ISBN,
  titolo,
  anno_pubblicazione,
  quantita,
  collane.nome       AS collana,
  casa_editrice.nome AS casa_editrice,
  generi.nome        AS genere,
  stanze.nome        AS stanza,
  espositori.nome    AS espositore
FROM libri
  JOIN collane ON libri.id_collana = collane.id
  JOIN casa_editrice ON libri.id_editore = casa_editrice.id
  JOIN libri_autori ON libri.id = libri_autori.id_libro
  JOIN libri_generi ON libri.id = libri_generi.id_libro
  JOIN generi ON libri_generi.id_genere = generi.id
  JOIN espositori ON espositori.id = libri.id_espositore
  JOIN stanze ON stanze.id = espositori.id_stanza
WHERE libri_autori.id_autore = 1;

#Ricerca libri per genere
SELECT
  libri.id                                 AS lib_id,
  ISBN,
  titolo,
  anno_pubblicazione,
  quantita,
  collane.nome                             AS collana,
  casa_editrice.nome                       AS casa_editrice,
  CONCAT(autori.cognome, ' ', autori.nome) AS autore,
  stanze.nome                              AS stanza,
  espositori.nome                          AS espositore
FROM libri
  JOIN collane ON libri.id_collana = collane.id
  JOIN casa_editrice ON libri.id_editore = casa_editrice.id
  JOIN libri_autori ON libri.id = libri_autori.id_libro
  JOIN libri_generi ON libri.id = libri_generi.id_libro
  JOIN autori ON libri_autori.id_autore = autori.id
  JOIN espositori ON espositori.id = libri.id_espositore
  JOIN stanze ON stanze.id = espositori.id_stanza
WHERE libri_generi.id_genere = 1;

#Prestiti non restituiti oltre la data di scadenza
SELECT libri.titolo AS titolo, CONCAT(utenti.cognome, ' ', utenti.nome) AS utente, data_inizio, data_fine
FROM prestiti
  JOIN libri ON prestiti.id_libro = libri.id
  JOIN utenti ON prestiti.id_utente = utenti.id
WHERE restituito = 0 AND data_fine < '2018-02-30';

#Prestiti in un intervallo di tempo
SELECT
  libri.titolo                                   AS titolo,
  CONCAT(utenti.cognome, ' ', utenti.nome)       AS utente,
  CONCAT(personale.cognome, ' ', personale.nome) AS personale,
  data_inizio,
  data_fine,
  restituito
FROM prestiti
  JOIN libri ON prestiti.id_libro = libri.id
  JOIN utenti ON prestiti.id_utente = utenti.id
  JOIN personale ON prestiti.id_personale = personale.id
WHERE data_inizio >= '2018-01-01' AND data_inizio <= '2018-02-30';

#Libri prestati da un determinato utente del personale
SELECT titolo, CONCAT(utenti.cognome, ' ', utenti.nome) AS utente, data_inizio, data_fine, restituito
FROM prestiti
  JOIN libri ON prestiti.id_libro = libri.id
  JOIN utenti ON prestiti.id_utente = utenti.id
WHERE id_personale = 1;

#Ricerca per titolo del libro
SELECT
  libri.id                                 AS id,
  ISBN,
  libri.titolo                             AS titolo,
  CONCAT(autori.cognome, ' ', autori.nome) AS autore,
  collane.nome                             AS collana,
  casa_editrice.nome                       AS casa_editrice,
  generi.nome                              AS genere,
  quantita                                 AS quantita,
  stanze.nome                              AS stanza,
  espositori.nome                          AS espositore
FROM libri
  JOIN collane ON libri.id_collana = collane.id
  JOIN casa_editrice ON libri.id_editore = casa_editrice.id
  JOIN libri_autori ON libri.id = libri_autori.id_libro
  JOIN libri_generi ON libri.id = libri_generi.id_libro
  JOIN generi ON libri_generi.id_genere = generi.id
  JOIN autori ON libri_autori.id_autore = autori.id
  JOIN espositori ON espositori.id = libri.id_espositore
  JOIN stanze ON stanze.id = espositori.id_stanza
WHERE libri.titolo LIKE '%comp%';

#Inventario dei libri in biblioteca
SELECT collane.nome AS collana, titolo, quantita, quantita - COUNT(prestiti.id_libro) AS disponibili
FROM prestiti
  JOIN libri ON prestiti.id_libro = libri.id
  JOIN collane ON collane.id = libri.id_collana
WHERE restituito = 0
GROUP BY collana, titolo, quantita;