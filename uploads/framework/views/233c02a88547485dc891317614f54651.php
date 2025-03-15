<?php global $s_v_data, $user, $title, $timezones, $currencies, $accounts, $categories; ?>

  <footer>
    <div class="footer-logo">
      <img src="<?=  asset('uploads/app/'.env('APP_LOGO')) ; ?>" class="img-responsive">
    </div>
    <p class="text-right pull-right">&copy; <?=  date("Y") ; ?> <?=  env("APP_NAME") ; ?> <span>•</span> All Rights Reserved.</p>
  </footer>


<!-- add income -->
    <div class="modal fade" id="addIncome" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Record Income</h4>
                </div>
                    <div class="modal-body">
                        <p>Save a new income record.</p>
                        <form class="simcy-form" action="<?=  url('Income@add') ; ?>" data-parsley-validate="" method="POST" loader="true">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="i.e Salary" required="">
                                    <input type="hidden" name="csrf-token" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Amount</label>
                                    <span class="input-prefix"><?=  currency() ; ?></span>
                                    <input type="number" class="form-control prefix"  step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" name="amount" min="0.01" placeholder="Amount" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Account</label>
                                    <select class="form-control select2" name="account">
                                        <option value="00">Other</option>
                                      <?php if (!empty($accounts)) { ?>
                                      <?php foreach ($accounts as $account) { ?>
                                        <option value="<?=  $account->id ; ?>"><?=  $account->name ; ?></option>
                                      <?php } ?>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>Group</label>
                                    <select class="form-control select2" name="income_group">
                                        <option value="Salary">Salary</option>
                                        <option value="Investments">Investments</option>
                                        <option value="Donations">Donations</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker" name="income_date" placeholder="Date" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Income</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <!--Record Expense-->
    <div class="modal fade" id="addExpense" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Record Expense</h4>
                </div>
                <form class="simcy-form" action="<?=  url('Expenses@add') ; ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <p>Save a new expense record.</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="i.e Water Bill" required="">
                                    <input type="hidden" name="csrf-token" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Amount</label>
                                    <span class="input-prefix"><?=  currency() ; ?></span>
                                    <input type="number" class="form-control prefix"  step="0.01" data-parsley-pattern="^[0-9]*\.[0-9]{2}$" min="0.01" name="amount" placeholder="Amount" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Account</label>
                                    <select class="form-control select2" name="account">
                                        <option value="00">Other</option>
                                      <?php if (!empty($accounts)) { ?>
                                      <?php foreach ($accounts as $account) { ?>
                                        <option value="<?=  $account->id ; ?>"><?=  $account->name ; ?></option>
                                      <?php } ?>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <label>Category</label>
                                        <select class="form-control select2" name="category">
                                            <?php if (!empty($categories)) { ?>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?=  $category->id ; ?>"><?=  $category->name ; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                            <option value="00">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker" name="expense_date" placeholder="Date" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Expense</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
<?php return;
