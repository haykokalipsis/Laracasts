<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * Fields for mass assignment
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = [];

    /**
     * A lesson belongs to a series
     *
     * @return void
     */
    public function series() {
        return $this->belongsTo(Series::class);
    }

    /**
     * Get next lesson after $this 
     *
     * @return \Bahdcasts\Lesson
     */
    public function getNextLesson() {
        $nextLesson = $this->series->lessons()->where('episode_number', '>', $this->episode_number)
            ->orderBy('episode_number', 'asc')
            ->first();

        if($nextLesson)
            return $nextLesson;

        return $this;
    } 
    
    /**
     * Get previous lesson for $this
     *
     * @return \Bahdcasts\Lesson
     */
    public function getPreviousLesson()
    {
        $previousLesson = $this->series->lessons()->where('episode_number', '<', $this->episode_number)
            ->orderBy('episode_number', 'desc')
            ->first();

        if($previousLesson)
            return $previousLesson;

        return $this;
    } 
}
