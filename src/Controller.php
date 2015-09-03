<?php

/**
 * Class Controller.
 */
class Controller
{
    /**
     * @var array
     */
    protected $di = [];

    /**
     * Gets merged content form layout and page.
     *
     * @param string $template
     * @param array  $data
     *
     * @return Response
     *
     * @throws Exception
     */
    public function render($template, $data = [])
    {
        $response = new Response();

        $pageContent = $this->getPageContent($template, $data);

        $content = $this->getLayoutContent($pageContent, $data);

        $response->setContent($content);

        return $response;
    }

    /**
     * Get current page content.
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     *
     * @throws Exception
     */
    private function getPageContent($template, $data = [])
    {
        if (is_array($data)) {
            extract($data);
        }

        $session = $this->getService('session');

        $templatePath = dirname(__DIR__).'/templates/'.$template.'.php';

        if (!file_exists($templatePath)) {
            throw new Exception("Template: {$templatePath} doesnt exist");
        }

        ob_start();

        require $templatePath;

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Gets layout content.
     *
     * @param string $pageContent
     * @param array  $data
     *
     * @return string
     *
     * @throws Exception
     */
    private function getLayoutContent($pageContent, $data = [])
    {
        if (is_array($data)) {
            extract($data);
        }

        $session = $this->getService('session');

        $layoutPath = dirname(__DIR__).'/templates/layout/base.php';

        if (!file_exists($layoutPath)) {
            throw new Exception("Layout: {$layoutPath} doesnt exist");
        }

        ob_start();

        require $layoutPath;

        $layoutContent = ob_get_contents();
        ob_end_clean();

        return str_replace('{content}', $pageContent, $layoutContent);
    }

    /**
     * @param string $name
     */
    public function setService($name, $service)
    {
        $this->di[$name] = $service;
    }

    /**
     * Dets service form DI container.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getService($name)
    {
        return isset($this->di[$name])
            ? $this->di[$name]
            : null;
    }

    /**
     * Get default resonse.
     *
     * @param string $message
     *
     * @return Response
     */
    public function getNotFoundResponse($message)
    {
        return $this->render('error', ['message' => $message]);
    }
}
