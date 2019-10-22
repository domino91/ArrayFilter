<?php

class MirrorCleaner
{
    private $carsArray = [];

    public function __construct(array $carsArray)
    {
        $this->carsArray = $carsArray;
    }

    public function cleanMirror()
    {
        $newCarsArray = [];

        foreach ($this->carsArray as $value) {
            $accessoriesArray = $value['accessories'] ?? [];
            $newCarsArray[]['accessories'] = $this->parserAccessories($accessoriesArray);
        }

        return $newCarsArray;
    }

    private function parserAccessories(array $accessoriesArray)
    {
        $newAccessoriesArray = [];

        foreach ($accessoriesArray as $value) {
            $cockpitsArray = $value['cockpit'] ?? [];
            $newAccessoriesArray[]['cockpit'] = $this->parserCockpits($cockpitsArray);
        }

        return $newAccessoriesArray;
    }

    private function parserCockpits(array $cockpitsArray)
    {
        $newCockpitsArray = [];

        foreach ($cockpitsArray as $element) {
            $newCockpitsArray[] = $this->removeMirror($element);
        }

        return $newCockpitsArray;
    }

    private function removeMirror(array $value)
    {
        return array_filter($value, function ($key) {
            return !($key == 'mirror');
        }, ARRAY_FILTER_USE_KEY);
    }
}