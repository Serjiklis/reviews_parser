<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Domain\User\UserRepository;
use App\Domain\Infrastructure\WordsRepository\IWordsRepository;
use App\Domain\Infrastructure\WordsRepository\WordsRepositoryHardcoded;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        IWordsRepository::class => function (ContainerInterface $c) 
        {
            $settings = $c->get(SettingsInterface::class);
            return new WordsRepositoryHardcoded();
        }
    ]);
};
