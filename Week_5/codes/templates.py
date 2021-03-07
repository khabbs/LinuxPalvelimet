from flask import Flask, render_template
app = Flask(__name__)

@app.route("/")
def templated():
	return render_template("base.html", greeting="Hello Templates!")

app.run(debug=True)
