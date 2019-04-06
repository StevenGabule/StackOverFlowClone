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
                                <a title="This question is useful" class="vote-up"><i class="fas fa-caret-up fa-2x"></i></a>
                                <span class="votes-count">1230</span>
                                <a title="This is not useful" class="vote-down off"><i class="fas fa-caret-down fa-2x"></i></a>
                                <a title="click to mark as favorite question (Click again to undo)" class="favorited">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favorite-count">123</span>
                                </a>
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
        @include('answers.create', [

        ])
    </div><!-- end of container -->
@endsection
