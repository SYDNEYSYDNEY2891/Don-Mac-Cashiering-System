<?php require views_path('partials/header');?>

    <div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">
        <?php if(!empty($row)):?>

        <form method="post" enctype="multipart/form-data">
            <h5><i class="fa fa-coffee"> Delete Product</i></h5>
            <div class="alert alert-danger text-center">Are you sure you want to delete this product?</div>
            
            <div class="mb-3">
                <label for="productControlInput1" class="form-label">Product description</label>
                <input disabled value="<?=set_value('description',$row['description'])?>" name="description" type="text" class="form-control" id="productControlInput1" placeholder="Product description">
                    <?php if(!empty($errors['description'])):?> 
                        <small class="text-danger"><?=$errors['description']?></small>
                    <?php endif;?>
            
            </div>

            <br>
            <img class="mx-auto d-block" src="<?=$row['image']?>" style="width: 30%;">

            <br>
            <button class="btn btn-danger float-end">Delete</button>

            <a href="index.php?page_name=admin&tab=products">
                <button type="button" class="btn btn-primary">Cancel</button>
            </a>
        </form>
        <?php else:?>
            That product was not found
            <br><br>
            <a href="index.php?page_name=admin&tab=products">
                <button type="button" class="btn btn-primary">Back to products</button>
            </a>
        <?php endif;?>

    </div>





<?php require views_path('partials/footer');?>