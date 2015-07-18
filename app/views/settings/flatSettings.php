<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-building fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>

    <!-- Flat Settings tab -->
    <div id="flatSettings">
        <!-- Flat Infos -->
        <div class="panel panel-primary" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
            <div class="panel-heading">
                <h3 class="panel-title"><?= $this->flatName ?></h3>
            </div>
            <div class="panel-body">
                <p>Your flat code is: <strong><?= $this->flatCode ?></strong></p>
                <p>You are in a flat with:</p>
                <table class="table table-hover">
                    <?php
                    //Liste der Users anzeigen
                    if (isset($this->users)) {
                        foreach ($this->users as $key => $user) {
                            ?>
                            <tr>
                                <td><?= $user['display_name'] ?></td>
                                <?php 
                                    if (Session::getUserId() != $user['id']) {
                                        echo '<td class="text-right"><a href="#userInfoId' . $user['id'] .'" class="btn btn-danger" data-toggle="modal" >throw out</a></td>';
                                    }else {
                                        echo '<td class="text-right"><a href="#" class="btn btn-danger disabled">throw out</a></td>';
                                    }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div><!-- end panel-body -->
        </div><!-- end flat infos -->

        <!-- Share Flat -->
        <div class="panel panel-primary" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
            <div class="panel-heading">
                <h3 class="panel-title">Share your flat</h3>
            </div>
            <div class="panel-body">
                <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                <?php
                if (isset($this->data['error_share'])) {
                    echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                }
                ?>
                <p>Share this flat with your buddies. Send them your flat code now.</p>
                <form action="<?= URL ?>/settings/shareFlat" method="post">
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" tabindex="1" required> 
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Send Code" class="btn btn-success" tabindex="2">
                    </div>
                </form>
            </div><!-- end panel-body -->
        </div><!-- end shareFlat -->
        <!-- Create Flat -->
        <div class="panel panel-primary" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
            <div class="panel-heading">
                <h3 class="panel-title">Create flat</h3>
            </div>
            <div class="panel-body">
                <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                <?php
                if (isset($this->data['error_create'])) {
                    echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                }
                ?>
                <form action="<?= URL ?>/settings/createFlat" method="post">
                    <div class="form-group">
                        <input type="text" value="" id="flatName" name="flatName" class="form-control" placeholder="Flat Name" tabindex="3" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Create" class="btn btn-success" tabindex="4">
                    </div>
                </form>
            </div><!-- end panel-body -->
        </div><!-- end createFlat -->

        <!-- Join Flat -->
        <div class="panel panel-primary" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
            <div class="panel-heading">
                <h3 class="panel-title">Join flat</h3>
            </div>
            <div class="panel-body">
                <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                <?php
                if (isset($this->data['error_join'])) {
                    echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                }
                ?>
                <form action="<?= URL ?>/settings/joinFlat" method="post">
                    <div class="form-group">
                        <input type="text" value="" id="flatCode" name="flatCode" class="form-control" placeholder="Flat Code" tabindex="5" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Join" class="btn btn-success" tabindex="6">
                    </div>
                </form>
            </div><!-- end panel-body -->
        </div><!-- end joinFlat -->

        <!-- Leave Flat -->
        <div class="panel panel-primary" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
            <div class="panel-heading">
                <h3 class="panel-title">Leave your flat</h3>
            </div>
            <div class="panel-body">
                <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                <?php
                if (isset($this->data['error_leave'])) {
                    echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                }
                ?>
                <p>You really want to leave your flat?</p>
                <form action="<?= URL ?>/settings/leaveFlat" method="post">
                    <div class="form-group">
                        <input type="submit" value="Yes, leave" class="btn btn-success" tabindex="7">
                    </div>
                </form>
            </div><!-- end panel-body -->
        </div><!-- end leaveFlat -->

        <!-- Modal für User Information -->
        <div id="userModal">
            <?php
            if (isset($this->users)) {
                foreach ($this->users as $user) {
                    ?>
                    <div id="userInfoId<?= $user['id'] ?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">User Informations</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Sure want to throw out <strong><?= $user['display_name'] ?></strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="<?= URL ?>/settings/throwOut">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <input type="submit" class="btn btn-danger pull-left" value="Yes, throw out">
                                    </form>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- end financeInfo -->
                    <?php
                }
            }
            ?>
        </div><!-- financeModal -->
    </div><!-- end flatSettings -->
</div><!-- end mainContent -->