<?php

declare(strict_types=1);


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

    public function foo(): void
    {
        $this->bar();
    }
}