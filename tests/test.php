<?php
require_once __DIR__ . '../../vendor/autoload.php';
use Abiodun\Exception\TransportException;
use Abiodun\MailSwifter\MailProvider;

/**
 *  ====================================
 *    TESTING USING GOOGLE SMTP
 * =====================================
 *
 * If used on a server, empty the information
 * and change `true` to `false`
 * to turn off Google SMTP
 */

try {
    $mail_provider = new MailProvider([
        'username' => 'iamhabbeboy@gmail.com',
        'password' => '07087322191',
        'smtp' => 'smtp.gmail.com',
    ]);

    $mail_provider->from = ['iamhabbeboy@gmail.com' => 'Testing MailSwifter'];
    $mail_provider->to = ['iamhabbeboy@gmail.com', 'iamhabbeboy@gmail.com' => 'Mailing'];

    $mail_provider->subject = 'New Mail Test';

    $file = __DIR__ . '/sample.html';
    $data_list = [
        'name' => 'Azeez Abiodun Solomon',
        'url' => 'http://info.google.com',
        'category' => 'Fashion',
    ];
    $resp = $mail_provider->template($file, $data_list);
    $resp = $mail_provider->send();
} catch (TransportException $e) {
}
