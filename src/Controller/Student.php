<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Student;
 */
namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\SchoolBoardInterface;

/**
 * Student Class
 */
class Student implements SchoolBoardInterface
{

    /** @param int $id; */
    public $id;

    /**
     * Class constructor
     * @param int $id;
     */
    public function __construct(int $id) {
        $this->id = $id;

    }
    public function show() {
        echo "Student id: {$this->id}";
    }
}