<?php

function getTelegramCredentials() {
    $tokenFile = 'telegram_bot_token.txt';
    $chatIdFile = 'telegram_chat_id.txt';

    if (file_exists($tokenFile) && file_exists($chatIdFile)) {
        $token = trim(file_get_contents($tokenFile));
        $chatId = trim(file_get_contents($chatIdFile));
        return ['token' => $token, 'chat_id' => $chatId];
    }
    return null;
}

function sendTelegramMessage($message) {
    $creds = getTelegramCredentials();
    if (!$creds) return;

    $url = "https://api.telegram.org/bot" . $creds['token'] . "/sendMessage";
    $data = [
        'chat_id' => $creds['chat_id'],
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

function sendTelegramPhoto($filePath, $caption = "") {
    $creds = getTelegramCredentials();
    if (!$creds) return;

    $url = "https://api.telegram.org/bot" . $creds['token'] . "/sendPhoto";
    $cFile = new CURLFile($filePath);
    $data = [
        'chat_id' => $creds['chat_id'],
        'photo' => $cFile,
        'caption' => $caption
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

function sendTelegramDocument($filePath, $caption = "") {
    $creds = getTelegramCredentials();
    if (!$creds) return;

    $url = "https://api.telegram.org/bot" . $creds['token'] . "/sendDocument";
    $cFile = new CURLFile($filePath);
    $data = [
        'chat_id' => $creds['chat_id'],
        'document' => $cFile,
        'caption' => $caption
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
?>
