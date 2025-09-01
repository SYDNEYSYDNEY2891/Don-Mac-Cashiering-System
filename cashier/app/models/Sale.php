<?php

class Sale extends Model
{
    protected $table = "sales";
    protected $allowed_columns = [

            'receipt_no',
            'user_id',
            'description',
            'qty',
            'amount',
            'total',
            'date',
            'transaction_no',
        ];

    public function validate($data, $id = null)
    {
        $errors = [];

            //check description
            if(empty($data['description']))
            {
                $errors['description'] = "Sale description is required";
            }else
            if(!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['description']))
            {
                $errors['description'] = "Only letters allowed in description";
            }


            //check qty
            if(empty($data['qty']))
            {
                $errors['qty'] = "Sale quantity is required";
            }else
            if(!preg_match('/^[0-9]+$/', $data['qty']))
            {
                $errors['qty'] = "Quantity must be a number";
            }

            //check amount
            if(empty($data['amount']))
            {
                $errors['amount'] = "Sale amount is required";
            }else
            if(!preg_match('/^[0-9.]+$/', $data['amount']))
            {
                $errors['amount'] = "Amount must be a number";
            }


        return $errors;
    }

    public function generate_filename($ext = "jpg")
    {
        return hash("sha1",rand(1000,999999999))."_".rand(1000,9999).".".$ext;
    }

}
