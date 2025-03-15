<?php global $s_v_data, $user, $title, $timezones, $currencies, $accounts, $categories; ?>
<header>
    <!-- Humbager -->
    <div class="humbager">
        <i class="mdi mdi-menu"></i>
    </div>
    <!-- logo -->
    <div class="branding">
        <a href="<?=  url('') ; ?>">
            <img src="<?=  asset('uploads/app/'.env('APP_LOGO')) ; ?>" class="img-responsive">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="navigation">
        <ul class="nav navbar-nav">
          <li><a href="<?=  url('Overview@get') ; ?>">Overview</a></li>
          <li><a href="<?=  url('Expenses@get') ; ?>">Expenses</a></li>
          <li><a href="<?=  url('Income@get') ; ?>">Income</a></li>
          <li><a href="<?=  url('Budget@get') ; ?>">Budget</a></li>
          <li class="close-menu"><a href=""><i class="mdi mdi-close-circle-outline"></i> Close</a></li>
        </ul>
    </nav>

    <!-- Right content -->
    <div class="header-right">
        <div class="dropdown hidden-sm hidden-xs">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span><i class="mdi mdi-plus-circle-outline"></i></span> New record</button>
          <ul class="dropdown-menu">
              <li role="presentation"><a role="menuitem" data-toggle="modal" data-target="#addExpense"> <i class="mdi mdi-chevron-right"></i> Expense</a></li>
              <li role="presentation"><a role="menuitem" data-toggle="modal" data-target="#addIncome"> <i class="mdi mdi-chevron-right"></i> Income</a></li>
          </ul>
        </div>
        <div class="dropdown">
            <span class="dropdown-toggle" data-toggle="dropdown">
                <span class="avatar">
                    <?php if (empty(user()->avatar)) { ?>
                     <img src="<?=  asset('assets/images/avatar.png') ; ?>" class="img-circle">
                    <?php } else { ?> 
                     <img src="<?=  asset('uploads/avatar/'.$user->avatar) ; ?>" class="img-circle">
                    <?php } ?>
                </span>
                <span class="profile-name"> 
                    <span class="hidden-xs"><?=  $user->fname; ?> <?=  $user->lname; ?></span> 
                    <i class="mdi mdi-menu-down-outline"></i> 
                </span>
            </span>
            <ul class="dropdown-menu profile-menu" role="menu" aria-labelledby="menu1">
              <?php if ($user->role == 'admin') { ?>
              <li role="presentation"><a role="menuitem" href="<?=  url('Users@get') ; ?>"> <i class="mdi mdi-account-multiple"></i> Users</a></li>
              <?php } ?>
              <li role="presentation"><a role="menuitem" href="<?=  url('Settings@get') ; ?>"> <i class="mdi mdi-settings"></i> Settings</a></li>
              <li role="presentation"><a role="menuitem" href="<?=  url('Auth@signout') ; ?>"> <i class="mdi mdi-logout"></i> Logout</a></li>
            </ul>
          </div>
    </div>
</header>
<?php return;
