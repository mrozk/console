<?php

/**
 * Singleton class to handle devices command items
 *
 * Its a simple implementation off console which can
 * send instructions to different devices in a flat
 */
class Control
{

    private static $owner;
    public $positionCount = 7;

    /**
     * @var array Command
     */
    private $onCommands = [];

    /**
     * @var array Command
     */
    private $offCommands = [];

    /**
     * @var array Command
     */
    private $undoCommands = [];

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!self::$owner) {
            self::$owner = new Control();
        }

        return self::$owner;
    }



    /**
     * @param $position
     * @param Command $actionOn
     * @param Command $actionOff
     * @throws Exception
     */
    public function add($position, $actionOn, $actionOff)
    {
        if($position < 0 || $position > ($this->positionCount - 1)){
            throw new Exception('Wrong position');
        }

        $this->onCommands[$position] = $actionOn;
        $this->offCommands[$position] = $actionOff;

    }


    /**
     *
     * Push button handler
     *
     * @param $position
     * @param bool $isOnButton what kind of button is it on/off
     * @throws Exception
     */
    public function perform($position, $isOnButton)
    {
        if($isOnButton){
            $command = isset($this->onCommands[$position]) ? $this->onCommands[$position] : null;
        }else{
            $command = isset($this->offCommands[$position]) ? $this->offCommands[$position] : null;
        }

        if(!$command){
            throw new Exception('Command not found');
        }

        /** @var Command $command */
        $command->execute();
        $this->appendOperation($command);
    }


    /**
     *
     * Concentrate execution history of commands
     *
     * @param $command
     */
    private function appendOperation($command){
        if(count($this->undoCommands) > 8){
            array_shift($this->undoCommands);
        }

        array_push($this->undoCommands, $command);
    }


    /**
     * Commands info
     */
    public function printCommands()
    {
        echo "List of commands and items\n";
        foreach($this->onCommands as $key => $item){
            echo "position $key \n";
            echo "On button execute " . get_class($item) .
                ", Off button execute" . get_class($this->offCommands[$key]). " \n";
            echo "Device  " . (isset($item->executor) ? get_class($item->executor) : 'macros') . " \n";
        }
    }


    /**
     *
     * Rollback previous command
     *
     */
    public function undo()
    {
        /** @var Command $element */
        $element = array_pop($this->undoCommands);
        if($element){
            $element->undo();
        }
    }




}