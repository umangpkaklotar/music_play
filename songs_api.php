<?php
header("Content-Type: application/json");
include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    // ✅ GET: All Songs or Single Song
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $conn->prepare("SELECT * FROM song WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            echo json_encode($res);
        } else {
            $result = $conn->query("SELECT * FROM song");
            $songs = [];
            while ($row = $result->fetch_assoc()) {
                $row['file_url'] = 'uploads/' . basename($row['file_url']);
                $row['image_url'] = 'uploads/' . basename($row['image_url']);
                $songs[] = $row;
            }
            echo json_encode($songs);
        }
        break;

    // ✅ POST: Add Song
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("INSERT INTO song (song_name, file_url, image_url, language, description) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $data['song_name'], $data['file_url'], $data['image_url'], $data['language'], $data['description']);
        $stmt->execute();
        echo json_encode(["message" => "Song Added"]);
        break;

    // ✅ PUT: Update Song
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $stmt = $conn->prepare("UPDATE song SET song_name=?, language=?, description=? WHERE id=?");
        $stmt->bind_param("sssi", $_PUT['song_name'], $_PUT['language'], $_PUT['description'], $_PUT['id']);
        $stmt->execute();
        echo json_encode(["message" => "Song Updated"]);
        break;

    // ✅ DELETE: Delete Song
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = intval($_DELETE['id']);
        $conn->query("DELETE FROM song WHERE id=$id");
        echo json_encode(["message" => "Song Deleted"]);
        break;
}
?>
