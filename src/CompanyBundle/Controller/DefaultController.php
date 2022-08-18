<?php

namespace CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($content)
    {
        $data = array('content' => $content);

        $html = 'companySearch/index.html.twig';

        $templating = $this->container->get('twig');
        $contentTag =$templating->render('companySearch/index.html.twig',array('name'=>$content));
        $response = new Response($contentTag);
        return $response;

    }
}
