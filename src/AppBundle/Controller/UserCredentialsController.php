<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author    Tomasz Karliński <karlinski.tomasz@gmail.com>
 * @copyright 2017 tkarlinski
 * @package   AppBundle\Controller
 * @since     2017-09-11
 * @version   Release: $Id$
 */
class UserCredentialsController extends Controller
{
    const ACTION_TOKEN = '/app_dev.php/token';
    const ACTION_VERIFY = '/app_dev.php/verify';

    /**
     * @Route("/uc/password")
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
                    'grant_type' => 'password',
                    'username' => 'tomek',
                    'password' => 'test123',
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
     * @Route("/uc/verify")
     *
     * @Template()
     * @param Request $request
     * @return array
     */
    public function verifyResourceAction(Request $request)
    {
        try {
            $client = $this->getGuzzleClient();

            $url = self::ACTION_VERIFY . '?access_token=f758cc639f016e36bbea04a0f3af1173417fcdc3';

            $response = $client->get($url, []);

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