<?php
namespace MailSwifter;

use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;

/**
 * Undocumented class
 */
class MailSwifter {

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $username;
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $password;
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $isSMTP;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    public $subject;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    public $body;

    /**
     * Undocumented variable
     * ['john@doe.com' => 'John Doe']
     * @var array
     */
    public $from;

    /**
     * Undocumented variable
     * ['iamhabbeboy@gmail.com', 'other@domain.org' => 'Solomon']
     * @var [type]
     */
    public $to;
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    public $sent;

    /**
     * Undocumented function
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($username = '', $password = '', $smtp = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->isSMTP   = $smtp;

        $this->subject  = '';
        $this->from     = [];
        $this->to       = [];
        $this->body     = '';
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function send()
    {

        $smtp       = ( $this->isSMTP == true ) ? $this->smtp() : '';
        $mailer     = new Swift_Mailer($smtp);

        if( $this->subject !== '') {

            $subject = $this->subject;
            $message = (new Swift_Message($subject))

            ->setFrom( $this->from )
            ->setTo( $this->to )
            ->setBody( $this->body, "text/html" )
            ;

            $result = $mailer->send($message);
            return $result;
        } else {
            throw new Exception('Empty Information supplied');
        }
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function smtp()
    {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setAuthMode('login')
        ->setUsername( $this->username )
        ->setPassword( $this->password )
        ;
        return $transport;
    }

    /**
     * Undocumented function
     *
     * @param [type] $file
     * @param array $data
     * @return void
     */
    public function template($file, array $data_list)
    {
        if(is_file($file)) {

            $file_get   = file_get_contents($file);

            $keys       = array_keys($data_list);
            $values     = array_values($data_list);

            $append     = array_map(function($value) { return '['.$value. ']'; }, $keys);
            $replace    = str_replace($append, $values, $file_get);

            $this->body = $replace;

        } else {
            throw new Exception('Mail template file is required or not found');
        }
    }

}