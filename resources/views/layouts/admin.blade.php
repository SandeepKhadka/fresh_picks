@include('admin.section.header')

<div class="page-wrapper">

    @include('admin.section.topnav')

    @include('admin.section.sidebar')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->

        @include('admin.section.notify')
        @yield('main-content')

        <!-- END PAGE CONTENT-->

        @include('admin.section.footer')
    </div>
</div>

@include('admin.section.scripts')
