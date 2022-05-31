@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ucfirst($page_title)}}</h2>
            </div>

            @if ($row)
                <form class="category-form-delete col-lg-10" enctype="multipart/form-data" method="post">
                    @csrf
                    @if ($errors)
                        @foreach($errors->all() as $error)
                            <div class="text-danger alert-danger">->> {{$error}}</div>
                        @endforeach
                    @endif

                    <div class="form-group row post-form-block">
                        <label for="delete_user_name">Name:</label>
                        <input disabled type="text" class="form-control" name="user" placeholder="Category" id="delete_user_name" value="{{$row->name}}">
                    </div>

                    <div class="form-group row post-form-block">
                        <label for="delete_user_email">Email:</label>
                        <input disabled type="text" class="form-control" name="email" placeholder="Email" id="delete_user_email" value="{{$row->email}}">
                    </div>

                    @if ($row->id == 1)
                        <p style="margin-left: 20px; font-size: 20px; color: red;">You can not delete this user!</p>
                    @else
                        <p>Are you sure you want to delete this user?</p>
                        <div class="">
                            <input class="btn btn-primary" type="submit" value="Delete">
                            <a href="{{url('admin/users')}}">
                                <button class="btn btn-primary" type="button" style="background: grey;">Cancel</button>
                            </a>
                        </div>
                    @endif
                </form>
            @else
                <p style="margin-left: 20px; font-size: 20px; color: red;">No such user found in database!</p>
            @endif

        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->

@include('admin.footer')







