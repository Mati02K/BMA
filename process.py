#!C:\Users\Mathesh\AppData\Local\Programs\Python\Python39\python.exe

print ("Content-type: text/html\n\n")

import cgi
import wikipedia

form=cgi.FieldStorage()

message=form.getvalue("message_py")

# print("It's Fucking working "+message)
result = wikipedia.summary(message, sentences = 2) 
print(result)




