import cx_Oracle
import random

cx_Oracle.init_oracle_client(lib_dir=r"instantclient_19_11")

username="matrnr"
password="your_pswd" 
con_string="oracle19.cs.univie.ac.at:1521/orclcdb"

def selectAllLogisitikzentrum():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Logistikzentrum")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllLagerhalle():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Lagerhalle")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllArtikel():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Artikel")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllLieferant():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Lieferant")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllMitarbeiter():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Mitarbeiter")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllLagermitarbeiter():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Lagermitarbeiter")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllVerwaltungsmitarbeiter():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from Verwaltungsmitarbeiter")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllWirdGelagertIn():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from WirdGelagertIn")
            result = cursor.fetchall();
            connection.commit()
    return result

def selectAllWirdGeliefertVon():
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.execute("select * from WirdGeliefertVon")
            result = cursor.fetchall();
            connection.commit()
    return result

def insertNewLogistikzentrum(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Logistikzentrum(name, ort, plz, strasse, hausnummer) values(:1, :2, :3, :4, :5)", data)
            connection.commit()

def insertNewMitarbeiter(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Mitarbeiter(vorname, nachname, geburtsdatum, personalnummer, logistikzentrumid) values(:1, :2, TO_DATE(:3,'YYYY-MM-DD'), :4, :5)", data)
            connection.commit()

def insertNewLagermitarbeiter(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Lagermitarbeiter(id, beginnarbeitsverhaeltnis, arbeitsstundenanzahl, vorgesetzterid) values(:1, TO_DATE(:2,'YYYY-MM-DD'), :3, :4)", data)
            connection.commit()

def insertNewVerwaltungsmitarbeiter(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Verwaltungsmitarbeiter(id, lohn, steuerklasse) values(:1, :2, :3)", data)
            connection.commit()

def insertNewLagerhalle(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Lagerhalle(logistikzentrumid, lagerhallennummer, lagerhallenhoehe, lagerflaeche) values(:1, :2, :3, :4)", data)
            connection.commit()

def insertNewArtikel(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Artikel(artikelnummer, produktbezeichnung) values(:1, :2)", data)
            connection.commit()

def insertNewLieferant(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into Lieferant(name, ort, plz, strasse, hausnummer) values(:1, :2, :3, :4, :5)", data)
            connection.commit()

def insertNewWirdGelagertIn(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into WirdGelagertIn(zentrumid, hallennummer, artikelidentifier, menge) values(:1, :2, :3, :4)", data)
            connection.commit()

def insertNewWirdGeliefertVon(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("insert into WirdGeliefertVon(artikelid, lieferantid) values(:1, :2)", data)
            connection.commit()

def updateLagermitarbeiterSetVorgesetzter(data):
    with cx_Oracle.connect(user=username, password=password, dsn=con_string, encoding="UTF-8") as connection:
        with connection.cursor() as cursor:
            cursor.executemany("update Lagermitarbeiter set vorgesetzterid = :1 where id = :2", data)
            connection.commit()
