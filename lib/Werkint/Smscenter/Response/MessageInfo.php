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

    /**
     * @param int       $id
     * @param string    $status
     * @param \DateTime $date
     */
    public function __construct(
        $id,
        $status,
        \DateTime $date
    ) {
        parent::__construct($id, $status);
        $this->date = $date;
    }

    /**
     * {@inheritdoc}
     */
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