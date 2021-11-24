import mysql.connector, discord, os, time, subprocess
from discord.ext import commands

mydb = mysql.connector.connect(
  database = "str_fivem",
  host = "localhost",
  user = "root",
  password = ""
)

database = mydb.cursor()

strr = commands.Bot(command_prefix = '_')

@strr.event
async def on_ready():
    await strr.change_presence(activity=discord.Game(name="Support > str,#0001"))

_token = 'Nzc3NjUyNzUzNTY4NDk3NzE1.X7GjkA.ARgWXU2ZhtCMR7keZCE6i-CZ2qQ'

def p(text):
  print(text)

@strr.command()
async def ban(banned, idb):
  idb = input('Esti sigur?: ')
  banned = input('ID-ul decedatului: ')

  if idb == "Da" and len(banned) > -1:
    idb = "1"
    p("Succes")

    str_sql = ("UPDATE vrp_users SET banned = '%s' WHERE id = %s" % (idb, banned))
    database.execute(str_sql)

    mydb.commit()
  else:
    p("failed")
    return banned

@strr.command()
async def unban(unbanned, idb):
  idb = input('Esti sigur?: ')
  unbanned = input('ID-ul decedatului: ')

  if idb == "Da" and len(unbanned) > -1:
    idb = "0"
    p("Succes")

    str_sql = ("UPDATE vrp_users SET banned = '%s' WHERE id = %s" % (idb, unbanned))
    database.execute(str_sql)

    mydb.commit()
  else:
    p("failed")
    return unbanned

@strr.command()
async def deschide(ctx):
  subprocess.Popen('C:\\Users\\sstru\\Desktop\\_str_framework\\!start.cmd')

@strr.command()
async def inchide(ctx):
  os.system("TASKKILL /F /IM cmd.exe") and os.system("TASKKILL /F /IM FXserver.exe")

strr.run(_token)