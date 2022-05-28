@include('admin.header')
@include('admin.sidebar')

<link rel="stylesheet" href="{{url('summernote/summernote-lite.min.css')}}">

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ucfirst($page_title)}}</h2>
            </div>

            <form class="post-form-add col-lg-10" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group row post-form-block">
                    <label for="add_post_title">Title:</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" id="add_post_title">
                </div>

                <div class="form-group row post-form-block">
                    <label for="add_post_image">Image:</label>
                    <input type="file" class="form-control" name="file" id="add_post_image">
                </div>

                <div class="form-group row post-form-block">
                    <label for="add_post_select">Category:</label>
                    <select name="category_id" class="post-form-add-select form-control" id="add_post_select">
                        <option>--Select a category--</option>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </div>

                <div class="form-group row post-form-block">
                    <label for="summernote">Content:</label>
                    <textarea name="content" id="summernote"></textarea>
                </div>

            </form>
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


