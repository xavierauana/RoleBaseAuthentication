<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 10:31 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Validators;


    use Xavierau\RoleBaseAuthentication\Contracts\Validator;

    class PermissionValidator implements Validator
    {
        public function getRules($data, $permission=null)
        {
            $rules =["object"=>'required'];
            if(!isset($data["object"]))
            {
                return $rules;
            }
            if($permission)
            {
                $rules["action"] = "required|unique:permissions,action,".$permission->id.",id,object,".$data["object"];
            }else{
                $rules["action"] = "required|unique:permissions,action,NULL,id,object,".$data["object"];
            }
            return $rules;

        }

        public function getMessages()
        {
            return [
                'action.unique'    => 'This :attribute already define for the object.'
            ];
        }

        public function validationFails($messages)
        {
            return redirect()
                    ->back()
                    ->withErrors($messages)
                    ->withInput();
        }
    }