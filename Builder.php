<?php

namespace Dushica\Html;

/**
* HTML Builder
*/
class Builder
{
    private $content = '';
    private $stack = [];
    private $noClose = ['input', 'br'];

    /**
     * Used for opening all tags except special tags (ex.: text())
     *
     * @param $method
     * @param $parameters
     * @return $this
     */
    public function __call($tag, $parameters)
    {
        $attributes = isset($parameters[0]) ? $this->attributes($parameters[0]) : '';

        $this->content .= "<{$tag}{$attributes}>";
        
        if( ! in_array($tag, $this->noClose))
            $this->stack[] = $tag;

        return $this;
    }

    /**
     * Is used for ending all tags from the stack.
     *
     * @return $this
     */
    public function end()
    {
        $tag = array_pop($this->stack);

        if($tag==null)
            throw new Exception("No more tags to close", 1);

        $this->content .= "</{$tag}>";

        return $this;
    }

    /**
     * Used for inserting simple text inside tags
     *
     * @param $text
     * @return $this
     */
    public function text($text)
    {
        $this->content .= $text;

        return $this;
    }

    /**
     * Used for generating html attributes from array.
     *
     * @param $attributes
     * @return null|string
     */
    public function attributes(array $attributes)
    {
        $result = '';

        foreach($attributes as $key=>$attribute)
            $result .= " {$key}=\"{$attribute}\"";

        return $result;
    }

    /**
     * Return the html content
     *
     * @return string
     */
    public function __toString()
    {
        return $this->content;
    }

    /**
     * Add a tag that not must be closed. (ex.: 'br') 
     *
     */
    public function addNoClose($noClose)
    {
        $this->noClose[] = $noClose;
    }

    /*
     * Set the array of tags tha not must be closed. (ex.: ['br', 'input'])
     *
     */
    public function setNoClose(array $noClose = [])
    {
        $this->noClose = $noClose;
    }

}