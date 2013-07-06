<?php
namespace Werkint\Smscenter;

class Smscenter
{
    const BASE_URL = 'https://smsc.ru/sys/';
    const CHARSET = 'utf-8';

    protected $login;
    protected $password;
    protected $sender;

    public function __construct(
        $login,
        $password,
        $sender
    ) {
        $this->login = $login;
        $this->password = $password;
        $this->sender = $sender;
    }

    public function sendMessages(
        array $phones, $message, $messageId, $format = 0, \DateTime $time = null
    ) {
        $params = [
            'phones'  => array_merge(';', $phones),
            'mes'     => $message,
            'id'      => $messageId,
            'sender'  => $this->sender,
            'charset' => static::CHARSET,
        ];

        if ($time) {
            $time = $time->format('DDMMYYhhmm, h1-h2, 0ts, +m');
            $params['time'] = $time;
        }

        $format = explode('=', $this->formats[$format]);
        $params[$format[0]] = $format[1];

        $ret = $this->query('send', $params);

        return $ret[1];
    }

    public function getMessages()
    {
        $list = $this->query('get', [
            'get_answers' => '1',
        ]);

        return $list;
    }

    public function getBalance()
    {
        $ret = $this->query('balance');

        return $ret->balance;
    }

    protected function query($command, array $params = [])
    {
        $params = array_merge($params, [
            'fmt'   => '3',
            'login' => $this->login,
            'psw'   => md5($this->password),
        ]);
        $url = static::BASE_URL . $command . '.php';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);

        if (!$ret) {
            throw new \Exception('Empty server response');
        }
        $ret = json_decode($ret);
        if ($ret->error_code) {
            throw new \Exception('Error ' . $ret->error_code . ': ' . $ret->error);
        }

        return $ret;
    }

    // -- Formats ---------------------------------------

    protected $formats = [
        'bin=0', 'flash=1', 'push=1', 'hlr=1', 'bin=1', 'bin=2', 'ping=1'
    ];

    // Обычный формат
    const FORMAT_NORMAL = 0;
    // Flash (всплывающее)
    const FORMAT_FLASH = 1;
    // WAP-PUSH сообщения
    const FORMAT_PUSH = 2;
    // HLR-запрос для получения информации о номере
    const FORMAT_HRL = 3;
    // бинарное сообщение
    const FORMAT_BIN = 4;
    // бинарное сообщение в HEX-виде
    const FORMAT_BINHEX = 5;
    // Ping-sms
    const FORMAT_PING = 6;

}
