<?php

namespace joaomlopes\HtmlToPDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JLHtmlToPDFBundle:Default:index.html.twig');
    }
}
