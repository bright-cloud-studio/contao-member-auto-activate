<?php

/**
* @copyright  Bright Cliud Studio
* @author     Bright Cloud Studio
* @package    Contao Member Auto Activate
* @license    LGPL-3.0+
* @see	       https://github.com/bright-cloud-studio/contao-member-auto-activate
*/

/* Hooks */
$GLOBALS['TL_HOOKS']['createNewUser'][]        = array('Bcs\Hooks\MemberHooks', 'onCreateNewUser');
