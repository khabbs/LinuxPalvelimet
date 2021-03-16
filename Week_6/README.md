Tämä tehtävä on tehty 26.1. Samsung Series 5 Notebookilla, käyttöjärjestelmänä Ubuntu 18.04 LTS

# H6
### Yhteenveto

Tee yksinkertainen tietokantaa hyödyntävä ohjelma

Tämän tehtävän koodi on kopioitu opettajalta: https://terokarvinen.com/2020/flask-automatic-forms/. Ohjelman pohjana on ilmoittautumislomake, josta on muokattu lempieläin äänestyslomake.

Flaskin, Pwgenin ja tarvittavien moduulien asennus
```bash
$ sudo apt-get update
$ sudo apt-get -y install python3-flask
$ sudo pip3 install flask_sqlalchemy
$ pip3 install Flask-WTF
$ sudo apt install -y pwgen
```

Loin ohjelman python-tiedoston autoformed.py
```bash
$ nano autoformed.py
```
Toisessa ikkunassa samalla generoin salasanan Pwgenillä ja lisäsin sen autoformed.py tiedostoon
```bash
$ pwgen -s 30 1
```
Ajaessani ohjelmaa, tuli virheilmoitus, että moduulia email_validator:sia ei ole asennettu. Sen asentamalla pääsi eteenpäin.

```bash
$ pip3 install email-validator
```

Testasin lopuksi lomakkeen täyttöä ja onnistuihan se!

![ilmo](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_6/photos/ilmo.png)


Tämän jälkeen muokkasin tuon ohjelman lempieläin äänestystä varten olevaksi lomakkeeksi. Uusin autoformed.py koodiin uuden tietokannan ja salasanan. Muokkasin myös lomakkeella kysytyt tiedot sekä sen mikä tieto tietokannasta sivulle tulostetaan. Muokatut kohdat löytyy koodeista: 

![lempieläin](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_6/photos/lempieläin.png)


#### Lähteet:
https://terokarvinen.com/2020/flask-automatic-forms/





