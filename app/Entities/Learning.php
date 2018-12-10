<?php

namespace App\Entities;

use App\Lesson;
use App\Series;
use Redis;

trait Learning
{
    public function completeLesson($lesson)
    {
        // We store something like user:5|series:55 = 4
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    public function percentageCompletedForSeries($series)
    {
        $numberOfLessonsInSeries = $series->lessons->count();
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
        return Redis::smembers("user:{$this->id}:series:{$series->id}");
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
    
    public function hasCompletedLesson($lesson)
    {
        return in_array(
            $lesson->id,
            $this->getCompletedLessonsForASeries($lesson->series)
        );
    } 
    
    public function seriesBeingWatchedByUser()
    {
        // Получаем все записи из редиса где юзверь 1 а курсов дофига. К примеру user:1:series:2, user:1:series:3
        // Важно: Получаем ключи, тобиш строки типа user:1:series:2, user:1:series:3, а не значения, тобиш lessons
        $keys = Redis::keys("user:{$this->id}:series:*");

        $seriesIds = [];

        foreach ($keys as $key):
            // Get series ids from string like user:1:seres:3
            $serieId = explode(':', $key)[3];
            array_push($seriesIds, $serieId);
        endforeach;

        $seriesCollection = collect($seriesIds);
        $seriesCollection->map(function ($id) {
            return Series::find($id);
        });

        return $seriesCollection;
    }
    
    public function getTotalNumberOfCompletedLessons()
    {
        $keys = Redis::keys("user:{$this->id}:series:*");

        $result = 0;
//        for example user:1:series:1 = [1,2,3,55,63], user1:series3 = [4,5,6,7,] etc, we need count of lessons in that key

        foreach ($keys as $key):
            $result += count(Redis::smembers($key ) );
        endforeach;

        return $result;
    }

}