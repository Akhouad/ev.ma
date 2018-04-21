@extends('../layouts.manager')

@section('content')
<div class="container" id="schedule">
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
            <form action="{{route('event-programme', ['id' => $event->id])}}" method="post">
                <div class="card bg-success">
                    <div class="card-header">Programme</div>
                    <div class="card-body">
                        
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Date *</strong></label>
                                    <input type="text" class="form-control datetimepicker" :class="{'border-danger': formErrors.date.error}" ref="date">
                                    <div class="alert alert-danger mt-2" v-if="formErrors.date.error" v-text="formErrors.date.message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Heure *</strong></label>
                                    <input type="time" class="form-control" :class="{'border-danger': formErrors.heure.error}" ref="heure">
                                    <div class="alert alert-danger mt-2" v-if="formErrors.heure.error" v-text="formErrors.heure.message"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Titre *</strong></label>
                                    <input type="text" class="form-control" :class="{'border-danger': formErrors.titre.error}" ref="titre">
                                    <div class="alert alert-danger mt-2" v-if="formErrors.titre.error" v-text="formErrors.titre.message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Intervenant</strong></label>
                                    <select name="" id="" class="form-control" ref="intervenant">
                                        <option value="0" selected disabled>Choisir un intervenant</option>
                                        @foreach($intervenants as $i)
                                        <option value="{{$i->user_id}}">{{$i->user->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><strong>Description</strong></label>
                                    <textarea name="" rows="5" class="form-control" ref="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p>Les informations suivies d'une * sont à saisir obligatoirement.</p>
                            </div>
                            <div class="col-md-4">
                                <a href="" class="btn btn-success pull-right" @click="addSchedule($event)">Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/schedule.js')}}"></script>
@endsection