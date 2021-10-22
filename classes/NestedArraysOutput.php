<?php
namespace classes;

class NestedArraysOutput
{
    private array $nestedArr;
    private string $output = '';
    private array $sortingKeys = ['last_name', 'account_id'];

    public function __construct(array $nestedArr)
    {
        $this->nestedArr = $nestedArr;
    }

    public function print()
    {
        $this->iterateArrForOutput($this->nestedArr);

        echo $this->output;
    }

    /**
     * sorting array by keys (task 2)
     */
    public function sortByKeys()
    {
        $valesForSorting = [];
        foreach ($this->nestedArr as $key => $value) {
            $valesForSorting[$key] = $this->findSortingFields($value);
        }

        foreach($this->sortingKeys as $sortingKey){
            $a = array_column($valesForSorting, $sortingKey);
            array_multisort(
                $a,
                SORT_ASC,
                SORT_NATURAL,
                $this->nestedArr,
                $valesForSorting
            );
        }
    }

    /**
     * preparing values for sorting array by predefined fields
     * @param array $nestedArr
     * @return array
     */
    private function findSortingFields(array $nestedArr): array
    {
        $valuesForSorting = [];

        foreach($nestedArr as $key => $value) {
            if (array_search($key, $this->sortingKeys, true ) !== false) {
                $valuesForSorting[$key] = $value;
            } else {
                if (is_array($value)) {
                    $valuesForSorting = array_merge($this->findSortingFields($value), $valuesForSorting);
                }
            }
        }
        return $valuesForSorting;
    }

    /**
     * The main method for task 1
     * @param $nestedArr
     * @param int $offsetLength
     */
    private function iterateArrForOutput($nestedArr, $offsetLength = 0)
    {
        foreach($nestedArr as $key => $value) {
            $key = is_numeric($key) ? ++$key : $key; //just for having the first key in a list as '1'
            $offset = str_repeat(' ', $offsetLength);

            if (is_array($value)) {
                $this->output .= $offset . $key . ':' . PHP_EOL;
                $this->iterateArrForOutput($value, strlen($offset . $key));
            } else {
                $this->output .= $offset . $key . ' - ' . $this->toStringByType($value) . ';' .PHP_EOL;
            }
        }
    }

    /**
     * It is here just because '1' or '0' looks not so good :)
     * @param $value
     * @return string
     */
    private function toStringByType($value)
    {
        if (is_bool($value)) {
            return $value ? 'yes' : 'no';
        }

        return $value;
    }
}
