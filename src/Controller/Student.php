<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Student;
 */
namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\StudentInterface;
use Boldizar\LibraFire\Interfaces\SchoolBoardInterface;
use Boldizar\LibraFire\Model\StudentModel;

/**
 * Student Class
 */
class Student implements StudentInterface
{
    /** @var Object $student; */
    public $student;

    /**
     * Class constructor
     * @param int $id;
     */
    public function __construct(int $id)
    {
        $model = new StudentModel();
        $this->student = $model->find($id);
        $this->student->grades = json_decode($this->student->grades);
    }

    /**
     * Render the report
     */
    public function render()
    {
        switch ($this->student->school_board) {
            case 'csm':
                $schoolBoard = new Csm($this->student);
                break;

            case 'csmb':
                $schoolBoard = new CsmB($this->student);
                break;
            
            default:
                $schoolBoard = false;
                break;
        }

        if ($schoolBoard instanceof SchoolBoardInterface) {
            $schoolBoard->calculateAverage();
            $schoolBoard->calculateFinalResult();
            $schoolBoard->report();
        }
    }
}