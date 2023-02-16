import dbHandler
import random
import datetime
from faker import Faker

fake = Faker("de_AT")
userInput = "";

def insertLogistikzentrum(amount):
    data = list()
    while amount > 0:
        amount -= 1
        data.append(("Logisikzentrum-" + fake.word(), fake.city_name(), fake.postcode(), fake.street_name(), random.randint(1,999)))
    dbHandler.insertNewLogistikzentrum(data)
    print("Logistikzentrum insertion completed!")
    

def insertMitarbeiter(amount):
    data = list()
    listLogisitikzentrumid = [x[0] for x in dbHandler.selectAllLogisitikzentrum()]
    if len(listLogisitikzentrumid) == 0:
        raise IOError("The table Logistikzentrum is empty!")
    
    personalnummer = random.randint(10000000,99999999)
    takenPersonalID = [x[4] for x in dbHandler.selectAllMitarbeiter()]

    while amount > 0:
        amount -= 1
        while personalnummer in takenPersonalID:
            personalnummer = random.randint(10000000,99999999)
        takenPersonalID.append(personalnummer)
        data.append((fake.first_name(), fake.last_name(), fake.date(), str(personalnummer), str(random.choice(listLogisitikzentrumid))))
    dbHandler.insertNewMitarbeiter(data)
    print("Mitarbeiter insertion completed!")

def insertLagermitarbeiter(amount):
    data = list()
    insertMitarbeiter(amount)
    highestid = int(max([x[0] for x in dbHandler.selectAllMitarbeiter()]))
    for i in range(1,amount+1):
        data.append((str(highestid-i), fake.date_between('-10y','today').strftime('%Y-%m-%d'), str(random.randint(6,40)), None))
    dbHandler.insertNewLagermitarbeiter(data)
    vorgesetzterUntergebenerList = list()
    vorgesetzte = random.sample(data, (round(len(data)*0.1)))
    untergebene = [x for x in data if x not in vorgesetzte]
    anzahlUntergebenerProVorgesetzter = len(untergebene) // len(vorgesetzte)
    for i, vorgesetzter in enumerate(vorgesetzte):
        start = i * anzahlUntergebenerProVorgesetzter
        end = start + anzahlUntergebenerProVorgesetzter
        ausgewaehlteUntergebene = untergebene[start:end]
        listOfTuples = [(vorgesetzter[0], x[0]) for x in ausgewaehlteUntergebene]
        vorgesetzterUntergebenerList.extend(listOfTuples)
    dbHandler.updateLagermitarbeiterSetVorgesetzter(vorgesetzterUntergebenerList)
    print("Lagermitarbeiter insertion completed!")

def insertVerwaltungsmitarbeiter(amount):
    data = list()
    insertMitarbeiter(amount)
    highestid = int(max([x[0] for x in dbHandler.selectAllMitarbeiter()]))
    for i in range(1,amount+1):
        data.append((str(highestid-i),'{:.2f}'.format(random.uniform(100, 8000)), random.randint(0,6)))
    dbHandler.insertNewVerwaltungsmitarbeiter(data)
    print("Verwaltungsmitarbeiter insertion completed!")

def insertLagerhalle(amount):
    data = list()
    logistikzentrumidlist = [x[0] for x in dbHandler.selectAllLogisitikzentrum()]
    logistikzentrumid = random.choice(logistikzentrumidlist)
    lagerhallennummer = random.randint(0,999)
    listLagerhallen = ([(x[0],x[1]) for x in dbHandler.selectAllLagerhalle()])
    while amount > 0:
        amount -= 1
        while (logistikzentrumid, lagerhallennummer) in listLagerhallen:
            logistikzentrumid = random.choice(logistikzentrumidlist)
            lagerhallennummer = random.randint(0,999)
        listLagerhallen.append((logistikzentrumid,lagerhallennummer))
        data.append((str(logistikzentrumid), str(lagerhallennummer), str('{:.1f}'.format(random.uniform(4, 20))), str('{:.2f}'.format(random.uniform(50, 1500)))))
    dbHandler.insertNewLagerhalle(data)
    print("Lagerhallen insertion completed!")

def insertArtikel(amount):
    data = list()
    artikelnummer = random.randint(1000000000,9999999999)
    takenArtikelnummer = ([x[1] for x in dbHandler.selectAllArtikel()])
    while amount > 0:
        amount -= 1
        while artikelnummer in takenArtikelnummer:
            artikelnummer = random.randint(1000000000,9999999999)
        takenArtikelnummer.append(artikelnummer)
        data.append((artikelnummer, fake.word()))
    dbHandler.insertNewArtikel(data)
    print("Artikel insertion completed!")

def insertLieferant(amount):
    data = list()
    while amount > 0:
        amount -= 1
        data.append((fake.company(), fake.city_name(), fake.postcode(), fake.street_name(), random.randint(1,999)))
    dbHandler.insertNewLieferant(data)
    print("Lieferant insertion completed!")

