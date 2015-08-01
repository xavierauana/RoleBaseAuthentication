<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 10:29 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Contracts;


    interface Validator
    {
        public function getRules($data, $object=null);

        public function getMessages();

        public function validationFails($messages);
    }