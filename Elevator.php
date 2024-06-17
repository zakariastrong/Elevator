<?php

// Interface for elevator hardware
interface ElevatorHardware {
    public function goUp();
    public function goDown();
}

// Basic implementation of the ElevatorHardware interface
class BasicElevatorHardware implements ElevatorHardware {
    public function goUp() {
        echo "Executing goUp command.\n";
    }

    public function goDown() {
        echo "Executing goDown command.\n";
    }
}

// Elevator class using the hardware
class Elevator {
    // The current floor the elevator is on
    private $currentFloor;

    // The total number of floors in the building
    private $totalFloors;

    // The elevator hardware
    private $hardware;

    // Constructor to initialize the elevator
    public function __construct($totalFloors, ElevatorHardware $hardware) {
        // Set the initial floor to the ground floor (floor 1)
        $this->currentFloor = 1;

        // Store the total number of floors in the building
        $this->totalFloors = $totalFloors;

        // Store the elevator hardware
        $this->hardware = $hardware;
    }

    // Function to move the elevator to the desired floor
    public function goToFloor($desiredFloor) {
        // Check if the requested floor is valid (within the building's range)
        if ($desiredFloor < 1 || $desiredFloor > $this->totalFloors) {
            echo "Invalid floor! Please choose a floor between 1 and " . $this->totalFloors . "." . PHP_EOL;
            return; // Exit the function if the floor is invalid
        }

        // Determine the direction of movement (up or down)
        if ($desiredFloor > $this->currentFloor) {
            $this->goUpTo($desiredFloor); // Call the goUpTo function to move up
        } else if ($desiredFloor < $this->currentFloor) {
            $this->goDownTo($desiredFloor); // Call the goDownTo function to move down
        } else {
            echo "You are already on floor " . $desiredFloor . "." . PHP_EOL; // If on the desired floor, print a message
        }
    }

    // Function to move the elevator up to the desired floor
    private function goUpTo($desiredFloor) {
        while ($this->currentFloor < $desiredFloor) {
            $this->hardware->goUp(); // Use the hardware to go up
            $this->currentFloor++; // Increment the current floor
            echo "Going up to floor " . $this->currentFloor . "." . PHP_EOL; // Print the current floor

            // Simulate the time it takes to go up one floor (replace with actual elevator movement logic)
            sleep(1); 
        }
    }

    // Function to move the elevator down to the desired floor
    private function goDownTo($desiredFloor) {
        while ($this->currentFloor > $desiredFloor) {
            $this->hardware->goDown(); // Use the hardware to go down
            $this->currentFloor--; // Decrement the current floor
            echo "Going down to floor " . $this->currentFloor . "." . PHP_EOL; // Print the current floor

            // Simulate the time it takes to go down one floor (replace with actual elevator movement logic)
            sleep(1); 
        }
    }
}

// Example usage of the Elevator class
$hardware = new BasicElevatorHardware(); // Create an instance of the basic hardware
$elevator = new Elevator(10, $hardware); // Create an elevator object with 10 floors and the basic hardware
$elevator->goToFloor(5); // Move the elevator to floor 5
$elevator->goToFloor(2); // Move the elevator to floor 2
$elevator->goToFloor(10); // Move the elevator to the top floor (floor 10)

?>
