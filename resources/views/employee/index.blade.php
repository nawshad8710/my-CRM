@extends('employee.layouts.app')

@section('title', 'Dashboard')

@push('css')
    <!-- FullCalendar -->
    <link href="{{ asset('assets/vendor/fullcalendar-3.10.0/fullcalendar.css') }}" rel="stylesheet" media="all" />
    <style type="text/css">
        .fc-event, .fc-event:hover {
            color: #fff !important;
            text-decoration: none;
        }
        .fc-day-grid-event .fc-content {
            white-space: pre-wrap;
        }
    </style>
@endpush

@section('content')
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ count($completed_projects) }}</h2>
                                                <span>Completed Projects</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ count($running_projects) }}</h2>
                                                <span>Running Projects</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="au-card">
                                <div id="calendar"></div>
                              </div>
                            </div><!-- .col -->
                        </div>


                        <!-- Copyright Section -->
                        @include('employee.layouts.partials.copyright')
                        
                    </div>
                </div>
            </div>
@endsection

@push('js')
<!-- full calendar requires moment along jquery which is included above -->
<script src="{{ asset('assets/vendor/fullcalendar-3.10.0/lib/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar-3.10.0/fullcalendar.js') }}"></script>

<script type="text/javascript">
$(function() {
  // for now, there is something adding a click handler to 'a'
  var tues = moment().day(2).hour(19);

  // build trival night events for example data
  var events = [];

  var pending_projects = [];

  var projects = {!! json_encode($running_projects) !!};

  var url = window.location.origin + '/employee/assignment/list';

  for(var i = 0; i < projects.length; i++){
    var n = projects[i];
    //console.log("isoString: " + n.toISOString());
    pending_projects.push({
      title: n.project_title,
      start: n.deadline,
      allDay: false,
      url: url
    });
  }

  // setup a few events
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    events: events.concat(pending_projects)
  });
});
    </script>
    
@endpush