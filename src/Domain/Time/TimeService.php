<?php

declare(strict_types=1);

namespace Domain\Time;

use Carbon\FactoryImmutable;
use DateTime;
use DateTimeZone;

final class TimeService
{
    private FactoryImmutable $factoryImmutable;

    public function __construct(FactoryImmutable $factoryImmutable)
    {
        $this->factoryImmutable = $factoryImmutable;
    }

    public function getInfo(DateTime $dateTime, string $timezone): TimeInfo
    {
        $carbonDateTime = $this->factoryImmutable->instance($dateTime);
        $carbonDateTime = $carbonDateTime->setTimezone(new DateTimeZone($timezone));

        $offset = $carbonDateTime->getOffset() / 60;
        $daysInFebruary = $carbonDateTime->setMonth(2)->daysInMonth;
        $monthName = $carbonDateTime->monthName;
        $daysInMonth = $carbonDateTime->daysInMonth;


        return new TimeInfo(
            $timezone,
            $offset,
            $daysInFebruary,
            $monthName,
            $daysInMonth,
        );
    }
}
