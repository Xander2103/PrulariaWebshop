-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 apr 2026 om 09:46
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prulariacom`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `createNieuweBestellingen` ()   begin
declare bestelIdValue int default 1;
declare bestellijnIdValue int default 1;
set bestelIdValue = (select max(bestelid) from Bestellingen);
set bestellijnIdValue = (select max(bestellijnId) from Bestellijnen);
insert into Bestellingen 
(bestelId, besteldatum, klantId, betaald, betaalwijzeId, bestellingsStatusId, actiecodeGebruikt, bedrijfsnaam, btwNummer, voornaam, familienaam, facturatieAdresId, leveringsAdresId) 
values 
(bestelIdValue + 1, adddate( adddate(current_date(), interval -3 day), interval + 8 hour), 1,1,2,2,0,'VDAB', '0887010362', 'Ad', 'Ministrateur', 1, 7),
(bestelIdValue + 2, adddate( adddate(current_date(), interval -3 day), interval + 9 hour), 2,1,2,2,0,null, null, 'Alpha', 'Klant', 2, 2),
(bestelIdValue + 3, adddate( adddate(current_date(), interval -3 day), interval + 10 hour), 3,1,2,2,0,null, null, 'Beta', 'Client', 3, 3),
(bestelIdValue + 4, adddate( adddate(current_date(), interval -3 day), interval + 11 hour), 4,1,2,1,0,null, null, 'Gamma', 'Customer', 4, 4),
(bestelIdValue + 5, adddate( adddate(current_date(), interval -3 day), interval + 12 hour), 5,1,3,1,1,null, null, 'Delta', 'Kunde', 5, 5),
(bestelIdValue + 6, adddate( adddate(current_date(), interval -2 day), interval + 9 hour), 1,1,2,2,0,'VDAB', '0887010362', 'Ad', 'Ministrateur', 1, 7),
(bestelIdValue + 7, adddate( adddate(current_date(), interval -2 day), interval + 10 hour), 2,1,2,2,0,null, null, 'Alpha', 'Klant', 2, 2),
(bestelIdValue + 8, adddate( adddate(current_date(), interval -2 day), interval + 11 hour), 3,1,2,2,0,null, null, 'Beta', 'Client', 3, 3),
(bestelIdValue + 9, adddate( adddate(current_date(), interval -2 day), interval + 12 hour), 4,1,2,1,0,null, null, 'Gamma', 'Customer', 4, 4),
(bestelIdValue + 10, adddate( adddate(current_date(), interval -2 day), interval + 13 hour), 5,1,3,1,1,null, null, 'Delta', 'Kunde', 5, 5),
(bestelIdValue + 11, adddate( adddate(current_date(), interval -1 day), interval + 8 hour), 1,1,2,2,0,'VDAB', '0887010362', 'Ad', 'Ministrateur', 1, 7),
(bestelIdValue + 12, adddate( adddate(current_date(), interval -1 day), interval + 9 hour), 2,1,2,2,0,null, null, 'Alpha', 'Klant', 2, 2),
(bestelIdValue + 13, adddate( adddate(current_date(), interval -1 day), interval + 10 hour), 3,1,2,2,0,null, null, 'Beta', 'Client', 3, 3),
(bestelIdValue + 14, adddate( adddate(current_date(), interval -1 day), interval + 11 hour), 4,1,2,1,0,null, null, 'Gamma', 'Customer', 4, 4),
(bestelIdValue + 15, adddate( adddate(current_date(), interval -1 day), interval + 12 hour), 5,1,3,1,1,null, null, 'Delta', 'Kunde', 5, 5),
(bestelIdValue + 16, adddate( adddate(current_date(), interval 5 hour), interval 30 minute), 1,1,3,2,0,'VDAB', '0887010362', 'Ad', 'Ministrateur', 1, 7),
(bestelIdValue + 17, adddate( adddate(current_date(), interval 6 hour), interval 15 minute), 2,1,2,2,0,null, null, 'Alpha', 'Klant', 2, 2),
(bestelIdValue + 18, adddate( adddate(current_date(), interval 7 hour), interval 30 minute), 3,1,2,2,0,null, null, 'Beta', 'Client', 3, 3),
(bestelIdValue + 19, adddate( adddate(current_date(), interval 8 hour), interval 10 minute), 4,1,2,1,0,null, null, 'Gamma', 'Customer', 4, 4),
(bestelIdValue + 20, adddate( adddate(current_date(), interval 8 hour), interval 15 minute), 5,0,1,1,1,null, null, 'Delta', 'Kunde', 5, 5);
update Bestellingen set betaald=0, betaalwijzeId=1, betalingscode='' where Bestellingen.bestellingsStatusId=1;
insert into Bestellijnen (bestellijnId, bestelid, artikelId, aantalBesteld) 
values 
(bestellijnIdValue + 1,bestelIdValue + 1,2,2),
(bestellijnIdValue + 2,bestelIdValue + 1,80,2), 
(bestellijnIdValue + 3,bestelIdValue + 1,89,1),
(bestellijnIdValue + 4,bestelIdValue + 1,118,2),
(bestellijnIdValue + 5,bestelIdValue + 2,4,4),
(bestellijnIdValue + 6,bestelIdValue + 2,23,1),
(bestellijnIdValue + 7,bestelIdValue + 3,33,1),
(bestellijnIdValue + 8,bestelIdValue + 3,21,1),
(bestellijnIdValue + 9,bestelIdValue + 4,1,1),
(bestellijnIdValue + 10,bestelIdValue + 4,29,1),
(bestellijnIdValue + 11,bestelIdValue + 4,65,1),
(bestellijnIdValue + 12,bestelIdValue + 4,172,1),
(bestellijnIdValue + 13,bestelIdValue + 4,173,1),
(bestellijnIdValue + 14,bestelIdValue + 4,174,1),
(bestellijnIdValue + 15,bestelIdValue + 5,76,1),
(bestellijnIdValue + 16,bestelIdValue + 5,83,1),
(bestellijnIdValue + 17,bestelIdValue + 5,86,1),
(bestellijnIdValue + 18,bestelIdValue + 5,112,1),
(bestellijnIdValue + 19,bestelIdValue + 5,126,1),
(bestellijnIdValue + 20,bestelIdValue + 5,138,1),
(bestellijnIdValue + 21,bestelIdValue + 6,23,1),
(bestellijnIdValue + 22,bestelIdValue + 7,24,1),
(bestellijnIdValue + 23,bestelIdValue + 8,25,1),
(bestellijnIdValue + 24,bestelIdValue + 9,26,1),
(bestellijnIdValue + 25,bestelIdValue + 10,27,1),
(bestellijnIdValue + 26,bestelIdValue + 11,4,6),
(bestellijnIdValue + 27,bestelIdValue + 12,5,6),
(bestellijnIdValue + 28,bestelIdValue + 13,6,6),
(bestellijnIdValue + 29,bestelIdValue + 14,7,6),
(bestellijnIdValue + 30,bestelIdValue + 15,8,6),
(bestellijnIdValue + 31,bestelIdValue + 16,46,1),
(bestellijnIdValue + 32,bestelIdValue + 17,47,1),
(bestellijnIdValue + 33,bestelIdValue + 18,48,1),
(bestellijnIdValue + 34,bestelIdValue + 19,49,1),
(bestellijnIdValue + 35,bestelIdValue + 20,49,1);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createNieuweInkomendeLeveringen1` ()   begin
declare leveringsIdValue int default 1;
set leveringsIdValue = (select max(inkomendeLeveringsId) from InkomendeLeveringen);
insert into InkomendeLeveringen
(inkomendeLeveringsId, leveranciersId, leveringsbonNummer, leveringsbondatum, leverDatum, ontvangerPersoneelslidId) 
values 
(leveringsIdValue + 1, 1, 
concat(year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,8),
adddate(adddate(current_date(), interval -1 day), interval + 8 hour), 
adddate(adddate(current_date(), interval -1 day), interval + 16 hour),4),
(leveringsIdValue + 2, 2, 
concat('L',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,9),
adddate(adddate(current_date(), interval -1 day), interval + 9 hour), 
adddate(current_date(), interval + 7 hour),4),
(leveringsIdValue + 3, 3, 
concat('Lbon',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,10),
adddate(adddate(current_date(), interval -1 day), interval + 10 hour), 
adddate(current_date(), interval + 7 hour),4),
(leveringsIdValue + 4, 4, 
concat('LB',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,11),
adddate(adddate(current_date(), interval -1 day), interval + 11 hour), 
adddate(current_date(), interval + 8 hour),4),
(leveringsIdValue + 5, 5, 
concat('Levering',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,12),
adddate(adddate(current_date(), interval -1 day), interval + 12 hour), 
adddate(current_date(), interval + 8 hour),4);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 1, 4, 6, 2, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 1, 5, 6, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 1, 23, 1, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 1, 24, 1, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 2, 218, 5, 1, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 2, 220, 5, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 2, 230, 5, 2, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 2, 234, 5, 1, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 161, 6, 1, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 162, 6, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 163, 6, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 164, 6, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 201, 5, 1, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 202, 5, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 3, 203, 5, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 4, 74, 1, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 4, 79, 1, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 4, 97, 2, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 4, 151, 10, 2, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 4, 259, 1, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 5, 1, 2, 0, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 5, 2, 5, 3, 0);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 5, 147, 2, 0, 0);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createNieuweInkomendeLeveringen2` ()   begin
declare leveringsIdValue int default 1;
set leveringsIdValue = (select max(inkomendeLeveringsId) from InkomendeLeveringen);
insert into InkomendeLeveringen 
(inkomendeLeveringsId, leveranciersId, leveringsbonNummer, leveringsbondatum, leverDatum, ontvangerPersoneelslidId) 
values 
(leveringsIdValue + 1, 1, 
concat(year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,16),
adddate(adddate(current_date(), interval -1 day), interval + 16 hour), 
adddate(adddate(current_date(), interval -1 day), interval + 20 hour),4),
(leveringsIdValue + 2, 2, 
concat('L',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,17),
adddate(adddate(current_date(), interval -1 day), interval + 17 hour), 
adddate(current_date(), interval + 10 hour),4),
(leveringsIdValue + 3, 3, 
concat('Lbon',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,18),
adddate(adddate(current_date(), interval -1 day), interval + 18 hour), 
adddate(current_date(), interval + 10 hour),4),
(leveringsIdValue + 4, 4, 
concat('LB',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,19),
adddate(adddate(current_date(), interval -1 day), interval + 19 hour), 
adddate(current_date(), interval + 11 hour),4),
(leveringsIdValue + 5, 5, 
concat('Levering',year(adddate(current_date(), interval -1 day)),'/',month(adddate(current_date(), interval -1 day)), day(adddate(current_date(), interval -1 day))-1,20),
adddate(adddate(current_date(), interval -1 day), interval + 20 hour), 
adddate(current_date(), interval + 11 hour),4);
insert into InkomendeLeveringsLijnen (inkomendeLeveringsId, artikelId, aantalGoedGekeurd, aantalTeruggestuurd,magazijnPlaatsId) 
values 
(leveringsIdValue + 1, 10, 6, 2, 0),
(leveringsIdValue + 1, 25, 1, 0, 0),
(leveringsIdValue + 1, 39, 2, 1, 0),
(leveringsIdValue + 1, 40, 2, 0, 0),
(leveringsIdValue + 2, 224, 5, 0, 0),
(leveringsIdValue + 2, 225, 3, 1, 0),
(leveringsIdValue + 2, 238, 3, 0, 0),
(leveringsIdValue + 3, 166, 6, 0, 0),
(leveringsIdValue + 3, 167, 6, 0, 0),
(leveringsIdValue + 3, 168, 6, 0, 0),
(leveringsIdValue + 3, 169, 6, 0, 0),
(leveringsIdValue + 3, 204, 5, 0, 0),
(leveringsIdValue + 3, 206, 5, 1, 0),
(leveringsIdValue + 3, 212, 5, 0, 0),
(leveringsIdValue + 4, 75, 2, 0, 0),
(leveringsIdValue + 4, 80, 2, 1, 0),
(leveringsIdValue + 4, 99, 0, 1, 0),
(leveringsIdValue + 4, 152, 10, 0, 0),
(leveringsIdValue + 4, 265, 1, 0, 0),
(leveringsIdValue + 5, 3, 5, 0, 0),
(leveringsIdValue + 5, 142, 2, 0, 0),
(leveringsIdValue + 5, 205, 3, 2, 0);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InkomendeLeveringElkeDagProcedure` ()   BEGIN
declare magazijnPlaatsIdValue int;
declare artikelIdValue int;
declare voorraadValue int;
declare maxAantalInMagazijnPlaatsValue int;
declare aantalInMagazijnPlaatsValue int;
insert into EventWachtrijArtikelen (artikelId, aantal, maxAantalInMagazijnPlaats) 
select artikelid, bestelpeil - voorraad, maxAantalInMagazijnPlaats 
from Artikelen 
where voorraad < minimumVoorraad and aantalBesteldLeverancier = 0;
insert into EventWachtrijArtikelen (artikelId, aantal, maxAantalInMagazijnPlaats) 
select artikelid, aantalBesteldLeverancier, maxAantalInMagazijnPlaats 
from Artikelen 
where voorraad < minimumVoorraad and aantalBesteldLeverancier > 0;
update Artikelen set voorraad = bestelpeil
where voorraad < minimumVoorraad and aantalBesteldLeverancier = 0 and artikelId>0;
update Artikelen set voorraad = voorraad + aantalBesteldLeverancier, aantalBesteldLeverancier = 0 
where voorraad < minimumVoorraad and aantalBesteldLeverancier > 0  and artikelId>0;
SET magazijnPlaatsIdValue = 1;
SET artikelIdValue=1;
WHILE ((magazijnPlaatsIdValue <= (select count(*) from MagazijnPlaatsen)) and (artikelIdValue <= (select count(*) from Artikelen))) DO
	SET voorraadValue = (select aantal from EventWachtrijArtikelen where artikelId=artikelIdValue);
	SET maxAantalInMagazijnPlaatsValue  = (select maxAantalInMagazijnPlaats from Artikelen where artikelId=artikelIdValue);
	WHILE (voorraadValue>0) and (magazijnPlaatsIdValue <= (select count(*) from MagazijnPlaatsen)) and 
          (artikelIdValue <= (select count(*) from Artikelen)) do
		  set aantalInMagazijnPlaatsValue = (select aantal from MagazijnPlaatsen where magazijnPlaatsId=magazijnPlaatsIdValue);
            if (aantalInMagazijnPlaatsValue=0) then
                select voorraadValue;
				if (voorraadValue < maxAantalInMagazijnPlaatsValue) then
					update MagazijnPlaatsen set artikelId=artikelIdValue, aantal=voorraadValue 
						where magazijnPlaatsId=magazijnPlaatsIdValue;
					set voorraadValue = 0;
				else
					update MagazijnPlaatsen set artikelId=artikelIdValue, aantal=maxAantalInMagazijnPlaatsValue 
                       where magazijnPlaatsId=magazijnPlaatsIdValue;
					set voorraadValue = voorraadValue - maxAantalInMagazijnPlaatsValue;            
				end if;
			end if;
            set  magazijnplaatsidValue = magazijnplaatsidValue + 1;          
        end while;
	set artikelidValue = artikelidValue + 1;
END WHILE;
delete from EventWachtrijArtikelen where artikelId>0;
END$$

--
-- Functies
--
CREATE DEFINER=`root`@`localhost` FUNCTION `geefMagazijnPlaats` (`artikelIdParameter` INT, `aantalParameter` INT) RETURNS INT(11) READS SQL DATA BEGIN
	DECLARE maxAantalValue INT;
	DECLARE plaatsIdValue INT;
    
	SET maxAantalValue = (select maxAantalInMagazijnPLaats from artikelen where artikelId = artikelIdParameter);
	SET plaatsIdValue = (select min(magazijnPlaatsId) from magazijnplaatsen 
                         where (artikelId is null) or (artikelId = artikelIdParameter and (aantal + aantalParameter) <= maxAantalValue));
	RETURN plaatsIdValue;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `genereerEan` (`id` INT) RETURNS VARCHAR(13) CHARSET utf8 COLLATE utf8_general_ci DETERMINISTIC begin
	declare eanValue varchar(13);
    declare i int default 1;
    declare cs int default 0;
    set eanValue = concat('5499999', lpad(id, 5, '0'));
    while (i <= 11) do
		set cs = cs + convert (substr(eanValue, i, 1), unsigned);
        set i = i + 2;
    end while;
    set i= 2; 
    while (i <= 12) do
		set cs = cs + (convert (substr(eanValue, i, 1), unsigned) * 3);
        set i = i + 2;
    end while;
    set eanValue = concat(eanValue,convert((10 - (cs mod 10)) mod 10, char));
    return eanValue;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `actiecodes`
--

