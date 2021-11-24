const Discord = require("discord.js")
const config = require("./config.json");
const fs = require("fs");
const { join } = require("path");
const _str = new Discord.Client();

_str.commands = new Discord.Collection();

_str.on('message', message => {
    if (message.author.bot) return;
    if (message.content.indexOf(config.prefix) !== 0) return;

    const args = message.content.slice(config.prefix.length).trim().split(/ +/g);
    const command = args.shift().toLowerCase();

    switch (command) {
        case 'kick': {
            const _response = args.join(' ');
            let _marijuana = `${DropPlayer(_response, "Ai luat kick! [str_kick]")}`
            let _consola = `${print('Jucatorul cu ID-ul: ' + _response + ' a luat kick de pe server! [str_kick]')}`
            message.channel.send("Ai dat kick jucatorului cu ID-ul: " + _response);
            break;
        }
        default:
            message.channel.send('This command is unknown!');
            break;
    }
});

_str.login(config.token); 