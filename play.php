<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
//if (isset($_SERVER['HTTP_CLIENT_IP'])
//    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
//    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
//) {
//    header('HTTP/1.0 403 Forbidden');
//    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
//}

$loader = require_once __DIR__.'/var/bootstrap.php.cache';
$loader = require_once __DIR__.'/vendor/autoload.php';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();


$container =$kernel->getContainer();
$container->set('request',$request);

$templating = $container->get('twig');

//echo $templating->render('adminAddCompanies/index.html.twig');


use AdminBundle\Entity\AdminEntity;
use CompanyBundle\Entity\CompanyEntity;

$adminEvent = new AdminEntity();

$adminEvent->setEmail('felipe.modena@f.com');
$adminEvent->setName('Felipe');
$adminEvent->setPassword('senha');
$adminEvent->setPhone('11976410078');

$companyEvent = new CompanyEntity();
$companyEvent->setPhone('14976410078');
$companyEvent->setName('Empresa LTDA');
$companyEvent->setAddress('Rua tal');
$companyEvent->setCity('Bauru');
$companyEvent->setCategory('Categoraia');
$companyEvent->setCode('10930000');
$companyEvent->setState('SP');
$companyEvent->setDescription('Descricao');


$enviroment = $container->get('doctrine')->getManager();


$enviroment->persist($companyEvent);
$enviroment->persist($adminEvent);
$enviroment->flush();
