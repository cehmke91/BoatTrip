<?php declare(strict_types=1);

use BoatTrip\Exceptions\FailedToPersistException;
use PHPUnit\Framework\TestCase;
use BoatTrip\Trip;

final class TripTest extends TestCase
{
    public function testValidTripCreationSuccess(): void
    {
        $this->assertInstanceOf(Trip::class, (new Trip(new DateTime())));
    }

    public function testInvalidTripCreationFails(): void
    {
        $this->expectException(ArgumentCountError::class);

        $trip = new Trip();
    }

    // public function testPersistanceSuccessReturnsVoid(): void
    // {
    //     $this->assertNull((new Trip(new DateTime()))->persist());
    // }

    // public function testPersistanceFailedThrowsException(): void
    // {
    //     $this->expectException(FailedToPersistException::class);
    //     $this->expectExceptionMessage("Failed to persist Trip");
        
    //     (new Trip(new DateTime()))->persist(true);
    // }

    public function testCannotAlterStartTimeWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Trip cannot start after it has ended.");

        $trip = new Trip(new DateTime("2022-12-21 12:00:00"));
        $trip->setEndsAt(new DateTime("2022-12-21 13:30:00"));
        $trip->setStartsAt(new DateTime("2022-12-21 14:00:00"));
    }

    public function testCanAlterStartTimeWithValidInput(): void
    {
        $trip = new Trip(new DateTime("2022-12-21 12:00:00"));
        $trip->setEndsAt(new DateTime("2022-12-21 13:30:00"));
        $trip->setStartsAt(new DateTime("2022-12-21 13:00:00"));
                
        $this->assertEquals("13:00:00", $trip->getStartsAt()->format("H:i:s"));
    }

    public function testCannotEndTripWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Trip cannot end before start.");

        $trip = new Trip(new DateTime());
        $trip->setEndsAt(New DateTime("2012-12-21"));
    }

    public function testCanSetTripEndWithValidInput(): void
    {
        $trip = new Trip(new DateTime("2022-12-21 12:00:00"));
        $trip->setEndsAt(new DateTime("2022-12-21 13:30:00"));

        $this->assertEquals("13:30:00", $trip->getEndsAt()->format("H:i:s"));
    }

    public function testRetrievingTotalDurationDuringTripReturnsNull(): void
    {
        $trip = new Trip(new DateTime());

        $this->assertNull($trip->getTotalDuration());
    }

    public function testTotalDurationAfterTripReturnsCorrectValue(): void
    {
        $trip = new Trip(new DateTime("2022-12-21 12:00:00"));
        $trip->setEndsAt(new DateTime("2022-12-21 13:30:00"));

        $duration = $trip->getTotalDuration();

        $this->assertInstanceOf(DateInterval::class, $duration);
        $this->assertEquals(30, $duration->i);
    }
}
