@extends('../layouts.manager')

@section('content')
<div class="container" id="schedule">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('event', ['id' => $event->id])}}">{{str_limit($event->name, 50, '...')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Programme</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-3">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-9">
            <div class="card bg-success">
                <div class="card-header">Programme</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(count($event->schedules->where('deleted_at', null)) > 0)
                    <ul class="deletable-list mb-5">
                        <?php 
                        $currentDate = null;
                        $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
                        ?>
                        @foreach($event->schedules->where('deleted_at', null)->sortBy('time') as $schedule)
                        <?php $date = date("d M Y",strtotime($schedule->time)); ?>
                        @if($currentDate != $date)
                        <?php $currentDate = $date; ?>
                        <h5 class="day">{{date('d', strtotime($schedule->time))}} {{$months[ date('m', strtotime($schedule->time)) - 1 ]}} {{date('Y', strtotime($schedule->time))}}</h5>
                        @endif
                        <li>
                            <strong>{{date('H:i', strtotime($schedule->time))}} - </strong>
                            <span>
                                {{$schedule->title}}
                                @if($schedule->intervention != null)
                                <small> / 
                                    <a href="{{route('user', ['username' => $schedule->intervention->user->username])}}" target="_blank">
                                        {{$schedule->intervention->user->fullname}}
                                    </a>
                                </small>
                                @endif
                            </span>
                            <a href="{{route('delete-schedule', ['id' => $event->id, 'schedule_id' => $schedule->id])}}" class="close-icon"><i class="fa fa-close"></i></a>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    <form action="{{route('event-programme', ['id' => $event->id])}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <div class="row">
                            <?php
                                $begin = new DateTime( $event->start_timestamp ); 
                                $end = new DateTime( $event->end_timestamp );
                                $interval = new DateInterval('P1D'); 
                                $daterange = new DatePeriod($begin, $interval ,$end);
                                $dates = "";
                                foreach($daterange as $date){ 
                                    $dates .= $date->format("m/d/Y") . "-"; 
                                }
                            ?>
                            <input type="hidden" value="{{$dates}}" class="valid_dates">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Date *</strong></label>
                                    <input type="text" class="form-control datetimepicker" name="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Heure *</strong></label>
                                    <input type="time" class="form-control" name="time">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Titre *</strong></label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Intervenant</strong></label>
                                    <select name="intervenant" class="form-control">
                                        <option value="0" selected disabled>Choisir un intervenant</option>
                                        @foreach($event->interventions as $i)
                                        <option value="{{$i->user_id}}">{{title_case($i->user->fullname)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><strong>Description</strong></label>
                                    <textarea name="description" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <p>Les informations suivies d'une * sont à saisir obligatoirement.</p>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success pull-right">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/schedule.js')}}"></script>
@endsection