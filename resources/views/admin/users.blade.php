@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12 posts-page-add-button-block">
                <span style="font-size: 25px;">{{ucfirst($page_title)}}</span>
                <a href="{{url('signup')}}">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Add user</button>
                </a>
            </div>

            <table class="table table-striped table-hover users">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @if ($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{date("jS M, Y", strtotime($row->updated_at))}}</td>
                            <td>
                                <a href="{{url('admin/users/edit') . '/' . $row->id}}">
                                    <button class="btn btn-success"><i class="fa fa-edit"></i> Edit user</button>
                                </a> |
                                <a href="{{url('admin/users/delete') . '/' . $row->id}}">
                                    <button class="btn btn-danger"><i class="fa fa-minus"></i> Delete user</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->

@include('admin.footer')



