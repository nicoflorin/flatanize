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
        <div class="panel-body">

        </div>

    </div><!-- end panel -->
</div>