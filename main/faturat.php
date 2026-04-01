<?php include 'db.php'; ?>
<link rel="stylesheet" href="admin-style.css">
<div class="container">
    <h2>Gjenero Faturë të Re</h2>
    <form action="process_invoice.php" method="POST">
        <select name="contract_id" required>
            <option value="">Zgjidh Kontratën (Qiramarrësi - Dyqani)</option>
            <?php
            $sql = "SELECT l.id, t.Emri, t.Mbiemri, s.Emertimi, l.qmimi_muaj_euro 
                    FROM LeaseContracts l
                    JOIN Tenants t ON l.tenant_id = t.id
                    JOIN Shops s ON l.shop_id = s.id";
            $contracts = $conn->query($sql);
            while($c = $contracts->fetch()) {
                echo "<option value='{$c['id']}'>{$c['Emri']} {$c['Mbiemri']} - {$c['Emertimi']} ({$c['qmimi_muaj_euro']}€)</option>";
            }
            ?>
        </select>
        
        <input type="text" name="nr_fatures" placeholder="Nr. Faturës (p.sh. INV-2026-001)" required>
        <input type="date" name="data_faturimit" value="<?php echo date('Y-m-d'); ?>" required>
        <input type="date" name="data_skadimit" required>
        
        <button type="submit" name="save_invoice">Krijo Faturën</button>
    </form>

    <hr>

    <h2>Menaxhimi i Faturave</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nr. Faturës</th>
                <th>Qiramarrësi</th>
                <th>Shuma</th>
                <th>Afati</th>
                <th>Statusi</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT i.*, t.Emri, t.Mbiemri 
                      FROM Invoices i
                      JOIN LeaseContracts l ON i.contract_id = l.id
                      JOIN Tenants t ON l.tenant_id = t.id
                      ORDER BY i.data_faturimit DESC";
            $stmt = $conn->query($query);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $statusClass = ($row['statusi'] == 'Borxh') ? 'text-danger' : 'text-success';
                ?>
                <tr>
                    <td><strong><?php echo $row['nr_fatures']; ?></strong></td>
                    <td><?php echo $row['Emri'] . " " . $row['Mbiemri']; ?></td>
                    <td><?php echo number_format($row['shuma_totale'], 2); ?>€</td>
                    <td><?php echo $row['data_skadimit']; ?></td>
                    <td class="<?php echo $statusClass; ?>"><?php echo $row['statusi']; ?></td>
                    <td>
                        <a href="print_invoice.php?id=<?php echo $row['id']; ?>" target="_blank">Print</a> | 
                        <a href="process_invoice.php?mark_paid=<?php echo $row['id']; ?>">Mark Paid</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>