<?php
if (Session::isLoggedIn()) {
    require_once ROOT . '/app/views/app/left_nav.php';
}
?>
<div id="mainContent" class="well" <?php echo (!Session::isLoggedIn()) ? 'style="width: 100%;"' : '' ?>>
    <div class="page-header">
        <h1><i class="fa fa-info-circle fa-lg fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <div class="row">

    </div><!-- end row -->
</div>