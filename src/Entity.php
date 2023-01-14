<?php declare(strict_types=1);

namespace BoatTrip;

/**
 *  Base entity class which contains the core
 *  data store information.
 * 
 *  This is simply for demonstration purposes
 *  as realistically the objects would represent
 *  entities in a data store, however since there
 *  is no data store implemented the id is simply
 *  set to null.
 */
class Entity
{
    public function __construct(
        readonly ?int $id = null,
    ) {}
}