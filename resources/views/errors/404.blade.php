@extends('../layouts.errors', [
    "title" => $exception->getMessage()  
])

@section('content')
<h4 class="text-center p-5">{{$exception->getMessage()}}</h4>
@endsection