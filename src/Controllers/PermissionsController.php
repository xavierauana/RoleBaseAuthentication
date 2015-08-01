<?php

namespace Xavierau\RoleBaseAuthentication\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;
use Xavierau\RoleBaseAuthentication\Validators\PermissionValidator;

class PermissionsController extends Controller
{

    private $permission;
    private $validator;

    /**
     * PermissionsController constructor.
     *
     * @param $permission
     */
    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
        $this->validator = new PermissionValidator();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = $this->getValidationFactory()->make($data, $this->validator->getRules($data), $this->validator->getMessages());

        if($validator->fails())
        {
            return $this->validator->validationFails();
        }

        $this->permission->object = strtolower($data["object"]);
        $this->permission->action = strtolower($data["action"]);
        $this->permission->save();

        return "{$this->permission->action} {$this->permission->object} created!";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permission->findOrFail($id);

        return view("RoleBaseAuthentication.permissions.edit")->with(compact("permission"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $permission = $this->permission->findOrFail($id);
        $rules = $this->validator->getRules($data, $permission);
        $validator = $this->getValidationFactory()->make($data, $rules, $this->validator->getMessages());
        if($validator->fails())
        {
            return $this->validator->validationFails($validator->errors());
        }

        $permission->object = strtolower($data["object"]);
        $permission->action = strtolower($data["action"]);
        $permission->save();

        return "{$permission->action} {$permission->object} updated!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->findOrFail($id);
        $permission->delete();
        return redirect("/");
    }
}
