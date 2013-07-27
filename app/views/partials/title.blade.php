@if (isset($page))
    @if ($page->show_title == true)
        <div class="page-header">
            <h1>
                @section('title') 
                @show
            </h1>
        </div>
    @endif
@else
    <div class="page-header">
        <h1>
            @section('title') 
            @show
        </h1>
    </div>
@endif
