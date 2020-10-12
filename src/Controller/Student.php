<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Student;
 */
namespace Boldizar\LibraFire\Controller;

/**
 * Student Class
 */
class Student {

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