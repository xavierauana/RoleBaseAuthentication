<?php
    /**
     * Author: Xavier Au
     * Date: 30/7/15
     * Time: 2:16 PM
     */

    namespace Xavierau\RoleBaseAuthentication\ViewComposers;


    use Illuminate\Contracts\View\View;
    use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;

    class GetPermissionsComposer
    {
        private $permission;

        public function __construct(PermissionInterface $permission)
        {
            $this->permission = $permission;
        }

        /**
         * Bind data to the view.
         *
         * @param  View  $view
         * @return void
         */
        public function compose(View $view)
        {
            $view->with('permissions', $this->permission->all());
        }
    }