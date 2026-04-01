<?php
include 'db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Spaces WHERE id = ?");
$stmt->execute([$id]);
$space = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form action="process_space.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $space['id']; ?>">
    <input type="text" name="Kodi_Hapesires" value="<?php echo $space['Kodi_Hapesires']; ?>">
    <input type="number" name="Kati" value="<?php echo $space['Kati']; ?>">
    <input type="number" step="0.01" name="Siperfaqja_m2" value="<?php echo $space['Siperfaqja_m2']; ?>">
    <select name="Statusi">
        <option value="E Lire" <?php if($space['Statusi'] == 'E Lire') echo 'selected'; ?>>E Lirë</option>
        <option value="E Zene" <?php if($space['Statusi'] == 'E Zene') echo 'selected'; ?>>E Zenë</option>
    </select>
    <button type="submit" name="update_space">Përditëso</button>
</form>