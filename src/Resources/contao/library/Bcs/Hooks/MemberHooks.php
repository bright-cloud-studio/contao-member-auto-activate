<?php

namespace Bcs\Hooks;

use Contao\Frontend;
use Contao\MemberModel;
use Contao\System;

class MemberHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onCreateNewUser($intId, $arrData, $objModule)
    {
        
        // Track if we want to activate this Member or not
        $boolActivate = FALSE;

        // If "Auto Activate" it checked on our Registration module
		if ($objModule->reg_autoActivate) {
		    // If the domain list is not empty
			if ($objModule->reg_autoActivateDomains != '') {
			    // Loop through the listed domains to see if they match the new member
				list($emailUser, $emailDomain) = explode("@", $arrData['email']);
				$arrDomains = preg_split("/\\r\\n|\\r|\\n/", $objModule->reg_autoActivateDomains);
				foreach($arrDomains as $domain) {
					if (strtolower(trim($domain)) == strtolower(trim($emailDomain))) {
						$boolActivate = TRUE;
					}
				}
			} else {
			    // If there are no domains listed, but "Auto Activate" is checked, proceed with Activation
				$boolActivate = TRUE;
			}
		}

        // If we are going to activate our new Member
		if ($boolActivate) {
		    
		    // Find this Member, as this hook is triggered after the Member is created
			$objMember = MemberModel::findByIdOrAlias($intId);
			// Setting 'disable' to 0 means it is activated, 1 means inactive
			$objMember->disable = 0;
			// Save our modified member
			$objMember->save();

			// HOOK: post activation callback
			if (isset($GLOBALS['TL_HOOKS']['activateAccount']) && is_array($GLOBALS['TL_HOOKS']['activateAccount']))
			{
				foreach ($GLOBALS['TL_HOOKS']['activateAccount'] as $callback)
				{
					System::importStatic($callback[0])->{$callback[1]}($objMember, $this);
				}
			}
		}
        
    }

}
