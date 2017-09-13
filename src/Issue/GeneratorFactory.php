<?php

namespace GyTreasure\Issue;

use GyTreasure\Issue\IssueGenerator\Exceptions\NoAvailableIssueScriptException;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueGenerator as LegacyIssueGenerator;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueStructure as LegacyStructure;
use GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\ScriptIssueGenerator;

class GeneratorFactory
{
    /**
     * @param  string       $generator
     * @param  string|null  $id
     * @param  array        $config
     * @param  int          $startNumber
     * @return \GyTreasure\Issue\IssueGenerator\IssueGeneratorInterface
     *
     * @throws \Exception
     */
    public static function make($generator, $id, array $config, $startNumber = 1)
    {
        switch ($generator) {
            case 'default':
                try {
                    return new ScriptIssueGenerator($id);
                } catch (NoAvailableIssueScriptException $e) {
                    return static::legacyGenerator($config, $startNumber);
                }
            case 'legacy':
                return static::legacyGenerator($config, $startNumber);
            default:
                throw new \Exception('Wrong issue generator: ' . $generator);
        }
    }

    /**
     * @param array $config
     * @param int $startNumber
     * @return \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueGenerator
     */
    protected static function legacyGenerator(array $config, $startNumber = 1)
    {
        $structure  = LegacyStructure::make($config['issuerule'], $config['issueset'], $startNumber);
        return LegacyIssueGenerator::make($structure);
    }
}
