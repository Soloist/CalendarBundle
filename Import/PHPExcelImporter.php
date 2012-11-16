<?php

namespace Soloist\Bundle\CalendarBundle\Import;

use Doctrine\ORM\EntityManager;
use Soloist\Bundle\CalendarBundle\Entity\Calendar;
use Soloist\Bundle\CalendarBundle\Entity\Event;

/**
 * PHPExcel event importer
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class PHPExcelImporter
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param EntityManager $em
     * @param array         $config
     */
    public function __construct(EntityManager $em, array $config)
    {
        $this->em     = $em;
        $this->config = $config;
    }

    /**
     * @param Calendar $calendar
     * @param string   $filename
     */
    public function import(Calendar $calendar, $filename)
    {
        $this->load($calendar, \PHPExcel_IOFactory::load($filename)->getActiveSheet());
    }

    /**
     * @param Calendar            $calendar
     * @param \PHPExcel_Worksheet $sheet
     */
    protected function load(Calendar $calendar, \PHPExcel_Worksheet $sheet)
    {
        foreach ($sheet->getRowIterator(2) as $row) {
            $this->loadRow($calendar, $sheet, $row);
        }
        $this->em->flush();
    }

    /**
     * @param Calendar                $calendar
     * @param \PHPExcel_Worksheet     $sheet
     * @param \PHPExcel_Worksheet_Row $row
     */
    protected function loadRow(Calendar $calendar, \PHPExcel_Worksheet $sheet, \PHPExcel_Worksheet_Row $row)
    {
        $event = new Event;
        $calendar->addEvent($event);

        foreach ($this->config as $field => $coordinate) {
            $event->{$this->getSetter($field)}($this->processValue($sheet, $row->getRowIndex(), $coordinate));
        }

        $this->em->persist($event);
    }

    /**
     * @param \PHPExcel_Worksheet $sheet
     * @param int                 $rowIndex
     * @param string              $coordinate
     *
     * @return string
     */
    protected function processValue(\PHPExcel_Worksheet $sheet, $rowIndex, $coordinate)
    {
        if (is_array($coordinate)) {
            return implode(
                ', ',
                array_map(
                    function($coordinate) use ($sheet, $rowIndex) {
                        return $sheet->getCell($coordinate.$rowIndex)->getValue();
                    },
                    $coordinate
                )
            );
        }

        return $sheet->getCell($coordinate.$rowIndex)->getValue();
    }

    /**
     * @param string $field
     *
     * @return string
     */
    protected function getSetter($field)
    {
        return 'set'.ucfirst($field);
    }
}
