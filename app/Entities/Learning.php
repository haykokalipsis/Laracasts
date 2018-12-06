<?php

namespace App\Entities;

use Redis;

trait Learning
{
    public function completeLesson($lesson)
    {
        // We store something like user:5|series:55 = 4
        Redis::sadd("user:{$this->id}|series:{$lesson->series->id}", $lesson->id);
    }

    public function percentageCompletedForSeries($series)
    {
        $numberOfLessonsInSeries = $series->Lessons->count();
        $numberOfCompletedLessons = $this->getNumberOfCompletedLessonsForSeries($series);

        return ($numberOfCompletedLessons / $numberOfLessonsInSeries) * 100;
    }

    public function getNumberOfCompletedLessonsForSeries($series)
    {
        return count(Redis::smembers("user:{$this->id}|series:{$series->id}") );
    }
}