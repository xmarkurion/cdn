@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <form action="{{route('images.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                            <button type="submit"> SAVE </button>
                        </form>

                        @if($errors->any())
                            <div id="error-box">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{$error}} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
