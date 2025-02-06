<?php
function getMovies() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM movies ORDER BY release_date DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
