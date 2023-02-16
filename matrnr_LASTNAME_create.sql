CREATE TABLE Logistikzentrum(
	id NUMBER GENERATED BY DEFAULT AS IDENTITY,
	name VARCHAR(50) NOT NULL,
	ort VARCHAR(50),
	plz NUMBER(5),
	strasse VARCHAR(100),
	hausnummer NUMBER(3),
	PRIMARY KEY(id),
	CHECK(hausnummer > 0)
);

CREATE TABLE Mitarbeiter(
	id NUMBER GENERATED BY DEFAULT AS IDENTITY,
	vorname VARCHAR(50) NOT NULL,
	nachname VARCHAR(50) NOT NULL,
	geburtsdatum DATE,
	personalnummer NUMBER(10) UNIQUE NOT NULL,
	logistikzentrumid NUMBER REFERENCES Logistikzentrum(id),
	PRIMARY KEY(id)
);

CREATE TABLE Lagermitarbeiter(
	id NUMBER PRIMARY KEY REFERENCES Mitarbeiter(id) ON DELETE CASCADE,	
	beginnarbeitsverhaeltnis DATE,
	arbeitsstundenanzahl FLOAT(1) DEFAULT 40,
	vorgesetzterid NUMBER REFERENCES Lagermitarbeiter(id),
	CHECK(arbeitsstundenanzahl > 0)
);

CREATE TABLE Verwaltungsmitarbeiter(
	id NUMBER PRIMARY KEY REFERENCES Mitarbeiter(id) ON DELETE CASCADE,	
	lohn FLOAT(2) NOT NULL,
	steuerklasse NUMBER(1)
);

CREATE TABLE Lagerhalle(
	logistikzentrumid NUMBER REFERENCES Logistikzentrum(id),
	lagerhallennummer NUMBER,
	lagerhallenhoehe FLOAT(2),
	lagerflaeche FLOAT(2),
	PRIMARY KEY(logistikzentrumid, lagerhallennummer),
	CHECK(lagerhallenhoehe > 0),
	CHECK(lagerflaeche > 0)
);

CREATE TABLE Artikel(
	id NUMBER GENERATED BY DEFAULT AS IDENTITY,
	artikelnummer NUMBER(10) UNIQUE NOT NULL,
	produktbezeichnung VARCHAR(250),
	PRIMARY KEY(id)
);

CREATE TABLE Lieferant(
	id NUMBER,
	name VARCHAR(250) NOT NULL,
	ort VARCHAR(50),
	plz NUMBER(5),
	strasse VARCHAR(100),
	hausnummer NUMBER(3),
	PRIMARY KEY(id),
	CHECK(hausnummer > 0)
);

CREATE TABLE WirdGelagertIn(
	zentrumid NUMBER,
	hallennummer NUMBER,
	artikelidentifier NUMBER REFERENCES Artikel(id),
	menge NUMBER,
	PRIMARY KEY(zentrumid, hallennummer, artikelidentifier),
	FOREIGN KEY(zentrumid, hallennummer) REFERENCES Lagerhalle(logistikzentrumid, lagerhallennummer),
	CHECK(menge >= 0)
);

CREATE TABLE WirdGeliefertVon(
	artikelid NUMBER REFERENCES Artikel(id),
	lieferantid NUMBER REFERENCES Lieferant(id),
	PRIMARY KEY(artikelid, lieferantid)
);

CREATE SEQUENCE seq_lieferant_id
  INCREMENT BY 1
  START WITH 1;

 CREATE OR REPLACE TRIGGER trigger_lieferant_insert
  BEFORE INSERT ON Lieferant
  FOR EACH ROW
    DECLARE
      seq_lieferant Lieferant.id%type;
    BEGIN
      SELECT seq_lieferant_id.nextval INTO seq_lieferant FROM dual;
      :new.id := seq_lieferant;
    END;
  
CREATE OR REPLACE TRIGGER check_artikelnummer_unique
BEFORE INSERT OR UPDATE ON Artikel
FOR EACH ROW
DECLARE
    PRAGMA AUTONOMOUS_TRANSACTION;
   	matching_artikelnummer INTEGER;
    artikelnummer_not_unique EXCEPTION;
BEGIN
	SELECT COUNT(*) INTO matching_artikelnummer FROM Artikel WHERE artikelnummer = :NEW.artikelnummer;
	IF matching_artikelnummer > 0 THEN
		RAISE artikelnummer_not_unique;
	END IF;
	EXCEPTION
		WHEN artikelnummer_not_unique THEN
			RAISE_APPLICATION_ERROR(-20123, 'Entered Artikelnummer already exists!');
END;

CREATE OR REPLACE PROCEDURE artikel_statistics(
	a_artikel_id IN Artikel.ID%TYPE,
	total_number OUT NUMBER,
	logistikzentrum_count OUT NUMBER
)
AS
BEGIN 
	SELECT SUM(w.menge), COUNT(DISTINCT l.LOGISTIKZENTRUMID) 
	INTO total_number, logistikzentrum_count FROM WirdGelagertIn w
	INNER JOIN Lagerhalle l
	ON w.ZENTRUMID = l.LOGISTIKZENTRUMID 
	AND w.HALLENNUMMER = l.LAGERHALLENNUMMER
	WHERE w.artikelidentifier = a_artikel_id;
	IF total_number IS NULL THEN
		total_number := 0;
	END IF;
END;
   
/* Wir wollen die Artikelnummer und die Produktbezeichnung haben,
 * zusammen mit der Anzahl der insgesamt gelagerten Artikel dieses Typs in allen Logistikzentren,
 * von denen wir mindestens 50 Stueck haben.
 */
   
CREATE VIEW ArtikelMengeView AS
SELECT a.artikelnummer, a.produktbezeichnung, SUM(w.menge) AS totaleMenge
FROM Artikel a INNER JOIN WirdGelagertIn w ON a.id = w.artikelidentifier
GROUP BY a.artikelnummer, a.produktbezeichnung
HAVING SUM(w.menge) > 50
ORDER BY SUM(w.menge) DESC;