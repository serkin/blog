<?php

namespace MyBlog\Controller;

use Response;

/**
 * Class DefaultController.
 */
class DefaultController extends \Controller
{
    /**
     * Action for "/" router.
     *
     * @return Response
     */
    public function indexAction()
    {

        /** @var \Octrine $octrine */
        $octrine = $this->getService('octrine');
        $posts = $octrine->getRepository('\MyBlog\Entity\Post')->findAll();

        return $this->render('index', [
            'posts' => $posts,
            'pageTitle' => 'My awesome blog',
        ]);
    }

    /**
     * Action for "/logout/" router.
     *
     * @return Response
     */
    public function logoutAction()
    {

        /** @var \Session $session */
        $session = $this->getService('session');
        $session->destroy();

        return $this->indexAction();
    }

    /**
     * Action for "/post/?id=x" router.
     *
     * @param \Request $request
     *
     * @return Response
     */
    public function showPostAction(\Request $request)
    {

        /** @var \Octrine $octrine */
        $octrine = $this->getService('octrine');

        /** @var \MyBlog\Entity\Post $post */
        $post = $octrine->getRepository('\MyBlog\Entity\Post')->findById($request->get('id'));

        if (!$post) {
            return $this->getNotFoundResponse('Post not found');
        }

        return $this->render('post', [
            'post' => $post,
            'pageTitle' => $post->getTitle(),
        ]);
    }

    /**
     * Action for "/authform/" router.
     *
     * @return Response
     */
    public function authFormAction()
    {
        return $this->render('auth', []);
    }

    /**
     * Action for "/auth/" router.
     *
     * @param \Request $request
     *
     * @return Response
     */
    public function authorizationAction(\Request $request)
    {

        /** @var \Session $session */
        $session = $this->getService('session');

        /** @var \Octrine $octrine */
        $octrine = $this->getService('octrine');

        /** @var \MyBlog\Entity\User $user */
        $user = $octrine->getRepository('\MyBlog\Entity\User')
            ->findByUserLogin($request->getPostParam('login'));

        if ($user && password_verify($request->getPostParam('password'), $user->getPassword())) {
            $session->setUserLogin($user->getLogin());
            $session->setUserId($user->getId());

            $response = new Response();
            $response->setRedirectUrl('/newpostform/');

            return $response;
        } else {
            $error = 'Login or password incorrect';
        }

        return $this->render('auth', ['error' => $error]);
    }

    /**
     * Action for "/newpostform/" router.
     *
     * @return Response
     */
    public function newPostFormAction()
    {
        return $this->render('newpost');
    }

    /**
     * Action for "/newpost/" router.
     *
     * @param \Request $request
     *
     * @return Response
     */
    public function newPostAction(\Request $request)
    {

        /** @var \Session $session */
        $session = $this->getService('session');

        if ($session->isClientAuthorized() === false) {
            $response = new Response();
            $response->setRedirectUrl('/auth/');

            return $response;
        }

        $form = $request->getPostParam('form');

        if (empty($form['title']) or empty($form['text'])) {
            return $this->render('newpost', ['error' => 'Fields cannot be empty']);
        }

        $post = new \MyBlog\Entity\Post();
        $post->setOctrine($this->getService('octrine'));

        $post->setUserId($session->getUserId());
        $post->setTitle($form['title']);
        $post->setText($form['text']);

        if ($post->save() === true && $post->getId() !== null) {
            $response = new Response();
            $response->setRedirectUrl('/post/?id='.$post->getId());

            return $response;
        } else {
            return $this->render('newpost', ['error' => 'Cannot save post']);
        }
    }

    /**
     * Action for "/newcomment/" router.
     *
     * @param \Request $request
     *
     * @return Response
     */
    public function newCommentAction(\Request $request)
    {
        $form = $request->getPostParam('form');

        if (empty($form['id_post'])) {
            return $this->indexAction();
        }

        if (empty($form['comment'])) {
            $request->setGetParams(['id' => $form['id_post']]);

            return $this->showPostAction($request);
        }

        $comment = new \MyBlog\Entity\Comment();
        $comment->setOctrine($this->getService('octrine'));

        /** @var \Session $session */
        $session = $this->getService('session');

        if ($session->isClientAuthorized()) {
            $comment->setUserId($session->getUserId());
        }

        $comment->setPostId($form['id_post']);
        $comment->setComment($form['comment']);

        $comment->save();

        $response = new Response();
        $response->setRedirectUrl('/post/?id='.$comment->getPostId());

        return $response;
    }
}
