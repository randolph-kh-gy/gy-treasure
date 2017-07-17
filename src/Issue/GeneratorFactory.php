<?php

namespace GyTreasure\Issue;

use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueGenerator as LegacyIssueGenerator;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueStructure as LegacyStructure;

class GeneratorFactory
{
    /**
     * @param  string  $generator
     * @param  array   $config
     * @param  int     $startNumber
     * @return \GyTreasure\Issue\IssueGenerator\IssueGeneratorInterface
     *
     * @throws \Exception
     */
    public static function make($generator, array $config, $startNumber = 1)
    {
        switch ($generator) {
            case 'legacy':
                $structure  = LegacyStructure::make($config['issuerule'], $config['issueset'], $startNumber);
                return LegacyIssueGenerator::make($structure);
            default:
                throw new \Exception('Wrong issue generator: ' . $generator);
        }
    }
}
