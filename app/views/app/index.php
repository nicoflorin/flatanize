<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-comment fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <p>Nice to see, that you signed up for flatanize! Now have fun with organising your flat.</p>
    <div class="alert alert-success" role="alert">
        <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here</a> to start!</p>
    </div>
</div><!-- end well -->