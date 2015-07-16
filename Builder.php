<?php

namespace Dushica\Html;

/**
* HTML Builder
*/
class Builder
{
	private $content = '';
	private $stack = [];
	private $noClose = ['br', 'link'];

    /**
     * Used for opening all tags except special tags (ex.: text())
     *
     * @param $method
     * @param $attributes
     * @return $this
     */
	public function __call($method, $attributes)
	{
		$htmlAttributes = isset($attributes[0]) ? $this->attributes($attributes[0]) : null;

		if($htmlAttributes)
			$this->content .= "<{$method}{$htmlAttributes}>";
		else
			$this->content .= "<{$method}>";
		
		if( ! in_array($method, $this->noClose))
			$this->stack[] = $method;

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
		$result = null;

		foreach($attributes as $key=>$attribute)
			$result .= " {$key}=\"{$attribute}\"";

		return $result;
	}

    /**
     * Return the html content
     *
     * @return string
     */
	function __toString()
	{
		return $this->content;
	}
}