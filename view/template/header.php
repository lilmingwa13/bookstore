<?php

require_once 'logo.php';

if (privilege() == 1) {
    require_once 'navbar_admin.php';
} elseif (privilege() == 0) {
    require_once 'navbar_user.php';
} else {
    require_once 'navbar.php';
}

?>