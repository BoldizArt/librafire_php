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
 * Discards the lowest grade, if the student have more than 2 grades
 * Students pass if the average grade of the grades is bigger than 8
 * Otherwise fail
 * Returns XML format
 */
class CsmB implements SchoolBoardInterface
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
        // Creating object of SimpleXMLElement
        $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->toXml($this->student, $xml);

        header('Content-Type: application/xml');
        print $xml->asXML();
    }

    // Convert array/object to XML
    public function toXml($data, &$xml) {
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