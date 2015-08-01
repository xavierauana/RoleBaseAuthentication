<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Role</title>
</head>
<body>
    <form action="{{route('admin.roles.update', $role->id)}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{csrf_field()}}

        <label for="role">Role</label>
        <input type="text" name="role" value="{{$role->display}}" required>
        {!! $errors->first('role',"<span class='input-error'>:message</span>") !!}

        <select name="permissions[]" id="permissions" multiple>
            @foreach($permissions as $permission)
                <option value="{{$permission->id}}" @if(in_array($permission->id, $permissionList)) selected @endif>{{ucwords($permission->action)}} {{ucwords($permission->object)}}</option>
            @endforeach
        </select>

        <input type="submit" value="update">
    </form>
</body>
</html>