<!DOCTYPE html>
<html>
	<head>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
		
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col s12 m8">
					<div class="card">
						<div class="card-content teal lighten-2">
							<br>
							<span class="card-title center-align"> Full Funnel </span>
						</div>
						<div class="card-action">
							<h5 style="text-align: left">New User Registered</h5>
							<p>Hello Admin,</p>
							<p style="text-align: justify">You account has been created.
							</p>
							<p><b>Name</b>:  {{ $name }}</p>
							<p><b>Username</b>:  {{ $username }}</p>
							<p><b>Email</b>:  {{ $email }}</p>
							<p><b>Type</b>:  {{ $type }}</p>

							<span>
								<a href="{{ url('login') }}">Visit Site</a>
							</span>
						</div>
					</div>
					<br>
					<br>
				</div>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	</body>

</html>
