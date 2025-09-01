<?php

$errors = [];
$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //make sure only admin can make other admins
    if(is_array($row) && Auth::access('admin') && $row['deletable'])
    {
        $user->delete($id);        
        redirect('admin&tab=users');

    }
    
}

if(Auth::access('admin')){
    require views_path('auth/delete-user');
}else{

    Auth::setMessage("Only admin can delete users");
    require views_path('auth/denied');

}

