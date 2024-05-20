drop table if exists SPECIALITE;
drop table if exists MEDECIN;
drop table if exists PHARMACIE;
drop table if exists ORDONNANCE;
drop table if exists MEDICAMENT;
drop table if exists ORDMED;
drop table if exists ORDPHAR;
/*==============================================================*/
/* Table : SPECIALITE                                               */
/*==============================================================*/
create table SPECIALITE
(
   ID_SPECIALITE		int(2) not null AUTO_INCREMENT,
   LIBELLE				varchar(50),
   primary key (ID_SPECIALITE)
)ENGINE=InnoDB CHARACTER SET utf8;

/*==============================================================*/
/* Table : MEDECIN                                               */
/*==============================================================*/
create table MEDECIN
(
   ID_MEDECIN			int(4) not null AUTO_INCREMENT,
   MAIL					varchar(30),
   PASS					varchar(20),
   NOM					varchar(20),
   PRENOM				varchar(20),
   ID_SPECIALITE		int(2) not null,
   primary key (ID_MEDECIN)
)ENGINE=InnoDB CHARACTER SET utf8;

/*==============================================================*/
/* Table : PHARMACIE                                               */
/*==============================================================*/
create table PHARMACIE
(
   ID_PHARMACIE			int(4) not null AUTO_INCREMENT,
   MAIL					varchar(30),
   PASS					varchar(20),
   NOM					varchar(40),
   GERANT				varchar(40),
   ADDRESS				text,
   primary key (ID_PHARMACIE)
)ENGINE=InnoDB CHARACTER SET utf8;

/*==============================================================*/
/* Table : ORDONNANCE                                               */
/*==============================================================*/
create table ORDONNANCE
(
   ID_ORDONNANCE		int(4) not null AUTO_INCREMENT,
   NOM					varchar(20),
   PRENOM				varchar(20),
   AGE					decimal(3),
   DATE_ORD				datetime,
   ETAT					varchar(1),
   ID_MEDECIN			int(4) not null,
   primary key (ID_ORDONNANCE)
)ENGINE=InnoDB CHARACTER SET utf8;

/*==============================================================*/
/* Table : MEDICAMENT                                               */
/*==============================================================*/
create table MEDICAMENT
(
   ID_MEDICAMENT		int(4) not null AUTO_INCREMENT,
   LIBELLE				varchar(40),
   DOSAGE				varchar(20),
   primary key (ID_MEDICAMENT)
)ENGINE=InnoDB CHARACTER SET utf8;

/*==============================================================*/
/* Table : ORDMED                                               */
/*==============================================================*/
create table ORDMED
(
   ID_ORDMED			int(4) not null AUTO_INCREMENT,
   ID_ORDONNANCE		int(4) not null,
   ID_MEDICAMENT		int(4) not null,
   primary key (ID_ORDMED)
)ENGINE=InnoDB CHARACTER SET utf8;

/*==============================================================*/
/* Table : ORDPHAR                                               */
/*==============================================================*/
create table ORDPHAR
(
   ID_ORDPHAR			int(4) not null AUTO_INCREMENT,
   ID_ORDONNANCE		int(4) not null,
   ID_PHARMACIE			int(4) not null,
   primary key (ID_ORDPHAR)
)ENGINE=InnoDB CHARACTER SET utf8;

/*============================== ASSOCIATION================================*/
alter table MEDECIN add constraint FK_Association_specialite foreign key (ID_SPECIALITE)
      references SPECIALITE (ID_SPECIALITE) on delete restrict on update CASCADE;

alter table ORDONNANCE add constraint FK_Association_medecin foreign key (ID_MEDECIN)
      references MEDECIN (ID_MEDECIN) on delete restrict on update CASCADE;

alter table ORDMED add constraint FK_Association_ordmed1 foreign key (ID_ORDONNANCE)
      references ORDONNANCE (ID_ORDONNANCE) on delete restrict on update CASCADE;
	  
alter table ORDMED add constraint FK_Association_ordmed2 foreign key (ID_MEDICAMENT)
      references MEDICAMENT (ID_MEDICAMENT) on delete restrict on update CASCADE;

alter table ORDPHAR add constraint FK_Association_ordphar1 foreign key (ID_ORDONNANCE)
      references ORDONNANCE (ID_ORDONNANCE) on delete restrict on update CASCADE;
	  
alter table ORDPHAR add constraint FK_Association_ordphar2 foreign key (ID_PHARMACIE)
      references PHARMACIE (ID_PHARMACIE) on delete restrict on update CASCADE;
	  
/*============================== DATA ================================*/
INSERT INTO `medcare`.`medicament` (`ID_MEDICAMENT`, `LIBELLE`, `DOSAGE`) VALUES (NULL, 'DOLIPRANE', '500mg'),(NULL, 'DOLIPRANE', '1000mg'),(NULL, 'EFFERALGAN', '500mg'),(NULL, 'DAFALGAN', '500mg'),(NULL, 'LEVOTHYROX', '200µg'),(NULL, 'IMODIUM', '1mg'),(NULL, 'IMODIUM', '2mg'),(NULL, 'SPASFON', '10mg');
INSERT INTO `medcare`.`specialite` (`ID_SPECIALITE`, `LIBELLE`) VALUES (NULL, 'Generaliste'),(NULL, 'O R L'),(NULL, 'Dontiste'),(NULL, 'Pédiatre');