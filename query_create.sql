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

CREATE TABLE classificazioni (
  id   INT(3)      NOT NULL,
  nome VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE stanze (
  id   INT         NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE libri (
  id                 INT          NOT NULL AUTO_INCREMENT,
  ISBN               VARCHAR(13)  NOT NULL,
  titolo             VARCHAR(100) NOT NULL,
  anno_pubblicazione YEAR         NOT NULL,
  quantita           INT          NOT NULL,
  id_editore         INT          NOT NULL,
  id_collana         INT          NULL     DEFAULT NULL,
  id_espositore      INT          NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_editore) REFERENCES casa_editrice (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_collana) REFERENCES collane (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  FOREIGN KEY (id_espositore) REFERENCES stanze (id)
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
  id           INT     NOT NULL AUTO_INCREMENT,
  id_libro     INT     NOT NULL,
  id_personale INT     NOT NULL,
  id_utente    INT     NOT NULL,
  data_inizio  DATE    NOT NULL,
  data_fine    DATE    NOT NULL,
  restituito   BOOLEAN NOT NULL DEFAULT FALSE,
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

CREATE TABLE espositori (
  id        INT         NOT NULL AUTO_INCREMENT,
  nome      VARCHAR(50) NOT NULL,
  id_stanza INT         NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_stanza) REFERENCES stanze (id)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
);

