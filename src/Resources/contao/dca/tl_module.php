<?php

/**
 * @copyright  Bright Cliud Studio
 * @author     Bright Cloud Studio
 * @package    Contao Member Auto Activate
 * @license    LGPL-3.0+
 * @see	       https://github.com/bright-cloud-studio/contao-member-auto-activate
 */

/** Palettes */
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'reg_autoActivate';
$GLOBALS['TL_DCA']['tl_module']['palettes']['registration']	= str_replace('reg_allowLogin', 'reg_allowLogin,reg_autoActivate', $GLOBALS['TL_DCA']['tl_module']['palettes']['registration']);
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['reg_autoActivate'] = 'reg_autoActivateDomains';

/** Fields */
$GLOBALS['TL_DCA']['tl_module']['fields']['reg_autoActivate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['reg_autoActivate'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['reg_autoActivateDomains'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['reg_autoActivateDomains'],
	'inputType'               => 'textarea',
	'eval'                    => array('tl_class'=>'clr'),
	'sql'                     => "text NULL"
);
