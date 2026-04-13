<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Mieszkania - MySQLi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #129e17; color: white; }
       
    </style>
</head>
<body>
    <h1>Mieszkania (MySQLi)</h1>
    <a href="index.html" class="back">Powrót</a>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mieszkania";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("<p class='error'>Błąd połączenia: " . mysqli_connect_error() . "</p>");
    }

    $sql = "SELECT * FROM adres WHERE metraz > 100 AND ulica LIKE 'K%' ORDER BY metraz DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID Mieszkania</th><th>Ulica</th><th>Nr Klatki</th><th>Nr Mieszkania</th><th>Metraż (m²)</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
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

    mysqli_close($conn);
    ?>

</body>
</html>

