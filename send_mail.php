<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['mail']));
    $phone = htmlspecialchars(trim($_POST['tel']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Проверяем, что все обязательные поля заполнены
    if (!empty($name) && !empty($email) && !empty($phone)) {

        // Устанавливаем заголовки письма
        $to = "ho4udeneg1@gmail.com"; 
        $subject = "Новая заявка с формы";
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Формируем тело письма
        $email_message = "
        <html>
        <head>
            <title>Новая заявка с формы</title>
        </head>
        <body>
            <h2>Детали заявки:</h2>
            <p><strong>Имя:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Телефон:</strong> {$phone}</p>
            <p><strong>Сообщение:</strong> {$message}</p>
        </body>
        </html>
        ";

        // Отправляем письмо
        if (mail($to, $subject, $email_message, $headers)) {
            http_response_code(200); // Успешно отправлено
        } else {
            http_response_code(500); // Ошибка отправки
        }
    } else {
        http_response_code(400); // Неполные данные
    }
}
?>
