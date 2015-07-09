<div class="well">
<ul class="nav nav-pills nav-stacked">
    <!-- @Todo Dynamisch active classe -->
        <li class="<?php echo ($this->data['title'] == 'Home') ? 'active' : '' ?>"><a href="<?= URL ?>">Home</a></li>
        <li class="<?php echo ($this->data['title'] == 'Shopping List') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/shopping/index">Shopping List</a></li>
        <li class="<?php echo ($this->data['title'] == 'Cleaning Tasks' || $this->data['title'] == 'Create Task') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/cleaning/index">Cleaning Tasks</a></li>
        <li class="<?php echo ($this->data['title'] == 'Financials') ? 'active' : '' ?>"><a href="#" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>Finances</a></li>
        <li class="nav-divider"></li>
        <li class="<?php echo ($this->data['title'] == 'Settings') ? 'active' : '' ?>"><a href="<?= URL ?>/settings/index">Settings</a></li>
    </ul>
</div>