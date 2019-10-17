<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Series;
use Illuminate\Http\Request;

class WatchSeriesController extends Controller
{
    
    /**
     * Watch a series
     *
     * @param Bahdcasts\Series $series
     * @return redirect
     */
    public function index(Series $series)
    {
        $user = auth()->user();

        if($user->hasStartedSeries($series) ) {
            return redirect()->route('series.watch',
                [
                    'series' => $series->slug,
                    'lesson' => $user->getNextLessonToWatch($series)
            ]);
        }
        
        return redirect()->route('series.watch', [   
                'series' => $series->slug, 
                'lesson' => $series->lessons->first()->id 
        ]);
    }

     /**
     * Show a lesson page
     *
     * @param Bahdcasts\Series $series
     * @param Bahdcasts\Lesson $lesson
     * @return view
     */
    public function showLesson(Series $series, Lesson $lesson)
    {
        if( ! auth()->user()->subscribedToPlan(['monthly', 'yearly']) ) {
            return redirect('/subscribe');
        } 

        return view('frontend.watch',
            [
                'series' => $series,
                'lesson' => $lesson
            ]);
    

    }
    
     /**
     * Complete a lesson via ajax
     *
     * @param Bahdcasts\Lesson $lesson
     * @return json response
     */
    public function completeLesson(Lesson $lesson)
    {
        auth()->user()->completeLesson($lesson);
        return response()->json([
            'status' => 'ok'
        ]);
    } 
    
}
