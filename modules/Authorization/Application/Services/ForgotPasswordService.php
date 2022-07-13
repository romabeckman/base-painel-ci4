<?php

namespace Authorization\Application\Services;

use \Authorization\Application\Exceptions\InvalidUserEmailException;
use \Authorization\Application\Exceptions\RecoveryPasswordFailException;
use \Authorization\Config\Services as AuthorizationService;
use \Authorization\Infrastructure\Persistence\Entity\User;
use \CodeIgniter\Email\Email;
use \System\Config\Services;
use \System\Config\System;
use const \PROJECT_NAME;
use function \db_connect;
use function \lang;
use function \view;

/**
 * Description of Email
 *
 * @author Romário Beckman
 */
class ForgotPasswordService {

    protected Email $emailConfig;

    public function __construct() {
        $this->emailConfig = Services::email();
    }

    public function handler(string $email): void {
        $user = AuthorizationService::userRepository()->getUserFromEmail($email);

        if (empty($user)) {
            System::$log['auth'] = 'Invalid login: ' . lang('Auth.invalid_user_email');
            throw new InvalidUserEmailException(lang('Auth.invalid_user_email'));
        }

        $password = substr(strtoupper(uniqid()), -5);
        $user->setPassword($password);
        AuthorizationService::userRepository()
                ->getModel()
                ->update(
                        id: $user->id,
                        data: [
                            'password' => $user->password,
                            'force_change_password' => 1
                        ]
        );
        $this->sendEmail($user, $password);
    }

    protected function sendEmail(User $user, string $password): void {
        $emailFrom = \System\Config\Services::configurationRepository()->getConfiguration('EMAIL_FROM');
        $emailFromName = \System\Config\Services::configurationRepository()->getConfiguration('EMAIL_FROM_NAME');

        $this->emailConfig->setFrom($emailFrom, $emailFromName);
        $this->emailConfig->setTo($user->email);

        $html = view('Authorization\Views\forgot_password_email', ['user' => $user, 'password' => $password]);

        $this->emailConfig->setSubject('Recuperação de Senha ' . PROJECT_NAME);
        $this->emailConfig->setMessage($html);

        if (!$this->emailConfig->send()) {
            throw new RecoveryPasswordFailException('Falha ao enviar o e-mail de recuperação de senha.');
        }
    }

}
