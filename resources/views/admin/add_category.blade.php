@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ucfirst($page_title)}}</h2>
            </div>

            <form class="post-form-add col-lg-10" enctype="multipart/form-data" method="post">
                @csrf
                @if ($errors)
                    @foreach($errors->all() as $error)
                        <div class="text-danger alert-danger">->> {{$error}}</div>
                    @endforeach
                @endif
                <div class="form-group row post-form-block">
                    <label for="add_category_title">Category:</label>
                    <input type="text" class="form-control" name="category" placeholder="Category" id="add_category_title" value="{{old('category')}}">
                </div>

                <input class="btn btn-primary" type="submit" value="Create">
            </form>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->



