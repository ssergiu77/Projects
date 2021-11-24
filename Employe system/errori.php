<?php if (count($erori_ang) > 0): ?>
    <div class='eroare_ang'>
        <?php foreach ($erori_ang as $eroare): ?>
            <style>
                #error_ang{outline: 2px solid red; border-radius:5px; color: red; font-weight: 600;}
            </style>
        <?php endforeach ?>
    </div>
<?php endif ?>

<?php if (count($erori_dep) > 0): ?>
    <div class='eroare_ang'>
        <?php foreach ($erori_dep as $eroare): ?>
            <style>
                #eroare_dep{outline: 2px solid red; border-radius:5px; color: red; font-weight: 600;}
            </style>
        <?php endforeach ?>
    </div>
<?php endif ?>



