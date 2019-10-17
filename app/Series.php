<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lesson;

class Series extends Model
{
    protected $guarded = [];
    protected $with = ['Lessons'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Return the public path for series image
     *
     * @return string
     */
    public function getImagePathAttribute() {
        return asset('storage/' . $this->image_url);
    }

    /**
     * Get a list of lessons for series in watching order
     *
     * @return void
     */
    public function getOrderedLessons() {
        return $this->lessons()->orderBy('episode_number', 'asc')->get();
    }
}
