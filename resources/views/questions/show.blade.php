@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <div class="media">
                            <div class="d-flex flex-column vote-controls">

                                <a title="This question is useful"
                                   class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                   onclick="event.preventDefault();document.getElementById('up-vote-question-{{ $question->id  }}').submit()">
                                    <i class="fas fa-caret-up fa-3x"></i></a>

                                <form action="/questions/{{ $question->id }}/vote"
                                      id="up-vote-question-{{ $question->id }}" method="post" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>

                                <span class="votes-count">{{ $question->votes_count }}</span>

                                <a title="This is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                   onclick="event.preventDefault();document.getElementById('down-vote-question-{{ $question->id  }}').submit()">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>

                                <form action="/questions/{{ $question->id }}/vote"
                                      id="down-vote-question-{{ $question->id }}" method="post" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>

                                <a title="click to mark as favorite question (Click again to undo)"
                                   class="favorite mt-2 {{ Auth::guest() ? 'off': ($question->is_favorited ? 'favorited' : '') }}"
                                   onclick="event.preventDefault();document.getElementById('favorite-question-{{ $question->id  }}').submit()">
                                    <i class="fas fa-star fa-3x"></i>
                                    <span class="favorite-count"
                                          style="color: black">{{ $question->favorites_count }}</span>
                                </a>
                                <form action="/questions/{{ $question->id }}/favorites"
                                      id="favorite-question-{{ $question->id }}" method="post" style="display: none;">
                                    @csrf
                                    @if($question->is_favorited)
                                        @method('DELETE')
                                    @endif
                                </form>
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $question->created_date }}</span>
                                    <div class="media">
                                        <a href="{{ $question->user->url }}" class="pr-2"><img
                                                    src="{{ $question->user->avatar }}" alt="user avatar"></a>
                                        <div class="media-body">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div><!-- end of float right -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('answers.index', [
            'answers' => $question->answers,
            'answersCount' => $question->answers_count
        ])
        @include('answers.create', [])
    </div><!-- end of container -->
@endsection
