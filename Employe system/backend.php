<?php 

$erori_ang = array();
$erori_dep = array();
$db = mysqli_connect('localhost', 'root', '', 'interviu');

// for ($i=1; $i < 100000; $i++) { 

//     $IDDEP = rand(1, 10000);
//     $NUMEDEP = "Nume Departament " . $i;
//     $NUMEANG = "Nume Angajat " . $i;
//     $PRENANG = "Prenume Angajat " . $i + 1;
//     $CNPANG = rand(1, 100000);
//     $FUNCTIEANG = "Functie Angajat " . $i + 10;
//     $SALARANG = rand(1000, 10000);
//     $ZILECON = rand(0, 100);

//     mysqli_query($db, "INSERT INTO angajati (id_departament, nume_dep, nume_ang, prenume_ang, cnp_ang, functie_ang, salariu_ang, zilecon_ang) 
//                                     VALUES ('$IDDEP', '$NUMEDEP', '$NUMEANG', '$PRENANG', '$CNPANG', '$FUNCTIEANG', '$SALARANG', '$ZILECON')");
// }

// for ($i=1; $i < 10000; $i++) { 

//     // $IDDEP = $i;
//     $NUMEDEP = "Nume Departament " . $i;
//     $DESCDEP = "Descriere Departament " . $i + 1;
//     // $NUMEANG = "Nume Angajat " . $i;
//     // $PRENANG = "Prenume Angajat " . $i + 1;
//     // $CNPANG = rand(1, 100000);
//     // $FUNCTIEANG = "Functie Angajat " . $i + 10;
//     // $SALARANG = rand(1000, 10000);
//     // $ZILECON = rand(0, 100);

//     mysqli_query($db, "INSERT INTO departamente (nume_dep, desc_dep) VALUES ('$NUMEDEP', '$DESCDEP')");
// }


if (isset($_GET['pagina_dep'])) {
    $pagina_dep = $_GET['pagina_dep'];
} else {
    $pagina_dep = 1;
}

$max = 15;
$min = ($pagina_dep-1) * $max;


$get_count = "SELECT COUNT(id_departament) FROM angajati WHERE id_departament = '1'";
$result_count = mysqli_query($db, $get_count);
$media_count = mysqli_fetch_array($result_count)[0];

$result_dep = "SELECT COUNT(*) FROM departamente";
$result = mysqli_query($db,$result_dep);
$randuri_totale = mysqli_fetch_array($result)[0];
$pag_total = ceil($randuri_totale / $max);

$sql = "SELECT * FROM departamente LIMIT $min, $max";
$table_dep = "<table class='table table-sm dep'><thead><tr><form action='frontend.php' id = 'submit_dep' method='post'><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'id_dep' id='floatingInput' placeholder='ID'><label for='floatingInput'>ID</label></div>ID</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'nume_dep' id='floatingPassword' placeholder='Nume'><label for='floatingPassword'>Nume</label></div>Nume Departament</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'desc_dep' id='floatingPassword' placeholder='Descriere'><label for='floatingPassword'>Descriere</label></div>Descriere Departament</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'salarm_dep' id='floatingPassword' placeholder='Salar Mediu'><label for='floatingPassword'>Salar Mediu</label></div>Salar Mediu Departament</th></tr></form>";

$res_data = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($res_data)){
    $id_dep = $row['id_departament']; 
    $nume_dep = $row['nume_dep'];
    $desc_dep = $row['desc_dep'];

    $id_departamente = mysqli_query($db, "SELECT id_departament FROM departamente WHERE id_departament = '$id_dep'");
    while ($randul_id_departamente = mysqli_fetch_array($id_departamente)) {
        $id_departament = $randul_id_departamente['id_departament'];
        $result = mysqli_query($db,"SELECT sum(salariu_ang), id_angajat FROM angajati WHERE id_departament = '$id_departament'");
        while ($randul_salariim = mysqli_fetch_array($result)) {
            $salarm_dep = $randul_salariim[0] / $media_count | 0;
            mysqli_query($db, "UPDATE departamente SET salarm_dep = '$salarm_dep' WHERE id_departament = '$id_dep'");
        }
    }

    $table_dep = $table_dep . "<tr><td>$id_dep</td><td>$nume_dep</td><td>$desc_dep</td><td>$salarm_dep</td>";
}

