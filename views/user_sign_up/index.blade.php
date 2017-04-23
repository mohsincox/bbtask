<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<th>ID</th>
			<th>Email</th>
			<th>Sign up token</th>
			<th>Edit</th>
		</tr>
		@foreach($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->sign_up_request_token }}</td>
			<td>Edit</td>
		</tr>
		@endforeach
	</table>
	
</body>
</html>