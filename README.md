## Project description
The entry point is a RunRovers command. I use a separate class to transform raw user input to rover objects.
At first I wanted to use a plateau as a main object to run all rovers on it but then switched to "rovers-centric" solution
where rovers know their plateau and movements and can move on their own which seemed more logical in this case.

I made it rather easy to add new movements by implementing MovementInterface and updating MovementFactory.

To get things done in time I reused several parts from previous projects (with minor adaptation) like docker file, bin/console
and several other small things.

I used only two vendors:
- *phpunit* for testing console interactions and simple units
- *symfony's console component* to take care of the I/O stuff

By the way after the last interview I researched the object calisthenics rules and tried to follow them this time.

## Installation

Please use docker:
```
sudo docker build -t vladimir/rovers .
sudo docker run -it vladimir/rovers:latest /bin/bash
```

Now you are in bash. To run the main command execute
```
bin/console run-rovers \
'5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM'
```
To launch tests run
```
vendor/bin/phpunit
```

---
To use it **without docker**, just run ```composer install``` in the main dir and use the same commands.


## Possible improvements
 - Directions shouldn't be a simple string
 - Create a master-class for collections
 - Finish unit tests
 - Properly handle exceptions
 - Introduce additional validation for use inputs
 - Add more method descriptions
 - Right turns and left turns are very similar
