<?php

namespace Config;

class Routes
{


    /**
     * @return array
     */
    public static function get(): array
    {
        return [
            new \Core\Router\Route('/^\/$/', \App\Controller\HomeController::class, 'showHome'),
            new \Core\Router\Route('/^\/articles$/', \App\Controller\ArticleController::class, 'showAll'),
            new \Core\Router\Route('/^\/articles\/([0-9]+)$/', \App\Controller\ArticleController::class, 'show'),
            new \Core\Router\Route('/^\/post-comment\/([0-9]+)$/', \App\Controller\CommentController::class, 'postComment'),
            new \Core\Router\Route('/^\/registration$/', \App\Controller\FormController::class, 'showFormRegistration'),
            new \Core\Router\Route('/^\/do-registration$/', \App\Controller\FormController::class, 'doRegistration'),
            new \Core\Router\Route('/^\/connection$/', \App\Controller\FormController::class, 'showFormConnection'),
            new \Core\Router\Route('/^\/do-connection$/', \App\Controller\FormController::class, 'doConnection'),
            new \Core\Router\Route('/^\/logout$/', \App\Controller\FormController::class, 'logout'),
            new \Core\Router\Route('/^\/article-creation$/', \App\Controller\FormController::class, 'showFormCreationArticle'),
            new \Core\Router\Route('/^\/do-article-creation$/', \App\Controller\ArticleController::class, 'postArticle'),
            new \Core\Router\Route('/^\/article-management$/', \App\Controller\ArticleController::class, 'modifyArticle'),
            new \Core\Router\Route('/^\/article-modify\/([0-9]+)$/', \App\Controller\FormController::class, 'showFormModifyArticle'),
            new \Core\Router\Route('/^\/article-delete\/([0-9]+)$/', \App\Controller\ArticleController::class, 'doDeleteArticle'),
            new \Core\Router\Route('/^\/do-article-modify\/([0-9]+)$/', \App\Controller\ArticleController::class, 'doModifyArticle'),
            new \Core\Router\Route('/^\/comment-management$/', \App\Controller\CommentController::class, 'showAll'),
            new \Core\Router\Route('/^\/comment-approved\/([0-9]+)$/', \App\Controller\CommentController::class, 'setValidComment'),
            new \Core\Router\Route('/^\/comment-delete\/([0-9]+)$/', \App\Controller\CommentController::class, 'doDeleteComment'),
            new \Core\Router\Route('/^\/user-management$/', \App\Controller\UserController::class, 'showAllUser'),
            new \Core\Router\Route('/^\/user-admin\/([0-9]+)$/', \App\Controller\UserController::class, 'setAdmin'),
            new \Core\Router\Route('/^\/user-user\/([0-9]+)$/', \App\Controller\UserController::class, 'setUser'),
            new \Core\Router\Route('/^\/user-delete\/([0-9]+)$/', \App\Controller\UserController::class, 'doDeleteUser'),
            new \Core\Router\Route('/^\/do-contact$/', \App\Controller\FormController::class, 'sendEmail'),
            new \Core\Router\Route('/^\/403$/', \App\Controller\ErrorController::class, 'show403'),
            new \Core\Router\Route('/^\/confirm-registration\/([a-f0-9]{64})$/', \App\Controller\UserController::class, 'setValid'),
            new \Core\Router\Route('/^\/profile$/', \App\Controller\UserController::class, 'showProfile'),
            new \Core\Router\Route('/^\/update-password\/([0-9]+)$/', \App\Controller\UserController::class, 'changePassword'),
        ];
    }


}