CREATE TABLE `actiecodes` (
  `actiecodeId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `geldigVanDatum` date NOT NULL,
  `geldigTotDatum` date NOT NULL,
  `isEenmalig` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `actiecodes`
--

INSERT INTO `actiecodes` (`actiecodeId`, `naam`, `geldigVanDatum`, `geldigTotDatum`, `isEenmalig`) VALUES
(1, 'Nieuwjaar', '2026-12-30', '2027-01-05', 0),
(2, 'Wintersolden', '2027-01-04', '2027-01-19', 0),
(3, 'ExtraWinterSolden', '2027-01-20', '2027-01-30', 0),
(4, 'Valentijn', '2027-02-11', '2027-02-18', 0),
(5, 'Lentekoopjes', '2027-01-20', '2027-01-30', 0),
(6, 'VoorjaarsKoopjes', '2026-05-01', '2026-05-15', 0),
(7, 'Zomersolden', '2026-07-03', '2026-07-19', 0),
(8, 'ExtraZomersolden', '2026-07-20', '2026-08-01', 0),
(9, 'NajaarsKoopjes', '2026-11-01', '2026-11-15', 0),
(10, 'VerjaardagPrularia', '2026-12-17', '2026-12-22', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adressen`
--

CREATE TABLE `adressen` (
  `adresId` int(11) NOT NULL,
  `straat` varchar(100) NOT NULL,
  `huisNummer` varchar(5) NOT NULL,
  `bus` varchar(5) DEFAULT NULL,
  `plaatsId` int(11) NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `adressen`
--

INSERT INTO `adressen` (`adresId`, `straat`, `huisNummer`, `bus`, `plaatsId`, `actief`) VALUES
(1, 'Keizerslaan', '11', '', 381, 1),
(2, 'Interleuvenlaan', '2', '', 1037, 1),
(3, 'Somersstraat', '22', '', 62, 1),
(4, 'T2 Campus, Thor Park', '11', '', 790, 1),
(5, 'Vlamingenstraat', '10', '', 2657, 1),
(6, 'Industrieweg', '50', '', 2701, 1),
(7, 'Sterrekundelaan', '14', '', 2203, 1),
(8, 'Keizerslaan', '7', '', 381, 1),
(9, 'Brussel', '7', NULL, 2342, 1),
(10, 'Brussel', '7', NULL, 2342, 1),
(11, 'Brussel', '7', NULL, 2342, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelcategorieen`
--

CREATE TABLE `artikelcategorieen` (
  `categorieId` int(11) NOT NULL,
  `artikelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikelcategorieen`
--

INSERT INTO `artikelcategorieen` (`categorieId`, `artikelId`) VALUES
(2, 1),
(2, 2),
(2, 3),
(4, 242),
(4, 243),
(4, 244),
(4, 245),
(4, 246),
(4, 247),
(4, 248),
(4, 249),
(4, 250),
(4, 251),
(4, 252),
(4, 253),
(4, 254),
(4, 255),
(5, 218),
(5, 219),
(5, 220),
(5, 221),
(5, 222),
(5, 223),
(5, 224),
(5, 225),
(5, 226),
(5, 227),
(5, 228),
(5, 229),
(5, 230),
(5, 231),
(5, 232),
(5, 233),
(5, 234),
(5, 235),
(5, 236),
(5, 237),
(5, 238),
(5, 239),
(5, 240),
(5, 241),
(5, 256),
(5, 257),
(6, 161),
(6, 162),
(6, 163),
(6, 164),
(6, 165),
(6, 166),
(6, 167),
(6, 168),
(6, 169),
(6, 170),
(6, 171),
(6, 172),
(6, 173),
(6, 174),
(6, 175),
(6, 176),
(6, 177),
(6, 178),
(6, 179),
(6, 180),
(6, 181),
(6, 182),
(6, 183),
(6, 184),
(6, 185),
(6, 186),
(6, 187),
(6, 188),
(6, 189),
(6, 190),
(6, 191),
(6, 192),
(6, 193),
(6, 194),
(6, 195),
(6, 196),
(6, 197),
(6, 198),
(6, 199),
(6, 200),
(6, 214),
(6, 215),
(6, 216),
(6, 217),
(7, 201),
(7, 202),
(7, 203),
(8, 242),
(8, 243),
(8, 244),
(8, 245),
(8, 246),
(8, 247),
(8, 248),
(8, 249),
(8, 250),
(8, 251),
(8, 252),
(8, 253),
(8, 254),
(8, 255),
(9, 211),
(9, 212),
(9, 213),
(9, 214),
(9, 215),
(9, 216),
(9, 217),
(9, 256),
(9, 257),
(10, 206),
(10, 207),
(10, 208),
(10, 209),
(10, 210),
(11, 204),
(11, 205),
(21, 122),
(21, 123),
(21, 124),
(21, 125),
(21, 126),
(21, 127),
(21, 128),
(21, 129),
(21, 130),
(21, 131),
(21, 132),
(21, 133),
(21, 134),
(21, 135),
(21, 136),
(21, 137),
(21, 138),
(22, 1),
(22, 2),
(22, 3),
(22, 139),
(22, 140),
(22, 141),
(22, 142),
(22, 143),
(22, 144),
(22, 145),
(22, 146),
(22, 147),
(22, 148),
(22, 149),
(22, 150),
(22, 151),
(22, 152),
(22, 153),
(22, 154),
(22, 155),
(22, 156),
(22, 157),
(22, 158),
(22, 159),
(22, 160),
(23, 55),
(23, 258),
(23, 259),
(23, 260),
(23, 261),
(23, 262),
(23, 263),
(23, 264),
(23, 265),
(23, 266),
(24, 74),
(24, 75),
(24, 76),
(24, 77),
(24, 78),
(24, 79),
(24, 80),
(24, 81),
(24, 82),
(24, 83),
(24, 84),
(24, 85),
(24, 86),
(24, 87),
(24, 88),
(24, 89),
(24, 90),
(24, 91),
(24, 92),
(24, 93),
(24, 94),
(24, 95),
(24, 96),
(24, 97),
(24, 98),
(24, 99),
(24, 100),
(24, 101),
(24, 102),
(24, 103),
(24, 104),
(24, 105),
(24, 106),
(24, 107),
(24, 108),
(24, 109),
(24, 110),
(24, 111),
(24, 112),
(24, 113),
(24, 114),
(24, 115),
(24, 116),
(24, 117),
(24, 118),
(24, 119),
(24, 120),
(24, 121),
(31, 23),
(31, 24),
(31, 25),
(31, 26),
(31, 27),
(31, 28),
(32, 16),
(32, 17),
(32, 18),
(33, 4),
(33, 5),
(33, 6),
(33, 7),
(33, 8),
(33, 9),
(33, 10),
(33, 11),
(33, 12),
(33, 13),
(33, 14),
(33, 15),
(34, 29),
(34, 30),
(34, 31),
(34, 32),
(35, 19),
(35, 20),
(35, 21),
(35, 22),
(36, 33),
(36, 34),
(36, 35),
(36, 36),
(36, 37),
(36, 38),
(37, 39),
(37, 40),
(37, 41),
(37, 42),
(38, 43),
(38, 44),
(38, 45),
(39, 46),
(39, 47),
(39, 48),
(39, 49),
(40, 50),
(40, 51),
(40, 52),
(40, 53),
(41, 54),
(41, 55),
(41, 56),
(41, 57),
(41, 58),
(41, 59),
(41, 60),
(41, 61),
(41, 62),
(41, 63),
(42, 64),
(42, 65),
(42, 66),
(42, 67),
(43, 68),
(43, 69),
(43, 70),
(43, 71),
(43, 72),
(43, 73);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelen`
--

CREATE TABLE `artikelen` (
  `artikelId` int(11) NOT NULL,
  `ean` varchar(13) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `beschrijving` varchar(255) NOT NULL,
  `prijs` decimal(18,5) NOT NULL,
  `gewichtInGram` int(11) NOT NULL,
  `bestelpeil` int(11) NOT NULL DEFAULT 0,
  `voorraad` int(11) NOT NULL DEFAULT 0,
  `minimumVoorraad` int(11) NOT NULL DEFAULT 0,
  `maximumVoorraad` int(11) NOT NULL DEFAULT 0,
  `levertijd` int(11) NOT NULL DEFAULT 1,
  `aantalBesteldLeverancier` int(11) NOT NULL DEFAULT 0,
  `maxAantalInMagazijnPLaats` int(11) NOT NULL DEFAULT 0,
  `leveranciersId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikelen`
--

INSERT INTO `artikelen` (`artikelId`, `ean`, `naam`, `beschrijving`, `prijs`, `gewichtInGram`, `bestelpeil`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`, `levertijd`, `aantalBesteldLeverancier`, `maxAantalInMagazijnPLaats`, `leveranciersId`) VALUES
(1, '5499999000019', 'emmer 10 l', 'huishoudemmer inhoud 10 l', 2.00000, 400, 25, 50, 10, 100, 1, 0, 25, 5),
(2, '5499999000026', 'emmer 12 l', 'huishoudemmer inhoud 12 l', 4.00000, 500, 25, 50, 10, 100, 1, 0, 25, 5),
(3, '5499999000033', 'emmer 5 l', 'huishoudemmer inhoud 5 l', 1.80000, 200, 25, 50, 10, 100, 1, 0, 25, 5),
(4, '5499999000040', 'keukenstoel', 'houten keukenstoel wit', 59.00000, 1200, 25, 50, 10, 100, 1, 0, 6, 1),
(5, '5499999000057', 'keukenstoel', 'houten keukenstoel grijs', 59.00000, 1200, 25, 50, 10, 100, 1, 0, 6, 1),
(6, '5499999000064', 'keukenstoel', 'houten keukenstoel zwart', 59.00000, 1200, 25, 50, 10, 100, 1, 0, 6, 1),
(7, '5499999000071', 'keukenstoel', 'houten keukenstoel rood', 59.00000, 1200, 25, 50, 10, 100, 1, 0, 6, 1),
(8, '5499999000088', 'keukenstoel', 'kunststof keukenstoel wit', 39.00000, 950, 25, 50, 10, 100, 1, 0, 6, 1),
(9, '5499999000095', 'keukenstoel', 'kunststof keukenstoel grijs', 39.00000, 950, 25, 50, 10, 100, 1, 0, 6, 1),
(10, '5499999000101', 'keukenstoel', 'kunststof keukenstoel zwart', 39.00000, 950, 25, 50, 10, 100, 1, 0, 6, 1),
(11, '5499999000118', 'keukenstoel', 'kunststof keukenstoel rood', 39.00000, 950, 25, 50, 10, 100, 1, 0, 6, 1),
(12, '5499999000125', 'keukenstoel', 'lederen keukenstoel wit', 199.00000, 1650, 25, 50, 10, 100, 1, 0, 6, 1),
(13, '5499999000132', 'keukenstoel', 'lederen keukenstoel grijs', 199.00000, 1650, 25, 50, 10, 100, 1, 0, 6, 1),
(14, '5499999000149', 'keukenstoel', 'lederen keukenstoel zwart', 199.00000, 1650, 25, 50, 10, 100, 1, 0, 6, 1),
(15, '5499999000156', 'keukenstoel', 'lederen keukenstoel rood', 199.00000, 1650, 25, 50, 10, 100, 1, 0, 6, 1),
(16, '5499999000163', 'bijzettafel', 'Houten bijzettafel rond - 50 cm', 99.00000, 2500, 25, 50, 10, 100, 1, 0, 10, 1),
(17, '5499999000170', 'bijzettafel', 'Houten bijzettafel rond - 90 cm', 137.00000, 3000, 25, 50, 10, 100, 1, 0, 10, 1),
(18, '5499999000187', 'bijzettafel', 'Houten bijzettafel rond - 30 cm', 57.00000, 2000, 25, 50, 10, 100, 1, 0, 10, 1),
(19, '5499999000194', 'salontafel', 'Houten salontafel rond - 90 cm', 125.00000, 3500, 3, 5, 1, 10, 1, 0, 1, 1),
(20, '5499999000200', 'salontafel', 'Houten salontafel rond - 120 cm', 150.00000, 4000, 3, 5, 1, 10, 1, 0, 1, 1),
(21, '5499999000217', 'salontafel', 'Houten salontafel 50cm - 95 cm', 135.00000, 3750, 3, 5, 1, 10, 1, 0, 1, 1),
(22, '5499999000224', 'salontafel', 'Houten salontafel 50cm - 120 cm', 175.00000, 4500, 3, 5, 1, 10, 1, 0, 1, 1),
(23, '5499999000231', 'eettafel', 'Houten keukentafel rond - 120 cm', 109.00000, 5000, 3, 5, 1, 10, 1, 0, 1, 1),
(24, '5499999000248', 'eettafel', 'Houten keukentafel rond - 150 cm', 129.00000, 6000, 3, 5, 1, 10, 1, 0, 1, 1),
(25, '5499999000255', 'eettafel', 'Houten keukentafel rond - 180 cm', 149.00000, 7000, 3, 5, 1, 10, 1, 0, 1, 1),
(26, '5499999000262', 'eettafel', 'Kunststof keukentafel wit rond - 120 cm', 79.00000, 3500, 3, 5, 1, 10, 1, 0, 1, 1),
(27, '5499999000279', 'eettafel', 'Kunststof keukentafel wit rond - 150 cm', 99.00000, 4000, 3, 5, 1, 10, 1, 0, 1, 1),
(28, '5499999000286', 'eettafel', 'Kunststof keukentafel wit rond - 180 cm', 119.00000, 4500, 3, 5, 1, 10, 1, 0, 1, 1),
(29, '5499999000293', 'kruk', '4 houten krukken', 259.00000, 8000, 3, 5, 1, 10, 1, 0, 6, 1),
(30, '5499999000309', 'kruk', '6 houten krukken', 379.00000, 10000, 3, 5, 1, 10, 1, 0, 6, 1),
(31, '5499999000316', 'kruk', '8 houten krukken', 469.00000, 16000, 3, 5, 1, 10, 1, 0, 6, 1),
(32, '5499999000323', 'kruk', '1 houten kruk', 75.00000, 2000, 3, 5, 1, 10, 1, 0, 6, 1),
(33, '5499999000330', 'sofa', 'stoffen 2-zit', 350.00000, 20000, 3, 5, 1, 10, 1, 0, 1, 1),
(34, '5499999000347', 'sofa', 'stoffen 3-zit', 429.00000, 24000, 3, 5, 1, 10, 1, 0, 1, 1),
(35, '5499999000354', 'sofa', 'stoffen 4-zit', 499.00000, 28000, 3, 5, 1, 10, 1, 0, 1, 1),
(36, '5499999000361', 'sofa', 'lederen 2-zit', 699.00000, 20000, 3, 5, 1, 10, 1, 0, 1, 1),
(37, '5499999000378', 'sofa', 'lederen 3-zit', 850.00000, 24000, 3, 5, 1, 10, 1, 0, 1, 1),
(38, '5499999000385', 'sofa', 'lederen 4-zit', 1099.00000, 28000, 3, 5, 1, 10, 1, 0, 1, 1),
(39, '5499999000392', 'TV-meubel', 'TV-meubel 1 lade', 399.00000, 5000, 3, 5, 1, 10, 1, 0, 2, 1),
(40, '5499999000408', 'TV-meubel', 'TV-meubel 2 lades', 479.00000, 5500, 3, 5, 1, 10, 1, 0, 2, 1),
(41, '5499999000415', 'TV-meubel', 'TV-meubel 1 lade en 2 zijkastjes', 579.00000, 6500, 3, 5, 1, 10, 1, 0, 2, 1),
(42, '5499999000422', 'TV-meubel', 'TV-meubel 2 lades en 2 zijkastjes', 699.00000, 7000, 3, 5, 1, 10, 1, 0, 2, 1),
(43, '5499999000439', 'Dressoir', 'Dressoir 2 deuren', 349.00000, 20000, 3, 5, 1, 10, 1, 0, 1, 1),
(44, '5499999000446', 'Dressoir', 'Dressoir 3 deuren', 499.00000, 25000, 3, 5, 1, 10, 1, 0, 1, 1),
(45, '5499999000453', 'Dressoir', 'Dressoir 4 deuren', 649.00000, 30000, 3, 5, 1, 10, 1, 0, 1, 1),
(46, '5499999000460', 'Ladekast', 'Ladekast 3 lades 90 cm', 146.00000, 7500, 3, 5, 1, 10, 1, 0, 1, 1),
(47, '5499999000477', 'Ladekast', 'Ladekast 4 lades 90 cm', 189.00000, 8500, 3, 5, 1, 10, 1, 0, 1, 1),
(48, '5499999000484', 'Ladekast', 'Ladekast 3 lades 120 cm', 219.00000, 9000, 3, 5, 1, 10, 1, 0, 1, 1),
(49, '5499999000491', 'Ladekast', 'Ladekast 4 lades 120 cm', 259.00000, 1000, 3, 5, 1, 10, 1, 0, 1, 1),
(50, '5499999000507', 'Wandrek', 'Houten wandrek enkel - 90 cm', 49.00000, 1250, 3, 5, 1, 10, 1, 0, 4, 1),
(51, '5499999000514', 'Wandrek', 'Houten wandrek dubbel - 90 cm', 79.00000, 1750, 3, 5, 1, 10, 1, 0, 4, 1),
(52, '5499999000521', 'Wandrek', 'Houten wandrek enkel - 120 cm', 65.00000, 1650, 3, 5, 1, 10, 1, 0, 4, 1),
(53, '5499999000538', 'Wandrek', 'Houten wandrek dubbel - 120 cm', 125.00000, 3300, 3, 5, 1, 10, 1, 0, 4, 1),
(54, '5499999000545', 'Kapstok', 'Wand kapstok hout - 90 cm', 75.00000, 1500, 3, 5, 1, 10, 1, 0, 2, 1),
(55, '5499999000552', 'Kapstok', 'Wand kapstok metaal - 90 cm', 45.00000, 1000, 3, 5, 1, 10, 1, 0, 2, 1),
(56, '5499999000569', 'Kapstok', 'Wand kapstok kunststof wit - 90 cm', 34.00000, 750, 3, 5, 1, 10, 1, 0, 2, 5),
(57, '5499999000576', 'Kapstok', 'Wand kapstok kunststof zwart - 90 cm', 34.00000, 750, 3, 5, 1, 10, 1, 0, 2, 5),
(58, '5499999000583', 'Kapstok', 'Kapstokhaken - set van 3 zwart', 19.00000, 250, 3, 5, 1, 10, 1, 0, 5, 1),
(59, '5499999000590', 'Kapstok', 'Kapstokhaken - set van 6 zwart', 35.00000, 500, 3, 5, 1, 10, 1, 0, 5, 1),
(60, '5499999000606', 'Kapstok', 'Kapstokhaken - set van 10 zwart', 60.00000, 1000, 3, 5, 1, 10, 1, 0, 5, 1),
(61, '5499999000613', 'Kapstok', 'Kapstokhaken - set van 3 wit', 19.00000, 250, 3, 5, 1, 10, 1, 0, 5, 1),
(62, '5499999000620', 'Kapstok', 'Kapstokhaken - set van 10 wit', 60.00000, 1000, 3, 5, 1, 10, 1, 0, 5, 1),
(63, '5499999000637', 'Kapstok', 'Kapstokhaken - set van 6 wit', 35.00000, 750, 3, 5, 1, 10, 1, 0, 5, 1),
(64, '5499999000644', 'Staande lamp', 'Staande lamp - 1  - koper', 149.00000, 2500, 3, 5, 1, 10, 1, 0, 5, 1),
(65, '5499999000651', 'Staande lamp', 'Staande lamp - 1 - metaal', 119.00000, 2500, 3, 5, 1, 10, 1, 0, 5, 1),
(66, '5499999000668', 'Staande lamp', 'Staande lamp - 1 + leeslicht  - koper', 179.00000, 3000, 3, 5, 1, 10, 1, 0, 5, 1),
(67, '5499999000675', 'Staande lamp', 'Staande lamp - 1 + leeslicht  - metaal', 139.00000, 3000, 3, 5, 1, 10, 1, 0, 5, 1),
(68, '5499999000682', 'Hanglamp', 'Bronzen hanglamp met 3 glazen', 119.00000, 2500, 3, 5, 1, 10, 1, 0, 5, 4),
(69, '5499999000699', 'Hanglamp', 'Bronzen hanglamp met 6 glazen', 149.00000, 3500, 3, 5, 1, 10, 1, 0, 5, 4),
(70, '5499999000705', 'Hanglamp', 'Koperen hanglamp met 3 glazen', 119.00000, 2500, 3, 5, 1, 10, 1, 0, 5, 4),
(71, '5499999000712', 'Hanglamp', 'Koperen hanglamp met 6 glazen', 149.00000, 3500, 3, 5, 1, 10, 1, 0, 5, 4),
(72, '5499999000729', 'Hanglamp', 'Industriële metalen hanglamp 3 glazen', 99.00000, 2500, 3, 5, 1, 10, 1, 0, 5, 4),
(73, '5499999000736', 'Hanglamp', 'Industriële metalen hanglamp 6 glazen', 115.00000, 3500, 3, 5, 1, 10, 1, 0, 5, 4),
(74, '5499999000743', 'Boormachine 500W', 'Boormachine 500W geel', 235.00000, 480, 3, 5, 1, 10, 1, 0, 10, 4),
(75, '5499999000750', 'Boormachine 600W', 'Boormachine 600W rood', 370.00000, 600, 3, 5, 1, 10, 1, 0, 10, 4),
(76, '5499999000767', 'Boormachine 1000W', 'Boormachine 1000W blauw', 680.00000, 750, 3, 5, 1, 10, 1, 0, 10, 4),
(77, '5499999000774', 'Klopboormachine 400W', 'Klopboormachine 400W groen', 240.00000, 520, 3, 5, 1, 10, 1, 0, 10, 4),
(78, '5499999000781', 'Klopboormachine 500W', 'Klopboormachine 500W geel', 360.00000, 630, 3, 5, 1, 10, 1, 0, 10, 4),
(79, '5499999000798', 'Klopboormachine 600W', 'Klopboormachine 600W rood', 480.00000, 830, 3, 5, 1, 10, 1, 0, 10, 4),
(80, '5499999000804', 'Klopboormachine 1000W', 'klopboormachine 1000W blauw', 850.00000, 1189, 3, 5, 1, 10, 1, 0, 10, 4),
(81, '5499999000811', 'Elektrische schroevendraaier 400W', 'Elektrische schroevendraaier 400W groen', 200.00000, 450, 3, 5, 1, 10, 1, 0, 10, 4),
(82, '5499999000828', 'Elektrische schroevendraaier 500W', 'Elektrische schroevendraaier 500W geel', 225.00000, 460, 3, 5, 1, 10, 1, 0, 10, 4),
(83, '5499999000835', 'Elektrische schroevendraaier 600W', 'Elektrische schroevendraaier 600W rood', 370.00000, 530, 3, 5, 1, 10, 1, 0, 10, 4),
(84, '5499999000842', 'Decoupeerzaag 400W', 'Wipzaag 400W blauw', 350.00000, 450, 3, 5, 1, 10, 1, 0, 10, 4),
(85, '5499999000859', 'Decoupeerzaag 500W', 'Wipzaag 500W groen', 370.00000, 460, 3, 5, 1, 10, 1, 0, 10, 4),
(86, '5499999000866', 'Decoupeerzaag 600W', 'Wipzaag 600W geel', 480.00000, 480, 3, 5, 1, 10, 1, 0, 10, 4),
(87, '5499999000873', 'Schuurmachine 400W', 'Schuurmachine 400W rood', 199.00000, 450, 3, 5, 1, 10, 1, 0, 10, 4),
(88, '5499999000880', 'Schuurmachine 500W', 'Schuurmachine 500W blauw', 270.00000, 460, 3, 5, 1, 10, 1, 0, 10, 4),
(89, '5499999000897', 'Schuurmachine 600W', 'Schuurmachine 600W groen', 390.00000, 480, 3, 5, 1, 10, 1, 0, 10, 4),
(90, '5499999000903', 'Breekhamers 600W', 'Breekhamers 600W geel', 680.00000, 1200, 3, 5, 1, 10, 1, 0, 10, 4),
(91, '5499999000910', 'Breekhamers 800W', 'Breekhamers 800W rood', 890.00000, 1250, 3, 5, 1, 10, 1, 0, 10, 4),
(92, '5499999000927', 'Breekhamers 1000W', 'Breekhamers 1000W blauw', 980.00000, 1480, 3, 5, 1, 10, 1, 0, 10, 4),
(93, '5499999000934', 'Breekhamers 1200W', 'Breekhamers 1200W groen', 1100.00000, 1760, 3, 5, 1, 10, 1, 0, 10, 4),
(94, '5499999000941', 'Cirkelzaag 400W', 'Cirkelzaag 400W geel', 450.00000, 1400, 3, 5, 1, 10, 1, 0, 10, 4),
(95, '5499999000958', 'Cirkelzaag 600W', 'Cirkelzaag 600W rood', 550.00000, 1680, 3, 5, 1, 10, 1, 0, 10, 4),
(96, '5499999000965', 'Cirkelzaag 1000W', 'Cirkelzaag 1000W blauw', 750.00000, 2400, 3, 5, 1, 10, 1, 0, 10, 4),
(97, '5499999000972', 'Cirkelzaag 1500W', 'Cirkelzaag 1500W groen', 989.00000, 2490, 3, 5, 1, 10, 1, 0, 10, 4),
(98, '5499999000989', 'Afkortzaag 400W', 'Afkortzaag 400W geel', 680.00000, 1900, 3, 5, 1, 10, 1, 0, 10, 4),
(99, '5499999000996', 'Afkortzaag 600W', 'Afkortzaag 600W rood', 870.00000, 2480, 3, 3, 1, 10, 1, 0, 10, 4),
(100, '5499999001009', 'Afkortzaag 800W', 'Afkortzaag 800W blauw', 990.00000, 2690, 3, 5, 1, 10, 1, 0, 10, 4),
(101, '5499999001016', 'Afkortzaag 1000W', 'Afkortzaag 1000W groen', 1200.00000, 3197, 3, 5, 1, 10, 1, 0, 10, 4),
(102, '5499999001023', 'Figuurzaag 250W', 'Figuurzaag 250W geel', 250.00000, 1400, 3, 5, 1, 10, 1, 0, 10, 4),
(103, '5499999001030', 'Figuurzaag 350W', 'Figuurzaag 350W rood', 290.00000, 1500, 3, 5, 1, 10, 1, 0, 10, 4),
(104, '5499999001047', 'Figuurzaag 450W', 'Figuurzaag 450W blauw', 390.00000, 1680, 3, 5, 1, 10, 1, 0, 10, 4),
(105, '5499999001054', 'Kolomboormachine 300W', 'Kolomboormachine 300W groen', 480.00000, 14500, 3, 5, 1, 10, 1, 0, 10, 4),
(106, '5499999001061', 'Kolomboormachine 600W', 'Kolomboormachine 600W geel', 678.00000, 17815, 3, 5, 1, 10, 1, 0, 10, 4),
(107, '5499999001078', 'Kolomboormachine 900W', 'Kolomboormachine 900W rood', 1580.00000, 19851, 3, 5, 1, 10, 1, 0, 10, 4),
(108, '5499999001085', 'Kolomboormachine 1500W', 'Kolomboormachine 1500W blauw', 2180.00000, 26780, 3, 5, 1, 10, 1, 0, 10, 4),
(109, '5499999001092', 'Schaafmachine 300W', 'Schaafmachine 300W groen', 230.00000, 480, 3, 5, 1, 10, 1, 0, 10, 4),
(110, '5499999001108', 'Schaafmachine 600W', 'Schaafmachine 600W geel', 370.00000, 580, 3, 5, 1, 10, 1, 0, 10, 4),
(111, '5499999001115', 'Schaafmachine 900W', 'Schaafmachine 900W rood', 680.00000, 724, 3, 5, 1, 10, 1, 0, 10, 4),
(112, '5499999001122', 'Schaafmachine 1500W', 'Schaafmachine 1500W blauw', 990.00000, 860, 3, 5, 1, 10, 1, 0, 10, 4),
(113, '5499999001139', 'Slijpmachine 600W', 'Slijpmachine 600W groen', 199.00000, 1200, 3, 5, 1, 10, 1, 0, 10, 4),
(114, '5499999001146', 'Slijpmachine 900W', 'Slijpmachine 900W geel', 350.00000, 1580, 3, 5, 1, 10, 1, 0, 10, 4),
(115, '5499999001153', 'Slijpmachine 1200W', 'Slijpmachine 1200W rood', 650.00000, 1790, 3, 5, 1, 10, 1, 0, 10, 4),
(116, '5499999001160', 'Multitool 250W', 'Multitool 250W blauw', 299.00000, 378, 3, 5, 1, 10, 1, 0, 10, 4),
(117, '5499999001177', 'Multitool 350W', 'Multitool 350W groen', 369.00000, 456, 3, 5, 1, 10, 1, 0, 10, 4),
(118, '5499999001184', 'Multitool 450W', 'Multitool 450W geel', 429.00000, 512, 3, 5, 1, 10, 1, 0, 10, 4),
(119, '5499999001191', 'Bovenfrees 450W', 'Bovenfrees 450W rood', 560.00000, 650, 3, 5, 1, 10, 1, 0, 10, 4),
(120, '5499999001207', 'Bovenfrees 600W', 'Bovenfrees 600W', 720.00000, 946, 3, 5, 1, 10, 1, 0, 10, 4),
(121, '5499999001214', 'Bovenfrees 900W', 'Bovenfrees 900W', 840.00000, 1165, 3, 5, 1, 10, 1, 0, 10, 4),
(122, '5499999001221', 'Hamer 100 gr', 'Hamer 100 gr staal', 14.00000, 120, 25, 50, 10, 100, 1, 0, 25, 4),
(123, '5499999001238', 'Hamer 250gr', 'Hamer 250gr staal', 19.00000, 280, 25, 50, 10, 100, 1, 0, 25, 4),
(124, '5499999001245', 'Hamer 400gr', 'Hamer 400gr staal', 24.00000, 430, 25, 50, 10, 100, 1, 0, 25, 4),
(125, '5499999001252', 'Hamer 1000gr', 'Hamer 1000gr staal', 35.00000, 1120, 25, 50, 10, 100, 1, 0, 25, 4),
(126, '5499999001269', 'Klauwhamer 250gr', 'Klauwhamer 250gr staal', 24.00000, 280, 25, 50, 10, 100, 1, 0, 25, 4),
(127, '5499999001276', 'Klauwhamer 400Gr', 'Klauwhamer 400gr staal', 35.00000, 430, 25, 50, 10, 100, 1, 0, 25, 4),
(128, '5499999001283', 'Hamer 250gr', 'Hamer 250gr rubber', 14.00000, 280, 25, 50, 10, 100, 1, 0, 25, 4),
(129, '5499999001290', 'Hamer 400gr', 'Hamer 400Gr rubber', 19.00000, 430, 25, 50, 10, 100, 1, 0, 25, 4),
(130, '5499999001306', 'Hamer 600gr', 'Hamer 600gr rubber', 24.00000, 670, 25, 50, 10, 100, 1, 0, 25, 4),
(131, '5499999001313', 'Hamer 400gr', 'Hamer 400gr hout', 35.00000, 430, 25, 50, 10, 100, 1, 0, 25, 4),
(132, '5499999001320', 'Hamer 750gr', 'Hamer 750gr hout', 55.00000, 830, 25, 50, 10, 100, 1, 0, 25, 4),
(133, '5499999001337', 'Universeelzaag 45cm', 'universeelzaag 45cm staal', 12.90000, 420, 25, 50, 10, 100, 1, 0, 25, 4),
(134, '5499999001344', 'Universeelzaag 50cm', 'universeelzaag 50cm staal', 14.90000, 470, 25, 50, 10, 100, 1, 0, 25, 4),
(135, '5499999001351', 'Universeelzaag 55cm', 'universeelzaag 55cm staal', 18.90000, 520, 25, 50, 10, 100, 1, 0, 25, 4),
(136, '5499999001368', 'Kapzaag 20cm', 'kapzaag 20cm staal', 15.90000, 480, 25, 50, 10, 100, 1, 0, 25, 4),
(137, '5499999001375', 'Kapzaag 30cm', 'kapzaag 30cm staal', 24.80000, 560, 25, 50, 10, 100, 1, 0, 25, 4),
(138, '5499999001382', 'Kapzaag 40cm', 'kapzaag 40cm staal', 33.70000, 640, 25, 50, 10, 100, 1, 0, 25, 4),
(139, '5499999001399', 'spade T-steel 95cm', 'spade T-steel 95cm hout', 45.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(140, '5499999001405', 'spade bolsteel 95cm', 'spade bolsteel 95cm hout', 44.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(141, '5499999001412', 'spade D-steel 95cm', 'spade D-steel 95cm hout', 49.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(142, '5499999001429', 'spade kinderen 60cm', 'spade kinderen 60cm hout', 19.00000, 700, 25, 50, 10, 100, 1, 0, 25, 5),
(143, '5499999001436', 'spade ergonomisch 95cm', 'spade ergonomisch 95cm hout', 54.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(144, '5499999001443', 'spade T-steel 95cm', 'spade T-steel 95cm epoxy', 49.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(145, '5499999001450', 'spade bolsteel 95cm', 'spade bolsteel 95cm epoxy', 48.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(146, '5499999001467', 'spade D-steel 95cm', 'spade D-steel 95cm epoxy', 53.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(147, '5499999001474', 'spade kinderen 60cm', 'spade kinderen 60cm PVC', 23.00000, 300, 25, 50, 10, 100, 1, 0, 25, 5),
(148, '5499999001481', 'spade ergonomisch 95cm', 'spade ergonomisch 95cm epoxy', 58.00000, 2000, 25, 50, 10, 100, 1, 0, 25, 4),
(149, '5499999001498', 'gazonhark 35cm', 'gazonhark 35cm staal', 35.00000, 4000, 25, 50, 10, 100, 1, 0, 25, 4),
(150, '5499999001504', 'gazonhark 50cm', 'gazonhark 50cm staal', 42.00000, 5000, 25, 50, 10, 100, 1, 0, 25, 4),
(151, '5499999001511', 'hark zonder steel 30cm', 'hark zonder steel 30cm staal', 15.00000, 2500, 25, 50, 10, 100, 1, 0, 25, 4),
(152, '5499999001528', 'hark zonder steel 35cm', 'hark zonder steel 35cm staal', 19.00000, 3000, 25, 50, 10, 100, 1, 0, 25, 4),
(153, '5499999001535', 'hark zonder steel 50cm', 'hark zonder steel 50cm staal', 26.00000, 4000, 25, 50, 10, 100, 1, 0, 25, 4),
(154, '5499999001542', 'hark zonder steel 60cm', 'hark zonder steel 60cm staal', 35.00000, 4500, 25, 50, 10, 100, 1, 0, 25, 4),
(155, '5499999001559', 'steel voor hark 100cm', 'steel voor hark 100cm staal', 20.00000, 736, 25, 50, 10, 100, 1, 0, 25, 4),
(156, '5499999001566', 'steel voor hark 120cm', 'steel voor hark 120cm staal', 24.00000, 1000, 25, 50, 10, 100, 1, 0, 25, 4),
(157, '5499999001573', 'bolsteel voor hark 100cm', 'bolsteel voor hark 100cm hout', 22.00000, 700, 25, 50, 10, 100, 1, 0, 25, 4),
(158, '5499999001580', 'bolsteel voor hark 120cm', 'bolsteel voor hark 120cm hout', 26.00000, 840, 25, 50, 10, 100, 1, 0, 25, 4),
(159, '5499999001597', 'T-steel voor hark 100cm', 'T-steel voor hark 100cm epoxy', 28.00000, 700, 25, 50, 10, 100, 1, 0, 25, 4),
(160, '5499999001603', 'T-steel voor hark 120cm', 'T-steel voor hark 120cm epoxy', 34.00000, 840, 25, 50, 10, 100, 1, 0, 25, 4),
(161, '5499999001610', 'steakmes', 'mat', 8.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(162, '5499999001627', 'tafelvork', 'mat', 8.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(163, '5499999001634', 'tafelmes', 'mat', 8.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(164, '5499999001641', 'eetlepel', 'mat', 8.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(165, '5499999001658', 'dinerlepel', 'mat', 8.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(166, '5499999001665', 'steakmes', 'staal', 8.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(167, '5499999001672', 'tafelvork', 'staal', 14.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(168, '5499999001689', 'tafelmes', 'staal', 14.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(169, '5499999001696', 'eetlepel', 'staal', 14.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(170, '5499999001702', 'dinerlepel', 'staal', 14.00000, 50, 25, 50, 10, 100, 1, 0, 50, 3),
(171, '5499999001719', 'steakmes 4-pack', 'staal', 55.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(172, '5499999001726', 'tafelvork 4-pack', 'staal', 55.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(173, '5499999001733', 'tafelmes 4-pack', 'staal', 55.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(174, '5499999001740', 'eetlepel 4-pack', 'staal', 55.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(175, '5499999001757', 'dinerlepel 4-pack', 'staal', 55.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(176, '5499999001764', 'steakmes 4-pack', 'mat', 30.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(177, '5499999001771', 'tafelvork 4-pack', 'mat', 30.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(178, '5499999001788', 'tafelmes 4-pack', 'mat', 30.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(179, '5499999001795', 'eetlepel 4-pack', 'mat', 30.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(180, '5499999001801', 'dinerlepel 4-pack', 'mat', 30.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(181, '5499999001818', 'steakmes 2-pack', 'mat', 16.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(182, '5499999001825', 'tafelvork 2-pack', 'mat', 16.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(183, '5499999001832', 'tafelmes 2-pack', 'mat', 16.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(184, '5499999001849', 'eetlepel 2-pack', 'mat', 16.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(185, '5499999001856', 'dinerlepel 2-pack', 'mat', 16.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(186, '5499999001863', 'steakmes 2-pack', 'staal', 26.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(187, '5499999001870', 'tafelvork 2-pack', 'staal', 26.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(188, '5499999001887', 'tafelmes 2-pack', 'staal', 26.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(189, '5499999001894', 'eetlepel 2-pack', 'staal', 26.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(190, '5499999001900', 'dinerlepel 2-pack', 'staal', 26.00000, 100, 25, 50, 10, 100, 1, 0, 50, 3),
(191, '5499999001917', 'steakmes 6-pack', 'mat', 45.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(192, '5499999001924', 'tafelvork 6-pack', 'mat', 45.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(193, '5499999001931', 'tafelmes 6-pack', 'mat', 45.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(194, '5499999001948', 'eetlepel 6-pack', 'mat', 45.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(195, '5499999001955', 'dinerlepel 6-pack', 'mat', 45.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(196, '5499999001962', 'steakmes 6-pack', 'staal', 80.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(197, '5499999001979', 'tafelvork 6-pack', 'staal', 80.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(198, '5499999001986', 'tafelmes 6-pack', 'staal', 80.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(199, '5499999001993', 'eetlepel 6-pack', 'staal', 80.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(200, '5499999002006', 'dinerlepel 6-pack', 'staal', 80.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(201, '5499999002013', 'groot plat bord 6-pack', 'wit porcelein', 60.00000, 2160, 25, 50, 10, 100, 1, 0, 50, 3),
(202, '5499999002020', 'wit soepbord 6-pack', 'wit porcelein', 60.00000, 2160, 25, 50, 10, 100, 1, 0, 50, 3),
(203, '5499999002037', 'wit dessertbord 6-pack', 'wit porcelein', 50.00000, 1500, 25, 50, 10, 100, 1, 0, 50, 3),
(204, '5499999002044', 'wit koffietas en onderzetter 6-pack', 'wit porcelein', 50.00000, 1860, 25, 50, 10, 100, 1, 0, 50, 3),
(205, '5499999002051', 'witte mok 300 ml 6-pack', 'wit porcelein', 12.00000, 1800, 25, 50, 10, 100, 1, 0, 50, 5),
(206, '5499999002068', 'waterglas op voet 6-pack', 'glas', 30.00000, 1140, 25, 50, 10, 100, 1, 0, 50, 3),
(207, '5499999002075', 'rode wijnglas 6-pack', 'glas', 27.00000, 960, 25, 50, 10, 100, 1, 0, 50, 3),
(208, '5499999002082', 'witte wijnglas 6-pack', 'glas', 24.00000, 840, 25, 50, 10, 100, 1, 0, 50, 3),
(209, '5499999002099', 'champagneglas 6-pack', 'glas', 30.00000, 840, 25, 50, 10, 100, 1, 0, 50, 3),
(210, '5499999002105', 'limonadeglas 6-pack', 'glas', 12.00000, 1200, 25, 50, 10, 100, 1, 0, 50, 5),
(211, '5499999002112', 'taartschotel 30 cm', 'wit porcelein', 35.00000, 600, 25, 50, 10, 100, 1, 0, 50, 3),
(212, '5499999002129', 'ovale schotel 30 x 20', 'wit porcelein', 35.00000, 500, 25, 50, 10, 100, 1, 0, 50, 3),
(213, '5499999002136', 'sauskom', 'wit porcelein', 30.00000, 600, 25, 50, 10, 100, 1, 0, 50, 3),
(214, '5499999002143', 'pollepel', 'staal', 30.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(215, '5499999002150', 'taartschep', 'staal', 10.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(216, '5499999002167', 'pollepel', 'mat', 15.00000, 300, 25, 50, 10, 100, 1, 0, 50, 3),
(217, '5499999002174', 'taartschep', 'mat', 5.00000, 200, 25, 50, 10, 100, 1, 0, 50, 3),
(218, '5499999002181', 'bewaardoos 1,2 l rechthoekig - set van 3', 'plastiek', 4.75000, 75, 25, 50, 10, 100, 1, 0, 50, 2),
(219, '5499999002198', 'bewaardoos 1,2 l rechthoekig - set van 6', 'plastiek', 8.99000, 150, 25, 50, 10, 100, 1, 0, 50, 2),
(220, '5499999002204', 'bewaardoos 1,5 l rechthoekig - set van 3', 'plastiek', 5.99000, 105, 25, 50, 10, 100, 1, 0, 50, 2),
(221, '5499999002211', 'bewaardoos 1,5 l rechthoekig - set van 6', 'plastiek', 10.25000, 210, 25, 50, 10, 100, 1, 0, 50, 2),
(222, '5499999002228', 'bewaardoos 2 l rechthoekig - set van 3', 'plastiek', 6.45000, 135, 25, 50, 10, 100, 1, 0, 50, 2),
(223, '5499999002235', 'bewaardoos 2 l rechthoekig - set van 6', 'plastiek', 11.45000, 270, 25, 50, 10, 100, 1, 0, 50, 2),
(224, '5499999002242', 'bewaardoos 1,2 l rechthoekig', 'plastiek', 1.19000, 25, 25, 50, 10, 100, 1, 0, 50, 2),
(225, '5499999002259', 'bewaardoos 1,5 l rechthoekig', 'plastiek', 2.23000, 25, 25, 50, 10, 100, 1, 0, 50, 2),
(226, '5499999002266', 'bewaardoos 2 l rechthoekig', 'plastiek', 2.75000, 25, 25, 50, 10, 100, 1, 0, 50, 2),
(227, '5499999002273', 'bewaardoos 1 l rechthoekig', 'plastiek', 3.00000, 20, 25, 50, 10, 100, 1, 0, 50, 2),
(228, '5499999002280', 'bewaardoos 1 l rechthoekig - set van 3', 'plastiek', 8.50000, 60, 25, 50, 10, 100, 1, 0, 50, 2),
(229, '5499999002297', 'bewaardoos 1 l rechthoekig - set van 6', 'plastiek', 15.00000, 120, 25, 50, 10, 100, 1, 0, 50, 2),
(230, '5499999002303', 'bewaardoos 1,2 l rond - set van 3', 'plastiek', 4.75000, 75, 25, 50, 10, 100, 1, 0, 50, 2),
(231, '5499999002310', 'bewaardoos 1,2 l rond - set van 6', 'plastiek', 8.99000, 150, 25, 50, 10, 100, 1, 0, 50, 2),
(232, '5499999002327', 'bewaardoos 1,5 l rond - set van 3', 'plastiek', 5.99000, 105, 25, 50, 10, 100, 1, 0, 50, 2),
(233, '5499999002334', 'bewaardoos 1,5 l rond - set van 6', 'plastiek', 10.25000, 210, 25, 50, 10, 100, 1, 0, 50, 2),
(234, '5499999002341', 'bewaardoos 2 l rond - set van 3', 'plastiek', 6.45000, 135, 25, 50, 10, 100, 1, 0, 50, 2),
(235, '5499999002358', 'bewaardoos 2 l rond - set van 6', 'plastiek', 11.45000, 270, 25, 50, 10, 100, 1, 0, 50, 2),
(236, '5499999002365', 'bewaardoos 1,2 l rond', 'plastiek', 1.19000, 25, 25, 50, 10, 100, 1, 0, 50, 2),
(237, '5499999002372', 'bewaardoos 1,5 l rond', 'plastiek', 2.23000, 25, 25, 50, 10, 100, 1, 0, 50, 2),
(238, '5499999002389', 'bewaardoos 2 l rond', 'plastiek', 2.75000, 25, 25, 50, 10, 100, 1, 0, 50, 2),
(239, '5499999002396', 'bewaardoos 1 l rond', 'plastiek', 3.00000, 20, 25, 50, 10, 100, 1, 0, 50, 2),
(240, '5499999002402', 'bewaardoos 1 l rond - set van 3', 'plastiek', 8.50000, 60, 25, 50, 10, 100, 1, 0, 50, 2),
(241, '5499999002419', 'bewaardoos 1 l rond - set van 6', 'plastiek', 15.00000, 120, 25, 50, 10, 100, 1, 0, 50, 2),
(242, '5499999002426', 'steelpan 16 cm', 'rvs', 20.00000, 600, 12, 25, 5, 50, 1, 0, 10, 3),
(243, '5499999002433', 'steelpan 18 cm', 'rvs', 25.00000, 750, 12, 25, 5, 50, 1, 0, 10, 3),
(244, '5499999002440', 'braadpan 20 cm', 'rvs', 25.00000, 800, 12, 25, 5, 50, 1, 0, 10, 3),
(245, '5499999002457', 'braadpan 24 cm', 'rvs', 30.00000, 900, 12, 25, 5, 50, 1, 0, 10, 3),
(246, '5499999002464', 'braadpan 26 cm', 'rvs', 35.00000, 1200, 12, 25, 5, 50, 1, 0, 10, 3),
(247, '5499999002471', 'kookpot 16 cm', 'rvs', 25.00000, 740, 12, 25, 5, 50, 1, 0, 10, 3),
(248, '5499999002488', 'kookpot 20 cm', 'rvs', 30.00000, 900, 12, 25, 5, 50, 1, 0, 10, 3),
(249, '5499999002495', 'kookpot 24 cm', 'rvs', 35.00000, 1200, 12, 25, 5, 50, 1, 0, 10, 3),
(250, '5499999002501', 'kookpot 26 cm', 'rvs', 40.00000, 1400, 12, 25, 5, 50, 1, 0, 10, 3),
(251, '5499999002518', 'soepketel 26 cm - 8 l', 'rvs', 60.00000, 1850, 12, 25, 5, 50, 1, 0, 10, 3),
(252, '5499999002525', 'soepketel 26 cm - 10 l', 'rvs', 75.00000, 2000, 12, 25, 5, 50, 1, 0, 10, 3),
(253, '5499999002532', 'anti-kleefpan 20 cm', 'rvs - ptfe laag', 30.00000, 800, 12, 25, 5, 50, 1, 0, 10, 3),
(254, '5499999002549', 'anti-kleefpan 24 cm', 'rvs - ptfe laag', 35.00000, 900, 12, 25, 5, 50, 1, 0, 10, 3),
(255, '5499999002556', 'anti-kleefpan 26 cm', 'rvs - ptfe laag', 40.00000, 1200, 12, 25, 5, 50, 1, 0, 10, 3),
(256, '5499999002563', 'taartshotel met deksel dia 34 cm hoogte 5 cm', 'plastiek', 12.00000, 460, 12, 25, 5, 50, 1, 0, 10, 3),
(257, '5499999002570', 'taartshotel met deksel dia 34 cm hoogte 12 cm', 'plastiek', 15.00000, 670, 12, 25, 5, 50, 1, 0, 10, 3),
(258, '5499999002587', 'wandbrievenbus', 'rechthoekige brievenbus, rvs', 27.00000, 2200, 3, 5, 1, 10, 1, 0, 10, 4),
(259, '5499999002594', 'wandbrievenbus donkergrijs', 'rechthoekige brievenbus, rvs', 29.00000, 2200, 3, 5, 1, 10, 1, 0, 10, 4),
(260, '5499999002600', 'wandbrievenbus grijs', 'rechthoekige brievenbus met afgeronde hoeken, staal', 35.00000, 3300, 3, 5, 1, 10, 1, 0, 10, 4),
(261, '5499999002617', 'wandbrievenbus zwart', 'rechthoekige brievenbus met afgeronde hoeken, staal', 40.00000, 3300, 3, 5, 1, 10, 1, 0, 10, 4),
(262, '5499999002624', 'pakketbrievenbus grijs', 'pakketopening 155 w 340mm, staal', 225.00000, 18500, 3, 5, 1, 10, 1, 0, 10, 4),
(263, '5499999002631', 'pakketbrievenbus zwart', 'pakketopening 155 w 340mm, staal', 225.00000, 18500, 3, 5, 1, 10, 1, 0, 10, 4),
(264, '5499999002648', 'staander voor wandbrievenbus grijs', 'staal, 1,5 m hoog', 35.50000, 230, 3, 5, 1, 10, 1, 0, 10, 4),
(265, '5499999002655', 'staander voor wandbrievenbus donkergrijs', 'staal, 1,5 m hoog', 35.50000, 230, 3, 5, 1, 10, 1, 0, 10, 4),
(266, '5499999002662', 'staander voor wandbrievenbus zwart', 'staal, 1,5 m hoog', 35.50000, 230, 3, 5, 1, 10, 1, 0, 10, 4);

--
-- Triggers `artikelen`
--
DELIMITER $$
CREATE TRIGGER `insertTriggerArtikelen` BEFORE INSERT ON `artikelen` FOR EACH ROW begin
    declare eanValue varchar(13);
    declare i int default 1;
    declare cs int default 0;
    set eanValue = concat('5499999', lpad(If(new.artikelId>0, new.artikelId, (select max(artikelId)+1 from Artikelen)), 5, '0'));
    while (i <= 11) do
		set cs = cs + convert (substr(eanValue, i, 1), unsigned);
        set i = i + 2;
    end while;
    set i= 2; 
    while (i <= 12) do
		set cs = cs + (convert (substr(eanValue, i, 1), unsigned) * 3);
        set i = i + 2;
    end while;
    set eanValue = concat(eanValue,convert((10 - (cs mod 10)) mod 10, char));
	set new.ean=eanValue;    
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelleveranciersinfolijnen`
--

CREATE TABLE `artikelleveranciersinfolijnen` (
  `artikelLeveranciersInfoLijnId` int(11) NOT NULL,
  `artikelId` int(11) NOT NULL,
  `vraag` varchar(255) NOT NULL,
  `antwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikelleveranciersinfolijnen`
--

INSERT INTO `artikelleveranciersinfolijnen` (`artikelLeveranciersInfoLijnId`, `artikelId`, `vraag`, `antwoord`) VALUES
(1, 74, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(2, 75, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(3, 76, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(4, 77, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(5, 78, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(6, 79, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(7, 80, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(8, 81, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(9, 82, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(10, 83, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(11, 84, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(12, 85, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(13, 86, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(14, 87, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(15, 88, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(16, 89, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(17, 90, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(18, 91, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(19, 92, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(20, 93, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(21, 94, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(22, 95, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(23, 96, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(24, 97, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(25, 98, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(26, 99, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(27, 100, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(28, 101, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(29, 102, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(30, 103, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(31, 104, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(32, 105, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(33, 106, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(34, 107, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(35, 108, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(36, 109, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(37, 110, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(38, 111, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(39, 112, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(40, 113, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(41, 114, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(42, 115, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(43, 116, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(44, 117, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(45, 118, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(46, 119, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(47, 120, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(48, 121, 'Wat is de garantieperiode?', 'De garantieperiode is 2 jaar. Hou de originele verpakking en factuur goed bij.'),
(49, 64, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(50, 65, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(51, 66, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(52, 67, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(53, 68, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(54, 69, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(55, 70, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(56, 71, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(57, 72, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(58, 73, 'Welke lampen zijn geschikt?', 'Led lampen met E27 fitting'),
(59, 242, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(60, 243, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(61, 244, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(62, 245, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(63, 246, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(64, 247, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(65, 248, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(66, 249, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(67, 250, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(68, 251, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(69, 252, 'Voor welke vuren is het artikel geschikt?', 'Het artikel is geschikt voor gas, electrische, keramische, inductie en halogeen vuren.'),
(70, 242, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(71, 243, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(72, 244, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(73, 245, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(74, 246, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(75, 247, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(76, 248, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(77, 249, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(78, 250, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(79, 251, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.'),
(80, 252, 'Is het artikel vaatwasbestendig?', 'Het artikel is geschikt voor huishoud vaatwassers als industriële vaatwassers.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijnen`
--

CREATE TABLE `bestellijnen` (
  `bestellijnId` int(11) NOT NULL,
  `bestelId` int(11) NOT NULL,
  `artikelId` int(11) NOT NULL,
  `aantalBesteld` int(11) NOT NULL,
  `aantalGeannuleerd` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellijnen`
--

INSERT INTO `bestellijnen` (`bestellijnId`, `bestelId`, `artikelId`, `aantalBesteld`, `aantalGeannuleerd`) VALUES
(1, 1, 2, 2, 0),
(2, 1, 80, 2, 0),
(3, 1, 89, 1, 0),
(4, 1, 118, 2, 0),
(5, 2, 4, 4, 0),
(6, 2, 23, 1, 0),
(7, 3, 33, 1, 0),
(8, 3, 21, 1, 0),
(9, 4, 1, 1, 0),
(10, 4, 29, 1, 0),
(11, 4, 65, 1, 0),
(12, 4, 172, 1, 0),
(13, 4, 173, 1, 0),
(14, 4, 174, 1, 0),
(15, 5, 76, 1, 0),
(16, 5, 83, 1, 0),
(17, 5, 86, 1, 0),
(18, 5, 112, 1, 0),
(19, 5, 126, 1, 0),
(20, 5, 138, 1, 0),
(21, 6, 99, 1, 0),
(22, 7, 99, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelId` int(11) NOT NULL,
  `besteldatum` datetime NOT NULL,
  `klantId` int(11) NOT NULL,
  `betaald` tinyint(1) NOT NULL DEFAULT 0,
  `betalingscode` varchar(45) DEFAULT NULL,
  `betaalwijzeId` int(11) NOT NULL,
  `annulatie` tinyint(1) NOT NULL DEFAULT 0,
  `annulatiedatum` date DEFAULT NULL,
  `terugbetalingscode` varchar(45) DEFAULT NULL,
  `bestellingsStatusId` int(11) NOT NULL,
  `actiecodeGebruikt` tinyint(1) NOT NULL DEFAULT 0,
  `bedrijfsnaam` varchar(45) DEFAULT NULL,
  `btwNummer` varchar(45) DEFAULT NULL,
  `voornaam` varchar(45) NOT NULL,
  `familienaam` varchar(45) NOT NULL,
  `facturatieAdresId` int(11) NOT NULL,
  `leveringsAdresId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`bestelId`, `besteldatum`, `klantId`, `betaald`, `betalingscode`, `betaalwijzeId`, `annulatie`, `annulatiedatum`, `terugbetalingscode`, `bestellingsStatusId`, `actiecodeGebruikt`, `bedrijfsnaam`, `btwNummer`, `voornaam`, `familienaam`, `facturatieAdresId`, `leveringsAdresId`) VALUES
(1, '2026-03-19 10:00:00', 1, 1, 'K20260319100000', 2, 0, NULL, NULL, 5, 0, 'VDAB', '0887010362', 'Ad', 'Ministrateur', 1, 7),
(2, '2026-03-25 14:00:00', 2, 1, 'K20260325140000', 2, 0, NULL, NULL, 5, 0, NULL, NULL, 'Alpha', 'Klant', 2, 2),
(3, '2026-03-25 14:30:00', 3, 1, 'K20260325143000', 2, 0, NULL, NULL, 4, 0, NULL, NULL, 'Beta', 'Client', 3, 3),
(4, '2026-03-26 07:00:00', 4, 1, 'K20260326070000', 2, 0, NULL, NULL, 5, 0, NULL, NULL, 'Gamma', 'Customer', 4, 4),
(5, '2026-03-26 07:20:00', 5, 1, 'O20260326072000', 3, 0, NULL, NULL, 2, 1, NULL, NULL, 'Delta', 'Kunde', 5, 5),
(6, '2026-03-26 14:11:56', 8, 1, 'K20260326141156', 2, 0, NULL, NULL, 2, 0, NULL, NULL, 'Xander', 'Van Malder', 10, 10),
(7, '2026-03-27 09:42:06', 8, 1, 'K20260327094206', 2, 0, NULL, NULL, 2, 0, NULL, NULL, 'Xander', 'Van Malder', 11, 11);

--
-- Triggers `bestellingen`
--
DELIMITER $$
CREATE TRIGGER `insertTriggerBestellingen` BEFORE INSERT ON `bestellingen` FOR EACH ROW begin
    IF new.besteldatum = date(new.besteldatum) THEN
		set new.besteldatum = DATE_ADD(DATE_ADD(new.besteldatum, interval floor(RAND()*(hour(now())-1)+1) hour), interval -floor(RAND()*(60-1)+1) minute);
    END IF;
	IF new.betaalwijzeId = 2 and new.betaald = 1 THEN
		set new.betalingscode = concat('K',convert(from_unixtime(unix_timestamp(new.besteldatum)) + 0, char(14)));
	END IF;
    IF new.betaalwijzeId = 3  and new.betaald = 1 THEN
		set new.betalingscode = concat('O',convert(from_unixtime(unix_timestamp(new.besteldatum)) + 0, char(14)));
	END IF;    
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingsstatussen`
--

CREATE TABLE `bestellingsstatussen` (
  `bestellingsStatusId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingsstatussen`
--

INSERT INTO `bestellingsstatussen` (`bestellingsStatusId`, `naam`) VALUES
(1, 'Lopend'),
(2, 'Betaald'),
(3, 'Geannuleerd'),
(4, 'Klaarmaken'),
(5, 'Onderweg'),
(6, 'Geleverd'),
(7, 'Verloren'),
(8, 'Beschadigd'),
(9, 'Retour'),
(10, 'RetourInStock');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `betaalwijzes`
--

CREATE TABLE `betaalwijzes` (
  `betaalwijzeId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `betaalwijzes`
--

INSERT INTO `betaalwijzes` (`betaalwijzeId`, `naam`) VALUES
(1, 'Niet betaald'),
(2, 'Kredietkaart'),
(3, 'Overschrijving');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorieen`
--

CREATE TABLE `categorieen` (
  `categorieId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `hoofdCategorieId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categorieen`
--

INSERT INTO `categorieen` (`categorieId`, `naam`, `hoofdCategorieId`) VALUES
(1, 'Huishouden', NULL),
(2, 'Schoonmaken', 1),
(3, 'Aan tafel', 1),
(4, 'Koken', 1),
(5, 'Bewaren', 1),
(6, 'Bestek', 3),
(7, 'Borden', 3),
(8, 'Potten en pannen', 3),
(9, 'Opdienen', 3),
(10, 'Glazen', 3),
(11, 'Tassen', 3),
(20, 'Klussen', NULL),
(21, 'Handgereedschap', 20),
(22, 'Tuinieren', 20),
(23, 'Ijzerwaren', 20),
(24, 'Powertools', 20),
(30, 'Wonen', NULL),
(31, 'Eettafel', 30),
(32, 'Bijzettafel', 30),
(33, 'Stoel', 30),
(34, 'Kruk', 30),
(35, 'Salontafel', 30),
(36, 'Sofa', 30),
(37, 'TV-meubel', 30),
(38, 'Dressoir', 30),
(39, 'Lade-kast', 30),
(40, 'Wandrek', 30),
(41, 'Kapstok', 30),
(42, 'Staande lamp', 30),
(43, 'Hanglamp', 30);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chatgesprekken`
--

CREATE TABLE `chatgesprekken` (
  `chatgesprekId` int(11) NOT NULL,
  `gebruikersAccountId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chatgespreklijnen`
--

CREATE TABLE `chatgespreklijnen` (
  `chatgesprekLijnId` int(11) NOT NULL,
  `chatgesprekId` int(11) NOT NULL,
  `bericht` varchar(255) NOT NULL,
  `tijdstip` timestamp NOT NULL DEFAULT current_timestamp(),
  `gebruikersAccountId` int(11) DEFAULT 0,
  `personeelslidAccountId` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contactpersonen`
--

CREATE TABLE `contactpersonen` (
  `contactpersoonId` int(11) NOT NULL,
  `voornaam` varchar(45) NOT NULL,
  `familienaam` varchar(45) NOT NULL,
  `functie` varchar(45) NOT NULL,
  `klantId` int(11) NOT NULL,
  `gebruikersAccountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contactpersonen`
--

INSERT INTO `contactpersonen` (`contactpersoonId`, `voornaam`, `familienaam`, `functie`, `klantId`, `gebruikersAccountId`) VALUES
(1, 'Ad', 'Ministrateur', 'CEO', 1, 2),
(2, 'In', 'Koper', 'Inkoper', 1, 8),
(3, 'De', 'Baas', 'De Baas', 7, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `eventwachtrijartikelen`
--

CREATE TABLE `eventwachtrijartikelen` (
  `artikelId` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `maxAantalInMagazijnPlaats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikersaccounts`
--

CREATE TABLE `gebruikersaccounts` (
  `gebruikersAccountId` int(11) NOT NULL,
  `emailadres` varchar(45) NOT NULL,
  `paswoord` varchar(255) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikersaccounts`
--

INSERT INTO `gebruikersaccounts` (`gebruikersAccountId`, `emailadres`, `paswoord`, `disabled`) VALUES
(1, 'anoniemeKlant@prularia.com', '', 1),
(2, 'ad.ministrateur@vdab.be', 'KlantVanPrularia', 0),
(3, 'alpha.klant@bestaatniet.be', 'KlantVanPrularia', 0),
(4, 'beta.client@bestaatniet.be', 'KlantVanPrularia', 0),
(5, 'gamma.customer@bestaatniet.be', 'KlantVanPrularia', 0),
(6, 'delta.kunde@bestaatniet.be', 'KlantVanPrularia', 0),
(7, 'eta.cliente@bestaatniet.be', 'KlantVanPrularia', 0),
(8, 'in.koper@vdab.be', 'KlantVanPrularia', 0),
(9, 'de.baas@rva.be', 'KlantVanPrularia', 0),
(10, 'xander.vanmalder@vdabcampus.be', 'Welkom2026', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkomendeleveringen`
--

CREATE TABLE `inkomendeleveringen` (
  `inkomendeLeveringsId` int(11) NOT NULL,
  `leveranciersId` int(11) NOT NULL,
  `leveringsbonNummer` varchar(45) NOT NULL,
  `leveringsbondatum` date NOT NULL,
  `leverDatum` date NOT NULL,
  `ontvangerPersoneelslidId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inkomendeleveringen`
--

INSERT INTO `inkomendeleveringen` (`inkomendeLeveringsId`, `leveranciersId`, `leveringsbonNummer`, `leveringsbondatum`, `leverDatum`, `ontvangerPersoneelslidId`) VALUES
(1, 5, '2022/786', '2022-02-11', '2022-02-15', 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkomendeleveringslijnen`
--

CREATE TABLE `inkomendeleveringslijnen` (
  `inkomendeLeveringsId` int(11) NOT NULL,
  `artikelId` int(11) NOT NULL,
  `aantalGoedgekeurd` int(11) NOT NULL,
  `aantalTeruggestuurd` int(11) NOT NULL DEFAULT 0,
  `magazijnPlaatsId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inkomendeleveringslijnen`
--

INSERT INTO `inkomendeleveringslijnen` (`inkomendeLeveringsId`, `artikelId`, `aantalGoedgekeurd`, `aantalTeruggestuurd`, `magazijnPlaatsId`) VALUES
(1, 1, 20, 0, 5),
(1, 2, 20, 0, 6),
(1, 3, 25, 0, 7),
(1, 3, 15, 0, 8),
(1, 205, 18, 2, 14),
(1, 210, 50, 0, 20),
(1, 210, 6, 4, 21);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int(11) NOT NULL,
  `facturatieAdresId` int(11) NOT NULL,
  `leveringsAdresId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantId`, `facturatieAdresId`, `leveringsAdresId`) VALUES
(1, 1, 7),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 8, 8),
(8, 9, 11);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klantenreviews`
--

CREATE TABLE `klantenreviews` (
  `klantenReviewId` int(11) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `score` int(11) NOT NULL,
  `commentaar` varchar(255) DEFAULT NULL,
  `datum` date NOT NULL,
  `bestellijnId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klantenreviews`
--

INSERT INTO `klantenreviews` (`klantenReviewId`, `nickname`, `score`, `commentaar`, `datum`, `bestellijnId`) VALUES
(1, 'CEO', 5, 'goed artikel, correcte prijs', '2026-03-26', 1),
(2, 'CEO', 1, 'luidruchtig', '2026-03-26', 2),
(3, 'CEO', 4, 'kleine krachtpatser', '2026-03-26', 3),
(4, 'CEO', 5, 'goed artikel, correcte prijs', '2026-03-26', 4),
(5, 'Alpha', 3, 'stevige stoel, afwerking kan beter', '2026-03-26', 5),
(6, 'Alpha', 2, 'niet zo stevig, vijzen komen snel terug los', '2026-03-26', 6),
(7, 'Beta', 4, 'mooi', '2026-03-26', 7),
(8, 'Beta', 5, 'mooi artikel, goed afgewerkt', '2026-03-26', 7),
(9, 'Xander', 5, 'Wa ne zaag!!!!', '2026-03-26', 21);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE `leveranciers` (
  `leveranciersId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `btwNummer` varchar(45) NOT NULL,
  `straat` varchar(45) NOT NULL,
  `huisNummer` varchar(5) NOT NULL,
  `bus` varchar(5) DEFAULT NULL,
  `plaatsId` int(11) NOT NULL,
  `familienaamContactpersoon` varchar(45) NOT NULL,
  `voornaamContactpersoon` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`leveranciersId`, `naam`, `btwNummer`, `straat`, `huisNummer`, `bus`, `plaatsId`, `familienaamContactpersoon`, `voornaamContactpersoon`) VALUES
(1, 'Mooie meubels', '1234567890', 'Somersstraat', '22', NULL, 62, 'Deur', 'D.'),
(2, 'Alles om te bewaren', '2345678901', 'Industrieweg', '50', NULL, 2701, 'Deksel', 'A.'),
(3, 'Tafelen en dineren', '3456789012', 'Interleuvenlaan', '2', NULL, 1037, 'Bord', 'X.'),
(4, 'Doe-het-zelf', '4567890123', 'Vlamingstraat', '10', NULL, 2657, 'Klusser', 'E'),
(5, 'Groothandel HierVindJeAlles', '5678901234', 'Thor Park', '8040', NULL, 790, 'Thor', 'I.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `magazijnplaatsen`
--

CREATE TABLE `magazijnplaatsen` (
  `magazijnPlaatsId` int(11) NOT NULL,
  `artikelId` int(11) DEFAULT NULL,
  `rij` char(1) NOT NULL,
  `rek` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `magazijnplaatsen`
--

INSERT INTO `magazijnplaatsen` (`magazijnPlaatsId`, `artikelId`, `rij`, `rek`, `aantal`) VALUES
(1, 1, 'A', 1, 25),
(2, 1, 'A', 2, 25),
(3, 2, 'A', 3, 25),
(4, 2, 'A', 4, 25),
(5, 3, 'A', 5, 25),
(6, 3, 'A', 6, 25),
(7, 4, 'A', 7, 6),
(8, 4, 'A', 8, 6),
(9, 4, 'A', 9, 6),
(10, 4, 'A', 10, 6),
(11, 4, 'A', 11, 6),
(12, 4, 'A', 12, 6),
(13, 4, 'A', 13, 6),
(14, 4, 'A', 14, 6),
(15, 4, 'A', 15, 2),
(16, 5, 'A', 16, 6),
(17, 5, 'A', 17, 6),
(18, 5, 'A', 18, 6),
(19, 5, 'A', 19, 6),
(20, 5, 'A', 20, 6),
(21, 5, 'A', 21, 6),
(22, 5, 'A', 22, 6),
(23, 5, 'A', 23, 6),
(24, 5, 'A', 24, 2),
(25, 6, 'A', 25, 6),
(26, 6, 'A', 26, 6),
(27, 6, 'A', 27, 6),
(28, 6, 'A', 28, 6),
(29, 6, 'A', 29, 6),
(30, 6, 'A', 30, 6),
(31, 6, 'A', 31, 6),
(32, 6, 'A', 32, 6),
(33, 6, 'A', 33, 2),
(34, 7, 'A', 34, 6),
(35, 7, 'A', 35, 6),
(36, 7, 'A', 36, 6),
(37, 7, 'A', 37, 6),
(38, 7, 'A', 38, 6),
(39, 7, 'A', 39, 6),
(40, 7, 'A', 40, 6),
(41, 7, 'A', 41, 6),
(42, 7, 'A', 42, 2),
(43, 8, 'A', 43, 6),
(44, 8, 'A', 44, 6),
(45, 8, 'A', 45, 6),
(46, 8, 'A', 46, 6),
(47, 8, 'A', 47, 6),
(48, 8, 'A', 48, 6),
(49, 8, 'A', 49, 6),
(50, 8, 'A', 50, 6),
(51, 8, 'A', 51, 2),
(52, 9, 'A', 52, 6),
(53, 9, 'A', 53, 6),
(54, 9, 'A', 54, 6),
(55, 9, 'A', 55, 6),
(56, 9, 'A', 56, 6),
(57, 9, 'A', 57, 6),
(58, 9, 'A', 58, 6),
(59, 9, 'A', 59, 6),
(60, 9, 'A', 60, 2),
(61, 10, 'B', 1, 6),
(62, 10, 'B', 2, 6),
(63, 10, 'B', 3, 6),
(64, 10, 'B', 4, 6),
(65, 10, 'B', 5, 6),
(66, 10, 'B', 6, 6),
(67, 10, 'B', 7, 6),
(68, 10, 'B', 8, 6),
(69, 10, 'B', 9, 2),
(70, 11, 'B', 10, 6),
(71, 11, 'B', 11, 6),
(72, 11, 'B', 12, 6),
(73, 11, 'B', 13, 6),
(74, 11, 'B', 14, 6),
(75, 11, 'B', 15, 6),
(76, 11, 'B', 16, 6),
(77, 11, 'B', 17, 6),
(78, 11, 'B', 18, 2),
(79, 12, 'B', 19, 6),
(80, 12, 'B', 20, 6),
(81, 12, 'B', 21, 6),
(82, 12, 'B', 22, 6),
(83, 12, 'B', 23, 6),
(84, 12, 'B', 24, 6),
(85, 12, 'B', 25, 6),
(86, 12, 'B', 26, 6),
(87, 12, 'B', 27, 2),
(88, 13, 'B', 28, 6),
(89, 13, 'B', 29, 6),
(90, 13, 'B', 30, 6),
(91, 13, 'B', 31, 6),
(92, 13, 'B', 32, 6),
(93, 13, 'B', 33, 6),
(94, 13, 'B', 34, 6),
(95, 13, 'B', 35, 6),
(96, 13, 'B', 36, 2),
(97, 14, 'B', 37, 6),
(98, 14, 'B', 38, 6),
(99, 14, 'B', 39, 6),
(100, 14, 'B', 40, 6),
(101, 14, 'B', 41, 6),
(102, 14, 'B', 42, 6),
(103, 14, 'B', 43, 6),
(104, 14, 'B', 44, 6),
(105, 14, 'B', 45, 2),
(106, 15, 'B', 46, 6),
(107, 15, 'B', 47, 6),
(108, 15, 'B', 48, 6),
(109, 15, 'B', 49, 6),
(110, 15, 'B', 50, 6),
(111, 15, 'B', 51, 6),
(112, 15, 'B', 52, 6),
(113, 15, 'B', 53, 6),
(114, 15, 'B', 54, 2),
(115, 16, 'B', 55, 10),
(116, 16, 'B', 56, 10),
(117, 16, 'B', 57, 10),
(118, 16, 'B', 58, 10),
(119, 16, 'B', 59, 10),
(120, 17, 'B', 60, 10),
(121, 17, 'C', 1, 10),
(122, 17, 'C', 2, 10),
(123, 17, 'C', 3, 10),
(124, 17, 'C', 4, 10),
(125, 18, 'C', 5, 10),
(126, 18, 'C', 6, 10),
(127, 18, 'C', 7, 10),
(128, 18, 'C', 8, 10),
(129, 18, 'C', 9, 10),
(130, 19, 'C', 10, 1),
(131, 19, 'C', 11, 1),
(132, 19, 'C', 12, 1),
(133, 19, 'C', 13, 1),
(134, 19, 'C', 14, 1),
(135, 20, 'C', 15, 1),
(136, 20, 'C', 16, 1),
(137, 20, 'C', 17, 1),
(138, 20, 'C', 18, 1),
(139, 20, 'C', 19, 1),
(140, 21, 'C', 20, 1),
(141, 21, 'C', 21, 1),
(142, 21, 'C', 22, 1),
(143, 21, 'C', 23, 1),
(144, 21, 'C', 24, 1),
(145, 22, 'C', 25, 1),
(146, 22, 'C', 26, 1),
(147, 22, 'C', 27, 1),
(148, 22, 'C', 28, 1),
(149, 22, 'C', 29, 1),
(150, 23, 'C', 30, 1),
(151, 23, 'C', 31, 1),
(152, 23, 'C', 32, 1),
(153, 23, 'C', 33, 1),
(154, 23, 'C', 34, 1),
(155, 24, 'C', 35, 1),
(156, 24, 'C', 36, 1),
(157, 24, 'C', 37, 1),
(158, 24, 'C', 38, 1),
(159, 24, 'C', 39, 1),
(160, 25, 'C', 40, 1),
(161, 25, 'C', 41, 1),
(162, 25, 'C', 42, 1),
(163, 25, 'C', 43, 1),
(164, 25, 'C', 44, 1),
(165, 26, 'C', 45, 1),
(166, 26, 'C', 46, 1),
(167, 26, 'C', 47, 1),
(168, 26, 'C', 48, 1),
(169, 26, 'C', 49, 1),
(170, 27, 'C', 50, 1),
(171, 27, 'C', 51, 1),
(172, 27, 'C', 52, 1),
(173, 27, 'C', 53, 1),
(174, 27, 'C', 54, 1),
(175, 28, 'C', 55, 1),
(176, 28, 'C', 56, 1),
(177, 28, 'C', 57, 1),
(178, 28, 'C', 58, 1),
(179, 28, 'C', 59, 1),
(180, 29, 'C', 60, 5),
(181, 30, 'D', 1, 5),
(182, 31, 'D', 2, 5),
(183, 32, 'D', 3, 5),
(184, 33, 'D', 4, 1),
(185, 33, 'D', 5, 1),
(186, 33, 'D', 6, 1),
(187, 33, 'D', 7, 1),
(188, 33, 'D', 8, 1),
(189, 34, 'D', 9, 1),
(190, 34, 'D', 10, 1),
(191, 34, 'D', 11, 1),
(192, 34, 'D', 12, 1),
(193, 34, 'D', 13, 1),
(194, 35, 'D', 14, 1),
(195, 35, 'D', 15, 1),
(196, 35, 'D', 16, 1),
(197, 35, 'D', 17, 1),
(198, 35, 'D', 18, 1),
(199, 36, 'D', 19, 1),
(200, 36, 'D', 20, 1),
(201, 36, 'D', 21, 1),
(202, 36, 'D', 22, 1),
(203, 36, 'D', 23, 1),
(204, 37, 'D', 24, 1),
(205, 37, 'D', 25, 1),
(206, 37, 'D', 26, 1),
(207, 37, 'D', 27, 1),
(208, 37, 'D', 28, 1),
(209, 38, 'D', 29, 1),
(210, 38, 'D', 30, 1),
(211, 38, 'D', 31, 1),
(212, 38, 'D', 32, 1),
(213, 38, 'D', 33, 1),
(214, 39, 'D', 34, 2),
(215, 39, 'D', 35, 2),
(216, 39, 'D', 36, 1),
(217, 40, 'D', 37, 2),
(218, 40, 'D', 38, 2),
(219, 40, 'D', 39, 1),
(220, 41, 'D', 40, 2),
(221, 41, 'D', 41, 2),
(222, 41, 'D', 42, 1),
(223, 42, 'D', 43, 2),
(224, 42, 'D', 44, 2),
(225, 42, 'D', 45, 1),
(226, 43, 'D', 46, 1),
(227, 43, 'D', 47, 1),
(228, 43, 'D', 48, 1),
(229, 43, 'D', 49, 1),
(230, 43, 'D', 50, 1),
(231, 44, 'D', 51, 1),
(232, 44, 'D', 52, 1),
(233, 44, 'D', 53, 1),
(234, 44, 'D', 54, 1),
(235, 44, 'D', 55, 1),
(236, 45, 'D', 56, 1),
(237, 45, 'D', 57, 1),
(238, 45, 'D', 58, 1),
(239, 45, 'D', 59, 1),
(240, 45, 'D', 60, 1),
(241, 46, 'E', 1, 1),
(242, 46, 'E', 2, 1),
(243, 46, 'E', 3, 1),
(244, 46, 'E', 4, 1),
(245, 46, 'E', 5, 1),
(246, 47, 'E', 6, 1),
(247, 47, 'E', 7, 1),
(248, 47, 'E', 8, 1),
(249, 47, 'E', 9, 1),
(250, 47, 'E', 10, 1),
(251, 48, 'E', 11, 1),
(252, 48, 'E', 12, 1),
(253, 48, 'E', 13, 1),
(254, 48, 'E', 14, 1),
(255, 48, 'E', 15, 1),
(256, 49, 'E', 16, 1),
(257, 49, 'E', 17, 1),
(258, 49, 'E', 18, 1),
(259, 49, 'E', 19, 1),
(260, 49, 'E', 20, 1),
(261, 50, 'E', 21, 4),
(262, 50, 'E', 22, 1),
(263, 51, 'E', 23, 4),
(264, 51, 'E', 24, 1),
(265, 52, 'E', 25, 4),
(266, 52, 'E', 26, 1),
(267, 53, 'E', 27, 4),
(268, 53, 'E', 28, 1),
(269, 54, 'E', 29, 2),
(270, 54, 'E', 30, 2),
(271, 54, 'E', 31, 1),
(272, 55, 'E', 32, 2),
(273, 55, 'E', 33, 2),
(274, 55, 'E', 34, 1),
(275, 56, 'E', 35, 2),
(276, 56, 'E', 36, 2),
(277, 56, 'E', 37, 1),
(278, 57, 'E', 38, 2),
(279, 57, 'E', 39, 2),
(280, 57, 'E', 40, 1),
(281, 58, 'E', 41, 5),
(282, 59, 'E', 42, 5),
(283, 60, 'E', 43, 5),
(284, 61, 'E', 44, 5),
(285, 62, 'E', 45, 5),
(286, 63, 'E', 46, 5),
(287, 64, 'E', 47, 5),
(288, 65, 'E', 48, 5),
(289, 66, 'E', 49, 5),
(290, 67, 'E', 50, 5),
(291, 68, 'E', 51, 5),
(292, 69, 'E', 52, 5),
(293, 70, 'E', 53, 5),
(294, 71, 'E', 54, 5),
(295, 72, 'E', 55, 5),
(296, 73, 'E', 56, 5),
(297, 74, 'E', 57, 5),
(298, 75, 'E', 58, 5),
(299, 76, 'E', 59, 5),
(300, 77, 'E', 60, 5),
(301, 78, 'F', 1, 5),
(302, 79, 'F', 2, 5),
(303, 80, 'F', 3, 5),
(304, 81, 'F', 4, 5),
(305, 82, 'F', 5, 5),
(306, 83, 'F', 6, 5),
(307, 84, 'F', 7, 5),
(308, 85, 'F', 8, 5),
(309, 86, 'F', 9, 5),
(310, 87, 'F', 10, 5),
(311, 88, 'F', 11, 5),
(312, 89, 'F', 12, 5),
(313, 90, 'F', 13, 5),
(314, 91, 'F', 14, 5),
(315, 92, 'F', 15, 5),
(316, 93, 'F', 16, 5),
(317, 94, 'F', 17, 5),
(318, 95, 'F', 18, 5),
(319, 96, 'F', 19, 5),
(320, 97, 'F', 20, 5),
(321, 98, 'F', 21, 5),
(322, 99, 'F', 22, 5),
(323, 100, 'F', 23, 5),
(324, 101, 'F', 24, 5),
(325, 102, 'F', 25, 5),
(326, 103, 'F', 26, 5),
(327, 104, 'F', 27, 5),
(328, 105, 'F', 28, 5),
(329, 106, 'F', 29, 5),
(330, 107, 'F', 30, 5),
(331, 108, 'F', 31, 5),
(332, 109, 'F', 32, 5),
(333, 110, 'F', 33, 5),
(334, 111, 'F', 34, 5),
(335, 112, 'F', 35, 5),
(336, 113, 'F', 36, 5),
(337, 114, 'F', 37, 5),
(338, 115, 'F', 38, 5),
(339, 116, 'F', 39, 5),
(340, 117, 'F', 40, 5),
(341, 118, 'F', 41, 5),
(342, 119, 'F', 42, 5),
(343, 120, 'F', 43, 5),
(344, 121, 'F', 44, 5),
(345, 122, 'F', 45, 25),
(346, 122, 'F', 46, 25),
(347, 123, 'F', 47, 25),
(348, 123, 'F', 48, 25),
(349, 124, 'F', 49, 25),
(350, 124, 'F', 50, 25),
(351, 125, 'F', 51, 25),
(352, 125, 'F', 52, 25),
(353, 126, 'F', 53, 25),
(354, 126, 'F', 54, 25),
(355, 127, 'F', 55, 25),
(356, 127, 'F', 56, 25),
(357, 128, 'F', 57, 25),
(358, 128, 'F', 58, 25),
(359, 129, 'F', 59, 25),
(360, 129, 'F', 60, 25),
(361, 130, 'G', 1, 25),
(362, 130, 'G', 2, 25),
(363, 131, 'G', 3, 25),
(364, 131, 'G', 4, 25),
(365, 132, 'G', 5, 25),
(366, 132, 'G', 6, 25),
(367, 133, 'G', 7, 25),
(368, 133, 'G', 8, 25),
(369, 134, 'G', 9, 25),
(370, 134, 'G', 10, 25),
(371, 135, 'G', 11, 25),
(372, 135, 'G', 12, 25),
(373, 136, 'G', 13, 25),
(374, 136, 'G', 14, 25),
(375, 137, 'G', 15, 25),
(376, 137, 'G', 16, 25),
(377, 138, 'G', 17, 25),
(378, 138, 'G', 18, 25),
(379, 139, 'G', 19, 25),
(380, 139, 'G', 20, 25),
(381, 140, 'G', 21, 25),
(382, 140, 'G', 22, 25),
(383, 141, 'G', 23, 25),
(384, 141, 'G', 24, 25),
(385, 142, 'G', 25, 25),
(386, 142, 'G', 26, 25),
(387, 143, 'G', 27, 25),
(388, 143, 'G', 28, 25),
(389, 144, 'G', 29, 25),
(390, 144, 'G', 30, 25),
(391, 145, 'G', 31, 25),
(392, 145, 'G', 32, 25),
(393, 146, 'G', 33, 25),
(394, 146, 'G', 34, 25),
(395, 147, 'G', 35, 25),
(396, 147, 'G', 36, 25),
(397, 148, 'G', 37, 25),
(398, 148, 'G', 38, 25),
(399, 149, 'G', 39, 25),
(400, 149, 'G', 40, 25),
(401, 150, 'G', 41, 25),
(402, 150, 'G', 42, 25),
(403, 151, 'G', 43, 25),
(404, 151, 'G', 44, 25),
(405, 152, 'G', 45, 25),
(406, 152, 'G', 46, 25),
(407, 153, 'G', 47, 25),
(408, 153, 'G', 48, 25),
(409, 154, 'G', 49, 25),
(410, 154, 'G', 50, 25),
(411, 155, 'G', 51, 25),
(412, 155, 'G', 52, 25),
(413, 156, 'G', 53, 25),
(414, 156, 'G', 54, 25),
(415, 157, 'G', 55, 25),
(416, 157, 'G', 56, 25),
(417, 158, 'G', 57, 25),
(418, 158, 'G', 58, 25),
(419, 159, 'G', 59, 25),
(420, 159, 'G', 60, 25),
(421, 160, 'H', 1, 25),
(422, 160, 'H', 2, 25),
(423, 161, 'H', 3, 50),
(424, 162, 'H', 4, 50),
(425, 163, 'H', 5, 50),
(426, 164, 'H', 6, 50),
(427, 165, 'H', 7, 50),
(428, 166, 'H', 8, 50),
(429, 167, 'H', 9, 50),
(430, 168, 'H', 10, 50),
(431, 169, 'H', 11, 50),
(432, 170, 'H', 12, 50),
(433, 171, 'H', 13, 50),
(434, 172, 'H', 14, 50),
(435, 173, 'H', 15, 50),
(436, 174, 'H', 16, 50),
(437, 175, 'H', 17, 50),
(438, 176, 'H', 18, 50),
(439, 177, 'H', 19, 50),
(440, 178, 'H', 20, 50),
(441, 179, 'H', 21, 50),
(442, 180, 'H', 22, 50),
(443, 181, 'H', 23, 50),
(444, 182, 'H', 24, 50),
(445, 183, 'H', 25, 50),
(446, 184, 'H', 26, 50),
(447, 185, 'H', 27, 50),
(448, 186, 'H', 28, 50),
(449, 187, 'H', 29, 50),
(450, 188, 'H', 30, 50),
(451, 189, 'H', 31, 50),
(452, 190, 'H', 32, 50),
(453, 191, 'H', 33, 50),
(454, 192, 'H', 34, 50),
(455, 193, 'H', 35, 50),
(456, 194, 'H', 36, 50),
(457, 195, 'H', 37, 50),
(458, 196, 'H', 38, 50),
(459, 197, 'H', 39, 50),
(460, 198, 'H', 40, 50),
(461, 199, 'H', 41, 50),
(462, 200, 'H', 42, 50),
(463, 201, 'H', 43, 50),
(464, 202, 'H', 44, 50),
(465, 203, 'H', 45, 50),
(466, 204, 'H', 46, 50),
(467, 205, 'H', 47, 50),
(468, 206, 'H', 48, 50),
(469, 207, 'H', 49, 50),
(470, 208, 'H', 50, 50),
(471, 209, 'H', 51, 50),
(472, 210, 'H', 52, 50),
(473, 211, 'H', 53, 50),
(474, 212, 'H', 54, 50),
(475, 213, 'H', 55, 50),
(476, 214, 'H', 56, 50),
(477, 215, 'H', 57, 50),
(478, 216, 'H', 58, 50),
(479, 217, 'H', 59, 50),
(480, 218, 'H', 60, 50),
(481, 219, 'I', 1, 50),
(482, 220, 'I', 2, 50),
(483, 221, 'I', 3, 50),
(484, 222, 'I', 4, 50),
(485, 223, 'I', 5, 50),
(486, 224, 'I', 6, 50),
(487, 225, 'I', 7, 50),
(488, 226, 'I', 8, 50),
(489, 227, 'I', 9, 50),
(490, 228, 'I', 10, 50),
(491, 229, 'I', 11, 50),
(492, 230, 'I', 12, 50),
(493, 231, 'I', 13, 50),
(494, 232, 'I', 14, 50),
(495, 233, 'I', 15, 50),
(496, 234, 'I', 16, 50),
(497, 235, 'I', 17, 50),
(498, 236, 'I', 18, 50),
(499, 237, 'I', 19, 50),
(500, 238, 'I', 20, 50),
(501, 239, 'I', 21, 50),
(502, 240, 'I', 22, 50),
(503, 241, 'I', 23, 50),
(504, 242, 'I', 24, 10),
(505, 242, 'I', 25, 10),
(506, 242, 'I', 26, 5),
(507, 243, 'I', 27, 10),
(508, 243, 'I', 28, 10),
(509, 243, 'I', 29, 5),
(510, 244, 'I', 30, 10),
(511, 244, 'I', 31, 10),
(512, 244, 'I', 32, 5),
(513, 245, 'I', 33, 10),
(514, 245, 'I', 34, 10),
(515, 245, 'I', 35, 5),
(516, 246, 'I', 36, 10),
(517, 246, 'I', 37, 10),
(518, 246, 'I', 38, 5),
(519, 247, 'I', 39, 10),
(520, 247, 'I', 40, 10),
(521, 247, 'I', 41, 5),
(522, 248, 'I', 42, 10),
(523, 248, 'I', 43, 10),
(524, 248, 'I', 44, 5),
(525, 249, 'I', 45, 10),
(526, 249, 'I', 46, 10),
(527, 249, 'I', 47, 5),
(528, 250, 'I', 48, 10),
(529, 250, 'I', 49, 10),
(530, 250, 'I', 50, 5),
(531, 251, 'I', 51, 10),
(532, 251, 'I', 52, 10),
(533, 251, 'I', 53, 5),
(534, 252, 'I', 54, 10),
(535, 252, 'I', 55, 10),
(536, 252, 'I', 56, 5),
(537, 253, 'I', 57, 10),
(538, 253, 'I', 58, 10),
(539, 253, 'I', 59, 5),
(540, 254, 'I', 60, 10),
(541, 254, 'J', 1, 10),
(542, 254, 'J', 2, 5),
(543, 255, 'J', 3, 10),
(544, 255, 'J', 4, 10),
(545, 255, 'J', 5, 5),
(546, 256, 'J', 6, 10),
(547, 256, 'J', 7, 10),
(548, 256, 'J', 8, 5),
(549, 257, 'J', 9, 10),
(550, 257, 'J', 10, 10),
(551, 257, 'J', 11, 5),
(552, 258, 'J', 12, 5),
(553, 259, 'J', 13, 5),
(554, 260, 'J', 14, 5),
(555, 261, 'J', 15, 5),
(556, 262, 'J', 16, 5),
(557, 263, 'J', 17, 5),
(558, 264, 'J', 18, 5),
(559, 265, 'J', 19, 5),
(560, 266, 'J', 20, 5),
(561, NULL, 'J', 21, 0),
(562, NULL, 'J', 22, 0),
(563, NULL, 'J', 23, 0),
(564, NULL, 'J', 24, 0),
(565, NULL, 'J', 25, 0),
(566, NULL, 'J', 26, 0),
(567, NULL, 'J', 27, 0),
(568, NULL, 'J', 28, 0),
(569, NULL, 'J', 29, 0),
(570, NULL, 'J', 30, 0),
(571, NULL, 'J', 31, 0),
(572, NULL, 'J', 32, 0),
(573, NULL, 'J', 33, 0),
(574, NULL, 'J', 34, 0),
(575, NULL, 'J', 35, 0),
(576, NULL, 'J', 36, 0),
(577, NULL, 'J', 37, 0),
(578, NULL, 'J', 38, 0),
(579, NULL, 'J', 39, 0),
(580, NULL, 'J', 40, 0),
(581, NULL, 'J', 41, 0),
(582, NULL, 'J', 42, 0),
(583, NULL, 'J', 43, 0),
(584, NULL, 'J', 44, 0),
(585, NULL, 'J', 45, 0),
(586, NULL, 'J', 46, 0),
(587, NULL, 'J', 47, 0),
(588, NULL, 'J', 48, 0),
(589, NULL, 'J', 49, 0),
(590, NULL, 'J', 50, 0),
(591, NULL, 'J', 51, 0),
(592, NULL, 'J', 52, 0),
(593, NULL, 'J', 53, 0),
(594, NULL, 'J', 54, 0),
(595, NULL, 'J', 55, 0),
(596, NULL, 'J', 56, 0),
(597, NULL, 'J', 57, 0),
(598, NULL, 'J', 58, 0),
(599, NULL, 'J', 59, 0),
(600, NULL, 'J', 60, 0),
(601, NULL, 'K', 1, 0),
(602, NULL, 'K', 2, 0),
(603, NULL, 'K', 3, 0),
(604, NULL, 'K', 4, 0),
(605, NULL, 'K', 5, 0),
(606, NULL, 'K', 6, 0),
(607, NULL, 'K', 7, 0),
(608, NULL, 'K', 8, 0),
(609, NULL, 'K', 9, 0),
(610, NULL, 'K', 10, 0),
(611, NULL, 'K', 11, 0),
(612, NULL, 'K', 12, 0),
(613, NULL, 'K', 13, 0),
(614, NULL, 'K', 14, 0),
(615, NULL, 'K', 15, 0),
(616, NULL, 'K', 16, 0),
(617, NULL, 'K', 17, 0),
(618, NULL, 'K', 18, 0),
(619, NULL, 'K', 19, 0),
(620, NULL, 'K', 20, 0),
(621, NULL, 'K', 21, 0),
(622, NULL, 'K', 22, 0),
(623, NULL, 'K', 23, 0),
(624, NULL, 'K', 24, 0),
(625, NULL, 'K', 25, 0),
(626, NULL, 'K', 26, 0),
(627, NULL, 'K', 27, 0),
(628, NULL, 'K', 28, 0),
(629, NULL, 'K', 29, 0),
(630, NULL, 'K', 30, 0),
(631, NULL, 'K', 31, 0),
(632, NULL, 'K', 32, 0),
(633, NULL, 'K', 33, 0),
(634, NULL, 'K', 34, 0),
(635, NULL, 'K', 35, 0),
(636, NULL, 'K', 36, 0),
(637, NULL, 'K', 37, 0),
(638, NULL, 'K', 38, 0),
(639, NULL, 'K', 39, 0),
(640, NULL, 'K', 40, 0),
(641, NULL, 'K', 41, 0),
(642, NULL, 'K', 42, 0),
(643, NULL, 'K', 43, 0),
(644, NULL, 'K', 44, 0),
(645, NULL, 'K', 45, 0),
(646, NULL, 'K', 46, 0),
(647, NULL, 'K', 47, 0),
(648, NULL, 'K', 48, 0),
(649, NULL, 'K', 49, 0),
(650, NULL, 'K', 50, 0),
(651, NULL, 'K', 51, 0),
(652, NULL, 'K', 52, 0),
(653, NULL, 'K', 53, 0),
(654, NULL, 'K', 54, 0),
(655, NULL, 'K', 55, 0),
(656, NULL, 'K', 56, 0),
(657, NULL, 'K', 57, 0),
(658, NULL, 'K', 58, 0),
(659, NULL, 'K', 59, 0),
(660, NULL, 'K', 60, 0),
(661, NULL, 'L', 1, 0),
(662, NULL, 'L', 2, 0),
(663, NULL, 'L', 3, 0),
(664, NULL, 'L', 4, 0),
(665, NULL, 'L', 5, 0),
(666, NULL, 'L', 6, 0),
(667, NULL, 'L', 7, 0),
(668, NULL, 'L', 8, 0),
(669, NULL, 'L', 9, 0),
(670, NULL, 'L', 10, 0),
(671, NULL, 'L', 11, 0),
(672, NULL, 'L', 12, 0),
(673, NULL, 'L', 13, 0),
(674, NULL, 'L', 14, 0),
(675, NULL, 'L', 15, 0),
(676, NULL, 'L', 16, 0),
(677, NULL, 'L', 17, 0),
(678, NULL, 'L', 18, 0),
(679, NULL, 'L', 19, 0),
(680, NULL, 'L', 20, 0),
(681, NULL, 'L', 21, 0),
(682, NULL, 'L', 22, 0),
(683, NULL, 'L', 23, 0),
(684, NULL, 'L', 24, 0),
(685, NULL, 'L', 25, 0),
(686, NULL, 'L', 26, 0),
(687, NULL, 'L', 27, 0),
(688, NULL, 'L', 28, 0),
(689, NULL, 'L', 29, 0),
(690, NULL, 'L', 30, 0),
(691, NULL, 'L', 31, 0),
(692, NULL, 'L', 32, 0),
(693, NULL, 'L', 33, 0),
(694, NULL, 'L', 34, 0),
(695, NULL, 'L', 35, 0),
(696, NULL, 'L', 36, 0),
(697, NULL, 'L', 37, 0),
(698, NULL, 'L', 38, 0),
(699, NULL, 'L', 39, 0),
(700, NULL, 'L', 40, 0),
(701, NULL, 'L', 41, 0),
(702, NULL, 'L', 42, 0),
(703, NULL, 'L', 43, 0),
(704, NULL, 'L', 44, 0),
(705, NULL, 'L', 45, 0),
(706, NULL, 'L', 46, 0),
(707, NULL, 'L', 47, 0),
(708, NULL, 'L', 48, 0),
(709, NULL, 'L', 49, 0),
(710, NULL, 'L', 50, 0),
(711, NULL, 'L', 51, 0),
(712, NULL, 'L', 52, 0),
(713, NULL, 'L', 53, 0),
(714, NULL, 'L', 54, 0),
(715, NULL, 'L', 55, 0),
(716, NULL, 'L', 56, 0),
(717, NULL, 'L', 57, 0),
(718, NULL, 'L', 58, 0),
(719, NULL, 'L', 59, 0),
(720, NULL, 'L', 60, 0),
(721, NULL, 'M', 1, 0),
(722, NULL, 'M', 2, 0),
(723, NULL, 'M', 3, 0),
(724, NULL, 'M', 4, 0),
(725, NULL, 'M', 5, 0),
(726, NULL, 'M', 6, 0),
(727, NULL, 'M', 7, 0),
(728, NULL, 'M', 8, 0),
(729, NULL, 'M', 9, 0),
(730, NULL, 'M', 10, 0),
(731, NULL, 'M', 11, 0),
(732, NULL, 'M', 12, 0),
(733, NULL, 'M', 13, 0),
(734, NULL, 'M', 14, 0),
(735, NULL, 'M', 15, 0),
(736, NULL, 'M', 16, 0),
(737, NULL, 'M', 17, 0),
(738, NULL, 'M', 18, 0),
(739, NULL, 'M', 19, 0),
(740, NULL, 'M', 20, 0),
(741, NULL, 'M', 21, 0),
(742, NULL, 'M', 22, 0),
(743, NULL, 'M', 23, 0),
(744, NULL, 'M', 24, 0),
(745, NULL, 'M', 25, 0),
(746, NULL, 'M', 26, 0),
(747, NULL, 'M', 27, 0),
(748, NULL, 'M', 28, 0),
(749, NULL, 'M', 29, 0),
(750, NULL, 'M', 30, 0),
(751, NULL, 'M', 31, 0),
(752, NULL, 'M', 32, 0),
(753, NULL, 'M', 33, 0),
(754, NULL, 'M', 34, 0),
(755, NULL, 'M', 35, 0),
(756, NULL, 'M', 36, 0),
(757, NULL, 'M', 37, 0),
(758, NULL, 'M', 38, 0),
(759, NULL, 'M', 39, 0),
(760, NULL, 'M', 40, 0),
(761, NULL, 'M', 41, 0),
(762, NULL, 'M', 42, 0),
(763, NULL, 'M', 43, 0),
(764, NULL, 'M', 44, 0),
(765, NULL, 'M', 45, 0),
(766, NULL, 'M', 46, 0),
(767, NULL, 'M', 47, 0),
(768, NULL, 'M', 48, 0),
(769, NULL, 'M', 49, 0),
(770, NULL, 'M', 50, 0),
(771, NULL, 'M', 51, 0),
(772, NULL, 'M', 52, 0),
(773, NULL, 'M', 53, 0),
(774, NULL, 'M', 54, 0),
(775, NULL, 'M', 55, 0),
(776, NULL, 'M', 56, 0),
(777, NULL, 'M', 57, 0),
(778, NULL, 'M', 58, 0),
(779, NULL, 'M', 59, 0),
(780, NULL, 'M', 60, 0),
(781, NULL, 'N', 1, 0),
(782, NULL, 'N', 2, 0),
(783, NULL, 'N', 3, 0),
(784, NULL, 'N', 4, 0),
(785, NULL, 'N', 5, 0),
(786, NULL, 'N', 6, 0),
(787, NULL, 'N', 7, 0),
(788, NULL, 'N', 8, 0),
(789, NULL, 'N', 9, 0),
(790, NULL, 'N', 10, 0),
(791, NULL, 'N', 11, 0),
(792, NULL, 'N', 12, 0),
(793, NULL, 'N', 13, 0),
(794, NULL, 'N', 14, 0),
(795, NULL, 'N', 15, 0),
(796, NULL, 'N', 16, 0),
(797, NULL, 'N', 17, 0),
(798, NULL, 'N', 18, 0),
(799, NULL, 'N', 19, 0),
(800, NULL, 'N', 20, 0),
(801, NULL, 'N', 21, 0),
(802, NULL, 'N', 22, 0),
(803, NULL, 'N', 23, 0),
(804, NULL, 'N', 24, 0),
(805, NULL, 'N', 25, 0),
(806, NULL, 'N', 26, 0),
(807, NULL, 'N', 27, 0),
(808, NULL, 'N', 28, 0),
(809, NULL, 'N', 29, 0),
(810, NULL, 'N', 30, 0),
(811, NULL, 'N', 31, 0),
(812, NULL, 'N', 32, 0),
(813, NULL, 'N', 33, 0),
(814, NULL, 'N', 34, 0),
(815, NULL, 'N', 35, 0),
(816, NULL, 'N', 36, 0),
(817, NULL, 'N', 37, 0),
(818, NULL, 'N', 38, 0),
(819, NULL, 'N', 39, 0),
(820, NULL, 'N', 40, 0),
(821, NULL, 'N', 41, 0),
(822, NULL, 'N', 42, 0),
(823, NULL, 'N', 43, 0),
(824, NULL, 'N', 44, 0),
(825, NULL, 'N', 45, 0),
(826, NULL, 'N', 46, 0),
(827, NULL, 'N', 47, 0),
(828, NULL, 'N', 48, 0),
(829, NULL, 'N', 49, 0),
(830, NULL, 'N', 50, 0),
(831, NULL, 'N', 51, 0),
(832, NULL, 'N', 52, 0),
(833, NULL, 'N', 53, 0),
(834, NULL, 'N', 54, 0),
(835, NULL, 'N', 55, 0),
(836, NULL, 'N', 56, 0),
(837, NULL, 'N', 57, 0),
(838, NULL, 'N', 58, 0),
(839, NULL, 'N', 59, 0),
(840, NULL, 'N', 60, 0),
(841, NULL, 'O', 1, 0),
(842, NULL, 'O', 2, 0),
(843, NULL, 'O', 3, 0),
(844, NULL, 'O', 4, 0),
(845, NULL, 'O', 5, 0),
(846, NULL, 'O', 6, 0),
(847, NULL, 'O', 7, 0),
(848, NULL, 'O', 8, 0),
(849, NULL, 'O', 9, 0),
(850, NULL, 'O', 10, 0),
(851, NULL, 'O', 11, 0),
(852, NULL, 'O', 12, 0),
(853, NULL, 'O', 13, 0),
(854, NULL, 'O', 14, 0),
(855, NULL, 'O', 15, 0),
(856, NULL, 'O', 16, 0),
(857, NULL, 'O', 17, 0),
(858, NULL, 'O', 18, 0),
(859, NULL, 'O', 19, 0),
(860, NULL, 'O', 20, 0),
(861, NULL, 'O', 21, 0),
(862, NULL, 'O', 22, 0),
(863, NULL, 'O', 23, 0),
(864, NULL, 'O', 24, 0),
(865, NULL, 'O', 25, 0),
(866, NULL, 'O', 26, 0),
(867, NULL, 'O', 27, 0),
(868, NULL, 'O', 28, 0),
(869, NULL, 'O', 29, 0),
(870, NULL, 'O', 30, 0),
(871, NULL, 'O', 31, 0),
(872, NULL, 'O', 32, 0),
(873, NULL, 'O', 33, 0),
(874, NULL, 'O', 34, 0),
(875, NULL, 'O', 35, 0),
(876, NULL, 'O', 36, 0),
(877, NULL, 'O', 37, 0),
(878, NULL, 'O', 38, 0),
(879, NULL, 'O', 39, 0),
(880, NULL, 'O', 40, 0),
(881, NULL, 'O', 41, 0),
(882, NULL, 'O', 42, 0),
(883, NULL, 'O', 43, 0),
(884, NULL, 'O', 44, 0),
(885, NULL, 'O', 45, 0),
(886, NULL, 'O', 46, 0),
(887, NULL, 'O', 47, 0),
(888, NULL, 'O', 48, 0),
(889, NULL, 'O', 49, 0),
(890, NULL, 'O', 50, 0),
(891, NULL, 'O', 51, 0),
(892, NULL, 'O', 52, 0),
(893, NULL, 'O', 53, 0),
(894, NULL, 'O', 54, 0),
(895, NULL, 'O', 55, 0),
(896, NULL, 'O', 56, 0),
(897, NULL, 'O', 57, 0),
(898, NULL, 'O', 58, 0),
(899, NULL, 'O', 59, 0),
(900, NULL, 'O', 60, 0),
(901, NULL, 'P', 1, 0),
(902, NULL, 'P', 2, 0),
(903, NULL, 'P', 3, 0),
(904, NULL, 'P', 4, 0),
(905, NULL, 'P', 5, 0),
(906, NULL, 'P', 6, 0),
(907, NULL, 'P', 7, 0),
(908, NULL, 'P', 8, 0),
(909, NULL, 'P', 9, 0),
(910, NULL, 'P', 10, 0),
(911, NULL, 'P', 11, 0),
(912, NULL, 'P', 12, 0),
(913, NULL, 'P', 13, 0),
(914, NULL, 'P', 14, 0),
(915, NULL, 'P', 15, 0),
(916, NULL, 'P', 16, 0),
(917, NULL, 'P', 17, 0),
(918, NULL, 'P', 18, 0),
(919, NULL, 'P', 19, 0),
(920, NULL, 'P', 20, 0),
(921, NULL, 'P', 21, 0),
(922, NULL, 'P', 22, 0),
(923, NULL, 'P', 23, 0),
(924, NULL, 'P', 24, 0),
(925, NULL, 'P', 25, 0),
(926, NULL, 'P', 26, 0),
(927, NULL, 'P', 27, 0),
(928, NULL, 'P', 28, 0),
(929, NULL, 'P', 29, 0),
(930, NULL, 'P', 30, 0),
(931, NULL, 'P', 31, 0),
(932, NULL, 'P', 32, 0),
(933, NULL, 'P', 33, 0),
(934, NULL, 'P', 34, 0),
(935, NULL, 'P', 35, 0),
(936, NULL, 'P', 36, 0),
(937, NULL, 'P', 37, 0),
(938, NULL, 'P', 38, 0),
(939, NULL, 'P', 39, 0),
(940, NULL, 'P', 40, 0),
(941, NULL, 'P', 41, 0),
(942, NULL, 'P', 42, 0),
(943, NULL, 'P', 43, 0),
(944, NULL, 'P', 44, 0),
(945, NULL, 'P', 45, 0),
(946, NULL, 'P', 46, 0),
(947, NULL, 'P', 47, 0),
(948, NULL, 'P', 48, 0),
(949, NULL, 'P', 49, 0),
(950, NULL, 'P', 50, 0),
(951, NULL, 'P', 51, 0),
(952, NULL, 'P', 52, 0),
(953, NULL, 'P', 53, 0),
(954, NULL, 'P', 54, 0),
(955, NULL, 'P', 55, 0),
(956, NULL, 'P', 56, 0),
(957, NULL, 'P', 57, 0),
(958, NULL, 'P', 58, 0),
(959, NULL, 'P', 59, 0),
(960, NULL, 'P', 60, 0),
(961, NULL, 'Q', 1, 0),
(962, NULL, 'Q', 2, 0),
(963, NULL, 'Q', 3, 0),
(964, NULL, 'Q', 4, 0),
(965, NULL, 'Q', 5, 0),
(966, NULL, 'Q', 6, 0),
(967, NULL, 'Q', 7, 0),
(968, NULL, 'Q', 8, 0),
(969, NULL, 'Q', 9, 0),
(970, NULL, 'Q', 10, 0),
(971, NULL, 'Q', 11, 0),
(972, NULL, 'Q', 12, 0),
(973, NULL, 'Q', 13, 0),
(974, NULL, 'Q', 14, 0),
(975, NULL, 'Q', 15, 0),
(976, NULL, 'Q', 16, 0),
(977, NULL, 'Q', 17, 0),
(978, NULL, 'Q', 18, 0),
(979, NULL, 'Q', 19, 0),
(980, NULL, 'Q', 20, 0),
(981, NULL, 'Q', 21, 0),
(982, NULL, 'Q', 22, 0),
(983, NULL, 'Q', 23, 0),
(984, NULL, 'Q', 24, 0),
(985, NULL, 'Q', 25, 0),
(986, NULL, 'Q', 26, 0),
(987, NULL, 'Q', 27, 0),
(988, NULL, 'Q', 28, 0),
(989, NULL, 'Q', 29, 0),
(990, NULL, 'Q', 30, 0),
(991, NULL, 'Q', 31, 0),
(992, NULL, 'Q', 32, 0),
(993, NULL, 'Q', 33, 0),
(994, NULL, 'Q', 34, 0),
(995, NULL, 'Q', 35, 0),
(996, NULL, 'Q', 36, 0),
(997, NULL, 'Q', 37, 0),
(998, NULL, 'Q', 38, 0),
(999, NULL, 'Q', 39, 0),
(1000, NULL, 'Q', 40, 0),
(1001, NULL, 'Q', 41, 0),
(1002, NULL, 'Q', 42, 0),
(1003, NULL, 'Q', 43, 0),
(1004, NULL, 'Q', 44, 0),
(1005, NULL, 'Q', 45, 0),
(1006, NULL, 'Q', 46, 0),
(1007, NULL, 'Q', 47, 0),
(1008, NULL, 'Q', 48, 0),
(1009, NULL, 'Q', 49, 0),
(1010, NULL, 'Q', 50, 0),
(1011, NULL, 'Q', 51, 0),
(1012, NULL, 'Q', 52, 0),
(1013, NULL, 'Q', 53, 0),
(1014, NULL, 'Q', 54, 0),
(1015, NULL, 'Q', 55, 0),
(1016, NULL, 'Q', 56, 0),
(1017, NULL, 'Q', 57, 0),
(1018, NULL, 'Q', 58, 0),
(1019, NULL, 'Q', 59, 0),
(1020, NULL, 'Q', 60, 0),
(1021, NULL, 'R', 1, 0),
(1022, NULL, 'R', 2, 0),
(1023, NULL, 'R', 3, 0),
(1024, NULL, 'R', 4, 0),
(1025, NULL, 'R', 5, 0),
(1026, NULL, 'R', 6, 0),
(1027, NULL, 'R', 7, 0),
(1028, NULL, 'R', 8, 0),
(1029, NULL, 'R', 9, 0),
(1030, NULL, 'R', 10, 0),
(1031, NULL, 'R', 11, 0),
(1032, NULL, 'R', 12, 0),
(1033, NULL, 'R', 13, 0),
(1034, NULL, 'R', 14, 0),
(1035, NULL, 'R', 15, 0),
(1036, NULL, 'R', 16, 0),
(1037, NULL, 'R', 17, 0),
(1038, NULL, 'R', 18, 0),
(1039, NULL, 'R', 19, 0),
(1040, NULL, 'R', 20, 0),
(1041, NULL, 'R', 21, 0),
(1042, NULL, 'R', 22, 0),
(1043, NULL, 'R', 23, 0),
(1044, NULL, 'R', 24, 0),
(1045, NULL, 'R', 25, 0),
(1046, NULL, 'R', 26, 0),
(1047, NULL, 'R', 27, 0),
(1048, NULL, 'R', 28, 0),
(1049, NULL, 'R', 29, 0),
(1050, NULL, 'R', 30, 0),
(1051, NULL, 'R', 31, 0),
(1052, NULL, 'R', 32, 0),
(1053, NULL, 'R', 33, 0),
(1054, NULL, 'R', 34, 0),
(1055, NULL, 'R', 35, 0),
(1056, NULL, 'R', 36, 0),
(1057, NULL, 'R', 37, 0),
(1058, NULL, 'R', 38, 0),
(1059, NULL, 'R', 39, 0),
(1060, NULL, 'R', 40, 0),
(1061, NULL, 'R', 41, 0),
(1062, NULL, 'R', 42, 0),
(1063, NULL, 'R', 43, 0),
(1064, NULL, 'R', 44, 0),
(1065, NULL, 'R', 45, 0),
(1066, NULL, 'R', 46, 0),
(1067, NULL, 'R', 47, 0),
(1068, NULL, 'R', 48, 0),
(1069, NULL, 'R', 49, 0),
(1070, NULL, 'R', 50, 0),
(1071, NULL, 'R', 51, 0),
(1072, NULL, 'R', 52, 0),
(1073, NULL, 'R', 53, 0),
(1074, NULL, 'R', 54, 0),
(1075, NULL, 'R', 55, 0),
(1076, NULL, 'R', 56, 0),
(1077, NULL, 'R', 57, 0),
(1078, NULL, 'R', 58, 0),
(1079, NULL, 'R', 59, 0),
(1080, NULL, 'R', 60, 0),
(1081, NULL, 'S', 1, 0),
(1082, NULL, 'S', 2, 0),
(1083, NULL, 'S', 3, 0),
(1084, NULL, 'S', 4, 0),
(1085, NULL, 'S', 5, 0),
(1086, NULL, 'S', 6, 0),
(1087, NULL, 'S', 7, 0),
(1088, NULL, 'S', 8, 0),
(1089, NULL, 'S', 9, 0),
(1090, NULL, 'S', 10, 0),
(1091, NULL, 'S', 11, 0),
(1092, NULL, 'S', 12, 0),
(1093, NULL, 'S', 13, 0),
(1094, NULL, 'S', 14, 0),
(1095, NULL, 'S', 15, 0),
(1096, NULL, 'S', 16, 0),
(1097, NULL, 'S', 17, 0),
(1098, NULL, 'S', 18, 0),
(1099, NULL, 'S', 19, 0),
(1100, NULL, 'S', 20, 0),
(1101, NULL, 'S', 21, 0),
(1102, NULL, 'S', 22, 0),
(1103, NULL, 'S', 23, 0),
(1104, NULL, 'S', 24, 0),
(1105, NULL, 'S', 25, 0),
(1106, NULL, 'S', 26, 0),
(1107, NULL, 'S', 27, 0),
(1108, NULL, 'S', 28, 0),
(1109, NULL, 'S', 29, 0),
(1110, NULL, 'S', 30, 0),
(1111, NULL, 'S', 31, 0),
(1112, NULL, 'S', 32, 0),
(1113, NULL, 'S', 33, 0),
(1114, NULL, 'S', 34, 0),
(1115, NULL, 'S', 35, 0),
(1116, NULL, 'S', 36, 0),
(1117, NULL, 'S', 37, 0),
(1118, NULL, 'S', 38, 0),
(1119, NULL, 'S', 39, 0),
(1120, NULL, 'S', 40, 0),
(1121, NULL, 'S', 41, 0),
(1122, NULL, 'S', 42, 0),
(1123, NULL, 'S', 43, 0),
(1124, NULL, 'S', 44, 0),
(1125, NULL, 'S', 45, 0),
(1126, NULL, 'S', 46, 0),
(1127, NULL, 'S', 47, 0),
(1128, NULL, 'S', 48, 0),
(1129, NULL, 'S', 49, 0),
(1130, NULL, 'S', 50, 0),
(1131, NULL, 'S', 51, 0),
(1132, NULL, 'S', 52, 0),
(1133, NULL, 'S', 53, 0),
(1134, NULL, 'S', 54, 0),
(1135, NULL, 'S', 55, 0),
(1136, NULL, 'S', 56, 0),
(1137, NULL, 'S', 57, 0),
(1138, NULL, 'S', 58, 0),
(1139, NULL, 'S', 59, 0),
(1140, NULL, 'S', 60, 0),
(1141, NULL, 'T', 1, 0),
(1142, NULL, 'T', 2, 0),
(1143, NULL, 'T', 3, 0),
(1144, NULL, 'T', 4, 0),
(1145, NULL, 'T', 5, 0),
(1146, NULL, 'T', 6, 0),
(1147, NULL, 'T', 7, 0),
(1148, NULL, 'T', 8, 0),
(1149, NULL, 'T', 9, 0),
(1150, NULL, 'T', 10, 0),
(1151, NULL, 'T', 11, 0),
(1152, NULL, 'T', 12, 0),
(1153, NULL, 'T', 13, 0),
(1154, NULL, 'T', 14, 0),
(1155, NULL, 'T', 15, 0),
(1156, NULL, 'T', 16, 0),
(1157, NULL, 'T', 17, 0),
(1158, NULL, 'T', 18, 0),
(1159, NULL, 'T', 19, 0),
(1160, NULL, 'T', 20, 0),
(1161, NULL, 'T', 21, 0),
(1162, NULL, 'T', 22, 0),
(1163, NULL, 'T', 23, 0),
(1164, NULL, 'T', 24, 0),
(1165, NULL, 'T', 25, 0),
(1166, NULL, 'T', 26, 0),
(1167, NULL, 'T', 27, 0),
(1168, NULL, 'T', 28, 0),
(1169, NULL, 'T', 29, 0),
(1170, NULL, 'T', 30, 0),
(1171, NULL, 'T', 31, 0),
(1172, NULL, 'T', 32, 0),
(1173, NULL, 'T', 33, 0),
(1174, NULL, 'T', 34, 0),
(1175, NULL, 'T', 35, 0),
(1176, NULL, 'T', 36, 0),
(1177, NULL, 'T', 37, 0),
(1178, NULL, 'T', 38, 0),
(1179, NULL, 'T', 39, 0),
(1180, NULL, 'T', 40, 0),
(1181, NULL, 'T', 41, 0),
(1182, NULL, 'T', 42, 0),
(1183, NULL, 'T', 43, 0),
(1184, NULL, 'T', 44, 0),
(1185, NULL, 'T', 45, 0),
(1186, NULL, 'T', 46, 0),
(1187, NULL, 'T', 47, 0),
(1188, NULL, 'T', 48, 0),
(1189, NULL, 'T', 49, 0),
(1190, NULL, 'T', 50, 0),
(1191, NULL, 'T', 51, 0),
(1192, NULL, 'T', 52, 0),
(1193, NULL, 'T', 53, 0),
(1194, NULL, 'T', 54, 0),
(1195, NULL, 'T', 55, 0),
(1196, NULL, 'T', 56, 0),
(1197, NULL, 'T', 57, 0),
(1198, NULL, 'T', 58, 0),
(1199, NULL, 'T', 59, 0),
(1200, NULL, 'T', 60, 0),
(1201, NULL, 'U', 1, 0),
(1202, NULL, 'U', 2, 0),
(1203, NULL, 'U', 3, 0),
(1204, NULL, 'U', 4, 0),
(1205, NULL, 'U', 5, 0),
(1206, NULL, 'U', 6, 0),
(1207, NULL, 'U', 7, 0),
(1208, NULL, 'U', 8, 0),
(1209, NULL, 'U', 9, 0),
(1210, NULL, 'U', 10, 0),
(1211, NULL, 'U', 11, 0),
(1212, NULL, 'U', 12, 0),
(1213, NULL, 'U', 13, 0),
(1214, NULL, 'U', 14, 0),
(1215, NULL, 'U', 15, 0),
(1216, NULL, 'U', 16, 0),
(1217, NULL, 'U', 17, 0),
(1218, NULL, 'U', 18, 0),
(1219, NULL, 'U', 19, 0),
(1220, NULL, 'U', 20, 0),
(1221, NULL, 'U', 21, 0),
(1222, NULL, 'U', 22, 0),
(1223, NULL, 'U', 23, 0),
(1224, NULL, 'U', 24, 0),
(1225, NULL, 'U', 25, 0),
(1226, NULL, 'U', 26, 0),
(1227, NULL, 'U', 27, 0),
(1228, NULL, 'U', 28, 0),
(1229, NULL, 'U', 29, 0),
(1230, NULL, 'U', 30, 0),
(1231, NULL, 'U', 31, 0),
(1232, NULL, 'U', 32, 0),
(1233, NULL, 'U', 33, 0),
(1234, NULL, 'U', 34, 0),
(1235, NULL, 'U', 35, 0),
(1236, NULL, 'U', 36, 0),
(1237, NULL, 'U', 37, 0),
(1238, NULL, 'U', 38, 0),
(1239, NULL, 'U', 39, 0),
(1240, NULL, 'U', 40, 0),
(1241, NULL, 'U', 41, 0),
(1242, NULL, 'U', 42, 0),
(1243, NULL, 'U', 43, 0),
(1244, NULL, 'U', 44, 0),
(1245, NULL, 'U', 45, 0),
(1246, NULL, 'U', 46, 0),
(1247, NULL, 'U', 47, 0),
(1248, NULL, 'U', 48, 0),
(1249, NULL, 'U', 49, 0),
(1250, NULL, 'U', 50, 0),
(1251, NULL, 'U', 51, 0),
(1252, NULL, 'U', 52, 0),
(1253, NULL, 'U', 53, 0),
(1254, NULL, 'U', 54, 0),
(1255, NULL, 'U', 55, 0),
(1256, NULL, 'U', 56, 0),
(1257, NULL, 'U', 57, 0),
(1258, NULL, 'U', 58, 0),
(1259, NULL, 'U', 59, 0),
(1260, NULL, 'U', 60, 0),
(1261, NULL, 'V', 1, 0),
(1262, NULL, 'V', 2, 0),
(1263, NULL, 'V', 3, 0),
(1264, NULL, 'V', 4, 0),
(1265, NULL, 'V', 5, 0),
(1266, NULL, 'V', 6, 0),
(1267, NULL, 'V', 7, 0),
(1268, NULL, 'V', 8, 0),
(1269, NULL, 'V', 9, 0),
(1270, NULL, 'V', 10, 0),
(1271, NULL, 'V', 11, 0),
(1272, NULL, 'V', 12, 0),
(1273, NULL, 'V', 13, 0),
(1274, NULL, 'V', 14, 0),
(1275, NULL, 'V', 15, 0),
(1276, NULL, 'V', 16, 0),
(1277, NULL, 'V', 17, 0),
(1278, NULL, 'V', 18, 0),
(1279, NULL, 'V', 19, 0),
(1280, NULL, 'V', 20, 0),
(1281, NULL, 'V', 21, 0),
(1282, NULL, 'V', 22, 0),
(1283, NULL, 'V', 23, 0),
(1284, NULL, 'V', 24, 0),
(1285, NULL, 'V', 25, 0),
(1286, NULL, 'V', 26, 0),
(1287, NULL, 'V', 27, 0),
(1288, NULL, 'V', 28, 0),
(1289, NULL, 'V', 29, 0),
(1290, NULL, 'V', 30, 0),
(1291, NULL, 'V', 31, 0),
(1292, NULL, 'V', 32, 0),
(1293, NULL, 'V', 33, 0),
(1294, NULL, 'V', 34, 0),
(1295, NULL, 'V', 35, 0),
(1296, NULL, 'V', 36, 0),
(1297, NULL, 'V', 37, 0),
(1298, NULL, 'V', 38, 0),
(1299, NULL, 'V', 39, 0),
(1300, NULL, 'V', 40, 0),
(1301, NULL, 'V', 41, 0),
(1302, NULL, 'V', 42, 0),
(1303, NULL, 'V', 43, 0),
(1304, NULL, 'V', 44, 0),
(1305, NULL, 'V', 45, 0),
(1306, NULL, 'V', 46, 0),
(1307, NULL, 'V', 47, 0),
(1308, NULL, 'V', 48, 0),
(1309, NULL, 'V', 49, 0),
(1310, NULL, 'V', 50, 0),
(1311, NULL, 'V', 51, 0),
(1312, NULL, 'V', 52, 0),
(1313, NULL, 'V', 53, 0),
(1314, NULL, 'V', 54, 0),
(1315, NULL, 'V', 55, 0),
(1316, NULL, 'V', 56, 0),
(1317, NULL, 'V', 57, 0),
(1318, NULL, 'V', 58, 0),
(1319, NULL, 'V', 59, 0),
(1320, NULL, 'V', 60, 0),
(1321, NULL, 'W', 1, 0),
(1322, NULL, 'W', 2, 0),
(1323, NULL, 'W', 3, 0),
(1324, NULL, 'W', 4, 0),
(1325, NULL, 'W', 5, 0),
(1326, NULL, 'W', 6, 0),
(1327, NULL, 'W', 7, 0),
(1328, NULL, 'W', 8, 0),
(1329, NULL, 'W', 9, 0),
(1330, NULL, 'W', 10, 0),
(1331, NULL, 'W', 11, 0),
(1332, NULL, 'W', 12, 0),
(1333, NULL, 'W', 13, 0),
(1334, NULL, 'W', 14, 0),
(1335, NULL, 'W', 15, 0),
(1336, NULL, 'W', 16, 0),
(1337, NULL, 'W', 17, 0),
(1338, NULL, 'W', 18, 0),
(1339, NULL, 'W', 19, 0),
(1340, NULL, 'W', 20, 0),
(1341, NULL, 'W', 21, 0),
(1342, NULL, 'W', 22, 0),
(1343, NULL, 'W', 23, 0),
(1344, NULL, 'W', 24, 0),
(1345, NULL, 'W', 25, 0),
(1346, NULL, 'W', 26, 0),
(1347, NULL, 'W', 27, 0),
(1348, NULL, 'W', 28, 0),
(1349, NULL, 'W', 29, 0),
(1350, NULL, 'W', 30, 0),
(1351, NULL, 'W', 31, 0),
(1352, NULL, 'W', 32, 0),
(1353, NULL, 'W', 33, 0),
(1354, NULL, 'W', 34, 0),
(1355, NULL, 'W', 35, 0),
(1356, NULL, 'W', 36, 0),
(1357, NULL, 'W', 37, 0),
(1358, NULL, 'W', 38, 0),
(1359, NULL, 'W', 39, 0),
(1360, NULL, 'W', 40, 0),
(1361, NULL, 'W', 41, 0),
(1362, NULL, 'W', 42, 0),
(1363, NULL, 'W', 43, 0),
(1364, NULL, 'W', 44, 0),
(1365, NULL, 'W', 45, 0),
(1366, NULL, 'W', 46, 0),
(1367, NULL, 'W', 47, 0),
(1368, NULL, 'W', 48, 0),
(1369, NULL, 'W', 49, 0),
(1370, NULL, 'W', 50, 0),
(1371, NULL, 'W', 51, 0),
(1372, NULL, 'W', 52, 0),
(1373, NULL, 'W', 53, 0),
(1374, NULL, 'W', 54, 0),
(1375, NULL, 'W', 55, 0),
(1376, NULL, 'W', 56, 0),
(1377, NULL, 'W', 57, 0),
(1378, NULL, 'W', 58, 0),
(1379, NULL, 'W', 59, 0),
(1380, NULL, 'W', 60, 0),
(1381, NULL, 'X', 1, 0),
(1382, NULL, 'X', 2, 0),
(1383, NULL, 'X', 3, 0),
(1384, NULL, 'X', 4, 0),
(1385, NULL, 'X', 5, 0),
(1386, NULL, 'X', 6, 0),
(1387, NULL, 'X', 7, 0),
(1388, NULL, 'X', 8, 0),
(1389, NULL, 'X', 9, 0),
(1390, NULL, 'X', 10, 0),
(1391, NULL, 'X', 11, 0),
(1392, NULL, 'X', 12, 0),
(1393, NULL, 'X', 13, 0),
(1394, NULL, 'X', 14, 0),
(1395, NULL, 'X', 15, 0),
(1396, NULL, 'X', 16, 0),
(1397, NULL, 'X', 17, 0),
(1398, NULL, 'X', 18, 0),
(1399, NULL, 'X', 19, 0),
(1400, NULL, 'X', 20, 0),
(1401, NULL, 'X', 21, 0),
(1402, NULL, 'X', 22, 0),
(1403, NULL, 'X', 23, 0),
(1404, NULL, 'X', 24, 0),
(1405, NULL, 'X', 25, 0),
(1406, NULL, 'X', 26, 0),
(1407, NULL, 'X', 27, 0),
(1408, NULL, 'X', 28, 0),
(1409, NULL, 'X', 29, 0),
(1410, NULL, 'X', 30, 0),
(1411, NULL, 'X', 31, 0),
(1412, NULL, 'X', 32, 0),
(1413, NULL, 'X', 33, 0),
(1414, NULL, 'X', 34, 0),
(1415, NULL, 'X', 35, 0),
(1416, NULL, 'X', 36, 0),
(1417, NULL, 'X', 37, 0),
(1418, NULL, 'X', 38, 0),
(1419, NULL, 'X', 39, 0),
(1420, NULL, 'X', 40, 0),
(1421, NULL, 'X', 41, 0),
(1422, NULL, 'X', 42, 0),
(1423, NULL, 'X', 43, 0),
(1424, NULL, 'X', 44, 0),
(1425, NULL, 'X', 45, 0),
(1426, NULL, 'X', 46, 0),
(1427, NULL, 'X', 47, 0),
(1428, NULL, 'X', 48, 0),
(1429, NULL, 'X', 49, 0),
(1430, NULL, 'X', 50, 0),
(1431, NULL, 'X', 51, 0),
(1432, NULL, 'X', 52, 0),
(1433, NULL, 'X', 53, 0),
(1434, NULL, 'X', 54, 0),
(1435, NULL, 'X', 55, 0),
(1436, NULL, 'X', 56, 0),
(1437, NULL, 'X', 57, 0),
(1438, NULL, 'X', 58, 0),
(1439, NULL, 'X', 59, 0),
(1440, NULL, 'X', 60, 0),
(1441, NULL, 'Y', 1, 0),
(1442, NULL, 'Y', 2, 0),
(1443, NULL, 'Y', 3, 0),
(1444, NULL, 'Y', 4, 0),
(1445, NULL, 'Y', 5, 0),
(1446, NULL, 'Y', 6, 0),
(1447, NULL, 'Y', 7, 0),
(1448, NULL, 'Y', 8, 0),
(1449, NULL, 'Y', 9, 0),
(1450, NULL, 'Y', 10, 0),
(1451, NULL, 'Y', 11, 0),
(1452, NULL, 'Y', 12, 0),
(1453, NULL, 'Y', 13, 0),
(1454, NULL, 'Y', 14, 0),
(1455, NULL, 'Y', 15, 0),
(1456, NULL, 'Y', 16, 0),
(1457, NULL, 'Y', 17, 0),
(1458, NULL, 'Y', 18, 0),
(1459, NULL, 'Y', 19, 0),
(1460, NULL, 'Y', 20, 0),
(1461, NULL, 'Y', 21, 0),
(1462, NULL, 'Y', 22, 0),
(1463, NULL, 'Y', 23, 0),
(1464, NULL, 'Y', 24, 0),
(1465, NULL, 'Y', 25, 0),
(1466, NULL, 'Y', 26, 0),
(1467, NULL, 'Y', 27, 0),
(1468, NULL, 'Y', 28, 0),
(1469, NULL, 'Y', 29, 0),
(1470, NULL, 'Y', 30, 0),
(1471, NULL, 'Y', 31, 0),
(1472, NULL, 'Y', 32, 0),
(1473, NULL, 'Y', 33, 0),
(1474, NULL, 'Y', 34, 0),
(1475, NULL, 'Y', 35, 0),
(1476, NULL, 'Y', 36, 0),
(1477, NULL, 'Y', 37, 0),
(1478, NULL, 'Y', 38, 0),
(1479, NULL, 'Y', 39, 0),
(1480, NULL, 'Y', 40, 0),
(1481, NULL, 'Y', 41, 0),
(1482, NULL, 'Y', 42, 0),
(1483, NULL, 'Y', 43, 0),
(1484, NULL, 'Y', 44, 0),
(1485, NULL, 'Y', 45, 0),
(1486, NULL, 'Y', 46, 0),
(1487, NULL, 'Y', 47, 0),
(1488, NULL, 'Y', 48, 0),
(1489, NULL, 'Y', 49, 0),
(1490, NULL, 'Y', 50, 0),
(1491, NULL, 'Y', 51, 0),
(1492, NULL, 'Y', 52, 0),
(1493, NULL, 'Y', 53, 0),
(1494, NULL, 'Y', 54, 0),
(1495, NULL, 'Y', 55, 0),
(1496, NULL, 'Y', 56, 0),
(1497, NULL, 'Y', 57, 0),
(1498, NULL, 'Y', 58, 0),
(1499, NULL, 'Y', 59, 0),
(1500, NULL, 'Y', 60, 0),
(1501, NULL, 'Z', 1, 0),
(1502, NULL, 'Z', 2, 0),
(1503, NULL, 'Z', 3, 0),
(1504, NULL, 'Z', 4, 0),
(1505, NULL, 'Z', 5, 0),
(1506, NULL, 'Z', 6, 0),
(1507, NULL, 'Z', 7, 0),
(1508, NULL, 'Z', 8, 0),
(1509, NULL, 'Z', 9, 0),
(1510, NULL, 'Z', 10, 0),
(1511, NULL, 'Z', 11, 0),
(1512, NULL, 'Z', 12, 0),
(1513, NULL, 'Z', 13, 0),
(1514, NULL, 'Z', 14, 0),
(1515, NULL, 'Z', 15, 0),
(1516, NULL, 'Z', 16, 0),
(1517, NULL, 'Z', 17, 0),
(1518, NULL, 'Z', 18, 0),
(1519, NULL, 'Z', 19, 0),
(1520, NULL, 'Z', 20, 0),
(1521, NULL, 'Z', 21, 0),
(1522, NULL, 'Z', 22, 0),
(1523, NULL, 'Z', 23, 0),
(1524, NULL, 'Z', 24, 0),
(1525, NULL, 'Z', 25, 0),
(1526, NULL, 'Z', 26, 0),
(1527, NULL, 'Z', 27, 0),
(1528, NULL, 'Z', 28, 0),
(1529, NULL, 'Z', 29, 0),
(1530, NULL, 'Z', 30, 0),
(1531, NULL, 'Z', 31, 0),
(1532, NULL, 'Z', 32, 0),
(1533, NULL, 'Z', 33, 0),
(1534, NULL, 'Z', 34, 0),
(1535, NULL, 'Z', 35, 0),
(1536, NULL, 'Z', 36, 0),
(1537, NULL, 'Z', 37, 0),
(1538, NULL, 'Z', 38, 0),
(1539, NULL, 'Z', 39, 0),
(1540, NULL, 'Z', 40, 0),
(1541, NULL, 'Z', 41, 0),
(1542, NULL, 'Z', 42, 0),
(1543, NULL, 'Z', 43, 0),
(1544, NULL, 'Z', 44, 0),
(1545, NULL, 'Z', 45, 0),
(1546, NULL, 'Z', 46, 0),
(1547, NULL, 'Z', 47, 0),
(1548, NULL, 'Z', 48, 0),
(1549, NULL, 'Z', 49, 0),
(1550, NULL, 'Z', 50, 0),
(1551, NULL, 'Z', 51, 0),
(1552, NULL, 'Z', 52, 0),
(1553, NULL, 'Z', 53, 0),
(1554, NULL, 'Z', 54, 0),
(1555, NULL, 'Z', 55, 0),
(1556, NULL, 'Z', 56, 0),
(1557, NULL, 'Z', 57, 0),
(1558, NULL, 'Z', 58, 0),
(1559, NULL, 'Z', 59, 0),
(1560, NULL, 'Z', 60, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `natuurlijkepersonen`
--

CREATE TABLE `natuurlijkepersonen` (
  `klantId` int(11) NOT NULL,
  `voornaam` varchar(45) NOT NULL,
  `familienaam` varchar(45) NOT NULL,
  `gebruikersAccountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `natuurlijkepersonen`
--

INSERT INTO `natuurlijkepersonen` (`klantId`, `voornaam`, `familienaam`, `gebruikersAccountId`) VALUES
(2, 'Alpha', 'Klant', 3),
(3, 'Beta', 'Client', 4),
(4, 'Gamma', 'Customer', 5),
(5, 'Delta', 'Kunde', 6),
(6, 'Eta', 'Cliente', 7),
(8, 'Xander', 'Van Malder', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personeelsleden`
--

CREATE TABLE `personeelsleden` (
  `personeelslidId` int(11) NOT NULL,
  `voornaam` varchar(45) NOT NULL,
  `familienaam` varchar(45) NOT NULL,
  `inDienst` tinyint(1) NOT NULL DEFAULT 1,
  `personeelslidAccountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `personeelsleden`
--

INSERT INTO `personeelsleden` (`personeelslidId`, `voornaam`, `familienaam`, `inDienst`, `personeelslidAccountId`) VALUES
(1, 'D.', 'Ceo', 1, 1),
(2, 'B.', 'Klantendienst', 1, 2),
(3, 'J.', 'Leveringen', 1, 3),
(4, 'F.', 'Magazijn', 1, 4),
(5, 'B.', 'Website', 1, 5),
(6, 'I.', 'Artikelbeheer', 1, 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personeelslidaccounts`
--

CREATE TABLE `personeelslidaccounts` (
  `personeelslidAccountId` int(11) NOT NULL,
  `emailadres` varchar(45) NOT NULL,
  `paswoord` varchar(255) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `personeelslidaccounts`
--

INSERT INTO `personeelslidaccounts` (`personeelslidAccountId`, `emailadres`, `paswoord`, `disabled`) VALUES
(1, 'd.ceo@prularia.com', '$2a$11$KThggo./izUkaugrYvPVueJB7Ib17f.mEFFrtfApfqk8O76AOtpE2', 0),
(2, 'k.klantendienst@prularia.com', '$2a$11$KThggo./izUkaugrYvPVueJB7Ib17f.mEFFrtfApfqk8O76AOtpE2', 0),
(3, 'j.leveringen@prularia.com', '$2a$11$KThggo./izUkaugrYvPVueJB7Ib17f.mEFFrtfApfqk8O76AOtpE2', 0),
(4, 'f.magazijn@prularia.com', '$2a$11$KThggo./izUkaugrYvPVueJB7Ib17f.mEFFrtfApfqk8O76AOtpE2', 0),
(5, 'b.website@prularia.com', '$2a$11$KThggo./izUkaugrYvPVueJB7Ib17f.mEFFrtfApfqk8O76AOtpE2', 0),
(6, 'i.artikelbeheer@prularia.com', '$2a$11$KThggo./izUkaugrYvPVueJB7Ib17f.mEFFrtfApfqk8O76AOtpE2', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personeelslidsecuritygroepen`
--

CREATE TABLE `personeelslidsecuritygroepen` (
  `personeelslidId` int(11) NOT NULL,
  `securityGroepId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `personeelslidsecuritygroepen`
--

INSERT INTO `personeelslidsecuritygroepen` (`personeelslidId`, `securityGroepId`) VALUES
(1, 4),
(2, 2),
(3, 3),
(4, 3),
(5, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plaatsen`
--

CREATE TABLE `plaatsen` (
  `plaatsId` int(11) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `plaats` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `plaatsen`
--

INSERT INTO `plaatsen` (`plaatsId`, `postcode`, `plaats`) VALUES
(1, '2970', '\'S Gravenwezel'),
(2, '3700', '\'S Herenelderen'),
(3, '7510', '3 Suisses'),
(4, '9420', 'Aaigem'),
(5, '8511', 'Aalbeke'),
(6, '3800', 'Aalst'),
(7, '9300', 'Aalst'),
(8, '9880', 'Aalter'),
(9, '3200', 'Aarschot'),
(10, '8700', 'Aarsele'),
(11, '8211', 'Aartrijke'),
(12, '2630', 'Aartselaar'),
(13, '4557', 'Abée'),
(14, '4280', 'Abolens'),
(15, '3930', 'Achel'),
(16, '5590', 'Achêne'),
(17, '5362', 'Achet'),
(18, '4219', 'Acosse'),
(19, '6280', 'Acoz'),
(20, '1105', 'ACTISOC'),
(21, '9991', 'Adegem'),
(22, '8660', 'Adinkerke'),
(23, '1790', 'Affligem'),
(24, '9051', 'Afsnee'),
(25, '5544', 'Agimont'),
(26, '4317', 'Aineffe'),
(27, '5310', 'Aische-En-Refail'),
(28, '6250', 'Aiseau'),
(29, '5070', 'Aisemont'),
(30, '3570', 'Alken'),
(31, '5550', 'Alle'),
(32, '4432', 'Alleur'),
(33, '1652', 'Alsemberg'),
(34, '8690', 'Alveringem'),
(35, '4540', 'Amay'),
(36, '6680', 'Amberloup'),
(37, '6953', 'Ambly'),
(38, '4219', 'Ambresin'),
(39, '4770', 'Amel'),
(40, '6997', 'Amonines'),
(41, '7750', 'Amougies'),
(42, '4540', 'Ampsin'),
(43, '5300', 'Andenne'),
(44, '1070', 'Anderlecht'),
(45, '6150', 'Anderlues'),
(46, '4821', 'Andrimont'),
(47, '4031', 'Angleur'),
(48, '7387', 'Angre'),
(49, '7387', 'Angreau'),
(50, '5537', 'Anhée'),
(51, '6721', 'Anlier'),
(52, '6890', 'Anloy'),
(53, '5537', 'Annevoie-Rouillon'),
(54, '4430', 'Ans'),
(55, '5500', 'Anseremme'),
(56, '7750', 'Anseroeul'),
(57, '5520', 'Anthée'),
(58, '4520', 'Antheit'),
(59, '4160', 'Anthisnes'),
(60, '7640', 'Antoing'),
(61, '2000', 'Antwerpen'),
(62, '2018', 'Antwerpen'),
(63, '2020', 'Antwerpen'),
(64, '2030', 'Antwerpen'),
(65, '2040', 'Antwerpen'),
(66, '2050', 'Antwerpen'),
(67, '2060', 'Antwerpen'),
(68, '2099', 'Antwerpen X'),
(69, '7910', 'Anvaing'),
(70, '8570', 'Anzegem'),
(71, '9200', 'Appels'),
(72, '9400', 'Appelterre-Eichem'),
(73, '5170', 'Arbre'),
(74, '7811', 'Arbre'),
(75, '4990', 'Arbrefontaine'),
(76, '7910', 'Arc-Ainières'),
(77, '7910', 'Arc-Wattripont'),
(78, '1390', 'Archennes'),
(79, '8850', 'Ardooie'),
(80, '2370', 'Arendonk'),
(81, '4601', 'Argenteau'),
(82, '6700', 'Arlon'),
(83, '7181', 'Arquennes'),
(84, '5060', 'Arsimont'),
(85, '6870', 'Arville'),
(86, '3665', 'As'),
(87, '9404', 'Aspelare'),
(88, '9890', 'Asper'),
(89, '7040', 'Asquillies'),
(90, '1730', 'Asse'),
(91, '8310', 'Assebroek'),
(92, '1007', 'Assemble de la Commission Communautaire Française'),
(93, '9960', 'Assenede'),
(94, '6860', 'Assenois'),
(95, '3460', 'Assent'),
(96, '5330', 'Assesse'),
(97, '9800', 'Astene'),
(98, '7800', 'Ath'),
(99, '7387', 'Athis'),
(100, '6791', 'Athus'),
(101, '3404', 'Attenhoven'),
(102, '3384', 'Attenrode'),
(103, '6717', 'Attert'),
(104, '7941', 'Attre'),
(105, '6790', 'Aubange'),
(106, '7972', 'Aubechies'),
(107, '4880', 'Aubel'),
(108, '5660', 'Aublain'),
(109, '6880', 'Auby-Sur-Semois'),
(110, '7382', 'Audregnies'),
(111, '7040', 'Aulnois'),
(112, '6706', 'Autelbas'),
(113, '1367', 'Autre-Eglise'),
(114, '7387', 'Autreppe'),
(115, '5060', 'Auvelais'),
(116, '5580', 'Ave-Et-Auffe'),
(117, '8630', 'Avekapelle'),
(118, '8580', 'Avelgem'),
(119, '4260', 'Avennes'),
(120, '3271', 'Averbode'),
(121, '4280', 'Avernas-Le-Bauduin'),
(122, '4280', 'Avin'),
(123, '4340', 'Awans'),
(124, '6870', 'Awenne'),
(125, '4400', 'Awirs'),
(126, '6900', 'Aye'),
(127, '4630', 'Ayeneux'),
(128, '4920', 'Aywaille'),
(129, '9890', 'Baaigem'),
(130, '3128', 'Baal'),
(131, '9310', 'Baardegem'),
(132, '2387', 'Baarle-Hertog'),
(133, '9200', 'Baasrode'),
(134, '9800', 'Bachte-Maria-Leerne'),
(135, '4837', 'Baelen'),
(136, '5550', 'Bagimont'),
(137, '6464', 'Baileux'),
(138, '6460', 'Bailièvre'),
(139, '5555', 'Baillamont'),
(140, '7730', 'Bailleul'),
(141, '5377', 'Baillonville'),
(142, '7380', 'Baisieux'),
(143, '1470', 'Baisy-Thy'),
(144, '5190', 'Balâtre'),
(145, '9860', 'Balegem'),
(146, '2490', 'Balen'),
(147, '9420', 'Bambrugge'),
(148, '6951', 'Bande'),
(149, '6500', 'Barben‡on'),
(150, '4671', 'Barchon'),
(151, '5570', 'Baronville'),
(152, '7534', 'Barry'),
(153, '5370', 'Barvaux-Condroz'),
(154, '6940', 'Barvaux-Sur-Ourthe'),
(155, '4520', 'Bas-Oha'),
(156, '7971', 'Basècles'),
(157, '4983', 'Basse-Bodeux'),
(158, '4690', 'Bassenge'),
(159, '9968', 'Bassevelde'),
(160, '7830', 'Bassilly'),
(161, '6600', 'Bastogne'),
(162, '3870', 'Batsheers'),
(163, '4651', 'Battice'),
(164, '7130', 'Battignies'),
(165, '7331', 'Baudour'),
(166, '7870', 'Bauffe'),
(167, '7604', 'Baugnies'),
(168, '1401', 'Baulers'),
(169, '9520', 'Bavegem'),
(170, '8531', 'Bavikhove'),
(171, '9150', 'Bazel'),
(172, '4052', 'Beaufays'),
(173, '6500', 'Beaumont'),
(174, '5570', 'Beauraing'),
(175, '6980', 'Beausaint'),
(176, '1320', 'Beauvechain'),
(177, '6594', 'Beauwelz'),
(178, '7532', 'Béclers'),
(179, '3960', 'Beek'),
(180, '9630', 'Beerlegem'),
(181, '8730', 'Beernem'),
(182, '2340', 'Beerse'),
(183, '1650', 'Beersel'),
(184, '8600', 'Beerst'),
(185, '1673', 'Beert'),
(186, '9080', 'Beervelde'),
(187, '2580', 'Beerzel'),
(188, '5000', 'Beez'),
(189, '6987', 'Beffe'),
(190, '3130', 'Begijnendijk'),
(191, '6672', 'Beho'),
(192, '1852', 'Beigem'),
(193, '8480', 'Bekegem'),
(194, '1730', 'Bekkerzeel'),
(195, '3460', 'Bekkevoort'),
(196, '1009', 'Belgische Senaat'),
(197, '5001', 'Belgrade'),
(198, '4610', 'Bellaire'),
(199, '7170', 'Bellecourt'),
(200, '5555', 'Bellefontaine'),
(201, '6730', 'Bellefontaine'),
(202, '8510', 'Bellegem'),
(203, '9881', 'Bellem'),
(204, '6834', 'Bellevaux'),
(205, '4960', 'Bellevaux-Ligneuville'),
(206, '1674', 'Bellingen'),
(207, '7970', 'Beloeil'),
(208, '9111', 'Belsele'),
(209, '4500', 'Ben-Ahin'),
(210, '6941', 'Bende'),
(211, '3540', 'Berbroek'),
(212, '2600', 'Berchem'),
(213, '9690', 'Berchem'),
(214, '2040', 'Berendrecht'),
(215, '1910', 'Berg'),
(216, '3700', 'Berg'),
(217, '4360', 'Bergilers'),
(218, '3580', 'Beringen'),
(219, '2590', 'Berlaar'),
(220, '9290', 'Berlare'),
(221, '3830', 'Berlingen'),
(222, '4257', 'Berloz'),
(223, '4607', 'Berneau'),
(224, '7320', 'Bernissart'),
(225, '6560', 'Bersillies-L\'Abbaye'),
(226, '3060', 'Bertem'),
(227, '6687', 'Bertogne'),
(228, '4280', 'Bertr‚e'),
(229, '6880', 'Bertrix'),
(230, '5651', 'Berz‚e'),
(231, '8980', 'Beselare'),
(232, '3130', 'Betekom'),
(233, '4300', 'Bettincourt'),
(234, '5030', 'Beuzet'),
(235, '2560', 'Bevel'),
(236, '1547', 'Bever'),
(237, '4960', 'Beverc‚'),
(238, '9700', 'Bevere'),
(239, '8791', 'Beveren'),
(240, '8800', 'Beveren'),
(241, '8691', 'Beveren-Aan-De-Ijzer'),
(242, '9120', 'Beveren-Waas'),
(243, '3581', 'Beverlo'),
(244, '3740', 'Beverst'),
(245, '4610', 'Beyne-Heusay'),
(246, '6543', 'Bienne-Lez-Happart'),
(247, '3360', 'Bierbeek'),
(248, '6533', 'Biercée'),
(249, '1301', 'Bierges'),
(250, '1430', 'Bierghes'),
(251, '4460', 'Bierset'),
(252, '5380', 'Bierwart'),
(253, '5640', 'Biesme'),
(254, '6531', 'Biesme-Sous-Thuin'),
(255, '5640', 'Biesmerée'),
(256, '5555', 'Bièvre'),
(257, '1390', 'Biez'),
(258, '6690', 'Bihain'),
(259, '8920', 'Bikschote'),
(260, '4831', 'Bilstain'),
(261, '3740', 'Bilzen'),
(262, '7130', 'Binche'),
(263, '3850', 'Binderveld'),
(264, '3211', 'Binkom'),
(265, '5537', 'Bioul'),
(266, '8501', 'Bissegem'),
(267, '7783', 'Bizet'),
(268, '2830', 'Blaasveld'),
(269, '5542', 'Blaimont'),
(270, '7522', 'Blandain'),
(271, '3052', 'Blanden'),
(272, '8370', 'Blankenberge'),
(273, '7040', 'Blaregnies'),
(274, '7321', 'Blaton'),
(275, '7370', 'Blaugies'),
(276, '4670', 'Blégny'),
(277, '7620', 'Bléharies'),
(278, '4280', 'Blehen'),
(279, '6760', 'Bleid'),
(280, '4300', 'Bleret'),
(281, '7903', 'Blicquy'),
(282, '3950', 'Bocholt'),
(283, '4537', 'Bodegnée'),
(284, '2530', 'Boechout'),
(285, '3890', 'Boekhout'),
(286, '9961', 'Boekhoute'),
(287, '4250', 'Boëlhe'),
(288, '8904', 'Boezinge'),
(289, '1670', 'Bogaarden'),
(290, '5550', 'Bohan'),
(291, '5140', 'Boignée'),
(292, '4690', 'Boirs'),
(293, '7170', 'Bois-D\'Haine'),
(294, '7866', 'Bois-De-Lessines'),
(295, '5170', 'Bois-De-Villers'),
(296, '4560', 'Bois-Et-Borsu'),
(297, '5310', 'Bolinne'),
(298, '4653', 'Bolland'),
(299, '1367', 'Bomal'),
(300, '6941', 'Bomal-Sur-Ourthe'),
(301, '4607', 'Bombaye'),
(302, '3840', 'Bommershoven'),
(303, '7603', 'Bon-Secours'),
(304, '4100', 'Boncelles'),
(305, '5310', 'Boneffe'),
(306, '2820', 'Bonheiden'),
(307, '5021', 'Boninne'),
(308, '1325', 'Bonlez'),
(309, '6700', 'Bonnert'),
(310, '5300', 'Bonneville'),
(311, '5377', 'Bonsin'),
(312, '2221', 'Booischot'),
(313, '8630', 'Booitshoeke'),
(314, '2850', 'Boom'),
(315, '3631', 'Boorsem'),
(316, '3190', 'Boortmeerbeek'),
(317, '1761', 'Borchtlombeek'),
(318, '2140', 'Borgerhout'),
(319, '3840', 'Borgloon'),
(320, '4317', 'Borlez'),
(321, '3891', 'Borlo'),
(322, '6941', 'Borlon'),
(323, '2880', 'Bornem'),
(324, '1404', 'Bornival'),
(325, '2150', 'Borsbeek'),
(326, '9552', 'Borsbeke'),
(327, '5032', 'Bossière'),
(328, '8583', 'Bossuit'),
(329, '1390', 'Bossut-Gottechain'),
(330, '3300', 'Bost'),
(331, '5032', 'Bothey'),
(332, '9820', 'Bottelare'),
(333, '6200', 'Bouffioulx'),
(334, '5004', 'Bouge'),
(335, '7040', 'Bougnies'),
(336, '6830', 'Bouillon'),
(337, '6464', 'Bourlers'),
(338, '5575', 'Bourseigne-Neuve'),
(339, '5575', 'Bourseigne-Vieille'),
(340, '7110', 'Boussoit'),
(341, '7300', 'Boussu'),
(342, '5660', 'Boussu-En-Fagne'),
(343, '6440', 'Boussu-Lez-Walcourt'),
(344, '1470', 'Bousval'),
(345, '3370', 'Boutersem'),
(346, '5500', 'Bouvignes-Sur-Meuse'),
(347, '7803', 'Bouvignies'),
(348, '2288', 'Bouwel'),
(349, '8680', 'Bovekerke'),
(350, '3870', 'Bovelingen'),
(351, '4300', 'Bovenistier'),
(352, '5081', 'Bovesse'),
(353, '6671', 'Bovigny'),
(354, '4990', 'Bra'),
(355, '7604', 'Braffe'),
(356, '5590', 'Braibant'),
(357, '1420', 'Braine-L\'Alleud'),
(358, '1440', 'Braine-Le-Château'),
(359, '7090', 'Braine-Le-Comte'),
(360, '4260', 'Braives'),
(361, '9660', 'Brakel'),
(362, '5310', 'Branchon'),
(363, '6800', 'Bras'),
(364, '7604', 'Brasm‚nil'),
(365, '2930', 'Brasschaat'),
(366, '7130', 'Bray'),
(367, '2960', 'Brecht'),
(368, '8450', 'Bredene'),
(369, '3960', 'Bree'),
(370, '2870', 'Breendonk'),
(371, '4020', 'Bressoux'),
(372, '8900', 'Brielen'),
(373, '2520', 'Broechem'),
(374, '3840', 'Broekom'),
(375, '1931', 'Brucargo'),
(376, '7940', 'Brugelette'),
(377, '8000', 'Brugge'),
(378, '5660', 'Brûly'),
(379, '5660', 'Brûly-De-Pesche'),
(380, '1785', 'Brussegem'),
(381, '1000', 'Brussel'),
(382, '1099', 'Brussel X'),
(383, '3800', 'Brustem'),
(384, '7641', 'Bruyelle'),
(385, '6222', 'Brye'),
(386, '3440', 'Budingen'),
(387, '9255', 'Buggenhout'),
(388, '7911', 'Buissenal'),
(389, '5580', 'Buissonville'),
(390, '1501', 'Buizingen'),
(391, '1910', 'Buken'),
(392, '8630', 'Bulskamp'),
(393, '3380', 'Bunsbeek'),
(394, '2070', 'Burcht'),
(395, '4210', 'Burdinne'),
(396, '6927', 'Bure'),
(397, '9420', 'Burst'),
(398, '7602', 'Bury'),
(399, '4750', 'Butgenbach'),
(400, '3891', 'Buvingen'),
(401, '7133', 'Buvrinnes'),
(402, '6743', 'Buzenol'),
(403, '6230', 'Buzet'),
(404, '4760', 'Büllingen'),
(405, '7604', 'Callenelle'),
(406, '7642', 'Calonne'),
(407, '7940', 'Cambron-Casteau'),
(408, '7870', 'Cambron-Saint-Vincent'),
(409, '1804', 'Cargovil'),
(410, '6850', 'Carlsbourg'),
(411, '7141', 'Carnières'),
(412, '7061', 'Casteau'),
(413, '5650', 'Castillon'),
(414, '4317', 'Celles'),
(415, '5561', 'Celles'),
(416, '7760', 'Celles'),
(417, '4632', 'Cérexhe-Heuseux'),
(418, '5630', 'Cerfontaine'),
(419, '1341', 'Céroux-Mousty'),
(420, '4650', 'Chaineux'),
(421, '5550', 'Chairière'),
(422, '5020', 'Champion'),
(423, '6971', 'Champlon'),
(424, '6921', 'Chanly'),
(425, '6742', 'Chantemelle'),
(426, '7903', 'Chapelle-À-Oie'),
(427, '7903', 'Chapelle-À-Wattines'),
(428, '7160', 'Chapelle-Lez-Herlaimont'),
(429, '4537', 'Chapon-Seraing'),
(430, '6000', 'Charleroi'),
(431, '6099', 'Charleroi X'),
(432, '4654', 'Charneux'),
(433, '6824', 'Chassepierre'),
(434, '1450', 'Chastre-Villeroux-Blanmont'),
(435, '5650', 'Chastrès'),
(436, '6200', 'Châtelet'),
(437, '6200', 'Châtelineau'),
(438, '6747', 'Châtillon'),
(439, '4050', 'Chaudfontaine'),
(440, '1325', 'Chaumont-Gistoux'),
(441, '7063', 'Chauss‚e-Notre-Dame-Louvignies'),
(442, '4032', 'Chênée'),
(443, '6673', 'Cherain'),
(444, '4602', 'Cheratte'),
(445, '7521', 'Chercq'),
(446, '5590', 'Chevetogne'),
(447, '4987', 'Chevron'),
(448, '7950', 'Chièvres'),
(449, '6460', 'Chimay'),
(450, '6810', 'Chiny'),
(451, '4400', 'Chokier'),
(452, '1031', 'Christelijke Sociale Organisaties'),
(453, '5560', 'Ciergnon'),
(454, '5590', 'Ciney'),
(455, '4260', 'Ciplet'),
(456, '7024', 'Ciply'),
(457, '1480', 'Clabecq'),
(458, '4560', 'Clavier'),
(459, '4890', 'Clermont'),
(460, '5650', 'Clermont'),
(461, '4480', 'Clermont-Sous-Huy'),
(462, '5022', 'Cognelée'),
(463, '7340', 'Colfontaine'),
(464, '4170', 'Comblain-Au-Pont'),
(465, '4180', 'Comblain-Fairon'),
(466, '4180', 'Comblain-La-Tour'),
(467, '5590', 'Conneux'),
(468, '1435', 'Corbais'),
(469, '6838', 'Corbion'),
(470, '7910', 'Cordes'),
(471, '5620', 'Corenne'),
(472, '4860', 'Cornesse'),
(473, '5555', 'Cornimont'),
(474, '1935', 'Corporate Village'),
(475, '5032', 'Corroy-Le-Château'),
(476, '1325', 'Corroy-Le-Grand'),
(477, '4257', 'Corswarem'),
(478, '1450', 'Cortil-Noirmont'),
(479, '5380', 'Cortil-Wodon'),
(480, '6010', 'Couillet'),
(481, '6120', 'Cour-Sur-Heure'),
(482, '6180', 'Courcelles'),
(483, '5336', 'Courrière'),
(484, '1490', 'Court-Saint-Etienne'),
(485, '4218', 'Couthuin'),
(486, '5300', 'Coutisse'),
(487, '1380', 'Couture-Saint-Germain'),
(488, '5660', 'Couvin'),
(489, '4280', 'Cras-Avernas'),
(490, '4280', 'Crehen'),
(491, '4367', 'Crisn‚e'),
(492, '7120', 'Croix-Lez-Rouveroy'),
(493, '4784', 'Crombach'),
(494, '5332', 'Crupet'),
(495, '6075', 'CSM Charleroi X'),
(496, '9075', 'CSM Gent X'),
(497, '7033', 'Cuesmes'),
(498, '6880', 'Cugnon'),
(499, '5660', 'Cul-Des-Sarts'),
(500, '5562', 'Custinne'),
(501, '8890', 'Dadizele'),
(502, '5660', 'Dailly'),
(503, '9160', 'Daknam'),
(504, '4607', 'Dalhem'),
(505, '8340', 'Damme'),
(506, '6767', 'Dampicourt'),
(507, '6020', 'Dampremy'),
(508, '7512', 'DANIEL JOUVANCE'),
(509, '4253', 'Darion'),
(510, '5630', 'Daussois'),
(511, '5020', 'Daussoulx'),
(512, '5100', 'Dave'),
(513, '6929', 'Daverdisse'),
(514, '8420', 'De Haan'),
(515, '9170', 'De Klinge'),
(516, '8630', 'De Moeren'),
(517, '8660', 'De Panne'),
(518, '9840', 'De Pinte'),
(519, '8540', 'Deerlijk'),
(520, '9570', 'Deftinge'),
(521, '9800', 'Deinze'),
(522, '9280', 'Denderbelle'),
(523, '9450', 'Denderhoutem'),
(524, '9470', 'Denderleeuw'),
(525, '9200', 'Dendermonde'),
(526, '9400', 'Denderwindeke'),
(527, '5537', 'Denée'),
(528, '8720', 'Dentergem'),
(529, '7912', 'Dergneau'),
(530, '2480', 'Dessel'),
(531, '8792', 'Desselgem'),
(532, '9070', 'Destelbergen'),
(533, '9042', 'Desteldonk'),
(534, '9831', 'Deurle'),
(535, '2100', 'Deurne'),
(536, '3290', 'Deurne'),
(537, '7864', 'Deux-Acren'),
(538, '5310', 'Dhuy'),
(539, '1831', 'Diegem'),
(540, '3590', 'Diepenbeek'),
(541, '3290', 'Diest'),
(542, '3700', 'Diets-Heur'),
(543, '8900', 'Dikkebus'),
(544, '9630', 'Dikkele'),
(545, '9890', 'Dikkelvenne'),
(546, '8600', 'Diksmuide'),
(547, '1700', 'Dilbeek'),
(548, '3650', 'Dilsen'),
(549, '3650', 'Dilsen-Stokkem'),
(550, '5500', 'Dinant'),
(551, '5570', 'Dion'),
(552, '1325', 'Dion-Valmont'),
(553, '4820', 'Dison'),
(554, '6960', 'Dochamps'),
(555, '9130', 'Doel'),
(556, '6836', 'Dohan'),
(557, '5680', 'Doische'),
(558, '4140', 'Dolembreux'),
(559, '4357', 'Donceel'),
(560, '1370', 'Dongelberg'),
(561, '3540', 'Donk'),
(562, '6536', 'Donstiennes'),
(563, '5530', 'Dorinne'),
(564, '3440', 'Dormaal'),
(565, '7711', 'Dottenijs'),
(566, '7370', 'Dour'),
(567, '5670', 'Dourbes'),
(568, '8951', 'Dranouter'),
(569, '5500', 'Dréhance'),
(570, '8600', 'Driekapellen'),
(571, '3350', 'Drieslinter'),
(572, '1620', 'Drogenbos'),
(573, '9031', 'Drongen'),
(574, '8380', 'Dudzele'),
(575, '2570', 'Duffel'),
(576, '3080', 'Duisburg'),
(577, '3803', 'Duras'),
(578, '6940', 'Durbuy'),
(579, '5530', 'Durnal'),
(580, '1653', 'Dworp'),
(581, '4690', 'Eben-Emael'),
(582, '6860', 'Ebly'),
(583, '7190', 'Ecaussinnes-D\'Enghien'),
(584, '7191', 'Ecaussinnes-Lalaing'),
(585, '2650', 'Edegem'),
(586, '9700', 'Edelare'),
(587, '7850', 'Edingen'),
(588, '9900', 'Eeklo'),
(589, '8480', 'Eernegem'),
(590, '8740', 'Egem'),
(591, '8630', 'Eggewaartskapelle'),
(592, '5310', 'Eghez‚e'),
(593, '4120', 'Ehein'),
(594, '4480', 'Ehein'),
(595, '3740', 'Eigenbilzen'),
(596, '2430', 'Eindhout'),
(597, '9700', 'Eine'),
(598, '3630', 'Eisden'),
(599, '9810', 'Eke'),
(600, '2180', 'Ekeren'),
(601, '9160', 'Eksaarde'),
(602, '3941', 'Eksel'),
(603, '3650', 'Elen'),
(604, '9620', 'Elene'),
(605, '1982', 'Elewijt'),
(606, '3400', 'Eliksem'),
(607, '1671', 'Elingen'),
(608, '4590', 'Ellemelle'),
(609, '7890', 'Ellezelles'),
(610, '7910', 'Ellignies-Lez-Frasnes'),
(611, '7972', 'Ellignies-Sainte-Anne'),
(612, '3670', 'Ellikom'),
(613, '7370', 'Elouges'),
(614, '9790', 'Elsegem'),
(615, '4750', 'Elsenborn'),
(616, '1050', 'Elsene'),
(617, '9660', 'Elst'),
(618, '8906', 'Elverdinge'),
(619, '9140', 'Elversele'),
(620, '2520', 'Emblem'),
(621, '4053', 'Embourg'),
(622, '8870', 'Emelgem'),
(623, '5080', 'Emines'),
(624, '5363', 'Emptinne'),
(625, '9700', 'Ename'),
(626, '3800', 'Engelmanshoven'),
(627, '4480', 'Engis'),
(628, '1350', 'Enines'),
(629, '4800', 'Ensival'),
(630, '7134', 'Epinois'),
(631, '1980', 'Eppegem'),
(632, '5580', 'Eprave'),
(633, '7050', 'Erbaut'),
(634, '7050', 'Erbisoeul'),
(635, '7500', 'Ere'),
(636, '9320', 'Erembodegem'),
(637, '6997', 'Erezée'),
(638, '5644', 'Ermeton-Sur-Biert'),
(639, '5030', 'Ernage'),
(640, '6972', 'Erneuville'),
(641, '4920', 'Ernonheid'),
(642, '9420', 'Erondegem'),
(643, '9420', 'Erpe'),
(644, '5101', 'Erpent'),
(645, '6441', 'Erpion'),
(646, '3071', 'Erps-Kwerps'),
(647, '6560', 'Erquelinnes'),
(648, '7387', 'Erquennes'),
(649, '9940', 'Ertvelde'),
(650, '9620', 'Erwetegem'),
(651, '7760', 'Escanaffles'),
(652, '8600', 'Esen'),
(653, '4130', 'Esneux'),
(654, '7502', 'Esplechin'),
(655, '7743', 'Esquelmes'),
(656, '2910', 'Essen'),
(657, '1790', 'Essene'),
(658, '7730', 'Estaimbourg'),
(659, '7730', 'Estaimpuis'),
(660, '7120', 'Estinnes-Au-Mont'),
(661, '7120', 'Estinnes-Au-Val'),
(662, '6740', 'Etalle'),
(663, '6760', 'Ethe'),
(664, '9680', 'Etikhove'),
(665, '8460', 'Ettelgem'),
(666, '1040', 'Etterbeek'),
(667, '7080', 'Eugies'),
(668, '4700', 'Eupen'),
(669, '1046', 'European External Action Service'),
(670, '1047', 'Europees Parlement'),
(671, '1049', 'Europese unie - Commissie'),
(672, '1048', 'Europese unie - Raad'),
(673, '4631', 'Evegn‚e'),
(674, '5350', 'Evelette'),
(675, '9660', 'Everbeek'),
(676, '3078', 'Everberg'),
(677, '1140', 'Evere'),
(678, '9940', 'Evergem'),
(679, '7730', 'Evregnies'),
(680, '5530', 'Evrehailles'),
(681, '4731', 'Eynatten'),
(682, '3400', 'Ezemaal'),
(683, '5600', 'Fagnolle'),
(684, '4317', 'Faimes'),
(685, '5522', 'Fala‰n'),
(686, '5060', 'Falisolle'),
(687, '4260', 'Fallais'),
(688, '5500', 'Falmagne'),
(689, '5500', 'Falmignoul'),
(690, '7181', 'Familleureux'),
(691, '6240', 'Farciennes'),
(692, '5340', 'Faulx-Les-Tombes'),
(693, '7120', 'Fauroeulx'),
(694, '6637', 'Fauvillers'),
(695, '4950', 'Faymonville'),
(696, '6856', 'Fays-Les-Veneurs'),
(697, '7387', 'Fayt-Le-Franc'),
(698, '7170', 'Fayt-Lez-Manage'),
(699, '5570', 'Felenne'),
(700, '7181', 'Feluy'),
(701, '4607', 'Feneur'),
(702, '4190', 'Ferrières'),
(703, '5570', 'Feschaux'),
(704, '4347', 'Fexhe-Le-Haut-Clocher'),
(705, '4458', 'Fexhe-Slins'),
(706, '4181', 'Filot'),
(707, '5560', 'Finnevaux'),
(708, '4530', 'Fize-Fontaine'),
(709, '4367', 'Fize-Le-Marsal'),
(710, '6686', 'Flamierge'),
(711, '5620', 'Flavion'),
(712, '5020', 'Flawinne'),
(713, '4400', 'Flémalle-Grande'),
(714, '4400', 'Flémalle-Haute'),
(715, '7012', 'Flénu'),
(716, '4620', 'Fléron'),
(717, '6220', 'Fleurus'),
(718, '4540', 'Flône'),
(719, '5334', 'Florée'),
(720, '5150', 'Floreffe'),
(721, '5620', 'Florennes'),
(722, '6820', 'Florenville'),
(723, '5150', 'Floriffoux'),
(724, '5370', 'Flostoy'),
(725, '5572', 'Focant'),
(726, '1212', 'FOD Mobiliteit'),
(727, '1350', 'Folx-Les-Caves'),
(728, '6140', 'Fontaine-L\'Evêque'),
(729, '6567', 'Fontaine-Valmont'),
(730, '5650', 'Fontenelle'),
(731, '6820', 'Fontenoille'),
(732, '7643', 'Fontenoy'),
(733, '4340', 'Fooz'),
(734, '6141', 'Forchies-La-Marche'),
(735, '7910', 'Forest'),
(736, '4870', 'Forêt'),
(737, '6596', 'Forge-Philippe'),
(738, '6464', 'Forges'),
(739, '6953', 'Forrières'),
(740, '5380', 'Forville'),
(741, '4980', 'Fosse'),
(742, '5070', 'Fosses-La-Ville'),
(743, '7830', 'Fouleng'),
(744, '6440', 'Fourbechies'),
(745, '5504', 'Foy-Notre-Dame'),
(746, '4870', 'Fraipont'),
(747, '5650', 'Fraire'),
(748, '4557', 'Fraiture'),
(749, '7080', 'Frameries'),
(750, '6853', 'Framont'),
(751, '5380', 'Franc-Waret'),
(752, '5600', 'Franchimont'),
(753, '4970', 'Francorchamps'),
(754, '5150', 'Franière'),
(755, '5660', 'Frasnes'),
(756, '7911', 'Frasnes-Lez-Buissenal'),
(757, '6210', 'Frasnes-Lez-Gosselies'),
(758, '4347', 'Freloux'),
(759, '6800', 'Freux'),
(760, '6440', 'Froidchapelle'),
(761, '5576', 'Froidfontaine'),
(762, '7504', 'Froidmont'),
(763, '6990', 'Fronville'),
(764, '7503', 'Froyennes'),
(765, '4260', 'Fumal'),
(766, '5500', 'Furfooz'),
(767, '5641', 'Furnaux'),
(768, '1750', 'Gaasbeek'),
(769, '7943', 'Gages'),
(770, '7906', 'Gallaix'),
(771, '1570', 'Galmaarden'),
(772, '1083', 'Ganshoren'),
(773, '7530', 'Gaurain-Ramecroix'),
(774, '9890', 'Gavere'),
(775, '5575', 'Gedinne'),
(776, '2440', 'Geel'),
(777, '4250', 'Geer'),
(778, '1367', 'Geest-Gérompont-Petit-Rosière'),
(779, '3450', 'Geetbets'),
(780, '5024', 'Gelbressée'),
(781, '3800', 'Gelinden'),
(782, '3620', 'Gellik'),
(783, '3200', 'Gelrode'),
(784, '8980', 'Geluveld'),
(785, '8940', 'Geluwe'),
(786, '6929', 'Gembes'),
(787, '5030', 'Gembloux'),
(788, '4851', 'Gemmenich'),
(789, '1470', 'Genappe'),
(790, '3600', 'Genk'),
(791, '7040', 'Genly'),
(792, '3770', 'Genoelselderen'),
(793, '9000', 'Gent'),
(794, '9099', 'Gent X'),
(795, '9050', 'Gentbrugge'),
(796, '1450', 'Gentinnes'),
(797, '1332', 'Genval'),
(798, '9500', 'Geraardsbergen'),
(799, '3960', 'Gerdingen'),
(800, '5524', 'Gérin'),
(801, '1367', 'Gérompont'),
(802, '6769', 'Gérouville'),
(803, '6280', 'Gerpinnes'),
(804, '2590', 'Gestel'),
(805, '5340', 'Gesves'),
(806, '7822', 'Ghislenghien'),
(807, '7011', 'Ghlin'),
(808, '7863', 'Ghoy'),
(809, '7823', 'Gibecq'),
(810, '2275', 'Gierle'),
(811, '8691', 'Gijverinkhove'),
(812, '9308', 'Gijzegem'),
(813, '8570', 'Gijzelbrechtegem'),
(814, '9860', 'Gijzenzele'),
(815, '6060', 'Gilly'),
(816, '5680', 'Gimnée'),
(817, '3890', 'Gingelom'),
(818, '8470', 'Gistel'),
(819, '8830', 'Gits'),
(820, '7041', 'Givry'),
(821, '1473', 'Glabais'),
(822, '3380', 'Glabbeek'),
(823, '4000', 'Glain'),
(824, '4400', 'Gleixhe'),
(825, '1315', 'Glimes'),
(826, '4690', 'Glons'),
(827, '5680', 'Gochenée'),
(828, '7160', 'Godarville'),
(829, '5530', 'Godinne'),
(830, '9620', 'Godveerdegem'),
(831, '4834', 'Goé'),
(832, '9500', 'Goeferdinge'),
(833, '7040', 'Goegnies-Chaussée'),
(834, '5353', 'Goesnes'),
(835, '3300', 'Goetsenhoven'),
(836, '4140', 'Gomz‚-Andoumont'),
(837, '7830', 'Gondregnies'),
(838, '5660', 'Gonrieux'),
(839, '9090', 'Gontrode'),
(840, '1755', 'Gooik'),
(841, '3840', 'Gors-Opleeuw'),
(842, '3803', 'Gorsem'),
(843, '6041', 'Gosselies'),
(844, '3840', 'Gotem'),
(845, '9800', 'Gottem'),
(846, '7070', 'Gottignies'),
(847, '6280', 'Gougnies'),
(848, '5651', 'Gourdinne'),
(849, '6030', 'Goutroux'),
(850, '6670', 'Gouvy'),
(851, '6181', 'Gouy-Lez-Piéton'),
(852, '6534', 'Gozée'),
(853, '4460', 'Grâce-Berleur'),
(854, '4460', 'Grâce-Hollogne'),
(855, '5555', 'Graide'),
(856, '9800', 'Grammene'),
(857, '4300', 'Grand-Axhe'),
(858, '4280', 'Grand-Hallet'),
(859, '6698', 'Grand-Halleux'),
(860, '5031', 'Grand-Leez'),
(861, '5030', 'Grand-Manil'),
(862, '4650', 'Grand-Rechain'),
(863, '6560', 'Grand-Reng'),
(864, '1367', 'Grand-Rosière-Hottomont'),
(865, '7973', 'Grandglise'),
(866, '6940', 'Grandhan'),
(867, '6960', 'Grandménil'),
(868, '7900', 'Grandmetz'),
(869, '6470', 'Grandrieu'),
(870, '4360', 'Grandville'),
(871, '6840', 'Grandvoir'),
(872, '6840', 'Grapfontaine'),
(873, '7830', 'Graty'),
(874, '5640', 'Graux'),
(875, '3450', 'Grazen'),
(876, '9200', 'Grembergen'),
(877, '1390', 'Grez-Doiceau'),
(878, '1850', 'Grimbergen'),
(879, '9506', 'Grimminge'),
(880, '4030', 'Grivegnée'),
(881, '2280', 'Grobbendonk'),
(882, '1702', 'Groot-Bijgaarden'),
(883, '3800', 'Groot-Gelmen'),
(884, '3840', 'Groot-Loon'),
(885, '5555', 'Gros-Fays'),
(886, '7950', 'Grosage'),
(887, '3990', 'Grote-Brogel'),
(888, '3740', 'Grote-Spouwen'),
(889, '9620', 'Grotenberge'),
(890, '3670', 'Gruitrode'),
(891, '6952', 'Grune'),
(892, '6927', 'Grupont'),
(893, '7620', 'Guignies'),
(894, '3723', 'Guigoven'),
(895, '6704', 'Guirsch'),
(896, '8560', 'Gullegem'),
(897, '3870', 'Gutshoven'),
(898, '3150', 'Haacht'),
(899, '9450', 'Haaltert'),
(900, '9120', 'Haasdonk'),
(901, '3053', 'Haasrode'),
(902, '6720', 'Habay-La-Neuve'),
(903, '6723', 'Habay-La-Vieille'),
(904, '6782', 'Habergy'),
(905, '4684', 'Haccourt'),
(906, '6720', 'Hachy'),
(907, '7911', 'Hacquegnies'),
(908, '5351', 'Haillot'),
(909, '7100', 'Haine-Saint-Paul'),
(910, '7100', 'Haine-Saint-Pierre'),
(911, '7350', 'Hainin'),
(912, '3300', 'Hakendover'),
(913, '6792', 'Halanzy'),
(914, '3545', 'Halen'),
(915, '2220', 'Hallaar'),
(916, '1500', 'Halle'),
(917, '2980', 'Halle'),
(918, '3440', 'Halle-Booienhoven'),
(919, '6986', 'Halleux'),
(920, '6922', 'Halma'),
(921, '3800', 'Halmaal'),
(922, '5340', 'Haltinne'),
(923, '6120', 'Ham-Sur-Heure'),
(924, '5190', 'Ham-Sur-Sambre'),
(925, '6840', 'Hamipr‚'),
(926, '1785', 'Hamme'),
(927, '9220', 'Hamme'),
(928, '1320', 'Hamme-Mille'),
(929, '4180', 'Hamoir'),
(930, '5360', 'Hamois'),
(931, '3930', 'Hamont'),
(932, '6990', 'Hampteau'),
(933, '5580', 'Han-Sur-Lesse'),
(934, '8610', 'Handzame'),
(935, '4357', 'Haneffe'),
(936, '4210', 'Hannêche'),
(937, '4280', 'Hannut'),
(938, '5310', 'Hanret'),
(939, '9850', 'Hansbeke'),
(940, '6560', 'Hantes-Wihéries'),
(941, '5621', 'Hanzinelle'),
(942, '5621', 'Hanzinne'),
(943, '7321', 'Harchies'),
(944, '8530', 'Harelbeke'),
(945, '1130', 'Haren'),
(946, '3700', 'Haren'),
(947, '3840', 'Haren'),
(948, '6900', 'Hargimont'),
(949, '7022', 'Harmignies'),
(950, '6767', 'Harnoncourt'),
(951, '6960', 'Harre'),
(952, '6950', 'Harsin'),
(953, '7022', 'Harveng'),
(954, '4920', 'Harz‚'),
(955, '3500', 'Hasselt'),
(956, '5540', 'Hastière-Lavaux'),
(957, '5541', 'Hastière-Par-Delà'),
(958, '6870', 'Hatrival'),
(959, '7120', 'Haulchin'),
(960, '4730', 'Hauset'),
(961, '6929', 'Haut-Fays'),
(962, '1461', 'Haut-Ittre'),
(963, '5537', 'Haut-Le-Wastia'),
(964, '7334', 'Hautrage'),
(965, '7041', 'Havay'),
(966, '5370', 'Havelange'),
(967, '5590', 'Haversin'),
(968, '7531', 'Havinnes'),
(969, '7021', 'Havré'),
(970, '3940', 'Hechtel'),
(971, '5543', 'Heer'),
(972, '3870', 'Heers'),
(973, '3740', 'Hees'),
(974, '8551', 'Heestert'),
(975, '2801', 'Heffen'),
(976, '1670', 'Heikruis'),
(977, '2830', 'Heindonk'),
(978, '6700', 'Heinsch'),
(979, '8301', 'Heist-Aan-Zee'),
(980, '2220', 'Heist-Op-Den-Berg'),
(981, '1790', 'Hekelgem'),
(982, '3870', 'Heks'),
(983, '3530', 'Helchteren'),
(984, '9450', 'Heldergem'),
(985, '3440', 'Helen-Bos'),
(986, '8587', 'Helkijn'),
(987, '7830', 'Hellebecq'),
(988, '9571', 'Hemelveerdegem'),
(989, '2620', 'Hemiksem'),
(990, '5380', 'Hemptinne'),
(991, '5620', 'Hemptinne-Lez-Florennes'),
(992, '3840', 'Hendrieken'),
(993, '3700', 'Henis'),
(994, '7090', 'Hennuyères'),
(995, '4841', 'Henri-Chapelle'),
(996, '7090', 'Henripont'),
(997, '7350', 'Hensies'),
(998, '3971', 'Heppen'),
(999, '4771', 'Heppenbach'),
(1000, '6220', 'Heppignies'),
(1001, '6887', 'Herbeumont'),
(1002, '7050', 'Herchies'),
(1003, '3770', 'Herderen'),
(1004, '9310', 'Herdersem'),
(1005, '3020', 'Herent'),
(1006, '2200', 'Herentals'),
(1007, '2270', 'Herenthout'),
(1008, '1540', 'Herfelingen'),
(1009, '4728', 'Hergenrath'),
(1010, '7742', 'Hérinnes-Lez-Pecq'),
(1011, '3540', 'Herk-De-Stad'),
(1012, '4681', 'Hermalle-Sous-Argenteau'),
(1013, '4480', 'Hermalle-Sous-Huy'),
(1014, '4680', 'Hermée'),
(1015, '5540', 'Hermeton-Sur-Meuse'),
(1016, '1540', 'Herne'),
(1017, '4217', 'Héron'),
(1018, '7911', 'Herquegies'),
(1019, '7712', 'Herseaux'),
(1020, '2230', 'Herselt'),
(1021, '4040', 'Herstal'),
(1022, '3717', 'Herstappe'),
(1023, '7522', 'Hertain'),
(1024, '3831', 'Herten'),
(1025, '8020', 'Hertsberge'),
(1026, '4650', 'Herve'),
(1027, '9550', 'Herzele'),
(1028, '8501', 'Heule'),
(1029, '5377', 'Heure'),
(1030, '4682', 'Heure-Le-Romain'),
(1031, '9700', 'Heurne'),
(1032, '3550', 'Heusden'),
(1033, '9070', 'Heusden'),
(1034, '3550', 'Heusden-Zolder'),
(1035, '4802', 'Heusy'),
(1036, '3191', 'Hever'),
(1037, '3001', 'Heverlee'),
(1038, '1435', 'Hévillers'),
(1039, '6941', 'Heyd'),
(1040, '1733', 'HighCo DATA'),
(1041, '9550', 'Hillegem'),
(1042, '2880', 'Hingene'),
(1043, '5380', 'Hingeon'),
(1044, '6984', 'Hives'),
(1045, '2660', 'Hoboken'),
(1046, '4351', 'Hodeige'),
(1047, '6987', 'Hodister'),
(1048, '4162', 'Hody'),
(1049, '3320', 'Hoegaarden'),
(1050, '1560', 'Hoeilaart'),
(1051, '8340', 'Hoeke'),
(1052, '3746', 'Hoelbeek'),
(1053, '3471', 'Hoeleden'),
(1054, '3840', 'Hoepertingen'),
(1055, '3730', 'Hoeselt'),
(1056, '2940', 'Hoevenen'),
(1057, '1981', 'Hofstade'),
(1058, '9308', 'Hofstade'),
(1059, '5377', 'Hogne'),
(1060, '4342', 'Hognoul'),
(1061, '7620', 'Hollain'),
(1062, '6637', 'Hollange'),
(1063, '8902', 'Hollebeke'),
(1064, '4460', 'Hollogne-Aux-Pierres'),
(1065, '4250', 'Hollogne-Sur-Geer'),
(1066, '3220', 'Holsbeek'),
(1067, '2811', 'Hombeek'),
(1068, '4852', 'Hombourg'),
(1069, '6640', 'Hompré'),
(1070, '6780', 'Hondelange'),
(1071, '5570', 'Honnay'),
(1072, '8830', 'Hooglede'),
(1073, '8690', 'Hoogstade'),
(1074, '2320', 'Hoogstraten'),
(1075, '4460', 'Horion-Hoz‚mont'),
(1076, '7301', 'Hornu'),
(1077, '3870', 'Horpmaal'),
(1078, '7060', 'Horrues'),
(1079, '6990', 'Hotton'),
(1080, '6724', 'Houdemont'),
(1081, '7110', 'Houdeng-Aimeries'),
(1082, '7110', 'Houdeng-Goegnies'),
(1083, '5575', 'Houdremont'),
(1084, '6660', 'Houffalize'),
(1085, '5563', 'Hour'),
(1086, '4671', 'Housse'),
(1087, '1476', 'Houtain-Le-Val'),
(1088, '4682', 'Houtain-Saint-Siméon'),
(1089, '7812', 'Houtaing'),
(1090, '8377', 'Houtave'),
(1091, '8630', 'Houtem'),
(1092, '3530', 'Houthalen'),
(1093, '7781', 'Houthem'),
(1094, '8650', 'Houthulst'),
(1095, '2235', 'Houtvenne'),
(1096, '3390', 'Houwaart'),
(1097, '5530', 'Houx'),
(1098, '5560', 'Houyet'),
(1099, '2540', 'Hove'),
(1100, '7830', 'Hoves'),
(1101, '7624', 'Howardries'),
(1102, '4520', 'Huccorgne'),
(1103, '9750', 'Huise'),
(1104, '7950', 'Huissignies'),
(1105, '1654', 'Huizingen'),
(1106, '3040', 'Huldenberg'),
(1107, '2235', 'Hulshout'),
(1108, '5560', 'Hulsonniaux'),
(1109, '8531', 'Hulste'),
(1110, '6900', 'Humain'),
(1111, '1851', 'Humbeek'),
(1112, '9630', 'Hundelgem'),
(1113, '1367', 'Huppaye'),
(1114, '4500', 'Huy'),
(1115, '7022', 'Hyon'),
(1116, '8480', 'Ichtegem'),
(1117, '9472', 'Iddergem'),
(1118, '9506', 'Idegem'),
(1119, '8900', 'Ieper'),
(1120, '9340', 'Impe'),
(1121, '1315', 'Incourt'),
(1122, '8770', 'Ingelmunster'),
(1123, '8570', 'Ingooigem'),
(1124, '1041', 'International press center'),
(1125, '7801', 'Irchonwelz'),
(1126, '7822', 'Isières'),
(1127, '5032', 'Isnes'),
(1128, '2222', 'Itegem'),
(1129, '1701', 'Itterbeek'),
(1130, '1460', 'Ittre'),
(1131, '4400', 'Ivoz-Ramet'),
(1132, '8870', 'Izegem'),
(1133, '6810', 'Izel'),
(1134, '8691', 'Izenberge'),
(1135, '6941', 'Izier'),
(1136, '8490', 'Jabbeke'),
(1137, '4845', 'Jalhay'),
(1138, '5354', 'Jallet'),
(1139, '5600', 'Jamagne'),
(1140, '5100', 'Jambes'),
(1141, '5600', 'Jamiolle'),
(1142, '6120', 'Jamioulx'),
(1143, '6810', 'Jamoigne'),
(1144, '1350', 'Jandrain-Jandrenouille'),
(1145, '1350', 'Jauche'),
(1146, '1370', 'Jauchelette'),
(1147, '5570', 'Javingue'),
(1148, '4540', 'Jehay'),
(1149, '6880', 'Jehonville'),
(1150, '7012', 'Jemappes'),
(1151, '5580', 'Jemelle'),
(1152, '5589', 'Jemelle'),
(1153, '4101', 'Jemeppe-Sur-Meuse'),
(1154, '5190', 'Jemeppe-Sur-Sambre'),
(1155, '4357', 'Jeneffe'),
(1156, '5370', 'Jeneffe'),
(1157, '3840', 'Jesseren'),
(1158, '1090', 'Jette'),
(1159, '3890', 'Jeuk'),
(1160, '1370', 'Jodoigne'),
(1161, '1370', 'Jodoigne-Souveraine'),
(1162, '7620', 'Jollain-Merlin'),
(1163, '6280', 'Joncret'),
(1164, '4650', 'Jul‚mont'),
(1165, '6040', 'Jumet'),
(1166, '4020', 'Jupille-Sur-Meuse'),
(1167, '4450', 'Juprelle'),
(1168, '7050', 'Jurbise'),
(1169, '6642', 'Juseret'),
(1170, '8600', 'Kaaskerke'),
(1171, '8870', 'Kachtem'),
(1172, '3293', 'Kaggevinne'),
(1173, '7540', 'Kain'),
(1174, '9270', 'Kalken'),
(1175, '9120', 'Kallo'),
(1176, '9130', 'Kallo'),
(1177, '2920', 'Kalmthout'),
(1178, '1008', 'Kamer van Volksvertegenwoordigers'),
(1179, '1910', 'Kampenhout'),
(1180, '8700', 'Kanegem'),
(1181, '3770', 'Kanne'),
(1182, '1880', 'Kapelle-Op-Den-Bos'),
(1183, '2950', 'Kapellen'),
(1184, '3381', 'Kapellen'),
(1185, '9970', 'Kaprijke'),
(1186, '8572', 'Kaster'),
(1187, '2460', 'Kasterlee'),
(1188, '3950', 'Kaulille'),
(1189, '3140', 'Keerbergen'),
(1190, '8600', 'Keiem'),
(1191, '4720', 'Kelmis'),
(1192, '4367', 'Kemexhe'),
(1193, '8956', 'Kemmel'),
(1194, '9190', 'Kemzeke'),
(1195, '8581', 'Kerkhove'),
(1196, '3370', 'Kerkom'),
(1197, '3800', 'Kerkom-Bij-Sint-Truiden'),
(1198, '9451', 'Kerksken'),
(1199, '3510', 'Kermt'),
(1200, '3840', 'Kerniel'),
(1201, '3472', 'Kersbeek-Miskom'),
(1202, '2560', 'Kessel'),
(1203, '3010', 'Kessel Lo'),
(1204, '3640', 'Kessenich'),
(1205, '1755', 'Kester'),
(1206, '4701', 'Kettenis'),
(1207, '5060', 'Keumiée'),
(1208, '9130', 'Kieldrecht'),
(1209, '3640', 'Kinrooi'),
(1210, '3870', 'Klein-Gelmen'),
(1211, '3990', 'Kleine-Brogel'),
(1212, '3740', 'Kleine-Spouwen'),
(1213, '8420', 'Klemskerke'),
(1214, '8650', 'Klerken'),
(1215, '9940', 'Kluizen'),
(1216, '9910', 'Knesselare'),
(1217, '8300', 'Knokke'),
(1218, '1730', 'Kobbegem'),
(1219, '8680', 'Koekelare'),
(1220, '1081', 'Koekelberg'),
(1221, '3582', 'Koersel'),
(1222, '8670', 'Koksijde'),
(1223, '3700', 'Kolmont'),
(1224, '3840', 'Kolmont'),
(1225, '7780', 'Komen'),
(1226, '7780', 'Komen-Waasten'),
(1227, '2500', 'Koningshooikt'),
(1228, '3700', 'Koninksem'),
(1229, '2550', 'Kontich'),
(1230, '8510', 'Kooigem'),
(1231, '8000', 'Koolkerke'),
(1232, '8851', 'Koolskamp'),
(1233, '3060', 'Korbeek-Dijle'),
(1234, '3360', 'Korbeek-Lo'),
(1235, '8610', 'Kortemark'),
(1236, '3470', 'Kortenaken'),
(1237, '3070', 'Kortenberg'),
(1238, '3720', 'Kortessem'),
(1239, '3890', 'Kortijs'),
(1240, '8500', 'Kortrijk'),
(1241, '3220', 'Kortrijk-Dutsel'),
(1242, '3850', 'Kozen'),
(1243, '1950', 'Kraainem'),
(1244, '8972', 'Krombeke'),
(1245, '9150', 'Kruibeke'),
(1246, '9770', 'Kruishoutem'),
(1247, '3300', 'Kumtich'),
(1248, '3511', 'Kuringen'),
(1249, '3840', 'Kuttekoven'),
(1250, '8520', 'Kuurne'),
(1251, '3945', 'Kwaadmechelen'),
(1252, '9690', 'Kwaremont'),
(1253, '1320', 'L\'Ecluse'),
(1254, '6464', 'L\'Escaillère'),
(1255, '7080', 'La Bouverie'),
(1256, '7611', 'La Glanerie'),
(1257, '4987', 'La Gleize'),
(1258, '7170', 'La Hestre'),
(1259, '1310', 'La Hulpe'),
(1260, '7100', 'La Louvière'),
(1261, '4910', 'La Reid'),
(1262, '6980', 'La Roche-En-Ardenne'),
(1263, '3400', 'Laar'),
(1264, '9270', 'Laarne'),
(1265, '6567', 'Labuissière'),
(1266, '6821', 'Lacuisine'),
(1267, '7950', 'Ladeuze'),
(1268, '5550', 'Laforêt'),
(1269, '7890', 'Lahamaide'),
(1270, '1020', 'Laken'),
(1271, '7522', 'Lamain'),
(1272, '4800', 'Lambermont'),
(1273, '6220', 'Lambusart'),
(1274, '4350', 'Lamine'),
(1275, '4210', 'Lamontzée'),
(1276, '6767', 'Lamorteau'),
(1277, '8600', 'Lampernisse'),
(1278, '3620', 'Lanaken'),
(1279, '4600', 'Lanaye'),
(1280, '9850', 'Landegem'),
(1281, '6111', 'Landelies'),
(1282, '3400', 'Landen'),
(1283, '5300', 'Landenne'),
(1284, '9860', 'Landskouter'),
(1285, '5651', 'Laneffe'),
(1286, '3201', 'Langdorp'),
(1287, '8920', 'Langemark'),
(1288, '3650', 'Lanklaar'),
(1289, '7800', 'Lanquesaint'),
(1290, '4450', 'Lantin'),
(1291, '4300', 'Lantremange'),
(1292, '7622', 'Laplaigne'),
(1293, '8340', 'Lapscheure'),
(1294, '1380', 'Lasne-Chapelle-Saint-Lambert'),
(1295, '1370', 'Lathuy'),
(1296, '4261', 'Latinne'),
(1297, '6761', 'Latour'),
(1298, '3700', 'Lauw'),
(1299, '8930', 'Lauwe'),
(1300, '6681', 'Lavacherie'),
(1301, '5580', 'Lavaux-Sainte-Anne'),
(1302, '4217', 'Lavoir'),
(1303, '5670', 'Le Mesnil'),
(1304, '7070', 'Le Roeulx'),
(1305, '5070', 'Le Roux'),
(1306, '9280', 'Lebbeke'),
(1307, '9340', 'Lede'),
(1308, '9050', 'Ledeberg'),
(1309, '8880', 'Ledegem'),
(1310, '3061', 'Leefdaal'),
(1311, '1755', 'Leerbeek'),
(1312, '6142', 'Leernes'),
(1313, '6530', 'Leers-Et-Fosteau'),
(1314, '7730', 'Leers-Nord'),
(1315, '2811', 'Leest'),
(1316, '9620', 'Leeuwergem'),
(1317, '8432', 'Leffinge'),
(1318, '6860', 'Léglise'),
(1319, '5590', 'Leignon'),
(1320, '8691', 'Leisele'),
(1321, '8600', 'Leke'),
(1322, '1502', 'Lembeek'),
(1323, '9971', 'Lembeke'),
(1324, '9820', 'Lemberge'),
(1325, '8860', 'Lendelede'),
(1326, '7870', 'Lens'),
(1327, '4280', 'Lens-Saint-Remy'),
(1328, '4250', 'Lens-Saint-Servais'),
(1329, '4360', 'Lens-Sur-Geer'),
(1330, '3970', 'Leopoldsburg'),
(1331, '4560', 'Les Avins'),
(1332, '6811', 'Les Bulles'),
(1333, '6830', 'Les Hayons'),
(1334, '4317', 'Les Waleffes'),
(1335, '7621', 'Lesdain'),
(1336, '7860', 'Lessines'),
(1337, '5580', 'Lessive'),
(1338, '6953', 'Lesterny'),
(1339, '5170', 'Lesve'),
(1340, '7850', 'Lettelingen'),
(1341, '9521', 'Letterhoutem'),
(1342, '6500', 'Leugnies'),
(1343, '9700', 'Leupegem'),
(1344, '3630', 'Leut'),
(1345, '3000', 'Leuven'),
(1346, '5310', 'Leuze'),
(1347, '7900', 'Leuze-En-Hainaut'),
(1348, '6500', 'Leval-Chaudeville'),
(1349, '7134', 'Leval-Trahegnies'),
(1350, '6238', 'Liberchies'),
(1351, '6890', 'Libin'),
(1352, '6800', 'Libramont-Chevigny'),
(1353, '2460', 'Lichtaart'),
(1354, '8810', 'Lichtervelde'),
(1355, '1770', 'Liedekerke'),
(1356, '9400', 'Lieferinge'),
(1357, '4000', 'Liège'),
(1358, '4020', 'Liège'),
(1359, '4099', 'Liège X'),
(1360, '2500', 'Lier'),
(1361, '4990', 'Lierneux'),
(1362, '5310', 'Liernu'),
(1363, '4042', 'Liers'),
(1364, '2870', 'Liezele'),
(1365, '7812', 'Ligne'),
(1366, '4254', 'Ligney'),
(1367, '5140', 'Ligny'),
(1368, '2275', 'Lille'),
(1369, '2040', 'Lillo'),
(1370, '1428', 'Lillois-Witterzée'),
(1371, '1300', 'Limal'),
(1372, '4830', 'Limbourg'),
(1373, '1342', 'Limelette'),
(1374, '6670', 'Limerl‚'),
(1375, '4357', 'Limont'),
(1376, '4287', 'Lincent'),
(1377, '3210', 'Linden'),
(1378, '1630', 'Linkebeek'),
(1379, '3560', 'Linkhout'),
(1380, '1357', 'Linsmeau'),
(1381, '2547', 'Lint'),
(1382, '3350', 'Linter'),
(1383, '2890', 'Lippelo'),
(1384, '5501', 'Lisogne'),
(1385, '8380', 'Lissewege'),
(1386, '5101', 'Lives-Sur-Meuse'),
(1387, '4600', 'Lixhe'),
(1388, '8647', 'Lo'),
(1389, '6540', 'Lobbes'),
(1390, '9080', 'Lochristi'),
(1391, '6042', 'Lodelinsart'),
(1392, '2990', 'Loenhout'),
(1393, '8958', 'Loker'),
(1394, '9160', 'Lokeren'),
(1395, '3545', 'Loksbergen'),
(1396, '8434', 'Lombardsijde'),
(1397, '7870', 'Lombise'),
(1398, '3920', 'Lommel'),
(1399, '4783', 'Lommersweiler'),
(1400, '6463', 'Lompret'),
(1401, '6924', 'Lomprez'),
(1402, '4431', 'Loncin'),
(1403, '1840', 'Londerzeel'),
(1404, '5310', 'Longchamps'),
(1405, '6688', 'Longchamps'),
(1406, '6840', 'Longlier'),
(1407, '1325', 'Longueville'),
(1408, '6600', 'Longvilly'),
(1409, '4710', 'Lontzen'),
(1410, '5030', 'Lonzée'),
(1411, '3040', 'Loonbeek'),
(1412, '8210', 'Loppem'),
(1413, '4987', 'Lorc‚'),
(1414, '1651', 'Lot'),
(1415, '9880', 'Lotenhulle'),
(1416, '5575', 'Louette-Saint-Denis'),
(1417, '5575', 'Louette-Saint-Pierre'),
(1418, '1471', 'Loupoigne'),
(1419, '1348', 'Louvain-La-Neuve'),
(1420, '4141', 'Louveign‚'),
(1421, '4920', 'Louveign‚'),
(1422, '9920', 'Lovendegem'),
(1423, '3360', 'Lovenjoel'),
(1424, '6280', 'Loverval'),
(1425, '5101', 'Loyers'),
(1426, '3210', 'Lubbeek'),
(1427, '7700', 'Luingne'),
(1428, '3560', 'Lummen'),
(1429, '5170', 'Lustin'),
(1430, '6238', 'Luttre'),
(1431, '9680', 'Maarke-Kerkem'),
(1432, '3680', 'Maaseik'),
(1433, '3630', 'Maasmechelen'),
(1434, '6663', 'Mabompr‚'),
(1435, '1830', 'Machelen'),
(1436, '9870', 'Machelen'),
(1437, '6591', 'Macon'),
(1438, '6593', 'Macquenoise'),
(1439, '5374', 'Maffe'),
(1440, '7810', 'Maffle'),
(1441, '4623', 'Magn‚e'),
(1442, '5330', 'Maillen'),
(1443, '7812', 'Mainvault'),
(1444, '7020', 'Maisières'),
(1445, '6852', 'Maissin'),
(1446, '5300', 'Maizeret'),
(1447, '3700', 'Mal'),
(1448, '9990', 'Maldegem'),
(1449, '1840', 'Malderen'),
(1450, '6960', 'Malempré'),
(1451, '1360', 'Malèves-Sainte-Marie-Wastinnes'),
(1452, '2390', 'Malle'),
(1453, '4960', 'Malmedy'),
(1454, '5020', 'Malonne'),
(1455, '5575', 'Malvoisin'),
(1456, '7170', 'Manage'),
(1457, '4760', 'Manderfeld'),
(1458, '8433', 'Mannekensvere'),
(1459, '1380', 'Maransart'),
(1460, '1495', 'Marbais'),
(1461, '6120', 'Marbaix'),
(1462, '6900', 'Marche-En-Famenne'),
(1463, '5024', 'Marche-Les-Dames'),
(1464, '7190', 'Marche-Lez-Ecaussinnes'),
(1465, '6030', 'Marchienne-Au-Pont'),
(1466, '4570', 'Marchin'),
(1467, '7387', 'Marchipont'),
(1468, '5380', 'Marchovelette'),
(1469, '6001', 'Marcinelle'),
(1470, '6987', 'Marcourt'),
(1471, '6990', 'Marenne'),
(1472, '9030', 'Mariakerke'),
(1473, '2880', 'Mariekerke'),
(1474, '5660', 'Mariembourg'),
(1475, '1350', 'Marilles'),
(1476, '7850', 'Mark'),
(1477, '8510', 'Marke'),
(1478, '8720', 'Markegem'),
(1479, '4210', 'Marneffe'),
(1480, '7522', 'Marquain'),
(1481, '6630', 'Martelange'),
(1482, '3742', 'Martenslinde'),
(1483, '5573', 'Martouzin-Neuville'),
(1484, '6953', 'Masbourg'),
(1485, '7050', 'Masnuy-Saint-Jean'),
(1486, '7050', 'Masnuy-Saint-Pierre'),
(1487, '9230', 'Massemen'),
(1488, '2240', 'Massenhoven'),
(1489, '5680', 'Matagne-La-Grande'),
(1490, '5680', 'Matagne-La-Petite'),
(1491, '9700', 'Mater'),
(1492, '7640', 'Maubray'),
(1493, '7534', 'Maulde'),
(1494, '7110', 'Maurage'),
(1495, '5670', 'Maz‚e'),
(1496, '1745', 'Mazenzele'),
(1497, '5032', 'Mazy'),
(1498, '5372', 'Méan'),
(1499, '2800', 'Mechelen'),
(1500, '3630', 'Mechelen-Aan-De-Maas'),
(1501, '3870', 'Mechelen-Bovelingen'),
(1502, '4219', 'Meeffe'),
(1503, '3391', 'Meensel-Kiezegem'),
(1504, '2321', 'Meer'),
(1505, '3078', 'Meerbeek'),
(1506, '9402', 'Meerbeke'),
(1507, '9170', 'Meerdonk'),
(1508, '2450', 'Meerhout'),
(1509, '2328', 'Meerle'),
(1510, '3630', 'Meeswijk'),
(1511, '8377', 'Meetkerke'),
(1512, '3670', 'Meeuwen'),
(1513, '5310', 'Mehaigne'),
(1514, '9800', 'Meigem'),
(1515, '9630', 'Meilegem'),
(1516, '1860', 'Meise'),
(1517, '6769', 'Meix-Devant-Virton'),
(1518, '6747', 'Meix-Le-Tige'),
(1519, '9700', 'Melden'),
(1520, '3320', 'Meldert'),
(1521, '3560', 'Meldert'),
(1522, '9310', 'Meldert'),
(1523, '4633', 'Melen'),
(1524, '1370', 'Mélin'),
(1525, '3350', 'Melkwezer'),
(1526, '9090', 'Melle'),
(1527, '1495', 'Mellery'),
(1528, '7540', 'Melles'),
(1529, '6211', 'Mellet'),
(1530, '6860', 'Mellier'),
(1531, '1820', 'Melsbroek'),
(1532, '9120', 'Melsele'),
(1533, '9820', 'Melsen'),
(1534, '4837', 'Membach'),
(1535, '5550', 'Membre'),
(1536, '3770', 'Membruggen'),
(1537, '9042', 'Mendonk'),
(1538, '8930', 'Menen'),
(1539, '6567', 'Merbes-Le-Chƒteau'),
(1540, '6567', 'Merbes-Sainte-Marie'),
(1541, '1785', 'Merchtem'),
(1542, '4280', 'Merdorp'),
(1543, '9420', 'Mere'),
(1544, '9820', 'Merelbeke'),
(1545, '9850', 'Merendree'),
(1546, '8650', 'Merkem'),
(1547, '2170', 'Merksem'),
(1548, '2330', 'Merksplas'),
(1549, '5600', 'Merlemont'),
(1550, '8957', 'Mesen'),
(1551, '7822', 'Meslin-L\'Evêque'),
(1552, '5560', 'Mesnil-Eglise'),
(1553, '5560', 'Mesnil-Saint-Blaise'),
(1554, '9200', 'Mespelare'),
(1555, '6780', 'Messancy'),
(1556, '3272', 'Messelbroek'),
(1557, '7022', 'Mesvin'),
(1558, '3870', 'Mettekoven'),
(1559, '5640', 'Mettet'),
(1560, '8760', 'Meulebeke'),
(1561, '5081', 'Meux'),
(1562, '7942', 'Mévergnies-Lez-Lens'),
(1563, '4770', 'Meyerode'),
(1564, '9660', 'Michelbeke'),
(1565, '4630', 'Micheroux'),
(1566, '9992', 'Middelburg'),
(1567, '8430', 'Middelkerke'),
(1568, '5376', 'Miécret'),
(1569, '3891', 'Mielen-Boven-Aalst'),
(1570, '7070', 'Mignault'),
(1571, '3770', 'Millen'),
(1572, '4041', 'Milmort'),
(1573, '2322', 'Minderhout'),
(1574, '1035', 'Ministerie van het Brussels Hoofdstedelijk Gewest'),
(1575, '6870', 'Mirwart'),
(1576, '4577', 'Modave'),
(1577, '3790', 'Moelingen'),
(1578, '8552', 'Moen'),
(1579, '9500', 'Moerbeke'),
(1580, '9180', 'Moerbeke-Waas'),
(1581, '8470', 'Moere'),
(1582, '8340', 'Moerkerke'),
(1583, '9220', 'Moerzeke'),
(1584, '7700', 'Moeskroen'),
(1585, '4520', 'Moha'),
(1586, '5361', 'Mohiville'),
(1587, '5060', 'Moignel‚e'),
(1588, '6800', 'Moircy'),
(1589, '2400', 'Mol'),
(1590, '7760', 'Molenbaix'),
(1591, '3461', 'Molenbeek-Wersbeek'),
(1592, '3640', 'Molenbeersel'),
(1593, '3294', 'Molenstede'),
(1594, '1730', 'Mollem'),
(1595, '4350', 'Momalle'),
(1596, '6590', 'Momignies'),
(1597, '5555', 'Monceau-En-Ardenne'),
(1598, '6592', 'Monceau-Imbrechies'),
(1599, '6031', 'Monceau-Sur-Sambre'),
(1600, '7000', 'Mons'),
(1601, '4400', 'Mons-Lez-Liège'),
(1602, '1400', 'Monstreux'),
(1603, '5530', 'Mont'),
(1604, '6661', 'Mont'),
(1605, '5580', 'Mont-Gauthier'),
(1606, '1367', 'Mont-Saint-André'),
(1607, '7542', 'Mont-Saint-Aubert'),
(1608, '1435', 'Mont-Saint-Guibert'),
(1609, '7141', 'Mont-Sainte-Aldegonde'),
(1610, '6540', 'Mont-Sainte-Geneviève'),
(1611, '6032', 'Mont-Sur-Marchienne'),
(1612, '6470', 'Montbliart'),
(1613, '4420', 'Montegnée'),
(1614, '3890', 'Montenaken'),
(1615, '7870', 'Montignies-Lez-Lens'),
(1616, '6560', 'Montignies-Saint-Christophe'),
(1617, '7387', 'Montignies-Sur-Roc'),
(1618, '6061', 'Montignies-Sur-Sambre'),
(1619, '6110', 'Montigny-Le-Tilleul'),
(1620, '6674', 'Montleban'),
(1621, '7911', 'Montroeul-Au-Bois'),
(1622, '7350', 'Montroeul-Sur-Haine'),
(1623, '4850', 'Montzen'),
(1624, '9310', 'Moorsel'),
(1625, '8560', 'Moorsele'),
(1626, '8890', 'Moorslede'),
(1627, '9860', 'Moortsele'),
(1628, '3740', 'Mopertingen'),
(1629, '9790', 'Moregem'),
(1630, '4850', 'Moresnet'),
(1631, '6640', 'Morhet'),
(1632, '5621', 'Morialm‚'),
(1633, '2200', 'Morkhoven'),
(1634, '7140', 'Morlanwelz-Mariemont'),
(1635, '6997', 'Mormont'),
(1636, '5190', 'Mornimont'),
(1637, '4670', 'Mortier'),
(1638, '4607', 'Mortroux'),
(1639, '2640', 'Mortsel'),
(1640, '5620', 'Morville'),
(1641, '7812', 'Moulbaix'),
(1642, '7543', 'Mourcourt'),
(1643, '7911', 'Moustier'),
(1644, '5190', 'Moustier-Sur-Sambre'),
(1645, '5550', 'Mouzaive'),
(1646, '4280', 'Moxhe'),
(1647, '5340', 'Mozet'),
(1648, '2812', 'Muizen'),
(1649, '3891', 'Muizen'),
(1650, '9700', 'Mullem'),
(1651, '9630', 'Munkzwalm'),
(1652, '6820', 'Muno'),
(1653, '3740', 'Munsterbilzen'),
(1654, '9820', 'Munte'),
(1655, '6750', 'Musson'),
(1656, '6750', 'Mussy-La-Ville'),
(1657, '4190', 'My'),
(1658, '7062', 'Naast'),
(1659, '6660', 'Nadrin'),
(1660, '5550', 'Nafraiture'),
(1661, '6120', 'Nalinnes'),
(1662, '5300', 'Namˆche'),
(1663, '5000', 'Namur'),
(1664, '4550', 'Nandrin'),
(1665, '5100', 'Naninne'),
(1666, '5555', 'Naom‚'),
(1667, '6950', 'Nassogne'),
(1668, '1110', 'NATO'),
(1669, '5360', 'Natoye'),
(1670, '9810', 'Nazareth'),
(1671, '7730', 'Néchin'),
(1672, '1120', 'Neder-Over-Heembeek'),
(1673, '9500', 'Nederboelare'),
(1674, '9660', 'Nederbrakel'),
(1675, '9700', 'Nederename'),
(1676, '9400', 'Nederhasselt'),
(1677, '1910', 'Nederokkerzeel'),
(1678, '9636', 'Nederzwalm-Hermelgem'),
(1679, '3670', 'Neerglabbeek'),
(1680, '3620', 'Neerharen'),
(1681, '3350', 'Neerhespen'),
(1682, '1357', 'Neerheylissem'),
(1683, '3040', 'Neerijse'),
(1684, '3404', 'Neerlanden'),
(1685, '3350', 'Neerlinter'),
(1686, '3680', 'Neeroeteren'),
(1687, '3910', 'Neerpelt'),
(1688, '3700', 'Neerrepen'),
(1689, '3370', 'Neervelp'),
(1690, '7784', 'Neerwaasten'),
(1691, '3400', 'Neerwinden'),
(1692, '9403', 'Neigem'),
(1693, '3700', 'Nerem'),
(1694, '4870', 'Nessonvaux'),
(1695, '1390', 'Nethen'),
(1696, '5377', 'Nettinne'),
(1697, '4721', 'Neu-Moresnet'),
(1698, '4608', 'Neufchâteau'),
(1699, '6840', 'Neufchâteau'),
(1700, '7332', 'Neufmaison'),
(1701, '7063', 'Neufvilles'),
(1702, '5600', 'Neuville'),
(1703, '4121', 'Neuville-En-Condroz'),
(1704, '9850', 'Nevele'),
(1705, '2845', 'Niel'),
(1706, '3668', 'Niel-Bij-As'),
(1707, '3890', 'Niel-Bij-Sint-Truiden'),
(1708, '9506', 'Nieuwenhove'),
(1709, '1880', 'Nieuwenrode'),
(1710, '3850', 'Nieuwerkerken'),
(1711, '9320', 'Nieuwerkerken'),
(1712, '8600', 'Nieuwkapelle'),
(1713, '8950', 'Nieuwkerke'),
(1714, '9100', 'Nieuwkerken-Waas'),
(1715, '8377', 'Nieuwmunster'),
(1716, '8620', 'Nieuwpoort'),
(1717, '3221', 'Nieuwrode'),
(1718, '2560', 'Nijlen'),
(1719, '1457', 'Nil-Saint-Vincent-Saint-Martin'),
(1720, '7020', 'Nimy'),
(1721, '9400', 'Ninove'),
(1722, '5670', 'Nismes'),
(1723, '1400', 'Nivelles'),
(1724, '5680', 'Niverlée'),
(1725, '6640', 'Nives'),
(1726, '6717', 'Nobressart'),
(1727, '1320', 'Nodebais'),
(1728, '1350', 'Noduwez'),
(1729, '7080', 'Noirchain'),
(1730, '6831', 'Noirfontaine'),
(1731, '5377', 'Noiseux'),
(1732, '9771', 'Nokere'),
(1733, '6851', 'Nollevaux'),
(1734, '2200', 'Noorderwijk'),
(1735, '8647', 'Noordschote'),
(1736, '1930', 'Nossegem'),
(1737, '6717', 'Nothomb'),
(1738, '7022', 'Nouvelles'),
(1739, '4347', 'Noville'),
(1740, '6600', 'Noville'),
(1741, '5380', 'Noville-Les-Bois'),
(1742, '5310', 'Noville-Sur-Mehaigne'),
(1743, '9681', 'Nukerke'),
(1744, '6230', 'Obaix'),
(1745, '7743', 'Obigies'),
(1746, '7034', 'Obourg'),
(1747, '6890', 'Ochamps'),
(1748, '4560', 'Ocquier'),
(1749, '6960', 'Odeigne'),
(1750, '4367', 'Odeur'),
(1751, '8730', 'Oedelem'),
(1752, '8800', 'Oekene'),
(1753, '2520', 'Oelegem'),
(1754, '8690', 'Oeren'),
(1755, '8720', 'Oeselgem'),
(1756, '1755', 'Oetingen'),
(1757, '7911', 'Oeudeghien'),
(1758, '2260', 'Oevel'),
(1759, '6850', 'Offagne'),
(1760, '1934', 'Office Exchange Brussels Airport Remailing'),
(1761, '7862', 'Ogy'),
(1762, '1380', 'Ohain'),
(1763, '5350', 'Ohey'),
(1764, '5670', 'Oignies-En-Thiérache'),
(1765, '1480', 'Oisquercq'),
(1766, '5555', 'Oizy'),
(1767, '9400', 'Okegem'),
(1768, '2250', 'Olen'),
(1769, '4300', 'Oleye'),
(1770, '7866', 'Ollignies'),
(1771, '5670', 'Olloy-Sur-Viroin'),
(1772, '2491', 'Olmen'),
(1773, '4877', 'Olne'),
(1774, '9870', 'Olsene'),
(1775, '4252', 'Omal'),
(1776, '4540', 'Ombret'),
(1777, '5600', 'Omez‚e'),
(1778, '6900', 'On'),
(1779, '5520', 'Onhaye'),
(1780, '9500', 'Onkerzele'),
(1781, '7387', 'Onnezies'),
(1782, '5190', 'Onoz'),
(1783, '1760', 'Onze-Lieve-Vrouw-Lombeek'),
(1784, '2861', 'Onze-Lieve-Vrouw-Waver'),
(1785, '8710', 'Ooigem'),
(1786, '9700', 'Ooike'),
(1787, '9790', 'Ooike'),
(1788, '9520', 'Oombergen'),
(1789, '9620', 'Oombergen'),
(1790, '3300', 'Oorbeek'),
(1791, '9340', 'Oordegem'),
(1792, '9041', 'Oostakker'),
(1793, '8670', 'Oostduinkerke'),
(1794, '9968', 'Oosteeklo'),
(1795, '8400', 'Oostende'),
(1796, '9860', 'Oosterzele'),
(1797, '3945', 'Oostham'),
(1798, '8020', 'Oostkamp'),
(1799, '8340', 'Oostkerke'),
(1800, '8600', 'Oostkerke'),
(1801, '2390', 'Oostmalle'),
(1802, '8840', 'Oostnieuwkerke'),
(1803, '8780', 'Oostrozebeke'),
(1804, '8640', 'Oostvleteren'),
(1805, '9931', 'Oostwinkel'),
(1806, '9660', 'Opbrakel'),
(1807, '9255', 'Opdorp'),
(1808, '3660', 'Opglabbeek'),
(1809, '3630', 'Opgrimbie'),
(1810, '1421', 'Ophain-Bois-Seigneur-Isaac'),
(1811, '9500', 'Ophasselt'),
(1812, '3870', 'Opheers'),
(1813, '1357', 'Opheylissem'),
(1814, '3640', 'Ophoven'),
(1815, '3960', 'Opitter'),
(1816, '3300', 'Oplinter'),
(1817, '3680', 'Opoeteren'),
(1818, '6852', 'Opont'),
(1819, '1315', 'Opprebais'),
(1820, '2890', 'Oppuurs'),
(1821, '3360', 'Opvelp'),
(1822, '1745', 'Opwijk'),
(1823, '1360', 'Orbais'),
(1824, '5550', 'Orchimont'),
(1825, '7501', 'Orcq'),
(1826, '3800', 'Ordingen'),
(1827, '5640', 'Oret'),
(1828, '4360', 'Oreye'),
(1829, '6880', 'Orgeo'),
(1830, '7802', 'Ormeignies'),
(1831, '1350', 'Orp-Le-Grand'),
(1832, '7750', 'Orroir'),
(1833, '3350', 'Orsmaal-Gussenhoven'),
(1834, '6983', 'Ortho'),
(1835, '7804', 'Ostiches'),
(1836, '8553', 'Otegem'),
(1837, '4210', 'Oteppe'),
(1838, '4340', 'Othée'),
(1839, '4360', 'Otrange'),
(1840, '3040', 'Ottenburg'),
(1841, '9420', 'Ottergem'),
(1842, '1340', 'Ottignies'),
(1843, '3050', 'Oud-Heverlee'),
(1844, '2360', 'Oud-Turnhout'),
(1845, '9200', 'Oudegem'),
(1846, '8600', 'Oudekapelle'),
(1847, '9700', 'Oudenaarde'),
(1848, '1600', 'Oudenaken'),
(1849, '8460', 'Oudenburg'),
(1850, '1160', 'Oudergem'),
(1851, '4590', 'Ouffet'),
(1852, '4102', 'Ougrée'),
(1853, '4680', 'Oupeye'),
(1854, '9406', 'Outer'),
(1855, '3321', 'Outgaarden'),
(1856, '4577', 'Outrelouxhe'),
(1857, '8582', 'Outrijve'),
(1858, '9750', 'Ouwegem'),
(1859, '9500', 'Overboelare'),
(1860, '3350', 'Overhespen'),
(1861, '3090', 'Overijse'),
(1862, '9290', 'Overmere'),
(1863, '3900', 'Overpelt'),
(1864, '3700', 'Overrepen'),
(1865, '3400', 'Overwinden'),
(1866, '3583', 'Paal'),
(1867, '4452', 'Paifve'),
(1868, '4560', 'Pailhe'),
(1869, '6850', 'Paliseul'),
(1870, '1760', 'Pamel'),
(1871, '7861', 'Papignies'),
(1872, '9661', 'Parike'),
(1873, '1012', 'Parlement de la communaut‚ française'),
(1874, '5012', 'Parlement Wallon'),
(1875, '8980', 'Passendale'),
(1876, '5575', 'Patignies'),
(1877, '7340', 'Pâturages'),
(1878, '9630', 'Paulatem'),
(1879, '7740', 'Pecq'),
(1880, '3990', 'Peer'),
(1881, '7120', 'Peissant'),
(1882, '4287', 'Pellaines'),
(1883, '3212', 'Pellenberg'),
(1884, '1670', 'Pepingen'),
(1885, '4860', 'Pepinster'),
(1886, '1820', 'Perk'),
(1887, '7640', 'Péronnes-Lez-Antoing'),
(1888, '7134', 'Péronnes-Lez-Binche'),
(1889, '7600', 'Péruwelz'),
(1890, '8600', 'Pervijze'),
(1891, '1360', 'Perwez'),
(1892, '5352', 'Perwez-Haillot'),
(1893, '5660', 'Pesche'),
(1894, '5590', 'Pessoux'),
(1895, '9800', 'Petegem-Aan-De-Leie'),
(1896, '9790', 'Petegem-Aan-De-Schelde');
INSERT INTO `plaatsen` (`plaatsId`, `postcode`, `plaats`) VALUES
(1897, '5660', 'Pétigny'),
(1898, '5555', 'Petit-Fays'),
(1899, '4280', 'Petit-Hallet'),
(1900, '4800', 'Petit-Rechain'),
(1901, '7090', 'Petit-Roeulx-Lez-Braine'),
(1902, '7181', 'Petit-Roeulx-Lez-Nivelles'),
(1903, '6692', 'Petit-Thier'),
(1904, '5660', 'Petite-Chapelle'),
(1905, '1800', 'Peutie'),
(1906, '5600', 'Philippeville'),
(1907, '7160', 'Piéton'),
(1908, '1370', 'Piétrain'),
(1909, '1315', 'Piétrebais'),
(1910, '7904', 'Pipaix'),
(1911, '3700', 'Piringen'),
(1912, '6240', 'Pironchamps'),
(1913, '8740', 'Pittem'),
(1914, '4122', 'Plainevaux'),
(1915, '1380', 'Plancenoit'),
(1916, '7782', 'Ploegsteert'),
(1917, '2275', 'Poederlee'),
(1918, '9880', 'Poeke'),
(1919, '8920', 'Poelkapelle'),
(1920, '9850', 'Poesele'),
(1921, '9401', 'Pollare'),
(1922, '4800', 'Polleur'),
(1923, '4910', 'Polleur'),
(1924, '8647', 'Pollinkhove'),
(1925, '7322', 'Pommeroeul'),
(1926, '5574', 'Pondrôme'),
(1927, '6230', 'Pont-À-Celles'),
(1928, '6250', 'Pont-De-Loup'),
(1929, '5380', 'Pontillas'),
(1930, '8970', 'Poperinge'),
(1931, '2382', 'Poppel'),
(1932, '7760', 'Popuelles'),
(1933, '5370', 'Porcheresse'),
(1934, '6929', 'Porcheresse'),
(1935, '1100', 'Postcheque'),
(1936, '7760', 'Pottes'),
(1937, '4280', 'Poucet'),
(1938, '4171', 'Poulseur'),
(1939, '6830', 'Poupehan'),
(1940, '4350', 'Pousset'),
(1941, '5660', 'Presgaux'),
(1942, '6250', 'Presles'),
(1943, '5170', 'Profondeville'),
(1944, '8972', 'Proven'),
(1945, '5650', 'Pry'),
(1946, '2242', 'Pulderbos'),
(1947, '2243', 'Pulle'),
(1948, '5530', 'Purnode'),
(1949, '5550', 'Pussemange'),
(1950, '2580', 'Putte'),
(1951, '2870', 'Puurs'),
(1952, '7390', 'Quaregnon'),
(1953, '7540', 'Quartes'),
(1954, '1430', 'Quenast'),
(1955, '4610', 'Queue-Du-Bois'),
(1956, '7972', 'Quevaucamps'),
(1957, '7040', 'Quévy-Le-Grand'),
(1958, '7040', 'Quévy-Le-Petit'),
(1959, '7380', 'Quiévrain'),
(1960, '1006', 'Raad van de Vlaamse Gemeenschapscommissie'),
(1961, '6792', 'Rachecourt'),
(1962, '4287', 'Racour'),
(1963, '4730', 'Raeren'),
(1964, '6532', 'Ragnies'),
(1965, '4987', 'Rahier'),
(1966, '7971', 'Ramegnies'),
(1967, '7520', 'Ramegnies-Chin'),
(1968, '4557', 'Ramelot'),
(1969, '1367', 'Ramillies'),
(1970, '1880', 'Ramsdonk'),
(1971, '2230', 'Ramsel'),
(1972, '8301', 'Ramskapelle'),
(1973, '8620', 'Ramskapelle'),
(1974, '6470', 'Rance'),
(1975, '6043', 'Ransart'),
(1976, '3470', 'Ransberg'),
(1977, '2520', 'Ranst'),
(1978, '2380', 'Ravels'),
(1979, '7804', 'Rebaix'),
(1980, '1430', 'Rebecq-Rognon'),
(1981, '4780', 'Recht'),
(1982, '6800', 'Recogne'),
(1983, '6890', 'Redu'),
(1984, '2840', 'Reet'),
(1985, '3621', 'Rekem'),
(1986, '8930', 'Rekkem'),
(1987, '1731', 'Relegem'),
(1988, '6800', 'Remagne'),
(1989, '3791', 'Remersdaal'),
(1990, '4350', 'Remicourt'),
(1991, '6987', 'Rendeux'),
(1992, '8647', 'Reninge'),
(1993, '8970', 'Reningelst'),
(1994, '6500', 'Renlies'),
(1995, '3950', 'Reppel'),
(1996, '7134', 'Ressaix'),
(1997, '9551', 'Ressegem'),
(1998, '6927', 'Resteigne'),
(1999, '2470', 'Retie'),
(2000, '4621', 'Retinne'),
(2001, '4790', 'Reuland'),
(2002, '6210', 'Rèves'),
(2003, '5080', 'Rhisnes'),
(2004, '4600', 'Richelle'),
(2005, '3770', 'Riemst'),
(2006, '5575', 'Rienne'),
(2007, '6464', 'Rièzes'),
(2008, '3840', 'Rijkel'),
(2009, '2310', 'Rijkevorsel'),
(2010, '3740', 'Rijkhoven'),
(2011, '2820', 'Rijmenam'),
(2012, '3700', 'Riksingen'),
(2013, '3202', 'Rillaar'),
(2014, '5170', 'Rivière'),
(2015, '1330', 'Rixensart'),
(2016, '6460', 'Robechies'),
(2017, '6769', 'Robelmont'),
(2018, '4950', 'Robertville'),
(2019, '9630', 'Roborst'),
(2020, '5580', 'Rochefort'),
(2021, '6830', 'Rochehaut'),
(2022, '4761', 'Rocherath'),
(2023, '4690', 'Roclenge-Sur-Geer'),
(2024, '4000', 'Rocourt'),
(2025, '8972', 'Roesbrugge-Haringe'),
(2026, '8800', 'Roeselare'),
(2027, '5651', 'Rognée'),
(2028, '7387', 'Roisin'),
(2029, '8460', 'Roksem'),
(2030, '8510', 'Rollegem'),
(2031, '8880', 'Rollegem-Kapelle'),
(2032, '4347', 'Roloux'),
(2033, '5600', 'Roly'),
(2034, '5600', 'Romedenne'),
(2035, '5680', 'Romerée'),
(2036, '3730', 'Romershoven'),
(2037, '4624', 'Romsée'),
(2038, '7623', 'Rongy'),
(2039, '7090', 'Ronquières'),
(2040, '9600', 'Ronse'),
(2041, '9932', 'Ronsele'),
(2042, '3370', 'Roosbeek'),
(2043, '1760', 'Roosdaal'),
(2044, '5620', 'Rosée'),
(2045, '6250', 'Roselies'),
(2046, '1331', 'Rosières'),
(2047, '3740', 'Rosmeer'),
(2048, '4257', 'Rosoux-Crenwick'),
(2049, '6730', 'Rossignol'),
(2050, '3650', 'Rotem'),
(2051, '4120', 'Rotheux-Rimière'),
(2052, '3110', 'Rotselaar'),
(2053, '7601', 'Roucourt'),
(2054, '7120', 'Rouveroy'),
(2055, '4140', 'Rouvreux'),
(2056, '6044', 'Roux'),
(2057, '1315', 'Roux-Miroir'),
(2058, '6900', 'Roy'),
(2059, '9630', 'Rozebeke'),
(2060, '1044', 'RTBF'),
(2061, '1033', 'RTL-TVI'),
(2062, '8020', 'Ruddervoorde'),
(2063, '6760', 'Ruette'),
(2064, '9690', 'Ruien'),
(2065, '1601', 'Ruisbroek'),
(2066, '2870', 'Ruisbroek'),
(2067, '8755', 'Ruiselede'),
(2068, '3870', 'Rukkelingen-Loon'),
(2069, '6724', 'Rulles'),
(2070, '8800', 'Rumbeke'),
(2071, '7610', 'Rumes'),
(2072, '7540', 'Rumillies'),
(2073, '3454', 'Rummen'),
(2074, '3400', 'Rumsdorp'),
(2075, '2840', 'Rumst'),
(2076, '3803', 'Runkelen'),
(2077, '9150', 'Rupelmonde'),
(2078, '7750', 'Russeignies'),
(2079, '3700', 'Rutten'),
(2080, '3798', 'S Gravenvoeren'),
(2081, '5010', 'SA SudPresse'),
(2082, '6221', 'Saint-Amand'),
(2083, '4606', 'Saint-Andr‚'),
(2084, '5620', 'Saint-Aubin'),
(2085, '7034', 'Saint-Denis'),
(2086, '5081', 'Saint-Denis-Bovesse'),
(2087, '4470', 'Saint-Georges-Sur-Meuse'),
(2088, '5640', 'Saint-Gérard'),
(2089, '5310', 'Saint-Germain'),
(2090, '1450', 'Saint-Géry'),
(2091, '7330', 'Saint-Ghislain'),
(2092, '6870', 'Saint-Hubert'),
(2093, '1370', 'Saint-Jean-Geest'),
(2094, '6747', 'Saint-Léger'),
(2095, '7730', 'Saint-Léger'),
(2096, '5003', 'Saint-Marc'),
(2097, '6762', 'Saint-Mard'),
(2098, '5190', 'Saint-Martin'),
(2099, '7500', 'Saint-Maur'),
(2100, '6887', 'Saint-Médard'),
(2101, '4420', 'Saint-Nicolas'),
(2102, '6800', 'Saint-Pierre'),
(2103, '4672', 'Saint-Remy'),
(2104, '6460', 'Saint-Remy'),
(2105, '1370', 'Saint-Remy-Geest'),
(2106, '7912', 'Saint-Sauveur'),
(2107, '5002', 'Saint-Servais'),
(2108, '4550', 'Saint-Séverin'),
(2109, '7030', 'Saint-Symphorien'),
(2110, '7100', 'Saint-Vaast'),
(2111, '6730', 'Saint-Vincent'),
(2112, '6820', 'Sainte-Cécile'),
(2113, '6800', 'Sainte-Marie-Chevigny'),
(2114, '6740', 'Sainte-Marie-Sur-Semois'),
(2115, '1480', 'Saintes'),
(2116, '4671', 'Saive'),
(2117, '6460', 'Salles'),
(2118, '5600', 'Samart'),
(2119, '6982', 'Samrée'),
(2120, '4780', 'Sankt-Vith'),
(2121, '7080', 'Sars-La-Bruyère'),
(2122, '6542', 'Sars-La-Buissière'),
(2123, '5330', 'Sart-Bernard'),
(2124, '5575', 'Sart-Custinne'),
(2125, '1495', 'Sart-Dames-Avelines'),
(2126, '5600', 'Sart-En-Fagne'),
(2127, '5070', 'Sart-Eustache'),
(2128, '4845', 'Sart-Lez-Spa'),
(2129, '5070', 'Sart-Saint-Laurent'),
(2130, '6470', 'Sautin'),
(2131, '5600', 'Sautour'),
(2132, '5030', 'Sauvenière'),
(2133, '1101', 'Scanning'),
(2134, '1030', 'Schaarbeek'),
(2135, '3290', 'Schaffen'),
(2136, '3732', 'Schalkhoven'),
(2137, '5364', 'Schaltin'),
(2138, '9820', 'Schelderode'),
(2139, '9860', 'Scheldewindeke'),
(2140, '2627', 'Schelle'),
(2141, '9260', 'Schellebelle'),
(2142, '9506', 'Schendelbeke'),
(2143, '1703', 'Schepdaal'),
(2144, '3270', 'Scherpenheuvel'),
(2145, '2970', 'Schilde'),
(2146, '9200', 'Schoonaarde'),
(2147, '8433', 'Schore'),
(2148, '9688', 'Schorisse'),
(2149, '2900', 'Schoten'),
(2150, '2223', 'Schriek'),
(2151, '8700', 'Schuiferskapelle'),
(2152, '3540', 'Schulen'),
(2153, '4782', 'Schönberg'),
(2154, '5300', 'Sclayn'),
(2155, '5361', 'Scy'),
(2156, '5300', 'Seilles'),
(2157, '6781', 'Sélange'),
(2158, '6596', 'Seloignes'),
(2159, '9890', 'Semmerzake'),
(2160, '7180', 'Seneffe'),
(2161, '6832', 'Sensenruth'),
(2162, '4557', 'Seny'),
(2163, '5630', 'Senzeilles'),
(2164, '6940', 'Septon'),
(2165, '4100', 'Seraing'),
(2166, '4537', 'Seraing-Le-Chƒteau'),
(2167, '5590', 'Serinchamps'),
(2168, '9260', 'Serskamp'),
(2169, '5521', 'Serville'),
(2170, '7010', 'SHAPE'),
(2171, '6640', 'Sibret'),
(2172, '6750', 'Signeulx'),
(2173, '8340', 'Sijsele'),
(2174, '5630', 'Silenrieux'),
(2175, '7830', 'Silly'),
(2176, '9112', 'Sinaai-Waas'),
(2177, '5377', 'Sinsin'),
(2178, '1082', 'Sint-Agatha-Berchem'),
(2179, '3040', 'Sint-Agatha-Rode'),
(2180, '2890', 'Sint-Amands'),
(2181, '9040', 'Sint-Amandsberg'),
(2182, '8200', 'Sint-Andries'),
(2183, '9550', 'Sint-Antelinks'),
(2184, '8710', 'Sint-Baafs-Vijve'),
(2185, '9630', 'Sint-Blasius-Boekel'),
(2186, '8554', 'Sint-Denijs'),
(2187, '9630', 'Sint-Denijs-Boekel'),
(2188, '9051', 'Sint-Denijs-Westrem'),
(2189, '8793', 'Sint-Eloois-Vijve'),
(2190, '8880', 'Sint-Eloois-Winkel'),
(2191, '1640', 'Sint-Genesius-Rode'),
(2192, '1060', 'Sint-Gillis'),
(2193, '9200', 'Sint-Gillis-Dendermonde'),
(2194, '9170', 'Sint-Gillis-Waas'),
(2195, '9620', 'Sint-Goriks-Oudenhove'),
(2196, '3730', 'Sint-Huibrechts-Hern'),
(2197, '3910', 'Sint-Huibrechts-Lille'),
(2198, '8600', 'Sint-Jacobs-Kapelle'),
(2199, '8900', 'Sint-Jan'),
(2200, '9982', 'Sint-Jan-In-Eremo'),
(2201, '1080', 'Sint-Jans-Molenbeek'),
(2202, '2960', 'Sint-Job-In-\'T-Goor'),
(2203, '1210', 'Sint-Joost-Ten-Noode'),
(2204, '8620', 'Sint-Joris'),
(2205, '8730', 'Sint-Joris'),
(2206, '3051', 'Sint-Joris-Weert'),
(2207, '3390', 'Sint-Joris-Winge'),
(2208, '2860', 'Sint-Katelijne-Waver'),
(2209, '1742', 'Sint-Katherina-Lombeek'),
(2210, '9667', 'Sint-Kornelis-Horebeke'),
(2211, '8310', 'Sint-Kruis'),
(2212, '9042', 'Sint-Kruis-Winkel'),
(2213, '1750', 'Sint-Kwintens-Lennik'),
(2214, '3500', 'Sint-Lambrechts-Herk'),
(2215, '1200', 'Sint-Lambrechts-Woluwe'),
(2216, '9980', 'Sint-Laureins'),
(2217, '1600', 'Sint-Laureins-Berchem'),
(2218, '2960', 'Sint-Lenaarts'),
(2219, '9550', 'Sint-Lievens-Esse'),
(2220, '9520', 'Sint-Lievens-Houtem'),
(2221, '9981', 'Sint-Margriete'),
(2222, '3300', 'Sint-Margriete-Houtem'),
(2223, '3470', 'Sint-Margriete-Houtem'),
(2224, '9667', 'Sint-Maria-Horebeke'),
(2225, '9630', 'Sint-Maria-Latem'),
(2226, '9570', 'Sint-Maria-Lierde'),
(2227, '9620', 'Sint-Maria-Oudenhove'),
(2228, '9660', 'Sint-Maria-Oudenhove'),
(2229, '1700', 'Sint-Martens-Bodegem'),
(2230, '9830', 'Sint-Martens-Latem'),
(2231, '9800', 'Sint-Martens-Leerne'),
(2232, '1750', 'Sint-Martens-Lennik'),
(2233, '9572', 'Sint-Martens-Lierde'),
(2234, '3790', 'Sint-Martens-Voeren'),
(2235, '8200', 'Sint-Michiels'),
(2236, '9100', 'Sint-Niklaas'),
(2237, '9170', 'Sint-Pauwels'),
(2238, '1541', 'Sint-Pieters-Kapelle'),
(2239, '8433', 'Sint-Pieters-Kapelle'),
(2240, '1600', 'Sint-Pieters-Leeuw'),
(2241, '3220', 'Sint-Pieters-Rode'),
(2242, '3792', 'Sint-Pieters-Voeren'),
(2243, '1150', 'Sint-Pieters-Woluwe'),
(2244, '8690', 'Sint-Rijkers'),
(2245, '1932', 'Sint-Stevens-Woluwe'),
(2246, '3800', 'Sint-Truiden'),
(2247, '1700', 'Sint-Ulriks-Kapelle'),
(2248, '0612', 'Sinterklaas'),
(2249, '4851', 'Sippenaeken'),
(2250, '7332', 'Sirault'),
(2251, '6470', 'Sivry'),
(2252, '9940', 'Sleidinge'),
(2253, '8433', 'Slijpe'),
(2254, '4450', 'Slins'),
(2255, '3700', 'Sluizen'),
(2256, '9506', 'Smeerebbe-Vloerzegem'),
(2257, '9340', 'Smetlede'),
(2258, '6890', 'Smuid'),
(2259, '8470', 'Snaaskerke'),
(2260, '8490', 'Snellegem'),
(2261, '4557', 'Soheit-Tinlot'),
(2262, '6920', 'Sohier'),
(2263, '7060', 'Soignies'),
(2264, '4861', 'Soiron'),
(2265, '6500', 'Solre-Saint-Géry'),
(2266, '6560', 'Solre-Sur-Sambre'),
(2267, '5140', 'Sombreffe'),
(2268, '5377', 'Somme-Leuze'),
(2269, '6769', 'Sommethonne'),
(2270, '5523', 'Sommière'),
(2271, '5651', 'Somzée'),
(2272, '5340', 'Sorée'),
(2273, '5333', 'Sorinne-La-Longue'),
(2274, '5503', 'Sorinnes'),
(2275, '5537', 'Sosoye'),
(2276, '4920', 'Sougn‚-Remouchamps'),
(2277, '5680', 'Soulme'),
(2278, '4630', 'Soumagne'),
(2279, '5630', 'Soumoy'),
(2280, '4950', 'Sourbrodt'),
(2281, '6182', 'Souvret'),
(2282, '5590', 'Sovet'),
(2283, '6997', 'Soy'),
(2284, '5150', 'Soye'),
(2285, '4900', 'Spa'),
(2286, '3510', 'Spalbeek'),
(2287, '7032', 'Spiennes'),
(2288, '8587', 'Spiere'),
(2289, '5530', 'Spontin'),
(2290, '4140', 'Sprimont'),
(2291, '5190', 'Spy'),
(2292, '2940', 'Stabroek'),
(2293, '8840', 'Staden'),
(2294, '8490', 'Stalhille'),
(2295, '7973', 'Stambruges'),
(2296, '5646', 'Stave'),
(2297, '8691', 'Stavele'),
(2298, '4970', 'Stavelot'),
(2299, '9140', 'Steendorp'),
(2300, '1840', 'Steenhuffel'),
(2301, '9550', 'Steenhuize-Wijnhuize'),
(2302, '8630', 'Steenkerke'),
(2303, '7090', 'Steenkerque'),
(2304, '1820', 'Steenokkerzeel'),
(2305, '9190', 'Stekene'),
(2306, '4801', 'Stembert'),
(2307, '8400', 'Stene'),
(2308, '1933', 'Sterrebeek'),
(2309, '3512', 'Stevoort'),
(2310, '3650', 'Stokkem'),
(2311, '3511', 'Stokrooie'),
(2312, '4987', 'Stoumont'),
(2313, '6887', 'Straimont'),
(2314, '6511', 'Strée'),
(2315, '4577', 'Strée-Lez-Huy'),
(2316, '7110', 'Strépy-Bracquegnies'),
(2317, '9620', 'Strijpen'),
(2318, '1760', 'Strijtem'),
(2319, '1853', 'Strombeek-Bever'),
(2320, '8600', 'Stuivekenskerke'),
(2321, '5020', 'Suarlée'),
(2322, '5550', 'Sugny'),
(2323, '5600', 'Surice'),
(2324, '6812', 'Suxy'),
(2325, '6661', 'Tailles'),
(2326, '7618', 'Taintignies'),
(2327, '5060', 'Tamines'),
(2328, '5651', 'Tarcienne'),
(2329, '4163', 'Tavier'),
(2330, '5310', 'Taviers'),
(2331, '6662', 'Tavigny'),
(2332, '6927', 'Tellin'),
(2333, '7520', 'Templeuve'),
(2334, '5020', 'Temploux'),
(2335, '9140', 'Temse'),
(2336, '6970', 'Tenneville'),
(2337, '1790', 'Teralfene'),
(2338, '2840', 'Terhagen'),
(2339, '6813', 'Termes'),
(2340, '1740', 'Ternat'),
(2341, '7333', 'Tertre'),
(2342, '3080', 'Tervuren'),
(2343, '4560', 'Terwagne'),
(2344, '3980', 'Tessenderlo'),
(2345, '3272', 'Testelt'),
(2346, '3793', 'Teuven'),
(2347, '4910', 'Theux'),
(2348, '6717', 'Thiaumont'),
(2349, '7070', 'Thieu'),
(2350, '7901', 'Thieulain'),
(2351, '7061', 'Thieusies'),
(2352, '6230', 'Thiméon'),
(2353, '4890', 'Thimister'),
(2354, '7533', 'Thimougies'),
(2355, '1402', 'Thines'),
(2356, '6500', 'Thirimont'),
(2357, '4280', 'Thisnes'),
(2358, '4791', 'Thommen'),
(2359, '5300', 'Thon'),
(2360, '1360', 'Thorembais-Les-Béguines'),
(2361, '1360', 'Thorembais-Saint-Trond'),
(2362, '7830', 'Thoricourt'),
(2363, '6536', 'Thuillies'),
(2364, '6530', 'Thuin'),
(2365, '7350', 'Thulin'),
(2366, '7971', 'Thumaide'),
(2367, '5621', 'Thy-Le-Baudouin'),
(2368, '5651', 'Thy-Le-Chƒteau'),
(2369, '5502', 'Thynes'),
(2370, '4367', 'Thys'),
(2371, '8573', 'Tiegem'),
(2372, '2460', 'Tielen'),
(2373, '9140', 'Tielrode'),
(2374, '3390', 'Tielt'),
(2375, '8700', 'Tielt'),
(2376, '3300', 'Tienen'),
(2377, '4630', 'Tignée'),
(2378, '4500', 'Tihange'),
(2379, '3150', 'Tildonk'),
(2380, '4130', 'Tilff'),
(2381, '6680', 'Tillet'),
(2382, '4420', 'Tilleur'),
(2383, '5380', 'Tillier'),
(2384, '1495', 'Tilly'),
(2385, '4557', 'Tinlot'),
(2386, '6637', 'Tintange'),
(2387, '6730', 'Tintigny'),
(2388, '2830', 'Tisselt'),
(2389, '6700', 'Toernich'),
(2390, '6941', 'Tohogne'),
(2391, '1570', 'Tollembeek'),
(2392, '3700', 'Tongeren'),
(2393, '2260', 'Tongerlo'),
(2394, '3960', 'Tongerlo'),
(2395, '7951', 'Tongre-Notre-Dame'),
(2396, '7950', 'Tongre-Saint-Martin'),
(2397, '5140', 'Tongrinne'),
(2398, '6717', 'Tontelange'),
(2399, '6767', 'Torgny'),
(2400, '8820', 'Torhout'),
(2401, '4263', 'Tourinne'),
(2402, '1320', 'Tourinnes-La-Grosse'),
(2403, '1457', 'Tourinnes-Saint-Lambert'),
(2404, '7500', 'Tournai'),
(2405, '6840', 'Tournay'),
(2406, '7904', 'Tourpes'),
(2407, '6890', 'Transinne'),
(2408, '6183', 'Trazegnies'),
(2409, '5670', 'Treignes'),
(2410, '4670', 'Trembleur'),
(2411, '3120', 'Tremelo'),
(2412, '7100', 'Trivières'),
(2413, '4280', 'Trognée'),
(2414, '4980', 'Trois-Ponts'),
(2415, '1480', 'Tubize'),
(2416, '2300', 'Turnhout'),
(2417, '6833', 'Ucimont'),
(2418, '3631', 'Uikhoven'),
(2419, '9290', 'Uitbergen'),
(2420, '8370', 'Uitkerke'),
(2421, '1180', 'Ukkel'),
(2422, '3832', 'Ulbeek'),
(2423, '5310', 'Upigny'),
(2424, '9910', 'Ursel'),
(2425, '3054', 'Vaalbeek'),
(2426, '3770', 'Val-Meer'),
(2427, '6741', 'Vance'),
(2428, '2431', 'Varendonk'),
(2429, '8490', 'Varsenare'),
(2430, '5680', 'Vaucelles'),
(2431, '7536', 'Vaulx'),
(2432, '6462', 'Vaulx-Lez-Chimay'),
(2433, '6960', 'Vaux-Chavanne'),
(2434, '4530', 'Vaux-Et-Borset'),
(2435, '6640', 'Vaux-Lez-Rosières'),
(2436, '4051', 'Vaux-Sous-Chèvremont'),
(2437, '6640', 'Vaux-Sur-Sûre'),
(2438, '3870', 'Vechmaal'),
(2439, '5020', 'Vedrin'),
(2440, '2431', 'Veerle'),
(2441, '5060', 'Velaine-Sur-Sambre'),
(2442, '7760', 'Velaines'),
(2443, '8210', 'Veldegem'),
(2444, '3620', 'Veldwezelt'),
(2445, '7120', 'Vellereille-Le-Sec'),
(2446, '7120', 'Vellereille-Les-Brayeux'),
(2447, '3806', 'Velm'),
(2448, '4460', 'Velroux'),
(2449, '3020', 'Veltem-Beisem'),
(2450, '9620', 'Velzeke-Ruddershove'),
(2451, '5575', 'Vencimont'),
(2452, '1005', 'Verenigde Vergadering van de Gemeenschappelijke '),
(2453, '6440', 'Vergnies'),
(2454, '4537', 'Verlaine'),
(2455, '5370', 'Verlée'),
(2456, '9130', 'Verrebroek'),
(2457, '3370', 'Vertrijk'),
(2458, '4800', 'Verviers'),
(2459, '6870', 'Vesqueville'),
(2460, '3870', 'Veulen'),
(2461, '8630', 'Veurne'),
(2462, '5300', 'Vezin'),
(2463, '7538', 'Vezon'),
(2464, '9500', 'Viane'),
(2465, '8570', 'Vichte'),
(2466, '6690', 'Vielsalm'),
(2467, '4317', 'Viemme'),
(2468, '2240', 'Viersel'),
(2469, '4577', 'Vierset-Barse'),
(2470, '5670', 'Vierves-Sur-Viroin'),
(2471, '6230', 'Viesville'),
(2472, '1472', 'Vieux-Genappe'),
(2473, '4530', 'Vieux-Waleffe'),
(2474, '4190', 'Vieuxville'),
(2475, '6890', 'Villance'),
(2476, '4260', 'Ville-En-Hesbaye'),
(2477, '7322', 'Ville-Pommeroeul'),
(2478, '7070', 'Ville-Sur-Haine'),
(2479, '7334', 'Villerot'),
(2480, '4161', 'Villers-Aux-Tours'),
(2481, '5630', 'Villers-Deux-Eglises'),
(2482, '6823', 'Villers-Devant-Orval'),
(2483, '5600', 'Villers-En-Fagne'),
(2484, '4340', 'Villers-L\'Evêque'),
(2485, '6600', 'Villers-La-Bonne-Eau'),
(2486, '6769', 'Villers-La-Loue'),
(2487, '6460', 'Villers-La-Tour'),
(2488, '1495', 'Villers-La-Ville'),
(2489, '4530', 'Villers-Le-Bouillet'),
(2490, '5600', 'Villers-Le-Gambon'),
(2491, '4280', 'Villers-Le-Peuplier'),
(2492, '4550', 'Villers-Le-Temple'),
(2493, '5080', 'Villers-Lez-Heest'),
(2494, '7812', 'Villers-Notre-Dame'),
(2495, '6210', 'Villers-Perwin'),
(2496, '6280', 'Villers-Poterie'),
(2497, '7812', 'Villers-Saint-Amand'),
(2498, '7031', 'Villers-Saint-Ghislain'),
(2499, '4453', 'Villers-Saint-Siméon'),
(2500, '6941', 'Villers-Sainte-Gertrude'),
(2501, '5580', 'Villers-Sur-Lesse'),
(2502, '6740', 'Villers-Sur-Semois'),
(2503, '1800', 'Vilvoorde'),
(2504, '4520', 'Vinalmont'),
(2505, '9921', 'Vinderhoute'),
(2506, '8630', 'Vinkem'),
(2507, '9800', 'Vinkt'),
(2508, '6461', 'Virelles'),
(2509, '1460', 'Virginal-Samme'),
(2510, '6760', 'Virton'),
(2511, '4600', 'Vis‚'),
(2512, '3300', 'Vissenaken'),
(2513, '7511', 'Vitrine Magique'),
(2514, '5070', 'Vitrival'),
(2515, '4683', 'Vivegnis'),
(2516, '6833', 'Vivy'),
(2517, '1011', 'Vlaams Parlement'),
(2518, '8600', 'Vladslo'),
(2519, '8908', 'Vlamertinge'),
(2520, '9420', 'Vlekkem'),
(2521, '1602', 'Vlezenbeek'),
(2522, '3724', 'Vliermaal'),
(2523, '3721', 'Vliermaalroot'),
(2524, '9520', 'Vlierzele'),
(2525, '3770', 'Vlijtingen'),
(2526, '2340', 'Vlimmeren'),
(2527, '8421', 'Vlissegem'),
(2528, '7880', 'Vloesberg'),
(2529, '5600', 'Vodecée'),
(2530, '5680', 'Vodelée'),
(2531, '5650', 'Vogenée'),
(2532, '9700', 'Volkegem'),
(2533, '1570', 'Vollezele'),
(2534, '5570', 'Vonêche'),
(2535, '9400', 'Voorde'),
(2536, '8902', 'Voormezele'),
(2537, '3840', 'Voort'),
(2538, '4347', 'Voroux-Goreux'),
(2539, '4451', 'Voroux-Lez-Liers'),
(2540, '2290', 'Vorselaar'),
(2541, '3890', 'Vorsen'),
(2542, '1190', 'Vorst'),
(2543, '2430', 'Vorst'),
(2544, '2350', 'Vosselaar'),
(2545, '9850', 'Vosselare'),
(2546, '3080', 'Vossem'),
(2547, '4041', 'Vottem'),
(2548, '9120', 'Vrasene'),
(2549, '2531', 'Vremde'),
(2550, '3700', 'Vreren'),
(2551, '5550', 'Vresse-Sur-Semois'),
(2552, '3770', 'Vroenhoven'),
(2553, '1043', 'VRT'),
(2554, '1818', 'VTM'),
(2555, '3630', 'Vucht'),
(2556, '9890', 'Vurste'),
(2557, '4570', 'Vyle-Et-Tharoul'),
(2558, '3473', 'Waanrode'),
(2559, '9506', 'Waarbeke'),
(2560, '8020', 'Waardamme'),
(2561, '2550', 'Waarloos'),
(2562, '8581', 'Waarmaarde'),
(2563, '9950', 'Waarschoot'),
(2564, '3401', 'Waasmont'),
(2565, '9250', 'Waasmunster'),
(2566, '7784', 'Waasten'),
(2567, '9185', 'Wachtebeke'),
(2568, '7971', 'Wadelincourt'),
(2569, '6223', 'Wagnelée'),
(2570, '6900', 'Waha'),
(2571, '5377', 'Waillet'),
(2572, '8720', 'Wakken'),
(2573, '5650', 'Walcourt'),
(2574, '2800', 'Walem'),
(2575, '1457', 'Walhain-Saint-Paul'),
(2576, '4711', 'Walhorn'),
(2577, '3401', 'Walsbets'),
(2578, '3401', 'Walshoutem'),
(2579, '3740', 'Waltwilder'),
(2580, '1741', 'Wambeek'),
(2581, '5570', 'Wancennes'),
(2582, '4020', 'Wandre'),
(2583, '6224', 'Wanfercée-Baulet'),
(2584, '3400', 'Wange'),
(2585, '6220', 'Wangenies'),
(2586, '5564', 'Wanlin'),
(2587, '4980', 'Wanne'),
(2588, '7861', 'Wannebecq'),
(2589, '9772', 'Wannegem-Lede'),
(2590, '4280', 'Wansin'),
(2591, '4520', 'Wanze'),
(2592, '9340', 'Wanzele'),
(2593, '7548', 'Warchin'),
(2594, '7740', 'Warcoing'),
(2595, '6600', 'Wardin'),
(2596, '8790', 'Waregem'),
(2597, '4300', 'Waremme'),
(2598, '4217', 'Waret-L\'Evêque'),
(2599, '5310', 'Waret-La-Chaussée'),
(2600, '5080', 'Warisoulx'),
(2601, '5537', 'Warnant'),
(2602, '4530', 'Warnant-Dreye'),
(2603, '7340', 'Warquignies'),
(2604, '4608', 'Warsage'),
(2605, '4590', 'Warzée'),
(2606, '7340', 'Wasmes'),
(2607, '7604', 'Wasmes-Audemez-Briffoeil'),
(2608, '7390', 'Wasmuel'),
(2609, '4219', 'Wasseiges'),
(2610, '9988', 'Waterland-Oudeman'),
(2611, '1410', 'Waterloo'),
(2612, '1170', 'Watermaal-Bosvoorde'),
(2613, '9988', 'Watervliet'),
(2614, '8978', 'Watou'),
(2615, '7910', 'Wattripont'),
(2616, '7131', 'Waudrez'),
(2617, '5540', 'Waulsort'),
(2618, '1440', 'Wauthier-Braine'),
(2619, '1300', 'Wavre'),
(2620, '5580', 'Wavreille'),
(2621, '6210', 'Wayaux'),
(2622, '1474', 'Ways'),
(2623, '3290', 'Webbekom'),
(2624, '2275', 'Wechelderzande'),
(2625, '2381', 'Weelde'),
(2626, '1982', 'Weerde'),
(2627, '2880', 'Weert'),
(2628, '4860', 'Wegnez'),
(2629, '5523', 'Weillen'),
(2630, '4950', 'Weismes'),
(2631, '9700', 'Welden'),
(2632, '4840', 'Welkenraedt'),
(2633, '9473', 'Welle'),
(2634, '3830', 'Wellen'),
(2635, '6920', 'Wellin'),
(2636, '1780', 'Wemmel'),
(2637, '8420', 'Wenduine'),
(2638, '5100', 'Wépion'),
(2639, '4190', 'Werbomont'),
(2640, '3118', 'Werchter'),
(2641, '6940', 'Wéris'),
(2642, '8610', 'Werken'),
(2643, '3730', 'Werm'),
(2644, '8940', 'Wervik'),
(2645, '3150', 'Wespelaar'),
(2646, '8434', 'Westende'),
(2647, '2260', 'Westerlo'),
(2648, '8300', 'Westkapelle'),
(2649, '8460', 'Westkerke'),
(2650, '2390', 'Westmalle'),
(2651, '2235', 'Westmeerbeek'),
(2652, '8954', 'Westouter'),
(2653, '9230', 'Westrem'),
(2654, '8840', 'Westrozebeke'),
(2655, '8640', 'Westvleteren'),
(2656, '9230', 'Wetteren'),
(2657, '8560', 'Wevelgem'),
(2658, '7620', 'Wez-Velvain'),
(2659, '3111', 'Wezemaal'),
(2660, '1970', 'Wezembeek-Oppem'),
(2661, '3401', 'Wezeren'),
(2662, '6666', 'Wibrin'),
(2663, '9260', 'Wichelen'),
(2664, '3700', 'Widooie'),
(2665, '2222', 'Wiekevorst'),
(2666, '8710', 'Wielsbeke'),
(2667, '5100', 'Wierde'),
(2668, '7608', 'Wiers'),
(2669, '5571', 'Wiesme'),
(2670, '9280', 'Wieze'),
(2671, '7370', 'Wihéries'),
(2672, '4452', 'Wihogne'),
(2673, '3990', 'Wijchmaal'),
(2674, '3850', 'Wijer'),
(2675, '3018', 'Wijgmaal'),
(2676, '2110', 'Wijnegem'),
(2677, '3670', 'Wijshagen'),
(2678, '8953', 'Wijtschate'),
(2679, '3803', 'Wilderen'),
(2680, '7904', 'Willaupuis'),
(2681, '3370', 'Willebringen'),
(2682, '2830', 'Willebroek'),
(2683, '7506', 'Willemeau'),
(2684, '5575', 'Willerzie'),
(2685, '2610', 'Wilrijk'),
(2686, '3012', 'Wilsele'),
(2687, '8431', 'Wilskerke'),
(2688, '3501', 'Wimmertingen'),
(2689, '5570', 'Winenne'),
(2690, '8750', 'Wingene'),
(2691, '3020', 'Winksele'),
(2692, '3722', 'Wintershoven'),
(2693, '6860', 'Witry'),
(2694, '7890', 'Wodecq'),
(2695, '8640', 'Woesten'),
(2696, '6780', 'Wolkrange'),
(2697, '1861', 'Wolvertem'),
(2698, '2160', 'Wommelgem'),
(2699, '3350', 'Wommersom'),
(2700, '4690', 'Wonck'),
(2701, '9032', 'Wondelgem'),
(2702, '9800', 'Wontergem'),
(2703, '9790', 'Wortegem'),
(2704, '2323', 'Wortel'),
(2705, '9550', 'Woubrechtegem'),
(2706, '8600', 'Woumen'),
(2707, '8670', 'Wulpen'),
(2708, '8952', 'Wulvergem'),
(2709, '8630', 'Wulveringem'),
(2710, '2990', 'Wuustwezel'),
(2711, '4652', 'Xhendelesse'),
(2712, '4432', 'Xhendremael'),
(2713, '4190', 'Xhoris'),
(2714, '4550', 'Yernée-Fraineux'),
(2715, '7513', 'Yves Rocher'),
(2716, '5650', 'Yves-Gomezée'),
(2717, '5530', 'Yvoir'),
(2718, '9080', 'Zaffelare'),
(2719, '9506', 'Zandbergen'),
(2720, '8680', 'Zande'),
(2721, '2240', 'Zandhoven'),
(2722, '2040', 'Zandvliet'),
(2723, '8400', 'Zandvoorde'),
(2724, '8980', 'Zandvoorde'),
(2725, '9500', 'Zarlardinge'),
(2726, '8610', 'Zarren'),
(2727, '1930', 'Zaventem'),
(2728, '8210', 'Zedelgem'),
(2729, '8380', 'Zeebrugge'),
(2730, '9660', 'Zegelsem'),
(2731, '9240', 'Zele'),
(2732, '3545', 'Zelem'),
(2733, '1731', 'Zellik'),
(2734, '9060', 'Zelzate'),
(2735, '1980', 'Zemst'),
(2736, '3800', 'Zepperen'),
(2737, '8490', 'Zerkegem'),
(2738, '1370', 'Zétrud-Lumay'),
(2739, '8470', 'Zevekote'),
(2740, '9080', 'Zeveneken'),
(2741, '9800', 'Zeveren'),
(2742, '9840', 'Zevergem'),
(2743, '3271', 'Zichem'),
(2744, '3770', 'Zichen-Zussen-Bolder'),
(2745, '8902', 'Zillebeke'),
(2746, '9750', 'Zingem'),
(2747, '2260', 'Zoerle-Parwijs'),
(2748, '2980', 'Zoersel'),
(2749, '3550', 'Zolder'),
(2750, '9930', 'Zomergem'),
(2751, '3520', 'Zonhoven'),
(2752, '8980', 'Zonnebeke'),
(2753, '9520', 'Zonnegem'),
(2754, '9620', 'Zottegem'),
(2755, '8630', 'Zoutenaaie'),
(2756, '3440', 'Zoutleeuw'),
(2757, '8904', 'Zuidschote'),
(2758, '8377', 'Zuienkerke'),
(2759, '9870', 'Zulte'),
(2760, '9690', 'Zulzeke'),
(2761, '3690', 'Zutendaal'),
(2762, '8550', 'Zwevegem'),
(2763, '8750', 'Zwevezele'),
(2764, '9052', 'Zwijnaarde'),
(2765, '2070', 'Zwijndrecht'),
(2766, '2150', 'Antwerpen'),
(2767, '3730', 'Bilzen-Hoeselt'),
(2768, '3740', 'Bilzen-Hoeselt'),
(2769, '3840', 'Tongeren-Borgloon'),
(2770, '3700', 'Tongeren-Borgloon'),
(2771, '3720', 'Hasselt'),
(2772, '3980', 'Tessenderlo-Ham'),
(2773, '3945', 'Tessenderlo-Ham'),
(2774, '6687', 'Bastogne'),
(2775, '9120', 'Beveren-Kruibeke-Zwijndrecht'),
(2776, '2070', 'Beveren-Kruibeke-Zwijndrecht'),
(2777, '9150', 'Beveren-Kruibeke-Zwijndrecht'),
(2778, '9185', 'Lochristi'),
(2779, '9180', 'Lokeren'),
(2780, '9820', 'Merelbeke-Melle'),
(2781, '9090', 'Merelbeke-Melle'),
(2782, '9810', 'Nazareth-De Pinte'),
(2783, '9840', 'Nazareth-De Pinte'),
(2784, '1570', 'Pajottegem'),
(2785, '1755', 'Pajottegem'),
(2786, '1540', 'Pajottegem'),
(2787, '8760', 'Tielt'),
(2788, '8755', 'Wingene'),
(2789, '9750', 'Kruisem'),
(2790, '9770', 'Kruisem'),
(2791, '9771', 'Kruisem'),
(2792, '9772', 'Kruisem'),
(2793, '9920', 'Lievegem'),
(2794, '9931', 'Lievegem'),
(2795, '9932', 'Lievegem'),
(2796, '9921', 'Lievegem'),
(2797, '9950', 'Lievegem'),
(2798, '9930', 'Lievegem'),
(2799, '8647', 'Lo-Reninge'),
(2800, '9680', 'Maarkedal'),
(2801, '9681', 'Maarkedal'),
(2802, '9688', 'Maarkedal'),
(2803, '6960', 'Manhay'),
(2804, '1350', 'Orp-Jauche'),
(2805, '1340', 'Ottignies-Louvain-La-Neuve'),
(2806, '1341', 'Ottignies-Louvain-La-Neuve'),
(2807, '1342', 'Ottignies-Louvain-La-Neuve'),
(2808, '1348', 'Ottignies-Louvain-La-Neuve'),
(2809, '3660', 'Oudsbergen'),
(2810, '4850', 'Plombières'),
(2811, '4851', 'Plombières'),
(2812, '4852', 'Plombières'),
(2813, '2870', 'Puurs-Sint-Amands'),
(2814, '2890', 'Puurs-Sint-Amands'),
(2815, '7040', 'Quévy'),
(2816, '7041', 'Quévy'),
(2817, '1430', 'Rebecq'),
(2818, '6680', 'Sainte-Ode'),
(2819, '6681', 'Sainte-Ode'),
(2820, '5060', 'Sambreville'),
(2821, '3271', 'Scherpenheuvel-Zichem'),
(2822, '3272', 'Scherpenheuvel-Zichem'),
(2823, '3270', 'Scherpenheuvel-Zichem'),
(2824, '6470', 'Sivry-Rance'),
(2825, '8587', 'Spiere-Helkijn'),
(2826, '3390', 'Tielt-Winge'),
(2827, '3391', 'Tielt-Winge'),
(2828, '4870', 'Trooz'),
(2829, '5670', 'Viroinval'),
(2830, '9790', 'Wortegem-Petegem'),
(2831, '9630', 'Zwalm'),
(2832, '9636', 'Zwalm');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rechtspersonen`
--

CREATE TABLE `rechtspersonen` (
  `klantId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `btwNummer` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rechtspersonen`
--

INSERT INTO `rechtspersonen` (`klantId`, `naam`, `btwNummer`) VALUES
(1, 'VDAB', '0887010362'),
(7, 'RVA', '0206737484');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `securitygroepen`
--

CREATE TABLE `securitygroepen` (
  `securityGroepId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `securitygroepen`
--

INSERT INTO `securitygroepen` (`securityGroepId`, `naam`) VALUES
(1, 'PHPwebsite'),
(2, 'Cwebsite'),
(3, 'Javawebsite'),
(4, 'Adminwebsite');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `toonpersoneelsledenmetsecuritygroepen`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `toonpersoneelsledenmetsecuritygroepen` (
`voornaam` varchar(45)
,`familienaam` varchar(45)
,`emailadres` varchar(45)
,`naam` varchar(45)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uitgaandeleveringen`
--

CREATE TABLE `uitgaandeleveringen` (
  `uitgaandeLeveringsId` int(11) NOT NULL,
  `bestelId` int(11) NOT NULL,
  `vertrekDatum` date NOT NULL,
  `aankomstDatum` date DEFAULT NULL,
  `trackingcode` varchar(45) NOT NULL,
  `klantId` int(11) NOT NULL,
  `uitgaandeLeveringsStatusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `uitgaandeleveringen`
--

INSERT INTO `uitgaandeleveringen` (`uitgaandeLeveringsId`, `bestelId`, `vertrekDatum`, `aankomstDatum`, `trackingcode`, `klantId`, `uitgaandeLeveringsStatusId`) VALUES
(1, 1, '2026-03-20', '2026-03-21', 'ul20260326104658', 1, 2),
(2, 2, '2026-03-26', NULL, 'ul20260326104658', 2, 1);

--
-- Triggers `uitgaandeleveringen`
--
DELIMITER $$
CREATE TRIGGER `insertTriggerUitgaandeleveringen` BEFORE INSERT ON `uitgaandeleveringen` FOR EACH ROW begin
set new.trackingcode = concat('ul',convert(from_unixtime(unix_timestamp()) + 0, char(14)));
update Bestellingen set bestellingsStatusId=5 where bestelId=new.bestelId;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateTriggerUitgaandeleveringen` BEFORE UPDATE ON `uitgaandeleveringen` FOR EACH ROW begin
update Bestellingen set bestellingsStatusId=new.uitgaandeLeveringsStatusId + 4 
where bestelid=new.bestelId;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uitgaandeleveringsstatussen`
--

CREATE TABLE `uitgaandeleveringsstatussen` (
  `uitgaandeLeveringsStatusId` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `uitgaandeleveringsstatussen`
--

INSERT INTO `uitgaandeleveringsstatussen` (`uitgaandeLeveringsStatusId`, `naam`) VALUES
(1, 'Onderweg'),
(2, 'Geleverd'),
(3, 'Verloren'),
(4, 'Beschadigd'),
(5, 'Retour'),
(6, 'RetourInStock');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `veelgesteldevragenartikels`
--

CREATE TABLE `veelgesteldevragenartikels` (
  `veelgesteldeVragenArtikelId` int(11) NOT NULL,
  `artikelId` int(11) NOT NULL,
  `vraag` varchar(255) NOT NULL,
  `antwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wishlistitems`
--

CREATE TABLE `wishlistitems` (
  `wishListItemId` int(11) NOT NULL,
  `artikelId` int(11) NOT NULL,
  `gebruikersAccountId` int(11) NOT NULL,
  `aanvraagDatum` date NOT NULL,
  `aantal` int(11) NOT NULL DEFAULT 1,
  `emailGestuurdDatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structuur voor de view `toonpersoneelsledenmetsecuritygroepen`
--
DROP TABLE IF EXISTS `toonpersoneelsledenmetsecuritygroepen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `toonpersoneelsledenmetsecuritygroepen`  AS SELECT `personeelsleden`.`voornaam` AS `voornaam`, `personeelsleden`.`familienaam` AS `familienaam`, `personeelslidaccounts`.`emailadres` AS `emailadres`, `securitygroepen`.`naam` AS `naam` FROM (((`personeelslidsecuritygroepen` join `personeelsleden` on(`personeelslidsecuritygroepen`.`personeelslidId` = `personeelsleden`.`personeelslidId`)) join `securitygroepen` on(`personeelslidsecuritygroepen`.`securityGroepId` = `securitygroepen`.`securityGroepId`)) join `personeelslidaccounts` on(`personeelsleden`.`personeelslidAccountId` = `personeelslidaccounts`.`personeelslidAccountId`)) ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `actiecodes`
--
ALTER TABLE `actiecodes`
  ADD PRIMARY KEY (`actiecodeId`);

--
-- Indexen voor tabel `adressen`
--
ALTER TABLE `adressen`
  ADD PRIMARY KEY (`adresId`),
  ADD KEY `fk_Adressen_Plaatsen_idx` (`plaatsId`);

--
-- Indexen voor tabel `artikelcategorieen`
--
ALTER TABLE `artikelcategorieen`
  ADD PRIMARY KEY (`categorieId`,`artikelId`),
  ADD KEY `fk_ArtikelCategorieen_Artikelen1_idx` (`artikelId`);

--
-- Indexen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artikelId`),
  ADD UNIQUE KEY `ean_UNIQUE` (`ean`),
  ADD KEY `fk_Artikelen_Leveranciers` (`leveranciersId`);

--
-- Indexen voor tabel `artikelleveranciersinfolijnen`
--
ALTER TABLE `artikelleveranciersinfolijnen`
  ADD PRIMARY KEY (`artikelLeveranciersInfoLijnId`,`artikelId`),
  ADD KEY `fk_ArtikelLeveranciersInfoLijnen_Artikelen1_idx` (`artikelId`);

--
-- Indexen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD PRIMARY KEY (`bestellijnId`),
  ADD KEY `fk_Bestellijnen_Bestellingen1_idx` (`bestelId`),
  ADD KEY `fk_Bestellijnen_Artikelen1_idx` (`artikelId`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelId`),
  ADD KEY `fk_Bestellingen_Betaalwijzes1_idx` (`betaalwijzeId`),
  ADD KEY `fk_Bestellingen_Klanten1_idx` (`klantId`),
  ADD KEY `fk_Bestellingen_BestellingsStatussen1_idx` (`bestellingsStatusId`),
  ADD KEY `fk_Bestellingen_Adressen1_idx` (`facturatieAdresId`),
  ADD KEY `fk_Bestellingen_Adressen2_idx` (`leveringsAdresId`);

--
-- Indexen voor tabel `bestellingsstatussen`
--
ALTER TABLE `bestellingsstatussen`
  ADD PRIMARY KEY (`bestellingsStatusId`);

--
-- Indexen voor tabel `betaalwijzes`
--
ALTER TABLE `betaalwijzes`
  ADD PRIMARY KEY (`betaalwijzeId`);

--
-- Indexen voor tabel `categorieen`
--
ALTER TABLE `categorieen`
  ADD PRIMARY KEY (`categorieId`),
  ADD KEY `fk_Categorieen_Categorieen1_idx` (`hoofdCategorieId`);

--
-- Indexen voor tabel `chatgesprekken`
--
ALTER TABLE `chatgesprekken`
  ADD PRIMARY KEY (`chatgesprekId`),
  ADD KEY `fk_ChatGesprekken_GebruikersAccounts1_idx` (`gebruikersAccountId`);

--
-- Indexen voor tabel `chatgespreklijnen`
--
ALTER TABLE `chatgespreklijnen`
  ADD PRIMARY KEY (`chatgesprekLijnId`),
  ADD KEY `fk_ChatgesprekLijnen_ChatGesprekken1_idx` (`chatgesprekId`),
  ADD KEY `fk_ChatgesprekLijnen_GebruikersAccounts1_idx` (`gebruikersAccountId`),
  ADD KEY `fk_ChatgesprekLijnen_PersoneelslidAccounts1_idx` (`personeelslidAccountId`);

--
-- Indexen voor tabel `contactpersonen`
--
ALTER TABLE `contactpersonen`
  ADD PRIMARY KEY (`contactpersoonId`),
  ADD KEY `fk_Contactpersonen_Rechtspersonen1_idx` (`klantId`),
  ADD KEY `fk_Contactpersonen_GebruikersAccounts_idx` (`gebruikersAccountId`);

--
-- Indexen voor tabel `eventwachtrijartikelen`
--
ALTER TABLE `eventwachtrijartikelen`
  ADD PRIMARY KEY (`artikelId`);

--
-- Indexen voor tabel `gebruikersaccounts`
--
ALTER TABLE `gebruikersaccounts`
  ADD PRIMARY KEY (`gebruikersAccountId`),
  ADD UNIQUE KEY `gebrukersnaam_UNIQUE` (`emailadres`);

--
-- Indexen voor tabel `inkomendeleveringen`
--
ALTER TABLE `inkomendeleveringen`
  ADD PRIMARY KEY (`inkomendeLeveringsId`),
  ADD KEY `fk_InkomendeLeveringen_Personeelsleden1_idx` (`ontvangerPersoneelslidId`),
  ADD KEY `fk_InkomendeLeveringen_Leveranciers1` (`leveranciersId`);

--
-- Indexen voor tabel `inkomendeleveringslijnen`
--
ALTER TABLE `inkomendeleveringslijnen`
  ADD PRIMARY KEY (`inkomendeLeveringsId`,`artikelId`,`magazijnPlaatsId`),
  ADD KEY `fk_InkomendeLeverongsLijnen_Artikelen1_idx` (`artikelId`),
  ADD KEY `fk_InkomendeLeverongsLijnen_MagazijnPlaatsen1_idx` (`magazijnPlaatsId`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`),
  ADD KEY `fk_Klanten_Adressen1_idx` (`facturatieAdresId`),
  ADD KEY `fk_Klanten_Adressen2_idx` (`leveringsAdresId`);

--
-- Indexen voor tabel `klantenreviews`
--
ALTER TABLE `klantenreviews`
  ADD PRIMARY KEY (`klantenReviewId`),
  ADD KEY `fk_KlantenReviews_Bestellijnen1_idx` (`bestellijnId`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`leveranciersId`),
  ADD KEY `fk_Leveranciers_Plaatsen1_idx` (`plaatsId`);

--
-- Indexen voor tabel `magazijnplaatsen`
--
ALTER TABLE `magazijnplaatsen`
  ADD PRIMARY KEY (`magazijnPlaatsId`),
  ADD UNIQUE KEY `uinx_rijrek` (`rij`,`rek`),
  ADD KEY `fk_MagazijnPlaatsen_Artikelen1_idx` (`artikelId`);

--
-- Indexen voor tabel `natuurlijkepersonen`
--
ALTER TABLE `natuurlijkepersonen`
  ADD PRIMARY KEY (`klantId`),
  ADD KEY `fk_PrivateKlanten_Klanten1_idx` (`klantId`),
  ADD KEY `fk_NatuurlijkePersonen_gebruikersAccountId_idx` (`gebruikersAccountId`);

--
-- Indexen voor tabel `personeelsleden`
--
ALTER TABLE `personeelsleden`
  ADD PRIMARY KEY (`personeelslidId`),
  ADD KEY `fk_Personeelsleden_PersoneelslidAccounts1_idx` (`personeelslidAccountId`);

--
-- Indexen voor tabel `personeelslidaccounts`
--
ALTER TABLE `personeelslidaccounts`
  ADD PRIMARY KEY (`personeelslidAccountId`),
  ADD UNIQUE KEY `emailadres_UNIQUE` (`emailadres`);

--
-- Indexen voor tabel `personeelslidsecuritygroepen`
--
ALTER TABLE `personeelslidsecuritygroepen`
  ADD PRIMARY KEY (`personeelslidId`,`securityGroepId`),
  ADD KEY `fk_PersoneelslidSecurityGroepen_SecurityGroepen1_idx` (`securityGroepId`);

--
-- Indexen voor tabel `plaatsen`
--
ALTER TABLE `plaatsen`
  ADD PRIMARY KEY (`plaatsId`);

--
-- Indexen voor tabel `rechtspersonen`
--
ALTER TABLE `rechtspersonen`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `securitygroepen`
--
ALTER TABLE `securitygroepen`
  ADD PRIMARY KEY (`securityGroepId`);

--
-- Indexen voor tabel `uitgaandeleveringen`
--
ALTER TABLE `uitgaandeleveringen`
  ADD PRIMARY KEY (`uitgaandeLeveringsId`),
  ADD KEY `fk_UitgaandeLeveringen_Klanten1_idx` (`klantId`),
  ADD KEY `fk_UitgaandeLeveringen_UitgaandeLeveringsStatussn1_idx` (`uitgaandeLeveringsStatusId`),
  ADD KEY `fk_UitgaandeLeveringen_Bestellingen1_idx` (`bestelId`);

--
-- Indexen voor tabel `uitgaandeleveringsstatussen`
--
ALTER TABLE `uitgaandeleveringsstatussen`
  ADD PRIMARY KEY (`uitgaandeLeveringsStatusId`);

--
-- Indexen voor tabel `veelgesteldevragenartikels`
--
ALTER TABLE `veelgesteldevragenartikels`
  ADD PRIMARY KEY (`veelgesteldeVragenArtikelId`),
  ADD KEY `fk_VeelgesteldeVragenArtikels_Artikelen1_idx` (`artikelId`);

--
-- Indexen voor tabel `wishlistitems`
--
ALTER TABLE `wishlistitems`
  ADD PRIMARY KEY (`wishListItemId`,`gebruikersAccountId`),
  ADD KEY `fk_WishListItems_Artikelen1_idx` (`artikelId`),
  ADD KEY `fk_WishListItems_GebruikersAccounts1_idx` (`gebruikersAccountId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `actiecodes`
--
ALTER TABLE `actiecodes`
  MODIFY `actiecodeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `adressen`
--
ALTER TABLE `adressen`
  MODIFY `adresId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artikelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT voor een tabel `artikelleveranciersinfolijnen`
--
ALTER TABLE `artikelleveranciersinfolijnen`
  MODIFY `artikelLeveranciersInfoLijnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT voor een tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  MODIFY `bestellijnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `bestellingsstatussen`
--
ALTER TABLE `bestellingsstatussen`
  MODIFY `bestellingsStatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `betaalwijzes`
--
ALTER TABLE `betaalwijzes`
  MODIFY `betaalwijzeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `categorieen`
--
ALTER TABLE `categorieen`
  MODIFY `categorieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT voor een tabel `chatgesprekken`
--
ALTER TABLE `chatgesprekken`
  MODIFY `chatgesprekId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `chatgespreklijnen`
--
ALTER TABLE `chatgespreklijnen`
  MODIFY `chatgesprekLijnId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `contactpersonen`
--
ALTER TABLE `contactpersonen`
  MODIFY `contactpersoonId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `gebruikersaccounts`
--
ALTER TABLE `gebruikersaccounts`
  MODIFY `gebruikersAccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `inkomendeleveringen`
--
ALTER TABLE `inkomendeleveringen`
  MODIFY `inkomendeLeveringsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `klantenreviews`
--
ALTER TABLE `klantenreviews`
  MODIFY `klantenReviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `leveranciersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `magazijnplaatsen`
--
ALTER TABLE `magazijnplaatsen`
  MODIFY `magazijnPlaatsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1561;

--
-- AUTO_INCREMENT voor een tabel `personeelsleden`
--
ALTER TABLE `personeelsleden`
  MODIFY `personeelslidId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `personeelslidaccounts`
--
ALTER TABLE `personeelslidaccounts`
  MODIFY `personeelslidAccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `plaatsen`
--
ALTER TABLE `plaatsen`
  MODIFY `plaatsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2833;

--
-- AUTO_INCREMENT voor een tabel `securitygroepen`
--
ALTER TABLE `securitygroepen`
  MODIFY `securityGroepId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `uitgaandeleveringen`
--
ALTER TABLE `uitgaandeleveringen`
  MODIFY `uitgaandeLeveringsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `uitgaandeleveringsstatussen`
--
ALTER TABLE `uitgaandeleveringsstatussen`
  MODIFY `uitgaandeLeveringsStatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `veelgesteldevragenartikels`
--
ALTER TABLE `veelgesteldevragenartikels`
  MODIFY `veelgesteldeVragenArtikelId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `wishlistitems`
--
ALTER TABLE `wishlistitems`
  MODIFY `wishListItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `adressen`
--
ALTER TABLE `adressen`
  ADD CONSTRAINT `fk_Adressen_Plaatsen` FOREIGN KEY (`plaatsId`) REFERENCES `plaatsen` (`plaatsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `artikelcategorieen`
--
ALTER TABLE `artikelcategorieen`
  ADD CONSTRAINT `fk_ArtikelCategorieen_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ArtikelCategorieen_Categorieen1` FOREIGN KEY (`categorieId`) REFERENCES `categorieen` (`categorieId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD CONSTRAINT `fk_Artikelen_Leveranciers` FOREIGN KEY (`leveranciersId`) REFERENCES `leveranciers` (`leveranciersId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `artikelleveranciersinfolijnen`
--
ALTER TABLE `artikelleveranciersinfolijnen`
  ADD CONSTRAINT `fk_ArtikelLeveranciersInfoLijnen_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD CONSTRAINT `fk_Bestellijnen_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestellijnen_Bestellingen1` FOREIGN KEY (`bestelId`) REFERENCES `bestellingen` (`bestelId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `fk_Bestellingen_Adressen1` FOREIGN KEY (`facturatieAdresId`) REFERENCES `adressen` (`adresId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestellingen_Adressen2` FOREIGN KEY (`leveringsAdresId`) REFERENCES `adressen` (`adresId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestellingen_BestellingsStatussen1` FOREIGN KEY (`bestellingsStatusId`) REFERENCES `bestellingsstatussen` (`bestellingsStatusId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestellingen_Betaalwijzes1` FOREIGN KEY (`betaalwijzeId`) REFERENCES `betaalwijzes` (`betaalwijzeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestellingen_Klanten1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `categorieen`
--
ALTER TABLE `categorieen`
  ADD CONSTRAINT `fk_Categorieen_Categorieen1` FOREIGN KEY (`hoofdCategorieId`) REFERENCES `categorieen` (`categorieId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `chatgesprekken`
--
ALTER TABLE `chatgesprekken`
  ADD CONSTRAINT `fk_ChatGesprekken_GebruikersAccounts1` FOREIGN KEY (`gebruikersAccountId`) REFERENCES `gebruikersaccounts` (`gebruikersAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `chatgespreklijnen`
--
ALTER TABLE `chatgespreklijnen`
  ADD CONSTRAINT `fk_ChatgesprekLijnen_ChatGesprekken1` FOREIGN KEY (`chatgesprekId`) REFERENCES `chatgesprekken` (`chatgesprekId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ChatgesprekLijnen_GebruikersAccounts1` FOREIGN KEY (`gebruikersAccountId`) REFERENCES `gebruikersaccounts` (`gebruikersAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ChatgesprekLijnen_PersoneelslidAccounts1` FOREIGN KEY (`personeelslidAccountId`) REFERENCES `personeelslidaccounts` (`personeelslidAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `contactpersonen`
--
ALTER TABLE `contactpersonen`
  ADD CONSTRAINT `fk_Contactpersonen_GebruikersAccounts1` FOREIGN KEY (`gebruikersAccountId`) REFERENCES `gebruikersaccounts` (`gebruikersAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Contactpersonen_Rechtspersonen1` FOREIGN KEY (`klantId`) REFERENCES `rechtspersonen` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `inkomendeleveringen`
--
ALTER TABLE `inkomendeleveringen`
  ADD CONSTRAINT `fk_InkomendeLeveringen_Leveranciers1` FOREIGN KEY (`leveranciersId`) REFERENCES `leveranciers` (`leveranciersId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_InkomendeLeveringen_Personeelsleden1` FOREIGN KEY (`ontvangerPersoneelslidId`) REFERENCES `personeelsleden` (`personeelslidId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `inkomendeleveringslijnen`
--
ALTER TABLE `inkomendeleveringslijnen`
  ADD CONSTRAINT `fk_InkomendeLeverongsLijnen_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_InkomendeLeverongsLijnen_InkomendeLeveringen1` FOREIGN KEY (`inkomendeLeveringsId`) REFERENCES `inkomendeleveringen` (`inkomendeLeveringsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD CONSTRAINT `fk_Klanten_Adressen1` FOREIGN KEY (`facturatieAdresId`) REFERENCES `adressen` (`adresId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Klanten_Adressen2` FOREIGN KEY (`leveringsAdresId`) REFERENCES `adressen` (`adresId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `klantenreviews`
--
ALTER TABLE `klantenreviews`
  ADD CONSTRAINT `fk_KlantenReviews_Bestellijnen1` FOREIGN KEY (`bestellijnId`) REFERENCES `bestellijnen` (`bestellijnId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD CONSTRAINT `fk_Leveranciers_Plaatsen1` FOREIGN KEY (`plaatsId`) REFERENCES `plaatsen` (`plaatsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `magazijnplaatsen`
--
ALTER TABLE `magazijnplaatsen`
  ADD CONSTRAINT `fk_MagazijnPlaatsen_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `natuurlijkepersonen`
--
ALTER TABLE `natuurlijkepersonen`
  ADD CONSTRAINT `fk_NatuurlijkePersonen_Gebruikersnamen1` FOREIGN KEY (`gebruikersAccountId`) REFERENCES `gebruikersaccounts` (`gebruikersAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PrivateKlanten_Klanten1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `personeelsleden`
--
ALTER TABLE `personeelsleden`
  ADD CONSTRAINT `fk_Personeelsleden_PersoneelslidAccounts1` FOREIGN KEY (`personeelslidAccountId`) REFERENCES `personeelslidaccounts` (`personeelslidAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `personeelslidsecuritygroepen`
--
ALTER TABLE `personeelslidsecuritygroepen`
  ADD CONSTRAINT `fk_PersoneelslidSecurityGroepen_Personeelsleden1` FOREIGN KEY (`personeelslidId`) REFERENCES `personeelsleden` (`personeelslidId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PersoneelslidSecurityGroepen_SecurityGroepen1` FOREIGN KEY (`securityGroepId`) REFERENCES `securitygroepen` (`securityGroepId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `rechtspersonen`
--
ALTER TABLE `rechtspersonen`
  ADD CONSTRAINT `fk_Rechtspersonen_Klanten1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `uitgaandeleveringen`
--
ALTER TABLE `uitgaandeleveringen`
  ADD CONSTRAINT `fk_UitgaandeLeveringen_Bestellingen1` FOREIGN KEY (`bestelId`) REFERENCES `bestellingen` (`bestelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UitgaandeLeveringen_Klanten1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UitgaandeLeveringen_UitgaandeLeveringsStatussn1` FOREIGN KEY (`uitgaandeLeveringsStatusId`) REFERENCES `uitgaandeleveringsstatussen` (`uitgaandeLeveringsStatusId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `veelgesteldevragenartikels`
--
ALTER TABLE `veelgesteldevragenartikels`
  ADD CONSTRAINT `fk_VeelgesteldeVragenArtikels_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `wishlistitems`
--
ALTER TABLE `wishlistitems`
  ADD CONSTRAINT `fk_WishListItems_Artikelen1` FOREIGN KEY (`artikelId`) REFERENCES `artikelen` (`artikelId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_WishListItems_GebruikersAccounts1` FOREIGN KEY (`gebruikersAccountId`) REFERENCES `gebruikersaccounts` (`gebruikersAccountId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER $$
--
-- Gebeurtenissen
--
CREATE DEFINER=`root`@`localhost` EVENT `InkomendeLeveringElkeDag` ON SCHEDULE EVERY 1 DAY STARTS '2026-03-27 11:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
declare magazijnPlaatsIdValue int;
declare artikelIdValue int;
declare voorraadValue int;
declare maxAantalInMagazijnPlaatsValue int;
declare aantalInMagazijnPlaatsValue int;
insert into EventWachtrijArtikelen (artikelId, aantal, maxAantalInMagazijnPlaats) 
select artikelid, bestelpeil - voorraad, maxAantalInMagazijnPlaats 
from Artikelen 
where voorraad < minimumVoorraad and aantalBesteldLeverancier = 0;
insert into EventWachtrijArtikelen (artikelId, aantal, maxAantalInMagazijnPlaats) 
select artikelid, aantalBesteldLeverancier, maxAantalInMagazijnPlaats 
from Artikelen 
where voorraad < minimumVoorraad and aantalBesteldLeverancier > 0;
update Artikelen set voorraad = bestelpeil
where voorraad < minimumVoorraad and aantalBesteldLeverancier = 0 and artikelId>0;
update Artikelen set voorraad = voorraad + aantalBesteldLeverancier, aantalBesteldLeverancier = 0 
where voorraad < minimumVoorraad and aantalBesteldLeverancier > 0  and artikelId>0;
SET magazijnPlaatsIdValue = 1;
SET artikelIdValue=1;
WHILE ((magazijnPlaatsIdValue <= (select count(*) from MagazijnPlaatsen)) and (artikelIdValue <= (select count(*) from Artikelen))) DO
	SET voorraadValue = (select aantal from EventWachtrijArtikelen where artikelId=artikelIdValue);
	SET maxAantalInMagazijnPlaatsValue  = (select maxAantalInMagazijnPlaats from Artikelen where artikelId=artikelIdValue);
	WHILE (voorraadValue>0) and (magazijnPlaatsIdValue <= (select count(*) from MagazijnPlaatsen)) and 
          (artikelIdValue <= (select count(*) from Artikelen)) do
		  set aantalInMagazijnPlaatsValue = (select aantal from MagazijnPlaatsen where magazijnPlaatsId=magazijnPlaatsIdValue);
            if (aantalInMagazijnPlaatsValue=0) then
                select voorraadValue;
				if (voorraadValue < maxAantalInMagazijnPlaatsValue) then
					update MagazijnPlaatsen set artikelId=artikelIdValue, aantal=voorraadValue 
						where magazijnPlaatsId=magazijnPlaatsIdValue;
					set voorraadValue = 0;
				else
					update MagazijnPlaatsen set artikelId=artikelIdValue, aantal=maxAantalInMagazijnPlaatsValue 
                       where magazijnPlaatsId=magazijnPlaatsIdValue;
					set voorraadValue = voorraadValue - maxAantalInMagazijnPlaatsValue;            
				end if;
			end if;
            set  magazijnplaatsidValue = magazijnplaatsidValue + 1;          
        end while;
	set artikelidValue = artikelidValue + 1;
END WHILE;
delete from EventWachtrijArtikelen where artikelId>0;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `VerwijderVervallenActiecodesElkeDag` ON SCHEDULE EVERY 1 DAY STARTS '2026-03-27 08:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
delete from prulariacom.Actiecodes where actiecodeId>0 and geldigTotDatum < current_date();
END$$

CREATE DEFINER=`root`@`localhost` EVENT `UitgaandeLeveringElkeDag` ON SCHEDULE EVERY 1 DAY STARTS '2026-03-27 10:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
update Bestellingen set bestellingsStatusId = 6 
where bestelId = (select bestelId from UitgaandeLeveringen 
                  where vertrekDatum < current_date() and uitgaandeLeveringsStatusId = 1);
update UitgaandeLeveringen
set uitgaandeLeveringsStatusId = 2, aankomstDatum=current_date() 
where vertrekDatum < current_date() and uitgaandeLeveringsStatusId = 1;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
