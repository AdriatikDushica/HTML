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
    public $minify = true;

    /**
     * Used for opening all tags except special tags (ex.: ->text())
     *
     * @param $method
     * @param $parameters
     * @return $this
     */
    public function __call($tag, $parameters)
    {
        $attributes = isset($parameters[0]) && is_array($parameters[0]) ? $this->attributes($parameters[0]) : '';

        if( ! $this->minify)
            $this->fixTab();

        $this->content .= "<{$tag}{$attributes}>" . ( ! $this->minify ? "\n" : "");
        
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
        
        if( ! $this->minify)
            $this->fixTab();

        if($tag==null)
            throw new Exception("No more tags to close", 1);

        $this->content .= "</{$tag}>" . ( ! $this->minify ? "\n" : "");

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
        if( ! $this->minify)
            $this->fixTab();

        $this->content .= $text . ( ! $this->minify ? "\n" : "");

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

    /*
     * Fix tabs using the number of elements in the stack
     *
     */
    public function fixTab()
    {
        for($i=0; $i<count($this->stack); $i++) $this->content .= "\t";
    }

}