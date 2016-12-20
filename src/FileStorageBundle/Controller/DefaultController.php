<?php

namespace FileStorageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])
            || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli-server')
        ) {
            header('HTTP/1.0 403 Forbidden');
            exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
        }
        return $this->render('FileStorageBundle:Test:main.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
