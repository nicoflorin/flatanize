<!-- Balance tab -->
<div id="financeBalance" class="tab-pane fade">
    <!-- Clear Balance -->
    <div>
        <a class="btn btn-success" href="<?= URL ?>/finance/clearBalance" role="button">Clear Balance</a>
        <button type="submit" class="btn btn-primary pull-right" onClick="window.location.reload(true)">
            <span class="glyphicon glyphicon-repeat"></span>
        </button>
    </div>
    <br>
    <!-- Balance -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Finance Balance</h3>
        </div>
        <table class="table">
            <thead class="nopadding">
                <tr>
                    <th class="col-xs-5 col-md-5 nopadding"></th>
                    <th class="col-xs-2 col-md-2 nopadding"></th>
                    <th class="col-xs-5 col-md-5 nopadding"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Balance für jeden User anzeigen
                foreach ($this->userBalance as $balance) {
                    //Prüfen ob Differenz positiv oder negativ
                    $diff = $balance['diff'];
                    if ($diff >= 0) {
                        $balance['plus'] = true;
                        $diff = '+' . $diff . ' ' . CURR;
                    } else {
                        $balance['minus'] = true;
                        $diff = $diff . ' ' . CURR;
                    }
                    ?>
                    <tr>
                        <td>
                            <div class="progress <?php echo (!isset($balance['minus'])) ? 'hidden' : ''?>">
                                <div class="progress-bar progress-bar-danger" <?php echo (isset($balance['minus'])) ? ' style="width: ' . $balance['perc'] . '%; display: block; float: right;"' : ''?>>
                                    <span><?php echo (isset($balance['minus'])) ? $diff : '' ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><span class="glyphicon glyphicon-user"></span><br><?= $balance['display_name'] ?></td>
                        <td>
                            <div class="progress <?php echo (!isset($balance['plus'])) ? 'hidden' : ''?>">
                                <div class="progress-bar progress-bar-success" <?php echo (isset($balance['plus'])) ? ' style="width: ' . $balance['perc'] . '%;"' : ''?>>
                                    <span><?php echo (isset($balance['plus'])) ? $diff : ''?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div><!-- end panel -->
</div>