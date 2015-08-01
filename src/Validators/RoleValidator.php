<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 10:31 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Validators;


    use Illuminate\Support\Facades\App;
    use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;
    use Xavierau\RoleBaseAuthentication\Contracts\Validator;

    class RoleValidator implements Validator
    {
        private $permission;

        /**
         * RoleValidator constructor.
         *
         * @param $permission
         */
        public function __construct()
        {
            $this->permission = App::make(PermissionInterface::class);
        }


        public function getRules($data, $role=null)
        {
            $idList = $this->createPermissionIdList();
            if($role)
            {
                $rules =["role"=>'required|unique:roles,code,'.$role->id];
            }else{
                $rules =["role"=>'required|unique:roles,code'];
            }

            $rules = $this->createPermissionArrayRules($data, $idList, $rules);

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

        /**
         * @return string
         */
        private function createPermissionIdList()
        {
            $permissionIds = $this->permission->lists('id')->toArray();
            $idList        = "";
            for ($i = 0; $i < count($permissionIds); $i++) {
                $idList .= $permissionIds[$i];
                if ($i < count($permissionIds) - 1) {
                    $idList .= ",";
                }
            }

            return $idList;
        }

        /**
         * @param $data
         * @param $idList
         * @param $rules
         *
         * @return mixed
         */
        private function createPermissionArrayRules($data, $idList, $rules)
        {
            if (isset($data["permissions"])) {
                foreach ($data["permissions"] as $index => $val) {
                    $rules["permissions." . $index] = "sometimes|in:" . $idList;
                }
                return $rules;
            }
            return $rules;
        }
    }