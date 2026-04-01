<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/project/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>MALL<span>ADMIN</span></h3>
            </div>
            
            <ul class="menu">
    <li class="active"><a href="shops.php"><i class="fas fa-store"></i> Dyqanet</a></li>
    <li><a href="kategorite.php"><i class="fas fa-tags"></i> Kategoritë</a></li>
    <li><a href="qiramarresit.php"><i class="fas fa-users"></i> Qiramarrësit</a></li>
    <li><a href="kontratat.php"><i class="fas fa-file-contract"></i> Kontratat</a></li><li>
    <a href="mirembajtja.php"><i class="fas fa-tools"></i> Mirëmbajtja</a></li>
    <li><a href="faturat.php"><i class="fas fa-file-invoice-dollar"></i> Faturat</a></li>
    <li><a href="ngjarjet.php"><i class="fas fa-calendar-alt"></i> Ngjarjet</a></li>
    <li><a href="pagesat.php"><i class="fas fa-credit-card"></i> Pagesat</a></li>
    <li><a href="hapesirat.php"><i class="fas fa-vector-square"></i> Hapësirat</a></li>
    <li><a href="statistikat.php"><i class="fas fa-chart-line"></i> Statistikat</a></li>
    <li><a href="perdoruesit.php"><i class="fas fa-user-shield"></i> Përdoruesit</a></li>
    <li><a href="njoftimet.php">Njoftimet</a></li>
</ul>
        </aside>

        <main class="content">
            <header class="top-bar">
                <h2 id="section-title">Menaxhimi i Dyqaneve</h2>
                <div class="user-info">Admin: Leart Shulina</div>
            </header>

            <div id="main-view">
                <div class="action-bar">
                    <div class="modal-body">
</form>
</div>
    </div>

<div class="form-container">
    <h3>Shto Dyqan të Ri</h3><br>
    <form action="process_shop.php" method="POST">
        <label for="Emertimi">Emri i Dyqanit</label>
        <input type="text" name="Emertimi" id="Emertimi" placeholder="Emri i Dyqanit" required><br>
        <label for="kategoria_ID">ID e Kategorise</label>
        <select name="kategoria_ID" id="kategoria_ID" required><br><br>
            <option value="">Zgjidh Kategorinë</option>
            <option value="1">Fashion</option>
            <option value="2">Food & Drinks</option>
            <option value="3">Sports</option>
            <option value="4">Technology</option>
        </select><br>
        <label for="Pronari">Emri i Pronarit:</label>
        <input type="text" name="Pronari" id="Pronari" placeholder="Emri i Pronarit"><br>
        <label for="Pronari_ID">ID e Pronarit</label>
        <input type="number" name="Pronari_ID" id="Pronari_ID" placeholder="ID e Pronarit" min="1"><br>
        <label for="Kati">Kati</label>
        <input type="number" name="Kati" id="Kati" placeholder="Kati" min="0" required><br>
        <label for="Numri_njesise">Numri_njesise</label>
        <input type="number" name="Numri_njesise" id="Numri_njesise" placeholder="Numri i Njësisë" min="1" required><br>
        <label for="Siperfaqja_m2">Siperfaqja_m2</label>
        <input type="number" step="0.01" name="Siperfaqja_m2" id="Siperfaqja_m2" placeholder="Sipërfaqja m2" min="0.01" required><br>
        <label for="Pershkrimi">Pershkrimi i Dyqanit</label>
        <textarea name="Pershkrimi" id="Pershkrimi" placeholder="Përshkrim i shkurtër i dyqanit" rows="2"></textarea><br>
        <label for="Statusi">Statusi</label>
        <select name="Statusi" id="Statusi" required><br>
            <option value="1">Aktiv</option>
            <option value="0">Jo Aktiv</option>
        </select>
        <label for="Data_hapjes">Data e Hapjes</label><br>
        <input type="date" name="Data_hapjes" id="Data_hapjes" required><br>
        <input type="hidden" name="id" id="id">
        <button type="submit" name="delete_shop"> <a href='delete_shop.php?id=" . $row['id'] . "'>Delete</a></button><br>
        <button type="submit" name="edit_shop"><a href='edit_shop.php?id=" . $row['id'] . "'>Edit</a></button><br>
        <button type="submit" name="save_shop">Ruaj Dyqanin</button><br>
    </form>
</div>

    <div class="content">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Emri i Dyqanit</th>
                    <th>Kategoria</th>
                    <th>Pronari</th>
                    <th>Lokacioni (Kati/Njësia)</th>
                    <th>Sipërfaqja</th>
                    <th>Statusi</th>
                    <th>Data e Hapjes</th>
                    <th style="text-align: center;">Veprimet</th>
                </tr>
            </thead>
            <tbody>
                <?php
    include 'db.php'; // Shto ; këtu

    // 1. Së pari deklarojmë stringun SQL
    $sql = "SELECT s.*, c.emertimi AS kategoria_emri, t.emertimi_kompanise AS pronari_emri 
            FROM shops s
            LEFT JOIN shopcategories c ON s.kategoria_ID = c.id
            LEFT JOIN tenants t ON s.Pronari_ID = t.id
            ORDER BY s.id DESC";

    // 2. Pastaj e ekzekutojmë query-n përmes lidhjes $conn
    $stmt = $conn->query($sql); 

    // 3. Tani fillojmë ciklin while
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $statusClass = ($row['Statusi'] == 'Aktiv') ? 'status-active' : 'status-inactive';
?>
                <tr>
                    <td style="color: white; font-weight: 600;">
                        <?php echo htmlspecialchars($row['Emertimi']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['kategoria_emri'] ?? 'E papërcaktuar'); ?></td>
                    <td><?php echo htmlspecialchars($row['Pronari'] ?? 'Pa Pronar'); ?></td>
                    <td>
                        <span style="display: block; font-size: 0.8rem; color: #94a3b8;">Kati: <?php echo $row['Kati']; ?></span>
                        <span>Njësia: <?php echo $row['Numri_njesise']; ?></span>
                    </td>
                    <td><?php echo $row['Siperfaqja_m2']; ?> m²</td>
                    <td>
                        <span class="<?php echo $statusClass; ?>">
                            <?php echo $row['Statusi']; ?>
                        </span>
                    </td>
                    <td><?php echo date('d.m.Y', strtotime($row['Data_hapjes'])); ?></td>
                    <td style="text-align: center;">
                        <a href="edit_shop.php?id=<?php echo $row['id']; ?>" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="process_shop.php?delete_id=<?php echo $row['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('A jeni i sigurt?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</html>
 
        