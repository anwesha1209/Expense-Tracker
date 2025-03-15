<?php global $s_v_data, $user, $title, $timezones, $currencies, $accounts, $categories; ?>
<?= view( 'includes/header', $s_v_data ); ?>
<body>
<?= view( 'includes/navbar', $s_v_data ); ?>
<!-- Main content -->
<div class="container">
    <div class="page-heading">
            <a class="btn btn-default pull-right ml-5" href="<?=  url('Budget@get') ; ?>" ><span><i class="mdi mdi-adjust"></i></span> Check Budget </a>
        <div class="heading-content">
            <div class="user-image">
                <?php if (empty($user->avatar)) { ?>
                <img src="<?=  asset('assets/images/avatar.png') ; ?>" class="img-circle img-responsive">
                <?php } else { ?>
                <img src="<?=  asset('uploads/avatar/'.$user->avatar) ; ?>" class="img-circle img-responsive">
                <?php } ?>
            </div>
            <div class="heading-title">
                <h2>Welcome back, <?= $user->fname; ?> <?= $user->lname; ?></h2>
                <p>This is your settings page. Take control!</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="settings-menu">
              <nav class="navbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a data-toggle="tab" href="#profile"><span><i class="mdi mdi-account"></i></span>  Profile</a></li>
                  <li><a data-toggle="tab" href="#categories"><span><i class="mdi mdi-theme-light-dark"></i></span>  Categories</a></li>
                  <?php if ( $user->role == "admin" ) { ?> 
                  <li><a data-toggle="tab" href="#system"><span><i class="mdi mdi-settings"></i></span>  System</a></li>
                  <?php } ?>
                  <li><a data-toggle="tab" href="#security"><span><i class="mdi mdi-lock"></i></span>  Security</a></li>
                </ul>
            </nav>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
              <div class="card-body p-zero">
                
                        <div class="tab-content settings">
                            <div class="row">
                                <div class="col-md-6">
                                  <div id="profile" class="tab-pane fade in active">
                                        <h3>Profile</h3>
                                        <p class="text-muted text-thin">Update your personal information</p>
                                        <form class="simcy-form" action="<?=  url('Settings@updateprofile'); ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Profile picture</label>
                                                          <?php if ( !empty($user->avatar) ) { ?>
                                                          <input type="file" name="avatar" class="croppie" default="<?=  url('') ; ?>uploads/avatar/<?=  $user->avatar ; ?>" crop-width="200" crop-height="200" accept="image/*">
                                                          <?php } else { ?>
                                                          <input type="file" name="avatar" class="croppie" crop-width="200" crop-height="200" accept="image/*">
                                                          <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>First name</label>
                                                        <input type="text" class="form-control" name="fname" value="<?=  $user->fname ; ?>" placeholder="First name" required>
                                                        <input type="hidden" name="csrf-token" value="<?=  csrf_token() ; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Last name</label>
                                                        <input type="text" class="form-control" name="lname" value="<?=  $user->lname ; ?>" placeholder="Last name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Email address</label>
                                                        <input type="email" class="form-control" name="email" value="<?=  $user->email ; ?>" placeholder="Email address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Phone number</label>
                                                        <input type="text" class="form-control" name="phone" value="<?=  $user->phone ; ?>" placeholder="Phone number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" name="address" value="<?=  $user->address ; ?>" placeholder="Address">
                                                    </div>
                                                </div>
                                            </div>
                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label>Currency</label>
                                                  <select class="form-control select2" name="currency" required="">
                                                    <?php foreach ( $currencies as $currency ) { ?>
                                                    <option value="<?=  $currency->code ; ?>" <?php if ( $currency->code == $user->currency ) { ?> selected <?php } ?>><?=  $currency->name ; ?> - <?=  $currency->code ; ?></option>
                                                    <?php } ?>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label>Time Zone</label>
                                                  <select class="form-control select2" name="timezone" required="">
                                                    <?php foreach ( $timezones as $timezone ) { ?>
                                                    <option value="<?=  $timezone->zone ; ?>" <?php if ( $timezone->zone == $user->timezone ) { ?> selected <?php } ?>><?=  $timezone->name ; ?></option>
                                                    <?php } ?>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                  </div>
                                  <div id="categories" class="tab-pane fade">
                                    <h3>Categories</h3>
                                    <p class="text-muted text-thin">Manage your income and expense categories</p>
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th class="text-center">No.</th>
                                          <th>Category</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if (!empty($categories)) { ?>
                                           <?php foreach ($categories as $key => $category) { ?>
                                            <tr>
                                            <td class="text-center"><label class="badge"><?=  $key + 1; ?></label></td>
                                            <td><strong><?=  $category->name ; ?></strong><br></td>
                                            <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                                                    <li role="presentation"><a role="menuitem" class="fetch-display-click" href="" url="<?=  url('Settings@updatecategoryview') ; ?>" data="csrf-token:<?=  csrf_token(); ?>|categoryid:<?=  $category->id ; ?>" holder=".update-form" modal="#update"> <i class="mdi mdi-pencil"></i> Edit</a></li>
                                                    <li role="presentation"><a role="menuitem" data="categoryid:<?=  $category->id ; ?>|csrf-token:<?= csrf_token(); ?>" href="" url="<?=  url('Settings@deletecategory') ; ?>" class="send-to-server-click" warning-title="Are you sure?" warning-message="This category and related records will be deleted." warning-button="Proceed"> <i class="mdi mdi-delete"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                            </td>
                                            </tr>
                                           <?php } ?>
                                        <?php } else { ?>
                                        <tr class="text-center"><td colspan="3">It's empty</td></tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#create"><span><i class="mdi mdi-plus-circle-outline"></i></span>  Add Category</button>
                                        </div>
                                    </div>
                                  </div>
                                  <div id="system" class="tab-pane fade">
                                    <h3>System</h3>
                                    <p class="text-muted text-thin">Manage System settings and preferences</p>

                                    <form class="simcy-form" action="<?=  url('Settings@updatesystem'); ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" value="<?=  csrf_token() ; ?>" name="csrf-token">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>System name</label>
                                                    <input type="text" class="form-control system-name" placeholder="System name" name="APP_NAME" value="<?=  env('APP_NAME') ; ?>" required>
                                                    <input type="hidden" name="csrf-token" value="<?=  csrf_token() ; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>System Logo </label>
                                                    <input type="file" name="APP_LOGO" class="croppie" default="<?=  asset('uploads/app/'.env('APP_LOGO')) ; ?>" crop-width="326" crop-height="78" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>System favicon/icon </label>
                                                    <input type="file" name="APP_ICON" class="croppie" default="<?=  asset('uploads/app/'.env('APP_ICON')) ; ?>" crop-width="66" crop-height="66" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>SMTP Username</label>
                                                    <input type="text" class="form-control" name="MAIL_USERNAME" placeholder="SMTP Username" value="<?=  env('MAIL_USERNAME') ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>SMTP Host</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Host" name="SMTP_HOST" value="<?=  env('SMTP_HOST') ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>SMTP Port</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Port" name="SMTP_PORT" value="<?=  env('SMTP_PORT') ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>SMTP Password</label>
                                                    <input type="password" class="form-control" placeholder="SMTP Password" name="SMTP_PASSWORD" value="<?=  env('SMTP_PASSWORD') ; ?>" autocomplete="false" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>SMTP Encryption</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Encryption" name="MAIL_ENCRYPTION" value="<?=  env('MAIL_ENCRYPTION'); ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>
                                                    <?php if ( env('SMTP_AUTH') == "Enabled" ) { ?> 
                                                    <input type="checkbox" class="switch" name="SMTP_AUTH" value="true" checked />
                                                    <?php } else { ?>
                                                    <input type="checkbox" class="switch" name="SMTP_AUTH" value="true" />
                                                    <?php } ?>
                                                    SMTP Authenticate.</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="divider"></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>
                                                    <?php if ( env('NEW_ACCOUNTS') == "Enabled" ) { ?> 
                                                    <input type="checkbox" class="switch" name="NEW_ACCOUNTS" value="Enabled" checked />
                                                    <?php } else { ?>
                                                    <input type="checkbox" class="switch" name="NEW_ACCOUNTS" value="Enabled" />
                                                    <?php } ?>
                                                    Allow new users & business to sign up</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                                  <div id="security" class="tab-pane fade">
                                    <h3>Security</h3>
                                    <p class="text-muted text-thin">Update your account password here</p>
                                        <form class="simcy-form" action="<?=  url('Settings@updatepassword') ; ?>" data-parsley-validate="" loader="true" method="POST">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Current password</label>
                                                        <input type="password" class="form-control" name="current" required placeholder="Current password">
                                                        <input type="hidden" name="csrf-token" value="<?=  csrf_token() ; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>New password</label>
                                                        <input type="password" class="form-control" name="password" data-parsley-required="true" data-parsley-minlength="6" data-parsley-error-message="Password is too short!" id="newPassword" placeholder="New password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Confirm password</label>
                                                        <input type="password" class="form-control" data-parsley-required="true" data-parsley-equalto="#newPassword" data-parsley-error-message="Passwords don't Match!" placeholder="Confirm password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                  </div>
                                </div>
                            </div>
                        </div>
              </div>
            </div>
        </div>
    </div>


  <!-- footer -->
  <?= view( 'includes/footer', $s_v_data ); ?>
</div>

    <!--Record Income-->
    <div class="modal fade" id="update" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="update-form"></div>
    </div>
    </div>

    <!--Record Income-->
    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category  </h4>
                </div>
                <form class="simcy-form" action="<?=  url('Settings@addcategory'); ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf-token" value="<?=  csrf_token() ; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>Category Name</label>
                                    <input type="text" class="form-control" name="category" placeholder="Category Name" data-parsley-required="true">
                                    <input type="hidden" name="csrf-token" value="<?=  csrf_token() ; ?> " />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add category</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- scripts -->
    <script src="<?= asset('assets/js/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?= asset('assets/libs/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/simcify.min.js'); ?>"></script>
    <!-- custom scripts -->
    <script src="<?= asset('assets/js/app.js'); ?>"></script>
</body>
</html>

<?php return;
