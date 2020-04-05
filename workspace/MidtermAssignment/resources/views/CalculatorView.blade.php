@extends('layouts.appmaster')

@section('title', 'Calculator Form')

@section('content')
<div align="center">
    <h3>Calculator Form</h3>
    
    <form method= "POST" action= "calculate">
        <input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        <table style="text-align: center;">
        	<tr>
        		<td>Operand 1:</td>
        		<td>
        			<input type="text" name="operandOne" placeholder="Enter your first number" required="required"><br>
        			{{$errors->first('operandOne')}}
        		</td>
    		</tr>
    		<tr>
    			<td>Operand 2:</td>
        		<td>
        			<input type="text" name="operandTwo" placeholder="Enter your second number" required="required"><br>
        			{{$errors->first('operandTwo')}}
        		</td>
    		</tr>
    		<tr>
        		<td style="text-align: right">
        			<input type="radio" name="operation" value="Add">
        		</td>
        		<td style="text-align: left"><label for="Add">Add</label></td>
    		</tr>
    		<tr>
        		<td style="text-align: right">
        			<input type="radio" name="operation" value="Subtract">
        		</td>
        		<td style="text-align: left"><label for="Subtract">Subtract</label></td>
    		</tr>
    		<tr>
        		<td style="text-align: right">
        			<input type="radio" name="operation" value="Multiply">
        		</td>
        		<td style="text-align: left"><label for="Multiply">Multiply</label></td>
    		</tr>
    		<tr>
        		<td style="text-align: right">
        			<input type="radio" name="operation" value="Divide">
        		</td>
        		<td style="text-align: left"><label for="Divide">Divide</label></td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				{{$errors->first('operation')}}
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				<input type="submit" value="Calculate">
    			</td>
    		</tr>
		</table>
    </form>
</div>
@endsection