<?php global $s_v_data, $user, $title, $stats, $accounts, $expenses, $categories; ?>
<?= view( 'includes/header', $s_v_data ); ?>
<body>
<?= view( 'includes/navbar', $s_v_data ); ?>
<!-- Main content -->
<div class="container">
    <div class="page-heading">
            <button class="btn btn-primary pull-right ml-5" type="button" data-toggle="modal" data-target="#addExpense"><span><i class="mdi mdi-plus-circle-outline"></i></span> Add Expense </button>
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
                <p>These are your expenses. Keep them low.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4>Expense records</h4>
              </div>
              <div class="card-body">
                  <div class="table-responsive longer">
                      <table class="table display" id="datatable">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Date</th>
                                  <th>Amount</th>
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php if (count($expenses) > 0) { ?>
                            <?php foreach ($expenses as $expense) { ?> 
                              <tr>
                                  <td><strong><?= $expense->title; ?></strong><br>
                                    <?php if (empty($expense->name)) { ?>
                                    <span>Other </span>
                                    <?php } else { ?>
                                    <span><?=  $expense->name; ?> </span>
                                    <?php } ?>
                                  </td>
                                  <td><span><?= date('M d, Y', strtotime($expense->expense_date)); ?></span><br>
                                    <?php if (empty($expense->category)) { ?>
                                    <p class="text-danger">Other </p>
                                    <?php } else { ?>
                                    <p class="text-danger"><?=  $expense->category; ?> </p>
                                    <?php } ?>
                                    </td>
                                  <td><strong><?= money($expense->amount); ?></strong><br><span>Spent</span></td>
                                  <td><strong><i class="mdi mdi-checkbox-blank-circle text-info"></i> Completed</strong></td>
                                  <td>
                                      <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span> </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="c-dropdown__item dropdown-item fetch-display-click" url="<?= url('Expenses@updateview'); ?>" data="csrf-token:<?= csrf_token(); ?>|expenseid:<?= $expense->id; ?>" holder=".update-form" modal="#update" href=""><i class="mdi mdi-pencil"></i> Edit</a></li>
                                            <li><a class="send-to-server-click" data="csrf-token:<?= csrf_token(); ?>|expenseid:<?= $expense->id; ?>" url="<?=  url('Expenses@delete') ; ?>" warning-title="Are you sure?" warning-message="This expense will be deleted permanently" warning-button="Continue" loader="true"><i class="mdi mdi-delete"></i> Delete</a></li>
                                        </ul>
                                      </div>
                                  </td>
                              </tr>
                              <?php } ?>
                              <?php } else { ?>
                              <tr>
                                <td colspan="5" class="text-center">It's empty here!</td>
                              </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4><?=  date("M") ; ?> Budget Usage</h4>
              </div>
              <div class="card-body">
                    <section class="text-center mt-15">
                      <svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
                        <circle class="circle-chart__background" stroke="#efefef" stroke-width="2" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
                        <circle class="circle-chart__circle" stroke="#F4BE4A" stroke-width="2" stroke-dasharray="<?=  $stats['percentage'] ; ?>,100" stroke-linecap="round" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
                        <g class="circle-chart__info">
                          <text class="circle-chart__percent" x="16.91549431" y="15.5" alignment-baseline="central" text-anchor="middle" font-size="8"><?=  $stats['percentage'] ; ?>%</text>
                          <text class="circle-chart__subline" x="16.91549431" y="20.5" alignment-baseline="central" text-anchor="middle" font-size="2"> <?=  money($stats['spent']) ; ?> Spent!</text>
                        </g>
                      </svg>
                      <div class="chart-insights">
                        <p>You have spent</p>
                        <h4><strong><?=  money($stats['spent']) ; ?></strong> out of <strong><?=  money($user->monthly_spending) ; ?></strong></h4>
                      </div>
                    </section>
                    <div></div>
              </div>
            </div>


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
    </div>

    
  <!-- footer -->
  <?= view( 'includes/footer', $s_v_data ); ?>
</div>


    <!-- view edit modal -->
    <div class="modal fade" id="update" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="update-form"></div>
      </div>
    </div>

    <!-- scripts -->
    <!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
    <script src="<?= asset('assets/libs/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js//jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/simcify.min.js'); ?>"></script>
    <!-- custom scripts -->
    <script src="<?= asset('assets/js/app.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }
                ]
            });
        });

    </script>
</body>
</html>

<?php return;
