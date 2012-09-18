<?php

/**
 * @package Birthday Posts mod
 * @version 0.13 Beta
 * @author Suki <missallsunday@simplemachines.org>
 * @copyright 2012 Suki
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */

/*
 * Version: MPL 2.0
 *
 * This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at http://mozilla.org/MPL/2.0/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 */

if (!defined('SMF'))
	die('Hacking attempt...');

function birthday_admin_areas(&$areas)
{
	global $txt;

	loadLanguage('BirthdayPosts');

	$areas['config']['areas']['modsettings']['subsections']['birthday'] = array($txt['bp_title']);
}

function birthday_modify_modifications(&$sub_actions)
{
	global $context;

	$sub_actions['birthday'] = 'modify_birthday_post_settings';
	$context[$context['admin_menu_name']]['tab_data']['tabs']['birthday'] = array();
}

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
		$save_vars = $config_vars;
		saveDBSettings($save_vars);
		redirectexit('action=admin;area=modsettings;sa=birthday');
	}
	prepareDBSettingContext($config_vars);
}