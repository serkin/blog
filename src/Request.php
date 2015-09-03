<?php

/**
 * Class Request.
 */
class Request
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $get = [];

    /**
     * @var array
     */
    private $post = [];

    /**
     * Create Request from global arrays.
     *
     * @return Request
     */
    public static function createFromGlobals()
    {
        $request = new self();
        $request->setGetParams(filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING));
        $request->setPostParams(filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING));
        $request->setUrl($_SERVER['REQUEST_URI']);

        return $request;
    }

    /**
     * Set current url.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets current url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets get array.
     *
     * @param array $vars
     */
    public function setGetParams($vars)
    {
        $this->get = $vars;
    }

    /**
     * Sets post array.
     *
     * @param array $vars
     */
    public function setPostParams($vars)
    {
        $this->post = $vars;
    }

    /**
     * Gets var for _GET array.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name)
    {
        return isset($this->get[$name])
            ? $this->get[$name]
            : null;
    }

    /**
     * Gets var for _POST array.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getPostParam($name)
    {
        return isset($this->post[$name])
            ? $this->post[$name]
            : null;
    }
}
