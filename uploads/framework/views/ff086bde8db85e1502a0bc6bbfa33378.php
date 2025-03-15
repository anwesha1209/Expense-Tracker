<?php global $s_v_data, $category; ?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit Category </h4>
    </div>
    <form class="simcy-form" action="<?=  url('Settings@updatecategory'); ?>" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf-token" value="<?=  csrf_token() ; ?>">
        <input type="hidden" name="categoryid" value="<?=  $category->id ; ?>">
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12 ">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category" placeholder="Category Name" data-parsley-required="true" value="<?=  $category->name ; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
<?php return;
