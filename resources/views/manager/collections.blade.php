@extends('../layouts.manager', [
        'pending_events' => $pending_events,
        'current_page' => 'Collections'
    ])

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <div class="alert-body">
            <p><strong>Veuillez corriger les erreurs suivantes: </strong></p>
            <ul style="margin:0;padding:0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>  
    @endif
    <div class="card bg-success mb-3">
        <div class="card-header">
            Ajouter une collection
            <a class="float-right" data-toggle="collapse" href="#addCollection" aria-expanded="false" aria-controls="addCollection">
                <span class="badge badge-light text-muted" style="line-height:9px">+</span>
            </a>
        </div>
        <div class="collapse" id="addCollection">
            <div class="card-body">
                <form action="{{route('add-collection')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><strong>Nom: *</strong></label>
                                <input type="text" class="form-control" name="name"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><strong>Image:</strong></label>
                                <input type="file" class="form-control" name="image"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><strong>Description</strong></label>
                                <textarea name="description" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success btn-sm" type="submit">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
    
    <div id="list">
        <div class="row collections-list">
            @foreach($collections as $c)
            <div class="col-md-4">
                <a href="{{route('collection', ['id' => $c->id,'slug' => $c->slug])}}" class="collection">
                    <div class="image">
                        @if($c->image != null)
                        <img src="{{asset('storage/images/manager/collections/' . $c->image)}}" alt="">
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink" height="512px" version="1.1" viewBox="0 0 32 32" width="512px"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#929292" id="icon-65-document-image"><path d="M22,24.0457281 L22,18 L11,18 L11,25 L11,25 L13.5,23 L14.9579388,24.2496618 L18.5930302,21 L22,24.0457281 L22,24.0457281 L22,24.0457281 Z M19,3 L9.0085302,3 C7.8992496,3 7,3.89833832 7,5.00732994 L7,27.9926701 C7,29.1012878 7.89092539,30 8.99742191,30 L24.0025781,30 C25.1057238,30 26,29.1090746 26,28.0025781 L26,11 L21.0059191,11 C19.8980806,11 19,10.1132936 19,9.00189865 L19,3 L19,3 Z M20,3 L20,8.99707067 C20,9.55097324 20.4509752,10 20.990778,10 L26,10 L20,3 L20,3 Z M10,17 L10,27 L23,27 L23,17 L10,17 L10,17 Z M14,21 C14.5522848,21 15,20.5522848 15,20 C15,19.4477152 14.5522848,19 14,19 C13.4477152,19 13,19.4477152 13,20 C13,20.5522848 13.4477152,21 14,21 L14,21 Z" id="document-image"/></g></g></svg>
                        @endif
                    </div>
                    <div class="name">{{title_case($c->name)}}</div>
                    <p class="description">
                        {{str_limit($c->description, 200, '...')}}
                    </p>
                    @if($c->events != null)
                    <div class="events-count">
                        {{count(unserialize($c->events))}}
                    </div>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/list.js')}}"></script>
@endsection