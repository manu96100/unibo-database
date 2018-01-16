INSERT INTO autori (id, cognome, nome, data_nascita) VALUES (1, "Tolkien", "John Ronald Reuel", "1892-01-03");
INSERT INTO autori (id, cognome, nome, data_nascita) VALUES (2, "Rowling", "Joanne", "1965-07-31");

INSERT INTO casa_editrice (id, nome) VALUES (1, "Mondadori");
INSERT INTO casa_editrice (id, nome) VALUES (2, "Zanichelli");

INSERT INTO collane (id, nome, descrizione) VALUES (1, "Il Signore degli Anelli", "Romanzo fantasy ambientato nella terra di mezzo. Parla di un Hobbit che deve distruggere un anello per portare la pace.");
INSERT INTO collane (id, nome, descrizione) VALUES (2, "Harry Potter", "Ogni libro della serie rappresenta un anno nella vita di Harry dagli undici ai diciassette anni; i libri descrivono ogni anno scolastico trascorso nella scuola di magia e stregoneria di Hogwarts.");

INSERT INTO generi (id, nome) VALUES (1, "Fantasy");
INSERT INTO generi (id, nome) VALUES (2, "Giallo");
INSERT INTO generi (id, nome) VALUES (3, "Avventura");

INSERT INTO personale (id, cognome, nome, data_nascita) VALUES (1, "Rossi", "Mario", "1980-01-01");
INSERT INTO personale (id, cognome, nome, data_nascita) VALUES (2, "Fabbri", "Matteo", "1996-05-04");

INSERT INTO utenti (id, cognome, nome, data_nascita, citta, indirizzo) VALUES (1, "Cortesi", "Emanuele", "1996-09-30", "Bagnacavallo (RA)", "via aaa 1");
INSERT INTO utenti (id, cognome, nome, data_nascita, citta, indirizzo) VALUES (2, "Capucci", "Fabio", "1996-01-16", "Fusignano (RA)", "via bbb 2");

INSERT INTO stanze(id, nome) VALUES (1, 'Per ragazzi');
INSERT INTO stanze(id, nome) VALUES (2, 'Per studenti');

INSERT INTO espositori(id, nome, id_stanza) VALUES (1, 'A', '1');
INSERT INTO espositori(id, nome, id_stanza) VALUES (2, 'B', '1');
INSERT INTO espositori(id, nome, id_stanza) VALUES (3, 'A', '2');

INSERT INTO libri(id, ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES (1, '1111111111111', 'La compagnia dellanello', 1980, 5, 1, 1, 1);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (1, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (1, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (1, 3);

INSERT INTO libri(id, ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES (2, '2222222222222', 'Le due torri', 1985, 7, 1, 1, 1);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (2, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (2, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (2, 3);

INSERT INTO libri(id, ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES (3, '3333333333333', 'La pietra filosofale', 1997, 9, 2, 2, 2);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (3, 2);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (3, 1);

INSERT INTO libri(id, ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES (4, '4444444444444', 'La camera dei segreti', 1999, 8, 2, 2, 2);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (4, 2);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (4, 1);

INSERT INTO prestiti(id, id_libro, id_personale, id_utente, data_inizio, data_fine) VALUES (1, 1, 2, 1, 2018-01-16, 2018-02-15);
INSERT INTO prestiti(id, id_libro, id_personale, id_utente, data_inizio, data_fine) VALUES (2, 2, 2, 1, 2018-01-16, 2018-02-15);
INSERT INTO prestiti(id, id_libro, id_personale, id_utente, data_inizio, data_fine) VALUES (3, 4, 1, 2, 2018-01-14, 2018-02-13);