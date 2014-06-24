<?php

/*
 * (c) Infonet Projekt SA <oprogramowanie@infonet-projekt.com.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\EventListener;

use Symfony\Component\EventDispatcher\Event,
    Symfony\Component\EventDispatcher\EventSubscriberInterface,
    Symfony\Component\HttpFoundation\Session\SessionInterface,
    Symfony\Component\Translation\TranslatorInterface;

use Xidea\Bundle\ProductBundle\ProductEvents,
    Xidea\Bundle\ProductBundle\Event\GetProductResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@infonet-projekt.com.pl>
 */
class FlashSubscriber implements EventSubscriberInterface
{

    private static $successMessages = array(
        ProductEvents::CREATE_COMPLETED => 'product.flash.create_completed'
    );
    private $session;
    private $translator;

    public function __construct(SessionInterface $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ProductEvents::CREATE_COMPLETED => 'onCreateCompleted'
        );
    }
    
    public function onCreateCompleted(GetProductResponseEvent $event)
    {
        $this->addSuccessFlash($event);
    }

    protected function addSuccessFlash(Event $event, array $parameters = array())
    {
        $eventName = $event->getName();
        if (!isset(self::$successMessages[$eventName])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()->add('success', $this->translator->trans(self::$successMessages[$event->getName()], $parameters, 'notifications'));
    }
}
