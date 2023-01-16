<?php declare(strict_types=1);

namespace BoatTrip;

use BoatTrip\Exceptions\InvalidCoordinateException;

/**
 *  Represents a GPS coordinate with a precision set to meters.
 */
class GPSCoordinate extends Entity
{
    public readonly int $tripId;
    
    public readonly float $latitude;
    public readonly float $longitude;

    public function __construct(
        int $tripId,
        float $latitude,
        float $longitude,
    ) {
        if ($latitude < -90 || $latitude > 90)
            throw new InvalidCoordinateException("Invalid latitude measurement. Must range from -90 to 90");

        if ($longitude < -180 || $longitude > 180)
            throw new InvalidCoordinateException("Invalid longitude measurement. Must range from -180 to 180");

        parent::__construct();
        
        // link to the containing trip
        $this->tripId = $triipId;

        // round to 5 decimal spaces to set the precision to 1.11m
        $this->latitude = round($latitude, 5);
        $this->longitude = round($longitude, 5);
    }

    /**
     *  Calculate the distance from this coordinate to the provided coordinate.
     *  The function will round to the nearest meter.
     *  
     *  @return int distance in meters.
     */
    public function distanceFrom(GPSCoordinate $coordinate): int
    {
        // if there is no distance just return 0 instead of calculating.
        if ($this->latitude === $coordinate->latitude && $this->longitude === $coordinate->longitude)
            return 0;

        // the radius of the earth in meters
        $earthRadius = 6371000;

        // use the haversine formula to calculate the distance.
        $latFrom = deg2rad($coordinate->latitude);
        $lonFrom = deg2rad($coordinate->longitude);
        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  
        return (int) round($angle * $earthRadius);
    }
}
