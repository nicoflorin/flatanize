<aside id="leftNav">
    <ul class="nav nav-pills nav-stacked">
        <!-- @Todo Dynamisch active class -->
        <li class="<?php echo ($this->data['title'] == 'Whiteboard') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/whiteboard/index"><i class="fa fa-comment fa-fw fa-lg"></i> Whiteboard</a></li>
        <li class="<?php echo ($this->data['title'] == 'Shopping List') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/shopping/index"><i class="fa fa-shopping-cart fa-fw fa-lg"></i> Shopping List</a></li>
        <li class="<?php echo ($this->data['title'] == 'Task Scheduling') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/task/index"><i class="fa fa-wrench fa-fw fa-lg"></i> Task Scheduling</a></li>
        <li class="<?php echo ($this->data['title'] == 'Finances') ? 'active' : '' ?>" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>><a href="<?= URL ?>/finance/index" ><i class="fa fa-usd fa-fw fa-lg"></i> Finances</a></li>
        <li id="NavSettings"><a><i class="fa fa-gears fa-fw fa-lg"></i> Settings <b class="caret"></b></a></li>
        <li class="<?php echo ($this->data['title'] == 'Flat Settings') ? 'active' : '' ?>"><a href="<?= URL ?>/settings/flatSettings" class="indent"><i class="fa fa-building fa-fw fa-lg"></i> Flat Settings</a></li>
        <li class="<?php echo ($this->data['title'] == 'User Settings') ? 'active' : '' ?>"><a href="<?= URL ?>/settings/userSettings" class="indent"><i class="fa fa-street-view fa-fw fa-lg"></i> User Settings</a></li>
    </ul>
</aside>