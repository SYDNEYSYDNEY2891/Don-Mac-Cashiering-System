<style>
    body {
        font-family: 'Arial', sans-serif; 
        background-color: #f9f5f1; 
        color: #4e3b32; 
    }

    .table-responsive {
        margin: 20px auto; 
        border-radius: 10px; 
        overflow: hidden; 
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); 
        background-color: #ffffff; 
    }

    .table {
        width: 100%; 
        border-collapse: collapse; 
    }

    .table th, .table td {
        padding: 15px; 
        text-align: center; 
    }

    .table th {
        background-color: #6f4c3e; 
        color: #ffffff; 
        font-weight: bold; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f0e6d2; 
    }

    .table-striped tbody tr:hover {
        background-color: #d6c9b6; 
        transition: background-color 0.3s; 
    }

    .btn {
        margin: 5px; 
        border-radius: 5px; 
        padding: 8px 12px; 
        transition: background-color 0.3s, transform 0.3s; 
    }

    .btn1 {
        background-color: #a86f55; 
        color: white; 
    }

    .btn1:hover {
        background-color: #935d47; 
        transform: translateY(-2px); 
    }

    .btn-danger {
        background-color: #c74b3a; 
        color: white; 
    }

    .btn-danger:hover {
        background-color: #b43a2e; 
        transform: translateY(-2px); 
    }

    .product-image {
        width: 80px; 
        height: 80px; 
        object-fit: cover; 
        border-radius: 5px; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    .no-products {
        text-align: center; 
        color: #777; 
        font-style: italic; 
    }
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center" style="color: #6f4c3e;">Product List</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>
                                <a href="index.php?page_name=drinks-new">
                                    <button class="btn btn1 btn-sm"><i class="fa fa-plus"></i> Add Product</button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <a href="index.php?page_name=product-single&id=<?=$product['id']?>" style="color: #6f4c3e; text-decoration: none;">
                                            <?=esc($product['description'])?>
                                        </a>
                                    </td>
                                    <td><?=esc($product['amount'])?></td>
                                    <td>
                                        <img src="<?=crop($product['image'])?>" class="product-image" alt="<?=esc($product['description'])?>">
                                    </td>
                                    <td><?=date("jS M, Y H:i:s a", strtotime($product['date']))?></td>
                                    <td>
                                        <a href="index.php?page_name=drinks-edit&id=<?=$product['id']?>">
                                            <button class="btn btn1 btn-sm">Edit</button>
                                        </a>
                                        <a href="index.php?page_name=drinks-delete&id=<?=$product['id']?>">
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="no-products">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
