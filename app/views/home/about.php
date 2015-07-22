<?php
if (Session::isLoggedIn()) { //Navigation nur anzeigen wenn eingeloggt.
    require_once ROOT . '/app/views/app/left_nav.php'; 
}
?>
<div id="mainContent" class="well" <?php echo (!Session::isLoggedIn()) ? 'style="width: 100%;"' : '' ?>>
    <div class="page-header">
        <h1><i class="fa fa-info-circle fa-lg fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <div class="row">
whiteboard
shopping list
task scheduler
finance

bug/support -> <?= WEBMASTER ?>
    </div><!-- end row -->
</div>