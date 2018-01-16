INSERT INTO autori (cognome, nome, data_nascita) VALUES ("Tolkien", "John Ronald Reuel", "1892-01-03");
INSERT INTO autori (cognome, nome, data_nascita) VALUES ("Rowling", "Joanne", "1965-07-31");

INSERT INTO casa_editrice (nome) VALUES ("Mondadori");
INSERT INTO casa_editrice (nome) VALUES ("Zanichelli");

INSERT INTO collana (nome, descrizione) VALUES ("Il Signore degli Anelli", "Romanzo fantasy ambientato nella terra di mezzo. Parla di un Hobbit che deve distruggere un anello per portare la pace.");
INSERT INTO collana (nome, descrizione) VALUES ("Harry Potter", "Ogni libro della serie rappresenta un anno nella vita di Harry dagli undici ai diciassette anni; i libri descrivono ogni anno scolastico trascorso nella scuola di magia e stregoneria di Hogwarts.");

INSERT INTO generi (nome) VALUES ("Fantasy");
INSERT INTO generi (nome) VALUES ("Giallo");
INSERT INTO generi (nome) VALUES ("Avventura");

INSERT INTO personale (cognome, nome, data_nascita) VALUES ("Rossi", "Mario", "1980-01-01");
INSERT INTO personale (cognome, nome, data_nascita) VALUES ("Fabbri", "Matteo", "1996-05-04");

INSERT INTO utenti (cognome, nome, data_nascita, citta, indirizzo) VALUES ("Cortesi", "Emanuele", "1996-09-30", "Bagnacavallo (RA)", "via aaa 1");
INSERT INTO utenti (cognome, nome, data_nascita, citta, indirizzo) VALUES ("Capucci", "Fabio", "1996-01-16", "Fusignano (RA)", "via bbb 2");

INSERT INTO stanze(nome) VALUES ('Per ragazzi');
INSERT INTO stanze(nome) VALUES ('Per studenti');

INSERT INTO espositori(nome, id_stanza) VALUES ('A', '1');
INSERT INTO espositori(nome, id_stanza) VALUES ('B', '1');
INSERT INTO espositori(nome, id_stanza) VALUES ('A', '2');

INSERT INTO libri(ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES ('1111111111111', 'La compagnia dellanello', 1980, 5, 1, 1, 1);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (1, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (1, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (1, 3);

INSERT INTO libri(ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES ('2222222222222', 'Le due torri', 1985, 7, 1, 1, 1);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (2, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (2, 1);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (2, 3);

INSERT INTO libri(ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES ('3333333333333', 'La pietra filosofale', 1997, 9, 2, 2, 2);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (3, 2);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (3, 1);

INSERT INTO libri(ISBN, titolo, anno_pubblicazione, quantita, id_editore, id_collana, id_espositore)
VALUES ('4444444444444', 'La camera dei segreti', 1999, 8, 2, 2, 2);
INSERT INTO libri_autori(id_libro, id_autore) VALUES (4, 2);
INSERT INTO libri_generi(id_libro, id_genere) VALUES (4, 1);

INSERT INTO prestiti(id_libro, id_personale, id_utente, data_inizio, data_fine) VALUES (1, 2, 1, 2018-01-16, 2018-02-15);
INSERT INTO prestiti(id_libro, id_personale, id_utente, data_inizio, data_fine) VALUES (2, 2, 1, 2018-01-16, 2018-02-15);
INSERT INTO prestiti(id_libro, id_personale, id_utente, data_inizio, data_fine) VALUES (4, 1, 2, 2018-01-14, 2018-02-13);