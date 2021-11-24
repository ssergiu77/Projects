const Discord = require("discord.js")
const config = require("./config.json");
const fs = require("fs");
const _str = new Discord.Client();

_str.commands = new Discord.Collection();

_str.on('message', msg => {
    if (msg.content === 'ping') {
        let _clear = `${GetNumPlayerIndices()} masini pe server`
        msg.reply('Pong!');
    }
});

_str.login(config.token); 