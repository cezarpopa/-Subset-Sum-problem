# Partition Problem

## Problem Description

The code in this file attempts to solve a version of the partition problem - a classic problem in computer science. The problem is defined as follows: "Can a given set of integers be divided into two subsets such that the sum of the elements in both subsets is equal?"

The process of the algorithm is as follows:

1. It first checks for a few scenarios where partition would not be possible:
    * If the list contains duplicate values.
    * If the sum of the list is an odd number.
    * If any value in the array is not an integer.

2. If no such cases are present, the function proceeds to utilize a form of the Subset Sum Problem's dynamic programming approach to address the Partition Problem.

3. The dynamic programming function `canSumBeFoundInSubsets` checks whether a subset in the array sums up to half of the total array sum.

4. It evaluates each subset of the array to reach this conclusion:
    * If the target sum is 0, it returns true, implying a subset has been found summing up to half of the array sum.
    * If no more elements are left in the subset, but the target sum hasn't been reached yet, it returns false.
    * If the sum of elements in any given subset exceeds the target sum, we understand that the last addition made the sum exceed the target; hence, we can ignore this and continue.
    * It repeats these steps by including or excluding elements until a sum matches the desired half sum.

5. If the function identifies such a subset, meaning the array can indeed be partitioned into two subsets of equal sums, it returns a '1'. If not, it returns a '-1'.

This algorithm is commonly used in computer science to solve optimization problems and is often useful in resource allocation scenarios.
