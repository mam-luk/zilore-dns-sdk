<?php

namespace Tests;
use Zilore\Api\Domains;
use PHPUnit\Framework\TestCase;

class DomainsTest extends TestCase
{
    private string $apiKey = '';
    private Domains $domains;
    public function setUp(): void
    {
        $this->domains = new Domains($this->apiKey);
    }

    public function testList()
    {
        $this->assertIsArray($this->domains->list());
    }

    public function testAdd()
    {
        $this->assertTrue($this->domains->add('some.meezaan.net'));
        $this->assertFalse($this->domains->add('some.meezaan.net'));
    }

    public function testDelete()
    {
        $this->assertTrue($this->domains->delete('some.meezaan.net'));
    }
}