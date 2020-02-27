<tr>
    <td>{{ $user->login_name }}</td>
    <td>{{ $user->display_name }}</td>
    <td>
        <input name="edit articles" type="checkbox" {{ $user->can('edit articles') ? 'checked' : '' }}>
    </td>
    <td>
        <input name="manage" type="checkbox" {{ $user->can('manage') ? 'checked' : '' }}>
    </td>
    <td>
        <button type="submit" class="btn btn-primary save-button">Update</button>
    </td>
</tr>
