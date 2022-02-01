<?php
try {
    $data = [
        'students' => [
            [
                'name' => 'Peter',
            ],
            [
                'name' => 'Jon',
            ],
            [
                'name' => 'Jony',
            ],
            [
                'name' => 'Alex',
            ]
        ],
        'grades' => [
            [
                'name' => 'CSM',
            ],
            [
                'name' => 'CSMB',
            ]
        ],
    ];

    $dataGradesStudents = [
        'CSM' => [
            'Peter' => [3, 4, 2],
            'Jony' => [3, 4, 7]
        ],
        'CSMB' => [
            'Alex' => [1, 8, 2],
            'Jon' => [3, 4, 7]
        ]
    ];
    foreach ($data as $table => $values){
        $dbConn->insertMany($table, $values);
    }
    $students = $dbConn->fetchRowMany('SELECT * FROM students');
    $studentsPluck = pluck($students, 'name');
    $grades = $dbConn->fetchRowMany('SELECT * FROM grades');
    $gradesPluck = pluck($grades, 'name');
    foreach ($dataGradesStudents as $nameGrades => $students) {
        foreach($students as $nameStudent=>$grades){
            foreach($grades as $value){
                $dbConn->insert('students_grades', [
                    'student_id'=>$studentsPluck[$nameStudent]['id'],
                    'grade_id'=>$gradesPluck[$nameGrades]['id'],
                    'bal'=>$value
                ]);
            }
        }
    }
} catch (Exception $e) {
    $message = json_decode($e->getMessage());
    echo $message->errorInfo->message . "\n";
}

/**
 * Pluck an array
 */
function pluck(array $data, $key): array
{
    $result = [];
    foreach ($data as $value) {
        $result[$value[$key]] = $value;
    }
    return $result;
}
