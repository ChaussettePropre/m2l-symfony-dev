create or replace function unSeulPresident() returns trigger as
$$
	declare
		nbPresident integer;
	begin 
		select into nbPresident count(idpersonne) from travail t0 where idassociation = new.idassociation and idmetier = 1;
		if nbPresident = 0 then 
			return new ;
		end if;
	    if nbPresident = 1 and new.idmetier != 1 then
			return new ;
		end if;
		return null;
	end;
$$
language 'plpgsql';

select count(idpersonne) from travail  where idassociation = 1 and idmetier = 1;

create trigger trig_unSeulPresident before update or insert on travail
	for each row
	execute procedure unSeulPresident();

---- Tests ----

-- Setup --
insert into association(id,iddiscipline,nom,adresse,cddepartement) values (99999,2,'SETUP TEST TRIGGER','SETUP TEST TRIGGER','99999' );
insert into personne(id,nom, prenom, mail) values (99999,'SETUP TEST','PREMIERPRESIDENT','TRIGGER UNSEULPRESIDENT');
insert into personne(id,nom, prenom, mail) values (100000,'SETUP TEST','SECONDPRESIDENT','TRIGGER UNSEULPRESIDENT');

-- Test --

--> vérification setup, doit afficher 0
select count(idpersonne) from travail  where idassociation = 99999 and idmetier = 1;

--> ajout premier président
insert into travail values (99999,1,99999);
--> doit afficher 1
select count(idpersonne) from travail  where idassociation = 99999 and idmetier = 1;

--> ajout second président
insert into travail values (100000,1,99999);
-- doit toujours afficher 1
select count(idpersonne) from travail  where idassociation = 99999 and idmetier = 1;

--> tentative d'update pour mettre le second president
-- ajout à un autre poste de travail (permet aussi de vérifier que la fonction ne bloque pas les ajouts d'autres membres que president)
insert into travail values (100000,2,99999);
-- update second président
update travail set idmetier = 1 where idpersonne = 100000 and idassociation = 99999;
-- doit toujours afficher 1
select count(idpersonne) from travail  where idassociation = 99999 and idmetier = 1;

-- Suppression des tests --
delete from travail where idmetier = 1 and idassociation =99999 and idpersonne = 99999 or idmetier = 2 and idassociation =99999 and idpersonne = 100000;
delete from personne where id = 99999 or id = 100000;
delete from association where id = 99999;

