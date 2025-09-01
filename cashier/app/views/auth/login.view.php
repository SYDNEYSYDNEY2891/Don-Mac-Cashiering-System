<?php require views_path('partials/header'); ?>

<style>
    body {
        background-image: url("assests/images/background.jpg"); /* Light coffee color */
        font-family: 'Arial', sans-serif;
    }

    .login-container {
        background-color: #ffffff; /* White background for the form */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        padding: 40px; /* Increased padding for spacing */
        text-align: center; /* Centered text */
    }

    .form-label {
        color: #6f4c3e; /* Dark coffee color for labels */
        text-align: left; /* Align labels to the left */
    }

    .text-danger {
        font-size: 0.9em; /* Slightly smaller error text */
    }

    .btn-primary {
        background-color: #6f4c3e; /* Dark coffee color */
        border: none;
        transition: background-color 0.3s; /* Smooth transition */
    }

    .btn-primary:hover {
        background-color: #5b3d30; /* Darker shade on hover */
    }

    h1 {
        color: #6f4c3e; /* Dark coffee color for heading */
    }

    h3 {
        color: #6f4c3e; /* Dark coffee color for subheading */
        margin-bottom: 20px; /* Spacing below */
    }

    .form-control {
        text-align: left; /* Align input text to the left */
    }
</style>

<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container col-lg-5 col-md-6 shadow">
        <h3>Login</h3>
        <div><?=esc(APP_NAME)?></div>
        
        <br>

        <form method="post">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email address</label>
                <input value="<?=set_value('email')?>" autocomplete="off" name="email" type="email" class="form-control" id="email" placeholder="Email" autofocus>
                <?php if(!empty($errors['email'])):?> 
                    <small class="text-danger"><?=$errors['email']?></small>
                <?php endif;?>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="password-addon">Password</span>
                <input value="<?=set_value('password')?>" name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                <?php if(!empty($errors['password'])):?> 
                    <small class="text-danger col-12"><?=$errors['password']?></small>
                <?php endif;?>
            </div>

            <br>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<?php require views_path('partials/footer'); ?>
