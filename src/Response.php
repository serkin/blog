<?php

/**
 * Class Response.
 */
class Response
{
    /**
     * @var string
     */
    private $content = '';

    /**
     * @var int
     */
    private $statusCode = 200;

    /**
     * @var string
     */
    private $redirectUrl;

    /**
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Gets current content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Gets http status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets http status code.
     *
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Gets content type.
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Sets content type.
     *
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * Prints object content.
     */
    public function display()
    {
        echo $this->content;
    }

    /**
     * Gets url for redirect.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * Defines url for redirect.
     *
     * @param string $redirectUrl
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }
}
