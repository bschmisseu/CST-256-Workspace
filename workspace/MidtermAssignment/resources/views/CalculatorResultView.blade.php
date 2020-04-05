@extends('layouts.appmaster')

@section('title', 'Calculator Result')

@section('content')
    <div align="center">
    	Your Result is: <h3>{{$answer}}</h3>
    	
    	<a href="/MidtermAssignment/">Try Again</a>
    </div>
@endsection