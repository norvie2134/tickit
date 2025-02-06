<?php
function reserveSeat($userId, $showtimeId, $seatNumber) {
    global $pdo;

    // Check if seat is available
    $stmt = $pdo->prepare("SELECT id FROM seats WHERE showtime_id = ? AND seat_number = ? AND status = 'available'");
    $stmt->execute([$showtimeId, $seatNumber]);
    $seat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($seat) {
        // Reserve seat
        $seatId = $seat['id'];
        $updateStmt = $pdo->prepare("UPDATE seats SET status = 'reserved' WHERE id = ?");
        $updateStmt->execute([$seatId]);

        // Create booking
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, showtime_id, seat_id, payment_status) VALUES (?, ?, ?, 'pending')");
        return $stmt->execute([$userId, $showtimeId, $seatId]);
    }

    return false;
}
?>
