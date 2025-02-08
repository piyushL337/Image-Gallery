<?php
include 'db.php';

$category = $_GET['category'] ?? '';
$tag = $_GET['tag'] ?? '';

$query = "SELECT * FROM images WHERE 1=1";
$params = [];

if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
}

if (!empty($tag)) {
    $query .= " AND FIND_IN_SET(?, tags)";
    $params[] = $tag;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($images);
?>
