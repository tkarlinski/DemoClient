<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author    Tomasz Karliński <karlinski.tomasz@gmail.com>
 * @copyright 2017 tkarlinski
 * @package   AppBundle\Controller
 * @since     2017-09-10
 * @version   Release: $Id$
 */
class ClientCredentialsController extends Controller
{
    const ACTION_TOKEN = '/app_dev.php/token';

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

            $client = $this->getGuzzleClient();
            $response = $client->post(self::ACTION_TOKEN, [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'scope' => 'scope1',
                ],
                'auth' => [
                    $this->getParameter('client_name'),
                    $this->getParameter('client_secret')
                ],
            ]);

            $result = json_decode($response->getBody(), true);

            var_dump($result);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return [];
    }

    /**
     * @return Client
     */
    protected function getGuzzleClient()
    {
        return $this->get('guzzle.client.api_oauth_server');
    }
}