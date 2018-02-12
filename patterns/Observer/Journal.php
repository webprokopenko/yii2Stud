<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 8:27 PM
 */
class Journal implements Observable{
    private $observers = [];

    public function attach(Observer $instanse)
    {
        foreach ($this->observers as $observer) {
            if($instanse === $observer)
                return false;
        }

        $this->observers[] = $instanse;
        return true;
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    public function published()
    {
        $this->notify();
    }
}