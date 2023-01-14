<?php declare(strict_types=1);

namespace BoatTrip\Exceptions;

/**
 *  @inheritdoc
 *  An invalid GPS coordinate was encountered.
 *  Latitude may range from -90 to 90.
 *  Longitude may range from -180 to 180.
 */
class InvalidCoordinateException extends \Exception
{}