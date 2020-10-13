<?php

namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\SchoolBoardInterface;

class Controller
{
    public function test(SchoolBoardInterface $student) {
        return $student->report();
    }
}