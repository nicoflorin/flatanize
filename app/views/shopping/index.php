<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once ROOT . '/app/views/app/' . 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <div class="alert alert-success" role="alert" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
            </div>

            <div id="shoppingContent" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <!-- Add To Shopping -->
                <div id="addToShoppingList">
                    <form method="post" action="<?= URL ?>/shopping/addToShoppingList">
                        <div class="row">
                            <div class="col-xs-8 col-md-8 nopadding-right">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-shopping-cart"></span></span>
                                    <input type="text" class="form-control" name="product" placeholder="Product" tabindex="1" autofocus>
                                </div>
                            </div>
                            <div class="col-xs-2 col-md-2 nopadding-left nopadding-right">
                                <div>
                                    <input type="text" class="form-control" name="amount" placeholder="Qty" tabindex="2">
                                </div>
                            </div>
                            <div class="col-xs-2 col-md-2 nopadding-left">
                                <div >
                                    <button type="submit" class="btn btn-success btn-block" tabindex="3">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </form>
                </div><!-- end addShopping -->
                <br>
                <!-- Shopping List -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Your Shopping List</h3>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-xs-10">Product</th>
                                <th class="col-xs-1 text-center">Qty</th>
                                <th class="col-xs-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr <?php echo (!empty($this->list)) ? 'style="display:none;"' : '' ?>>
                                <td class="text-info">There are no records available.</td>
                            </tr>
                            <?php
                            foreach ($this->list as $entry) {
                            ?>
                                <tr>
                                    <td><?= $entry['product'] ?></td>
                                    <td class="text-center"><?= $entry['amount'] ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo URL . '/shopping/deleteFromShoppingList/' . $entry['id']; ?>" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- end panel -->
            </div><!-- end shoppingContent -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->