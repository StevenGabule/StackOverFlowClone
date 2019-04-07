<div class="row mt-4">

    <div class="col-md-12">

        <div class="card">

            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount)}}</h2>
                </div>
            </div>

            <hr/>

            @include('layouts.messages')

            @foreach($answers as $answer)

                <div class="media">

                    <div class="d-flex flex-column vote-controls">

                        <a title="This answer is useful"
                           class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                           onclick="event.preventDefault();document.getElementById('up-vote-answer-{{ $answer->id  }}').submit()">
                            <i class="fas fa-caret-up fa-3x"></i></a>

                        <form action="/answers/{{ $answer->id }}/vote"
                              id="up-vote-answer-{{ $answer->id }}" method="post" style="display: none;">
                            @csrf
                            <input type="hidden" name="vote" value="1">
                        </form>

                        <span class="votes-count">{{ $answer->votes_count }}</span>

                        <a title="This is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                           onclick="event.preventDefault();document.getElementById('down-vote-answer-{{ $answer->id  }}').submit()">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>

                        <form action="/answers/{{ $answer->id }}/vote"
                              id="down-vote-answer-{{ $answer->id }}" method="post" style="display: none;">
                            @csrf
                            <input type="hidden" name="vote" value="-1">
                        </form>

                        @can('accept', $answer)
                            <a title="Mark this answer as best answer" class="{{ $answer->status }} mt-2"
                               onclick="event.preventDefault();document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-check fa-2x"></i>
                            </a>

                            <form action="{{ route('answers.accept', $answer->id) }}"
                                  id="accept-answer-{{ $answer->id }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        @else
                            @if($answer->is_best)
                                <a title="The question owner accepted this as best answer" class="{{ $answer->status }} mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            @endif
                        @endcan

                    </div>

                    <div class="media-body p-4">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can('update', $answer)
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                           class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete', $answer)
                                        <form class="form-delete" style="display: inline-block;"
                                              action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}"
                                              method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure?')">Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                            <div class="col-4"></div>

                            <div class="col-4">
                                <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                <div class="media">
                                    <a href="{{ $answer->user->url }}" class="pr-2">
                                        <img src="{{ $answer->user->avatar }}" alt="user avatar">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                    </div>
                                </div>
                            </div><!-- end of float right -->

                        </div>

                    </div>

                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div><!-- end of first row -->