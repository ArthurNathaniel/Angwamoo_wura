<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
?>

<div class="mobile">
        <div class="logo"></div>
        <div class="dashed"></div>
        <a href="services.php" class="<?= $current_page === 'services.php' ? 'active' : '' ?>">Main Services</a>

        <a href="massage_services.php" class="<?= $current_page === 'massage_services.php' ? 'active' : '' ?>">Massage</a>
        <a href="sauna.php" class="<?= $current_page === 'sauna.php' ? 'active' : '' ?>">Sauna</a>
        <a href="detox.php" class="<?= $current_page === 'detox.php' ? 'active' : '' ?>">Detox</a>
        <a href="facial.php" class="<?= $current_page === 'facial.php' ? 'active' : '' ?>">Facial</a>
        <a href="teeth_whitening.php" class="<?= $current_page === 'teeth_whitening.php' ? 'active' : '' ?>">Teeth Whitening</a>
        <a href="manicure.php" class="<?= $current_page === 'manicure.php' ? 'active' : '' ?>">Manicure</a>
        <a href="skin_care.php" class="<?= $current_page === 'skin_care.php' ? 'active' : '' ?>">Skin Care</a>
    </div>