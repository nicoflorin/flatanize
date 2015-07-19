<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-building fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <div id="flatSettings">

        <?php if (Session::getFlatId()) : ?>
            <!-- Flat Infos -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->flatName ?></h3>
                </div>
                <div class="panel-body">
                    <p>Your flat code is: <strong><?= $this->flatCode ?></strong></p>
                    <p>You are in a flat with:</p>
                    <table class="table table-hover">
                        <?php if (isset($this->users)) : //Liste der Users anzeigen ?>
                            <?php foreach ($this->users as $key => $user) : ?>
                                <tr>
                                    <td><?= $user['display_name'] ?></td>
                                    <?php if (Session::getUserId() != $user['id']) : ?>
                                        <td class="text-right"><a href="#userInfoId<?= $user['id'] ?>" class="btn btn-danger" data-toggle="modal" >throw out</a></td>
                                    <?php else : ?>
                                        <td class="text-right"><a href="#" class="btn btn-danger disabled">throw out</a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                </div><!-- end panel-body -->
            </div><!-- end flat infos -->
        <?php endif; ?>

        <?php if (Session::getFlatId()) : ?>
            <!-- Share Flat -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Share your flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php if (isset($this->data['error_share'])) : ?>
                        <div class="alert alert-danger" role="alert"><p><?= $this->data['error_msg'] ?></p></div>
                    <?php endif; ?>
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
        <?php endif; ?>

        <?php if (!Session::getFlatId()) : ?>
            <!-- Create Flat -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Create flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php if (isset($this->data['error_create'])) : ?>
                        <div class="alert alert-danger" role="alert"><p><?= $this->data['error_msg'] ?></p></div>
                    <?php endif; ?>
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
        <?php endif; ?>

        <?php if (!Session::getFlatId()) : ?>
            <!-- Join Flat -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Join flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php if (isset($this->data['error_join'])) : ?>
                        <div class="alert alert-danger" role="alert"><p><?= $this->data['error_msg'] ?></p></div>
                    <?php endif; ?>
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
        <?php endif; ?>


        <?php if (Session::getFlatId()) : ?>
            <!-- Leave Flat -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Leave your flat</h3>
                </div>
                <div class="panel-body">
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php if (isset($this->data['error_leave'])) : ?>
                        <div class="alert alert-danger" role="alert"><p><?= $this->data['error_msg'] ?></p></div>
                    <?php endif; ?>
                    <p>You really want to leave your flat?</p>
                    <form action="<?= URL ?>/settings/leaveFlat" method="post">
                        <div class="form-group">
                            <input type="submit" value="Yes, leave" class="btn btn-success" tabindex="7">
                        </div>
                    </form>
                </div><!-- end panel-body -->
            </div><!-- end leaveFlat -->
        <?php endif; ?>

        <!-- Modal für User Information -->
        <div id="userModal">
            <?php if (isset($this->users)) : ?>
                <?php foreach ($this->users as $user) : ?>
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
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!-- financeModal -->
    </div><!-- end flatSettings -->
</div><!-- end mainContent -->