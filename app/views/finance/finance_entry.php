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
                    <th class="col-xs-4 col-md-3 nopadding"></th>
                    <th class="col-xs-2 col-md-5 nopadding"></th>
                    <th class="col-xs-5 col-md-2 nopadding"></th>
                    <th class="col-xs-1 col-md-1 nopadding"></th>
                </tr>
            </thead>
            <tbody>
                <tr <?php echo (!empty($this->financeList)) ? 'style="display:none;"' : '' ?>>
                    <td class="text-info">There are no finance entries available.</td>
                </tr>

                <?php
                foreach ($this->financeList as $entry) {
                    //Datum in Format d.m.Y formatieren
                    $entry['date'] = Functions::formatDate($entry['date'], 'd.m.Y');
                    ?>

                    <tr>
                        <td>
                            <strong><?= $entry['product'] ?></strong>
                            <p><?= $entry['date'] ?></p>
                        </td>
                        <td><?= $entry['display_name'] ?></td>
                        <td class="text-right">
                            <?= number_format($entry['price'], 2, '.', '') ?> <?= CURR ?>
                        </td>
                        <td class="text-right">
                            <a href="#financeInfoId<?= $entry['id'] ?>" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-info-sign"></span></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
        </table>

        <!-- Modal für Finance Information -->
        <?php
        foreach ($this->financeList as $entry) {
            ?>
            <!-- Modal für Finance Information -->
            <div id="financeInfoId<?= $entry['id'] ?>" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Information</h4>
                        </div>
                        <div class="modal-body">
                            <h4><?= $entry['product'] ?></h4>
                            <p><strong><?= $entry['display_name'] ?></strong> paid <?= number_format($entry['price'], 2, '.', '') ?> <?= CURR ?><p>
                            <p>on: <?= $entry['date'] ?></p>
                            <p>participants: </p>
                            <table class="table">
                                <?php
                                foreach ($this->userList[0] as $user) {
                                    echo '<tr>';
                                    echo '<td>' . $user['display_name'] . '</td>';
                                    echo '<td>' . number_format($entry['pricePP'], 2, '.', '') . ' ' . CURR . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div><!-- end financeInfo -->
            <?php
        }
        ?>

    </div><!-- end panel -->
</div>