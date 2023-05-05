-- lapoele.batiment definition

-- Drop table

-- DROP TABLE batiment;

CREATE TABLE batiment (
	id serial NOT NULL,
	nom varchar NULL,
	CONSTRAINT batiment_pk PRIMARY KEY (id)
);


-- lapoele.categorie definition

-- Drop table

-- DROP TABLE categorie;

CREATE TABLE categorie (
	id serial NOT NULL,
	libelle varchar NOT NULL,
	tarif float8 NULL,
	CONSTRAINT categorie_pk PRIMARY KEY (id)
);


-- lapoele.discipline definition

-- Drop table

-- DROP TABLE discipline;

CREATE TABLE discipline (
	id serial NOT NULL,
	libelle varchar NOT NULL,
	olympique varchar NOT NULL,
	CONSTRAINT discipline_pk PRIMARY KEY (id)
);


-- lapoele.metier definition

-- Drop table

-- DROP TABLE metier;

CREATE TABLE metier (
	id serial NOT NULL,
	nom varchar NOT NULL,
	CONSTRAINT metier_pk PRIMARY KEY (id)
);


-- lapoele.personne definition

-- Drop table

-- DROP TABLE personne;

CREATE TABLE personne (
	id serial NOT NULL,
	nom varchar NOT NULL,
	prenom varchar NOT NULL,
	mail varchar NOT NULL,
	adresse varchar NULL,
	tel varchar NULL,
	"type" varchar NULL,
	CONSTRAINT personne_pk PRIMARY KEY (id)
);


-- lapoele.association definition

-- Drop table

-- DROP TABLE association;

CREATE TABLE association (
	id serial NOT NULL,
	iddiscipline int4 NOT NULL,
	nom varchar NOT NULL,
	adresse varchar NOT NULL,
	cddepartement int4 NOT NULL,
	tel varchar NULL,
	email varchar NULL,
	logo varchar NULL,
	"type" varchar NULL,
	CONSTRAINT association_pk PRIMARY KEY (id),
	CONSTRAINT association_discipline_fk FOREIGN KEY (iddiscipline) REFERENCES discipline(id)
);


-- lapoele.etage definition

-- Drop table

-- DROP TABLE etage;

CREATE TABLE etage (
	id serial NOT NULL,
	numero int2 NOT NULL,
	batiment int4 NOT NULL,
	CONSTRAINT etage_pk PRIMARY KEY (id),
	CONSTRAINT etage_un UNIQUE (numero, batiment),
	CONSTRAINT etage_batiment_fk FOREIGN KEY (batiment) REFERENCES batiment(id)
);


-- lapoele.ligue definition

-- Drop table

-- DROP TABLE ligue;

CREATE TABLE ligue (
	id int4 NOT NULL,
	CONSTRAINT ligue_pk PRIMARY KEY (id),
	CONSTRAINT ligue_association_fk FOREIGN KEY (id) REFERENCES association(id)
);


-- lapoele.salle definition

-- Drop table

-- DROP TABLE salle;

CREATE TABLE salle (
	id serial NOT NULL,
	nom varchar NULL,
	situation int4 NULL,
	"type" varchar NULL,
	CONSTRAINT salle_pk PRIMARY KEY (id),
	CONSTRAINT salle_etage_fk FOREIGN KEY (situation) REFERENCES etage(id)
);


-- lapoele.sallereservable definition

-- Drop table

-- DROP TABLE sallereservable;

CREATE TABLE sallereservable (
	id int4 NOT NULL,
	idcat int4 NULL,
	CONSTRAINT sallereservable_pk PRIMARY KEY (id),
	CONSTRAINT sallereservable_categorie_fk FOREIGN KEY (idcat) REFERENCES categorie(id),
	CONSTRAINT sallereservable_salle_fk FOREIGN KEY (id) REFERENCES salle(id)
);


-- lapoele.travail definition

-- Drop table

-- DROP TABLE travail;

CREATE TABLE travail (
	idpersonne int4 NOT NULL,
	idmetier int4 NOT NULL,
	idassociation int4 NOT NULL,
	CONSTRAINT travail_pk PRIMARY KEY (idpersonne, idassociation, idmetier),
	CONSTRAINT travail_association_fk FOREIGN KEY (idassociation) REFERENCES association(id),
	CONSTRAINT travail_metier_fk FOREIGN KEY (idmetier) REFERENCES metier(id),
	CONSTRAINT travail_personne_fk FOREIGN KEY (idpersonne) REFERENCES personne(id)
);


-- lapoele.utilisateur definition

-- Drop table

-- DROP TABLE utilisateur;

CREATE TABLE utilisateur (
	id int4 NOT NULL,
	pseudonyme varchar NOT NULL,
	"password" varchar NOT NULL,
	roles json NULL,
	CONSTRAINT utilisateur_pk PRIMARY KEY (id),
	CONSTRAINT utilisateur_mail_fk FOREIGN KEY (id) REFERENCES personne(id)
);


-- lapoele.bureau definition

-- Drop table

-- DROP TABLE bureau;

CREATE TABLE bureau (
	id int4 NOT NULL,
	occupant int4 NULL,
	CONSTRAINT bureau_pk PRIMARY KEY (id),
	CONSTRAINT bureau_association_fk FOREIGN KEY (occupant) REFERENCES association(id),
	CONSTRAINT bureau_salle_fk FOREIGN KEY (id) REFERENCES salle(id)
);


-- lapoele.comite definition

-- Drop table

-- DROP TABLE comite;

CREATE TABLE comite (
	id int4 NOT NULL,
	idliguetravail int4 NULL,
	CONSTRAINT comite_pk PRIMARY KEY (id),
	CONSTRAINT comite_association_fk FOREIGN KEY (id) REFERENCES association(id),
	CONSTRAINT comite_fk FOREIGN KEY (idliguetravail) REFERENCES ligue(id)
);


-- lapoele.reservation definition

-- Drop table

-- DROP TABLE reservation;

CREATE TABLE reservation (
	idreserv serial NOT NULL,
	idsalle int4 NOT NULL,
	idassociation int4 NOT NULL,
	idpersonne int4 NOT NULL,
	datedebut date NOT NULL,
	datefin date NULL,
	status varchar NOT NULL,
	justification varchar NULL,
	CONSTRAINT reservation_pk PRIMARY KEY (idreserv),
	CONSTRAINT reservation_fk_1 FOREIGN KEY (idassociation) REFERENCES association(id),
	CONSTRAINT reservation_fk_2 FOREIGN KEY (idpersonne) REFERENCES personne(id),
	CONSTRAINT reservation_fk_3 FOREIGN KEY (idsalle) REFERENCES salle(id)
);