<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @copyright Copyright Webiny LTD
 */

namespace Webiny\Component\Config\Tests;


use Webiny\Component\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testYamlConfig()
    {
        $yamlConfig = realpath(__DIR__ . '/Configs/config.yaml');
        $config = Config::getInstance()->yaml($yamlConfig);
        $this->assertInstanceOf('\Webiny\Component\Config\ConfigObject', $config);
        $this->assertEquals('Royal Oak', $config->get('bill-to.address.city'));
    }

    public function testJsonConfig()
    {
        $jsonConfig = realpath(__DIR__ . '/Configs/config.json');
        $config = Config::getInstance()->json($jsonConfig);
        $this->assertInstanceOf('\Webiny\Component\Config\ConfigObject', $config);
        $this->assertEquals('Webiny', $config->get('website.name'));
    }

    public function testMissingFile()
    {
        $this->setExpectedException('\Webiny\Component\Config\ConfigException');
        $jsonConfig = realpath(__DIR__ . '/Configs/configMissing.json');
        Config::getInstance()->json($jsonConfig);
    }

    public function testPhpConfig()
    {
        $phpConfig = realpath(__DIR__ . '/Configs/config.php');
        $config = Config::getInstance()->php($phpConfig);
        $this->assertInstanceOf('\Webiny\Component\Config\ConfigObject', $config);
        $this->assertEquals('www.webiny.com', $config->get('default.url'));
    }

    public function testIniConfig()
    {
        $iniConfig = realpath(__DIR__ . '/Configs/config.ini');
        $config = Config::getInstance()->ini($iniConfig);
        $this->assertInstanceOf('\Webiny\Component\Config\ConfigObject', $config);
        $this->assertEquals('coolProperty', $config->group2->newProperty);
    }

    public function testParseResource()
    {
        $resource = ['application' => 'development'];
        $config = Config::getInstance()->parseResource($resource);
        $this->assertInstanceOf('\Webiny\Component\Config\ConfigObject', $config);
        $this->assertEquals('development', $config->application);
    }
}