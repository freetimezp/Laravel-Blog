@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ucfirst($page_title)}}</h2>
            </div>

            @if ($row)
                <form class="category-form-edit col-lg-10" enctype="multipart/form-data" method="post">
                    @csrf
                    @if ($errors)
                        @foreach($errors->all() as $error)
                            <div class="text-danger alert-danger">->> {{$error}}</div>
                        @endforeach
                    @endif
                    <div class="form-group row post-form-block">
                        <label for="add_category_title">Category:</label>
                        <input type="text" class="form-control" name="category" placeholder="Category" id="add_category_title" value="{{$row->category}}">
                    </div>

                    <div class="posts-page-edit-button-block">
                        <input class="btn btn-primary" type="submit" value="Save">
                        <a href="{{url('admin/categories')}}">
                            <button class="btn btn-primary" type="button" style="background: grey;">Cancel</button>
                        </a>
                    </div>
                </form>
            @else
                <p style="margin-left: 20px; font-size: 20px; color: red;">No such category found in database!</p>
            @endif
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->

@include('admin.footer')





