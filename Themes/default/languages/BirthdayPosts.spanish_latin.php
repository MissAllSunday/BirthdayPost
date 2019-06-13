<?php

/**
 * @package Birthday Posts mod
 * @version 1.0
 * @author Suki <suki@missallsunday.com>
 * @copyright 2012 Suki
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */

global $scripturl, $txt;

$txt['bp_title'] = 'Birthday Post';
$txt['bp_admin_desc'] = 'Este mod te permite crear un tema cuando alg&uacute;n usuario del foro cumple a&ntilde;os. Puedes especificar el foro, el usuario que va a crear el tema, el asunto y el mensaje. Tambi&eacute;n puedes usar la variable <strong>{membername}</strong> para personalizar el mensaje a&uacute;n m&aacute;s. Para activar este mod, ve a <a href="' . $scripturl . '?action=admin;area=scheduledtasks;sa=tasks">scheduled tasks</a> y bisca por "Post Birthday Posts"';
$txt['bp_board'] = 'ID de el foro donde se va a publicar el tema<br /><span class="smalltext" style="color: #FF0000;">NOTE: esta opci&oacute;n debe ser establecida.</span>';
$txt['bp_pid'] = 'ID de el usuario que va a crear el tema.<br /><span class="smalltext">Default es 0 que equivale a un usuario invitado</span>';
$txt['bp_psubject'] = 'Asunto del tema<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> para personalizarlo.</span>';
$txt['bp_pbody'] = 'El mensaje del tema.<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> para personalizarlo.</span>';
$txt['bp_increase_pc'] = '&iquest;Se incrementer&aacute; la cantidad de mensajes de el usuario que va a crear el tema?';
$txt['bp_default_subject'] = '&iexcl;Fel&iacute;z Cumplea&ntilde;os!';
$txt['bp_default_body'] = '&iexcl;Fel&iacute;z Cumplea&ntilde;os, {membername}!';
$txt['bp_send_pm'] = '&iquest;Enviar un mensaje privado de notificaci&oacute;n?';
$txt['bp_pmsubject'] = 'El asunto del mensaje privado.<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> y <strong>{forumname}</strong> para personalizarlo</span>';
$txt['bp_pmbody'] = 'El cuerpo del mensaje privado.<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> y <strong>{forumname}</strong> para personalizarlo</span>';
$txt['bp_min_posts'] = 'N&uacute;mero m&iacute;nimo de mensajes que el usuario debe de tener';
$txt['bp_default_pmsubject'] = '&iexcl;Fel&iacute;z Cumplea&ntilde;os!';
$txt['bp_default_pmbody'] = '&iexcl;Fel&iacute;z Cumplea&ntilde;os de parte de todo el staff de {forumname}!';
$txt['bp_lastactive'] = '&iquest;El usuario debe de haber estado activo en los ultimos d&iacute;as?<br /><span class="smalltext">Usa 0 para deshabilitar la opci&oacute;n.</span>';
$txt['bp_minregdays'] = 'N&uacute;mero de d&iacute;as que el usuario tiene que haber sido usuario del foro antes de que el mod cree un tema para su cumplea&ntilde;os?<br /><span class="smalltext">Usa 0 para deshabilitar la opci&oacute;n.</span>';
$txt['bp_reusetopic'] = 'Topic ID en donde los temas se van a publicar.<br /><span class="smalltext">Usa 0 si quieres que se cree un nuevo tema para cada usuario, de lo contrario, escribe un ID de alg&uacute;n tema v&aacute;lido para que todos los mensajes se publiquen en ese tema.</span>';
$txt['bp_postperday'] = '&iquest;Crear un s&oacute;lo tema para todos los mensajes de cumplea&ntilde;os?<br /><span class="smalltext">De lo contrario (por defecto) crear un nuevo tema para cada cumplea&ntilde;os.</span>';
$txt['bp_banned'] = 'Post/PM banned members too?';

/* Scheduled tasks */
$txt['scheduled_task_birthday_posts'] = 'Post Birthday Posts';
$txt['scheduled_task_desc_birthday_posts'] = 'Crea un nuevo tema cada vez que hay alg&uacute;n cumplea&ntilde;os.';