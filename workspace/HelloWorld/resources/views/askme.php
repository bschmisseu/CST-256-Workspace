<html>
	<head>
		
		<title>Ask Me!</title>
	
	</head>
	<body>
	
		<form action = "whoami" method="post">
			<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
			
			<h2>Whats your Name? </h2>
			
			<table>
				<tr>
					<td>First Name</td>
					<td><input type="text" name="firstName" placeholder="First Name"></td>
				</tr>	
				<tr>
					<td>Last Name</td>
					<td><input type="text" name="lastName" placeholder="Last Name"></td>
				</tr>	
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>