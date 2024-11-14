<?php
$firebaseUrl = 'https://portfolio-e0559.firebaseio.com/feedback.json';

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
    echo json_encode(['status' => 'success', 'message' => 'Обратная связь успешно отправлена!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Произошла ошибка при отправке данных.']);
}
?>
