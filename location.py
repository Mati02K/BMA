#!C:\Users\Mathesh\AppData\Local\Programs\Python\Python39\python.exe

print ("Content-type: text/html\n\n")

import requests
import webbrowser
import cgi
import wikipedia

form=cgi.FieldStorage()

message=form.getvalue("message_py")

# message="Hospitals"

res = requests.get('https://ipinfo.io/')
data = res.json()

city = data['city']
region =data['region']

location = data['loc'].split(',')
latitude = location[0]
longitude = location[1]

print("Your Latitude : ", latitude)
print("Your Longitude : ", longitude)
print("Your City : ", city)


webbrowser.open("https://www.google.com/maps/search/"+message+"/@"+latitude+","+longitude)
print("Your Requested Details are open in Map")