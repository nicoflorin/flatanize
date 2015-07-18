<?php
if (Session::isLoggedIn()) {
    require_once ROOT . '/app/views/app/left_nav.php';
}
?>
<div id="mainContent" class="well" <?php echo (!Session::isLoggedIn()) ? 'style="width: 100%;"' : '' ?>>
    <div class="page-header">
        <h1><i class="fa fa-question-circle fa-lg fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <!-- @Todo FAQ erstellen -->
    <!-- Bootstrap Accordion -->
    <div class="panel-group" id="faqAccordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq1">1. What is <?= TITLE ?>?</a>
                </h4>
            </div>
            <div id="faq1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>With <?= TITLE ?> you can organize the daily doings in a shared flat. Things like a shared shopping list, a task scheduler or keeping track of the finances has never been easier.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq2">2. Which functions does <?= TITLE ?> have?</a>
                </h4>
            </div>
            <div id="faq2" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>You can write messages to the whiteboard, make a shared shopping list, schedule your flat tasks and keep track of your finances.</p>
                    <p>And who knows, maybe there will be some more in the future...</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq3">3. How can i create a new flat?</a>
                </h4>
            </div>
            <div id="faq3" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Just go to flat settings and write an awesome name under the create flat panel. Hit the Create button and that's it.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq4">4. How can i join a flat someone else created?</a>
                </h4>
            </div>
            <div id="faq4" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>To join a flat, you'll need a flat code. Ask your flat mate, who created a flat, about that code.</p>
                    <p>If you have the code, just go to flat settings and enter it under the join flat panel and hit Join.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq5">5. How can my flatmates join my created flat?</a>
                </h4>
            </div>
            <div id="faq5" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Just give them your flat code and they will be able to join you. You'll find the code under flat settings in the Information panel.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq6">6. How throw out a mate that has left my flat?</a>
                </h4>
            </div>
            <div id="faq6" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>To throw out you head to flat settings and hit the throw out button under the information panel. Confirm your choice and voilà, he's gone.</p>
                    <p>It was a mistake? Just let him join the flat again by entering the flat code under the join panel.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq7">7. How can i create a new flat?</a>
                </h4>
            </div>
            <div id="faq7" class="panel-collapse collapse">
                <div class="panel-body">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq8">8. How can i create a new flat?</a>
                </h4>
            </div>
            <div id="faq8" class="panel-collapse collapse">
                <div class="panel-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div><!-- end panel-group -->
</div><!-- end well -->