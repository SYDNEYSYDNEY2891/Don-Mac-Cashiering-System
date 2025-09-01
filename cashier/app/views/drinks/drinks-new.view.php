<?php require views_path('partials/header');?>

    <div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

        <form method="post" enctype="multipart/form-data">
            <h5><i class="fa fa-coffee"> Add Product</i></h5>
            
            <div class="mb-3">
                <label for="productControlInput1" class="form-label">Product description</label>
                <input name="description" type="text" class="form-control" id="productControlInput1" placeholder="Product description">
                    <?php if(!empty($errors['description'])):?> 
                        <small class="text-danger"><?=$errors['description']?></small>
                    <?php endif;?>
            
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Amount: </span>
                <input name="amount" value="0.00" step="0.05" type="number" class="form-control" placeholder="Amount" aria-label="Amount">
            </div>
                   
                    <?php if(!empty($errors['amount'])):?> 
                        <small class="text-danger"><?=$errors['amount']?></small>
                    <?php endif;?>
                    <br>
            <div class="mb-3">
                <label for="formFile" class="form-label">Product Image</label>
                <input name="image" class="form-control" type="file" id="formFile">
                    <?php if(!empty($errors['image'])):?> 
                        <small class="text-danger"><?=$errors['image']?></small>
                    <?php endif;?>
            
            </div>

            <br>
            <button class="btn btn-danger float-end">Save</button>

            <a href="index.php?page_name=admin&tab=products">
                <button type="button" class="btn btn-primary">Cancel</button>
            </a>
        </form>

    </div>





<?php require views_path('partials/footer');?>