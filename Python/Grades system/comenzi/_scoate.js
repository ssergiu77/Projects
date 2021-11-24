const mysql = require("mysql");
module.exports.run = async (bot, message, args) => {
    let con = mysql.createConnection({
        host: "127.0.0.1",
        user: "root",
        password: "",
        database: "str_fivem"
    })
con.connect(function(err) {
    if(err) {
        console.log('[str_ban] Erroare: ' + err.stack)
        return err;
    }
    var _ban = args.join("")
    var _id = args.join("")
    var _sql = `UPDATE vrp_user_data SET dvalue = ; WHERE user_id = '${_id}'`;
    con.query(_sql, function (err, result) {
        if (err) throw err;
        console.log (`ID-ul: ${_id} | A luat ban pe server! [SUCCES]`)
    })
})
}

module.exports.help = {
    name: "unban"
}
