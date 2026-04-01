<?php include 'db.php'; ?>
<link rel="stylesheet" href="/project/style.css">
<div class="form-wrapper">
        <form action="process_lease.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Qiramarrësi</label>
                    <select name="Qiramarresi_id" required>
                        <option value="">Zgjidh Qiramarrësin</option>
                        <?php
                        $tenants = $conn->query("SELECT id, Emri, Mbiemri FROM tenants");
                        while($t = $tenants->fetch()) {
                            echo "<option value='{$t['id']}'>{$t['Emri']} {$t['Mbiemri']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Dyqani</label>
                    <select name="shop_id" required>
                        <option value="">Zgjidh Dyqanin</option>
                        <?php
                        $shops = $conn->query("SELECT id, Emertimi FROM Shops WHERE Statusi = 1");
                        while($s = $shops->fetch()) {
                            echo "<option value='{$s['id']}'>{$s['Emertimi']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Data Fillimit</label>
                    <input type="date" name="Data_fillimit" required>
                </div>

                <div class="form-group">
                    <label>Data Përfundimit</label>
                    <input type="date" name="Data_perfundimit" required>
                </div>

                <div class="form-group">
                    <label>Qiraja Mujore (€)</label>
                    <input type="number" step="0.01" name="Qiraja_mujore" required>
                </div>

                <div class="form-group">
                    <label>Depozita (€)</label>
                    <input type="number" step="0.01" name="Depozita" required>
                </div>

                <div class="form-group">
                    <label>Kushtet</label>
                    <input type="text" name="Kushtet" required>
                </div>

                <div class="form-group">
                    <label>Statusi</label>
                    <select name="Statusi" required>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" name="save_lease" class="btn-submit">
                    Gjenero Kontratën
                </button>
            </div>

        </form>

        <h2>Kontratat e Regjistruara</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Dyqani_id</th>
                <th>ID_E_Qiramarresit</th>
                <th>Data_Fillimit</th>
                <th>Data_perfundimit</th>
                <th>Qiraja_mujore</th>
                <th>Depozita</th>
                <th>Kushtet</th>
                <th>Statusi</th>
            </tr>
        </thead>
        <tbody>
            <?php

            try{
            $sql = "SELECT l.*, t.Emri, t.Mbiemri, s.Emertimi 
                    FROM LeaseContracts l
                    JOIN Tenants t ON l.tenant_id = t.id
                    JOIN Shops s ON l.shop_id = s.id
                    ORDER BY l.id DESC";
            $stmt = $conn->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $statusColor = ($row['statusi'] == 'Aktive') ? '#2ecc71' : '#e74c3c';
                ?>
                <tr>
                    <td><?php echo $row['Emri'] . " " . $row['Mbiemri']; ?></td>
                    <td><?php echo $row['Emertimi']; ?></td>
                    <td><?php echo $row['Data_fillimit'] . " / " . $row['Data_perfundimit']; ?></td>
                    <td><strong><?php echo number_format($row['Qiraja_mujore'], 2); ?>€</strong></td>
                    <td style="color: <?php echo $statusColor; ?>; font-weight: bold;"><?php echo $row['Statusi']; ?></td>
                    <td>
                        <a href="edit_lease.php?id=<?php echo $row['ID']; ?>">Edit</a> | 
                        <a href="process_lease.php?delete_id=<?php echo $row['ID']; ?>" onclick="return confirm('A jeni i sigurt?')">Fshij</a>
                    </td>
                </tr>
            <?php } 
            } catch (PDOException $e) {
                die("Gabim: Username ose Email ekziston në sistem!");
            }
            ?>
        </tbody>
    </table>
    </div>