<?php
namespace Werkint\Smscenter;

use Werkint\Smscenter\Response\MessageError;
use Werkint\Smscenter\Response\MessageInfo;
use Werkint\Smscenter\Response\PhoneOperator;

/**
 * SmscenterInterface.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface SmscenterInterface
{
    /**
     * Sends messages
     * @param array     $phones  Target phones
     * @param string    $message Text message
     * @param int       $format  Format (listed below)
     * @param \DateTime $time    Send time
     * @return mixed
     */
    public function sendMessages(
        array $phones,
        $format = 0,
        $message = null,
        \DateTime $time = null
    );

    /**
     * Lists incoming messages
     * @param int $hours Hours to list, MAX = 70
     * @return mixed
     */
    public function getIncomingMessages(
        $hours = 24
    );

    /**
     * Get account balance
     * Query amount is limited to 3 per minute.
     * @return float
     */
    public function getBalance();

    /**
     * Gets message status
     * Query amount is limited to 3 per minute for same message.
     * @param string $phone
     * @param int    $messageId
     * @param bool   $moreInfo
     * @return MessageInfo|MessageError
     */
    public function getStatus(
        $phone,
        $messageId,
        $moreInfo = false
    );

    /**
     * Fetches operator of phone number.
     * Query amount is limited to 100 per minute (3 for same phone).
     * Only for Russian Federation.
     * @param $phone
     * @return PhoneOperator
     */
    public function getPhoneOperator(
        $phone
    );

}