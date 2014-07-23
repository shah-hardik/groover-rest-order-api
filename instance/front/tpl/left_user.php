<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="navbar-header">
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php ?>" style="color:#00ccff">Grover Allman Zazzle Order Interface</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="<?php l('user_dashboard') ?>">Users Dashboard </a></li>

        </ul>
       
        <?php $user =($_SESSION['user']); ?>
      
        <ul class="nav navbar-nav navbar-right">
    <li class="">
              <a href="#">  <i class="fa fa-user" >&nbsp;</i><?php print $user; ?>&nbsp;</a>
               
            </li>
              <li><a href="<?php print _U ?>?logout=1"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>