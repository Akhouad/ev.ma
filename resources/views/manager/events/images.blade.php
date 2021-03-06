@extends('../layouts.manager', ['current_page' => 'Information générales'])

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/locales/fr.js"></script>
@endsection

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

    <div class="row">
        <div class="col-md-3 col-sm-2">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-md-9 col-sm-10">
            <div class="card bg-success" id="images">
                <div class="card-header">Album photo</div>
                <div class="card-body">
                    <ul class="images-list">
                        <li>
                            <div class="upload-file">
                                <form action="{{route('event-images', ['id' => $event->id])}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="input">
                                        <span class="plus" @click="resetFiles($event)">+</span>
                                        <input type="file" ref="file_input" name="images[]" multiple @change="fileChosen($event)">
                                        <span class="files" v-cloak v-text="files.join(',').substring(0, 50)">
                                            <span v-if="files.join(',').length > 0" v-cloak>...</span>
                                        </span>
                                    </div>
                                    <button :class="{'active': files.length > 0}" type="submit">Ajouter</button>
                                </form>
                            </div>
                            <div class="file-actions dropdown">
                                <form action="{{route('delete-image', ['id' => $event->id])}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="images" ref="deleting_files">
                                    <button :class="{'active': deleting_files.length > 0}" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </li>
                        @if(count($event->images) > 0)
                            @foreach($event->images->where('deleted_at', null) as $image)
                            <li>
                                <a href=""><img src="{{asset('storage/images/manager/events/' . $image->file)}}" alt=""></a>
                                <div class="checkbox-fn" data-id="{{$image->id}}">
                                    <label for="">
                                        <input type="checkbox">
                                    </label>
                                </div>
                            </li>
                            @endforeach  
                        @endif
                    </ul> 
                    <form action="{{route('event-images', ['id' => $event->id])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!-- <div class="file-loading">
                            <input id="images" name="input-freqd-3[]" multiple type="file" accept="image/*">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-block btn-success btn-submit"><i class="fa fa-upload"></i> Submit</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/images.js')}}"></script>
@endsection