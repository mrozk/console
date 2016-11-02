<?php
require_once "devices.php";
require_once "interface.php";
require_once "control.php";
require_once "commands.php";

$control = Control::getInstance();
$bathroomLight = new BathroomLight();
$jacuzzi = new Jacuzzi();
$heating = new Heating();

// Simple actions and scenarios
$control->add(0, new BathroomLightOnCommand($bathroomLight), new BathroomLightOffCommand($bathroomLight));
$control->add(1, new JacuzziOnCommand($jacuzzi), new JacuzziOffCommand($jacuzzi));
$control->add(2, new HeatingOnCommand($heating), new HeatingOffCommand($heating));
$control->add(3, new HeatingChangeUpCommand($heating), new HeatingChangeDownCommand($heating));

$control->perform(0, true);
$control->perform(3, true);
$control->undo();
$control->undo();
$control->undo();


// Macros actions and scenarios
$macrosOnCommands = [];
$macrosOffCommands = [];
$door = new Door();
$garage = new Garage();
$macrosOnCommands[] = new ObjectOpenCommand($door);
$macrosOnCommands[] = new ObjectOpenCommand($garage);
$macrosOffCommands[] = new ObjectCloseCommand($door);
$macrosOffCommands[] = new ObjectCloseCommand($garage);

$macrosOn = new MacrosCommands($macrosOnCommands);
$macrosOff = new MacrosCommands($macrosOffCommands);

$control->add(4, $macrosOn, $macrosOff);
$control->perform(4, true);
$control->undo();

