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

In terms of persistence.
While it is out of scope, I included a base Entity class which acknowledges it. The persistence layer should itself be responsible for storing and retrieving the entities.
Rather than the entities having a save method on them which invokes the persistence layer (which could then be passed through using dependency injection to keep the implementation agnostic). 
Another thing to consider in the persistence layer is converting the GPS coordinates to integers to avoid floating point errors. 
Strings would also be possible but because the valid values including 5 bits of precision can be safely converted to integers without overflow issues.
I'd argue that that is better since the multiplication or division after the fact is much safer than string conversion.

