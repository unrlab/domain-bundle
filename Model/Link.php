<?php
/**
 * Created by IntelliJ IDEA.
 * User: dj3
 * Date: 28/12/15
 * Time: 19:25
 */

namespace UnrLab\DomainBundle\Model;


class Link
{
    private $pattern;

    private $route;

    public function __construct($route, $pattern)
    {
        $this->route   = $route;
        $this->pattern = $pattern;
    }

    public function generageLink($id)
    {
        return str_replace($this->pattern, $id, $this->route);
    }
}