$table_dep = $table_dep . "</tbody></table>";

if (isset($_POST['get_dep'])) {

    $table_dep = "<table class='table table-sm dep'><thead><tr><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'id_dep' id='floatingInput' placeholder='ID'><label for='floatingInput'>ID</label></div>ID</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'nume_dep' id='floatingPassword' placeholder='Nume'><label for='floatingPassword'>Nume</label></div>Nume Departament</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'desc_dep' id='floatingPassword' placeholder='Descriere'><label for='floatingPassword'>Descriere</label></div>Descriere Departament</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'salarm_dep' id='floatingPassword' placeholder='Salar Mediu'><label for='floatingPassword'>Salar Mediu</label></div>Salar Mediu Departament</th></tr>";

    $id_dep = mysqli_real_escape_string($db, $_POST['id_dep']);
    $nume_dep = mysqli_real_escape_string($db, $_POST['nume_dep']);
    $desc_dep = mysqli_real_escape_string($db, $_POST['desc_dep']);
    $salarm_dep = mysqli_real_escape_string($db, $_POST['salarm_dep']);

    if (empty($id_dep) && empty($nume_dep) && empty($desc_dep) && empty($salarm_dep)) {
        array_push($erori_dep, 'Nu ai introdus nici o valoare!');

        $table_dep = "<table class='table table-sm dep'><thead><tr><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'id_dep' id='floatingInput' placeholder='ID'><label for='floatingInput'>ID</label></div>ID</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'nume_dep' id='floatingPassword' placeholder='Nume'><label for='floatingPassword'>Nume</label></div>Nume Departament</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'desc_dep' id='floatingPassword' placeholder='Descriere'><label for='floatingPassword'>Descriere</label></div>Descriere Departament</th><th scope='col'><div class='form-floating mb-3' id = 'eroare_dep'><input type='text' class='form-control' name = 'salarm_dep' id='floatingPassword' placeholder='Salar Mediu'><label for='floatingPassword'>Salar Mediu</label></div>Salar Mediu Departament</th></tr>";
        $result_dep = mysqli_query($db, "SELECT * FROM departamente LIMIT $min, $max");

        while($row = mysqli_fetch_array($result_dep)){ 
            $table_dep = $table_dep . "<tr><td>".$row['id_departament']."</td><td>".$row['nume_dep']."</td><td>".$row['desc_dep']."</td><td>".$row['salarm_dep']."</td>";
        }
        $table_dep = $table_dep . "</tbody></table>";
    }
    else {  
        $result = mysqli_query($db, "SELECT * FROM departamente WHERE id_departament = '$id_dep' OR nume_dep = '$nume_dep' OR desc_dep = '$desc_dep'"); // problema OR salarm_dep = '$salarm_dep'

        while ($row = mysqli_fetch_array($result)) {
            $table_dep = $table_dep . "<tr><td>".$row['id_departament']."</td><td>".$row['nume_dep']."</td><td>".$row['desc_dep']."</td><td>".$row['salarm_dep']."</td>";
        }
    }
}

if (isset($_GET['pagina_ang'])) {
    $pagina_ang = $_GET['pagina_ang'];
} else {
    $pagina_ang = 1;
}

$max = 15;
$min = ($pagina_ang-1) * $max; 

$result_dep = "SELECT COUNT(*) FROM angajati";
$result = mysqli_query($db,$result_dep);
$randuri_totale = mysqli_fetch_array($result)[0];
$pag_total = ceil($randuri_totale / $max);

