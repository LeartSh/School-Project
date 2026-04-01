<?php
include 'db.php';

// kontrollo nese ID ekziston
if (!isset($_GET['ID'])) {
    die("ID mungon!");
}

$id = $_GET['ID'];

$stmt = $conn->prepare("SELECT * FROM categories WHERE ID = ?");
$stmt->execute([$id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

// nese nuk gjendet
if (!$category) {
    die("Kategoria nuk u gjet!");
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edito Kategorinë</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="dark-theme">

<div class="container">
    <h2>Edito Kategorinë</h2>

    <form action="process_category.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']); ?>">

        <label>Emri i Kategorisë:</label>
        <input type="text" name="Emertimi" value="<?php echo htmlspecialchars($category['Emertimi']); ?>" required>

        <button type="submit" name="update_category">Përditëso</button>
    </form>

    <br>
    <a href="categories.php" style="color: cyan;">⬅ Kthehu mbrapa</a>
</div>

</body>
</html>