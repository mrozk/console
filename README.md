Flexible console
=================

Flexible console can control remote devices with different interfaces.
It has one button for programing some scenario with some device, and two buttons on/off for sending different signals


Usage
-----
To add new device you must create device class and create their method bodies
Example:
```
class Garage
{
    public function open()
    {
        echo "open Garage \n";
    }

    public function close()
    {
        echo "close Garage \n";
    }
}
```
To add new device you must create class for on and off button
witch implements interface Command, and there we programing device behaviour

```
class ObjectOpenCommand implements Command{

    public $executor;

    public function __construct($executor)
    {
        $this->executor = $executor;
    }


    public function execute()
    {
        $this->executor->open();
    }

    public function undo()
    {
        $this->executor->close();
    }
}
```

Then we just add specific commands to specific position


```
$control->add(0, new BathroomLightOnCommand($bathroomLight), new BathroomLightOffCommand($bathroomLight));
```
And perform  some actions

```
$control->perform(4, true);
```

Requirements
------------
PHP 5.6

Run
---
```
php index.php
```