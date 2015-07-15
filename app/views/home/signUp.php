<div class="well">
    <div class="page-header">
        <h1><?= $this->data['title'] ?></h1>
    </div>
    <!-- @Todo anzeige ob Registrierung erfolgreich -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
            <?php
            if (isset($this->data['error'])) {
                echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                // @Todo Form validation mit Bootstrap <span class="help-block">Username is available</span>
            }
            ?>
            <?php
            if (isset($this->data['success'])) {
                echo '<div class="alert alert-success" role="alert"><p>Sign Up was successfull!</p></div>';
            }
            ?>
            <form role="form" action="<?= URL ?>/register/run" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo ($this->data['username'] === true ) ? 'has-error' : '' ?>">
                            <input type="text" value="<?php echo (isset($this->data['username']) && $this->data['username'] !== true) ? $this->data['username'] : '' ?>" name="username" id="first_name" class="form-control input-lg" placeholder="User Name" tabindex="5" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo ($this->data['displayname'] === true ) ? 'has-error' : '' ?>">
                            <input type="text" value="<?php echo (isset($this->data['displayname']) && $this->data['displayname'] !== true) ? $this->data['displayname'] : '' ?>" name="displayname" id="last_name" class="form-control input-lg" placeholder="Display Name" tabindex="6" required>
                        </div>
                    </div>
                </div><!-- end row -->
                <div class="form-group <?php echo ($this->data['email'] === true ) ? 'has-error' : '' ?>">
                    <input type="email" value="<?php echo (isset($this->data['email']) && $this->data['email'] !== true) ? $this->data['email'] : '' ?>" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="7" required>
                </div>
                <div class="form-group <?php echo ($this->data['password'] === true ) ? 'has-error' : '' ?>">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="8" required>
                </div>
                <div class="form-group">
                    <input type="text" value="<?php echo (isset($this->data['flatCode']) && $this->data['flatCode'] !== true) ? $this->data['flatCode'] : '' ?>" name="flat_code" id="flat_code" class="form-control input-lg" placeholder="Flat Code (if available)" tabindex="9">
                </div>
                <div class="form-group">
                    <input type="submit" value="Sign Up" class="btn btn-success btn-block btn-lg" tabindex="10">
                </div>
            </form>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end well -->