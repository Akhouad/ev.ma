@extends('../layouts.manager')

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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('event', ['id' => $event->id])}}">{{str_limit($event->name, 50, '...')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Information générales</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-3">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-9">
            <div class="card bg-success">
                <div class="card-header">Album photo</div>
                <div class="card-body">
                    <form action="{{route('event-images', ['id' => $event->id])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="file-loading">
                            <input id="images" name="input-freqd-3[]" multiple type="file" accept="image/*">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-block btn-success btn-submit"><i class="fa fa-upload"></i> Submit</button>
                        <!-- <div class="form-group">
                            <label for="">Images</label>
                            <input id="images" multiple type="file" name="images[]" class="file" data-preview-file-type="text" >
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/images.js')}}"></script>
<script>
    $("#images").fileinput({
        theme: "fa",
        // uploadUrl: "{{route('event-images', ['id' => $event->id])}}",
        maxFileCount: 20,
        multiple: true,
        allowedFileExtensions: ['jpg', 'gif', 'png'],
        maxFileSize: 500,
        showUpload: false,
        showRemove: false,
        required: true,
        fileActionSettings: {
            removeClass: 'btn btn-outline-danger',
            showZoom: false,
            showDrag: false
        },
        layoutTemplates:{
            actionDelete: "<a href=\"{{route('delete-image', ['id'=>$event->id])}}\" class=\"{removeClass}\" title=\"Supprimer l'image\"{dataUrl}{dataKey} style='height:30px!important;line-height:30px!important;padding:0 10px!important'>{removeIcon}</a>\n",
        },
        initialPreview: [
            @if(count($event->images) > 0)
            @foreach($event->images as $image)
            "<img src=\"{{asset('storage/images/manager/events/' . $image->file)}}\" class='file-preview-image' style='max-width:100%;max-height:200px;'>",
            @endforeach
            @endif 
        ],
        initialPreviewConfig: [
            @if(count($event->images) > 0)
            @foreach($event->images as $image)
            "{caption: '',  url:\"{{route('delete-image', ['id'=>$event->id])}}\", key:{{$image->id}} ",
            @endforeach
            @endif 
        ],
        uploadExtraData: function() {
            return {
                event_id: {{$event->id}},
                organizer_id: {{$event->organizer_id}}
            };
        }
    });
    $(".btn-submit").on("click", function() {
        $("#images").fileinput('upload');
    });
</script>
@endsection