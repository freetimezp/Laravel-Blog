@include('header')

<div class="container-fluid">
    <div class="row fh5co-post-entry">

        @foreach ($rows as $row)
            <article class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-12 animate-box">
                <a href="{{url('single/' . $row->slag)}}">
                    <figure>
                            <img src="{{url($row->image)}}" alt="Image" class="img-responsive">
                    </figure>
                    <span class="fh5co-meta">{{$row->category}}</span>
                    <h2 class="fh5co-article-title" style="min-height: 75px;">{{ucfirst($row->title)}}</h2>
                    <span class="fh5co-meta fh5co-date">{{date("jS M, Y", strtotime($row->updated_at))}}</span>
                </a>
            </article>
        @endforeach

        <span class="clearfix"></span>

        <div style="display: block; text-align: center; width: 100%;">
            @include('pagination')
        </div>

    </div>
</div>

@include('footer')
