--une ligue ne peut pas être attribuer a plus de 2 bureaux à la fois;
   
   create or replace FUNCTION maxbureaux() RETURNS TRIGGER AS
$$
    DECLARE
        nbbureaux integer;
    BEGIN
        select into nbbureaux count(occupant)
        from bureau  
        where occupant=new.occupant;
        if (nbbureaux>=2) then
        return null;
        end if;
        return new;
    END;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER trig_max_bureaux BEFORE insert or update ON bureau
    FOR EACH ROW
    EXECUTE PROCEDURE maxbureaux();
   
   
   
   --max 2 bureaux pour une ligue
   
update bureau set occupant=1 where id=73;
update bureau set occupant=1 where id=75;
update bureau set occupant=1 where id=76;
update bureau set occupant=3 where id=29;

select count(occupant) from bureau 