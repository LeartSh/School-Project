<?php include 'db.php'; ?>
<link rel="stylesheet" href="admin-style.css">
<div class="container">
    <h2>Shto Hapësirë të Re</h2>
    <form action="process_space.php" method="POST">
        <input type="text" name="Kodi_Hapesires" placeholder="Kodi (psh. L1-05)" required>
        <input type="number" name="Kati" placeholder="Kati" required>
        <input type="number" step="0.01" name="Siperfaqja_m2" placeholder="Sipërfaqja m2" required>
        <select name="Statusi">
            <option value="E Lire">E Lirë</option>
            <option value="E Zene">E Zenë</option>
            <option value="Ne Rimodelim">Në Rimodelim</option>
        </select>
        <button type="submit" name="save_space">Ruaj Hapësirën</button>
    </form>

    <hr>

    <h2>Menaxhimi i Hapësirave</h2>
    <table>
        <thead>
            <tr>
                <th>Kodi</th>
                <th>Kati</th>
                <th>Sipërfaqja</th>
                <th>Statusi</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM Spaces");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                    <td>{$row['Kodi_Hapesires']}</td>
                    <td>{$row['Kati']}</td>
                    <td>{$row['Siperfaqja_m2']} m2</td>
                    <td>{$row['Statusi']}</td>
                    <td>
                        <a href='edit_space.php?id={$row['id']}'>Edit</a> | 
                        <a href='process_space.php?delete_id={$row['id']}' onclick='return confirm(\"A jeni i sigurt?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>