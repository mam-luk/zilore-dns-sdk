<?php
namespace Zilore\Api;

use Illuminate\Http\Client\Factory;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

/**
 * Zilore.com API Client
 */
class Client
{

    public string $apiKey;
    public Factory $http;
    public Logger $logger;
    public array $errors= [];
    public array $responses = [];
    public string $baseUrl = "https://api.zilore.com";

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->http = new Factory();
        $this->logger = new Logger('zilore');
        $this->logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));
    }
}