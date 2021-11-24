#from utils import log,info,warn,error,exitfunc,clearterminal,CommandArgs # use in projects
import datetime,time,sys,os,re

open("last.log","w").close()
def log(logmsg):
	if not logmsg:
		return
	logf = open("last.log","a")
	logf.write(datetime.datetime.fromtimestamp(time.time()).strftime('%Y-%m-%d %H:%M:%S')+" | "+logmsg.strip("\n")+"\n")
	logf.close()

def info(infomsg):
	print("\033[94mINFO\033[0m: "+str(infomsg))
	log("INFO: "+str(infomsg))

def warn(warnmsg):
	print("\033[93mWARNING\033[0m: "+str(warnmsg))
	log("WARNING: "+str(warnmsg))

def error(errmsg, exit=False):
	print("\033[91mERROR\033[0m: "+str(errmsg))
	log("ERROR: "+str(errmsg))
	if exit:
		sys.exit()

def exitfunc(client):
	client.logout() if client else None
	info("Shutting off...")

def clearterminal():
	os.system('cls' if os.name == 'nt' else 'clear')

clearterminal()