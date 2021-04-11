<?php

declare(strict_types=1);

class Character{
    public function __construct()
    {
    }
}

$character = new Character();
$character2 = new Character();

$storage = new SplObjectStorage();
$storage->attach($character);

$storage2 = new SplObjectStorage();
$storage2->attach($character);
$storage2->attach($character2);

$storage->addAll($storage2);


$fixedStorage = new SplFixedArray(5);
$fixedStorage[0] = 'foo';
$fixedStorage[1] = 'foo';
$fixedStorage[2] = 'foo';
$fixedStorage[3] = 'foo';
$fixedStorage[4] = 'foo';
$fixedStorage->setSize(2);
$fixedStorage->setSize(3);

echo spl_object_id($storage);
echo spl_object_id($storage2);

class Dashboard implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo 'update' . PHP_EOL;
    }
}

class Npc implements SplSubject
{
//    private ?SplObserver $observer = null;

    public function attach(SplObserver $observer)
    {
        $this->observer = $observer;
    }

    public function detach(SplObserver $observer)
    {
        $this->observer = null;
    }

    public function notify()
    {
        $this->observer->update($this);
    }
}

$dashboard = new Dashboard();

$npc1 = new Npc();
$npc1->attach($dashboard);
$npc1->notify();

$npc2 = new Npc();
$npc2->attach($dashboard);
$npc2->notify();
