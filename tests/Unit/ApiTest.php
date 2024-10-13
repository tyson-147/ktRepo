<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ApiTest extends TestCase
{
    public function testKurtosysApi()
    {
        $client = new Client();

        $one = microtime(1);

        $responseObject = $client->request('GET', 'https://kurtosys.com/');
        $this->assertEquals(200, $responseObject->getStatusCode());

        $two = microtime(1);

        $serverHeaderValue = '';

        foreach ($responseObject->getHeaders() as $name => $values) {
            if($name == 'Server') {
                $serverHeaderValue = $values[0];
                break;
            }
        }

        $this->assertEquals('cloudflare', $serverHeaderValue);

        try {
            $this->assertLessThan(2, $two - $one);
        }
        catch(\Exception $ex)
        {
            throw new \Exception($ex->getMessage());
        }

    }
}
