<?php

namespace Aldoggutierrez\EloquentStates\Models;

use Closure;
use UnitEnum;

class State
{
    protected string $name;

    protected array $validations;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function transitionToIf(UnitEnum|string $state, Closure|bool $validation): self
    {
        if ($state instanceof UnitEnum) {
            $state = $state->value;
        }
        $this->validations[$state] = $validation;

        return $this;
    }

    public function transitionTo(UnitEnum|string $state): self
    {
        return $this->transitionToIf($state, true);
    }

    public function canTransitionTo(UnitEnum|string $state)
    {
        if ($state instanceof UnitEnum) {
            $state = $state->value;
        }
        if (array_key_exists($state, $this->validations)) {
            return $this->validations[$state] instanceof Closure ? $this->validations[$state]() : $this->validations[$state];
        }

        return false;
    }
}
