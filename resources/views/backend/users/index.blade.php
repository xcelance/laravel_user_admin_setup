@extends('layouts.admin')

@section('title', 'Users')
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
					<h6 class="m-0 font-weight-bold ">All Users</h6>

					<a class="btn btn-success" href="{{ url('/admin/users/add') }}"> <i class="fas fa-plus"></i> Add User</a>
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
                    
					<div class="table-outer" id="table_data">
						@include('backend.users.include.list')
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script type="text/javascript">
		// add datatable js to table.
		jQuery('#data_table').DataTable({
			"lengthMenu": [ [10, 50, 100, -1], [10, 50, 100, "All"] ]
		});

		jQuery('#mainCheck').click(function() { 
			// make all check box checked/unchecked.
			var all = jQuery('.cust-checkbox');
		    if (jQuery(this).is(':checked')) {
		        all.each(function(i) { this.checked = true; });
		    } else {
		        all.each(function(i) { this.checked = false; });
		    }
		});
	</script>
@endsection