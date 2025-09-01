<?php require views_path('partials/header');?>
    
    <div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4 shadow">
        
        <?php if(is_array($row)):?>

            <center>
                <div><?=esc(APP_NAME)?></div>
            </center>
            <br>

            <table class="table table-hover table-striped">
                <tr>
                    <td colspan="2">
                            <img src="<?=crop($row['image'],400,$row['gender'])?>" style="width: 100px;max-width: 100px; height: 100px">
                    </td>
                </tr>
                <tr>
                    <th>Username</th><td><?=$row['username']?></td>
                </tr>
                <tr>
                    <th>Email</th><td><?=$row['email']?></td>
                </tr>
                <tr>
                    <th>Gender</th><td><?=$row['gender']?></td>
                </tr>
                <tr>
                    <th>Role</th><td><?=$row['role']?></td>
                </tr>
                <tr>
                    <th>Date Created</th><td><?=get_date($row['date'])?></td>
                </tr>

            </table>
            <br>
                <a href="index.php?page_name=edit-user&id=<?=$row['id']?>">
                    <button type="button" class="btn btn-danger">Edit</button>
                </a>

                <a href="index.php?page_name=admin&tab=users" class="float-end">
                    <button type="button" class="btn btn-primary">Back</button>
                </a>

        <?php else:?>
            <div class="alert alert-danger text-center">User not found!</div>

        <?php endif;?>
    
    </div>
 
    
<?php require views_path('partials/footer');?>
    
