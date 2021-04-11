<?php

declare(strict_types=1);

namespace App\Kato\StaticAnalyse;


class InvalidClassDesign
{
    private int $value;     // should be invalid type

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return array<int>
     */
    function takesAnInt(int $i): array
    {
        return [$i];
    }

    public function bar(): void
    {

    }

    public function sayHello(): string
    {
        return 'hello';
    }

    public function foo(): void
    {
        $this->bar();
    }
}