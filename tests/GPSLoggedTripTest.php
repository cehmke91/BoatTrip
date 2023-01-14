<?php declare(strict_types=1);

use BoatTrip\GPSCoordinate;
use BoatTrip\GPSLoggedTrip;
use PHPUnit\Framework\TestCase;

final class GPSLoggedTripTest extends TestCase
{
    public function testCanAddCoordinateToTrip(): void
    {
        $trip = new GPSLoggedTrip(new DateTime());
        $trip->logCoordinate(new GPSCoordinate(12.5, 10));

        $log = $trip->getLog();

        $this->assertEquals(count($log), 1);
        $this->assertEquals($log[0]->latitude, 12.5);
        $this->assertEquals($log[0]->longitude, 10);
    }

    public function testEmptyLogReturnsDistance0(): void
    {
        $trip = new GPSLoggedTrip(new DateTime());

        $this->assertEquals(0, $trip->calculateDistanceLogged());
    }

    public function testLogWithSingleEntrReturnsDistance0(): void
    {
        $trip = new GPSLoggedTrip(new DateTime());
        $trip->logCoordinate(new GPSCoordinate(12.5, 10));

        $this->assertEquals(0, $trip->calculateDistanceLogged());
    }

    public function testLogWithMultipleEntriesReturnsCorrectDistance0(): void
    {
        $trip = new GPSLoggedTrip(new DateTime());

        // use 5 units of precision to log in meters.
        // this makes testing easy as altering 1 should equal 1 meter.
        $trip->logCoordinate(new GPSCoordinate(12.50001, 10));
        $trip->logCoordinate(new GPSCoordinate(12.50002, 10));
        $trip->logCoordinate(new GPSCoordinate(12.50003, 10));


        $this->assertEquals(2, $trip->calculateDistanceLogged());
    }
}