@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ucfirst($page_title)}}</h2>
            </div>

            <form class="post-form-delete col-lg-10" enctype="multipart/form-data" method="post">
                @csrf
                @if ($errors)
                    @foreach($errors->all() as $error)
                        <div class="text-danger alert-danger">->> {{$error}}</div>
                    @endforeach
                @endif

                <div class="form-group row post-form-block">
                    <label for="add_post_title">Title:</label>
                    <input disabled type="text" class="form-control" name="title" placeholder="Title" id="add_post_title" value="{{$row->title}}">
                </div>
                <div class="form-group row post-form-block">
                    <label>Image:</label>
                    <img src="{{url('uploads') . '/' . $row->image}}" alt="edit post">
                </div>

                <p>Are you sure you want to delete this post?</p>
                <div class="">
                    <input class="btn btn-primary" type="submit" value="Delete">
                    <a href="{{url('admin/posts')}}">
                        <button class="btn btn-primary" type="button" style="background: grey;">Cancel</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->

@include('admin.footer')





