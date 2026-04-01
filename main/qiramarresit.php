<head>
    <title>Menaxhimi i Qiramarrësve</title>
    <link rel="stylesheet" href="/project/admin-style.css">
</head>
<body class="dark-theme">
    <div class="container">
        <h2>Shto Qiramarrës të Ri</h2>
        <form action="process_tenant.php" method="POST">
            <label for="Emri">Emri:</label>
            <input type="text" name="Emri" placeholder="Emri" required>
            
            <br><label for="Mbiemri">Mbiemri:</label>
            <input type="text" name="Mbiemri" placeholder="Mbiemri" required>
            
            <br><label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email">
            
            <br><label>Telefoni:</label>
            <input type="text" name="telefoni" placeholder="Telefoni">
            
            <br><label>Emri i Kompanisë:</label>
            <input type="text" name="Emertimi_kompanise" placeholder="Emri i Kompanisë" required>
            
            <br><label>Kontakti:</label>
            <input type="text" name="kontakti" placeholder="Personi Kontaktues">
            
            <br><label>Numri i Biznesit:</label>
            <input type="text" name="nr_biznesit" placeholder="Nr. Biznesit">
            
            <br><label>Adresa:</label>
            <input type="text" name="adresa" placeholder="Adresa">
            
            <br><label>Data e regjistrimit:</label>
            <input type="date" name="data_regjistrimit" value="<?php echo date('Y-m-d'); ?>">
            
            <button type="submit" name="save_tenant">Ruaj Qiramarrësin</button>
        </form>
        
        <hr>

        <h2>Lista e Qiramarrësve</h2>
        <table border="1" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emri i Plotë</th>
                    <th>Email / Tel</th>
                    <th>Kompania</th>
                    <th>Biznes Nr.</th>
                    <th>Adresa</th>
                    <th>Veprimet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $stmt = $conn->query("SELECT * FROM tenants");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo htmlspecialchars($row['Emri'] . ' ' . $row['Mbiemri']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($row['email']); ?><br>
                            <small><?php echo htmlspecialchars($row['telefoni']); ?></small>
                        </td>
                        <td>
                            <strong><?php echo htmlspecialchars($row['Emertimi_kompanise']); ?></strong><br>
                            <small>Përfaqësuesi: <?php echo htmlspecialchars($row['kontakti']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($row['nr_biznesit']); ?></td>
                        <td><?php echo htmlspecialchars($row['adresa']); ?></td>
                        <td>
                            <a href="edit_tenant.php?id=<?php echo $row['ID']; ?>" style="color: cyan;">Edit</a> | 
                            <a href="process_tenant.php?delete_id=<?php echo $row['ID']; ?>" style="color: red;" onclick="return confirm('A jeni i sigurt?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>