<?php

namespace MakinaCorpus\Autocomplete\Tests\Mock;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MockUrlGenerator implements UrlGeneratorInterface
{
    private $context;

    public function setContext(RequestContext $context)
    {
        $this->context = $context;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        return \strtr($name, $parameters);
    }
}
