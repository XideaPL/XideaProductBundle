<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Controller;

use Symfony\Component\BrowserKit\Cookie,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ControllerTestCase extends WebTestCase
{
    /*
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    protected $client;
    
    public function setUp()
    {
        $this->client = static::createClient();
    }
    
    protected function logIn()
    {
        $session = $this->client->getContainer()->get('session');
        $userLoader = $this->client->getContainer()->get('xidea_user.user_loader');

        $firewall = 'app';
        $user = $userLoader->loadOneByUsername('admin');
        $token = new UsernamePasswordToken($user, $user->getPassword(), $firewall, $user->getRoles());
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}

