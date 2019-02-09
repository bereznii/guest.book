@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-group" method="post" action="{{route('comment')}}">
                    @csrf
                    <label for="comment">Комментарий:</label>
                    <textarea class="form-control" name="comment" rows="5" id="comment" placeholder="Ваш отзыв" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-2">Пользователь</th>
                            <th class="col-8">Отзыв</th>
                            <th class="col-2">Время</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comments))
                            @foreach($comments as $comment)
                            <tr class="d-flex">
                                <td class="col-2"><a href="{{route('profile', ['id' => $comment->user_id])}}">{{$comment->user_name}}</a></td>
                                <td class="col-8"><p>{{$comment->text}}</p></td>
                                <td class="col-2"><p>{{$comment->created_at}}</p></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection