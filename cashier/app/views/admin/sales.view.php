<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f1e8; /* Light beige background */
        color: #3e2723; /* Dark brown text color */
    }
    

    .nav-tabs {
        border-bottom: 2px solid #6f4c3e; /* Darker brown */
    }

    .nav-link {
        color: #3e2723; /* Dark brown */
        padding: 10px 15px;
    }

    .nav-link.active {
        background-color: #6f4c3e; /* Dark brown */
        color: #ffffff;
    }

    .table-responsive {
        margin-top: 20px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        background-color: #e8e4c9; /* White background for the table */
    }

    .table th, .table td {
        padding: 15px;
        text-align: center;
    }

    .table th {
        background-color: #6f4c3e; /* Dark brown */
        color: #ffffff;
    }

    /* Light colors for transaction rows */
    .transaction-group-1 {
        background-color: #fce8d6; /* Light cream color */
        border-bottom: 2px solid #d9c9b2; /* Light tan for separation */
    }

    .transaction-group-2 {
        background-color: #e9f5e9; /* Light latte color */
        border-bottom: 2px solid #d9c9b2; /* Light tan for separation */
    }

    .btn {
        border-radius: 5px;
        padding: 8px 12px;
        transition: background-color 0.3s;
    }

    .btn-success {
        background-color: #6f4c3e; /* Dark brown */
        color: white;
    }

    .btn-success:hover {
        background-color: #5a3e32; /* Darker brown */
    }

    .btn-filter {
        background-color: #6f4c3e; /* Dark brown */
        color: white;
        width: 100px;
        height: 38px;
        margin-top: 22px;
    }

    .btn-filter:hover {
        background-color: #5a3e32; /* Darker brown */
    }

    .filter-form {
        margin-bottom: 20px;
    }

    h2 {
        color: #6f4c3e; /* Dark brown */
        text-align: left;
        margin-top: 20px;
    }

    .no-sales {
        text-align: center;
        color: #777;
        font-style: italic;
    }
</style>



<?php if($section == 'table'): ?>

<div class="filter-form">
    <form class="row float-end" action="index.php?page_name=admin&tab=sales" method="GET">
        <div class="col">
            <label for="start">Start Date:</label>
            <input class="form-control" id="start" type="date" name="start" value="<?= esc($_GET['start'] ?? '') ?>">
        </div>
        <div class="col">
            <label for="end">End Date:</label>
            <input class="form-control" id="end" type="date" name="end" value="<?= esc($_GET['end'] ?? '') ?>">
        </div>
        <button class="btn btn-filter" type="submit">Go</button>
        <input type="hidden" name="page_name" value="admin">
        <input type="hidden" name="tab" value="sales">
    </form>
    <div class="clearfix"></div>
</div>

<h2>Today's Total: ₱ <?= number_format($sales_total, 2) ?></h2>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Transaction No.</th>
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
                <?php 
                $previous_transaction_no = null;
                $previous_receipt_no = null;
                $color_switch = 1; // Toggle for alternating row colors
                $transaction_total = 0; // Initialize transaction total
                $cashier_displayed = false; // Track if cashier has been displayed
                
                foreach ($sales as $sale): 
                    $is_first_item_transaction = ($sale['transaction_no'] !== $previous_transaction_no);
                    $is_first_item_receipt = ($sale['receipt_no'] !== $previous_receipt_no);

                    // Toggle row color for new transactions
                    if ($is_first_item_transaction) {
                        if ($previous_transaction_no !== null) { // If this is not the first transaction, output the total for the previous group
                            ?>
                            <tr class="transaction-group-<?= $color_switch ?>">
                                <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
                                <td><?= number_format($transaction_total, 2) ?></td>
                                <td colspan="2"></td>
                            </tr>
                            <?php
                            $transaction_total = 0; // Reset for the next transaction
                            $color_switch = ($color_switch == 1) ? 2 : 1; // Switch color for next transaction
                            $cashier_displayed = false; // Reset cashier display flag for the new transaction
                        }
                    }
                    // Accumulate the total for the current transaction
                    $transaction_total += $sale['total'];
                ?>
                    <tr class="transaction-group-<?= $color_switch ?>">
                        <td><?= $is_first_item_transaction ? esc($sale['transaction_no']) : '' ?></td>
                        <td><?= $is_first_item_receipt ? esc($sale['receipt_no']) : '' ?></td>
                        <td><?= esc($sale['description']) ?></td>
                        <td><?= esc($sale['qty']) ?></td>
                        <td><?= number_format(esc($sale['amount']), 2) ?></td>
                        <td><?= number_format(esc($sale['total']), 2) ?></td>

                        <?php
                            $cashier = get_user_by_id($sale['user_id']);
                            $name = empty($cashier) ? "Unknown" : esc($cashier['username']);
                            $namelink = empty($cashier) ? "#" : "index.php?pg=profile&id=" . esc($cashier['id']);
                        ?>
                        <td><?= $is_first_item_transaction && !$cashier_displayed ? "<a href=\"$namelink\">$name</a>" : '' ?></td>
                        <td><?= $is_first_item_transaction ? date("jS M, Y", strtotime($sale['date'])) : '' ?></td>
                    </tr>
                <?php 
                    $previous_transaction_no = $sale['transaction_no'];
                    $previous_receipt_no = $sale['receipt_no'];
                    $cashier_displayed = $is_first_item_transaction; // Mark cashier as displayed for the first item
                endforeach;

                // After looping through all sales, output the last transaction total
                if ($previous_transaction_no !== null): ?>
                    <tr class="transaction-group-<?= $color_switch ?>">
                        <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
                        <td><?= number_format($transaction_total, 2) ?></td>
                        <td colspan="2"></td>
                    </tr>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="no-sales">No sales records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        <?php $pager->display(); ?>
    </div>    
</div>

<?php endif; ?>
