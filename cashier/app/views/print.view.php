<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="assests/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=esc(APP_NAME)?></title>
    <link rel="stylesheet" type="text/css" href="assests/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assests/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assests/css/main.css">

</head>

<body>

    <?php

        $vars = $_GET['vars'] ?? "";

        $obj = json_decode($vars,true);

    ?>

<center>
    <h1><?=$obj['company']?></h1>
    <h4>Receipt</h4>
    <div><i><?=date("jS F, Y")?></i></div>

</center>

<?php if(is_array($obj)):?>

    <table class="table table-striped">
        <tr>
            <th>Qty</th>
            <th>Description</th>
            <th>@</th>
            <th>Amount</th>
        </tr>

        <?php foreach ($obj['data'] as $row) :?>

            <tr>
                <td><?=$row['qty']?></td>
                <td><?=$row['description']?></td>
                <td>₱ <?=$row['amount']?></td>
                <td>₱ <?=$row['qty'] * $row['amount']?></td>
            </tr>
        <?php endforeach;?>

        <tr>
            <td colspan="2"></td><td><b>Total: </b></td><td><b>₱ <?=$obj['gtotal']?></b></td>
        </tr>

        <tr>
            <td colspan="2"></td><td>Amount Paid: </td><td>₱ <?=$obj['amount']?></td>
        </tr>

        <tr>
            <td colspan="2"></td><td>Change: </td><td>₱ <?=$obj['change']?></td>
        </tr>
            
        
    </table>

    <center><p><i>Cebu's First 39 Pesos Coffee</i></p></center>
<?php endif;?>

<script>
    window.print();
</script>

</body>
</html>