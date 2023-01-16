# BoatTrip

## Setup

- clone the repository.
- `cd` to the code directory and run `composer install`.
- run `composer test` to run the tests.

## Thoughts

I chose to view the trip as something which can be edited after the fact. It would also be possible to view the trip as a 'log' meaning that we simply save the data sent by the boat so that it can be viewed after the fact.
I chose this way because the other method relies solely on input, if the boat has it's motor turned off is that the end of a trip? it could be a break instead. And if we look at the problem that way a trip has to be ended by human input which could be incorrect, so we allow editing it after the fact. For the same reason the start date can then be altered as it may have been started too late.


If the other approach were to be taken the following changes would need to be made:

- The Trip class should have 2 readonly properties for the timestamps.
- The Trip class should have an end() function which sets the endtime as the timestamp when the trip has ended.
- The getters and setters should be removed from the Trip class.
- Once a trip has ended it should no longer be possible to add GPSCoordinates.

Some other possible extensions to this implementation:
GPSCoordinate could include a timestamp. This would allow us to log the speed of the boat at certain points. This information could be used to see where boats tend to stand still or where they tend to never stop. Depending on the type of activity/boat it could then mean there are frequent jams at a location, or in reverse that there is nothing of interest and people simply move past.
Correctly linking the coordinates to the Trip would then also be done in the persistence layer when storing data, upon retrieval they can be added to 
the Trip using the logCoordinates. Depending on the actual ORM used the entities may have other structures associated with them, I tried to keep it agnostic in this way, although in practice it is often more beneficial to have the entity be more usable from the perspective of the ORM.
