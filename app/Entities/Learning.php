<?php

namespace App\Entities;

use App\Lesson;
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
        return count($this->getCompletedLessonsForASeries($series));
    }
    
    public function hasStartedSeries($series)
    {
        return $this->getNumberOfCompletedLessonsForSeries($series) > 0;
    } 

    public function getCompletedLessonsForASeries($series)
    {
        return Redis::smembers("user:{$this->id}|series:{$series->id}");
    }

    public function getCompletedLessons($series)
    {
        // Get ids of completed lessons as array. 1, 2, 5
        $completedLessons = $this->getCompletedLessonsForASeries($series);

        // Make, transform collection of lessons from those ids
        return collect($completedLessons)->map(function ($lessonId) {
            return Lesson::find($lessonId);
        });
    }

}