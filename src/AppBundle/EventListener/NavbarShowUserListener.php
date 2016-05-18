<?php

/*
 * This file is part of sedona-sbo Demo.
 *
 * (c) Sedona <http://www.sedona.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Observe;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @package Sedona\SBOTestBundle
 * @Service("showuser.listener")
 */
class NavbarShowUserListener
{

    protected $security_context;

    /**
     * @InjectParams({
        "security_context": @Inject("security.context")
     * })
     * @param $security_context
     */
    public function __construct(SecurityContext $security_context)
    {
        $this->security_context = $security_context;
    }

    /**
     * @Observe("theme.navbar_user")
     * //Observe("theme.sidebar_user")
     * @param ShowUserEvent $event
     */
    public function onShowUser(ShowUserEvent $event)
    {
        $event->setUser($this->getUser());
    }

    protected function getUser()
    {
        return $this->security_context->getToken()->getUser();
    }


}
