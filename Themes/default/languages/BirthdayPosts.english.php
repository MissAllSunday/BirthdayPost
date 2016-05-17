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

global $scripturl, $txt;

$txt['BirthdayPosts_title'] = 'Birthday Post';
$txt['BirthdayPosts_admin_desc'] = 'This mod will allow you to set a standard post when it is a members birthday. You can specify which board, who the poster should be, the subject of the post and the body. There is also the <strong>{membername}</strong> variable which allows you to personalize this even more. To enable this mod, go to the <a href="' . $scripturl . '?action=admin;area=scheduledtasks;sa=tasks">scheduled tasks</a> and look for "Post Birthday Posts"';
$txt['BirthdayPosts_board'] = 'ID of the board you wish to make the post';
$txt['BirthdayPosts_board_sub'] = '<span class="smalltext" style="color: #FF0000;">NOTE: This must be set!</span>';
$txt['BirthdayPosts_pid'] = 'ID of the member you wish to make the post.';
$txt['BirthdayPosts_pid_sub'] = 'Default is 0 which is Guest';
$txt['BirthdayPosts_psubject'] = 'Subject of the post';
$txt['BirthdayPosts_psubject_sub'] = 'Use <strong>{membername}</strong> to personalize it';
$txt['BirthdayPosts_pbody'] = 'The meat and gravy of the post.';
$txt['BirthdayPosts_pbody_sub'] = 'Use <strong>{membername}</strong> to give it a "personal" touch.';
$txt['BirthdayPosts_min_posts'] = 'Minimum number of posts a member must have';
$txt['BirthdayPosts_increase_pc'] = 'Will these posts increase the poster\'s postcount?';
$txt['BirthdayPosts_default_subject'] = 'Happy Birthday!';
$txt['BirthdayPosts_default_body'] = 'Happy Birthday, {membername}!';
$txt['BirthdayPosts_send_pm'] = 'Send a PM notification?';
$txt['BirthdayPosts_pmsubject'] = 'The subject of the PM.';
$txt['BirthdayPosts_pmsubject_sub'] = 'Use <strong>{membername}</strong> and <strong>{forumname}</strong> to personalize it';
$txt['BirthdayPosts_pmbody'] = 'The main body of the PM.';
$txt['BirthdayPosts_pmbody_sub'] = 'Use <strong>{membername}</strong> and <strong>{forumname}</strong> to personalize it.<br />Use <strong>{link}</strong> to give a link to the post.';
$txt['BirthdayPosts_default_pmsubject'] = 'Happy Birthday!';
$txt['BirthdayPosts_default_pmbody'] = 'Happy birthday from all the staff here at {forumname}!';
$txt['BirthdayPosts_lastactive'] = 'User must have been active in the last how many days?';
$txt['BirthdayPosts_lastactive_sub'] = 'Use 0 to disable this.';
$txt['BirthdayPosts_minregdays'] = 'Minimum number of days a user has to have been a member before they would receive a birthday post on their birthday?';
$txt['BirthdayPosts_minregdays_sub'] = 'Use 0 to disable this.';
$txt['BirthdayPosts_reusetopic'] = 'Topic ID to post new messages into.';
$txt['BirthdayPosts_reusetopic_sub'] = 'Use 0 to make each birthday post into a new topic, or specify an existing topic id here.';
$txt['BirthdayPosts_postperday'] = 'Make a single post that has all the birthdays today in it?';
$txt['BirthdayPosts_postperday_sub'] = 'Otherwise (default) make a new post for each birthday.';
$txt['BirthdayPosts_banned'] = 'Post/PM banned members too?';

/* Scheduled Tasks */
$txt['scheduled_task_birthday_posts'] = 'Post Birthday Posts';
$txt['scheduled_task_desc_birthday_posts'] = 'Posts a new topic when there is a new birthday.';