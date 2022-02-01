<?php

namespace Index;

require_once 'dbConnection.php';
require_once 'report.php';

use dbConnection;
use Report;

class Index
{
    private $dbConn;
    private $report;
    public function __construct()
    {
        $this->report = new Report();
        $dbConn = new dbConnection();
        $this->dbConn = $dbConn->getConnection();
    }

    public function index()
    {
        if ($_GET['student']) {
            return $this->getReportForStudent($_GET['student']);
        }

        return "Need a value";
    }

    private function getReportForStudent($idStudent)
    {
        $student = $this->dbConn->fetchRowMany("SELECT s.name name ,g.name board ,s_g.bal as bal FROM school_test_task.students_grades as s_g join students as s on s.id=s_g.student_id join grades as g on g.id=s_g.grade_id where s.id=" . $idStudent);
        $gradesBal = [];
        $boardName = '';
        $studentName = '';
        foreach ($student as $grades) {
            $gradesBal[]=[$grades['bal']];
            $boardName = $grades['board'];
            $studentName = $grades['name'];
        }

        if ($boardName == "CSM") {
            
           return $this->report->JsonReport([
                'student id' => $idStudent,
                'student name' => $studentName,
                'board' => $boardName,
                'grades_bal' => $gradesBal,
                'result' => array_sum($gradesBal) / count($gradesBal) >= 7 ? 'Pass' : 'Fail'
            ]);
        }
        if($boardName == "CSMB"){
            return $this->report->XmlReport([
                'student id' => $idStudent,
                'student name' => $studentName,
                'board' => $boardName,
                'grades_bal' => $gradesBal,
                'result' => max($gradesBal) >= 8 ? 'Pass' : 'Fail'
            ]);
        }
    }
}

$test = new Index();

print_r($test->index());
