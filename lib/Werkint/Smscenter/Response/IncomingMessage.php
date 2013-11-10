<?php
namespace Werkint\Smscenter\Response;

/**
 * IncomingMessage.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class IncomingMessage
{

    protected $id;
    protected $dateSent;
    protected $dateReceived;
    protected $message;
    protected $phone;
    protected $target;

    public function __construct(
        $id,
        \DateTime $dateSent,
        \DateTime $dateReceived,
        $message,
        $phone,
        $target
    ) {
        $this->dateReceived = $dateReceived;
        $this->dateSent = $dateSent;
        $this->id = $id;
        $this->message = $message;
        $this->phone = $phone;
        $this->target = $target;
    }

    /**
     * @return \DateTime
     */
    public function getDateReceived()
    {
        return $this->dateReceived;
    }

    /**
     * @return \DateTime
     */
    public function getDateSent()
    {
        return $this->dateSent;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }


}