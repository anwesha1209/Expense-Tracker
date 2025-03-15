<?php global $s_v_data, $title, $user, $stats, $accounts, $categories, $budgets; ?>
<?= view( 'includes/header', $s_v_data ); ?>
<body>
<?= view( 'includes/navbar', $s_v_data ); ?>
<!-- Main content -->
<div class="container">
    <div class="page-heading">
            <button class="btn btn-default pull-right ml-5" type="button" data-toggle="modal" data-target="#create" data-backdrop="static" data-keyboard="false"><span><i class="mdi mdi-adjust"></i></span> Adjust </button>
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
                <p>This is your budgeting page. Do it wisely.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4>Budgeting Chart</h4>
              </div>
              <div class="card-body">
                <div id="container" style="height: 400px"></div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4><?=  date("M") ; ?> Budgeting Goals</h4>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table display table-striped" id="datatable">
                          <tbody>
                              <?php if (!empty($budgets)) { ?>
                              <?php foreach ($budgets as $key => $budget) { ?>
                                <tr>
                                    <td><span class="badge badge-success"><?=  $key + 1 ; ?></span></td>
                                    <td><strong><?=  $budget->name ; ?></strong><br><span>Updated: <?=  date('j M, Y',strtotime($budget->updated_at)); ?></span></td>
                                    <td><strong><?=  money($budget->spent) ; ?></strong><br><span>Spent</span></td>
                                    <td><strong><?=  money($budget->budget) ; ?></strong><br><span>Set Goal</span></td>
                                    <td><strong><?=  $budget->transactions ; ?></strong><br><span>Transactions</span></td>
                                    <td>
                                      <div>
                                          <strong class="pull-right"><?=  money($budget->spent) ; ?> / <?=  money($budget->budget) ; ?></strong>
                                          <span>Progress</span>
                                          <div class="progress progress-bar-success-alt">
                                              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?=  $budget->percentage ; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=  $budget->percentage ; ?>%">
                                              </div>
                                          </div>
                                      </div>
                                    </td>
                                </tr>
                              <?php } ?>
                              <?php } else { ?> 
                              <tr class="text-center"><td colspans="6">It is empty here</td></tr>
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

<!--Record Income-->
<div class="modal budget fade" id="create" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form class="simcy-form" action="<?=  url('Budget@adjust') ; ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="tab-content">
                    <div id="adjust" class="tab-pane fade in active">
                      <div class="row">
                        <div class="col-md-6 float-center">
                          <div class="adjust-info text-center">
                              <?php if (empty($user->avatar)) { ?>
                              <img src="<?=  asset('assets/images/avatar.png') ; ?>" class="img-circle img-responsive">
                              <?php } else { ?>
                              <img src="<?=  asset('uploads/avatar/'.$user->avatar) ; ?>" class="img-circle img-responsive">
                              <?php } ?>
                              <h2>What's up <?=  $user->fname; ?>!</h2>
                              <p>Create a budget of how much you want to spend, save and earning goals. Also distribute your budget.</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 float-center">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <label>I want to spend ( Monthly )</label>
                                          <span class="input-prefix"><?=  currency() ; ?></span>
                                          <input type="number" class="form-control prefix" name="monthly_spending" step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" value="<?=  $user->monthly_spending ; ?>" placeholder="i.e 4000" required>
                                          <span class="help">Per Month</span>
                                          <input type="hidden" name="csrf-token" value="" />
                                      </div>
                                      <div class="col-md-6">
                                          <label>I want to spend ( Annualy )</label>
                                          <span class="input-prefix"><?=  currency() ; ?></span>
                                          <input type="number" class="form-control prefix" name="annual_spending" step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" value="<?=  $user->annual_spending ; ?>" placeholder="i.e 12000" id="annualspend" required>
                                          <span class="help">Per Year</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <label>I want to save ( Monthly )</label>
                                          <span class="input-prefix"><?=  currency() ; ?></span>
                                          <input type="number" class="form-control prefix" name="monthly_saving" step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" value="<?=  $user->monthly_saving ; ?>" placeholder="i.e 4000" required>
                                          <span class="help">Per Month</span>
                                      </div>
                                      <div class="col-md-6">
                                          <label>I plan to Earn ( Monthly )</label>
                                          <span class="input-prefix"><?=  currency() ; ?></span>
                                          <input type="number" class="form-control prefix" name="monthly_earning" step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" value="<?=  $user->monthly_earning ; ?>" placeholder="i.e 12000" required>
                                          <span class="help">Per Year</span>
                                      </div>
                                  </div>
                              </div>
                        </div>
                      </div>
                      <div class="adjust-actions text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span><i class="mdi mdi-close-circle-outline"></i></span> Cancel</button>
                        <button type="submit" class="btn btn-primary" data-toggle="tab" href="#distribute"><span><i class="mdi mdi-source-branch"></i></span> Distribute</button>
                      </div>
                    </div>
                    <?php if ( $stats['allocated'] > $user->monthly_spending ) { ?>
                    <div id="distribute" class="tab-pane fade exceeded">
                    <?php } else { ?>
                    <div id="distribute" class="tab-pane fade">
                    <?php } ?>
                      <div class="row">
                        <div class="col-md-8 float-center">
                      <a data-toggle="tab" href="#adjust"><h2><i class="mdi mdi-arrow-left-thick"></i></h2></a>
                          <div class="adjust-info text-center">
                              <h2>Let's Distribute!</h2>
                              <?php if ( $stats['allocated'] > $user->monthly_spending ) { ?>
                              <p class="adjust-text"><span class="text-danger">You have allocated more than budgeted for a month.</span></p>
                              <?php } else { ?>
                              <p class="adjust-text">Distribute your budget to categories.</p>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 float-center">
                          <div class="distribute">
                            <?php if (!empty($categories)) { ?>
                            <?php foreach ($categories as $category) { ?>
                            <div class="distribute-input">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <strong class="pull-right"><?=  currency() ; ?><span class="allocated-budget"><?=  $category->budget ; ?></span> / <?=  currency() ; ?><span class="total-budget"><?=  $user->monthly_spending ; ?></span> </strong>
                                          <label><?=  $category->name ; ?></label>
                                          <input type="hidden" name="category[]" value="<?=  $category->id ; ?>">
                                          <input class="budget-slider" type="text" name="budget[]" data-slider-min="0" data-slider-step="1" data-slider-value="<?=  $category->budget ; ?>" data-slider-max="<?=  $user->monthly_spending ; ?>"/>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <?php } ?>
                            <?php } else { ?>
                            <div class="distribute-input">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                          No categories to distribute.
                                        </div>
                                    </div>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="adjust-actions text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span><i class="mdi mdi-close-circle-outline"></i></span> Cancel</button>
                        <button class="btn btn-primary" type="submit"><span><i class="mdi mdi-content-save"></i></span> Save Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!--update Income-->
<div class="modal budget fade" id="update" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="updateform"></div>
    </div>
  </div>
</div>
<!-- scripts -->
<script src="<?= asset('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?= asset('assets/libs/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= asset('assets/libs/slider/bootstrap-slider.min.js'); ?>"></script>
<script src="<?= asset('assets/js//jquery.slimscroll.min.js'); ?>"></script>
<script src="<?= asset('assets/js/simcify.min.js'); ?>"></script>
<script src="<?= asset('assets/js/echarts.min.js'); ?>"></script>
<!-- custom scripts -->
<script src="<?= asset('assets/js/budget.js'); ?>"></script>
<script src="<?= asset('assets/js/app.js'); ?>"></script>
<script type="text/javascript">
      var subtext = "<?=  date('F Y', strtotime(date('Y-m').' -1 month')) ; ?> Vs <?=  date('F Y') ; ?>";
      var lastMonth = [<?=  implode(",", $stats["lastmonth"]) ; ?>];
      var thisMonth = [<?=  implode(",", $stats["thismonth"]) ; ?>];
</script>
</body>
</html>

<?php return;
