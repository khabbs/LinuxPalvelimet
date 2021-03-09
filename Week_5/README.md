# H5
### Yhteenveto

Koodaa ja julkaise uusi tietokantaa ja lomakkeita hyödyntävä weppipalvelu

Tämän tehtävän pohjalle kopioin ohjelmakoodin suoraan seuraavalta sivulta: https://www.pythonistaplanet.com/flask-to-do-list/. Ohjelmassa lisätään, muokataan ja poistetaan tehtävälistalta tehtäviä. 

Flaskin ja tarvittavien moduulien asennus
```bash
$ sudo apt-get update
$ sudo apt-get -y install python3-flask
$ sudo pip3 install flask_sqlalchemy
```

Loin Hello World template testausta varten tarvittavat tiedostot
```bash
$ nano templates.py
$ mkdir templates
$ nano base.html
```
Testasin toteutuksen ajamista ja se toimii halutusti.

Seuraavaksi lisäsin tietokanta toiminnot koodiin ja loin todo.db tietokannan
```bash
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///todo.db'
db = SQLAlchemy(app)

class Todo(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    content = db.Column(db.String(300), nullable=False)

    def __rep__(self):
        return '<Task %r>' % self.id
```
Kun olin luomassa tietokantaa, törmäsin ongelmaan:
‘sqlalchemy.exc.OperationalError: (sqlite3.OperationalError) unable to open database file’

Troubleshoottasin ja googlailin tuota niin pitkään, että jätin tehtävän kesken pariksi päiväksi, sillä vastausta ei löytynyt. Uudelleen avattuani koodit tajusin tehneeni ne Sudo oikeuksia vaativiin kansioihin… Siirrettyäni tiedostot ja kansiot fiksumpaan paikkaan, error viesti poistui.

Seuraavaksi loin base.html koodiin mallin, jota halusin hyödyntää useammallakin sivulla. 

![base](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/base.html.png)


Loin index.html siv↓n¸ jolle periytin base.html tiedostosta mallin. Vaihdoin myös Flask app.py tiedostoon index.html sivun base.html sijaan.

![index](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/index.html.png)


Seuraavaksi loin taskeihin liittyvien toiminnallisuudet index.html sivulle sekä app.py.
![tasks](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/tasks.png)


![app.py](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/app.py.png)


Törmäsin virheilmoitukseen “NameError: name 'request' is not defined”, joka nopeasti ratkesi tuomalla puuttuva request ja redirect objekti.

```bash
from flask import request, redirect
```
Seuraavaksi kokeilin sovelluksen toimintaa ja törmäsin heti virheeseen: “jinja2.exceptions.UndefinedError: 'task' is undefined”
Googlailu ei tuottanut lisäarvoa, sillä virheilmoitus on suhteellisen selkeä. Kävin läpi tekemääni koodia ja huomasin kirjoitus virheen index.html sivulla: {% for tasks in tasks %}. Sen korjaamalla oikeaan muotoon {% for task in tasks %}, taskien lisäys onnistui. Taskin nimi ei kuitenkaan näkynyt listalla ollenkaan, update näkymässä kaikki oli ok.

![todo-list](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/todo-list.png)
![updatetask](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/updatetask.png)

Koodin läpikäymisen jälkeen, tämä kuten liian moni, oli kirjoitusvirheestä kiinni. Olin unohtanut sulkea juuri ennen taskien sisällön tuomista

```bash
<td  {{ task.content }} </td>
``` 

Lopputulos:
![todo-complete](https://github.com/khabbs/LinuxPalvelimet/blob/main/Week_5/todo-complete.png)


#### Lähteet:
https://www.pythonistaplanet.com/flask-to-do-list/
https://flask-sqlalchemy.palletsprojects.com/en/2.x/quickstart/ 
Troubleshoot kaninkolo googlaus




