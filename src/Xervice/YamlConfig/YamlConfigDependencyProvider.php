<?php
declare(strict_types=1);


namespace Xervice\YamlConfig;


use Xervice\YamlConfig\Business\Hydrator\HydratorCollection;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class YamlConfigDependencyProvider extends AbstractProvider
{
    public const HYDRATOR_COLLECTION = 'hydrator.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container): void
    {
        $container[self::HYDRATOR_COLLECTION] = function () {
            return new HydratorCollection(
                $this->getHydratorList()
            );
        };
    }

    /**
     * @return \Xervice\YamlConfig\Business\Hydrator\HydratorInterface[]
     */
    protected function getHydratorList(): array
    {
        return [];
    }
}