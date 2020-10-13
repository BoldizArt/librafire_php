<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\CsmB;
 */
namespace Boldizar\LibraFire\Controller;

use Boldizar\LibraFire\Interfaces\SchoolBoardInterface;
use SimpleXMLElement;

/**
 * CsmB Class
 * 
 * @todo
 * 
 * 
 * Returns XML format
 */
class CsmB implements SchoolBoardInterface
{
    /** @param Object $student; */
    public $student;

    /**
     * Class constructor
     * @param Object $student;
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Calculate the average
     * Discards the lowest grade, if the student have more than 2 grades
     */
    public function calculateAverage()
    {
        $grades = array_values((array) $this->student->grades);
        
        // Sort the values
        sort($grades, SORT_NUMERIC);

        // Calculate the number of items in the array
        $count = count($grades);

        // If there is more than one, remove the lowest value
        if ($count > 1) {
            array_shift($grades);
            $count--;
        }

        // Get the sum of values
        $sum = array_sum($grades);

        // Calculate the average
        $this->student->average = $sum / $count;
    }

    /**
     * Calculate the final result
     * Students pass if the average grade of the grades is bigger than 8
     * Otherwise fail
     */
    public function calculateFinalResult()
    {
        if (!isset($this->student->average)) {
            $this->calculateAverage();
        }

        // Calculate if the student is passed or not
        $pass = $this->student->average > 8;
        $this->student->final_result = $pass ? 'passed' : 'failed';
    }

    /**
     * Return the report in XML format
     */
    public function report()
    {
        // Creating object of SimpleXMLElement
        $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->toXml($this->student, $xml);

        header('Content-Type: application/xml');
        print $xml->asXML();
    }

    /**
     * Convert array/object to XML
     */
    public function toXml($data, &$xml)
    {
        foreach ($data as $key => $value) {
            if (\is_array($value) || \is_object($value)) {
                if (is_numeric($key)) {
                    $key = 'item'.$key;
                }
                $subnode = $xml->addChild($key);
                $this->toXml($value, $subnode);
            } else {
                $xml->addChild("{$key}", htmlspecialchars("{$value}"));
            }
        }
    }
}