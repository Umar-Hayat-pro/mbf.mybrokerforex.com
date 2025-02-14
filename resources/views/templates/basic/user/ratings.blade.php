
@extends($activeTemplate . 'layouts.master')<!-- Adjust this based on your layout structure -->

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
             <!-- Use the variable here -->
            <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://rankings.mbfx.co/widgets/ratings?widgetKey=social_platform_ratings&theme=light&lang=en" class="w-full h-screen" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection