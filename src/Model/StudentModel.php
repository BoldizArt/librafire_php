<?php
/**
 * @file contains Boldizar\LibraFire\Model\StudentModel;
 */
namespace Boldizar\LibraFire\Model;

use Boldizar\LibraFire\Model\Model;

class StudentModel extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $grades; // JSON
    public $scool_board;

    /** @var string TABLE_NAME */
    const TABLE_NAME = 'student';
}