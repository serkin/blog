<?php

/**
 * Class Application.
 */
class Application
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Handle Request.
     *
     * Determines which router should be executed and hand over job to it
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $router = $this->findRouter($request->getUrl());

        if (is_null($router)) {
            return $this->getNotFoundResponse('Cannot found Controller');
        }

        /** @var Controller $controller */
        $controller = new $router['class']();

        $controller->setService('octrine', $this->configureOctrineService());
        $controller->setService('session', $this->configureSession());

        return call_user_func_array([$controller, $router['method']], [$request]);
    }

    /**
     * Matches routers against url.
     *
     * @param string $url
     *
     * @return array|null
     */
    private function findRouter($url)
    {
        foreach ($this->config['routers'] as $router) {
            $pattern = str_replace('/', '\/', $router['pattern']);
            if (preg_match("/{$pattern}/", $url)) {
                return $router;
            }
        }

        return;
    }

    /**
     * Terminates application.
     *
     * Renders content or excute redirecting
     *
     * @param Response $response
     */
    public function terminate(Response $response)
    {
        if ($response->getRedirectUrl() === null) {
            header("Content-Type: {$response->getContentType()}; charset=utf-8");
            http_response_code($response->getStatusCode());

            $response->display();
        } else {
            header("Location: {$response->getRedirectUrl()}");
        }

        exit();
    }

    /**
     * Prepares Session object for di container.
     *
     * @return Session
     */
    private function configureSession()
    {
        $session = new Session();

        if (isset($_SESSION['userId'])) {
            $session->setUserId($_SESSION['userId']);
        }

        if (isset($_SESSION['userLogin'])) {
            $session->setUserLogin($_SESSION['userLogin']);
        }

        return $session;
    }

    /**
     * Prepare Octrine for DI container.
     *
     * @return Octrine
     */
    private function configureOctrineService()
    {
        $pdo = $this->configurePDO();
        $octrine = new Octrine($pdo);

        return $octrine;
    }

    /**
     * Configures PDO for Octrine.
     *
     * @return PDO
     */
    private function configurePDO()
    {
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ];

        return new PDO(
            $this->config['db']['dsn'],
            $this->config['db']['userName'],
            $this->config['db']['password'],
            $options
        );
    }

    /**
     * Creates default Response in case of emergency.
     *
     * @param $message
     *
     * @return Response
     */
    private function getNotFoundResponse($message)
    {
        $response = new Response($message);
        $response->setStatusCode(404);

        return $response;
    }
}
