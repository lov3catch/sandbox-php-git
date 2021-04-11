<?php

declare(strict_types=1);

namespace App\Kato\Psl;

require __DIR__ . '/../../../vendor/autoload.php';

use Psl\{Str, Vec};
use function Psl\Type\object;

function foo(iterable $codes): string
{
    $codes = Vec\filter_nulls($codes);

    $chars = Vec\map($codes, fn(int $code): string => Str\chr($code));

    return Str\join($chars, ', ');
}

class Predicate1
{
    public function __invoke(string $value)
    {
        return $value . '_success' . PHP_EOL;
    }
}

class Predicate2
{
    public function __invoke(string $value)
    {
        return $value . '_error' . PHP_EOL;
    }
}

$predicate1 = static function (string $value) {
    return $value . '_success' . PHP_EOL;
};

$predicate2 = static function (string $value) {
    return $value . '_error' . PHP_EOL;
};

function predicator(string $value, callable $prdct): string
{
    return $prdct($value);
}

echo predicator('foo', $predicate1);
echo predicator('foo', $predicate2);
echo predicator('foo', new Predicate1());
echo predicator('foo', new Predicate2());

// --------------------------------------------

class PartA
{
    public function __invoke(int $value)
    {
        return $value > 100
            ? new PartB()
            : new PartC();
    }
}

class PartB
{
    public function __invoke(int $value)
    {
        return __CLASS__;
    }
}

class PartC
{
    public function __invoke(int $value)
    {
        return __CLASS__;
    }
}

$result = (new PartA())(101)(1);
var_dump($result);

// -------

class NpcWithLevel
{
    public int $level;

    public function __construct(int $level)
    {
        $this->level = $level;
    }
}

class NpcMinHeap extends \SplMinHeap
{
    /**
     * @param NpcWithLevel $value1
     * @param NpcWithLevel $value2
     * @return int
     */
    protected function compare($value1, $value2)
    {
        return $value2->level - $value1->level;
    }
}

$heapLvl = new NpcMinHeap();
$heapLvl->insert(new NpcWithLevel(3));
$heapLvl->insert(new NpcWithLevel(5));
$heapLvl->insert(new NpcWithLevel(1));

//var_dump($heapLvl->top());die;

// -------
class NpcStorage extends \SplObjectStorage
{
    /**
     * @param NpcWithLevel $object
     * @return bool|void
     */
    public function contains($object)
    {
        /**
         * @var NpcWithLevel $obj
         * @var NpcWithLevel $object
         */
        foreach ($this as $obj) {
            if ($obj->level === $object->level) {
                return true;
            }
        }

        return false;
    }
}

$npcStorage = new NpcStorage();
$npcStorage->attach(new NpcWithLevel(1));
$npcStorage->attach(new NpcWithLevel(2));
$npcStorage->attach(new NpcWithLevel(3));

$exists = $npcStorage->contains(new NpcWithLevel(4));
var_dump($exists);
