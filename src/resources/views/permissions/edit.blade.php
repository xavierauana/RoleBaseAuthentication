<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Permission</title>
</head>
<body>
    <form action="{{route('admin.permissions.update', $permission->id)}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{csrf_field()}}

        <label for="object">Object</label>
        <input type="text" name="object" value="{{$permission->object}}" required>
        {!! $errors->first('object',"<span class='input-error'>:message</span>") !!}

        <label for="action">Action</label>
        <input type="text" name="action" value="{{$permission->action}}" required>
        {!! $errors->first('action',"<span class='input-error'>:message</span>") !!}

        <input type="submit" value="update">
    </form>
</body>
</html>