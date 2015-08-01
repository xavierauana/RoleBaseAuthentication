<?php

namespace Xavierau\RoleBaseAuthentication\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;
use Xavierau\RoleBaseAuthentication\Validators\RoleValidator;

class RolesController extends Controller
{

    private $role;
    private $validator;

    /**
     * RolesController constructor.
     *
     * @param $role
     */
    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
        $this->validator = new RoleValidator();
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
        return view('RoleBaseAuthentication.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), $this->validator->getRules($request->all()), $this->validator->getMessages());
        if($validator->fails())
        {
            return $this->validator->validationFails($validator->errors());
        }

        $this->role->createRoleRecord($request);
        return "{$this->role->display} created!";
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
        $role = $this->role->findOrFail($id);
        $permissionList = $role->permissions()->lists('id')->toArray();
        return view("RoleBaseAuthentication.roles.edit")->with(compact("role", "permissionList"));
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
        $role = $this->role->findOrFail($id);

        $validator = $this->getValidationFactory()->make($request->all(), $this->validator->getRules($request->all(), $role), $this->validator->getMessages());
        if($validator->fails())
        {
            return $this->validator->validationFails($validator->errors());
        }

        $role->updateRoleRecord($request, $id);
        return "Role updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->role->findOrFail($id);
        $role->delete();
        return redirect('/');
    }
}
