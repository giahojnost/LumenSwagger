<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

class CommandsTest extends LumenTestCase {
    public function setUp(): void {
        parent::setUp();
        $this->app->prepareForConsoleCommand();
        $this->setPaths();
    }
    
    /** @test */
    public function canGenerateJsonDocumentation() {
        Artisan::call('lumen-swagger:generate');
        $this->assertFileExists($this->jsonDocsFile());
        $fileContent = file_get_contents($this->jsonDocsFile());
        $this->assertJson($fileContent);
        $this->assertStringContainsString('LumenSwagger', $fileContent);
        //Check if constants are replaced
        $this->assertStringContainsString('http://my-default-host.com', $fileContent);
        $this->assertStringNotContainsString('SWAGGER_LUME_CONST_HOST', $fileContent);
    }
    
    /** @test */
    public function canPublishAssets() {
        $this->setPaths();
        Artisan::call('lumen-swagger:publish');
        $config_src = __DIR__ . '/../config/lumen-swagger.php';
        $config_published = __DIR__ . '/config/lumen-swagger.php';
        $view_src = __DIR__ . '/../resources/views/index.blade.php';
        $view_published = __DIR__ . '/resources/views/vendor/lumen-swagger/index.blade.php';
        $this->assertTrue(file_exists($config_published));
        $this->assertTrue(file_exists($view_published));
        $this->assertEquals(
            file_get_contents($config_src),
            file_get_contents($config_published)
        );
        $this->assertEquals(
            file_get_contents($view_src),
            file_get_contents($view_published)
        );
    }
}
