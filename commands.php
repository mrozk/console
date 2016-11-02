<?php

/**
 * Command for turning on the lite at bathroom
 */
class BathroomLightOnCommand implements Command{

    public $executor;

    public function __construct(BathroomLight $executor)
    {
        $this->executor = $executor;
    }


    public function execute()
    {
        $this->executor->on();
        $this->executor->dim();
    }

    public function undo()
    {
        $this->executor->off();
    }
}


/**
 * Command for opening object, which can be open
 */
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


/**
 * Command for closing object, which can be close
 */
class ObjectCloseCommand implements Command{

    public $executor;

    public function __construct($executor)
    {
        $this->executor = $executor;
    }


    public function execute()
    {
        $this->executor->close();
    }

    public function undo()
    {
        $this->executor->open();
    }
}


/**
 * Command for turning off the lite at bathroom
 */
class BathroomLightOffCommand implements Command{

    public $executor;

    public function __construct(BathroomLight $executor)
    {
        $this->executor = $executor;
    }


    public function execute()
    {
        $this->executor->off();
    }

    public function undo()
    {
        $this->executor->on();
        $this->executor->dim();
    }
}


/**
 * Command for turning on Jacuzzi and Playing music in one time
 */
class JacuzziOnCommand implements Command{

    public $executor;

    public function __construct(Jacuzzi $executor)
    {
        $this->executor = $executor;
    }

    public function execute()
    {
        $this->executor->turnOn();
        $this->executor->playMusic();
    }

    public function undo()
    {
        $this->executor->turnOff();
    }
}

/**
 * Command for turning off Jacuzzi and Playing music
 */
class JacuzziOffCommand implements Command{

    public $executor;

    public function __construct(Jacuzzi $executor)
    {
        $this->executor = $executor;
    }

    public function execute()
    {
        $this->executor->turnOff();
    }

    public function undo()
    {
        $this->executor->turnOn();
        $this->executor->playMusic();
    }
}


/**
 * Command for turning on Heating on max power
 */
class HeatingOnCommand implements Command{

    public $executor;

    public function __construct(Heating $executor)
    {
        $this->executor = $executor;
    }

    public function execute()
    {
        $this->executor->warmMax();
    }

    public function undo()
    {
        $this->executor->off();
    }
}

/**
 * Command for turning off Heating
 */
class HeatingOffCommand implements Command{

    public $executor;

    public function __construct(Heating $executor)
    {
        $this->executor = $executor;
    }

    public function execute()
    {
        $this->executor->off();
    }

    public function undo()
    {
        $this->executor->warmMax();
    }
}

/**
 * Command for change up heat power on 1 point
 */
class HeatingChangeUpCommand implements Command{

    public $executor;

    public function __construct(Heating $executor)
    {
        $this->executor = $executor;
    }

    public function execute()
    {
        $this->executor->warmUp();
    }

    public function undo()
    {
        $this->executor->warmDown();
    }
}



/**
 * Command for change down heat power on 1 point
 */
class HeatingChangeDownCommand implements Command{

    public $executor;

    public function __construct(Heating $executor)
    {
        $this->executor = $executor;
    }

    public function execute()
    {
        $this->executor->warmDown();
    }

    public function undo()
    {
        $this->executor->warmUp();
    }
}


/**
 * Command for concentrating other commands and
 * organize their multiply execution
 */
class MacrosCommands implements Command{

    /**
     * @var Command[]
     */
    public $command;

    public function __construct(array $command)
    {
        $this->command = $command;
    }

    public function execute()
    {
        foreach($this->command as $item){
            $item->execute();
        }
    }

    public function undo()
    {
        foreach($this->command as $item){
            $item->undo();
        }
    }
}
