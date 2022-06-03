@include('admin.header')
@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12 posts-page-add-button-block">
                <span style="font-size: 25px;">{{ucfirst($page_title)}}</span>
                <a href="{{url('admin/categories/add')}}">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Add category</button>
                </a>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @if ($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td>{{$row->category}}</td>
                            <td>{{date("jS M, Y", strtotime($row->updated_at))}}</td>
                            <td>
                                <a href="{{url('admin/categories/edit') . '/' . $row->id}}">
                                    <button class="btn btn-success"><i class="fa fa-edit"></i> Edit category</button>
                                </a> |
                                <a href="{{url('admin/categories/delete') . '/' . $row->id}}">
                                    <button class="btn btn-danger"><i class="fa fa-minus"></i> Delete category</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

            @include('pagination')

        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->

@include('admin.footer')


