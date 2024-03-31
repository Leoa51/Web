<?php
require_once '../../doctrine/bootstrap.php';

header('Content-Type: application/json');

$studentId = $_COOKIE['student_id'] ?? null;

if ($studentId === null) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!is_array($data) || !isset($data['offerId']) || !isset($data['isChecked'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request data']);
    exit;
}

$offerId = intval($data['offerId']);
$isChecked = boolval($data['isChecked']);

try {
    if ($isChecked) {
        // Ajouter l'offre à la wishlist
        $query = "INSERT INTO editwishlist (ID_User, ID_Offers, putWishlist) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $studentId, $offerId);
        $stmt->execute();
    } else {
        // Supprimer l'offre de la wishlist
        $query = "DELETE FROM editwishlist WHERE ID_User = ? AND ID_Offers = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $studentId, $offerId);
        $stmt->execute();
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}

$stmt->close();
$conn->close();
?>
