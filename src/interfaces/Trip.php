<?php declare(strict_types=1);

namespace BoatTrip\Interfaces;

use DateTime;
use DateInterval;

/**
 *  Interface for a trip. (journey or excusrions, especially for pleasure).
 *  It is understood that a trip has a beginning and an end which may not yet have occurred.
 * 
 *  @property DateTime  $startsAt
 *  @property ?DateTime $endsAt
 */
interface Trip
{
    /**
     *  Sets the `endsAt` property on the trip to the given DateTime.
     * 
     *  @throws InvalidArgumentException The end time cannot be before the start.
     */
    public function setEndsAt(DateTime $endTime);

    /**
     *  Retrieves the `endsAt` property
     */
    public function getEndsAt(): ?DateTime;

    /**
     *  Sets the `startsAt` property on the trip to the given DateTime.
     */
    public function setStartsAt(DateTime $endTime);

    /**
     *  Retrieves the `startsAt` property
     */
    public function getStartsAt(): ?DateTime;

    /**
     *  Returns the total duration of the trip for a trip which has ended.
     *  When the trip is still active null will be returned instead.
     */
    public function getTotalDuration(): ?DateInterval;
}