<?php declare(strict_types=1);

namespace BoatTrip;

use BoatTrip\Interfaces\GPSLogged;
use DateTime;

class GPSLoggedTrip extends Trip implements GPSLogged
{
    /** @var GPSCoordinate[] */
    private array $coordinates;

    public function __construct(
        DateTime $startsAt,
    ) {
        parent::__construct($startsAt);
        $this->coordinates = [];
    }

    /** @inheritdoc */
    public function logCoordinate(GPSCoordinate $coordinate)
    {
        $this->coordinates[] = $coordinate;
    }

    /** @inheritdoc */
    public function getLog(): array
    {
        return $this->coordinates;
    }

    /** 
     *  @inheritdoc
     *  @return int the distance in meters.
     */
    public function calculateDistanceLogged(): int
    {
        $totalDistance = 0;

        foreach ($this->coordinates as $i => $coordinate) {
            // if we hit the last element we can simply exit out.
            if ($i + 1 >= count($this->coordinates)) break;

            $totalDistance += $coordinate->distanceFrom($this->coordinates[$i + 1]);
        }

        return $totalDistance;
    }
}