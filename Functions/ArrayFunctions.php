<?php

namespace Functions;

final class ArrayFunctions
{
    /**
     * Felállítja a tömböt id => név formában
     * 
     * @param array $array
     * 
     * @return array
     */
    public static function flatArray(array $array): array
    {
        $returnArray = [];
        foreach ($array as $data) {
            if (array_key_exists('id', $data) && array_key_exists('name', $data)) {
                $returnArray[$data['id']] = $data['name'];
            }
        }
        
        return !empty($returnArray) ? $returnArray : $array;
    }

    /**
     * Felállítja a tömböt azonosító alapján
     * 
     * @param array $array
     * 
     * @return array
     */
    public static function indexedArray(array $array): array
    {
        $returnArray = [];
        foreach ($array as $data) {
            if (array_key_exists('id', $data)) {
                $returnArray[$data['id']] = $data;
            }
        }

        return !empty($returnArray) ? $returnArray : $array;
    }

    /**
     * Felállítja a tömböt egy tömbelem alapján alapján
     * 
     * @param array $array
     * 
     * @return array
     */
    public static function elementArray(array $array, string $element = 'id'): array
    {
        $returnArray = [];
        foreach ($array as $data) {
            if (array_key_exists($element, $data)) {
                $returnArray[$data[$element]] = $data;
            }
        }

        return !empty($returnArray) ? $returnArray : $array;
    }
}