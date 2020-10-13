<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Csm;
 */
namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\SchoolBoardInterface;

/**
 * Csm Class
 * 
 * @todo
 * Students pass if the average is bigger or equal to 7
 * Otherwise fail
 * Returns JSON format
 */
class Csm implements SchoolBoardInterface
{
    /** @param Boldizar\LibraFire\Model\Student $student; */
    public $student;

    /**
     * Class constructor
     * @param Boldizar\LibraFire\Model\Student $student;
     */
    public function __construct($student) {
        $this->student = $student;

    }
    public function report() {
        header('Content-Type: application/json');
        echo json_encode($this->student);

    }
}