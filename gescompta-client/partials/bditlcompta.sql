SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE balances (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  dateDebut date NOT NULL,
  dateFin date NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE charges (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelleCharge varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  montantCharge double(8,2) NOT NULL,
  dateCharge datetime NOT NULL,
  idFrs int(11) NOT NULL,
  refEcrit int(10) unsigned NOT NULL,
  numCompte int(10) unsigned NOT NULL,
  OnOff tinyint(1) NOT NULL,
  PRIMARY KEY (id),
  KEY idFrs (idFrs),
  KEY refEcrit (refEcrit,numCompte),
  KEY numCompte (numCompte)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE clients (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  numClient int(11) NOT NULL,
  adreesseClient varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  emailClient varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  codeClient varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  OnOff tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE comptes (
  id int(10) unsigned NOT NULL ,
  intituleCompte varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

CREATE TABLE ecritures (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelleEcrit varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  dateEcrit datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  montant int(11) NOT NULL,
  commentaire varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  mois int(11) NOT NULL,
  pieces varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  OnOff tinyint(1) NOT NULL,
  idTypeEcrit int(10) unsigned NOT NULL,
  idJournal int(10) unsigned NOT NULL,
  numCompte int(10) unsigned NOT NULL,
  idUser int(10) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY idTypeEcrit (idTypeEcrit),
  KEY numCompte (numCompte),
  KEY idJournal (idJournal),
  KEY idTypeEcrit_2 (idTypeEcrit),
  KEY idUser (idUser)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE exercices (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  anneeExo varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  libelleExo varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  OnOff tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE fournisseurs (
  IdFrs int(11) NOT NULL AUTO_INCREMENT,
  nomFrs varchar(50) NOT NULL,
  prenomFrs varchar(50) NOT NULL,
  telFrs int(11) NOT NULL,
  adresseFrs varchar(100) NOT NULL,
  emailFrs varchar(100) NOT NULL,
  PRIMARY KEY (IdFrs)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE grandlivres (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  dateDebut date NOT NULL,
  dateFin date NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE journals (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nomJournal varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  codeJournal varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  dateDebut date NOT NULL,
  dateFin date NOT NULL,
  idExo int(11) unsigned DEFAULT NULL,
  cloture int(1) NOT NULL,
  OnOff tinyint(1) NOT NULL,
  PRIMARY KEY (id),
  KEY idExo (idExo)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

CREATE TABLE operations (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelleOpe varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  dateOpe datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE personnemorales (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  denomination varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  adresseClient varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  numClient int(15) NOT NULL,
  emailClient varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  OnOff int(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

CREATE TABLE personnephysiques (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nom varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  prenom varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  numClient int(15) NOT NULL,
  adresseClient varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  emailClient varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  OnOff int(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

CREATE TABLE projets (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelleProjet varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  dateOuverture date NOT NULL,
  dateDebut date NOT NULL,
  dateFin date NOT NULL,
  montantProjet int(11) NOT NULL,
  dateLivraison date NOT NULL,
  idClientP int(11) unsigned NOT NULL,
  idClientM int(11) unsigned NOT NULL,
  livrer int(11) NOT NULL,
  OnOff tinyint(1) NOT NULL,
  PRIMARY KEY (id),
  KEY idClientP (idClientP),
  KEY idClientM (idClientM),
  KEY idClientM_2 (idClientM)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE reglements (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelleReglemt varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  montantReglemt int(11) NOT NULL,
  dateReglemt date NOT NULL,
  idProjet int(11) unsigned NOT NULL,
  idClient int(11) unsigned NOT NULL,
  idTypeReglement int(11) unsigned NOT NULL,
  idEcrit int(11) unsigned NOT NULL,
  OnOff tinyint(1) NOT NULL,
  PRIMARY KEY (id),
  KEY idClient (idClient),
  KEY idProjet (idProjet),
  KEY idClient_2 (idClient),
  KEY idTypeReglement (idTypeReglement),
  KEY idEcrit (idEcrit)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE typeecritures (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelletypeEcrit varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE typereglements (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  libelleTypeReglemt varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE typeusers (
  idTypeUser int(1) unsigned NOT NULL AUTO_INCREMENT,
  libelleTypeUser varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (idTypeUser)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE utilisateurs (
  idUser int(10) unsigned NOT NULL AUTO_INCREMENT,
  image varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  nom varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  prenom varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  login varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  email varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  actif tinyint(1) NOT NULL DEFAULT '1',
  OnOff tinyint(1) NOT NULL DEFAULT '1',
  idTypeUser int(11) unsigned NOT NULL,
  PRIMARY KEY (idUser),
  UNIQUE KEY utilisateurs_login_unique (login),
  UNIQUE KEY utilisateurs_email_unique (email),
  KEY idTypeUser (idTypeUser),
  KEY idTypeUser_2 (idTypeUser)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


ALTER TABLE charges
  ADD CONSTRAINT charges_ibfk_3 FOREIGN KEY (numCompte) REFERENCES comptes (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT charges_ibfk_1 FOREIGN KEY (idFrs) REFERENCES fournisseurs (IdFrs) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT charges_ibfk_2 FOREIGN KEY (refEcrit) REFERENCES ecritures (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ecritures
  ADD CONSTRAINT ecritures_ibfk_3 FOREIGN KEY (idUser) REFERENCES utilisateurs (idUser) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT ecritures_ibfk_1 FOREIGN KEY (idTypeEcrit) REFERENCES typeecritures (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT ecritures_ibfk_4 FOREIGN KEY (idJournal) REFERENCES journals (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT ecritures_ibfk_2 FOREIGN KEY (numCompte) REFERENCES comptes (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE journals
  ADD CONSTRAINT journals_ibfk_1 FOREIGN KEY (idExo) REFERENCES exercices (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE projets
  ADD CONSTRAINT projets_ibfk_1 FOREIGN KEY (idClientP) REFERENCES personnephysiques (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT projets_ibfk_2 FOREIGN KEY (idClientM) REFERENCES personnemorales (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE reglements
  ADD CONSTRAINT reglements_ibfk_3 FOREIGN KEY (idEcrit) REFERENCES ecritures (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT reglements_ibfk_1 FOREIGN KEY (idProjet) REFERENCES projets (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT reglements_ibfk_2 FOREIGN KEY (idTypeReglement) REFERENCES typereglements (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE utilisateurs
  ADD CONSTRAINT utilisateurs_ibfk_1 FOREIGN KEY (idTypeUser) REFERENCES typeusers (idTypeUser) ON DELETE NO ACTION ON UPDATE NO ACTION,
