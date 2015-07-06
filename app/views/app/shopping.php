<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <div id="addShopping">
                <form method="post" action="<?= URL ?>/app/addToShoppingList">
                    <div class="row">
                        <div class="col-xs-9"">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-shopping-cart"></span></span>
                                <input type="text" class="form-control" placeholder="Product" tabindex="1">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Amount" tabindex="2">
                                <span class="input-group-btn">
                                    <input type="submit" value="Add" class="btn btn-primary" tabindex="3">
                                </span>
                                
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
            </div><!-- end addShopping -->

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Shopping List</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td>Product</td>
                            <td>Amount</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->