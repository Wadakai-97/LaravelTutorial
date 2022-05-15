<?php
try {
    $host = 'localhost';
    $dbname = 'ProductManagement';
    $dbuser = 'root';
    $dbpass = 'root';

    $dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser, $dbpass);
} catch(PDOException $e) {
    var_dump($e->getMessage());
    exit;
}

$sql = 'SELECT products.id, img_path, product_name, stock, price, company_id, company_name FROM products INNER JOIN companies ON products.company_id = companies.id';

$stmt = $dbh->prepare($sql);
$stmt->execute();
$productList = array();


while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $productList[] = array(
        'id' => $row['id'],
        'img_path' => $row['img_path'],
        'product_name' => $row['product_name'],
        'stock' => $row['stock'],
        'price' => $row['price'],
        'company_name' => $row['company_name'],
    );
}

header('Content-type: application/json');
echo json_encode($productList);
