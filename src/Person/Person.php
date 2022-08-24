<?php
namespace GeekBrains\LevelTwo\Person;

use \DateTimeImmutable;

class Person
{
    private int $id;
    private Name $name;
    private DateTimeImmutable $registeredOn;

    public function __construct(int $id, Name $name, DateTimeImmutable $registeredOn) {
        $this->id = $id;
        $this->registeredOn = $registeredOn;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->name . ' (на сайте с ' . $this->registeredOn->format('Y-m-d') . ')';
    }
}