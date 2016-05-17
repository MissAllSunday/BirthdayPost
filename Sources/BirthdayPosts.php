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
	die('No direct access...');

// Use Ohara! manually :(
require_once ($sourcedir .'/ohara/src/Suki/Ohara.php');

class BirthdayPosts extends Suki\Ohara
{
	public $name = __CLASS__;
	protected $_useConfig = true;

	public function __construct()
	{
		$this->setRegistry();
	}

	public function adminArea(&$areas)
	{
		$areas['config']['areas']['modsettings']['subsections'][$this->name] = array($this->text('title'));
	}

	public function settingsTab(&$sub_actions)
	{
		global $context;

		$sub_actions['birthday'] = $this->settingsPage();
		$context[$context['admin_menu_name']]['tab_data']['tabs'][$this->name] = array();
	}

	function settingsPage($return_config = false)
	{
		global $context;

		$config_vars = array(
			array('desc', $this->name .'_admin_desc', 'subtext' => $this->text('_sub')),
			array('int', $this->name .'_board', 'subtext' => $this->text('_sub')),
			array('int', $this->name .'_reusetopic', 'subtext' => $this->text('_sub')),
			array('int', $this->name .'_pid', 'subtext' => $this->text('_sub')),
			array('check', $this->name .'_increase_pc', 'subtext' => $this->text('_sub')),
			array('text', $this->name .'_psubject', 'subtext' => $this->text('_sub')),
			array('large_text', $this->name .'_pbody', 'subtext' => $this->text('_sub')),
			array('check', $this->name .'_postperday', 'subtext' => $this->text('_sub')),
			array('check', $this->name .'_banned', 'subtext' => $this->text('_sub')),
		'',
			array('check', $this->name .'_send_pm', 'subtext' => $this->text('_sub')),
			array('text', $this->name .'_pmsubject', 'subtext' => $this->text('_sub')),
			array('large_text', $this->name .'_pmbody', 'subtext' => $this->text('_sub')),
		'',
			array('int', $this->name .'_lastactive', 'subtext' => $this->text('_sub')),
			array('int', $this->name .'_minregdays', 'subtext' => $this->text('_sub')),
			array('int', $this->name .'_min_posts', 'subtext' => $this->text('_sub')),
		);

		if ($return_config)
			return $config_vars;

		$context['post_url'] = $this->scriptUrl . '?action=admin;area=modsettings;save;sa='. $this->name;
		$context['settings_title'] = $this->text('title');

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

	public function scheduledTask()
	{
		global $mbname, $smcFunc, $user_profile, $context;

		// Load the language files
		loadEssentialThemeData();

		// Get the date
		$month = date('n'); // Month without leading zeros.
		$day = date('j'); // Day without leading zeros.
		$reuseTopic = $this->setting('reusetopic'):

		// Are we reusing an existing topic, if so - does it exist and does it match the board id specified?
		// If no to any of these, force new topic posting.

		if($this->setting('reusetopic'))
		{
			$result = $smcFunc['db_query']('', '
				SELECT id_topic, id_board
				FROM {db_prefix}topics
				WHERE id_topic = {int:topic}
					AND id_board = {int:board}',
				array(
					'topic' => $reuseTopic,
					'board' => $this->setting('board') ? (int) $this->setting('board') : 1,
				)
			);

			// If we find no rows, either topic doesn't exist, or it's not in the right board - so force regular handling, i.e. new topic.
			if (!$smcFunc['db_num_rows']($result))
				$reuseTopic = 0;

			$smcFunc['db_free_result']($result);
		}

		else
			$reuseTopic = 0;

		// So who are the lucky ones?
		$result = $smcFunc['db_query']('', '
			SELECT id_member, real_name
			FROM {db_prefix}members
			WHERE bp_lastpost < {int:lastpost}
				AND MONTH(birthdate) = {int:month}
				AND DAYOFMONTH(birthdate) = {int:day}
				AND birthdate > {string:nondate}
				AND notify_announcements = {int:notify_announcements}' . ($this->setting('lastactive') ? '
				AND last_login > {int:last_login}' : '') . ($this->setting('minregdays') ? '
				AND date_registered < {int:minreg}' : '') . ($this->setting('banned') ? '
				AND is_activated >= 1 AND is_activated <= 10' : '
				AND is_activated >= 1'),
			array(
				'lastpost' => time() - 172800, // more than 2 days ago
				'nondate' => '0001-01-01',
				'notify_announcements' => 1,
				'year' => 1,
				'month' => $month,
				'day' => $day,
				'last_login' => $this->setting('lastactive') ? time() - ($this->setting('lastactive') * 86400) : 0,
				'minreg' => $this->setting('minregdays') ? time() - ($this->setting('minregdays') * 86400) : 0,
			)
		);

		// Group 'em
		$birthdays = array();
		while ($row = $smcFunc['db_fetch_assoc']($result))
		{
			$birthdays[] = array(
				'id' => $row['id_member'],
				'name' => $row['real_name'],
			);
		}
		$smcFunc['db_free_result']($result);

		// If there aren't any, leave now to avoid any funny business
		if (empty($birthdays))
			return true;

		// Now we know there are... let's get everything set up.

		// Going to need this to make the post...
		require_once($sourcedir . '/Subs-Post.php');

		// Load the member data of the poster and construct the array for createPost
		$posterId = ($this->setting('pid') ? $modSettings['bp_pid'] : 0);

		loadMemberData($posterId, false, 'normal');

		$posterOptions = array(
			'id' => $posterId,
			'name' => (isset($user_profile[$posterId]['real_name']) ? $user_profile[$posterId]['real_name'] : $this->text('title')),
			'update_post_count'	=> ($this->setting('increase_pc') && !empty($posterId) ? 1 : 0),
			'email' => (isset($user_info['email']) ? $user_info['email'] : ''),
			'ip' => '0.0.0.0',
		);

		// Default vars.
		$postSubject = $this->setting('psubject') ? $this->setting('psubject') : $this->text('default_subject');
		$postBody = $this->setting('pbody') ? $this->setting('pbody') : $this->text('default_body');
		$postBoard = $this->setting('board') ? $this->setting('board') : 1;

		// Are we doing one post for all birthdays, or one post per birthday?
		if ($this->setting('postperday'))
		{
			$birthdayNames = array();
			foreach($birthdays as $birthday)
			{
				$birthdayNames[] = $birthday['name'];
				$birthdayLinks[] = '[url=' . $this->scriptUrl . '?action=profile;u=' . $birthday['id'] . ']' . $birthday['name'] . '[/url]';
			}

			$postSubject = $this->parser($postSubject, array(
				'{membername}' => implode(', ', $birthdayNames)
			));

			$postBody = $this->parser($postBody, array(
				'{membername}' => implode(', ', $birthdayLinks)
			));

			// Finally, set up the post and make it!
			$topicOptions = array(
				'board' => $postBoard,
				'mark_as_read' => false,
				'id' => $reuseTopic,
			);
			$msgOptions = array(
				'id' => 0,
				'subject' => $this->sanitize($postSubject),
				'body' => $this->sanitize($postBody),
				'smileys_enabled' => true,
			);
			createPost ($msgOptions, $topicOptions, $posterOptions);

			// Push it back into an array for later use with PMs
			foreach($birthdays as $key => $birthday)
			{
				$birthdays[$key]['topic'] = $topicOptions['id'];
				$birthdays[$key]['message'] = $msgOptions['id'];
			}
		}

		else
		{
			foreach($birthdays as $key => $birthday)
			{
				$postSubject = $this->parser($postSubject, array(
					'{membername}' => $birthday['name']
				));

				$postBody = $this->parser($postBody, array(
					'{membername}' => implode(', ', '[url=' . $this->scriptUrl . '?action=profile;u=' . $birthday['id'] . ']' . $birthday['name'] . '[/url]')
				));

				// Options needed for our post.
				// Options for the topic itself
				$topicOptions = array(
					'board' => $postBoard,
					'mark_as_read' => false,
					'id' => $reuseTopic,
				);
				// Message options!
				$msgOptions = array(
					'id' => 0,
					'subject' => $this->sanitize($postSubject),
					'body' => $this->sanitize($postBody),
					'smileys_enabled' => true,
				);

				// Make the darn post already!
				createPost ($msgOptions, $topicOptions, $posterOptions);

				// Push it back into an array for later use with PMs
				$birthdays[$key]['topic'] = $topicOptions['id'];
				$birthdays[$key]['message'] = $msgOptions['id'];
			}
		}

		// Have they enabled the sending of a notification PM as well?
		if (!empty($modSettings['bp_send_pm']))
		{
			foreach($birthdays as $birthday)
			{
				// Set values for the {membername}, {link} and {forumname} variables
				$destlink = empty($modSettings['queryless_urls']) ? ($this->scriptUrl . '?topic=' . $birthday['topic'] . '.msg' . $birthday['message'] . '#msg' . $birthday['message']) : ($this->scriptUrl . '/topic,' . $birthday['topic'] . '.msg' . $birthday['message'] . '.html#msg' . $birthday['message']);

				$bp_pm_subject = str_replace('{membername}', $birthday['name'], !empty($modSettings['bp_pmsubject']) ? $modSettings['bp_pmsubject'] : $txt['BirthdayPosts_default_pmsubject']);
				$bp_pm_body = str_replace('{membername}', $birthday['name'], !empty($modSettings['bp_pmbody']) ? $modSettings['bp_pmbody'] : $txt['BirthdayPosts_default_pmbody']);
				$bp_pm_body = str_replace('{link}', $destlink, $bp_pm_body);

				$bp_pm_subject = str_replace('{forumname}', $context['forum_name'], $bp_pm_subject);
				$bp_pm_body = str_replace('{forumname}', $context['forum_name'], $bp_pm_body);

				// Options needed for the PM
				$pm_to = array(
					'to' => array($birthday['id']),
					'bcc' => array(),
				);
				$pm_from = array(
					'id' => (isset($modSettings['bp_pid']) ? $modSettings['bp_pid'] : 0),
					'name' => (isset($user_profile[$poster_id]['real_name']) ? $user_profile[$poster_id]['real_name'] : $txt['BirthdayPosts_title']),
					'username' => (isset($user_profile[$poster_id]['member_name']) ? $user_profile[$poster_id]['member_name'] : $txt['BirthdayPosts_title']),
				);
				$pm_subject = $bp_pm_subject;
				$pm_body = $bp_pm_body;

				// Create the PM!
				sendpm($pm_to, $pm_subject, $pm_body, false, $pm_from);
			}
		}

		// Just before we leave, let's also update the members table as to when we last did this.
		$birthday_ids = array();
		foreach($birthdays as $birthday)
			$birthday_ids[] = (int) $birthday['id'];

		$smcFunc['db_query']('', '
			UPDATE {db_prefix}members
			SET bp_lastpost = {int:time}
			WHERE id_member IN ({array_int:ids})',
			array(
				'time' => time(),
				'ids' => $birthday_ids,
			)
		);

		return true;
	}
}
