@extends('layouts.admin')

@section('title', 'Edit User')
@section('content')

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-white">Users</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-sm-12">
			
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold ">Add New User</h6>

					<a class="btn btn-primary" href="{{ url('/admin/users') }}"> <i class="fas fa-arrow-left"></i> Back</a>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					@if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

					<div class="table-outer">
						<!-- add form here -->
						<form enctype="multipart/form-data" action="{{ url('/admin/users/add') }}" method="post">
							<!-- Card Body -->
							@csrf
			                <div class="card-body">
			                  	<div class="admin-input-outer">
				                    <div class="row">
				                      	<div class="col-sm-12">
					                        <div class="image-outer">
					                        	<img src="{{ url('public/assets/images/avtar.png') }}" class="img-user1 user-img">
					                          	<input type="file" id="upload_profile" name="profile">
					                          	<img src="{{ url('public/assets/images/camera.png') }}" class="camera-img">
					                        </div>
				                      	</div>
				                    </div>

				                    <div class="row">
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Name</label>
					                          	<input type="text" name="name" value="{{ old('name') }}">
					                        </div>
				                      	</div>
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Username</label>
					                          	<input type="text" name="username" value="{{ old('username') }}" class="@error('username') is-invalid @enderror">
					                          	@error('username')
			                                        <span class="invalid-feedback" role="alert" style="display: block;">
			                                            <strong>{{ $message }}</strong>
			                                        </span>
			                                    @enderror
					                        </div>
				                      	</div>
				                    </div>

				                    <div class="row">
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                        	<label>Email</label>
					                          	<input type="text" value="{{ old('email') }}" name="email" class="@error('email') is-invalid @enderror">
					                          	@error('email')
			                                        <span class="invalid-feedback" role="alert" style="display: block;">
			                                            <strong>{{ $message }}</strong>
			                                        </span>
			                                    @enderror
					                        </div>
				                      	</div>
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Type</label>
					                          	<select name="type" required>
					                          		<option value="">--Select--</option>
						                            <option @if(old("type") == "user") selected @endif value="user">User</option>
						                            <option @if(old("type") == "admin") selected @endif value="admin">Admin</option>
					                          	</select>
					                        </div>
				                      	</div>
				                    </div>

				                    <div class="row">
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Password</label>
					                          	<input type="password" name="password" class="@error('password') is-invalid @enderror">
					                          	@error('password')
			                                        <span class="invalid-feedback" role="alert" style="display: block;">
			                                            <strong>{{ $message }}</strong>
			                                        </span>
			                                    @enderror
					                        </div>
				                      	</div>
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Confirm Password</label>
					                          	<input type="password" name="password_confirmation">
					                        </div>
				                      	</div>
				                    </div>

				                    <div class="row">
				                      	<div class="col-sm-12">
					                        <div class="input-text-outer">
					                          	<button class="btn-admin" type="submit">Add</button>
					                          	<a href="{{ url('/admin/users') }}">Cancel</a>
					                        </div>
				                      	</div>
				                    </div>
			                  	</div>
			                </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('js')

	<script type="text/javascript">
		//change profile image.
		jQuery('#upload_profile').on('change', function (e) {
		    var reader = new FileReader();
		    var file = e.target.files[0];
		    var img = jQuery('.user-img')[0];
		    reader.readAsDataURL(file);

			reader.onload = function() {
				img.src = reader.result;
			};
		});
	</script>

@endpush