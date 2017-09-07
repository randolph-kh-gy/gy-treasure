<?php

namespace GyTreasure\Issue\DrawingGenerator;

use GyTreasure\Issue\DrawingGenerator\Exceptions\UnavailableDrawingIdException;
use GyTreasure\Issue\DrawingGenerator\Exceptions\UnsupportedDrawingIdException;
use GyTreasure\Issue\DrawingGenerator\Strategies\ElevenFiveStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\ShuffleTenStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\TakeFiveStrategy;
use GyTreasure\Issue\IssueInfo;

class DrawingStrategyFactory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Issue\DrawingGenerator\DrawingStrategy
     *
     * @throws \GyTreasure\Issue\DrawingGenerator\Exceptions\UnsupportedDrawingIdException 未支援的自主彩
     * @throws \GyTreasure\Issue\DrawingGenerator\Exceptions\UnavailableDrawingIdException 无效的自主彩 ID
     */
    public static function make($id)
    {
        if (! IssueInfo::isOwner($id)) {
            throw new UnavailableDrawingIdException('Drawing Id is unavailable for generating.  ($id: ' . $id . ')');
        }

        if (IssueInfo::isSsc($id)) {
            return new TakeFiveStrategy;
        } elseif (IssueInfo::is115($id)) {
            return new ElevenFiveStrategy;
        } elseif (IssueInfo::isPK10($id)) {
            return new ShuffleTenStrategy;
        } else {
            throw new UnsupportedDrawingIdException('Unsupported drawing ID. ($id: ' . $id . ')');
        }
    }

    /**
     * 是否为有效的自主彩种 ID.
     *
     * @param  string  $id
     * @return bool
     */
    public static function isIdAvailable($id)
    {
        $isOwner = IssueInfo::isOwner($id);
        $type    = IssueInfo::type($id);
        return $isOwner && in_array($type, static::availableTypes());
    }

    /**
     * @return array
     */
    protected static function availableTypes()
    {
        return [IssueInfo::TYPE_SSC, IssueInfo::TYPE_115, IssueInfo::TYPE_PK10];
    }
}
