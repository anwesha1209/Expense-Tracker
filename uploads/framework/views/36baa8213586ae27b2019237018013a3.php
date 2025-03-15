<?php global $s_v_data, $account; ?>
<div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Account</h4>
                </div>
                <form class="simcy-form" action="<?=  url('Overview@updateaccount') ; ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <p>Update <?= $account->name; ?> details.</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?= $account->name; ?>" name="name" placeholder="i.e Paypal">
                                    <input type="hidden" name="csrf-token" value="" />
                                    <input type="hidden" name="accountid" value="<?= $account->id; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Account balance</label>
                                    <span class="input-prefix"><?=  currency() ; ?></span>
                                    <input type="number" class="form-control prefix" value="<?= $account->balance; ?>" name="balance" placeholder="Account balance">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Type</label>
                                    <select class="form-control select2" name="type">
                                        <option value="Cash" <?php if ($account->type == 'Cash') { ?> selected <?php } ?> >Cash</option>
                                        <option value="Bank" <?php if ($account->type == 'Bank') { ?> selected <?php } ?> >Bank</option>
                                        <option value="Card" <?php if ($account->type == 'Card') { ?> selected <?php } ?> >Card</option>
                                        <option value="E-Wallet" <?php if ($account->type == 'E-Wallet') { ?> selected <?php } ?> >E-Wallet</option>
                                        <option value="Other" <?php if ($account->type == 'Other') { ?> selected <?php } ?> >Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status">
                                        <option value="Active" <?php if ($account->status == 'Active') { ?> selected <?php } ?> >Active</option>
                                        <option value="Inactive" <?php if ($account->status == 'Inactive') { ?> selected <?php } ?> >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Account</button>
                    </div>
                </form>
            </div>
<?php return;
