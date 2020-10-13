<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Student;
 */
namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\StudentInterface;
use Boldizar\LibraFire\Model\StudentModel;

/**
 * Student Class
 */
class Student implements StudentInterface
{
    /** @var Boldizar\LibraFire\Model\StudentModel $student; */
    public $student;

    /**
     * Class constructor
     * @param int $id;
     */
    public function __construct(int $id)
    {
        /**
         * @todo
         * $student = StudentModel::fetch($id);
         */
        $this->student = (object) [
            'id' => $id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'schoolboard' => $id == 1 ? 'csm' : 'csmb',
            'grades' => (object) [
                'a' => 4,
                'b' => 8,
                'c' => 9,
                'd' => 10
            ]
        ];
    }

    /**
     * Calculate the avrage
     */
    public function calculateAvrage()
    {
        $this->student->avrage = 7.8;
    }


    /**
     * Calculate the final result
     */
    public function calculateFinalResult()
    {
        $this->student->final_result = 'passed';
    }

    /**
     * Render the report
     */
    public function render()
    {
        switch ($this->student->schoolboard) {
            case 'csm':
                $csm = new Csm($this->student);
                break;

            case 'csmb':
                $csm = new CsmB($this->student);
                break;
            
            default:
                # code...
                break;
        }

        $controller = new Controller();
        $controller->test($csm);
    }
}