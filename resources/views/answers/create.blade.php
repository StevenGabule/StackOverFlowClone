<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your answer</h3>
                </div>
            </div>
            <hr/>
            <form action="{{ route('questions.answers.store', $question->id) }}" method="post" class="p-4">
                @csrf
                <div class="form-group">
                    <textarea name="body" id="body" cols="" rows="7"
                              class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                              placeholder="Your answer"></textarea>
                    @if($errors->has('body'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-info btn-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- end of first row -->