<?php

declare(strict_types=1);


class InvalidClassDesign
{
    private int $value;     // should be invalid type

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return array<string>
     */
    function takesAnInt(int $i) {
        return [$i, "hello"];
    }

    function foo()
    {
        return $this->bar();
    }
}