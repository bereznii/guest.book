@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body">
                <form class="form-group" method="post" action="{{route('comment')}}">
                    @csrf
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" name="comment" rows="5" id="comment"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Пользователь</th>
                            <th>Отзыв</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comments))
                            @foreach($comments as $comment)
                            <tr>
                                <td><a href="{{route('profile', ['id' => $comment->user_id])}}">{{$comment->user_name}}</a></td>
                                <td><p>{{$comment->text}}</p></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection