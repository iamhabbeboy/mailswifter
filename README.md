# mailswifter

## Installation

```cmd
composer require abiodun/mailswifter
```


## Usage

```cmd
use Abiodun\MailSwifter\MailProvider
```

`index.php`

```php
    $mail_provider = new MailProvider([
        'username' => 'username@gmail.com',
        'password' => 'password',
        'smtp' => 'smtp.gmail.com',
    ]);

     $mail_provider->from = ['username@gmail.com' => 'Testing MailSwifter'];
    $mail_provider->to = ['username@gmail.com', 'username@gmail.com' => 'Mailing'];

    $mail_provider->subject = 'New Mail Test';

    $file = __DIR__ . '/sample.html';
    $data_list = [
        'name' => ' ',
        'url' => 'http://info.google.com',
        'category' => 'Fashion',
    ];
    $resp = $mail_provider->template($file, $data_list);
    $resp = $mail_provider->send();
```

`sample.html`

```html
    <h1>This is a sample for the mail </h1>
    <p> i surely believe this would work so well</p>

    <p>Name is: [name] </p>
    <p>Url: [url]</p>
    <p>Category: [category]</p>
    <p>i'm so happy here </p>
```