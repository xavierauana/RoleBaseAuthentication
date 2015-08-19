@extends("back.layouts.default")

@section("content")

                        <table class="table sortableTable">
                            <thead>
                            <th>Role</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->display}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route("admin.roles.edit", $role->id)}}" class="btn btn-primary btn-sm">edit</a>
                                            <button class="btn btn-danger btn-sm">delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection