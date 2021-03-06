<?php require_once ROOT . '/app/views/app/' . 'left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-usd fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <?php if (Session::getFlatId()) : ?>
        <!-- Create a Finance Entry -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Create a new finance entry</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="<?= URL ?>/finance/createEntry">
                    <div class="form-group <?php echo (isset($this->data['product'])) ? 'has-error' : '' ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-shopping-cart fa-lg fa-fw"></i></span>
                            <input type="text" id="product" name="product" class="form-control" placeholder="Product or description" tabindex="1" required autofocus>
                        </div>
                    </div>
                    <div class="form-group <?php echo (isset($this->data['price'])) ? 'has-error' : '' ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd fa-lg fa-fw"></i></span>
                            <input type="number" step="any" min="0" id="price" name="price" class="form-control" placeholder="Price" tabindex="2" required>
                        </div>
                        <?php if (isset($this->data['price'])) : ?>
                            <span class="help-block">Please enter positiv numbers only!</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group <?php echo (isset($this->data['date'])) ? 'has-error' : '' ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-lg fa-fw"></i></span>
                            <input type="date" id="date" name="date" class="form-control" value="<?php echo date('d.m.Y', time()); ?>" tabindex="3" required>
                        </div>
                        <?php if (isset($this->data['date'])) : ?>
                            <span class="help-block text-danger">Date format must be: "DD.MM.YYYY" or "YYYY-MM-DD"!</span>
                        <?php endif; ?>
                    </div>
                    <p>Who needs to pay for it all?</p>
                    <div class="form-group <?php echo (isset($this->data['users'])) ? 'has-error' : '' ?>">
                        <div class="" data-toggle="buttons">
                            <?php foreach ($this->userList as $key => $user) : ?>
                                <label class="btn btn-default"><input type="checkbox" name="user[]" value="<?= $key ?>" tabindex="4"><?= $user ?></label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (isset($this->data['users'])) : ?>
                            <span class="help-block">Select at least one resident!</span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Create Entry" class="btn btn-success btn-block btn-lg" tabindex="5">
                    </div>
                </form>
            </div><!-- end panel-body -->
        </div><!-- end panel -->
    <?php endif; ?>
</div><!-- end mainContent -->
