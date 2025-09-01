<style>
    .stat-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        text-align: center;
        background: #f9f9f9; /* Light background for contrast */
        transition: transform 0.2s, box-shadow 0.2s; /* Smooth hover effect */
        text-decoration: none; /* Remove underline from link */
        color: inherit; /* Inherit text color */
    }
    
    .stat-card:hover {
        transform: translateY(-5px); /* Lift effect on hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Enhanced shadow */
    }

    .stat-card h4 {
        color: #555; /* Darker color for headings */
        margin-bottom: 10px;
    }

    .stat-card h1 {
        color: #333; /* Darker color for numbers */
        font-size: 2.5rem; /* Larger font size */
        margin: 0;
    }

    .stat-card i {
        color: #6f4c3e; /* Color for icons */
        margin-bottom: 15px; /* Spacing below icon */
    }
</style>

<div class="row justify-content-center">
    <!-- Total Users card clickable -->
    <a href="index.php?page_name=admin&tab=users" class="col-md-3 stat-card shadow">
        <i class="fa fa-user" style="font-size: 30px"></i>
        <h4>Total Users:</h4>
        <h1><?=$total_users?></h1>
    </a>
    
    <!-- Total Drinks card clickable -->
    <a href="index.php?page_name=admin&tab=products" class="col-md-3 stat-card shadow">
        <i class="fa fa-mug-hot" style="font-size: 30px"></i>
        <h4>Total Drinks:</h4>
        <h1><?=$total_drinks?></h1>
    </a>
    
    <!-- Total Sales card clickable -->
    <a href="index.php?page_name=admin&tab=sales" class="col-md-3 stat-card shadow">
        <i class="fa fa-money-bill-wave" style="font-size: 30px"></i>
        <h4>Total Sales:</h4>
        <h1>₱ <?=$total_sales?></h1>
    </a>
</div>
