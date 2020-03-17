<tr>
    <td>{{ $user->login_name }}</td>
    <td>{{ $user->display_name }}</td>
    <td>
        <ul>
            @foreach ($user->roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>
    </td>
    <td>
        <a href="{{ route('admin.users.edit', $user->display_name) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
        <a href="#" class="btn btn-danger"><i class="fa fa-user-times"></i> Delete</a>
    </td>
</tr>
