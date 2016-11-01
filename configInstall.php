<?php

/**
 * @package Birthday Posts mod
 * @version 0.13 Beta
 * @author Suki <missallsunday@simplemachines.org>
 * @copyright 2012 Suki
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */
 
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');

else if(!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php and SSI.php files.');

if ((SMF == 'SSI') && !$user_info['is_admin'])
	die('Admin priveleges required.');

// Prepare and insert this mod's config array.
$_config = array(
	'_availableHooks' => array(
		'adminArea' => 'integrate_admin_areas',
		'settingsTab' => 'integrate_modify_modifications',
	),
);

// All good.
updateSettings(array('_configActivityBar' => json_encode($_config)));

if (SMF == 'SSI')
	echo 'Database changes are complete!';