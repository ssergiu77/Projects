import discord, os, subprocess
from discord.ext import commands

strr = commands.Bot(command_prefix = '_')

_token = 'Nzc1NzkzMjA4OTg5OTc0NTM4.X6rfug.ebTClB37y91fF6_QDJomrlAhkRE'

@strr.command()
async def deschide(ctx):
  subprocess.Popen('C:\\Users\\sstru\\Desktop\\_str_framework\\!start.cmd')

@strr.command()
async def inchide(ctx):
  os.system("TASKKILL /F /IM cmd.exe") and os.system("TASKKILL /F /IM FXserver.exe")

strr.run(_token)