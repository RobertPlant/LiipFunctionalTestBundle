<?php

/*
 * This file is part of the Liip/FunctionalTestBundle
 *
 * (c) Lukas Kahwe Smith <smith@pooteeweet.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\FunctionalTestBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Client;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\ClassLoader\DebugClassLoader;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\ProxyReferenceRepository;

use Doctrine\DBAL\Driver\PDOSqlite\Driver as SqliteDriver;

use Doctrine\ORM\Tools\SchemaTool;

use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader as DataFixturesLoader;
use Symfony\Bundle\DoctrineFixturesBundle\Common\DataFixtures\Loader as SymfonyFixturesLoader;
use Doctrine\Bundle\FixturesBundle\Common\DataFixtures\Loader as DoctrineFixturesLoader;

/**
 * @author Robert Plant <robertplant.io>
 */
abstract class DatabaseTestCase extends WebTestCase
{
    protected function getConnection()
    {
        $pdo = new PDO('sqlite::memory');
        return $this->createDefaultDBConnection($pdo, 'testdb');
    }

    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/src/Ingot/SteelBundle/Tests/_fixtures/seedStockDatabase.xml');
    }
}