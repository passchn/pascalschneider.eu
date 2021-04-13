<?php

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$settings = json_decode(file_get_contents('../settings.json'), true);
$email_webmaster = $settings['mail']['webmaster'];
$email_from = $settings['mail']['from'];

if (isset($data['email'])) {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $company = $data['company'];
    $text = $data['text'];

    $header = 'From: '.$email_from . "\r\n" .
    'Reply-To: '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $email = mail(
        $email_webmaster,
        'Kontaktformular | '.$name,
        "Von $name, E-Mail: $email \r\n
        Telefon: $phone, Unternehmen: $company
        =========\r\n
        Nachricht: \r\n
        =========\r\n
        $text",
        $header
    );

    sleep(1);

    if ($email) {
        http_response_code(200);
        echo json_encode([
            'ok' => true,
            'data' => $data
        ]);
    } else {
        http_response_code(200);
        echo json_encode([
            'ok' => false,
            'data' => $data
        ]);
    }

    die();
}

http_response_code(404);
echo json_encode([
    'ok' => false, 
    'data' => $data
]);

?>