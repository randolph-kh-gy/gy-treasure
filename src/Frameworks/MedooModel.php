<?php

namespace GyTreasure\Frameworks;

use Medoo\Medoo;

abstract class MedooModel
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var \Medoo\Medoo
     */
    protected $medoo;

    /**
     * @var array
     */
    protected static $medooQueryFunc = [
        'select', 'insert', 'update', 'delete',
        'replace', 'get', 'has', 'count', 'max',
        'min', 'avg', 'sum'
    ];

    /**
     * IssueInfoModel constructor.
     * @param \Medoo\Medoo $medoo
     */
    public function __construct(Medoo $medoo)
    {
        $this->medoo = $medoo;
    }

    /**
     * @return \PDO
     */
    public function pdo()
    {
        return $this->medoo->pdo;
    }
}