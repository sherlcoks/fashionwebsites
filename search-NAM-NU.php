<?php
$where = "";
$where_price = "";
if(!empty($_SESSION['seach'])){
    $where = $_SESSION['seach'];
}

if(!empty($priceRangeBotton)){
    $where_price = "`quanao_price` >= $priceRangeBotton" . ' AND';
}
if(!empty($priceRangeTop)){
    $where_price = "`quanao_price` <= $priceRangeTop" . ' AND';
}
if(!empty($priceRangeBotton) && !empty($priceRangeTop)){
    $where_price = "`quanao_price` BETWEEN '$priceRangeBotton' AND '$priceRangeTop'" . ' AND';
}

// $sql_price = "SELECT * FROM quan_ao WHERE quanao_price BETWEEN '".$_POST["PriceRangeBottom"]."' AND '".$_POST["PriceRangeTop"]."'";
// printf($sql_price);
// exit;
$config_name = "product";
$config_title = "商品";

// đếm số lượng sản phẩm 
$item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $item_per_page;

$totalRecords = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE $where_price `name` LIKE '" . $where . "%'");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
$products = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE $where_price `name` LIKE '" . $where . "%' ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);

$conn->close();