$sql = "SELECT * FROM angajati LIMIT $min, $max";
$table_ang = "<table class='table table-sm ang'><form action='frontend.php' id = 'submit_ang' method='post'><thead><tr><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'id_ang' id='floatingInput' placeholder='ID Angajat'><label for='floatingInput'>ID Angajat</label></div>ID</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'id_dep_ang' id='floatingPassword' placeholder='ID Departament'><label for='floatingPassword'>ID Departament</label></div>ID Departament</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'nume_dep_ang' id='floatingPassword' placeholder='Nume Departament'><label for='floatingPassword'>Nume Departament</label></div>Nume Departament</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'nume_ang' id='floatingPassword' placeholder='Nume'><label for='floatingPassword'>Nume</label></div>Nume</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'prenume_ang' id='floatingPassword' placeholder='Prenume'><label for='floatingPassword'>Prenume</label></div>Prenume</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'cnp_ang' id='floatingPassword' placeholder='CNP'><label for='floatingPassword'>CNP</label></div>CNP</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'functie_ang' id='floatingPassword' placeholder='Functie'><label for='floatingPassword'>Functie</label></div>Functie</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'salariu_ang' id='floatingPassword' placeholder='Salariu'><label for='floatingPassword'>Salariu</label></div>Salariu</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'zilecon_ang' id='floatingPassword' placeholder='Zile Concediu'><label for='floatingPassword'>Zile Concediu</label></div>Zile Concediu</th></tr></form>";

$res_data = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($res_data)){
    $table_ang = $table_ang . "<tr><td>".$row['id_angajat']."</td><td>".$row['id_departament']."</td><td>".$row['nume_dep']."</td><td>".$row['nume_ang']."</td><td>".$row['prenume_ang']."</td><td>".$row['cnp_ang']."</td><td>".$row['functie_ang']."</td><td>".$row['salariu_ang']."</td><td>".$row['zilecon_ang']."</td>";
}

$table_ang = $table_ang . "</tbody></table>";


