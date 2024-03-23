<?php

use Cezarpopa\Untitled1\PartitionArray;
use PHPUnit\Framework\TestCase;

class PartitionArrayTest extends TestCase
{
    protected $arrayPartitioner;

    protected function setUp(): void
    {
        parent::setUp();
        $this->arrayPartitioner = new PartitionArray();
    }

    protected function tearDown(): void
    {
        $this->arrayPartitioner = null;
        parent::tearDown();
    }

    public function testArrayPartitionWithEmptyArrayReturnsMinusOne()
    {
        $divider = $this->arrayPartitioner;

        $this->assertEquals('-1', $divider([]));
    }

    public function testInvokeWithDupeValues()
    {
        $divider = $this->arrayPartitioner;

        $this->assertTrue($divider->hasDuplicates([1, 1]));
    }

    public function testInvokeWithoutDupeValues()
    {
        $divider = $this->arrayPartitioner;

        $this->assertFalse($divider->hasDuplicates([1, 2]));
    }

    public function testInvokeValidValue()
    {
        $divider = $this->arrayPartitioner;

        $this->assertEquals('-1', $divider([3, 1, 5, 9, 12]));
    }

    public function testInvokeValidValue2()
    {
        $divider = $this->arrayPartitioner;

        $this->assertEquals('1', $divider([1, 2, 3, 4]));
    }

    public function testInvokeValidValue3()
    {
        $divider = $this->arrayPartitioner;

        $this->assertEquals('1', $divider([16, 22, 35, 8, 20, 1, 21, 11]));
    }

    public function testInvokeValidValueFail()
    {
        $divider = $this->arrayPartitioner;

        $this->assertEquals('-1', $divider([1, 2, 3, 5]));
    }

    public function testInvokeInValidValue()
    {
        $divider = $this->arrayPartitioner;

        $this->assertEquals('-1', $divider([1, 2, 3]));
    }

    public function testCanSumBeFoundInSubsetsWithInvalidSubsets(): void
    {
        $divider = $this->arrayPartitioner;

        $array            = [5, 5, 15, 5, 25];
        $numberOfElements = count($array);
        $desiredSum       = array_sum($array) / 2;

        $actual = $divider->canSumBeFoundInSubsets($array, $numberOfElements, $desiredSum);

        $this->assertFalse($actual);
    }

    public function testCanSumBeFoundInSubsetsWithValidSubsets(): void
    {
        $divider = $this->arrayPartitioner;

        $array            = [3, 7, 1, 2, 8];
        $numberOfElements = count($array);
        $desiredSum       = array_sum($array) / 2;
        $actual           = $divider->canSumBeFoundInSubsets($array, $numberOfElements, $desiredSum);

        $this->assertTrue($actual);
    }

    public function testCanSumBeFoundInSubsetsWithEmptyArray(): void
    {
        $divider          = $this->arrayPartitioner;
        $array            = [];
        $numberOfElements = count($array);
        $desiredSum       = array_sum($array) / 2;
        $actual           = $divider->canSumBeFoundInSubsets($array, $numberOfElements, $desiredSum);

        $this->assertTrue($actual);
    }

    public function testArrayIsNotOdd()
    {
        $this->assertFalse($this->arrayPartitioner->arrayIsOdd([1, 2]));
    }

    public function testArrayIsOdd()
    {
        $this->assertTrue($this->arrayPartitioner->arrayIsOdd([1, 2, 3]));
    }

    public function testArrayIsUnhealthyFilled()
    {
        $this->assertFalse($this->arrayPartitioner->arrayContainsNonIntegers([1, 2, 3]));
    }

    public function testArrayIsUnhealthyEmpty()
    {
        $this->assertTrue($this->arrayPartitioner->arrayContainsNonIntegers([]));
    }

    public function testArrayIsUnhealthyMixed()
    {
        $this->assertTrue($this->arrayPartitioner->arrayContainsNonIntegers(['a', 1]));
    }

    public function testArrayIsUnhealthyFloats()
    {
        $this->assertTrue($this->arrayPartitioner->arrayContainsNonIntegers([1.2, 1.1]));
    }

    public function testIsIntegerPassed()
    {
        $result = $this->arrayPartitioner->isValidInteger(1);

        $this->assertTrue($result);
    }

    public function testIsIntegerFails()
    {
        $result = $this->arrayPartitioner->isValidInteger('1');

        $this->assertNotTrue($result);
    }

    public function testIsFoatFails()
    {
        $result = $this->arrayPartitioner->isValidInteger(1.1);

        $this->assertNotTrue($result);
    }
}
