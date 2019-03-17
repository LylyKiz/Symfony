<?php

namespace Dom\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DomCarBundle:Default:index.html.twig');
    }
}
