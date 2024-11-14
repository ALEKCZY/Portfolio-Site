<?php
// Настройки Firebase
$firebaseUrl = 'https://portfolio-e0559.firebaseio.com/feedback.json';  // URL вашей базы данных Firebase

// Получаем данные из POST-запроса
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Проверка на пустые поля
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => 'Все поля обязательны для заполнения.']);
    exit;
}

// Создание массива данных для Firebase
$data = [
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

// Преобразование данных в JSON
$jsonData = json_encode($data);

// Инициализация cURL для отправки данных в Firebase
$ch = curl_init($firebaseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// Выполнение запроса
$response = curl_exec($ch);
curl_close($ch);

// Проверка на успешное добавление
if ($response) {
    echo json_encode(['status' => 'success', 'message' => 'Обратная связь успешно отправлена!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Произошла ошибка при отправке данных.']);
}
?>
