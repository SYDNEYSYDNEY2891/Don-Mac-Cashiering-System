<?php

defined("ABSPATH") ? "" : die();

// Function to generate unique transaction number
function generate_transaction_no() {
    $db = new Database();
    $date = date("Y-m-d");
    
    // Fetch the last transaction number for the current date
    $query = "SELECT MAX(transaction_no) AS max_transaction_no FROM sales WHERE DATE(date) = :date";
    $lastTransaction = $db->query($query, ['date' => $date]);

    if (empty($lastTransaction)) {
        // If no transactions found, start from 1
        return date("Ymd") . "0001"; // Format: YYYYMMDD0001
    }

    $lastTransactionNo = $lastTransaction[0]['max_transaction_no'];
    // Increment the last transaction number
    $incrementedNo = intval(substr($lastTransactionNo, -4)) + 1; // Get the last 4 digits and increment

    // Generate the new transaction number with leading zeros
    return date("Ymd") . str_pad($incrementedNo, 4, '0', STR_PAD_LEFT);
}

$raw_data = file_get_contents("php://input");
if (!empty($raw_data)) {
    $OBJ = json_decode($raw_data, true);
    
    if (is_array($OBJ)) {
        if ($OBJ['data_type'] == "search") {
            $productClass = new Product();
            $limit = 20;

            if (!empty($OBJ['text'])) {
                $text = "%" . $OBJ['text'] . "%";
                $query = "SELECT * FROM drinks WHERE description LIKE :find LIMIT 20";
                $rows = $productClass->query($query, ['find' => $text]);
            } else {
                // Get all
                $rows = $productClass->getAll($limit, 0, 'desc', 'views');
            }

            if ($rows) {
                foreach ($rows as $key => $row) {
                    $rows[$key]['description'] = strtoupper($row['description']);
                    $rows[$key]['image'] = crop($row['image']);
                }

                $info['data_type'] = "search";
                $info['data'] = $rows;

                echo json_encode($info);
            }
        } else if ($OBJ['data_type'] == "checkout") {
            $data = $OBJ['text'];
            $recipt_no = get_receipt_no();
            $transaction_no = generate_transaction_no(); // Generate a unique transaction number
            $user_id = auth("id");
            $date = date("Y-m-d H:i:s");

            $db = new Database();
            // Read from the database
            foreach ($data as $row) {
                $arr = [];
                $arr['id'] = $row['id'];
                $query = "SELECT * FROM drinks WHERE id = :id LIMIT 1";
                $check = $db->query($query, $arr);

                if (is_array($check)) {
                    $check = $check[0];
                    // Save to database
                    $arr = [];
                    $arr['description'] = $check['description'];
                    $arr['amount'] = $check['amount'];
                    $arr['qty'] = $row['qty'];
                    $arr['total'] = $row['qty'] * $check['amount'];
                    $arr['receipt_no'] = $recipt_no;
                    $arr['transaction_no'] = $transaction_no; // Set the generated transaction number
                    $arr['date'] = $date;
                    $arr['user_id'] = $user_id;

                    $query = "INSERT INTO sales (receipt_no, transaction_no, description, qty, amount, total, date, user_id) VALUES (:receipt_no, :transaction_no, :description, :qty, :amount, :total, :date, :user_id)";
                    $db->query($query, $arr);

                    // Add view count
                    $query = "UPDATE drinks SET views = views + 1 WHERE id = :id LIMIT 1";
                    $db->query($query, ['id' => $check['id']]);
                }
            }

            $info['data_type'] = "checkout";
            $info['data'] = "Items saved successfully!";

            echo json_encode($info);
        }
    }
}
