<?php
namespace Werkint\Smscenter\Response;

/**
 * PhoneOperator.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class PhoneOperator
{
    protected $operator;
    protected $region;

    /**
     * @param string $operator
     * @param string $region
     */
    public function __construct(
        $operator,
        $region
    ) {
        $this->operator = $operator;
        $this->region = $region;
    }

    // -- Getters ---------------------------------------

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

}