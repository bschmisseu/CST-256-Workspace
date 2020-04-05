@extends('layouts.appmasterBootstrap')
@section('title', 'Login Passed')

@section('content')
    <h2>Login Passed</h2>
    
    @if($model->getUserName() == 'bschmisseur')
    	<h4>Welcome Back Bryce</h4>
    @else
    	<h4>Welcome New User</h4>
    @endif
    
    <input type="submit" formaction="loginBlade" class="btn btn-primary" value="Try Again">
@endsection