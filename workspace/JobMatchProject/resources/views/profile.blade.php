@extends('layouts.appmaster')
@section('title', 'Job Match: Profile')

@section('content')
    <div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0,0,0,.05); width: 70%">
    	<div style="padding-bottom: 15px;background: #299be4;color: #fff;padding: 16px 30px;margin: -20px -25px 10px;border-radius: 3px 3px 0 0;">
        	<h2>Profile</h2>
    	</div>
    	<form method="POST" action="editUser">
    	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    	<table style="width: 100%;">
    		<tr>
    		<td>
    			<h4>User Information</h4>
    		</td>
    		</tr>
        	<tr>
        	<td>
                <!-- Firstname Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="firstName">First Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        	<input id="firstName" name="firstName" type="text" value="{{session()->get('currentUser')->getFirstName()}}" placeholder="First Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
        	<td>
    			<!--Last Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="lastName">Last Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        	<input id="lastName" name="lastName" type="text" value="{{session()->get('currentUser')->getLastName()}}" placeholder="Last Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
        	<td>
    			<!--Phone Number -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="phoneNumber">Phone number </label>  
                        <div class="col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                	<i class="fa fa-phone"></i>
                            	</span>
                            <input id="phoneNumber" name="phoneNumber" type="text" value="{{session()->get('currentUser')->getPhoneNumber()}}" placeholder="Phone number" class="form-control input-md">
                        </div>
                    </div>
                </div>
            </td>
            </tr>
            <tr>
        	<td>
                <!--Email -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email Address</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            	<i class="fa fa-envelope-o"></i>
                    		</span>
                    		<input id="email" name="email" type="text" value="{{session()->get('currentUser')->getEmail()}}" placeholder="Email Address" class="form-control input-md">
                    	</div>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
        	<td>
                <!-- User Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="userName">User Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        	<input id="userName" name="userName" type="text" value="{{session()->get('currentUser')->getUserCredential()->getUserName()}}" placeholder="User Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
        	<td>
    			<!-- password -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Password</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-key"></i>
                            </span>
                        	<input id="password" name="password" type="password" value="{{session()->get('currentUser')->getUserCredential()->getPassword()}}" placeholder="Password" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="bio">Overview (max 200 words)</label>
                    <div class="col-md-4">                     
                    	<textarea class="form-control" rows="10" id="bio" name="bio">{{session()->get('currentUser')->getUserInformation()->getBio()}}</textarea>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<h4>Education</h4>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="schoolName">School Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-graduation-cap"></i>
                            </span>
                        	<input id="schoolName" name="schoolName" type="text" value="{{session()->get('currentUser')->getUserInformation()->getEducationHistory()[0]->getName()}}" placeholder="School Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>	
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="degree">Degree</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-graduation-cap"></i>
                            </span>
                        	<input id="degree" name="degree" type="text" value="{{session()->get('currentUser')->getUserInformation()->getEducationHistory()[0]->getDegree()}}" placeholder="Degree of Study" class="form-control input-md">
                    	</div>
    				</div>
    			</div>	
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="field">Field of Study</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-graduation-cap"></i>
                            </span>
                        	<input id="field" name="field" type="text" value="{{session()->get('currentUser')->getUserInformation()->getEducationHistory()[0]->getField()}}" placeholder="Field of Study" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="educationStartDate">Start Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="educationStartDate" name="educationStartDate" type="date" value="{{session()->get('currentUser')->getUserInformation()->getEducationHistory()[0]->getStartDate()}}" placeholder="Start Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="educationEndDate">End Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="educationEndDate" name="educationEndDate" type="date" value="{{session()->get('currentUser')->getUserInformation()->getEducationHistory()[0]->getEndDate()}}" placeholder="End Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="educationDescription">Description (max 200 words)</label>
                    <div class="col-md-4">                     
                    	<textarea class="form-control" rows="10"  id="educationDescription" name="educationDescription">{{session()->get('currentUser')->getUserInformation()->getEducationHistory()[0]->getDescription()}}</textarea>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<h4>Job</h4>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobTitle">Title</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-briefcase"></i>
                            </span>
                        	<input id="jobTitle" name="jobTitle" type="text" value="{{session()->get('currentUser')->getUserInformation()->getJobs()[0]->getTitle()}}" placeholder="Job Title" class="form-control input-md">
                    	</div>
    				</div>
    			</div>	
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="companyName">Company Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-briefcase"></i>
                            </span>
                        	<input id="companyName" name="companyName" type="text" value="{{session()->get('currentUser')->getUserInformation()->getJobs()[0]->getCompanyName()}}" placeholder="CompanyName" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobStartDate">Start Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="jobStartDate" name="jobStartDate" type="date" value="{{session()->get('currentUser')->getUserInformation()->getJobs()[0]->getStartingDate()}}" placeholder="Start Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobEndDate">End Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="jobEndDate" name="jobEndDate" type="date" value="{{session()->get('currentUser')->getUserInformation()->getJobs()[0]->getEndingDate()}}" placeholder="End Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobDescription">Description (max 200 words)</label>
                    <div class="col-md-4">                     
                    	<textarea class="form-control" rows="10"  id="jobDescription" name="jobDescription">{{session()->get('currentUser')->getUserInformation()->getJobs()[0]->getDescription()}}</textarea>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<input type= "submit" value= "Save Changes" class="btn btn-success">
    		</td>
    		</tr>
		</table>	
    	</form>
    </div>
    <br>
@endsection