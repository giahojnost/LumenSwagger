<?php

namespace Tests;

use LumenSwagger\Generator;

class GeneratorTest extends LumenTestCase
{
    /** @test */
    public function canGenerateApiJsonFile()
    {
        $this->setPaths();

        Generator::generateDocs();

        $this->assertTrue(file_exists($this->jsonDocsFile()));

        $response = $this->get(config('lumen-swagger.routes.docs'));

        $this->assertResponseOk();

        $this->assertStringContainsString('LumenSwagger', $response->response->getContent());
        $this->assertStringContainsString('my-default-host.com', $response->response->getContent());
    }

    /** @test */
    public function canGenerateApiJsonFileWithChangedBasePath()
    {
        if ($this->isOpenApi() == true) {
            $this->markTestSkipped('only for openApi 2.0');
        }

        $this->setPaths();

        $cfg = config('lumen-swagger');
        $cfg['paths']['base'] = '/new_path/is/here';
        config(['lumen-swagger' => $cfg]);

        Generator::generateDocs();

        $this->assertTrue(file_exists($this->jsonDocsFile()));

        $response = $this->get(config('lumen-swagger.routes.docs'));

        $this->assertResponseOk();

        $this->assertStringContainsString('LumenSwagger', $response->response->getContent());
        $this->assertStringContainsString('new_path', $response->response->getContent());
    }

    /** @test */
    public function canSetProxy()
    {
        $this->setPaths();

        $cfg = config('lumen-swagger');
        $cfg['proxy'] = 'http://proxy.dev';
        config(['lumen-swagger' => $cfg]);

        $this->get(config('lumen-swagger.routes.api'));

        $this->assertResponseOk();

        $this->assertTrue(file_exists($this->jsonDocsFile()));
    }

    /** @test */
    public function canSetValidatorUrl()
    {
        $this->setPaths();

        $cfg = config('lumen-swagger');
        $cfg['validator_url'] = 'http://validator-url.dev';
        config(['lumen-swagger' => $cfg]);

        $response = $this->get(config('lumen-swagger.routes.api'));

        $this->assertResponseOk();

        $this->assertStringContainsString('validator-url.dev', $response->response->getContent());

        $this->assertTrue(file_exists($this->jsonDocsFile()));
    }
}
