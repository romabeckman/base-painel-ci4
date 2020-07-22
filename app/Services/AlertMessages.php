<?php

namespace App\Services;

use \CodeIgniter\Config\BaseService;
use \Exception;
use function \service;

/**
 * Description of Message
 *
 * @author Romário Beckman
 */
class AlertMessages extends BaseService {

    /**
     * @param string $message
     * @param Exception|null $exc
     */
    function setMsgSuccess(string $message, ?Exception $exc = null) {
        $this->setMessage($message, 'success', $exc);
    }

    /**
     * @param string $message
     * @param Exception|null $exc
     */
    function setMsgWarning(string $message, ?Exception $exc = null) {
        $this->setMessage($message, 'warning', $exc);
    }

    /**
     * @param string $message
     * @param Exception|null $exc
     */
    function setMsgDanger(string $message, ?Exception $exc = null) {
        $this->setMessage($message, 'danger', $exc);
    }

    /**
     * @param string $message
     * @param Exception|null $exc
     */
    function setMsgInfo(string $message, ?Exception $exc = null) {
        $this->setMessage($message, 'info', $exc);
    }

    /**
     * @param string $message
     * @param string $alert
     * @param Exception|null $exc
     */
    private function setMessage(string $message, string $alert, ?Exception $exc = null) {
        if (ENVIRONMENT == 'development' && !is_null($exc)) {
            $message .= '<hr /><b>' . $exc->getMessage() . '</b><br />' . nl2br($exc->getTraceAsString());
        }

        \System\Config\Sys::$log['alert_message'] = [
            'text' => $message,
            'alert' => $alert
        ];

        service('session')->setFlashdata('alert-message', [
            'text' => $message,
            'alert' => $alert
        ]);
    }

    /**
     * @return array|null
     */
    function getMessage(): ?array {
        return service('session')->getFlashdata('alert-message');
    }

}
