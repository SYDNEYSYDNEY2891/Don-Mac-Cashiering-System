<?php require views_path('partials/header'); ?>

<style>
    body {
        background-image: url("assests/images/background.jpg"); /* Light coffee color */
        font-family: 'Arial', sans-serif;
    }

    .admin-header {
        text-align: center;
        padding: 10px;
        color: white;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .dashboard {
        margin-top: 30px;
    }

    .list-group-item {
        background-color: #ffffff; /* White background */
        color: #4e3b32; /* Darker text color */
        transition: background-color 0.3s, box-shadow 0.3s;
        border: none;
        margin-bottom: 10px;
        padding: 10px 20px;
        border-radius: 30px; /* Rounded button look */
        text-align: center;
        font-weight: bold;
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #d6c9b6; /* Light hover effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Button hover shadow */
    }

    .list-group-item.active {
        background-color: #a86f55; /* Active button color */
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Stronger shadow for active button */
    }

    .content {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        background-color: #ffffff; /* Content background */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h4 {
        color: #6f4c3e; /* Heading color */
        margin-bottom: 20px;
    }
</style>

<div class="dashboard">
    <div class="container-fluid row">
        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
            <ul class="list-group">
                <a href="index.php?page_name=admin&tab=dashboard">
                    <li class="list-group-item <?=!$tab || $tab == 'dashboard'?'active':''?>">
                        <i class="fa fa-chart-line"></i> Dashboard
                    </li>
                </a>

                <a href="index.php?page_name=admin&tab=users">
                    <li class="list-group-item <?=$tab=='users'?'active':''?>">
                        <i class="fa fa-users"></i> Users
                    </li>
                </a>

                <a href="index.php?page_name=admin&tab=products">
                    <li class="list-group-item <?=$tab=='products'?'active':''?>">
                        <i class="fa fa-mug-hot"></i> Drinks
                    </li>
                </a>

                <a href="index.php?page_name=admin&tab=sales">
                    <li class="list-group-item <?=$tab=='sales'?'active':''?>">
                        <i class="fa fa-cash-register"></i> Sales
                    </li>
                </a>
            </ul>
        </div>

        <div class="border col p-3 content">
            <?php
                switch ($tab) {
                    case 'products':
                        require views_path('admin/products');
                        break;

                    case 'users':
                        require views_path('admin/users');
                        break;

                    case 'sales':
                        require views_path('admin/sales');
                        break;

                    default:
                        require views_path('admin/dashboard');
                        break;
                }
            ?>
        </div>
    </div>
</div>

<?php require views_path('partials/footer'); ?>
