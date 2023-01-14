<?php declare(strict_types=1);

use BoatTrip\Exceptions\InvalidCoordinateException;
use PHPUnit\Framework\TestCase;
use BoatTrip\GPSCoordinate;

final class GPSCoordinateTest extends TestCase
{
    public function testThrowsExceptionWhenGivenLatitudeTooLow(): void
    {
        $this->expectException(InvalidCoordinateException::class);
        $this->expectExceptionMessage("Invalid latitude measurement. Must range from -90 to 90");

        new GPSCoordinate(-130.46, 18.92);
    }

    public function testThrowsExceptionWhenGivenLatitudeTooHigh(): void
    {
        $this->expectException(InvalidCoordinateException::class);
        $this->expectExceptionMessage("Invalid latitude measurement. Must range from -90 to 90");

        new GPSCoordinate(130.46, 18.92);
    }

    public function testThrowsExceptionWhenGivenLongitudeTooLow(): void
    {
        $this->expectException(InvalidCoordinateException::class);
        $this->expectExceptionMessage("Invalid longitude measurement. Must range from -180 to 180");

        new GPSCoordinate(13.46, -195);
    }

    public function testThrowsExceptionWhenGivenLongitudeTooHigh(): void
    {
        $this->expectException(InvalidCoordinateException::class);
        $this->expectExceptionMessage("Invalid longitude measurement. Must range from -180 to 180");

        new GPSCoordinate(13.46, 195);
    }

    public function testCanSuccessfullyCreateCoordinate(): void
    {
        $coord = new GPSCoordinate(13.46, 18.92);

        $this->assertEquals(13.46, $coord->latitude);
        $this->assertEquals(18.92, $coord->longitude);
    }

    public function testDistanceFromReturns0WhenNoDifference(): void
    {
        $coord1 = new GPSCoordinate(13.46, 18.92);
        $coord2 = new GPSCoordinate(13.46, 18.92);

        $this->assertEquals(0, $coord1->distanceFrom($coord2));
    }

    public function testDistanceFromReturnsCorrectly(): void
    {
        // distance traveled here should be exactly 1 meter.
        // 5 decimal points on GPS coordinates = 1.11m
        $coord1 = new GPSCoordinate(13.46001, 18.92);
        $coord2 = new GPSCoordinate(13.46002, 18.92);

        $this->assertEquals(1, $coord1->distanceFrom($coord2));
    }
}