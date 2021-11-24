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
        console.log(`[str_ban] -- Totul merge perfect!`)
        _str.commands.set(props.help.name, props);
    });
});

_str.on("ready", () => {
    console.log(`[str_ban] -- Este activ!`);
    _str.user.setPresence({
        game: {
            name: "Sclavul lui 'str,'",
            type: 0
        }
    });
});

_str.on("message", async message => {

    if (message.channel.type === "dm") return;

    let prefix = config.prefix;
    let messageArray = message.content.split(" ");
    let command = messageArray[0].toLowerCase();
    let args = messageArray.slice(1);

    if (!command.startsWith(prefix)) return;

    let cmd = _str.commands.get(command.slice(prefix.length));
    if (cmd) cmd.run(_str, message, args);

});

_str.login(config.token); 