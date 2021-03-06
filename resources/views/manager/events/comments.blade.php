@extends('layouts.manager', ['current_page' => 'Commentaires'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-2">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-md-9 col-sm-10">
            <div class="card bg-success" id="comments">
                <div class="card-header">Commentaires</div>
                <div class="card-body comments">
                    @if(count($event->comments->where('deleted_at', null)) > 0)
                        @if(Auth::user()->is_admin)
                        <form action="{{route('delete-comments', ['id' => $event->id])}}" method="post" class="text-right mb-2">
                            {{csrf_field()}}
                            <input type="hidden" name="comments_ids" ref="comments_ids">

                            <button type="submit" class="btn btn-danger btn-sm" v-cloak :class="{'disabled': comments.length < 1}">
                                <i class="fa fa-trash mr-2"></i>
                                Supprimer
                            </button>
                        </form>
                        @endif
                        @foreach($event->comments->where('deleted_at', null) as $comment)
                        <div class="comment">
                            @if(Auth::user()->is_admin)
                                <div class="check-comment">
                                    <div class="checkbox-fn">
                                        <label for="" class="label-control">
                                            <input type="checkbox" ref="checkbox-{{$comment->id}}" data-id="{{$comment->id}}">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <a href="{{route('user', ['username' => $comment->user->username])}}" class="author-image">
                                <img src="{{asset('storage/images/avatars/' . $comment->user->avatar)}}" alt="">
                            </a>
                            <div class="author-info">
                                <a href="{{route('user', ['username' => $comment->user->username])}}" class="author-name">
                                    {{title_case($comment->user->fullname)}}
                                </a>
                                - 
                                <small class="reports">{{$comment->reported}} reports</small>
                                <div class="date-rating">
                                    <div class="comment-date">
                                        {{date('d-m-Y', strtotime($comment->created_at))}}
                                    </div>
                                    @if($comment->rating != null)
                                    <div class="comment-rating">
                                        @for($i = 0 ; $i < floor($comment->rating->rating) ; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                        @if($comment->rating->rating > floor($comment->rating->rating) && $comment->rating->rating < ceil($comment->rating->rating))
                                        <i class="fa fa-star-half-empty"></i>
                                        @endif
                                        @for($i = 5 ; $i > ceil($comment->rating->rating) ; $i--)
                                        <i class="fa fa-star-o"></i>
                                        @endfor
                                    </div>
                                    @endif
                                </div>
                                <p class="comment-text">
                                    {{$comment->comment}}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="p-5 text-center text-muted">
                            Vous n'avez aucun commentaire.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/comments.js')}}"></script>
@endsection