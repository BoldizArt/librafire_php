<?php
/**
 * @file Contains Boldizar\LibraFire\Interfaces\StudentInterface;
 */
namespace Boldizar\LibraFire\Interfaces;

/**
 * StudentInterface Interface
 */
interface StudentInterface
{
    /**
     * Class constructor
     */
    public function __construct(int $id);

    /**
     * Calculate the avrage
     */
    public function calculateAvrage();
    
    
    /**
     * Calculate the final result
     */
    public function calculateFinalResult();
    
    /**
     * Render the report
     */
    public function render();
}


