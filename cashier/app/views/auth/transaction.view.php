<?php require views_path('partials/header');?>
<style>
    body {
        font-family: 'Arial', sans-serif; 
        background-color: #f9f5f1; 
        color: #4e3b32; 
    }

    .nav-tabs {
        border-bottom: 2px solid #6f4c3e; 
    }

    .nav-link {
        color: #4e3b32; 
        padding: 10px 15px; 
    }

    .nav-link.active {
        background-color: #6f4c3e; 
        color: #ffffff; 
    }

    .table-responsive {
        margin-top: 20px; 
        border-radius: 10px; 
        overflow: hidden; 
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); 
        background-color: #ffffff; 
    }

    .table th, .table td {
        padding: 15px; 
        text-align: center; 
    }

    .table th {
        background-color: #6f4c3e; 
        color: #ffffff; 
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f0e6d2; 
    }

    .table-striped tbody tr:hover {
        background-color: #d6c9b6; 
    }

    .btn {
        border-radius: 5px; 
        padding: 8px 12px; 
        transition: background-color 0.3s; 
    }

    .btn-success {
        background-color: #a86f55; 
        color: white; 
    }

    .btn-success:hover {
        background-color: #935d47; 
    }

    .btn-filter {
        background-color: #6f4c3e; 
        color: white; 
        width: 100px; 
        height: 38px; 
        margin-top: 22px; 
    }

    .btn-filter:hover {
        background-color: #5a3e32; 
    }

    .filter-form {
        margin-bottom: 20px; 
    }

    h2 {
        color: #6f4c3e; 
        text-align: left; 
        margin-top: 20px; 
    }

    .no-sales {
        text-align: center; 
        color: #777; 
        font-style: italic; 
    }
</style>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Transaction No.</th> <!-- Add Transaction No header -->
                <th>Receipt No.</th>
                <th>Description</th>
                <th>QTY</th>
                <th>Amount</th>
                <th>Total</th>
                <th>Cashier</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sales)): ?>
                <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td><?= esc($sale['transaction_no']) ?></td> <!-- Display Transaction No -->
                        <td><?= esc($sale['receipt_no']) ?></td>
                        <td><?= esc($sale['description']) ?></td>
                        <td><?= esc($sale['qty']) ?></td>
                        <td><?= esc($sale['amount']) ?></td>
                        <td><?= esc($sale['total']) ?></td>

                        <?php
                            $cashier = get_user_by_id($sale['user_id']);
                            $name = empty($cashier) ? "Unknown" : esc($cashier['username']);
                            $namelink = empty($cashier) ? "#" : "index.php?pg=profile&id=" . $cashier['id'];
                        ?>
                        <td>
                            <a href="<?= $namelink ?>"><?= esc($name) ?></a>
                        </td>

                        <td><?= date("jS M, Y", strtotime($sale['date'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="no-sales">No sales records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $pager->display(); ?>
</div>

<?php require views_path('partials/footer');?>
