<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0;
    }

    .user-card {
        background-color: #f9f9f9;
        border: 2px solid #6f4c3e;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin: 10px;
        padding: 20px;
        width: calc(33.333% - 40px);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.3s;
    }

    .user-card:hover {
        transform: translateY(-5px);
    }

    .user-card img {
        border-radius: 50%;
        object-fit: cover;
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
    }

    .user-card h4 {
        margin: 10px 0 5px;
        font-size: 18px;
        color: #6f4c3e;
    }

    .user-card p {
        margin: 5px 0;
        color: #555;
    }

    .btn {
        margin: 5px;
        border-radius: 5px;
        padding: 5px 10px;
        transition: background-color 0.3s;
    }

    .btn-success {
        background-color: #6f4c3e;
        border: none;
        color: white;
    }

    .btn-success:hover {
        background-color: #5a3c31;
    }

    .btn-danger {
        background-color: #d9534f;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c12a2a;
    }

    .btn-sales {
        background-color: #007bff;
        border: none;
        color: white;
    }

    .btn-sales:hover {
        background-color: #0056b3;
    }

    .create-user-container {
        text-align: right;
        margin-bottom: 20px;
        margin-top: 8px;
    }

    .create-user-container a {
        color: white;
        font-weight: 500;
        padding: 10px 20px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        background-color: #6f4c3e;
        border: 2px solid #6f4c3e;
        border-radius: 5px;
        text-decoration: none;
    }

    .create-user-container a:hover {
        background-color: #6f4c3e;
        color: #6f4c3e;
    }
</style>

<div class="create-user-container">
    <?php if(Auth::access('admin')): ?>
        <a href="index.php?page_name=signup">Create a user</a>
    <?php endif; ?>
</div>

<div class="card-container">
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <div class="user-card">
                <a href="index.php?page_name=profile&id=<?=$user['id']?>">
                    <img src="<?=crop($user['image'],400,$user['gender'])?>" alt="<?=esc($user['username'])?>">
                </a>
                <h4>
                    <a href="index.php?page_name=profile&id=<?=$user['id']?>" style="color: #6f4c3e; text-decoration: none;"><?=esc($user['username'])?></a>
                </h4>
                <p>Gender: <?=esc($user['gender'])?></p>
                <p>Email: <?=esc($user['email'])?></p>
                <p>Role: <?=esc($user['role'])?></p>
                <p>Date: <?=date("jS M, Y", strtotime($user['date']))?></p>
                <div>
                    <a href="index.php?page_name=edit-user&id=<?=$user['id']?>">
                        <button class="btn btn-success btn-sm">Edit</button>
                    </a>
                    <a href="index.php?page_name=delete-user&id=<?=$user['id']?>">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </a>
                    

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>
