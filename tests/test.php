<?php
require_once 'vendor/autoload.php';
use MailSwifter\MailSwifter;

/**
 *  ====================================
 *    TESTING USING GOOGLE SMTP
 * =====================================
 *
 * If used on a server, empty the information
 * and change `true` to `false`
 * to turn off Google SMTP
 */
$mail_provider          = new MailSwifter('EMAIL_ADDRESS', 'PASSWORD', true);
$mail_provider->from    = ['iamhabbeboy@gmail.com' => 'Solomon'];
$mail_provider->to      = ['iamhabbeboy@gmail.com', 'iamhabbeboy@gmail.com' => 'Abiodun'];
$mail_provider->subject = 'Sample Testing Mail with HTML';
$file = __DIR__.'/sample.html';
$data_list = ['name' => 'Azeez Abiodun Solomon', 'url' => 'http://info.google.com', 'category' => 'Fashion'];
$resp = $mail_provider->template($file, $data_list);
$resp = $mail_provider->send();

if($resp) {
    echo 'Sent !';
} else {
    echo 'not sent';
}