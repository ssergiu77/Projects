
const Discord = require("discord.js")
const config = require("./config.json");
const fs = require("fs");
const _str = new Discord.Client();

_str.commands = new Discord.Collection();

fs.readdir("./comenzi/", (err, files) => {
    if (err) console.error(err);

    let arquivojs = files.filter(f => f.split(".").pop() == "js");
    arquivojs.forEach((f, i) => {
        let props = require(`./comenzi/${f}`);
        _str.commands.set(props.help.name, props);
    });
});

_str.on("ready", () => {
    console.log(`[str_ub] Este pornit!`);
    _str.user.setPresence({
        game: {
            name: "Sclavul lui 'str,'",
            type: 0
        }
    });
});

_str.login(config.token); 