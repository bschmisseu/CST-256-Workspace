<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\business\CalculatorService;
use App\model\CalculatorModel;


class CalculatorController extends Controller
{
    private $service;
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct()
    {
        $this->service = new CalculatorService();
    }
    
    public function calculate(Request $request)
    {
        try
        {
            $this->validateForm($request);
            
            $operandOne = $request->input('operandOne');
            $operandTwo = $request->input('operandTwo');
            $operation = $request->input('operation');
            
            $model = new CalculatorModel($operandOne, $operandTwo, $operation);
            
            $answer = $this->service->calculateEquation($model);
            
            $data = ['answer' => $answer];
            return view('CalculatorResultView')->with($data);
        }
            
        catch(ValidationException $invalidException)
        {
            throw $invalidException;
        }
    }
    
    private function validateForm(Request $request)
    {
        $rules = ['operandOne' => 'Required | numeric',
            'operandTwo' => 'Required | numeric',
            'operation' => 'Required'
        ];
        
        $this->validate($request, $rules);
    }
}
