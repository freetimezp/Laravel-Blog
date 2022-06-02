@include('header')

<div class="container-fluid">
    <div class="row fh5co-post-entry single-entry">
        <article
            class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
            <figure class="animate-box">
                <img src="{{url('uploads' . '/' . $row->image)}}" alt="Image" class="img-responsive" style="margin: 0 auto;">
            </figure>
            <span class="fh5co-meta animate-box"><a href="{{url('single')}}">{{$category->category}}</a></span>
            <h2 class="fh5co-article-title animate-box">
                <a href="{{url('single')}}">{{$row->title}}</a></h2>
            <span class="fh5co-meta fh5co-date animate-box">{{date("jS M, Y", strtotime($row->updated_at))}}</span>

            <div
                class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-left content-article">
                <div class="row">
                    <div class="col-lg-8 cp-r animate-box">
                        <?=$row->content;?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>

@include('footer')
