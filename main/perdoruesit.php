<?php include 'db.php'; ?>
<div class="container">
    <h2>Shto Përdorues të Ri</h2>
    <form action="process_users.php" method="POST">
        <input type="text" name="emri_mbiemri" placeholder="Emri dhe Mbiemri" required>
        <input type="text" name="username" placeholder="Username (përdoret për login)" required>
        <input type="email" name="email" placeholder="Email Adresa">
        <input type="password" name="password" placeholder="Fjalëkalimi" required>
        
        <select name="roli">
            <option value="Staff">Staf (Vetëm lexim/shtim)</option>
            <option value="Manager">Menaxher (Modifikim)</option>
            <option value="Admin">Administrator (Kontroll i plotë)</option>
        </select>
        
        <button type="submit" name="save_user">Krijo Llogarinë</button>
    </form>

    <hr>

    <h2>Përdoruesit e Sistemit</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Emri</th>
                <th>Username</th>
                <th>Roli</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT id, emri_mbiemri, username, roli FROM Users");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['emri_mbiemri']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><strong><?php echo $row['roli']; ?></strong></td>
                    <td>
                        <a href="process_users.php?delete_id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('A jeni i sigurt?')">Fshij</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>