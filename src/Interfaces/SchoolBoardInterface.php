<?php
/**
 * @file Contains Boldizar\LibraFire\Interfaces\SchoolBoardInterface;
 */
namespace Boldizar\LibraFire\Interfaces;

/**
 * SchoolBoardInterface Interface
 */
interface SchoolBoardInterface
{
    public function __construct(array $student);
    public function calculateAverage();
    public function calculateFinalResult();
    public function report();
}
