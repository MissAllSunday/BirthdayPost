<?php
/*******************************************************************
* install_db.php                                                   *
********************************************************************
* For support and license issues, please see this mod's thread:    *
* http://www.simplemachines.org/community/index.php?topic=328059.0 *
*******************************************************************/

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
else if(!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php and SSI.php files.');

if ((SMF == 'SSI') && !$user_info['is_admin'])
	die('Admin priveleges required.');

// All this for one query...
$query = $smcFunc['db_query']('', '
	SELECT id_task FROM {db_prefix}scheduled_tasks WHERE task = "birthday_posts" OR task = "birthdayPosts"
');

if ($smcFunc['db_num_rows']($query) == 1)
{
	$smcFunc['db_query']('', '
		UPDATE {db_prefix}scheduled_tasks
		SET task = "birthday_posts"
		WHERE task = "birthdayPosts"'
	);
}
else
{
	// Create the scheduled task
	$smcFunc['db_insert'](
		'insert',
		'{db_prefix}scheduled_tasks',
		array(
			'id_task' => 'int',
			'next_time' => 'int',
			'time_offset' => 'int',
			'time_regularity' => 'int',
			'time_unit' => 'string',
			'disabled' => 'int',
			'task' => 'string',
		),
		array(
			0, 0, 0, 1, 'd', 1, 'birthday_posts',
		),
		array(
			'id_task',
		)
	);
}

$smcFunc['db_free_result']($query);

db_extend('packages');

// Add the column for figuring out if we've done this user before
//$smcFunc['db_add_column'] (table_name, column_into, parameters, if_exists, error)
$smcFunc['db_add_column'](
	'{db_prefix}members',
	array(
		'name' => 'bp_lastpost',
		'type' => 'int',
		'size' => 10,
		'null' => false,
		'default' => 0,
		'unsigned' => true,
	),
	array(),
	'update',
	null
);

if (SMF == 'SSI')
	echo 'Database changes are complete!';
?>