def insertWirdGelagertIn(amount):
    data = list()
    lagerhallen = [(x[0],x[1]) for x in dbHandler.selectAllLagerhalle()]
    randomEntry = random.choice(lagerhallen)
    zentrumid = randomEntry[0]
    hallennummer = randomEntry[1]
    artikelList = ([x[0] for x in dbHandler.selectAllArtikel()])
    artikelidentifier = random.choice(artikelList)
    wirdGelagertInList = ([(x[0],x[1],x[2]) for x in dbHandler.selectAllWirdGelagertIn()])
    if len(artikelList) == 0:
        raise IOError("The table Artikel is empty!")

    while amount > 0:
        amount -= 1
        while(zentrumid, hallennummer, artikelidentifier) in wirdGelagertInList:
            artikelidentifier = random.choice(artikelList)
            randomEntry = random.choice(lagerhallen)
            zentrumid = randomEntry[0]
            hallennummer = randomEntry[1]
        wirdGelagertInList.append((zentrumid, hallennummer, artikelidentifier))
        data.append((zentrumid, hallennummer, artikelidentifier, random.randint(1,50000)))
    dbHandler.insertNewWirdGelagertIn(data)
    print("WirdGelagertIn insertion completed!")

def insertWirdGeliefertVon(amount):
    data = list()
    artikelList = ([x[0] for x in dbHandler.selectAllArtikel()])
    artikelid = random.choice(artikelList)
    lieferantenList = ([x[0] for x in dbHandler.selectAllLieferant()])
    lieferantid = random.choice(lieferantenList)
    takenWirdGeliefertVon = ([(x[0],x[1]) for x in dbHandler.selectAllWirdGeliefertVon()])
    while amount > 0:
        amount -= 1
        while(artikelid, lieferantid) in takenWirdGeliefertVon:
            artikelid = random.choice(artikelList)
            lieferantid = random.choice(lieferantenList)
        takenWirdGeliefertVon.append((artikelid, lieferantid))
        data.append((artikelid, lieferantid))
    dbHandler.insertNewWirdGeliefertVon(data)
    print("WirdGeliefertVon insertion completed!")

def doYourThing(amount):
    print("--------------------------")
    print("DoYourThing has been started!")
    insertLogistikzentrum(amount)
    insertMitarbeiter(amount)
    insertLagermitarbeiter(amount)
    insertVerwaltungsmitarbeiter(amount)
    insertLagerhalle(amount)
    insertArtikel(amount)
    insertLieferant(amount)
    insertWirdGelagertIn(amount)
    insertWirdGeliefertVon(amount)
    print("DoYourThing has been done!")
    print("--------------------------")


print("DATA INSERTER TOOL")
print("------------------")
print("Use the following command in order to add new entries to the specified table:")
print("insert [TableName] [Amount]")
print("Type 'do your thing [Amount]' to perform all inserts!")
print("Exit the data inserter tool by writing 'exit'!")
print("The following tables are available:")
print("Logistikzentrum | Mitarbeiter | Lagermitarbeiter | Verwaltungsmitarbeiter")
print("Lagerhalle | Artikel | Lieferant | WirdGelagertIn | WirdGeliefertVon")
while userInput != "exit":
    userInput = input()
    separatedInput = userInput.split(" ")
    for entry in separatedInput:
        if entry.startswith("-"):
            raise ValueError("The number can't be negative!")
    
    if(len(separatedInput) == 3 and separatedInput[2].isnumeric()):
        match separatedInput[1]:
            case "Logistikzentrum":
                insertLogistikzentrum(int(separatedInput[2]))
            case "Mitarbeiter":
                insertMitarbeiter(int(separatedInput[2]))
            case "Lagermitarbeiter":
                insertLagermitarbeiter(int(separatedInput[2]))
            case "Verwaltungsmitarbeiter":
                insertVerwaltungsmitarbeiter(int(separatedInput[2]))
            case "Lagerhalle":
                insertLagerhalle(int(separatedInput[2]))
            case "Artikel":
                insertArtikel(int(separatedInput[2]))
            case "Lieferant":
                insertLieferant(int(separatedInput[2]))
            case "WirdGelagertIn":
                insertWirdGelagertIn(int(separatedInput[2]))
            case "WirdGeliefertVon":
                insertWirdGeliefertVon(int(separatedInput[2]))
            case _:
                print("An error occured. Please check your spelling!")
    else:
        if separatedInput[0] == "exit":
            print("See ya!")
        elif separatedInput[0] == "do" and separatedInput[1] == "your" and separatedInput[2] == "thing" and separatedInput[3].isnumeric():
            doYourThing(int(separatedInput[3]))
        else:
            print("Invalid input! Please try again!")
        



