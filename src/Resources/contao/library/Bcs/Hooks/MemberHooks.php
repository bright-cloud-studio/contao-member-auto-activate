<?php

namespace Bcs\Hooks;

class MemberHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onCreateNewUser($userId, $userData, $module)
    {

      echo "Hook Hooked it's hook hookishly";
      die();
        
    }

}
