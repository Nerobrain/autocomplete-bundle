<?php

namespace MakinaCorpus\Autocomplete\Tests\Bundle;

use MakinaCorpus\Autocomplete\Bundle\AutocompleteBundle;
use MakinaCorpus\Autocomplete\Bundle\DependencyInjection\AutocompleteExtension;
use MakinaCorpus\Autocomplete\Tests\Mock\MockAutocompleteSource;
use MakinaCorpus\Autocomplete\Tests\Mock\MockAutocompleteSourceWithTemplateEngine;
use MakinaCorpus\Autocomplete\Tests\Mock\MockUrlGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class ExtensionTest extends TestCase
{
    public function testServicesRegistration()
    {
        $container  = new ContainerBuilder();
        $container->addDefinitions([
            'router' => new Definition(MockUrlGenerator::class),
            'source_1' => (new Definition(MockAutocompleteSourceWithTemplateEngine::class))
                ->addTag('autocomplete.source'),
            'source_2' => (new Definition(MockAutocompleteSource::class))
                ->addTag('autocomplete.source'),
        ]);

        (new AutocompleteBundle())->build($container);
        (new AutocompleteExtension())->load(['autocomplete' => []], $container);
        $this->assertTrue(true);

        // Compile, and ensure services are there
        $container->compile();
    }
}
