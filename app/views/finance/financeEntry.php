<!-- Entries tab -->
<div id="financeEntry" class="tab-pane fade in active">
    <!-- create New Task -->
    <div>
        <a class="btn btn-success" href="<?= URL ?>/finance/showCreateEntry" role="button">Create New Entry</a>
        <button type="submit" class="btn btn-primary pull-right" onClick="window.location.reload(true)">
            <span class="glyphicon glyphicon-repeat"></span>
        </button>
    </div>
    <br>
    <!-- All entries -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Your Finance Entries</h3>
        </div>
        <table class="table">
            <thead class="nopadding">
                <tr>
                    <th class="col-xs-5 nopadding"></th>
                    <th class="col-xs-3 nopadding"></th>
                    <th class="col-xs-4 nopadding"></th>
                </tr>
            </thead>
            <tbody>
                <tr <?php echo (!empty($this->financeList)) ? 'style="display:none;"' : '' ?>>
                    <td class="text-info">There are no scheduled tasks available.</td>
                </tr>

                <?php
                foreach ($this->financeList as $entry) {
                    //Datum in Format d.m.Y formatieren
                    $entry['date'] = Functions::formatDate($entry['date'], 'd.m.Y');
                    ?>
                    <tr>
                        <td><strong><?= $entry['product'] ?></strong>
                            <p><?= $entry['date'] ?></p>
                        </td>
                        <td>Added by: <?= $entry['display_name'] ?></td>
                        <td class="text-right"><?= $entry['price'] ?> <?= CURR ?>
                            <p><?= $entry['pricePP'] ?>  <?= CURR ?></p>
                        </td>
                    </tr>   
                    <?php
                }
                ?>
        </table>

    </div><!-- end panel -->
</div>