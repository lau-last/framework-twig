<?php

namespace App\Manager;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

final class EmailManager
{


    /**
     * @param array $input
     * @return bool
     */
    private function isValidName(array $input): bool
    {
        return (isset($input['name']) && strlen($input['name']) > 2);
    }


    /**
     * @param array $input
     * @return bool
     */
    private function isValidFirstName(array $input): bool
    {
        return (isset($input['first-name']) && strlen($input['first-name']) > 2);
    }


    /**
     * @param array $input
     * @return bool
     */
    private function isValidSubject(array $input): bool
    {
        return (isset($input['subject']) && strlen($input['subject']) > 4);
    }


    /**
     * @param array $input
     * @return bool
     */
    private function isValidMessage(array $input): bool
    {
        return (isset($input['subject']) && strlen($input['subject']) > 29);
    }


    /**
     * @param array $input
     * @return bool
     */
    private function checkEmail(array $input): bool
    {
        return (isset($input['email']) && filter_var($input['email'], FILTER_VALIDATE_EMAIL));
    }


    /**
     * @param array $input
     * @return array
     */
    public function isValidFormContact(array $input): array
    {

        $errors = [];
        if($this->isValidName($input) === false) {
            $errors['name'] = 'Your name must contain at least 3 characters';
        }

        if($this->isValidFirstName($input) === false) {
            $errors['first-name'] = 'Your first name must contain at least 3 characters';
        }

        if($this->isValidSubject($input) === false) {
            $errors['subject'] = 'Your subject must contain at least 5 characters';
        }

        if($this->isValidMessage($input) === false) {
            $errors['name'] = 'Your message must contain at least 30 characters';
        }

        if ($this->checkEmail($input) === false) {
            $errors['email'] = 'The email address is not valid';
        }

        return $errors;
    }


    /**
     * @param $input
     * @return bool
     */
    public function doSendEmailContact($input): bool
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = getenv("MAIL_HOST");
            $mail->SMTPAuth = true;
            $mail->Port = getenv("MAIL_PORT");
            $mail->Username = getenv("MAIL_USERNAME");
            $mail->Password = getenv("MAIL_PASSWORD");
            $mail->setFrom(trim($input['email']), trim($input['first-name'] . ' ' . trim($input['name'])));
            $mail->addAddress('laurent@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = trim($input['subject']);
            $mail->Body = trim($input['message']);
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * @param $input
     * @return bool
     */
    public function doSendEmailValidation($input): bool
    {
        $userInfo = (new UserManager())->getUserInfo($input['email']);
        $message = '
        <h1>Hello and welcome to the blog !!</h1>
        <p>Here is the link to validate your registration. After one hour from receiving it, the link will no longer be valid. You will need to register again.</p>
        <a href="http://localhost:8000/confirm-registration/' . $userInfo->getToken() . '" target="_blank">Validate your account by clicking on this link.</a>';
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = getenv("MAIL_HOST");
            $mail->SMTPAuth = true;
            $mail->Port = getenv("MAIL_PORT");
            $mail->Username = getenv("MAIL_USERNAME");
            $mail->Password = getenv("MAIL_PASSWORD");
            $mail->setFrom('No-Reply@exemple.com', 'Mailer');
            $mail->addAddress(trim($input['email']));
            $mail->isHTML(true);
            $mail->Subject = 'validation';
            $mail->Body = $message;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


}
