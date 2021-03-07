# H4
### Yhteenveto

Koodaa ja julkaise uusi tietokantaa hyödyntävä weppipalvelu

Tämän tehtävän pohjalle kopion taasen ohjelmakoodin suoraan seuraavalta sivulta: https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php . Tietoinen valinta, jonka taustalla oli halu keskittyä toiminnallisuuksien oppimiseen versus javascriptin/html/css hinkkaamisen sijaan. Vaikkakin jouduin sitä joka tapauksessa tekemään, sillä tässä tehty uusi sovellus eroaa alkuperäisestä toteutuksesta jonkin verran. Ohjelmassa lisätään, muokataan ja katsotaan ruoka reseptejä. Sovelluksessa on myös randomointi nappi, joka valitsee randomilla tietokannasta jonkun entryn.

MySQL asennus ja konfigurointi
```bash
$ sudo apt install -y mysql-server
$ sudo mysql_secure_installation
```

Loin tietokannan reseptejä varten
```bash
mysql> CREATE DATABASE recipes;
```

Tein sql skriptin, jossa luotiin kaksi taulukkoa juuri luotuun tietokantaan. (Toinen taulukko ‘jalkiruoka’ on luotu sovelluskehitystä varten, mutta on tämän toteutuksen ulkopuolella):

![tables](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_4/tables.png)


Ajoin sen komennolla:
```bash
mysql> source /var/www/html3/recipes.sql;
```

Loin käyttäjän jj, annoin sille oikeuksia ja jatkoin sillä sovelluksen konfigurointia. Aiemmassa tehtävässä oikeudet oli annettu kaikkiin tietokantoihin ja tauluihin, nyt luvitettu taulukko kerrallaan.

```bash
$ sudo mysql
$ CREATE USER jj@localhost IDENTIFIED BY ‘salasana’; // Salasana on poistettu tehtävästä
$ GRANT ALL on recipes.* TO jj@localhost WITH GRANT OPTION;
```


Muokkasin /etc/hosts tiedostoon 127.0.1.3 recipes.com. Kopioin /etc/apache2/sites-available/000-default.conf tiedoston /etc/apache2/sites-available/recipes.com.conf ja lisäsin Server Name recipes.com:in ja DocumentRoot /var/www/html3

Käynnistin apachen uudelleen, jotta konfiguroinnit tulivat voimaan
```bash
$ sudo systemctl restart apache2
```

Loin seuraavat tiedostot sivujen ohjeiden mukaan ja lisäsin /var/www/html3 kansioon
Index.php = Sovelluksen etusivu, josta näkyy tietueet listattuna ja niitä pääsee muokkaamaan, 
Config.php = pitää sisällään tietokantaan kirjautumistiedot
Create.php = tietueiden luonti sivu eli reseptien lisäys tietokantaan
Read.php = Sivu, jolla tietueita pääsee tarkastelemaan
Update.php = Sivu, jolla tietoa pystyy päivittämään
Delete.php = Svu, jolla tietueen poisto tehdään
Error.php = Sivu, johon sovellus vie mikäli sovelluksen käytössä käy virhe

Testasin sivua recipes.com. Sivu oli tyhjä, koska tietokannassa ei ole vielä dataa. Navigoin ruokien lisäys sivulle ja testasin listan toimintoja.

Ruokien lisäys onnistui hyvin, mutta linkit resepteihin näkyivät vain tekstinä eikä hyperlinkkeinä. Muokkasin linkit näkymään index.php ja read.php sivuille näkymään hypelinkkeinä seuraavasti:
```bash
echo "<td> <a href='" . $row['link'] . "'>" . $row['link'] . "</a> </td>";
```

Tämän jälkeen lisäsin random.php sivun. Randomisointiin vaadittavaa koodia piti opiskella ja työstää hetken, sillä yleisin käyttö randomisaattorille on echo staattisten numeroarvojen väliltä. Nyt tarpeena oli randomisoida tietystä tietokannasta ja taulukosta kaikkien tietueiden väliltä yksi. 

```bash
$query = "SELECT * FROM `paaruoka` ORDER BY RAND() Limit 1";  
$result = mysqli_query($link, $query);
```

Kun sain toiminnallisesti sivun toimimaan halutusti, muokkasin sivujärjestystä vastaamaan paremmin käyttötarkoitusta. Etusivulla on randomisointi nappi, joka vie uudelle sivulle jossa haetaan vaihtoehto tietokannasta löytyvistä ruokaohjeista. Randomisointi sivulla on myös napit, jolla pääsee listaamaan kaikki tietueet kannasta sekä  lisäämään uuden.

![recipes_rand](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_4/recipes_rand.png)



![recipes_list](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_4/recipes_list.png)





#### Lähteet:
https://www.php.net/manual/en/tutorial.php 
https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php 


