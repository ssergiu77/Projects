import sys,os,json,discord,re,requests,pickle,datetime,random,time,asyncio,sqlite3
from utils import log,info,error,exitfunc,clearterminal
from discord import Game,Emoji,Permissions
from discord.utils import get
from discord.ext.commands import Bot
# sys.setdefaultencoding("utf-8")

_TOKEN = "Nzc3NzEyNTczMDY3NjkwMDA2.X7HbRg.8gNbAY3e97Yd9zPzqE4jTHCkxow"
_OWNERID = 775331344317939733
_ACCESS_ROLES = [778715342520057917]
_MEMBER_COUNT_CHANNELID = 778914679925506069
_PREFIX = "_"
_DB_CON = sqlite3.connect("data.db",isolation_level=None)

# MISC

_LAST_WRNLIST_MSG = None

client = Bot(command_prefix=_PREFIX)
client.activity = discord.Activity(name="Silence Life",type=discord.ActivityType.watching)

def isAdmin(member):
	return len([i for i in _ACCESS_ROLES if i in [x.id for x in member.roles]])>0

async def generateWarnList(entries,title):
	emb = discord.Embed(color=0x0284D0,title=title)
	if len(entries)<=0:
		return discord.Embed.Empty
	for entry in entries:
		sender = await client.guilds[0].fetch_member(entry[3])
		emb.add_field(name="ID: %s | Moderator: %s#%s" % (entry[0],sender.name,sender.discriminator),value="%s - %s" % (entry[2],entry[4]),inline=False)
	return emb

class CommandArgs():
	def __init__(self, message: discord.Message):
		self.msg = message
		self.guild = message.guild
		msgr=re.search(r'\w+', message.content[1:])
		self.cmd=(msgr.group(0) if msgr!=None else "N/A")
		self.args=(message.content[(msgr.end(0) if msgr!=None else -1)+2:] if msgr!=None else "N/A")
		self.largs=re.findall(r'\b\w+\b',message.content[(msgr.end(0) if msgr!=None else -1)+2:])
		self.author=message.author
		self.channel=message.channel
		self.is_admin=isAdmin(message.author)
		self.is_owner=message.author.id==_OWNERID

	async def send(self,message="",emb=None) -> discord.Message:
		return await self.channel.send(str(message),embed=emb)

	async def reply(self,message="",emb=None) -> discord.Message:
		return await self.channel.send(self.author.mention + " -> " + str(message),embed=emb)

	async def edit(self,message="",emb=None):
		if self.author.id!=_OWNERID:
			return await self.reply(str(message),emb)
		else:
			await self.msg.edit(str(message),embed=emb)

@client.event
async def on_ready():
	info("Bot started.")
	info("Logged in as %s#%s." % (client.user.name,client.user.discriminator))
	c = _DB_CON.cursor()
	c.execute("""CREATE TABLE IF NOT EXISTS `warns` ( `id` INT NOT NULL , `userid` VARCHAR(60) NOT NULL , `reason` TEXT NOT NULL , `sender` VARCHAR(60) NOT NULL , `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`));""")
	_DB_CON.commit() # just in case lol
	c.close()

@client.event
async def on_member_join(member):
	global _MEMBER_COUNT_CHANNELID
	print("member joined %d" % client.guilds[0].member_count)
	await client.guilds[0].get_channel(_MEMBER_COUNT_CHANNELID).edit(name="Members: %d" % client.guilds[0].member_count)

@client.event
async def on_member_remove(member):
	global _MEMBER_COUNT_CHANNELID
	print("member removed %d" % client.guilds[0].member_count)
	await client.guilds[0].get_channel(_MEMBER_COUNT_CHANNELID).edit(name="Members: %d" % client.guilds[0].member_count)

@client.command()
async def kick(ctx,member : discord.Member, *, reason = None, message=None, limit: int = 1):

	await ctx.channel.purge(limit=limit)

	message = f'**[str_bot]** You got kicked from the server!'
	await member.send(message)  

	await member.kick(reason=message)
	print("User kicked")

@client.command()
async def ban(ctx, member : discord.Member, *, reason = None, limit: int = 1):

	await ctx.channel.purge(limit=limit)

	message = f'**[str_bot]** You got banned from the server!'
	await member.send(message)

	await member.ban(reason=reason)
	
	b = discord.Embed(title=f'**[str_bot]** BANNED! **[SUCCES]**\n**[str_bot]** Account banned {member}',color=discord.Color((0xec3b3b)))
	await ctx.send(embed=b)
	print("User banned")

