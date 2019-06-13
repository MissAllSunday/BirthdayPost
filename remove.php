<?php

/**
 * @package Birthday Posts mod
 * @version 1.0
 * @author Suki <suki@missallsunday.com>
 * @copyright 2019 Jessica González
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */

	if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
		require_once(dirname(__FILE__) . '/SSI.php');

	elseif (!defined('SMF'))
		exit('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');

	// Everybody likes hooks
	$hooks = array(
		'integrate_admin_include' => '$sourcedir/BirthdayPosts.php',
		'integrate_admin_areas' => 'birthday_admin_areas',
		'integrate_modify_modifications' => 'birthday_modify_modifications',
		'integrate_menu_buttons' => 'birthday_post_copyright',
	);

	/* Uninstall please */
	foreach ($hooks as $hook => $function)
		remove_integration_function($hook, $function);