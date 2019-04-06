@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Editing answer for question: <strong>{{ $question->title }}</strong></h1>
                        </div>
                    </div>
                    <hr/>
                    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post"
                          class="p-4">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                    <textarea name="body" id="body" cols="" rows="7"
                              class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                              placeholder="Edit answer">{{ old('body', $answer->body) }}</textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info btn-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- end of first row -->
    </div>
@endsection