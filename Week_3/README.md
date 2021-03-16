Tämä tehtävä on tehty 26.1. Samsung Series 5 Notebookilla, käyttöjärjestelmänä Ubuntu 18.04 LTS

# H3
### Yhteenveto
Apache on monikäyttöinen ja selkeä kunhan oppii logiikan sekä käyttää riittävästi aikaa asioiden tutkimiseen ennen tekemiseen ryhtymistä. Websivujen konfigurointi on todella helppoa ja pienellä vaivalla niistä saa tehtyä jopa siistin näköiset. Tietokannat ovat myös mielenkiintoisia ja niiden avulla voi tehdä vaikka mitä. Tietoturva on äärettömän tärkeä muistaa, vaikka säilytettävät tiedot eivät olisikaan henkilötietoja (#Vastaamo). Se onkin seuraava opiskeltava kohde, tähän tehtävään en kerennyt siihen tutustua.

## Table of contents
- [Yhteenveto]
- [a)Apachen asennus ja käyttäjän kotisivut]
- [c) PHP koodi virheen analysointi lokista]
- [f) Flask]
- [n) Samaan IP-osoitteeseen toisen sivun lisäys]
- [m) Apachen oletussivun muuttaminen]
- [j&g) CRUD ohjelma käyttäen MySQL]
### a) Apachen asennus ja käyttäjän kotisivut
Asensin Apachen ja enabloin käyttäjähakemistot
```bash
$ sudo apt-get install -y apache2
$ sudo a2enmod userdir
```

Käynnistin apachen uudelleen, jotta konfiguroinnit tulivat voimaan
```bash
$ sudo systemctl restart apache2
```
Modifioin käyttäjäsivuja lisäämällä siihen hieman tekstiä
```bash
$ mkdir public_html
$ nano index.html
```
![web](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/apache_web.png)


### c) PHP koodi virheen analysointi lokista
Jotta voin luoda virheen koodiin, täytyi minun asentaa PHP ja luoda jokin koodi sivulle.
```bash
$ sudo apt install php libapache2-mod-php
```

Käynnistin apachen uudelleen, jotta konfiguroinnit tulivat voimaan
```bash
$ sudo systemctl restart apache2
```
Loin yksinkertaisen PHP koodinpätkän. Random numero generaattori, joka kertoo kiinnostukseni määrän maailmaa kohtaan sinä kyseisenä hetkenä.

![PHPsofta](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/PHP_komento.png)


Tein siihen kirjoitusvirheen, joka aiheutti web-selaimella sivun “tyhjentymisen” ja  näkyi lokissa seuraavasti:

![phperror](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/php_error.png)

### f) Flask
Asennetaan Python3 venv
```bash
$ sudo apt get install -y python-pip
$ sudo apt get install -y python3-venv
$ sudo apt get install -y python3-flask
```
Tein valmistelevat toimet, loin tarvittavat kansiot, aktivoin ympäristön ja asensin flaskin
```bash
$ sudo python3 -m venv testi
$ . testi/bin/activate
$ pip install -y flask
```

Tein simppelin Flask sovelluksen, joka moikkaa maailmalle.
![flask](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/Flask.png)


Kerroin terminaalille mikä sovellus on kyseessä ja testasin toimivuutta
```bash
$ export FLASK_APP=hello.py
$ flask run
 * Serving Flask app "hello"
 * Running on http://127.0.0.1:5000/
```

Tein toisen yksinkertaisen sovelluksen, joka laskee elossaolo ajan päivissä.

![elinikä](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/elinik%C3%A4.png)
 

### n) Samaan IP-osoitteeseen toisen sivun lisäys 

/etc/hosts tiedostoon lisäsin jj.com 

![hosts](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/hosts.png)


/etc/apache2/sites-available/000-default.conf lisätty 

![virtualhost](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/jj.com.png)


Loin kansion /var/www/html2 ja lisäsin sinne index.html tiedoston

![jjcomsivu](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/jj.com_sivu.png)

### m) Apachen oletussivun muuttaminen
Kopioin /var/www/html/index.html tiedoston ja vein sen jj käyttäjän kotihakemistoon /home/jj/public_html/index.html. 

