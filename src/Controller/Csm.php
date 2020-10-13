<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Csm;
 */
namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\SchoolBoardInterface;

/**
 * Csm Class
 */
class Csm implements SchoolBoardInterface
{
    /** @param Object $student; */
    public $student;

    /**
     * Class constructor
     * @param Object $student;;
     */
    public function __construct($student) {
        $this->student = $student;
    }

    /**
     * Calculate the average
     */
    public function calculateAverage()
    {
        $grades = array_values((array) $this->student->grades);

        // Get the sum of values
        $sum = array_sum($grades);

        // Calculate the average
        $this->student->average = $sum/count($grades);
    }

    /**
     * Calculate the final result
     * Students pass if the average is bigger or equal to 7
     * Otherwise fail
     * 
     * @return string
     */
    public function calculateFinalResult()
    {
        if (!isset($this->student->average)) {
            $this->calculateAverage();
        }

        // Calculate if the student is passed or not
        $pass = $this->student->average >= 7;
        $this->student->final_result = $pass ? 'passed' : 'failed';
    }

    /**
     * Return the data in JSON format
     */
    public function report() {
        header('Content-Type: application/json');
        echo json_encode($this->student);
    }
}
