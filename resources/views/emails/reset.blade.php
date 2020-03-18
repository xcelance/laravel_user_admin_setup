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
							<h5 style="text-align: left">Password Reset Link</h5>
							<p>Hello Admin,</p>
							<p style="text-align: justify">Please click below link to reset your password.
							</p>
							<span>
								<button class="btn btn-primary"><a href="{{ url('reset/password/').'/'.$token }}">Click here</a></button>
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
