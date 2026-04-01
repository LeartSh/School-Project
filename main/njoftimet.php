<?php include 'db.php'; ?>
<link rel="stylesheet" href="/project/dashboard.css">
<div class="container">
    <h2>Krijo Njoftim të Ri</h2>
    <form action="process_announcement.php" method="POST">
        <input type="text" name="Titulli" placeholder="Titulli i Njoftimit" required>
        
        <select name="Kategoria">
            <option value="Info">Informacion i Përgjithshëm</option>
            <option value="Urgent">Urgjente 🚨</option>
            <option value="Event">Event / Aktivitet</option>
            <option value="Maintenance">Mirëmbajtje / Punime</option>
        </select>

        <textarea name="Pershkrimi" placeholder="Shkruani njoftimin këtu..." required></textarea>
        <label>Valid deri më:</label>
        <input type="date" name="Valid_Deri">
        
        <button type="submit" name="save_announcement">Posto Njoftimin</button>
    </form>

    <hr>

    <h2>Arkiva e Njoftimeve</h2>
    <div class="announcements-list">
        <?php
        $stmt = $conn->query("SELECT * FROM Announcements ORDER BY data_publikimit DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $color = ($row['Kategoria'] == 'Urgent') ? 'red' : 'blue';
            ?>
            <div style="border-left: 5px solid <?php echo $color; ?>; padding: 10px; margin-bottom: 15px; background: #1a1a1a; color: white;">
                <h3><?php echo htmlspecialchars($row['Titulli']); ?> 
                    <small style="font-size: 0.6em; color: #ccc;">(<?php echo $row['Kategoria']; ?>)</small>
                </h3>
                <p><?php echo nl2br(htmlspecialchars($row['Pershkrimi'])); ?></p>
                <small>Postuar më: <?php echo date('d.m.Y H:i', strtotime($row['data_publikimit'])); ?></small>
                <br>
                <a href="process_announcement.php?delete_id=<?php echo $row['id']; ?>" style="color: #ff4d4d;" onclick="return confirm('A jeni i sigurt?')">Fshij njoftimin</a>
            </div>
        <?php } ?>
    </div>
</div>


<h2>Edituar nga Hadis Sylka</h2>


