@include('header')

<div class="container-fluid">
    <div class="row fh5co-post-entry">

        @foreach ($rows as $row)
            <article class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-12 animate-box">
                <figure>
                    <a href="{{url('single')}}">
                        <img src="{{url($row->image)}}" alt="Image" class="img-responsive">
                    </a>
                </figure>
                <span class="fh5co-meta"><a href="{{url('single')}}p">{{$row->category}}</a></span>
                <h2 class="fh5co-article-title"><a href="{{url('single')}}">{{ucfirst($row->title)}}</a></h2>
                <span class="fh5co-meta fh5co-date">{{date("jS M, Y", strtotime($row->updated_at))}}</span>
            </article>
        @endforeach

    </div>
</div>

@include('footer')
