<?php

namespace AppBundle\Controller;

use Guzzle\Http\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author    Tomasz Karliński <karlinski.tomasz@gmail.com>
 * @copyright 2017 tkarlinski
 * @package   AppBundle\Controller
 * @since     2017-09-10
 * @version   Release: $Id$
 */
class ClientCredentialsController
{
    /**
     * @Route("/cc/authenticate")
     *
     * @Template()
     * @param Request $request
     * @return array
     */
    public function authenticateAction(Request $request)
    {
        try {
            $client = new Client();
            $request = $client->delete();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return [];
    }

}