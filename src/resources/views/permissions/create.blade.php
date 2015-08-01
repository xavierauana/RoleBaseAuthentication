<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Permission</title>
</head>
<body>
    <form action="{{route("admin.permissions.store")}}" method="POST">
        {{csrf_field()}}

        <label for="object">Object</label>
        <input type="text" name="object" required>
        {!! $errors->first('object',"<span class='input-error'>:message</span>") !!}

        <label for="action">Action</label>
        <input type="text" name="action" required>
        {!! $errors->first('action',"<span class='input-error'>:message</span>") !!}

        <input type="submit" value="create">

    </form>
</body>
</html>