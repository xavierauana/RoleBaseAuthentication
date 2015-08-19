@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Roles
                        </h4>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('admin.roles.update', $role->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" value="{{$role->display}}" class="form-control" required>
                                {!! $errors->first('role',"<span class='input-error'>:message</span>") !!}
                            </div>


                            <div class="form-group">
                                <label for="permissions[]">Permissions</label>
                                <select name="permissions[]" id="permissions" class="form-control select2" data-testing="123"  data-another="abc" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}" @if(in_array($permission->id, $permissionList)) selected @endif>{{ucwords($permission->action)}} {{ucwords($permission->object)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="update" class="btn-block btn btn-success">
                            <a href="{{route("admin.roles.index")}}" class="btn btn-block btn-info">back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection