<?php

class BathroomLight
{
    public function off()
    {
        echo "turn off BathroomLight \n";
    }

    public function on()
    {
        echo "turn on BathroomLight \n";
    }

    public function dim()
    {
        echo "dim BathroomLight \n";
    }
}


class Jacuzzi
{
    public function turnOn()
    {
        echo "turn on Jacuzzi \n";
    }

    public function turnOff()
    {
        echo "turn off Jacuzzi \n";
    }

    public function playMusic()
    {
        echo "playMusic Jacuzzi \n";
    }
}


class Heating
{

    const MIN = 1;
    const MED = 2;
    const MAX = 3;
    const NO = 0;

    public $status = 0;

    public function warmUp()
    {
        if ($this->status < self::MAX) {
            $this->status++;
        }
        echo "level $this->status warmUp Heating \n";
    }

    public function warmDown()
    {
        if ($this->status > self::NO) {
            $this->status--;
        }
        echo "level $this->status warmDown Heating \n";
    }

    public function warmMax()
    {
        $this->status = self::MAX;
        echo "warmMax Heating \n";
    }

    public function off()
    {
        $this->status = self::NO;
        echo "off Heating \n";
    }
}


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

class Door {

    public function open()
    {
        echo "open Door \n";
    }

    public function close()
    {
        echo "close Door \n";
    }

}




