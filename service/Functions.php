<?php

namespace Service;

class Functions {

    public function timeElapsed($creationDate) {
        date_default_timezone_set('Europe/Paris');
        $now = new \DateTime(); // Curr date and time
        $creation = new \DateTime($creationDate); // Topic creation date
        $interval = $creation->diff($now); // Calculate interval
    
        // Format the result
        if ($interval->y > 0) {
            return $interval->y . 'y';
        } elseif ($interval->m > 0) {
            return $interval->m . 'mo';
        } elseif ($interval->d > 0) {
            return $interval->d . 'd';
        } elseif ($interval->h > 0) {
            return $interval->h . 'h';
        } elseif ($interval->i > 0) {
            return $interval->i . 'm';
        } else {
            return $interval->s . 's';
        }
    }

}
