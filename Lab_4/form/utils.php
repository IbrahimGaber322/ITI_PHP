<?php




function create_table()
{
    try {
        // Open connection
        $conn = connect_to_db_pdo();
        var_dump($conn);
        
        // Query
        $query = "CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(200) UNIQUE,
            password VARCHAR(255) NOT NULL,
            Room_no VARCHAR(100), 
            EXT INT DEFAULT 0,
            profile VARCHAR(200)
        )";

        $conn->exec($query);

        // Close connection
        $conn = null;
    } catch (PDOException $e) {
        echo "<h3 style='color: green'>" . $e->getMessage() . "</h3>";
    }
}
?>

