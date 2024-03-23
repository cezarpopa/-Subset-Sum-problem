<?php

declare(strict_types=1);

namespace Cezarpopa\Untitled1;

class PartitionArray
{

    public function __invoke(array $integerArray): string
    {
        /**
         * Ensure we have only valid integers
         */
        if ($this->arrayContainsNonIntegers($integerArray)) {
            return '-1';
        }

        /**
         * If the array sum is an odd value we can't partition that properly
         */
        if ($this->arrayIsOdd($integerArray)) {
            return '-1';
        }

        /**
         * No duplicate values for now
         */
        if ($this->hasDuplicates($integerArray)) {
            return '-1';
        }

        $arraySize = count($integerArray);
        $arraySum  = array_sum($integerArray);
        $partitionSize = $arraySum / 2;

        if (is_float($arraySum) || is_float($partitionSize)) {
            return '-1';
        }

        // Find if there is subset with sum equal to half of total sum
        return $this->canSumBeFoundInSubsets($integerArray, $arraySize, $partitionSize) ? '1' : '-1';
    }

    /**
     * Determines whether a subset of the given numbers can be found that sums up to the desired sum.
     *
     * @param array $integerArray    The array of numbers.
     * @param int   $numberOfElements The number of elements to consider in the subset.
     * @param int   $desiredSum       The desired sum to be found.
     *
     * @return bool Returns true if a subset is found, false otherwise.
     */
    public function canSumBeFoundInSubsets(array $integerArray, int $numberOfElements, int $desiredSum): bool
    {
        // This is the base case for the recursion: if the desired sum has reached 0, then a valid subset has been found,
        // so we return true.
        if ($desiredSum === 0) {
            return true;
        }

        // This is another base case: if there are no elements left in the 'integerArray' but the desired sum hasn't reached
        // 0 (it isn't found yet), we return false indicating that the current combination does not result in the desired sum.
        if ($numberOfElements === 0 && $desiredSum !== 0) {
            return false;
        }

        // This condition checks if the last element is greater than the desired sum; if so, this element cannot be a part
        // of the solution (subset), thus we ignore it and move forward with the next elements, reducing the number of
        // elements by one.
        if ($integerArray[$numberOfElements - 1] > $desiredSum) {
            return $this->canSumBeFoundInSubsets(
                $integerArray,
                $numberOfElements - 1,
                $desiredSum
            );
        }

        // 'includeLastElement': We check whether the solution exists when including the last element in the sum. We do this
        // by calling the function recursively while reducing the number of elements by one (ignoring the last element).
        $includeLastElement = $this->canSumBeFoundInSubsets(
            $integerArray,
            $numberOfElements - 1,
            $desiredSum
        );

        // 'excludeLastElement': We check whether the solution exists when excluding the last element from the sum. We
        // subtract the value of the last element from the desired sum and call the function recursively with this new sum,
        // while also reducing the number of elements by one.
        $excludeLastElement = $this->canSumBeFoundInSubsets(
            $integerArray,
            $numberOfElements - 1,
            $desiredSum - $integerArray[$numberOfElements - 1]
        );

        // There exists a solution (a subset sum equal to the desired sum) if either a solution exists when including the
        // last element ('includeLastElement' is true) or when excluding the last element ('excludeLastElement' is true).
        return $includeLastElement || $excludeLastElement;
    }

    public function hasDuplicates(array $input_array): bool
    {
        return count($input_array) !== count(array_flip($input_array));
    }

    public function arrayIsOdd(array $listOfIntegers): bool
    {
        return count($listOfIntegers) % 2 !== 0;
    }

    public function arrayContainsNonIntegers(array $listOfIntegers): bool
    {
        if (empty($listOfIntegers)) {
            return true;
        }

        $mappedArray = array_map([$this, 'isValidInteger'], $listOfIntegers);
        if (in_array(false, $mappedArray, true)) {
            return true;
        }

        return false;
    }

    public function isValidInteger(mixed $value): bool
    {
        return is_int($value);
    }
}
