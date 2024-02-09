<?php

declare(strict_types=1);

namespace Domain\Time;

final class TimeInfo
{
    private string $timeZone;
    private string $offset;
    private int $daysInFebruary;
    private string $monthName;
    private int $daysInMonth;

    public function __construct(string $timeZone, int $offset, int $daysInFebruary, string $monthName, int $daysInMonth)
    {
        $this->offset = $offset > 0 ? "-{$offset}" : "+{$offset}";
        $this->daysInFebruary = $daysInFebruary;
        $this->monthName = $monthName;
        $this->daysInMonth = $daysInMonth;
        $this->timeZone = $timeZone;
    }

    public function getOffset(): string
    {
        return $this->offset;
    }

    public function getDaysInFebruary(): int
    {
        return $this->daysInFebruary;
    }

    public function getMonthName(): string
    {
        return $this->monthName;
    }

    public function getDaysInMonth(): int
    {
        return $this->daysInMonth;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }
}