@client.command()
async def unban(ctx, *, member, limit: int = 1):
      await ctx.channel.purge(limit=limit)
      banned_users = await ctx.guild.bans()
      member_name, member_discriminator = member.split('#')

      for ban_entry in banned_users:
            user = ban_entry.user
            
            if (user.name, user.discriminator) == (member_name, member_discriminator):
                  await ctx.guild.unban(user)
                  b = discord.Embed(title=f'**[str_bot]** UNBANNED! **[SUCCES]**\n**[str_bot]** You unbanned: {member}',color=discord.Color((0xec3b3b)))
                  await ctx.send(embed=b)

                  print("User Unbanned")
                  return


@client.command()
async def warn(ctx, self, message: discord.Message):
	if ctx.is_admin:
		if len(ctx.msg.mentions)>0:
			if isAdmin(ctx.msg.mentions[0]) or ctx.msg.mentions[0].id==client.user.id:
				await ctx.reply("You can't warn an administrator")
			else:
				warn_trgt = ctx.msg.mentions[0]
				reason = None if len(ctx.largs)<1 else " ".join(ctx.largs[1:])
				c = _DB_CON.cursor()
				c.execute("""INSERT INTO warns(id,userid,reason,sender) VALUES((SELECT COALESCE(MAX(id)+1, 1) FROM warns),?,?,?)""",[warn_trgt.id,"No Reason" if not reason else reason,ctx.author.id])
				_DB_CON.commit() # just in case lol
				c.close()
				# await ctx.reply("%s has been warned!%s" % (warn_trgt.mention,"" if not reason else " (%s)" % reason))
				await ctx.send(emb=discord.Embed(color=0x28A745,description=":white_check_mark: **Warning logged for %s#%s** | *%s*" % (warn_trgt.name,warn_trgt.discriminator,"" if not reason else reason)))
		else:
			await ctx.reply("Usage: %skick <@mention> [reason]" % _PREFIX)
	else:
		await ctx.reply("You don't have permissions to use this command")

@client.command()
async def delwarn(ctx, self, message: discord.Message):
	self.msg = message
	self.is_admin=isAdmin(message.author)
	if ctx.is_admin:
		if len(ctx.largs)>0:
			c = _DB_CON.cursor()
			c.execute("DELETE FROM warns WHERE id = ?",[ctx.largs[0]])
			_DB_CON.commit()
			c.close()
			await ctx.reply("Removed warning ID %s" % ctx.largs[0])
		else:
			await ctx.reply("Usage: %sdelwarn <id>" % _PREFIX)
	else:
		await ctx.reply("You don't have permissions to use this command")

@client.command()
async def warns(ctx, self, message: discord.Message):
	self.msg = message
	self.is_admin=isAdmin(message.author)
	if ctx.is_admin:
		if len(ctx.msg.mentions)>0:
			warnlist_trgt = ctx.msg.mentions[0]
			c = _DB_CON.cursor()
			c.execute("""SELECT * FROM warns WHERE userid = ?""",[warnlist_trgt.id])
			res = c.fetchall()
			if len(res)>0:
				await ctx.send(emb=await generateWarnList(res,"%s warnings for %s#%s" % (len(res),warnlist_trgt.name,warnlist_trgt.discriminator)))
			else:
				await ctx.send(emb=discord.Embed(color=0x28A745,description=":white_check_mark: **No warns recorded for %s#%s**" % (warnlist_trgt.name,warnlist_trgt.discriminator)))
			c.close()
		else:
			await ctx.reply("Usage: %swarns <@mention>" % _PREFIX)
	else:
		await ctx.reply("You don't have permissions to use this command")

	if ctx.cmd in locals():
		info("Handling command %s." % ctx.cmd)
		await locals()[ctx.cmd]()

async def dm(ctx):
	async def ping():
		await ctx.reply("Pong! %sms" % (round(client.latency*1000,2)))

	if ctx.cmd in locals():
		info("Handling dm command %s." % ctx.cmd)
		await locals()[ctx.cmd]()


try:
	client.loop.run_until_complete(client.run(_TOKEN))
except (KeyboardInterrupt):
	info("Stopping bot")
	_DB_CON.close()
	client.loop.close()