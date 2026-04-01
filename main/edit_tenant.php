<?php
include 'db.php';

// Check if ID exists
if (!isset($_GET['id'])) {
    die("ID mungon!");
}

$id = (int)$_GET['id'];

// Fetch tenant
$stmt = $conn->prepare("SELECT * FROM tenants WHERE ID = ?");
$stmt->execute([$id]);
$t = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if tenant exists
if (!$t) {
    die("Qiramarrësi nuk u gjet!");
}
?>

<form action="process_tenant.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($t['ID']); ?>">

    <label>Emri:</label>
    <input type="text" name="emri" value="<?php echo htmlspecialchars($t['Emri']); ?>">

    <label>Mbiemri:</label>
    <input type="text" name="mbiemri" value="<?php echo htmlspecialchars($t['Mbiemri']); ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($t['email']); ?>">

    <label>Telefoni:</label>
    <input type="text" name="telefoni" value="<?php echo htmlspecialchars($t['telefoni']); ?>">

    <button type="submit" name="update_tenant">Përditëso</button>
</form>