<?php
if (Session::isLoggedIn()) { //Navigation nur anzeigen wenn eingeloggt.
    require_once ROOT . '/app/views/app/left_nav.php';
}
?>
<div id="mainContent" class="well" <?php echo (!Session::isLoggedIn()) ? 'style="width: 100%;"' : '' ?>>
    <div class="page-header">
        <h1><i class="fa fa-info-circle fa-lg fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <div>
        <h2>Hello everybody</h2>
        <p>My name is Nico Florin and i am the creator of <?= TITLE ?>.</p>
        <p>This website is the result of my diploma project as a computer scientist.</p>
        <br>
        <p>The purpose of <?= TITLE ?> is to give you some useful functions to organize the living in a share flat.</p>
        <p>Such as:</p>
        <ul>
            <li>Whiteboard</li>
            <li>Shopping List</li>
            <li>Task Scheduler</li>
            <li>Finance</li>
        </ul>
        <br>
        <p>Now have fun using <?= TITLE ?>!</p>
        <br>
        <p>If you find any bug please report to <?= WEBMASTER ?>. Thank you!</p>
    </div>
</div>