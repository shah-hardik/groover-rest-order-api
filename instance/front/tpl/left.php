<?php if (!in_array($_SESSION['user'], array('admin@admin.com'))) : ?>
    <?php include "left_user.php"; ?>
<?php else: ?>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="navbar-header">
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php l('home') ?>" style="color:#00ccff">Grover Allman Zazzle Order Interface</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="<?php l('new_orders') ?>">New Orders</a></li>
            <li><a href="<?php l('archived_orders') ?>">Archived Orders</a></li>
        </ul>
        <?php $admin =($_SESSION['user']); ?>
        <ul class="nav navbar-nav navbar-right">
    <li class="">
              <a href="#">  <i class="fa fa-user" >&nbsp;</i><?php if ($admin == 'admin@admin.com'): print 'Admin'; else: print $admin; endif; ?>&nbsp;</a>
               
            </li>
              <li><a href="<?php print _U ?>?logout=1"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<?php endif; ?>
