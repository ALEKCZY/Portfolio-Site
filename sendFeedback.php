<?php
$firebaseUrl = 'https://firestore.googleapis.com/v1/projects/portfolio-e0559/databases/feedback/documents/feedback';
header('Content-Type: application/json'); // Устанавливаем правильный заголовок
error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => 'Все поля обязательны для заполнения.']);
    exit;
}

$data = [
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

$jsonData = json_encode($data);

$ch = curl_init($firebaseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    echo json_encode(['status' => 'success', 'message' => 'Feedback successfully sent!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred while sending data.']);
}
?>
