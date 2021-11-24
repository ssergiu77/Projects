import discord, mysql.connector, random, time, socket, hashlib
from discord.ext import commands

mydb = mysql.connector.connect(
  database = "_str_framework",
  host = "localhost",
  user = "root",
  password = ""
)

database = mydb.cursor()

#database.execute("CREATE DATABASE str_register")
#database.execute("CREATE TABLE _str_login (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), password VARCHAR(255))")

a = 1
strr = commands.Bot(command_prefix = '.')


@strr.event
async def on_ready():
    await strr.change_presence( status = discord.Status, activity = discord.Game("sclavu' lu' str,"))

@strr.command()
async def str_reg(ctx):

  _info1 = await ctx.author.send("**[str_reg]** Imediat iti vei primi datele de la cont!")
  _info2 = await ctx.author.send("**[str_reg]** Fiecare persoana care se inregistreaza are un cont unic!")
  _info3 = await ctx.author.send("**[str_reg]** Support Discord >>> str,#0001 ! ")


  hostname = socket.gethostname()
  IPAddr = "127.0.0.1 02:38:08 12/11/2020"

  nickF = random.randrange(a, b)

  if nickF:
    print("Succes")
  else:
    print("Failed")
    _info4 = await ctx.author.send("A esuat creearea unui Username!")
    return nickF

  pass_un = random.randrange(a, b)

  #int = hashlib.sha256(b'%d' % pass_un)

  #pass_en = int.hexdigest()

  if pass_un:
    print("succes")

    str_sql = "INSERT INTO _str_login (username, password) VALUES (%s, %s)"
    database.execute("INSERT INTO _str_login (username, password) VALUES (%s, %s)", (nickF, pass_un))

    mydb.commit()

    print("Username: ", nickF)
    print("ID: ", database.lastrowid)
    print("password: ", pass_un)

    time.sleep(2)

    _info5 = await ctx.author.send("**Se creeaza contul!**")

    time.sleep(5)

    _info6 = await ctx.author.send("**Username: **%s" % (nickF))
    _info7 = await ctx.author.send("**ID                 :** %s" % (database.lastrowid))
    _info8 = await ctx.author.send("**Password: **%s" % (pass_un))
  else:
    print("failed")

    _info9 = await ctx.author.send("A esuat creearea unei parole!")
    
    return pass_un
b = 10000000

strr.run('Nzc1NzkzMjA4OTg5OTc0NTM4.X6rfug.Wq3ZHfyqQIASbG9KaoTWjYEjNIk')