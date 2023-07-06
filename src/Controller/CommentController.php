<?php

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\UserManager;
use Core\Controller\Controller;
use Core\Http\Request;


final class CommentController extends Controller
{
    public function postComment($articleId)
    {
        $articleId = implode($articleId);
        $request = new Request();
        (new CommentManager())->createComment($request->getPost(), $articleId);
         $this->redirect("/articles/$articleId");
    }

    public function showAll()
    {
        if (UserManager::userIsAdmin()) {

            $data['comments'] = (new CommentManager())->getAllComments();

            $this->render('management-comment.twig', $data);
            return;
        }
         $this->redirect('/403');
    }

    public function setValidComment($id)
    {
        (new CommentManager())->updateCommentSetValid($id);
         $this->redirect('/comment-management');
    }

    public function doDeleteComment($id)
    {
        (new CommentManager())->deleteComment($id);
         $this->redirect('/comment-management');
    }
}
