--une association ne peut pas résserver plus de 2salles dans la même journée;
CREATE or replace FUNCTION max_reserv_jour() RETURNS TRIGGER AS
$$
declare
nbreserv integer;
begin
select into nbreserv count(reservation.idassociation)from reservation
where reservation.idassociation = new.idassociation and
    new.datefin>=datefin and
    new.datedebut<=datedebut
   or
    reservation.idassociation = new.idassociation and
    new.datefin<=datefin and
    new.datedebut>=datedebut
   or
    reservation.idassociation = new.idassociation and
    new.datefin>=datefin and
    new.datedebut>=datedebut and
    new.datefin<=datedebut and
    new.datedebut>=datefin
   or
    reservation.idassociation = new.idassociation and
    new.datefin<=datefin and
    new.datedebut<=datedebut and
    new.datefin>=datedebut and
    new.datedebut<=datefin
   or
    reservation.idassociation = new.idassociation and
    new.datefin>=datefin and
    new.datedebut<=datedebut and
    new.datefin>=datedebut and
    new.datedebut<=datefin
;

if nbreserv < 2 then
		return new ;
end if;
return null ;
end;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER tring_nombre_reserv_max BEFORE insert or update ON reservation
                                                            FOR EACH ROW
                                                            execute procedure max_reserv_jour();




insert into reservation (idreserv, idsalle, idassociation, idpersonne, datedebut, datefin, status)
values  (45,10,4,1,'2021-01-01','2021-01-03','En cours de traitement'),
        (46,10,4,1,'2021-01-01','2021-01-03','En cours de traitement');

insert into reservation (idreserv, idsalle, idassociation, idpersonne, datedebut, datefin, status)
values  (47,10,4,1,'2021-01-01','2021-01-02','En cours de traitement'),
        (48,10,4,1,'2021-01-02','2021-01-03','En cours de traitement'),
        (49,10,4,1,'2020-12-31','2021-01-02','En cours de traitement'),
        (50,10,4,1,'2021-01-02','2021-01-04','En cours de traitement'),
        (51,10,4,1,'2020-12-02','2021-01-04','En cours de traitement');

(7,9,4,1,'2021-01-01','2021-01-03','En cours de traitement'),


DELETE FROM reservation
WHERE idreserv =46 or idreserv =50;