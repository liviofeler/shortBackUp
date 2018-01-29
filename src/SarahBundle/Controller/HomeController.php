<?php

namespace SarahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('SarahBundle:Default:index.html.twig');
    }
}
