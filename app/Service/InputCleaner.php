<?php

namespace App\Service;

/**
 * Class Reference
 * @package App\Service
 */
class InputCleaner
{
    /*
     * Method to strip tags globally.
     */
    public function cleanData(array $data)
    {
        return $this->arrayStripTags($data);
    }

    /**
     * @param array $array
     * @return array
     */
    public function arrayStripTags(array $array)
    {
        $result = [];

        foreach ($array as $key => $value) {
            $key = strip_tags($key);

            if (is_array($value)) {
                $result[$key] = $this->arrayStripTags($value);
            } else {
                $result[$key] = trim(strip_tags($value));
            }
        }

        return $result;
    }
}