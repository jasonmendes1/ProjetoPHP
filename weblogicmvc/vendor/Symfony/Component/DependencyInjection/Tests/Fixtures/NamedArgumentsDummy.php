<?php

namespace Symfony\Component\DependencyInjection\Tests\Fixtures;

/**
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class NamedArgumentsDummy
{
    public function __construct(CaseSensitiveClass $c, $apiKey)
    {
    }

    public function setApiKey($apiKey)
    {
    }
}
