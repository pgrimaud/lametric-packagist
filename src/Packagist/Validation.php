<?php

declare(strict_types=1);

namespace Packagist;

class Validation
{
    /**
     * @var array
     */
    private array $parameters = [
        'package',
        'period',
    ];

    /**
     * @var array
     */
    private array $period = [
        'total',
        'monthly',
        'daily',
    ];

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function __construct(array $parameters = [])
    {
        foreach ($this->parameters as $name) {
            if (empty($parameters[$name])) {
                throw new \Exception('Missing parameter');
            }

            if ($name == 'period' && !in_array($parameters[$name], $this->period)) {
                throw new \InvalidArgumentException('Invalid period');
            }

            $this->parameters[$name] = addslashes(urldecode($parameters[$name]));
        }
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}