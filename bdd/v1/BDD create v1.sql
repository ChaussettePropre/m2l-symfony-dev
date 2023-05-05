drop table sallereservable cascade;
drop table categorie cascade;
drop table reservation cascade;

/*CREATE TABLE bureau
(
id       int4 NOT NULL,
occupant int4 NULL,
CONSTRAINT bureau_pk PRIMARY KEY (id),
CONSTRAINT bureau_salle_fk FOREIGN KEY (id) REFERENCES salle (id),
constraint bureau_association_fk foreign key (occupant) references association (id)
);*/

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
CONSTRAINT reservation_pk PRIMARY KEY (idReserv),
CONSTRAINT reservation_fk FOREIGN KEY (idsalle) REFERENCES sallereservable (id),
CONSTRAINT reservation_fk_1 FOREIGN KEY (idassociation) REFERENCES association (id)
);

alter table utilisateur drop column idniveau;
alter table utilisateur add column roles json;
