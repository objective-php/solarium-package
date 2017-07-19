<?php

namespace ObjectivePHP\Package\Solarium\Middleware;


use Fei\Gateway\Config\SolrClient;
use ObjectivePHP\Application\ApplicationInterface;
use ObjectivePHP\Application\Middleware\AbstractMiddleware;
use Solarium\Client;

class SolariumInitializer extends AbstractMiddleware
{
    public function run(ApplicationInterface $app)
    {
        $config = $app->getConfig()->subset(SolrClient::class);
        
        
        foreach($config as $instance => $params) {
            $serviceId = 'solr.client.' . $instance;
            
            $config = [
                'endpoint' => [
                    $instance => [
                        'host' => $params['host'],
                        'port' => $params['port'],
                        'path' => rtrim($params['base-path'], '/') . '/' . $params['core']
                    ]
                ]
            ];
            
            $app->getServicesFactory()->registerService(['id' => $serviceId, 'class' => Client::class, 'params' => [$config]]);
        }
       
        
    }
    
}
