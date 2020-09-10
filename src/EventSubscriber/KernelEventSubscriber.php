<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\EventSubscriber;

use Passioneight\Bundle\PimcoreFormsBundle\Constant\Configuration as Config;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class KernelEventSubscriber implements EventSubscriberInterface
{
    /** @var ParameterBagInterface $parameterBag */
    private $parameterBag;

    /** @var ContainerInterface $container */
    private $container;

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => "onKernelRequest"
        ];
    }

    /**
     * KernelEventSubscriber constructor.
     * @param ParameterBagInterface $parameterBag
     * @param ContainerInterface $container
     */
    public function __construct(ParameterBagInterface $parameterBag, ContainerInterface $container)
    {
        $this->parameterBag = $parameterBag;
        $this->container = $container;
    }

    /**
     * Sets any needed values for the form classes.
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event)
    {
        if($event->isMasterRequest() && !$event->getRequest()->isXmlHttpRequest()) {
            $config = $this->parameterBag->get(Config::ROOT) ?: [];

            $labelFormat = @$config[Config::FORM_FIELD][Config::FORM_FIELD_LABEL_FORMAT];
            FormField::setDefaultLabelFormat($labelFormat);
        }
    }
}
