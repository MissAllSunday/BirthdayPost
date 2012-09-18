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

$txt['bp_title'] = 'Birthday Post';
$txt['bp_admin_desc'] = 'Este mod te permite crear un tema cuando algún usuario del foro cumple años. Puedes especificar el foro, el usuario que va a crear el tema, el asunto y el mensaje. También puedes usar la variable <strong>{membername}</strong> para personalizar el mensaje aún más. Para activar este mod, ve a <a href="' . $scripturl . '?action=admin;area=scheduledtasks;sa=tasks">scheduled tasks</a> y bisca por "Post Birthday Posts"';
$txt['bp_board'] = 'ID de el foro donde se va a publicar el tema<br /><span class="smalltext" style="color: #FF0000;">NOTE: esta opción debe ser establecida.</span>';
$txt['bp_pid'] = 'ID de el usuario que va a crear el tema.<br /><span class="smalltext">Default es 0 que equivale a un usuario invitado</span>';
$txt['bp_psubject'] = 'Asunto del tema<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> para personalizarlo.</span>';
$txt['bp_pbody'] = 'El mensaje del tema.<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> para personalizarlo.</span>';
$txt['bp_min_posts'] = 'Número mínimo de mensajes que el usuario debe de tener';
$txt['bp_increase_pc'] = '¿Se incrementerá la cantidad de mensajes de el usuario que va a crear el tema?';
$txt['bp_default_subject'] = '¡Felíz Cumpleaños!';
$txt['bp_default_body'] = '¡Felíz Cumpleaños, {membername}!';
$txt['bp_send_pm'] = '¿Enviar un mensaje privado de notificación?';
$txt['bp_pmsubject'] = 'El asunto del mensaje privado.<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> y <strong>{forumname}</strong> para personalizarlo</span>';
$txt['bp_pmbody'] = 'El cuerpo del mensaje privado.<br /><span class="smalltext">Puedes usar <strong>{membername}</strong> y <strong>{forumname}</strong> para personalizarlo</span>';
$txt['bp_default_pmsubject'] = '¡Felíz Cumpleaños!';
$txt['bp_default_pmbody'] = '¡Felíz Cumpleaños de parte de todo el staff de {forumname}!';
$txt['bp_lastactive'] = '¿El usuario debe de haber estado activo en los ultimos dias?<br /><span class="smalltext">Usa 0 para deshabilitar la opción.</span>';
$txt['bp_minregdays'] = 'Número de dias que el usuario tiene que haber sido usuario del foro antes de que el mod cree un tema para su cumpleaños?<br /><span class="smalltext">Usa 0 para deshabilitar la opción.</span>';
$txt['bp_reusetopic'] = 'Topic ID en donde los temas se van a publicar.<br /><span class="smalltext">Usa 0 si quieres que se cree un nuevo tema para cada usuario, de lo contrario, escribe un ID de algún tema válido para que todos los mensajes se publiquen en ese tema.</span>';
$txt['bp_postperday'] = '¿Crear un sólo tema para todos los mensajes de cumpleaños?<br /><span class="smalltext">De lo contrario (por defecto) crear un nuevo tema para cada cumpleaños.</span>';
$txt['bp_banned'] = 'Post/PM banned members too?';

/* Scheduled Tasks */
$txt['scheduled_task_birthday_posts'] = 'Post Birthday Posts';
$txt['scheduled_task_desc_birthday_posts'] = 'Crea un nuevo tema cada vez que hay algún cumpleaños.';