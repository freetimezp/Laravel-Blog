@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ucfirst($page_title)}}</h2>
            </div>

            @if ($row)
                <form class="user-form-edit col-lg-10" enctype="multipart/form-data" method="post">
                    @csrf
                    @if ($errors)
                        @foreach($errors->all() as $error)
                            <div class="text-danger alert-danger">->> {{$error}}</div>
                        @endforeach
                    @endif
                    <div class="form-group row post-form-block">
                        <label for="edit_user_name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" id="edit_user_name" value="{{$row->name}}">
                    </div>

                    <div class="form-group row post-form-block mb-2">
                        <label for="edit_user_email">Email:</label>
                        <input type="text" name="email" id="edit_user_email" value="{{$row->email}}" placeholder="Email">
                    </div>

                    <div class="form-group row post-form-block mb-2">
                        <label for="edit_user_pass">New pass:</label>
                        <input type="text" name="password" id="edit_user_pass" value="" placeholder="Password">
                    </div>

                    @if ($row->id == 1)
                        <p style="margin-left: 20px; font-size: 20px; color: red;">You can not edit this user!</p>
                    @else
                        <div class="posts-page-edit-button-block">
                            <input class="btn btn-primary" type="submit" value="Save">
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




