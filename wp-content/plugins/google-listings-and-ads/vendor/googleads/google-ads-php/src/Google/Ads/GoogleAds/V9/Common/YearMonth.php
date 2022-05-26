<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v9/common/dates.proto

namespace Google\Ads\GoogleAds\V9\Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Year month.
 *
 * Generated from protobuf message <code>google.ads.googleads.v9.common.YearMonth</code>
 */
class YearMonth extends \Google\Protobuf\Internal\Message
{
    /**
     * The year (e.g. 2020).
     *
     * Generated from protobuf field <code>int64 year = 1;</code>
     */
    protected $year = 0;
    /**
     * The month of the year. (e.g. FEBRUARY).
     *
     * Generated from protobuf field <code>.google.ads.googleads.v9.enums.MonthOfYearEnum.MonthOfYear month = 2;</code>
     */
    protected $month = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $year
     *           The year (e.g. 2020).
     *     @type int $month
     *           The month of the year. (e.g. FEBRUARY).
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Ads\GoogleAds\V9\Common\Dates::initOnce();
        parent::__construct($data);
    }

    /**
     * The year (e.g. 2020).
     *
     * Generated from protobuf field <code>int64 year = 1;</code>
     * @return int|string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * The year (e.g. 2020).
     *
     * Generated from protobuf field <code>int64 year = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setYear($var)
    {
        GPBUtil::checkInt64($var);
        $this->year = $var;

        return $this;
    }

    /**
     * The month of the year. (e.g. FEBRUARY).
     *
     * Generated from protobuf field <code>.google.ads.googleads.v9.enums.MonthOfYearEnum.MonthOfYear month = 2;</code>
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * The month of the year. (e.g. FEBRUARY).
     *
     * Generated from protobuf field <code>.google.ads.googleads.v9.enums.MonthOfYearEnum.MonthOfYear month = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setMonth($var)
    {
        GPBUtil::checkEnum($var, \Google\Ads\GoogleAds\V9\Enums\MonthOfYearEnum\MonthOfYear::class);
        $this->month = $var;

        return $this;
    }

}

