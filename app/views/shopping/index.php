<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
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
                    <div class="col-xs-8 col-md-8 nopadding-right-xs">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-shopping-cart fa-lg"></i></span>
                            <input type="text" class="form-control" name="product" placeholder="Product" tabindex="1" autofocus>
                        </div>
                    </div>
                    <div class="col-xs-2 col-md-2 nopadding-left-xs nopadding-right-xs">
                        <div>
                            <input type="number" pattern="[0-9]*" class="form-control" name="amount" placeholder="Qty" tabindex="2">
                        </div>
                    </div>
                    <div class="col-xs-2 col-md-2 nopadding-left-xs">
                        <div >
                            <button type="submit" class="btn btn-success btn-block" tabindex="3">
                                <i class="fa fa-plus fa-lg"></i>
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="col-xs-10">Product</th>
                        <th class="col-xs-1 text-center">Qty</th>
                        <th class="col-xs-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr <?php echo (!empty($this->list)) ? 'style="display:none;"' : '' ?>>
                        <td  class="text-info" >There are no records available.</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    foreach ($this->list as $entry) {
                        ?>
                        <tr>
                            <td><?= $entry['product'] ?></td>
                            <td class="text-center"><?= $entry['amount'] ?></td>
                            <td class="text-right">
                                <form action="<?php echo URL . '/shopping/deleteFromShoppingList'; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                                </form>
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