![oletus](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/oletus.png)

Muokkasin /var/www/html/index.html tiedostoa, jotta se näyttää erilaiselta. 
Nyt oletussivua pystyy myös muokkaamaan ilman sudo oikeuksia sillä se sijaitsee nyt käyttäjän kansion alla.

![local](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/local.png)

### j&g) CRUD ohjelma käyttäen MySQL ja LAMP
Tämän tehtävän ohjelmakoodin kopioin suoraan seuraavalta sivulta: https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php  . Tietoinen valinta, jonka taustalla oli halu keskittyä toiminnallisuuksien oppimiseen versus javascriptin/html/css hinkkaamisen sijaan. Ohjelmassa lisätään, muokataan ja katsotaan työntekijöiden nimi, osoite ja palkkatietoja.

MySQL asennus ja konfigurointi
```bash
$ sudo apt install -y mysql-server
$ sudo mysql_secure_installation
```

Loin käyttäjän JJ ja annoin useita oikeuksia kaikkiin tietokantoihin ja tauluihin
```bash
$ sudo mysql
$ CREATE USER jj@localhost IDENTIFIED BY ‘salasana’;
$ GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO jj@localhost WITH GRANT OPTION;
```

Loin taulukon työntekijöiden tietoja varten juuri luodulla tunnuksella
```bash
mysql> CREATE TABLE employees (
    ->     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ->     name VARCHAR(100) NOT NULL,
    ->     address VARCHAR(255) NOT NULL,
    ->     salary INT(10) NOT NULL
    -> );
```
Loin tarvittavat tiedostot sivujen ohjeiden mukaan ja lisäsin /var/www/html2 kansioon

Muokkasin /etc/hosts tiedostoon 127.0.1.2 tyontekijat.com ja lisäsin /etc/apache2/sites-available/000-default.conf työntekijat.com ja DocumentRoot /var/www/html2  

Käynnistin apachen uudelleen, jotta konfiguroinnit tulivat voimaan
```bash
$ sudo systemctl restart apache2
```

Testasin sivua tyontekijat.com sivua. Sivu oli tyhjä, koska tietokannassa ei ole vielä dataa. Kokeilin seuraavaksi ‘Lisää uusi työntekijä’, mutta sivu oli täysin tyhjä ilman täytettävää lomaketta. Jostain syystä config.php sisältö rikkoi sivun. Lisäsin sivun koodiin virheilmoitusten näyttämisen, jonka perusteella lähdin korjaamaan tilannetta.
```bash
 error_reporting(E_ALL | E_STRICT);  
ini_set('display_startup_errors',1);  
ini_set('display_errors',1);
```

Google auttoi, sen verran, että huomasin mysqli moduulin puuttuvan. 
```bash
$ sudo apt install php-mysqli
```
Tämän jälkeen lomake näkyi sivulla, mutta sivulla oli myös virheilmoitukset:
```bash
Warning: mysqli_select_db() expects parameter 1 to be mysqli, string given in /var/www/html2/create.php on line 17

Warning: mysqli_set_charset() expects parameter 1 to be mysqli, string given in /var/www/html2/create.php on line 18
```
Kun kokeilin lisätä työntekijän tuli vielä yksi virhe:
```bash
Warning: mysqli_stmt_close() expects parameter 1 to be mysqli_stmt, boolean given in /var/www/html2/create.php on line 74
```

Kun kävin virheilmoitusten osoittamia parametrejä läpi, huomasin virheen koodissa:

![error](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/error2.png)

Korjasin tilanteen:

![error2](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/error.png)

Nyt sivut toimivat halutusti. Etusivulla näkyy taulukkona työntekijät, taulukosta voit valita; Näytä, muokkaa tai poista. Oikealla ylhäältä pääsee lisäämään uuden työntekijän.
![toimiva](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_3/toimiva.png)


#### Lähteet:

https://flask.palletsprojects.com/en/1.1.x/installation/#install-flask 
https://www.php.net/manual/en/tutorial.php 
https://www.codespeedy.com/calculate-age-in-days-from-date-of-birth-in-python/ 
https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04 
https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php 


