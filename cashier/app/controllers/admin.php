<?php

$tab = $_GET['tab'] ?? 'dashboard';

if($tab == "products")
{
    $productClass = new Product();
    $products = $productClass->query("select * from drinks order by id desc");
}else
if($tab == "sales")
{

    $section = $_GET['s'] ?? 'table';
    $startdate = $_GET['start'] ?? null;
    $enddate = $_GET['end'] ?? null;


    $saleClass = new Sale();

    $limit = 10;
    $pager = new Pager($limit);
    $offset = $pager->offset;

    $query = "select * from sales order by id desc limit $limit offset $offset";
    
    //get today's sales total
    $year = date("Y");
    $month = date("m");
    $day = date("d");

    $query_total = "SELECT sum(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";

    if($startdate && $enddate)
    {
        $styear = date("Y",strtotime($startdate));
        $stmonth = date("m",strtotime($startdate));
        $stday = date("d",strtotime($startdate));

        $endyear = date("Y",strtotime($enddate));
        $endmonth = date("m",strtotime($enddate));
        $endday = date("d",strtotime($enddate));

        $query = "select * from sales where year(date) >= '$styear' && month(date) >= '$stmonth' && day(date) >= '$stday' && year(date) <= '$endyear' && month(date) <= '$endmonth' && day(date) <= '$endday' order by id desc limit $limit offset $offset";
        $query_total = "select sum(total) as total from sales where year(date) >= '$styear' && month(date) >= '$stmonth' && day(date) >= '$stday' && year(date) <= '$endyear' && month(date) <= '$endmonth' && day(date) <= '$endday'";

    }else


    if($startdate && !$enddate)
    {
        $styear = date("Y",strtotime($startdate));
        $stmonth = date("m",strtotime($startdate));
        $stday = date("d",strtotime($startdate));

        $query = "select * from sales where year(date) = '$styear' && month(date) = '$stmonth' && day(date) = '$stday' order by id desc limit $limit offset $offset";
        $query_total = "select sum(total) as total from sales where year(date) = '$styear' && month(date) = '$stmonth' && day(date) = '$stday'";

    }

    $sales = $saleClass->query($query);

    $st = $saleClass->query($query_total);
    $sales_total = 0;

    if($st){

        $sales_total = $st[0]['total'] ?? 0;
    }



}else
if($tab == "users")
{
    $userClass = new User();
    $users = $userClass->query("select * from users order by id desc");
}else
if($tab == "dashboard"){

    $db = new Database();
    $query = "select count(id) as total from users";

    $myusers = $db->query($query);
    $total_users = $myusers[0]['total'];

    $query = "select count(id) as total from drinks";

    $myusers = $db->query($query);
    $total_drinks= $myusers[0]['total'];

    $query = "select sum(total) as total from sales";

    $myusers = $db->query($query);
    $total_sales = $myusers[0]['total'];
}



if(Auth::access('supervisor')){
    require views_path('admin/admin');
}else{

    Auth::setMessage("You don't have access to the admin page");
    require views_path('auth/denied');

}
