<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>
            <div>
                <h3>Create Flat</h3>
                <div>
                    <!-- Error Fenster anzeigen, falls ein Fehler auftrat -->
                    <?php
                    if (isset($this->data['error'])) {
                        echo '<div class="alert alert-danger" role="alert"><p>' . $this->data['error_msg'] . '</p></div>';
                    }
                    ?>
                    <form role="form" action="<?= URL ?>/app/createFlat" method="post">
                        <div class="form-group">
                            <input type="text" value="" id="flatName" name="flatName" class="form-control" placeholder="Flat Name" tabindex="1">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Create" class="btn btn-primary" tabindex="7">
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div><!-- end well -->
</div><!-- end col -->
</div><!-- end row -->