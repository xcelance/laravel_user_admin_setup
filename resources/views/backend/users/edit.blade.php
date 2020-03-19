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
					<h6 class="m-0 font-weight-bold ">Edit User - {{ $user->name }}</h6>

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
						<form enctype="multipart/form-data" action="{{ url('/admin/users/update') }}" method="post">
							<!-- Card Body -->
							@csrf
			                <div class="card-body">
			                  	<div class="admin-input-outer">
				                    <div class="row">
				                      	<div class="col-sm-12">
					                        <div class="image-outer">
					                        	@if($user->profile)
					                          		<img src="{{ url($user->profile) }}" class="img-user1 user-img">
					                          	@else 
					                          		<img src="{{ url('public/assets/images/avtar.png') }}" class="img-user1 user-img">
					                          	@endif
					                          	<input type="file" id="upload_profile" name="profile">
					                          	<img src="{{ url('public/assets/images/camera.png') }}" class="camera-img">
					                        </div>
				                      	</div>
				                    </div>
				                    <input type="hidden" name="id" value="{{ $user->id }}">
				                    <div class="row">
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Name</label>
					                          	<input type="text" name="name" value="{{ $user->name }}">
					                        </div>
				                      	</div>
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Username</label>
					                          	<input type="text" name="username" value="{{ $user->username }}">
					                        </div>
				                      	</div>
				                    </div>
				                    <div class="row">
				                      	<div class="col-sm-12">
					                        <div class="input-text-outer">
					                        	<label>Email</label>
					                          	<input type="text" readonly value="{{ $user->email }}" name="email">
					                        </div>
				                      	</div>
				                    </div>
				                    <div class="row">
				                      	<div class="col-sm-6">
					                        <div class="input-text-outer">
					                          	<label>Type</label>
					                          	<select name="type">
					                          		<option value="">--Select--</option>
						                            <option @if($user->type == 'user') selected @endif value="user">User</option>
						                            <option @if($user->type == 'admin') selected @endif value="admin">Admin</option>
					                          	</select>
					                        </div>
				                      	</div>
				                    </div>
				                    <div class="row">
				                      	<div class="col-sm-12">
					                        <div class="input-text-outer">
					                          	<button class="btn-admin" type="submit">Update</button>
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

@section('js')

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

@endsection