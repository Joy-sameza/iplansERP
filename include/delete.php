<?php

// Inclure la configuration de la base de données ou toute autre configuration nécessaire

// Vérifier la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Récupérer l'ID à supprimer
    parse_str(file_get_contents("php://input"), $deleteData);
    $idToDelete = isset($deleteData['id']) ? intval($deleteData['id']) : null;

    if ($idToDelete !== null) {
        // Exécuter la logique de suppression
        try {
            $pdo = new PDO("mysql:host=your_database_host;dbname=your_database_name", "your_username", "your_password");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("DELETE FROM your_table WHERE id = :id");
            $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
            $stmt->execute();

            // Envoyer une réponse JSON
            http_response_code(200);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            // En cas d'erreur PDO
            error_log('Erreur PDO lors de la suppression : ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Erreur interne du serveur']);
        }
    } else {
        // L'ID n'est pas spécifié dans la requête
        http_response_code(400);
        echo json_encode(['error' => 'ID non spécifié']);
    }
} else {
    // Méthode non autorisée
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
}
