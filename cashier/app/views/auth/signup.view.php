<?php require views_path('partials/header'); ?>

<style>
    body {
        background-color: #f9f5f1; /* Light coffee color */
        font-family: 'Arial', sans-serif;
    }

    .form-container {
        background-color: #ffffff; /* White background for the form */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        padding: 30px; /* Padding for spacing */
    }

    .form-label {
        color: #6f4c3e; /* Dark coffee color for labels */
    }

    .text-danger {
        font-size: 0.9em; /* Slightly smaller error text */
    }

    .btn-primary {
        background-color: #6f4c3e; /* Dark coffee color */
        border: none;
    }

    .btn-primary:hover {
        background-color: #5b3d30; /* Darker shade on hover */
    }

    .btn-danger {
        background-color: #d9534f; /* Bootstrap danger color */
        border: none;
    }

    .btn-danger:hover {
        background-color: #c9302c; /* Darker shade on hover */
    }

    h3 {
        color: #6f4c3e; /* Dark coffee color for heading */
    }
</style>

<div class="container-fluid col-lg-5 col-md-6 mt-5 p-4 form-container">
    <form method="post">
        <center>
            <h3><i class="fa fa-coffee"></i> Create User</h3>
            <div><?=esc(APP_NAME)?></div>
        </center>
    
        <br>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input value="<?=set_value('username')?>" name="username" type="text" class="form-control" id="username" placeholder="Username">
            <?php if(!empty($errors['username'])):?> 
                <small class="text-danger"><?=$errors['username']?></small>
            <?php endif;?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input value="<?=set_value('email')?>" name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
            <?php if(!empty($errors['email'])):?> 
                <small class="text-danger"><?=$errors['email']?></small>
            <?php endif;?>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="male" <?=set_value('gender') == 'male' ? 'selected' : ''?>>Male</option>
                <option value="female" <?=set_value('gender') == 'female' ? 'selected' : ''?>>Female</option>
            </select>
            <?php if(!empty($errors['gender'])):?> 
                <small class="text-danger"><?=$errors['gender']?></small>
            <?php endif;?>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="password-addon">Password</span>
            <input value="<?=set_value('password')?>" name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
            <?php if(!empty($errors['password'])):?> 
                <small class="text-danger col-12"><?=$errors['password']?></small>
            <?php endif;?>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="retype-password-addon">Retype Password</span>
            <input value="<?=set_value('password_retype')?>" name="password_retype" type="password" class="form-control" placeholder="Retype Password" aria-label="Retype Password" aria-describedby="retype-password-addon">
            <?php if(!empty($errors['password_retype'])):?> 
                <small class="text-danger col-12"><?=$errors['password_retype']?></small>
            <?php endif;?>
        </div>

        <br>
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary">Create</button>
            <a href="index.php?page_name=admin&tab=users">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </div>
    </form>
</div>

<?php require views_path('partials/footer'); ?>
