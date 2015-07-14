<!-- User Settings tab -->
<div id="userSettings" class="tab-pane fade">
    <!-- Passwort ändern -->
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
            <form role="form" action="<?= URL ?>/settings/changePassword" method="post">
                <div class="form-group">
                    <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password" tabindex="1" required> 
                </div>
                <div class="form-group">
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" tabindex="2" required> 
                </div>
                <div class="form-group">
                    <input type="password" id="verify_password" name="verify_password" class="form-control" placeholder="New Password" tabindex="3" required> 
                </div>

                <div class="form-group">
                    <input type="submit" value="Change" class="btn btn-success" tabindex="4">
                </div>
            </form>
        </div><!-- end panel-body -->
    </div><!-- end shareFlat -->
    <!-- @Todo Passwort ändern -->
    <!-- @Todo Bild hochladen -->
    <!-- @Todo Anzeigenamen ändern -->
</div>