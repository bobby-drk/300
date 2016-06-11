<div id="copyright" class="copyright text-center vertical_offset_xl">&copy; Copyright {{date('Y')}} :: {{ config('app.site_name') }}
    @if (Auth::check())
        - <a href="/logout">logout</a>
    @endif
</div>