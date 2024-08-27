<?php

namespace Bcs\Hooks;

use Contao\Frontend;
use Contao\MemberModel;

class MemberHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onCreateNewUser($userId, $userData, $module)
    {

        $boolActivate = FALSE;
        echo "TEST: " . $boolActivate;
        die();

		if ($objModule->reg_autoActivate) {
			if ($objModule->reg_autoActivateDomains != '') {
				list($emailUser, $emailDomain) = explode("@", $arrData['email']);
				$arrDomains = preg_split("/\\r\\n|\\r|\\n/", $objModule->reg_autoActivateDomains);
				foreach($arrDomains as $domain) {
					if (strtolower(trim($domain)) == strtolower(trim($emailDomain))) {
						$boolActivate = TRUE;
					}
				}
			} else {
				$boolActivate = TRUE;
			}
		}
		
		
		echo "boolActivate: " . $boolActivate . "<br>";
		echo "reg_autoActivate: " . $objModule->reg_autoActivate . "<br>";
		echo "reg_autoActivateDomains: " . $objModule->reg_autoActivateDomains . "<br>";
		die();
		
		
		

		if ($boolActivate) {
			$objMember = MemberModel::findByIdOrAlias($intId);
			// Update the account
			$objMember->disable = '';
			$objMember->activation = '';
			$objMember->save();

			// HOOK: post activation callback
			if (isset($GLOBALS['TL_HOOKS']['activateAccount']) && is_array($GLOBALS['TL_HOOKS']['activateAccount']))
			{
				foreach ($GLOBALS['TL_HOOKS']['activateAccount'] as $callback)
				{
					$this->import($callback[0]);
					$this->{$callback[0]}->{$callback[1]}($objMember, $this);
				}
			}
		}


        
    }

}