if (isset($_POST['get_ang'])) {

    $table_ang = "<table class='table table-sm ang'><form action='frontend.php' id = 'submit_ang' method='post'><thead><tr><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'id_ang' id='floatingInput' placeholder='ID Angajat'><label for='floatingInput'>ID Angajat</label></div>ID</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'id_dep_ang' id='floatingPassword' placeholder='ID Departament'><label for='floatingPassword'>ID Departament</label></div>ID Departament</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'nume_dep_ang' id='floatingPassword' placeholder='Nume Departament'><label for='floatingPassword'>Nume Departament</label></div>Nume Departament</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'nume_ang' id='floatingPassword' placeholder='Nume'><label for='floatingPassword'>Nume</label></div>Nume</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'prenume_ang' id='floatingPassword' placeholder='Prenume'><label for='floatingPassword'>Prenume</label></div>Prenume</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'cnp_ang' id='floatingPassword' placeholder='CNP'><label for='floatingPassword'>CNP</label></div>CNP</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'functie_ang' id='floatingPassword' placeholder='Functie'><label for='floatingPassword'>Functie</label></div>Functie</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'salariu_ang' id='floatingPassword' placeholder='Salariu'><label for='floatingPassword'>Salariu</label></div>Salariu</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'zilecon_ang' id='floatingPassword' placeholder='Zile Concediu'><label for='floatingPassword'>Zile Concediu</label></div>Zile Concediu</th></tr></form>";

    $id_ang = mysqli_real_escape_string($db, $_POST['id_ang']);
    $id_dep_ang = mysqli_real_escape_string($db, $_POST['id_dep_ang']);
    $nume_dep_ang = mysqli_real_escape_string($db, $_POST['nume_dep_ang']);
    $nume_ang = mysqli_real_escape_string($db, $_POST['nume_ang']);
    $prenume_ang = mysqli_real_escape_string($db, $_POST['prenume_ang']);
    $cnp_ang = mysqli_real_escape_string($db, $_POST['cnp_ang']);
    $functie_ang = mysqli_real_escape_string($db, $_POST['functie_ang']);
    $salariu_ang = mysqli_real_escape_string($db, $_POST['salariu_ang']);
    $zilecon_ang = mysqli_real_escape_string($db, $_POST['zilecon_ang']);

    if (empty($id_ang) && empty($id_dep_ang) && empty($nume_dep_ang) && empty($nume_ang) && empty($prenume_ang) && empty($cnp_ang) && empty($functie_ang) && empty($salariu_ang) && empty($zilecon_ang)) {
        array_push($erori_ang, 'Nu ai introdus nici o valoare!');

        $table_ang = "<table class='table table-sm ang'><thead><tr><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'id_ang' id='floatingInput' placeholder='ID Angajat'><label for='floatingInput'>ID Angajat</label></div>ID</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'id_dep_ang' id='floatingPassword' placeholder='ID Departament'><label for='floatingPassword'>ID Departament</label></div>ID Departament</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'nume_dep_ang' id='floatingPassword' placeholder='Nume Departament'><label for='floatingPassword'>Nume Departament</label></div>Nume Departament</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'nume_ang' id='floatingPassword' placeholder='Nume'><label for='floatingPassword'>Nume</label></div>Nume</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'prenume_ang' id='floatingPassword' placeholder='Prenume'><label for='floatingPassword'>Prenume</label></div>Prenume</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'cnp_ang' id='floatingPassword' placeholder='CNP'><label for='floatingPassword'>CNP</label></div>CNP</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'functie_ang' id='floatingPassword' placeholder='Functie'><label for='floatingPassword'>Functie</label></div>Functie</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'salariu_ang' id='floatingPassword' placeholder='Salariu'><label for='floatingPassword'>Salariu</label></div>Salariu</th><th scope='col'><div class='form-floating mb-3' id = 'error_ang'><input type='text' class='form-control' name = 'zilecon_ang' id='floatingPassword' placeholder='Zile Concediu'><label for='floatingPassword'>Zile Concediu</label></div>Zile Concediu</th></tr>";
        $result_ang = mysqli_query($db, "SELECT * FROM angajati LIMIT $min, $max");

        while($row = mysqli_fetch_array($result_ang)){ 
            $table_ang = $table_ang . "<tr><td>".$row['id_angajat']."</td><td>".$row['id_departament']."</td><td>".$row['nume_dep']."</td><td>".$row['nume_ang']."</td><td>".$row['prenume_ang']."</td><td>".$row['cnp_ang']."</td><td>".$row['functie_ang']."</td><td>".$row['salariu_ang']."</td><td>".$row['zilecon_ang']."</td>";
        }
        $table_ang = $table_ang . "</tbody></table>";
    }
    else {  
        $result = mysqli_query($db, "SELECT * FROM angajati WHERE id_angajat = '$id_ang' OR id_departament = '$id_dep_ang' OR nume_dep = '$nume_dep_ang' OR nume_ang = '$nume_ang' OR prenume_ang = '$prenume_ang' OR cnp_ang = '$cnp_ang' OR functie_ang = '$functie_ang' OR salariu_ang = '$salariu_ang'"); // problema OR zilecon_ang = '$zilecon_ang'

        while ($row = mysqli_fetch_array($result)) {
            $table_ang = $table_ang . "<tr><td>".$row['id_angajat']."</td><td>".$row['id_departament']."</td><td>".$row['nume_dep']."</td><td>".$row['nume_ang']."</td><td>".$row['prenume_ang']."</td><td>".$row['cnp_ang']."</td><td>".$row['functie_ang']."</td><td>".$row['salariu_ang']."</td><td>".$row['zilecon_ang']."</td>";
        }
        $table_ang = $table_ang . "</tbody></table>";
    }
}

?>