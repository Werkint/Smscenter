<?php
namespace Werkint\Smscenter\Response;

/**
 * MessageInfo.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class MessageInfo extends MessageStatus
{
    protected $date;

    public function __construct(
        $id,
        $status,
        \DateTime $date)
    {
        parent::__construct($id, $status);
        $this->date = $date;
    }

    public function isError()
    {
        return false;
    }

    // -- Getters ---------------------------------------

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}