<?php

namespace Soloist\Bundle\CalendarBundle\EventListener;

use Symfony\Component\HttpFoundation\Request;

use FrequenceWeb\Bundle\DashboardBundle\Menu\Event\Configure;

use Doctrine\ORM\EntityManager;

class DashboardListener
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    private $em;

    public function __construct(Request $request, EntityManager $em)
    {
        $this->request = $request;
        $this->em = $em;
    }

    public function onConfigureNewMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild('Catégorie', array(
            'route'     => 'tfhc_admin_category_new'
        ));
        $root->addChild('Produit', array(
            'route'     => 'tfhc_admin_product_new'
        ));
    }

    public function onConfigureTopMenu(Configure $event)
    {
        $nbOrders = $this->em->getRepository('TfhcSiteBundle:Order')->getNonClosedOrders();

        $root = $event->getRoot();
        $root->addChild('Catégories', array('route' => 'tfhc_admin_category_index'));
        $root->addChild('Produits', array('route' => 'tfhc_admin_product_index'));
        $root->addChild('Faq', array('route' => 'tfhc_admin_faq_index'));
        $root->addChild('Commandes (' . $nbOrders . ')', array('route' => 'sylius_sales_backend_order_list'));
        $root->addChild('Changer de langue (actuellement : '.$this->request->getLocale().')', array('route' => 'language_switch'));
    }
}
