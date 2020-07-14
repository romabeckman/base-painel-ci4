<?php

namespace App\Services;

use \CodeIgniter\Config\BaseService;
use function \service;

/**
 * Description of Message
 *
 * @author Romário Beckman
 */
class AlertMessages extends BaseService {

    static function setMsgSuccess(string $message) {
        static::setMessage($message, 'success');
    }

    static function setMsgWarning(string $message) {
        static::setMessage($message, 'warning');
    }

    static function setMsgDanger(string $message) {
        static::setMessage($message, 'danger');
    }

    static function setMsgInfo(string $message) {
        static::setMessage($message, 'info');
    }

    static private function setMessage(string $message, string $alert) {
        \System\Config\Sys::$log['alert_messages'] = [
            'text' => $message,
            'alert' => $alert
        ];

        service('session')->setFlashdata('alert-message', [
            'text' => $message,
            'alert' => $alert
        ]);
    }

    static function getMessage(): ?array {
        return service('session')->getFlashdata('alert-message');
    }

}
