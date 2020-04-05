<?php 

namespace App\model;

Class CalculatorModel
{
    private $operandOne;
    private $operandTwo; 
    private $operation;
    
    function __construct(int $operandOne, int $operandTwo, String $operation)
    {
        $this->operandOne = $operandOne;
        $this->operandTwo = $operandTwo;
        $this->operation = $operation;
    }
    
    /**
     * @return Integer
     */
    public function getOperandOne()
    {
        return $this->operandOne;
    }

    /**
     * @return Integer
     */
    public function getOperandTwo()
    {
        return $this->operandTwo;
    }

    /**
     * @return String
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param Integer $operandOne
     */
    public function setOperandOne($operandOne)
    {
        $this->operandOne = $operandOne;
    }

    /**
     * @param Integer $operandTwo
     */
    public function setOperandTwo($operandTwo)
    {
        $this->operandTwo = $operandTwo;
    }

    /**
     * @param String $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }
}

?>