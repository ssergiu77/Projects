const mysql = require("mysql");
module.exports.run = async (bot, message, args) => {
    let con = mysql.createConnection({
        host: "127.0.0.1",
        user: "root",
        password: "",
        database: "_str_js"
    })
con.connect(function(err) {
    if(err) {
        console.log('[str_ban] Eroare de conectare: ' + err.stack)
        return err;
    }

    var _ban = '1'
    var _id = args.join("")
    var _sql = `UPDATE _str_players SET banned = '${_ban}' WHERE id = '${_id}'`;
    con.query(_sql, function (err, result) {
        if (err) throw err;
        console.log (`ID-ul: ${_id} A fost banat de pe server!`)
    })
})
}

module.exports.help = {
    name: "ban"
}
