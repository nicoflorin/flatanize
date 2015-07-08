<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <!-- Add To Shopping -->
            <div id="addToShoppingList">
                <form method="post" action="<?= URL ?>/shopping/addToShoppingList">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-shopping-cart"></span></span>
                                <input type="text" class="form-control" name="product" placeholder="Product" tabindex="1">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <input type="text" class="form-control" name="amount" placeholder="Amount" tabindex="2">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <input type="submit" value="Add" class="btn btn-primary btn-block" tabindex="3">
                            </div>
                        </div>
                    </div><!-- end row -->
                </form>
                <hr>
            </div><!-- end addShopping -->

            <!-- Shopping List -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Shopping List</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-xs-10">Product</th>
                                <th class="col-xs-1">Amount</th>
                                <th class="col-xs-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($this->list as $value) {
                                echo '<tr>';
                                echo '<td>' . $value['product'] . '</td>';
                                echo '<td>' . $value['amount'] . '</td>';
                                echo '<td><a href="' . URL . '/shopping/deleteFromShoppingList/' . $value['id'] .
                                '" class="btn btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->