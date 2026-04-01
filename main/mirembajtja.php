<link rel="stylesheet" href="/project/dashboard.css">

<?php 
include 'db.php'; 
try {
    // Fetches maintenance records joined with shop names
    $sql = "SELECT m.*, s.Emertimi 
            FROM MaintenanceRequests m 
            LEFT JOIN shops s ON m.Dyqani_id = s.id 
            ORDER BY m.Data_kerkeses DESC";
    $stmt = $conn->query($sql);
} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
?>

<link rel="stylesheet" href="admin-style.css">
<div class="container">
    <h2>Raporto një Problem Teknik</h2>
    <form action="process_maintenance.php" method="POST">
        <label>Dyqani:</label>
        <select name="Dyqani_id" required>
            <option value="">Zgjidh Dyqanin/Lokacionin</option>
            <?php
            $shops = $conn->query("SELECT id, Emertimi FROM shops");
            while($s = $shops->fetch()) {
                echo "<option value='{$s['id']}'>{$s['Emertimi']}</option>";
            }
            ?>
        </select>

        <label>Qiramarrësi:</label>
        <select name="Qiramarresi_id" required>
            <option value="">Zgjidh Qiramarrësin</option>
            <?php
            // Replaced manual number input with a dropdown from the database
            $tenants = $conn->query("SELECT id, Emertimi_kompanise FROM tenants");
            while($t = $tenants->fetch()) {
                echo "<option value='{$t['id']}'>{$t['Emertimi_kompanise']}</option>";
            }
            ?>
        </select>

        <label for="lloji">Lloji i Problemit</label>
        <input type="text" name="lloji" placeholder="psh. Elektrike, Hidraulike" required>

        <label for="Pershkrimi">Përshkrimi i hollësishëm</label>
        <textarea name="Pershkrimi"></textarea>

        <label>Prioriteti:</label>
        <select name="Prioriteti">
            <option value="I Ulet">I Ulët</option>
            <option value="Mesatar" selected>Mesatar</option>
            <option value="I Larte">I Lartë</option>
            <option value="Urgjent">Urgjent 🚨</option>
        </select>

        <label>Data e kërkesës:</label>
        <input type="date" name="Data_kerkeses" value="<?php echo date('Y-m-d'); ?>" required>

        <label for="Statusi">Statusi Fillestar:</label>
        <select name="Statusi" required>
            <option value="E Re">E Re</option>
            <option value="Në Proces">Në Proces</option>
            <option value="E Kryer">E Kryer</option>
        </select>

        <label for="Tekniku_id">ID e Teknikut (Opsionale):</label>
        <input type="number" name="Tekniku_id">

        <label>Data e përfundimit (Opsionale):</label>
        <input type="date" name="Data_perfundimit">

        <button type="submit" name="save_maintenance">Dërgo Kërkesën</button>
    </form>

    <hr>

    <h2>Kërkesat e Hapura</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Dyqani</th>
                <th>Problemi</th>
                <th>Prioriteti</th>
                <th>Statusi</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($stmt) && $stmt) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Visual Priority logic
                    $prioColor = ($row['Prioriteti'] == 'Urgjent') ? 'red' : (($row['Prioriteti'] == 'I Larte') ? 'orange' : 'inherit');
                    
                    // Visual Status logic
                    $statusClass = '';
                    if ($row['Statusi'] == 'E Kryer') $statusClass = 'background: #2ecc71; color: white;';
                    if ($row['Statusi'] == 'Në Proces') $statusClass = 'background: #3498db; color: white;';
                    if ($row['Statusi'] == 'E Re') $statusClass = 'background: #f1c40f; color: black;';
            ?>
            <tr>
                <td><?php echo date('d/m', strtotime($row['Data_kerkeses'])); ?></td>
                <td><?php echo htmlspecialchars($row['Emertimi'] ?? 'N/A'); ?></td>
                <td><strong><?php echo htmlspecialchars($row['lloji']); ?></strong></td>
                <td style="color: <?php echo $prioColor; ?>; font-weight: bold;"><?php echo $row['Prioriteti']; ?></td>
                <td>
                    <span style="<?php echo $statusClass; ?> padding: 3px 8px; border-radius: 3px; font-size: 12px; font-weight: bold;">
                        <?php echo htmlspecialchars($row['Statusi']); ?>
                    </span>
                </td>
                <td>
                    <a href="process_maintenance.php?complete_id=<?php echo $row['ID']; ?>" style="color: green; text-decoration: none; font-weight: bold;">Kryej</a> 
                    | 
                    <a href="process_maintenance.php?delete_id=<?php echo $row['ID']; ?>" style="color: red; text-decoration: none; font-weight: bold;" onclick="return confirm('Fshij kërkesën?')">Fshij</a>
                </td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='6'>Nuk u gjet asnjë kërkesë: " . ($error_msg ?? '') . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>