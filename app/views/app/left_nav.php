<div>
    <div class="collapse navbar-collapse" id="leftNavCollapse">
        <ul class="nav nav-pills nav-stacked">
            <!-- @Todo Dynamisch active class -->
            <li class="<?php echo ($this->data['title'] == 'Home') ? 'active' : '' ?>"><a href="<?= URL ?>">Home</a></li>
            <li class="<?php echo ($this->data['title'] == 'Shopping List') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/shopping/index">Shopping List</a></li>
            <li class="<?php echo ($this->data['title'] == 'Task Scheduling') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/task/index">Task Scheduling</a></li>
            <li class="<?php echo ($this->data['title'] == 'Finances') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/finance/index" >Finances</a></li>
            <li class="nav-divider"></li>
            <li id="NavSettings"><a>Settings</a></li>
            <li class="<?php echo ($this->data['title'] == 'Flat Settings') ? 'active' : '' ?> indent"><a href="<?= URL ?>/settings/flatSettings">Flat Settings</a></li>
            <li class="<?php echo ($this->data['title'] == 'User Settings') ? 'active' : '' ?> indent"><a href="<?= URL ?>/settings/userSettings">User Settings</a></li>
        </ul>
    </div>
</div>