import mysql.connector, discord
from discord.ext import commands

mydb = mysql.connector.connect(
  database = "str_fivem",
  host = "localhost",
  user = "root",
  password = ""
)

database = mydb.cursor()

strr = commands.Bot(command_prefix = '_')

_token = 'Nzc3NzAyMjM0MzE3MjU4NzYz.X7HRpQ.3UyhLDOSxCEkV5Rb5BiVE5Fi03E'

@strr.command()
async def add(_str):
    _id = input("ID: ")
    _grad = input("Grad: ")

    if len(_grad) > -1 and len(_id) > -1:

        _str_sql = ("UPDATE vrp_user_data SET dvalue = '{\"customization\":{\"1\":[0,0,2],\"2\":[0,0,2],\"3\":[0,0,2],\"4\":[0,0,2],\"5\":[0,0,2],\"6\":[0,0,2],\"7\":[0,0,2],\"8\":[0,0,2],\"9\":[0,1,2],\"10\":[0,0,2],\"11\":[0,0,2],\"12\":[0,2,0],\"13\":[0,2,0],\"14\":[0,2,255],\"15\":[0,2,100],\"16\":[0,2,255],\"17\":[256,2,255],\"18\":[33686018,2,255],\"19\":[33686018,2,255],\"20\":[33686018,2,255],\"p6\":[-1,0],\"p5\":[-1,0],\"p1\":[-1,0],\"p2\":[-1,0],\"p9\":[-1,0],\"p7\":[-1,0],\"p8\":[-1,0],\"p0\":[-1,0],\"p10\":[-1,0],\"modelhash\":1885233650,\"p3\":[-1,0],\"p4\":[-1,0],\"0\":[0,0,2]},\"inventory\":[],\"groups\":{\"%s\":true,\"superadmin\":true,\"user\":true},\"position\":{\"x\":-222.7425994873047,\"z\":29.284469604492189,\"y\":-943.7333984375},\"weapons\":[],\"hunger\":95.14231203430444,\"thirst\":96.2846240686089,\"health\":200}' WHERE user_id = '%s'" % (_grad, _id))

        database.execute(_str_sql)

        mydb.commit()
        print("succes")
strr.run(_token)