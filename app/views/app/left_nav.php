    <ul class="nav nav-pills nav-stacked">
        <li class="<?php echo ($this->data['title'] == 'Home') ? 'active' : '' ?>"><a href="<?= URL ?>">Home</a></li>
        <li class="<?php echo ($this->data['title'] == 'Shopping List') ? 'active' : '' ?>"><a href="<?= URL ?>/shopping/index">Shopping List</a></li>
        <li class="<?php echo ($this->data['title'] == 'Cleaning Tasks') ? 'active' : '' ?>"><a href="<?= URL ?>/cleaning/index">Cleaning Tasks</a></li>
        <li class="<?php echo ($this->data['title'] == 'Financials') ? 'active' : '' ?>"><a href="#">Finances</a></li>
        <li class="nav-divider"></li>
        <li class="<?php echo ($this->data['title'] == 'Settings') ? 'active' : '' ?>"><a href="<?= URL ?>/settings/index">Settings</a></li>
    </ul>