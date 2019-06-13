<?php

/**
 * @package Birthday Posts mod
 * @version 1.0
 * @author Suki <suki@missallsunday.com>
 * @copyright 2012 Suki
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/**
 * @param array $areas Admin menu array
 */
function birthday_admin_areas(&$areas)
{
	global $txt;

	loadLanguage('BirthdayPosts');

	$areas['config']['areas']['modsettings']['subsections']['birthday'] = array($txt['bp_title']);
}

/**
 * @param array $sub_actions Admin menu sub actions
 */
function birthday_modify_modifications(&$sub_actions)
{
	global $context;

	$sub_actions['birthday'] = 'modify_birthday_post_settings';
	$context[$context['admin_menu_name']]['tab_data']['tabs']['birthday'] = array();
}

/**
 * @param bool $return_config
 * @return array
 */
function modify_birthday_post_settings($return_config = false)
{
	global $context, $scripturl, $txt;

	$config_vars = array(
		array('desc', 'bp_admin_desc'),
		array('int', 'bp_board'),
		array('int', 'bp_reusetopic'),
		array('int', 'bp_pid'),
		array('check', 'bp_increase_pc'),
		array('text', 'bp_psubject'),
		array('large_text', 'bp_pbody'),
		array('check', 'bp_postperday'),
		array('check', 'bp_banned'),
	'',
		array('check', 'bp_send_pm'),
		array('text', 'bp_pmsubject'),
		array('large_text', 'bp_pmbody'),
	'',
		array('int', 'bp_lastactive'),
		array('int', 'bp_minregdays'),
		array('int', 'bp_min_posts'),
	);

	if ($return_config)
		return $config_vars;

	$context['post_url'] = $scripturl . '?action=admin;area=modsettings;save;sa=birthday';
	$context['settings_title'] = $txt['bp_title'];

	if (empty($config_vars))
	{
		$context['settings_save_dont_show'] = true;
		$context['settings_message'] = '<div align="center">' . $txt['modification_no_misc_settings'] . '</div>';

		return prepareDBSettingContext($config_vars);
	}

	if (isset($_GET['save']))
	{
		checkSession();
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=modsettings;sa=birthday');
	}
	prepareDBSettingContext($config_vars);
}

/**
 * DUH WINNING!!!
 */
function birthday_post_copyright()
{
    global $context;

     if ($context['current_action'] == 'credits')
        $context['copyrights']['mods'][] = '<a href="http://missallsunday.com" title="Free SMF Mods">Birthday Posts mod &copy Suki</a>';
}
