
-- CONNECTION: name=PostgreSQL - M2L

drop table categorie cascade;
drop table reservation cascade;
drop table bureau cascade;
drop table roles cascade;
drop table travail cascade;

create table travail
(
  idMembre      int4 not null,
  idMetier      int4 not null,
  idAssociation int4 not null,
  constraint travail_pk primary key (idMembre, idAssociation, idMetier),
  constraint travail_association_fk foreign key (idAssociation) references association (id),
  constraint travail_metier_fk foreign key (idMetier) references metier (id),
  constraint travail_membre_fk foreign key (idMembre) references membre (id)
);

INSERT INTO travail (idmembre,idmetier,idassociation) VALUES
	 (1,1,1),
	 (2,2,1),
	 (3,3,1),
	 (4,1,2),
	 (5,2,2),
	 (6,3,2),
	 (7,1,3),
	 (8,2,3),
	 (9,3,3),
	 (10,1,4);
INSERT INTO travail (idmembre,idmetier,idassociation) VALUES
	 (11,2,4),
	 (12,3,4),
	 (1,2,5),
	 (2,3,5),
	 (3,1,5),
	 (4,2,6),
	 (5,3,6),
	 (6,1,6);

CREATE TABLE bureau
(
id       int4 NOT NULL,
occupant int4 NULL,
CONSTRAINT bureau_pk PRIMARY KEY (id),
CONSTRAINT bureau_salle_fk FOREIGN KEY (id) REFERENCES salle (id),
constraint bureau_association_fk foreign key (occupant) references Ligue (id)
);

CREATE TABLE categorie
(
id      serial  NOT NULL,
libelle	varchar not null,
CONSTRAINT categorie_pk PRIMARY KEY (id)
);

CREATE TABLE sallereservable
(
id         int4 NOT NULL,
idcat	   int4 null,
CONSTRAINT sallereservable_pk PRIMARY KEY (id),
CONSTRAINT sallereservable_salle_fk FOREIGN KEY (id) REFERENCES salle (id),
CONSTRAINT sallereservable_categorie_fk FOREIGN KEY (idcat) REFERENCES categorie (id)
);

CREATE TABLE reservation
(
idReserv      serial not null,
idsalle       int4 NOT NULL,
idassociation int4 not null,
idMembre      int4 not null,
status        varchar not null,

justification varchar null,

CONSTRAINT reservation_pk PRIMARY KEY (idReserv),
CONSTRAINT reservation_fk FOREIGN KEY (idsalle) REFERENCES sallereservable (id),
CONSTRAINT reservation_fk_1 FOREIGN KEY (idassociation) REFERENCES Association (id),
CONSTRAINT reservation_fk_2 FOREIGN KEY (idMembre) REFERENCES Membre (id)
);

alter table utilisateur drop column idniveau;
alter table utilisateur add column roles json;
alter table comite add constraint comite_fk foreign key (idliguetravail) references Ligue (id);

insert into sallereservable values (1,13),(2,13),(3,13),(4,13),(5,13),(6,13),(7,13),(8,13),(11,14),(12,14);
