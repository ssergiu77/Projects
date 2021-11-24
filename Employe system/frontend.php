<?php include 'backend.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interviu</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
    <body>
    <div class="erroare">
        <?php include 'errori.php' ?>
    </div>

    <div class="showbut">
        <button type="button" onclick = "show_table();" id = "show_table" class="btn btn-dark">Arata Angajati</button>
    </div>


        <div class="container-ang" id = "container_ang">
            <header><h1>Tabel Angajati</h1></header>
            <div class="change_page">
                <h5 class="<?php if($pagina_ang <= 1){ echo 'disabled'; } ?>" id = "bpage">
                    <a href="<?php if($pagina_ang <= 1){ echo '#'; } else { echo "?pagina_ang=".($pagina_ang - 1); } ?>"><?php if ($pagina_ang == "1") {echo '';} else {echo "<strong>Pagina Anterioara</strong><br><a href='?pagina_ang=1'>Prima Pagina</a>";} ?></a>
                </h5>
                <h5 class="<?php if($pagina_ang >= $pag_total){ echo 'disabled'; } ?>" id = "npage">
                    <a href="<?php if($pagina_ang >= $pag_total){ echo '#'; } else { echo "?pagina_ang=".($pagina_ang + 1); } ?>"><strong>Pagina Urmatoare</strong></a>
                    <br><a href="?pagina_ang=<?php echo $pag_total; ?>">Ultima Pagina</a>
                </h5>
            </div>
            <form action="frontend.php" id = 'submit_ang' method="post">
                <button type='submit' style = 'display: none;' name = 'get_ang' class='btn btn-dark'>Cauta</button>
                <?php echo $table_ang; ?>
            </form>
        </div>

        <div class="container-dep" id = "container_dep">
            <header><h1>Tabel Departamente</h1></header>
            <div class="change_page">
                <h5 class="<?php if($pagina_dep <= 1){ echo 'disabled'; } ?>" id = "bpage">
                    <a href="<?php if($pagina_dep <= 1){ echo '#'; } else { echo "?pagina_dep=".($pagina_dep - 1); } ?>"><?php if ($pagina_dep == "1") {echo '';} else {echo "<strong>Pagina Anterioara</strong><br><a href='?pagina_dep=1'>Prima Pagina</a>";} ?></a>
                </h5>
                <h5 class="<?php if($pagina_dep >= $pag_total){ echo 'disabled'; } ?>" id = "npage">
                    <a href="<?php if($pagina_dep >= $pag_total){ echo '#'; } else { echo "?pagina_dep=".($pagina_dep + 1); } ?>"><strong>Pagina Urmatoare</strong></a>
                    <br><a href="?pagina_dep=<?php echo $pag_total; ?>">Ultima Pagina</a>
                </h5>
            </div>
            <form action='frontend.php' id = 'submit_dep' method='post'>
                <button type='submit' style = 'display: none;' name = 'get_dep' id = "buton_dep" class='btn btn-dark'>Cauta</button>
                <?php echo $table_dep; ?> 
            </form>
        </div>
    </body>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>