<?php
/**
 * Helper Mensagens do sistema
 *
 * @author Fábio Assunção <fabio@fabioassuncao.com.br>
 * @date April 30, 2016
 */

use \Babita\Helpers\Url;
use \Babita\Helpers\Session;

/**
 * Envia as mensagens de sistema para a view
 */
function systemMessage($message, $class = 'warning')
{
    switch ($class) {
        case 'warning':
            $icon = 'fa-warning';
            break;

        case 'danger':
            $icon = 'fa-ban';
            break;

        case 'success':
            $icon = 'fa-check';
            break;

        case 'info':
            $icon = 'fa-info';
            break;
    }

    if (is_array($message)) {
        if (!isset($message['title']) || empty($message['title'])){
            $message['title'] = '';
        }

        if (!isset($message['message']) || empty($message['message'])){
            $message['message'] = '';
        }
    }

    if(is_string($message)) {
        $strMessage = $message;
        $message = [
            'title' => $strMessage,
            'message' => ''
        ];
    }

    $dataMessage = [
        'class' => $class,
        'icone' => $icon,
        'title' => $message['title'],
        'message' => $message['message']
    ];

    Session::set('messageSystem', $dataMessage);
}

/**
 * Mensagens de avisos
 */
function alertWarning($message)
{
    systemMessage($message, 'warning');
}

/**
 * Mensagens de erros
 */
function alertError($message)
{
    systemMessage($message, 'danger');
}

/**
 * Mensagens de sucesso
 */
function alertSuccess($message)
{
    systemMessage($message, 'success');
}

/**
 * Mensagens de informações
 */
function alertInfo($message)
{
    systemMessage($message, 'info');
}

/**
 * Checa as mensagens de erros enviados para a view atrvés de http/post
 */
function getMessageSystem()
{
    $messageSystem = Session::pull('messageSystem');
    if (!empty($messageSystem)) {
        return \Babita\Mvc\View::get('app/views/message', $messageSystem, true, true);
    }

    return "";
}