<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <!-- Flat Infos -->
            <div class="panel panel-primary" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->flatName ?></h3>
                </div>
                <div class="panel-body">
                    <p>Your Flat Code is: <?= $this->flatCode ?></p>
                </div><!-- end panel-body -->
            </div><!-- end flat infos -->

            <!-- Share Flat -->
            <div class="panel panel-primary" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <div class="panel-heading">
                    <h3 class="panel-title">Share Flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error_share'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <p>Share your flat with your buddies. Send them your code now.</p>
                    <form role="form" action="<?= URL ?>/app/shareFlat" method="post">
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" tabindex="1">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Send Code" class="btn btn-primary" tabindex="2">
                        </div>
                    </form>
                </div><!-- end panel-body -->
            </div><!-- end shareFlat -->
            <!-- Create Flat -->
            <div class="panel panel-primary" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <div class="panel-heading">
                    <h3 class="panel-title">Create Flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error_create'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <form role="form" action="<?= URL ?>/app/createFlat" method="post">
                        <div class="form-group">
                            <input type="text" value="" id="flatName" name="flatName" class="form-control" placeholder="Flat Name" tabindex="1">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Create" class="btn btn-primary" tabindex="2">
                        </div>
                    </form>
                </div><!-- end panel-body -->
            </div><!-- end createFlat -->

            <!-- Join Flat -->
            <div class="panel panel-primary" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <div class="panel-heading">
                    <h3 class="panel-title">Join Flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error_join'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <form role="form" action="<?= URL ?>/app/joinFlat" method="post">
                        <div class="form-group">
                            <input type="text" value="" id="flatCode" name="flatCode" class="form-control" placeholder="Flat Code" tabindex="1">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Join" class="btn btn-primary" tabindex="2">
                        </div>
                    </form>
                </div><!-- end panel-body -->
            </div><!-- end joinFlat -->

            <!-- Leave Flat -->
            <div class="panel panel-primary" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <div class="panel-heading">
                    <h3 class="panel-title">Leave Flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error_leave'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <form role="form" action="<?= URL ?>/app/leaveFlat" method="post">
                        <div class="form-group">
                            <input type="submit" value="Leave" class="btn btn-primary">
                        </div>
                    </form>
                </div><!-- end panel-body -->
            </div><!-- end leaveFlat -->

        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->