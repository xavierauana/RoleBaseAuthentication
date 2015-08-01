<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Role</title>
</head>
<body>
    <form action="{{route("admin.roles.store")}}" method="POST">
        {{csrf_field()}}

        <label for="role">Role</label>
        <input type="text" name="role" required>
        {!! $errors->first('role',"<span class='input-error'>:message</span>") !!}

        <select name="permissions[]" id="permissions" multiple>
            @foreach($permissions as $permission)
                <option value="{{$permission->id}}">{{ucwords($permission->action)}} {{ucwords($permission->object)}}</option>
            @endforeach
        </select>

        <input type="submit" value="create">
    </form>


</body>
</html>