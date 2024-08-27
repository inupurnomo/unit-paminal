@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Home')
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/fullcalendar/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-statistics.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-analytics.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-calendar.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
{{-- <script src="{{asset('assets/js/app-calendar-events.js')}}"></script> --}}
<script>
  /**
 * App Calendar Events
 */

'use strict';

let events = [
  {
    id: 1,
    url: '/dumas/show/1',
    title: 'Saksi 1',
    start: '2024-08-23',
    allDay: true,
    extendedProps: {
      calendar: 'Saksi'
    }
  }
];

</script>
<script src="{{asset('assets/js/app-calendar.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4">
  <!-- Gamification Card -->
  <div class="col-md-12">
    <div class="card h-100">
      <div class="d-flex align-items-end row">
        <div class="col-md-6 order-2 order-md-1">
          <div class="card-body">
            {{-- {{$jadwal}} --}}
            <h3 class="card-title pb-xl-2 h3 mb-4">Agenda Hari Ini</h3>
            <div>
              <h5>Undangan Saksi</h5>
              @foreach ($saksi as $s)
              <div class="my-2">
              • <a href="/dumas/show/{{ $s->dumas_id }}" target="_blank" rel="noopener noreferrer" title="Lihat Dumas">{{ $s->name }} - {{ $s->telephone }}</a>
              </div>
              @endforeach
              <hr />
              <h5>Undangan Terlapor</h5>
              @foreach ($terlapor as $t)
              <div class="my-2">
              • <a href="/dumas/show/{{ $t->dumas_id }}" target="_blank" rel="noopener noreferrer" title="Lihat Dumas">{{ $t->name }} - {{ $t->dumas->satker }}</a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-6 text-center text-md-end order-1 order-md-2">
          <div class="card-body pb-0 px-0 px-md-4 ps-0">
            <img src="{{asset('assets/img/illustrations/illustration-john-'.$configData['style'].'.png')}}" height="180" alt="View Profile" data-app-light-img="illustrations/illustration-john-light.png" data-app-dark-img="illustrations/illustration-john-dark.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Gamification Card -->

  <!-- Statistics Total Order -->
  <div class="col-sm-6 col-lg-6 mb-4">
    <div class="card card-border-shadow-success h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <i class="mdi mdi-book-multiple-outline mdi-36px"></i>
          </div>
          <h4 class="ms-1 mb-0 display-6">{{ $dumas_aktif }}</h4>
        </div>
        <p class="mb-0 text-heading">Total Dumas Aktif</p>
      </div>
    </div>
  </div>
  <!--/ Statistics Total Order -->

  <!-- Sessions line chart -->
  <div class="col-sm-6 col-lg-6 mb-4">
    <div class="card card-border-shadow-info h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
          <div class="avatar me-2">
            <i class="mdi mdi-book-minus mdi-36px"></i>
          </div>
          <h4 class="ms-1 mb-0 display-6">{{ $dumas_selesai }}</h4>
        </div>
        <p class="mb-0 text-heading">Total Dumas Selesai</p>
      </div>
    </div>
  </div>
  <!--/ Sessions line chart -->
</div>

<hr class="my-4" />

{{-- app calendar --}}
<div class="card app-calendar-wrapper">
  <div class="row g-0">
    <!-- Calendar Sidebar -->
    <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
      {{-- <div class="p-3 pb-2 my-sm-0 mb-3">
        <div class="d-grid">
          <button class="btn btn-primary btn-toggle-sidebar" data-bs-toggle="offcanvas" data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
            <i class="mdi mdi-plus me-1"></i>
            <span class="align-middle">Add Event</span>
          </button>
        </div>
      </div> --}}
      <div class="p-4">
        <!-- inline calendar (flatpicker) -->
        <div class="inline-calendar"></div>

        <hr class="container-m-nx my-4">

        <!-- Filter -->
        <div class="mb-4">
          <small class="text-small text-muted text-uppercase align-middle">Filter</small>
        </div>

        <div class="form-check form-check-secondary mb-3">
          <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked>
          <label class="form-check-label" for="selectAll">View All</label>
        </div>

        <div class="app-calendar-events-filter">
          <div class="form-check mb-3">
            <input class="form-check-input input-filter" type="checkbox" id="select-saksi" data-value="saksi" checked>
            <label class="form-check-label" for="select-saksi">Saksi</label>
          </div>
          <div class="form-check form-check-success mb-3">
            <input class="form-check-input input-filter" type="checkbox" id="select-terlapor" data-value="terlapor" checked>
            <label class="form-check-label" for="select-terlapor">Terlapor</label>
          </div>
          <div class="form-check form-check-info">
            <input class="form-check-input input-filter" type="checkbox" id="select-etc" data-value="etc" checked>
            <label class="form-check-label" for="select-etc">ETC</label>
          </div>
        </div>
      </div>
    </div>
    <!-- /Calendar Sidebar -->

    <!-- Calendar & Modal -->
    <div class="col app-calendar-content">
      <div class="card shadow-none border-0 ">
        <div class="card-body pb-0">
          <!-- FullCalendar -->
          <div id="calendar"></div>
        </div>
      </div>
      <div class="app-overlay"></div>
      <!-- FullCalendar Offcanvas -->
      <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar" aria-labelledby="addEventSidebarLabel">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form class="event-form pt-0" id="eventForm" onsubmit="return false">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Event Title" />
              <label for="eventTitle">Title</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                <option data-label="primary" value="Saksi" selected>Saksi</option>
                <option data-label="success" value="Terlapor">Terlapor</option>
                <option data-label="info" value="ETC">ETC</option>
              </select>
              <label for="eventLabel">Label</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="eventStartDate" name="eventStartDate" placeholder="Start Date" />
              <label for="eventStartDate">Start Date</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="eventEndDate" name="eventEndDate" placeholder="End Date" />
              <label for="eventEndDate">End Date</label>
            </div>
            <div class="mb-3">
              <label class="switch">
                <input type="checkbox" class="switch-input allDay-switch" />
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">All Day</span>
              </label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="url" class="form-control" id="eventURL" name="eventURL" placeholder="https://www.google.com" />
              <label for="eventURL">Event URL</label>
            </div>
            <div class="form-floating form-floating-outline mb-4 select2-primary">
              <select class="select2 select-event-guests form-select" id="eventGuests" name="eventGuests" multiple>
                <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
              </select>
              <label for="eventGuests">Add Guests</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="Enter Location" />
              <label for="eventLocation">Location</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
              <label for="eventDescription">Description</label>
            </div>
            <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4 gap-2">
              <div class="d-flex">
                <button type="submit" class="btn btn-primary btn-add-event me-sm-2 me-1">Add</button>
                <button type="reset" class="btn btn-outline-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
              </div>
              <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Calendar & Modal -->
  </div>
</div>
@endsection
