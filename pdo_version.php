<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Mieszkania - PDO</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #008cff; color: white; }
      
    </style>
</head>
<body>
    <h1>Mieszkania (PDO)</h1>
    <a href="index.html" class="back">Powrót</a>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mieszkania";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM adres WHERE metraz > 100 AND ulica LIKE 'K%' ORDER BY metraz DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            echo "<table>";
            echo "<tr><th>ID Mieszkania</th><th>Ulica</th><th>Nr Klatki</th><th>Nr Mieszkania</th><th>Metraż (m²)</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id_mieszkania"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["ulica"]) . "</td>";
                echo "<td>" . $row["nr_klatki"] . "</td>";
                echo "<td>" . $row["nr_mieszkania"] . "</td>";
                echo "<td>" . $row["metraz"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Brak wyników spełniających kryteria.</p>";
        }
    } catch(PDOException $e) {
        echo "<p class='error'>Błąd połączenia lub zapytania: " . $e->getMessage() . "</p>";
    }
    ?>

</body>
</html>

