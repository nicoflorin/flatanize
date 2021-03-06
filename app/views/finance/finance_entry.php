<!-- Entries tab -->
<div id="financeEntry" class="tab-pane fade in active">
    <!-- create New Task -->
    <div>
        <a class="btn btn-success" href="<?= URL ?>/finance/showCreateEntry" role="button">Create New Entry</a>
    </div>
    <br>
    <!-- All entries -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Your Finance Entries</h3>
        </div>
        <?php if (empty($this->financeList)) : ?>
            <!-- no entries available -->
            <div class="panel-body">
                <p class="text-info noMargin">There are no finance entries available.</p>
            </div>
        <?php endif; ?>

        <?php if (!empty($this->financeList)) : ?>
            <table class="table table-hover">
                <thead class="nopadding">
                    <tr>
                        <th class="col-xs-4 col-md-3 nopadding"></th>
                        <th class="col-xs-2 col-md-5 nopadding"></th>
                        <th class="col-xs-5 col-md-2 nopadding"></th>
                        <th class="col-xs-1 col-md-1 nopadding"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($this->financeList as $entry) : ?>
                        <?php
                        //Datum in Format d.m.Y formatieren
                        $entry['date'] = Functions::formatDate($entry['date'], 'd.m.Y');
                        ?>
                        <!-- row als Link zu Modal -->
                        <tr onclick="input" data-toggle="modal" href="#financeInfoId<?= $entry['id'] ?>">
                            <td>
                                <p><strong><?= $entry['product'] ?></strong></p>
                                <p><?= $entry['date'] ?></p>
                            </td>
                            <td>Added: <?= $entry['display_name'] ?></td>
                            <td class="text-right">
                                <?= number_format($entry['price'], 2, '.', '') ?> <?= CURR ?>
                            </td>
                            <td class="text-right">
                                <i class="fa fa-chevron-right"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div><!-- end panel -->

    <?php if (!empty($this->financeList)) : ?>
        <!-- Modal für Finance Information -->
        <div id="financeModal">
            <?php foreach ($this->financeList as $entry) : ?>
                <div id="financeInfoId<?= $entry['id'] ?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Finance Informations</h4>
                            </div>
                            <div class="modal-body">
                                <h4><?= $entry['product'] ?></h4>
                                <p><strong><?= $entry['display_name'] ?></strong> paid <?= number_format($entry['price'], 2, '.', '') ?> <?= CURR ?><p>
                                <p>on: <?= $entry['date'] ?></p>
                                <p>participants: </p>
                                <table class="table">
                                    <?php foreach ($this->userList[$entry['id']] as $user) : ?>
                                        <tr>
                                            <td><?= $user['display_name'] ?></td>
                                            <td><?= number_format($entry['pricePP'], 2, '.', '') . ' ' . CURR ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="<?= URL ?>/finance/deleteEntry">
                                    <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                    <input type="submit" class="btn btn-danger pull-left" value="Delete">
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div><!-- end financeInfo -->
            <?php endforeach; ?>
        </div><!-- financeModal -->
    <?php endif; ?>
</div>