@extends('layouts.app')

@section('header')
    <header class="header header-inverse" style="background-color: #9ac29d">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>{{ $lesson->title }}</h1>
                    <p class="fs-20 opacity-70">{{  $series->title }}</p>

                </div>
            </div>

        </div>
    </header>
@stop

@section('content')
    <div class="section bg-grey">
        <div class="container">

            {{--We are getting those lessons here, for the purpose of not duplicating the query multiple times --}}
            {{--If you want, you can get those in controller and pass here, i dont like to clunk controllers--}}
            @php
                $nextLesson = $lesson->getNextLesson();
                $previousLesson = $lesson->getPreviousLesson();
            @endphp

            <div class="row gap-y text-center">
                <div class="col-12">

                    <vue-player
                            default_lesson="{{ $lesson }}"
                            @if($nextLesson->id !== $lesson->id)
                                next_lesson_url="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id]) }}"
                            @endif
                    ></vue-player>

                    @if($previousLesson->id !== $lesson->id)
                        <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $previousLesson->id]) }}" class="btn btn-info">Previous Lesson</a>
                    @endif

                    @if($nextLesson->id !== $lesson->id)
                        <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id]) }}" class="btn btn-info">Next Lesson</a>
                    @endif

                </div>

                <div class="col-12">
                    <ul class="list-group">
                        @foreach($series->getOrderedLessons() as $l)
                            <li class="list-group-item
                                @if($l->id == $lesson->id)
                                    active
                                @endif
                            ">

                                <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $l->id]) }}">{{ $l->title }}</a>

                                @if(auth()->user()->hasCompletedLesson($l))
                                    &nbsp;<b><small>COMPLETED</small></b>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop