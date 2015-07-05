<?php
echo 'shopping';
print_r($_SESSION);
echo '<br />';
if (Session::isLoggedIn()) {
    echo 'logged In';
}

