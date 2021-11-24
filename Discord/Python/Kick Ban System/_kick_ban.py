import discord, mysql.connector
from discord.ext import commands
_strr = commands.Bot(command_prefix = '_')
_token = 'ODA4ODAzOTg1MTkyMTI0NDE4.YCL3aA.zufEY1VX3NlEnAkWAI5XqKsOTss'


#CONNECT DATABASE!
      

mydb = mysql.connector.connect(
  host="127.0.0.1",
  user="root",
  password="",
  database="_str_warnings"
)





_str = mydb.cursor()



#_str.execute("CREATE DATABASE _str_warnings")
# _str.execute("CREATE TABLE _warnings (_warn_id INT AUTO_INCREMENT PRIMARY KEY, _gived VARCHAR(255), _user VARCHAR(255), _reason VARCHAR(255))")




# BAN / UNBAN / KICK / WARN / UNWARN / WARNS





@_strr.command()
@commands.has_role("testing")
async def warns(ctx, member : discord.Member):
      await ctx.channel.purge(limit=1)
      def check(_reasons):
            return _reasons.author.id == ctx.author.id 

      _sql = ("SELECT _reason FROM _warnings WHERE _user ='%s'" % member.display_name)
      _str.execute(_sql)

      myresult = _str.fetchall()

      for x in myresult:
            a = discord.Embed(title= "**Warns user**:\n%s" % (x) ,color=discord.Color((0xec3b3b)))
            await ctx.send(embed=a)
    



 
@_strr.command()
@commands.has_role("testing")
async def unwarn(ctx, member : discord.Member):
      await ctx.channel.purge(limit=1)
      a = discord.Embed(title=f'**[str_bot]** Why ?',color=discord.Color((0xec3b3b)))
      await ctx.send(embed=a)
      def check(_reason):
            return _reason.author.id == ctx.author.id
      
      message = await _strr.wait_for('message', check=check)
      
      b = discord.Embed(title=f'**[str_bot]** UNWARN DELETED FROM DATABASE! **[SUCCES]**\n**[str_bot]** You have been unwarned {member}',color=discord.Color((0xec3b3b)))
      await ctx.send(embed=b)

      await member.send(f'**[str_bot]** You have been unwarned by {ctx.author.mention}! Reason: **{message.content}**')
      
      #_sql = "UPDATE _warnings SET _reason = 'Warn Clear' WHERE _user = '%s'" % member.display_name
      _sql = "DELETE FROM _warnings WHERE _user = '%s'" % member.display_name

      _str.execute(_sql)

      print(member.display_name)

      mydb.commit()

      print("succes")




@_strr.command()
@commands.has_role("testing")
async def warn(ctx, member : discord.Member):
      await ctx.channel.purge(limit=1)
      a = discord.Embed(title=f'**[str_bot]** What reason?',color=discord.Color((0xec3b3b)))
      await ctx.send(embed=a)
      
      def check(_reason):
            return _reason.author.id == ctx.author.id
      
      message = await _strr.wait_for('message', check=check)

      b = discord.Embed(title=f'**[str_bot]** WARN SAVED IN DATABASE! **[SUCCES]**\n**[str_bot]** Warn sended to {member}',color=discord.Color((0xec3b3b)))
      await ctx.send(embed=b)

      await member.send(f'**[str_bot]** You have been warned by {ctx.author.mention}! Reason: **{message.content}**')
      
      _sql = "INSERT INTO _warnings (_gived, _user, _reason) VALUES (%s, %s, %s)"
      _insert = (message.author.name, member.display_name ,message.content)

      _str.execute(_sql, _insert)

      mydb.commit()
      print("succes")




@_strr.command()
@commands.has_role("testing")
async def kick(ctx, member : discord.Member, *, reason = None, message=None, limit: int = 1):

      await ctx.channel.purge(limit=limit)

      message = f'**[str_bot]** You got kicked from the server!'
      await member.send(message)  

      await member.kick(reason=message)
      print("User kicked")




@_strr.command()
@commands.has_role("testing")
async def ban(ctx, member : discord.Member, *, reason = None, limit: int = 1):

      await ctx.channel.purge(limit=limit)

      message = f'**[str_bot]** You got banned from the server!'
      await member.send(message)

      await member.ban(reason=reason)
      
      b = discord.Embed(title=f'**[str_bot]** BANNED! **[SUCCES]**\n**[str_bot]** Account banned {member}',color=discord.Color((0xec3b3b)))
      await ctx.send(embed=b)
      print("User banned")




@_strr.command()
@commands.has_role("testing")
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




_strr.run(_token)