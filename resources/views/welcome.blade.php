@extends('public.base')
@section('head')
<script type="text/javascript" src="{{ URL::asset('js/progressbar.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
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
    <form class="flex items-center" method="POST" enctype="multipart/form-data" action="/check" id="myForm">
        @csrf
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="sourceUpload" name="source" accept=".png, .jpeg" />
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
                <input type='file' id="targetUpload" name="target" accept=".png, .jpeg" />
                <label for="targetUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="targetPreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                </div>
            </div>
        </div>
    </form>
    <div class="flex flex-row" style="margin-left: 17%">
      <div class="m-2">
        <label id="similar-label" class="hidden text-xl font-bold text-center">Similarity</label>
        <div id="similarity" class="chart-container"></div>
      </div>
      <div class="m-2">
        <label id="conf-label" class="hidden text-xl font-bold text-center">Confidence</label>
        <div id="confidence" class="chart-container"></div>
      </div>
    </div>
</div>

@endsection


@section('script')
<script type="text/javascript">

// function barTrigger(container, number){
//   var bar = new ProgressBar.SemiCircle(container, {
//     strokeWidth: 6,
//     color: '#FFEA82',
//     trailColor: '#eee',
//     trailWidth: 1,
//     easing: 'easeInOut',
//     duration: 1400,
//     svgStyle: null,
//     text: {
//       value: '',
//       alignToBottom: false
//     },
//     from: {color: '#FFEA82'},
//     to: {color: '#ED6A5A'},
//     // Set default step function for all animate calls
//     step: (state, bar) => {
//       bar.path.setAttribute('stroke', state.color);
//       var value = Math.round(bar.value() * number);
//       if (value === 0) {
//         bar.setText('');
//       } else {
//         bar.setText(value+"%");
//       }

//       bar.text.style.color = state.color;
//     }
//   });
//   bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
//   bar.text.style.fontSize = '2rem';

//   bar.animate(1.0);  // Number from 0.0 to 1.0
// }

function barTrigger(id, number){
  var percent = number;

  var ratio = percent / 100;

  var pie = d3.layout
    .pie()
    .value(function(d) {
      return d;
    })
    .sort(null);

  var w = 300,
    h = 300;

  var outerRadius = w / 2 - 10;
  var innerRadius = 85;

  var color = ["#ececec", "#2779bd", "#888888"];

  var colorOld = "#F00";
  var colorNew = "#0F0";

  var arc = d3.svg
    .arc()
    .innerRadius(innerRadius)
    .outerRadius(outerRadius)
    .startAngle(0)
    .endAngle(Math.PI);

  var arcLine = d3.svg
    .arc()
    .innerRadius(innerRadius)
    .outerRadius(outerRadius)
    .startAngle(0);

  var svg = d3
    .select(id)
    .append("svg")
    .attr({
      width: w,
      height: h,
      class: ""
    })
    .append("g")
    .attr({
      transform: "translate(" + w / 2 + "," + h / 2 + ")"
    });

  var path = svg
    .append("path")
    .attr({
      d: arc,
      transform: "rotate(-90)"
    })
    .attr({
      "stroke-width": "1",
      stroke: "#FFFFFF"
    })
    .style({
      fill: "#FFFFFF"
    });

  var pathForeground = svg
    .append("path")
    .datum({ endAngle: 0 })
    .attr({
      d: arcLine,
      transform: "rotate(-90)"
    })
    .style({
      fill: function(d, i) {
        return color[1];
      }
    });

  var middleCount = svg
    .append("text")
    .datum(0)
    .text(function(d) {
      return d;
    })
    .attr({
      class: "font-bold text-xl",
      "text-anchor": "middle",
      dy: 0,
      dx: 5
    })
    .style({
      fill: d3.rgb("#000000"),
    });

  var oldValue = 0;
  var arcTween = function(transition, newValue, oldValue) {
    transition.attrTween("d", function(d) {
      var interpolate = d3.interpolate(d.endAngle, Math.PI * (newValue / 100));

      var interpolateCount = d3.interpolate(oldValue, newValue);

      return function(t) {
        d.endAngle = interpolate(t);
        middleCount.text(Math.floor(interpolateCount(t)) + "%");

        return arcLine(d);
      };
    });
  };

  pathForeground
    .transition()
    .duration(750)
    .ease("cubic")
    .call(arcTween, percent, oldValue);

}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

$('#myForm').submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: '{{ url('api/check') }}',
        type: 'POST',              
        data: formData,
        processData: false,
        contentType: false,
        success: function(result)
        { 
            // barTrigger(container1, result['similarit'])
            if(result['match'].length === 0){
              var confidence = result['source']['Confidence'];
              var match = 0;
              barTrigger("#similarity", match);
              barTrigger("#confidence", confidence);
              $("#similar-label").removeClass('hidden');
              $("#conf-label").removeClass('hidden');
            } else if(result['match'].length > 0) {
              var confidence = result['match'][0]['Face']['Confidence'];
              var match = result['match'][0]['Similarity'];
              barTrigger("#similarity", match);
              barTrigger("#confidence", confidence);
              $("#similar-label").removeClass('hidden');
              $("#conf-label").removeClass('hidden');
            }
        },
        error: function(data)
        {
            console.log("error>>> ", data.responseText);
        }
    });

});
</script>
@endsection