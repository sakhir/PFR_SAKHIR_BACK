<?php

namespace ContainerW91vXQc;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserHelperService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Helper\UserHelper' shared autowired service.
     *
     * @return \App\Helper\UserHelper
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Helper/UserHelper.php';

        return $container->privates['App\\Helper\\UserHelper'] = new \App\Helper\UserHelper(($container->services['doctrine.orm.default_entity_manager'] ?? $container->getDoctrine_Orm_DefaultEntityManagerService()), ($container->services['security.password_encoder'] ?? $container->load('getSecurity_PasswordEncoderService')));
    }
}
