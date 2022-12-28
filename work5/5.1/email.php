<?php
require_once './vendor/autoload.php';
try {

    $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465))
        ->setUsername('testRR3344')
        ->setPassword('GGhh3344');

    $mailer = new Swift_Mailer($transport);

    $message = new Swift_Message();

    $message->setSubject('message');

    $message->setFrom(['testRR3344@yandex.ru' => 'name']);

    $message->addTo('testRR4466@yandex.ru', 'name');

    $message->setBody("text text text");

    $message->addPart('text', 'text/html');

    $result = $mailer->send($message);
} catch (Exception $e) {
    echo $e->getMessage();
}
