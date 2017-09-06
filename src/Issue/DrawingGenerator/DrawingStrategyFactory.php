<?php

namespace GyTreasure\Issue\DrawingGenerator;

use GyTreasure\Issue\DrawingGenerator\Exceptions\UnsupportedDrawingIdException;
use GyTreasure\Issue\DrawingGenerator\Strategies\ElevenFiveStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\ShuffleTenStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\TakeFiveStrategy;

class DrawingStrategyFactory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Issue\DrawingGenerator\DrawingStrategy
     *
     * @throws \GyTreasure\Issue\DrawingGenerator\Exceptions\UnsupportedDrawingIdException
     */
    public static function make($id)
    {
        if (static::isSsc($id)) {
            return new TakeFiveStrategy;
        } elseif (static::is115($id)) {
            return new ElevenFiveStrategy;
        } elseif (static::isPK10($id)) {
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
        return static::isSsc($id) || static::is115($id) || static::isPK10($id);
    }

    /**
     * 是否为自主时时彩.
     *
     * @param  string  $id
     * @return bool
     */
    protected static function isSsc($id)
    {
        return in_array($id, ['miaomiao_ssc', 'yifen_ssc', 'liangfen_ssc', 'wufen_ssc']);
    }

    /**
     * 是否为自主 11 选 5.
     *
     * @param  string  $id
     * @return bool
     */
    protected static function is115($id)
    {
        return in_array($id, ['miaomiao115', 'yifen115', 'liangfen115', 'wufen115']);
    }

    /**
     * 是否为自主 PK10.
     *
     * @param  string  $id
     * @return bool
     */
    protected static function isPK10($id)
    {
        return in_array($id, ['jisu_pk10']);
    }
}
