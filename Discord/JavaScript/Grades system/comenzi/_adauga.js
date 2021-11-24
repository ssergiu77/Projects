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

    var _ban = "Police Officer"
    var _id = args.join("")
    var _sql = `UPDATE vrp_user_data SET dvalue = '*' WHERE user_id = '${_id}'`
    con.query(_sql, function (err, result) {
        if (err) throw err;
        console.log (`ID-ul: ${_id} | A primit ${_ban}! [SUCCES]`)
        
    })
})
}

module.exports.help = {
    name: "adauga"
}
