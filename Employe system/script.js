var container_ang = document.getElementById('container_ang');
var container_dep = document.getElementById('container_dep');
document.body.removeChild(container_ang);


function show_table() {
    var buton = document.getElementById('show_table');
    if (!document.getElementById('container_ang')) {
        buton.innerHTML = "Arata Departamentele";
        document.body.appendChild(container_ang);
        document.body.removeChild(container_dep);
    }
    else if (!document.getElementById('container_dep')) {
        buton.innerHTML = "Arata Angajati";
        document.body.appendChild(container_dep);
        document.body.removeChild(container_ang);
    }
}