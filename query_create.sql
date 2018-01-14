CREATE TABLE collane (
  id          INT          NOT NULL AUTO_INCREMENT,
  nome        VARCHAR(255) NOT NULL,
  descrizione TEXT         NULL,
  PRIMARY KEY (id)
);

CREATE TABLE casa_editrice (
  id   INT          NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE autori (
  id           INT          NOT NULL AUTO_INCREMENT,
  cognome      VARCHAR(100) NOT NULL,
  nome         VARCHAR(100) NOT NULL,
  data_nascita DATE         NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE generi (
  id   INT         NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE libri (
  id         INT          NOT NULL AUTO_INCREMENT,
  ISBN       VARCHAR(13)  NOT NULL,
  titolo     VARCHAR(100) NOT NULL,
  quantita    INT          NOT NULL,
  id_editore INT          NOT NULL,
  id_collana INT          NULL     DEFAULT NULL,
  cancellato BOOLEAN      NOT NULL DEFAULT FALSE,
  PRIMARY KEY (id),
  FOREIGN KEY (id_editore) REFERENCES casa_editrice (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_collana) REFERENCES collane (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
);

CREATE TABLE libri_autori (
  id_libro  INT NOT NULL,
  id_autore INT NOT NULL,
  PRIMARY KEY (id_autore, id_libro),
  FOREIGN KEY (id_autore) REFERENCES autori (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_libro) REFERENCES libri (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
);

CREATE TABLE libri_generi (
  id_libro  INT NOT NULL,
  id_genere INT NOT NULL,
  PRIMARY KEY (id_genere, id_libro),
  FOREIGN KEY (id_libro) REFERENCES libri (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_genere) REFERENCES generi (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
);

CREATE TABLE personale (
  id           INT          NOT NULL AUTO_INCREMENT,
  cognome      VARCHAR(100) NOT NULL,
  nome         VARCHAR(100) NOT NULL,
  data_nascita DATE         NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE utenti (
  id           INT          NOT NULL AUTO_INCREMENT,
  cognome      VARCHAR(100) NOT NULL,
  nome         VARCHAR(100) NOT NULL,
  data_nascita DATE         NOT NULL,
  citta        VARCHAR(50)  NOT NULL,
  indirizzo    VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE prestiti (
  id           INT      NOT NULL AUTO_INCREMENT,
  id_libro     INT      NOT NULL,
  id_personale INT      NOT NULL,
  id_utente    INT      NOT NULL,
  data_inizio  DATETIME NOT NULL,
  data_fine    DATETIME NOT NULL,
  restituito   BOOLEAN  NOT NULL DEFAULT FALSE,
  PRIMARY KEY (id),
  FOREIGN KEY (id_libro) REFERENCES libri (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_personale) REFERENCES personale (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_utente) REFERENCES utenti (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
);

CREATE TABLE posizioni_libri (
  id_libro   INT         NOT NULL,
  stanza     VARCHAR(20) NOT NULL,
  espositore VARCHAR(20) NOT NULL,
  ripiano    VARCHAR(20) NOT NULL,
  PRIMARY KEY (id_libro),
  FOREIGN KEY (id_libro) REFERENCES libri (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
);