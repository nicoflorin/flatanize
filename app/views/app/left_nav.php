    <ul class="nav nav-pills nav-stacked">
        <li class="<?php echo ($this->data['title'] == 'Home') ? 'active' : '' ?>"><a href="<?= URL ?>">Home</a></li>
        <li class="<?php echo ($this->data['title'] == 'Shopping List') ? 'active' : '' ?>"><a href="<?= URL ?>/app/shopping">Shopping List</a></li>
        <li class="<?php echo ($this->data['title'] == 'Cleaning Schedules') ? 'active' : '' ?>"><a href="#">Cleaning Schedules</a></li>
        <li class="<?php echo ($this->data['title'] == 'Financials') ? 'active' : '' ?>"><a href="#">Financials</a></li>
        <li class="<?php echo ($this->data['title'] == 'Settings') ? 'active' : '' ?>"><a href="<?= URL ?>/app/settings">Settings</a></li>
    </ul>