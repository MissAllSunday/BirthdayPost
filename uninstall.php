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

else if(!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php and SSI.php files.');

if ((SMF == 'SSI') && !$user_info['is_admin'])
	die('Admin priveleges required.');

// Trim the logs from scheduled task
$query = $smcFunc['db_query']('', '
	SELECT id_task
	FROM {db_prefix}scheduled_tasks
	WHERE task = {string:task}',
	array(
		'task' => 'birthday_posts',
	)
);

if ($row = $smcFunc['db_fetch_row']($query))
{
	// Remove said task
	$smcFunc['db_query']('', '
		DELETE FROM {db_prefix}scheduled_tasks
		WHERE id_task = {int:id_task}',
		array(
			'id_task' => $row[0],
		)
	);
	
	// Remove log entries
	$smcFunc['db_query']('', '
		DELETE FROM {db_prefix}log_scheduled_tasks
		WHERE id_task = {int:id_task}',
		array(
			'id_task' => $row[0],
		)
	);
}

if (SMF == 'SSI')
	echo 'Database changes are complete!';
