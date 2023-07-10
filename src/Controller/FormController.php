<?php

namespace App\Controller;

use App\Manager\ArticleManager;
use App\Manager\EmailManager;
use App\Manager\FormManager\FormConnection;
use App\Manager\FormManager\FormRegistration;
use App\Manager\UserManager;
use App\SessionBlog\SessionBlog;
use Core\Controller\Controller;
use Core\Http\Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class FormController extends Controller
{


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showFormConnection(): void
    {
        $this->render('connection.twig');
    }


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function doConnection(): void
    {
        $form = new FormConnection();
        $request = new Request();
        if ($form->registerSession($request->getPost()) === false) {
            $data = [];
            $data['error'] = 'The login or password is incorrect';
            $this->render('connection.twig', $data);
            return;
        }
        $this->redirect('/');
    }


    /**
     * @return void
     */
    public function logout(): void
    {
        SessionBlog::destroy();
        $this->redirect('/');
    }


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showFormRegistration(): void
    {
        $this->render('registration.twig');
    }


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws \Exception
     */
    public function doRegistration(): void
    {
        $request = new Request();
        $registration = new FormRegistration();
        $errors = $registration->isValid($request->getPost());
        $data = [];
        if (empty($errors) === false) {
            $data['errors'] = $errors;
            $this->render('registration.twig', $data);
            return;
        }
        (new UserManager())->doPreRegistration($request->getPost());
        $messages = (new EmailManager())->doSendEmailValidation($request->getPost()) ?
            'Message has been sent for validation' :
            'Message could not be sent for validation retry please';
        $data['message'] = $messages;
        $this->render('registration.twig', $data);
    }


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showFormCreationArticle(): void
    {
        if (UserManager::userIsAdmin() === true) {
            $this->render('creation-article.twig');
            return;
        }
        $this->redirect('/403');
    }


    /**
     * @param $id
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showFormModifyArticle($id): void
    {
        $data = [];
        $data['article'] = (new ArticleManager())->getArticle($id);
        $this->render('modify-article.twig', $data);
    }


    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendEmail(): void
    {
        $data = [];
        $request = new Request();
        $messages = (new EmailManager())->doSendEmailContact($request->getPost()) ? 'Message has been sent' : 'Message could not be sent';
        $data['messages'] = $messages;
        $this->render('home.twig', $data);
    }


}
