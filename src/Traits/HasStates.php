<?php

namespace Aldoggutierrez\EloquentStates\Traits;

use Aldoggutierrez\EloquentStates\Events\StateChanged;
use Aldoggutierrez\EloquentStates\Models\State;
use UnitEnum;

trait HasStates
{
    /** @var State[] */
    protected array $states = [];

    public function initializeHasStates(): void
    {
        $this->registerStates();
    }

    public function addState(UnitEnum|string $state): State
    {
        if ($state instanceof UnitEnum) {
            $state = $state->value;
        }

        $this->states[$state] = new State($state);

        return $this->states[$state];
    }

    public function getStates(): array
    {
        return $this->states;
    }

    public function transitionTo(UnitEnum|string $state)
    {
        if ($state instanceof UnitEnum) {
            $state = $state->value;
        }
        $currentState = $this->{$this->stateProperty ?? 'state'};
        if (! isset($currentState) || ! array_key_exists($currentState, $this->states) || ! $this->states[$currentState]->canTransitionTo($state)) {
            abort(403, "$currentState state cannot be transitioned to $state state");
        }
        $this->{$this->stateProperty ?? 'state'} = $state;
        $saved = $this->saveQuietly();

        if ($saved) {
            StateChanged::dispatch();
        }

        return $saved;
    }

    public function registerStates(): void {}
}
