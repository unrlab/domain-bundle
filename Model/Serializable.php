<?php
/**
 * Created by IntelliJ IDEA.
 * User: dj3
 * Date: 28/12/15
 * Time: 19:44
 */

namespace UnrLab\DomainBundle\Model;


interface Serializable
{
    public function preSerialize();
    public function getLinks();
}