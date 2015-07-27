<?php
if (Session::isLoggedIn()) { //Navigation nur anzeigen wenn eingeloggt.
    require_once ROOT . '/app/views/app/left_nav.php';
}
?>
<div id="mainContent" class="well" <?php echo (!Session::isLoggedIn()) ? 'style="width: 100%;"' : '' ?>>
    <div class="page-header">
        <h1><i class="fa fa-question-circle fa-lg fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <!-- Bootstrap Accordion -->
    <div class="panel-group" id="faqAccordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq1">1. What is Flatanize?</a>
                </h4>
            </div>
            <div id="faq1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>With Flatanize you can organize the daily doings in a shared flat. Things like a shared shopping list, a task scheduler or keeping track of the finances has never been easier.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq2">2. Which functions does Flatanize have?</a>
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
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq3">3. How can I create a new flat?</a>
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
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq4">4. How can I join a flat someone else created?</a>
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
                    <p>When they are not around, you can send them the code by entering their email address under the share flat panel.</p>
                    <p>When they have the code, they can enter it right at the registration form or after the login under the join flat panel and hit Join.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq6">6. How can I throw out a mate that has left my flat?</a>
                </h4>
            </div>
            <div id="faq6" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>To throw out you head to flat settings and hit the throw out button under the information panel. Confirm your choice and voilà, he's gone.</p>
                    <p>It was a mistake? Just let him join the flat again by entering the flat code under the join flat panel.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq7">7. I have no smartphone. Can I use Flatanize nonetheless?</a>
                </h4>
            </div>
            <div id="faq7" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Yes, you can ;-). Flatanize is a responsive website, that looks good on every device with internet and a web browser.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq8">8. How can I edit a scheduled task?</a>
                </h4>
            </div>
            <div id="faq8" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>That's not possible at the moment i'm afraid. But you can delete it by clicking on it and hit delete. Create a new one afterwards.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq9">9. How can I edit a finance entry?</a>
                </h4>
            </div>
            <div id="faq9" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>That's not possible at the moment i'm afraid. But you can delete it by clicking on it and hit delete. Create a new one afterwards.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq10">10. Want to quit Flatanize?</a>
                </h4>
            </div>
            <div id="faq10" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>To quit, you'll have to leave your flat and write an email to <?= WEBMASTER ?> with the subject "delete account".</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq11">11. Want to delete your flat?</a>
                </h4>
            </div>
            <div id="faq11" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>To delete a flat, all your mates have to leave the flat and then write an email to <?= WEBMASTER ?> with the subject "delete flat".</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#faqAccordion" href="#faq12">12. No email is send, when inviting a friend?</a>
                </h4>
            </div>
            <div id="faq12" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Sometimes the email is in the SPAM folder. Check the SPAM folder on your email account.</p>
                </div>
            </div>
        </div>
    </div><!-- end panel-group -->
</div><!-- end well -->