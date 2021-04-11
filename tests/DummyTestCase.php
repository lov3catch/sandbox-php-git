<?php

declare(strict_types=1);


class DummyTestCase extends \PHPUnit\Framework\TestCase
{
    public function testFoo(): void
    {
       self::assertEquals(1, 1);
    }
}