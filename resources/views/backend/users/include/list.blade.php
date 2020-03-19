<table id="data_table">
    <thead>
        <tr>
            <th>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="mainCheck" name="check">
                    <label class="custom-control-label" for="mainCheck"></label>
                </div>
            </th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Type</th>
            <th>Created On</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    @if($user-> type !== 'admin')
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input cust-checkbox" id="check{{ $user->id }}" name="checked[]">
                            <label class="custom-control-label" for="check{{ $user->id }}"></label>
                        </div>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->type == 'admin')
                        <b class="text-primary">Admin</b>
                    @else
                        <b class="text-warning">User</b>
                    @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <div class="edit-delete-btn">
                        <a href="{{ url('/admin/users/edit').'/'.base64_encode($user->id) }}"><i class="fas fa-edit"></i></a> 
                        @if($user->type !== 'admin')
                            <a href="{{ url('/admin/users/delete').'/'.base64_encode($user->id) }}"><i class="fas fa-trash-alt"></i></a> 
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>