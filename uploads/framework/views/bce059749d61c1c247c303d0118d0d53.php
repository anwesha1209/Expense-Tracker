<?php global $s_v_data, $user, $accounts, $categories, $title, $stats, $reports; ?>
 <?= view( 'includes/header', $s_v_data ); ?>

<body>
    <?= view( 'includes/navbar', $s_v_data ); ?>
    <!-- Main content -->
    <div class="container">
        <div class="page-heading">
            <a class="btn btn-default pull-right ml-5" href="<?=  url('Budget@get') ; ?>"><span><i class="mdi mdi-adjust"></i></span> Check Budget </a>
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
                    <p>This is your Hellaplus dashboard. Overview of everything.</p>
                </div>
            </div>
        </div>

        <div class="row overview-widgets">
            <div class="col-md-4">
                <?php if ( $stats['percentage'] < 33 ) { ?>
                <div class="card bg-green text-white">
                <?php } else if ($stats['percentage'] < 66) { ?>
                <div class="card bg-info text-white">
                <?php } else if ($stats['percentage'] < 100) { ?>
                <div class="card bg-warning text-white">
                <?php } else if ($stats['percentage'] > 100) { ?>
                <div class="card bg-danger text-white">
                <?php } ?>
                  <div class="card-header">
                    <h4 class="text-white">Budget Status</h4>
                  </div>
                  <div class="card-body">
                    <div class="insight-card text-center">

                      <?php if ( $stats['percentage'] < 33 ) { ?>
                      <h3>Looking Good, <?=  $user->fname ; ?>!</h3>
                      <?php } else if ($stats['percentage'] < 66) { ?>
                      <h3>Good progress, <?=  $user->fname ; ?>!</h3>
                      <?php } else if ($stats['percentage'] < 100) { ?>
                      <h3>Almost there, <?=  $user->fname ; ?>!</h3>
                      <?php } else if ($stats['percentage'] > 100) { ?>
                      <h3>Ooh <?=  $user->fname ; ?>!</h3>
                      <?php } ?>

                      <?php if ($stats['percentage'] > 100) { ?>
                      <p>You have spent <?=  money($stats['spent']) ; ?> which is <?=  $stats['percentage'] - 100 ; ?>% more than your expected monthly budget. Nothing left to spend :( </p>
                      <?php } else { ?>
                      <p>You have spent <?=  $stats['percentage'] ; ?> % of your expected monthly budget. You still have <?=  100 - $stats['percentage'] ; ?> % to go. </p>
                      <?php } ?>
                      <a href="<?=  url('Budget@get') ; ?>" >Adjust Budget <span><i class="mdi mdi-hand-pointing-right"></i></span></a>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Transactions</h4>
                    </div>
                    <div class="card-body overflow">
                        <div class="transaction-amount">
                            <!-- item -->
                            <div class="transaction-amount-item">
                                <div class="transaction-icon">
                                    <i class="mdi mdi-checkbox-blank-circle text-primary"></i>
                                </div>
                                <div class="transaction-info">
                                    <strong><?=  money($stats['income']) ; ?></strong>
                                    <span>Income</span>
                                </div>
                            </div>
                            <!-- item -->
                            <div class="transaction-amount-item">
                                <div class="transaction-icon">
                                    <i class="mdi mdi-checkbox-blank-circle text-danger"></i>
                                </div>
                                <div class="transaction-info">
                                    <strong><?=  money($stats['expenses']) ; ?></strong>
                                    <span>Expenses</span>
                                </div>
                            </div>
                            <!-- item -->
                            <div class="transaction-amount-item">
                                <div class="transaction-icon">
                                    <i class="mdi mdi-checkbox-blank-circle text-info"></i>
                                </div>
                                <div class="transaction-info">
                                    <strong><?=  money($stats['savings']) ; ?></strong>
                                    <span>Savings</span>
                                </div>
                            </div>
                        </div>

                        <div class="transaction-visual">
                            <div id="transactions" style="height: 200px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Budget Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="transaction-progress">
                            <div class="item mt-5">
                                <strong class="pull-right"><?=  $stats['expenseTransactions'] ; ?> Transactions</strong>
                                <p class="text-muted"> <i class="mdi mdi-checkbox-blank-circle-outline text-info"></i> Expenses</p>
                                <div class="progress progress-bar-primary-alt">
                                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width:<?=  $stats['expensePercentage'] ; ?>%">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <strong class="pull-right"><?=  $stats['incomeTransactions'] ; ?> Transactions</strong>
                                <p class="text-muted"> <i class="mdi mdi-checkbox-blank-circle-outline text-primary"></i> Income</p>
                                <div class="progress progress-bar-success-alt">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width:<?=  $stats['incomePercentage'] ; ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row transaction-links">
                                <div class="col-md-12">
                                    <p class="text-center view-all-transaction">View all transaction records</p>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?=  url('Expenses@get') ; ?>" class="btn btn-danger btn-block" type="button"> Expenses</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?=  url('Income@get') ; ?>" class="btn btn-primary btn-block" type="button"> Income</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="range">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="reportrange" id="reportrange" name="reportrange">
                            <i class="mdi mdi-calendar-text"></i>&nbsp;
                            <span></span>
                            <i class="mdi mdi-menu-down-outline"></i>
                        </div>
                        <h4><span class="reports-title">Last 30 Days</span> activities</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 figure-stats">
                                <div class="figure-section">
                                    <p>Total Income</p>
                                    <span class="badge badge-primary pull-right income-count" data-toggle="tooltip" data-original-title="Transactions"><?=  $reports['income']['count'] ; ?> Trns.</span>
                                    <h2 class="text-primary reports-income"><?=  $reports['income']['total'] ; ?></h2>
                                </div>
                                <div class="figure-section">
                                    <p>Total Expenses</p>
                                    <span class="badge badge-danger pull-right expenses-count" data-toggle="tooltip" data-original-title="Transactions"><?=  $reports['expenses']['count'] ; ?> Trns.</span>
                                    <h2 class="text-danger reports-expenses"><?=  $reports['expenses']['total'] ; ?></h2>
                                </div>
                                <div class="figure-section">
                                    <span class="pull-right text-primary"> Amount</span>
                                    <p>Top Expenses</p>
                                    <table>
                                        <tbody class="top-expenses">
                                            <?php if (!empty($reports['expenses']['top'])) { ?>
                                            <?php foreach ($reports['expenses']['top'] as $topExpense) { ?>
                                              <tr>
                                                <td><?=  $topExpense->title ; ?></td>
                                                <td class="text-right"><?=  $topExpense->amount ; ?></td>
                                              </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                              <tr>
                                                <td class="text-center">It's empty here!</td>
                                              </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div id="monthly" style="height: 379px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary pull-right ml-5" type="button" data-toggle="modal" data-target="#create"><span><i class="mdi mdi-plus-circle-outline"></i></span> Add Account </button>
                        <h4>Accounts</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive longer">
                            <table class="table display" id="datatable">
                                <tbody>
                                    <?php if (!empty($accounts)) { ?>
                                    <?php foreach ($accounts as $account) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="icon-account"><i class="mdi mdi-briefcase"></i></div>
                                        </td>
                                        <td><strong><?=  $account->name ; ?></strong>
                                            <br><span><?=  $account->type ; ?></span></td>

                                        <td><strong><?=  money($account->balance) ; ?></strong>
                                            <br><span>Balance</span></td>
                                        <td><strong><?=  $account->transactions ; ?></strong>
                                            <br><span>Transactions</span></td>
                                        <td><strong><?=  date('M d, Y', strtotime($account->updated_at)) ; ?></strong>
                                            <br><span>Updated On</span></td>
                                        <td>
                                            <?php if ($account->status == 'Active') { ?>
                                            <strong class="text-primary"><i class="mdi mdi-checkbox-blank-circle"></i> Active</strong>
                                            <?php } else { ?>
                                            <strong class="text-danger"><i class="mdi mdi-checkbox-blank-circle"></i> Inactive</strong>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="c-dropdown__item dropdown-item fetch-display-click" url="<?= url('Overview@updateaccountview'); ?>" data="csrf-token:<?= csrf_token(); ?>|accountid:<?= $account->id; ?>" holder=".update-form" modal="#update" href=""><i class="mdi mdi-pencil"></i> Edit</a></li>
                                                    <li><a class="send-to-server-click" data="csrf-token:<?= csrf_token(); ?>|accountid:<?= $account->id; ?>" url="<?=  url('Overview@deleteaccount') ; ?>" warning-title="Are you sure?" warning-message="You want to delete this account?." warning-button="Continue" loader="true"><i class="mdi mdi-delete"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center">It's empty here!</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?= view( 'includes/footer', $s_v_data ); ?>

    </div>

    <!--Add Account-->
    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Account</h4>
                </div>
                <form class="simcy-form" action="<?=  url('Overview@createaccount') ; ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <p>Create a new account.</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="i.e Paypal">
                                    <input type="hidden" name="csrf-token" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Account balance</label>
                                    <span class="input-prefix"><?=  currency() ; ?></span>
                                    <input type="number" class="form-control prefix" step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" name="balance" placeholder="Account balance">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Type</label>
                                    <select class="form-control select2" name="type">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Card">Card</option>
                                        <option value="E-Wallet">E-Wallet</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Account</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
        <!-- view edit modal -->
    <div class="modal fade" id="update" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="update-form"></div>
      </div>
    </div>
    <!-- scripts -->
    <script src="<?=  asset('assets/js/jquery-3.2.1.min.js') ; ?>"></script>
    <script src="<?=  asset('assets/js/moment.min.js') ; ?>"></script>
    <script src="<?=  asset('assets/libs/bootstrap/js/bootstrap.min.js') ; ?>"></script>
    <script src="<?=  asset('assets/libs/daterangepicker/daterangepicker.js') ; ?>"></script>
    <script src="<?=  asset('assets/js//jquery.slimscroll.min.js') ; ?>"></script>
    <script src="<?=  asset('assets/js/simcify.min.js') ; ?>"></script>
    <script src="<?=  asset('assets/js/echarts.min.js') ; ?>"></script>
    <!-- custom scripts -->
    <script src="<?=  asset('assets/js/overview.js') ; ?>"></script>
    <script src="<?=  asset('assets/js/app.js') ; ?>"></script>
    <script type="text/javascript">

        // doughnut
        var totalIncome = <?=  $stats['income'] ; ?>,
            totalExpenses = <?=  $stats['expenses'] ; ?>,
            totalSavings = <?=  $stats['savings'] ; ?>,
            currency = "<?=  currency() ; ?>",
            reportsUrl = "<?=  url('Overview@getreports') ; ?>";

      // graph
      var labels = ["<?=  implode('", "', $reports['chart']['label']) ; ?>"];
      var income = [<?=  implode(', ', $reports['chart']['income']) ; ?>];
      var expenses = [<?=  implode(', ', $reports['chart']['expenses']) ; ?>];

    </script>
</body>

</html>
<?php return;
