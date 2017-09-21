<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/key-test", name="keyTest")
     *
     * @param Request $request
     */
    public function keyTestAction(Request $request)
    {
        $privateKey = file_get_contents('/var/www/ClientA/data/privkey2.pem');

        try {
            $sig = openssl_sign('Test data', $signature, $privateKey, OPENSSL_ALGO_SHA256);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        exit;
    }
}
