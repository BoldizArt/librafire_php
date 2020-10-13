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
     * Render the report
     */
    public function render();
}
