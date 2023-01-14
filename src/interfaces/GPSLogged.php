<?php declare(strict_types=1);

namespace BoatTrip\Interfaces;

use BoatTrip\GPSCoordinate;

/**
 *  This interface defines the properties of an entity which is GPS logged.
 *  A GPS logged entity is any entity which has a collection of GPS coordinates
 *  attached with the intention of logging its positioning.
 * 
 *  @property GPSCoordinate[] $coordinates
 */
interface GPSLogged
{
    /**
     *  Add a Coordinate to the log.
     */
    public function logCoordinate(GPSCoordinate $coordinate);

    /**
     *  Retrieve all coordinates.
     *  @return array GPSCoordinate[]
     */
    public function getLog(): array;

    /**
     *  Returns the total distance logged by GPS coordinates
     *  on this entity.
     */
    public function calculateDistanceLogged(): float|int;
}