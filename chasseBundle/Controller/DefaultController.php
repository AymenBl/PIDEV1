<?php

namespace chasseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('chasseBundle:Default:index.html.twig');
    }
}
