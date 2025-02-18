<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $secretKey = "ТВОЙ_SECRET_KEY"; // Используй свой приватный ключ
    $captchaResponse = $_POST['g-recaptcha-response']; // Токен reCAPTCHA от пользователя
    $userIP = $_SERVER['REMOTE_ADDR']; // IP-адрес пользователя

    if (!$captchaResponse) {
        die("Ошибка: капча не пройдена!");
    }

    // Отправляем запрос в Google для проверки
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyUrl . "?secret=" . $secretKey . "&response=" . $captchaResponse . "&remoteip=" . $userIP);
    $responseData = json_decode($response);

    // Проверяем, успешна ли капча
    if ($responseData->success) {
        echo "Капча пройдена, обработка формы...";
        // Здесь можно продолжить обработку формы (например, запись в базу данных)
    } else {
        echo "Ошибка проверки капчи!";
    }
} else {
    echo "Ошибка: неверный метод запроса!";
}
?>