<?php
// Include necessary files (e.g., database connection, authentication)
$sales = new Sale();

// Check if the user is logged in and has the right access
if (!Auth::isLoggedIn()) {
    header('Location: login.php'); // Redirect if not logged in
    exit;
}

// Get the user ID from the URL
$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to get the sales data for the specific user
$salesQuery = "SELECT * FROM sales WHERE user_id = ?";
$stmt = $db->prepare($salesQuery);
$stmt->execute([$userId]);
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user details (optional, if you want to show user info)
$userQuery = "SELECT username FROM users WHERE id = ?";
$userStmt = $db->prepare($userQuery);
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($user['username']) ?>'s Sales</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Link your CSS file -->
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($user['username']) ?>'s Sales</h1>

        <?php if (!empty($sales)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= htmlspecialchars($sale['id']) ?></td>
                            <td><?= htmlspecialchars($sale['item']) ?></td>
                            <td><?= htmlspecialchars($sale['amount']) ?></td>
                            <td><?= date("jS M, Y", strtotime($sale['date'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No sales found for this user.</p>
        <?php endif; ?>

        <a href="index.php?page_name=admin&tab=users">Back to Users</a>
    </div>
</body>
</html>
