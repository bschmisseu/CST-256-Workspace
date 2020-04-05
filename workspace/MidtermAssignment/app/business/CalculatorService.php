<?php

namespace App\business;

use App\model\CalculatorModel;

Class CalculatorService 
{
    public function calculateEquation(CalculatorModel $model)
    {
        if(strcmp("Add", $model->getOperation()) == 0)
        {
            return $model->getOperandOne() + $model->getOperandTwo();
        }
        
        else if(strcmp("Subtract", $model->getOperation()) == 0)
        {
            return $model->getOperandOne() - $model->getOperandTwo();
        }
        
        else if(strcmp("Multiply", $model->getOperation()) == 0)
        {
            return $model->getOperandOne() * $model->getOperandTwo();
        }
        
        else if(strcmp("Divide", $model->getOperation()) == 0)
        {
            return $model->getOperandOne() / $model->getOperandTwo();
        }
        
        else
        {
            return 101010;
        }
    }
}