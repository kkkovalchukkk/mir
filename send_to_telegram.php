<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = "7909158800:AAHNpfqu5ixo_oeoQm1hx4SkWup1OvXbWqo";
    $chat_id = "-4585362707";  // ID чата или группы, куда будут отправляться сообщения
    // Собираем данные формы
    $name = $_POST['name'];
    $email = $_POST['mail'];  // Здесь изменили на 'mail'
    $phone = $_POST['tel'];   // Здесь изменили на 'tel'
    $message = $_POST['message'];

    // Формируем текст сообщения с использованием HTML для форматирования
    $text = "
<b>Новое сообщение с сайта</b>
——————————————
<b>Имя:</b> $name
<b>Email:</b> $email
<b>Телефон:</b> $phone
<b>Сообщение:</b>
$message
——————————————";

    // URL для отправки запроса
    $url = "https://api.telegram.org/bot$token/sendMessage";

    // Данные для отправки
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML'  // Используем HTML для форматирования
    ];

    // Отправка запроса
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Проверка результата и отправка соответствующего HTTP-кода
    if ($result) {
        http_response_code(200);  // Успешный ответ
        echo "success"; 
    } else {
        http_response_code(500);  // Ошибка на сервере
        echo "error";
    }
} else {
    http_response_code(405);  // Метод не разрешен
}