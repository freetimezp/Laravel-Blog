@include('admin.header')
@include('admin.sidebar')

<link rel="stylesheet" href="{{url('summernote/summernote-lite.min.css')}}">

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12 posts-page-add-button-block">
                <span style="font-size: 25px;">{{ucfirst($page_title)}}</span>
                <a href="{{url('admin/posts/add')}}">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Add post</button>
                </a>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($rows)
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$row->title}}</td>
                                <td>{{$row->category}}</td>
                                <td>{{$row->content}}</td>
                                <td><img src="{{url('uploads') . '/' . $row->image}}" alt="post" style="width:150px;"></td>
                                <td>{{date("jS M, Y", strtotime($row->created_at))}}</td>
                                <td>
                                    <a href="{{url('admin/posts/edit') . '/' . $row->id}}">
                                        <button class="btn btn-success"><i class="fa fa-edit"></i> Edit post</button>
                                    </a> |
                                    <a href="{{url('admin/posts/delete') . '/' . $row->id}}">
                                        <button class="btn btn-danger"><i class="fa fa-minus"></i> Delete post</button>
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

<script src="{{url('summernote/summernote-lite.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>

