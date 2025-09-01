<?php

class Product extends Model
{
    protected $table = "drinks";
    protected $allowed_columns = [

            'user_id',
            'description',
            'qty',
            'amount',
            'image',
            'date',
            'views',
        ];

    public function validate($data, $id = null)
    {
        $errors = [];

            //check description
            if(empty($data['description']))
            {
                $errors['description'] = "Product description is required";
            }else
            if(!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['description']))
            {
                $errors['description'] = "Only letters allowed in description";
            }


            //check qty
            if(empty($data['qty']))
            {
                $errors['qty'] = "Product quantity is required";
            }else
            if(!preg_match('/^[0-9]+$/', $data['qty']))
            {
                $errors['qty'] = "Quantity must be a number";
            }

            //check amount
            if(empty($data['amount']))
            {
                $errors['amount'] = "Product amount is required";
            }else
            if(!preg_match('/^[0-9.]+$/', $data['amount']))
            {
                $errors['amount'] = "Amount must be a number";
            }

            //check image
            $max_size = 4;
            $size = $max_size * (1024 * 1024);

            if(!$id || ($id && !empty($data['image'])))
            {
                if(empty($data['image']))
                {
                    $errors['image'] = "Product image is required";
                }else
                if($data['image']['error'] > 0)
                {
                    $errors['image'] = "The image failed to upload. Error No." .$data['image']['error'];
                }else
                if($data['image']['size'] > $size)
                {
                    $errors['image'] = "The image SIZE must be lower than " .$max_size. "MB";
                }
            }

        return $errors;
    }

    public function generate_filename($ext = "jpg")
    {
        return hash("sha1",rand(1000,999999999))."_".rand(1000,9999).".".$ext;
    }

}
