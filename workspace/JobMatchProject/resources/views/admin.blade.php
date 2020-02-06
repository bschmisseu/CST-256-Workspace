@extends('layouts.appmaster')
@section('title', 'Job Match: Admin')

@section('content')
<link rel="stylesheet" href="resources/style/adminPage.css">
<br>
    <div class="container" style="font-size: 13px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>User <b>Management</b></h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>						
						<th>User Name</th>
						<th>Role</th>
                        <th>Status</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($userList as $user)
                    <tr style="text-align: center">
                        <td>{{$user->getIdNum()}}</td>
                        <td>
                        <form method="POST" action="adminViewUser" id="userProfileForm{{$user->getIdNum()}}" style="vertical-align: middle">
                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        	<input type="hidden" name="userId" value="{{$user->getIdNum()}}">
                        	<a style="cursor: pointer" onclick="document.getElementById('userProfileForm{{$user->getIdNum()}}').submit();">{{$user->getFirstName()}}</a>
                        </form>
                        </td>
                        <td>{{$user->getUserCredential()->getUserName()}}</td>
                        @if($user->getUserRole() == 0)                        
                        	<td>Admin</td>
                        @else
                        	<td>User</td>
                    	@endif
                    	@if($user->isActive())
							<td><span class="status text-success">&bull;</span> Active</td>
						@else
							<td><span class="status text-danger">&bull;</span> Suspended</td>
						@endif
						<td>
						@if(session()->get('currentUser')->getIdNum() != $user->getIdNum())
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to suspend this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getIdNum()}}">
    							<button formaction="suspendUser" class="pause" title="Pause" data-toggle="tooltip"><i class="material-icons">&#xe14b;</i></button>
    						</form>
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getIdNum()}}">
    							<button formaction="deleteUser" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></button>
    						</form>
						@endif
						</td>
                    </tr>
                  @endforeach 
                </tbody>
            </table>
        </div>
    </div> 

@endsection