<?php declare(strict_types=1);

namespace BoatTrip;

use BoatTrip\Interfaces\Trip as TripInterface;
use DateTime;
use DateInterval;
use InvalidArgumentException;

class Trip extends Entity implements TripInterface
{
    private DateTime $startsAt;

    private ?DateTime $endsAt;

    public function __construct(
       DateTime $startsAt,
    ) {
        parent::__construct();

        $this->startsAt = $startsAt;
        $this->endsAt = null;
    }

    /** @inheritdoc */
    public function getStartsAt(): ?DateTime
    {
        return $this->startsAt;
    }

    /** @inheritdoc */
    public function setStartsAt(DateTime $startsAt): void
    {
        if (isset($this->endsAt) && $startsAt >= $this->endsAt)
            throw new InvalidArgumentException("Trip cannot start after it has ended.");

        $this->startsAt = $startsAt;
    }

    /** @inheritdoc */
    public function getEndsAt(): ?DateTime
    {
        return $this->endsAt;
    }

    /** @inheritdoc */
    public function setEndsAt(DateTime $endsAt): void
    {
        if ($endsAt <= $this->startsAt) throw new InvalidArgumentException("Trip cannot end before start.");

        $this->endsAt = $endsAt;
    }

    /** @inheritdoc */
    public function getTotalDuration(): ?DateInterval
    {
        if (!isset($this->endsAt)) return null;

        return date_diff($this->startsAt, $this->endsAt);
    }

}