<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-street-view fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>

    <!-- User Settings tab -->
    <div id="userSettings">
        <!-- Passwort ändern -->
        <div id="changePassword">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error_pwchange'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <!-- Success Fenster anzeigen, falls KEIN fehler auftrag -->
                    <?php
                    if (isset($this->data['success_pwchange'])) {
                        echo '<div class="alert alert-success" role="alert"><p>You have changed your password successfully!</p></div>';
                    }
                    ?>
                    <form action="<?= URL ?>/settings/changePassword" method="post">
                        <div class="form-group">
                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password" tabindex="1" required> 
                        </div>
                        <div class="form-group">
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" tabindex="2" required> 
                        </div>
                        <div class="form-group">
                            <input type="password" id="verify_password" name="verify_password" class="form-control" placeholder="New Password (confirm)" tabindex="3" required> 
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Change" class="btn btn-success" tabindex="4">
                        </div>
                    </form>
                </div><!-- end panel-body -->
                <!-- @Todo Bild hochladen -->
                <!-- @Todo Anzeigenamen ändern -->
            </div><!-- end panel -->
        </div><!-- end changePassword -->

        <!-- DisplayName ändern -->
        <div id="changeDisplayName">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Display Name</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error_dnChange'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <!-- Success Fenster anzeigen, falls KEIN fehler auftrag -->
                    <?php
                    if (isset($this->data['success_dnChange'])) {
                        echo '<div class="alert alert-success" role="alert"><p>You have changed your display name successfully!</p></div>';
                    }
                    ?>
                    <form action="<?= URL ?>/settings/changeDisplayName" method="post">
                        <div class="form-group">
                            <input type="text" id="displayName" name="displayName" class="form-control" placeholder="New Display Name" tabindex="1" required> 
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Change" class="btn btn-success" tabindex="2">
                        </div>
                    </form>
                </div><!-- end panel-body -->
                <!-- @Todo Bild hochladen -->
                <!-- @Todo Anzeigenamen ändern -->
            </div><!-- end panel -->
        </div><!-- end changeDisplayName -->
    </div><!-- end userSettings -->
</div><!-- end mainContent -->