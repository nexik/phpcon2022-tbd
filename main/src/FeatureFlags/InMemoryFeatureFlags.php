<?php
namespace Tbd\Main\FeatureFlags;

class InMemoryFeatureFlags implements FeatureFlagsInterface
{
    private array $flags = [];

    public function __construct(array $flags = []){
        $this->flags = $flags;
    }

    public function setEnabled(string $flag, bool $enabled = true) : void
    {
        $this->flags[$flag] = $enabled;
    }

    public function isEnabled(string $flag) : bool
    {
        return $this->flags[$flag] ?? false;
    }
}
