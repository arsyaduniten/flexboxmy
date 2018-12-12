@extends('public.base')
@section('head')
<style type="text/css">
body {
  background: whitesmoke;
  font-family: 'Open Sans', sans-serif;
}
.container {
  max-width: 960px;
  margin: 30px auto;
  padding: 20px;
}
h1 {
  font-size: 20px;
  text-align: center;
  margin: 20px 0 20px;
}
h1 small {
  display: block;
  font-size: 15px;
  padding-top: 8px;
  color: gray;
}
.avatar-upload {
  position: relative;
  max-width: 205px;
  margin: 50px auto;
}
.avatar-upload .avatar-edit {
  position: absolute;
  right: 12px;
  z-index: 1;
  top: 10px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\f040";
  font-family: 'FontAwesome';
  color: #757575;
  position: absolute;
  top: 10px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 192px;
  height: 192px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

</style>

@endsection

@section('content')
<div class="container">
    <h1>Image Recognition
        <small>by Azad</small>
    </h1>
    <form class="flex items-center" method="POST" enctype="multipart/form-data" action="/check">
        @csrf
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="sourceUpload" name="source" accept=".png, .jpg, .jpeg" />
                <label for="sourceUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="sourcePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                </div>
            </div>
        </div>
        <button class="px-4 py-2 bg-blue-dark text-white rounded-full shadow-lg font-bold" type="submit">Check</button>
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="targetUpload" name="target" accept=".png, .jpg, .jpeg" />
                <label for="targetUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="targetPreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                </div>
            </div>
        </div>
    </form>
</div>

@endsection


@section('script')
<script type="text/javascript">
function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(id).css('background-image', 'url('+e.target.result +')');
            $(id).hide();
            $(id).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
        console.log(input.files[0]);
    }
}
$("#sourceUpload").change(function() {
    readURL(this, "#sourcePreview");
});

$("#targetUpload").change(function() {
    readURL(this, "#targetPreview");
});
</script>
@endsection