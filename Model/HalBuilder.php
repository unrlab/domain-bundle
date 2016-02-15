<?php
/**
 * Created by IntelliJ IDEA.
 * User: dj3
 * Date: 28/12/15
 * Time: 19:22
 */

namespace UnrLab\DomainBundle\Model;


trait HalBuilder
{
    protected function buildLink($id, $route, $pattern)
    {
        $link = new Link($route, $pattern);
        $links = $link->generageLink($id);

        return $links;
    }
    protected function buildLinks(array $ids, $route, $pattern)
    {
        $links = array();
        if (count($ids) > 0){
            foreach ($ids as $id) {
                $links[] = $this->buildLink($id, $route, $pattern);
            }
        }

        return $links;
    }
}