<?php

namespace Umanit\Bundle\TreeBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Arthur Guigand <aguigand@umanit.fr>
 */
class SonataMenuBuilderSubscriber implements EventSubscriberInterface
{
    /**
     * @var
     */
    private $menuEntityClass;

    /**
     * SonataMenuBuilderSubscriber constructor.
     *
     * @param string $menuEntityClass
     */
    public function __construct($menuEntityClass)
    {
        $this->menuEntityClass = $menuEntityClass;
    }

    public static function getSubscribedEvents()
    {
        return ['sonata.admin.event.configure.menu.sidebar' => 'addMenuItems'];
    }

    public function addMenuItems(Event $event)
    {
        if (!empty($this->menuEntityClass) &&
            method_exists($event, 'getMenu') &&
            get_class($event->getMenu()) === 'Knp\Menu\MenuItem'
        ) {

            /** @var \Knp\Menu\ItemInterface $menu */
            $menu = $event->getMenu();

            $menu->addChild('Menu', ['route' => 'tree_admin_menu_dashboard', 'extras' => ['icon' => '<i class="fa fa-bars"></i>']]);
        }
    }
}