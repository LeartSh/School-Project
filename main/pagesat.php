<?php include 'db.php'; ?>
<div class="container">
    <h2>Regjistro Pagesë të Re</h2>
    <form action="process_payment.php" method="POST">
        <select name="contract_id" required>
            <option value="">Zgjidh Kontratën</option>
            <?php
            $sql = "SELECT l.id, t.Emri, t.Mbiemri, s.Emertimi 
                    FROM LeaseContracts l
                    JOIN Tenants t ON l.tenant_id = t.id
                    JOIN Shops s ON l.shop_id = s.id
                    WHERE l.statusi = 'Aktive'";
            $contracts = $conn->query($sql);
            while($c = $contracts->fetch()) {
                echo "<option value='{$c['id']}'>{$c['Emri']} {$c['Mbiemri']} - {$c['Emertimi']}</option>";
            }
            ?>
        </select>

        <input type="number" step="0.01" name="shuma" placeholder="Shuma (€)" required>
        <input type="date" name="data_pageses" value="<?php echo date('Y-m-d'); ?>" required>
        
        <select name="metoda_pageses">
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
        </select>

        <input type="text" name="pershkrimi" placeholder="Shënime (psh. Qiraja Mars 2026)">
        <button type="submit" name="save_payment">Konfirmo Pagesën</button>
    </form>

    <hr>

    <h2>Logu i Pagesave</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Qiramarrësi</th>
                <th>Dyqani</th>
                <th>Shuma</th>
                <th>Data</th>
                <th>Metoda</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT p.*, t.emri, t.mbiemri, s.emertimi 
                      FROM Payments p
                      JOIN LeaseContracts l ON p.contract_id = l.id
                      JOIN Tenants t ON l.tenant_id = t.id
                      JOIN Shops s ON l.shop_id = s.id
                      ORDER BY p.data_pageses DESC";
            $stmt = $conn->query($query);
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['emri'] . " " . $row['mbiemri']); ?></td>
                    <td><?php echo htmlspecialchars($row['emertimi']); ?></td>
                    <td><span style="color: #22c55e; font-weight: bold;"><?php echo number_format($row['shuma'], 2); ?>€</span></td>
                    <td><?php echo date('d.m.Y', strtotime($row['data_pageses'])); ?></td>
                    <td><span class="badge"><?php echo $row['metoda_pageses']; ?></span></td>
                    <td>
                        <a href="process_payment.php?delete_id=<?php echo $row['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('A jeni i sigurt që dëshironi të fshini këtë pagesë?')">
                           <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?> </tbody>
    </table>
</div>