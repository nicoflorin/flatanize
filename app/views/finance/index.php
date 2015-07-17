<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-usd fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <div class="alert alert-success" role="alert" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
        <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
        <li class="active"><a data-toggle="tab" href="#financeEntry"><i class="fa fa-list-ul fa-lg fa-fw"></i> Entries</a></li>
        <li><a data-toggle="tab" href="#financeBalance"><i class="fa fa-pie-chart fa-lg fa-fw"></i> Balance</a></li>
    </ul><!-- end nav -->
    <br />
    <div class="tab-content" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
        <?php require_once 'finance_entry.php'; ?>
        <?php require_once 'finance_balance.php'; ?>
    </div><!-- end tab-content -->
</div><!-- end mainContent -->