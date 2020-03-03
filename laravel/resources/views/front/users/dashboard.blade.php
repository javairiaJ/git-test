@extends('front.layouts.app')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}
</style>



<!-- <div class="divider" style=" background-color:  #cd0011;
  height: 5px;  margin-top: -22px">
  </div> -->
<div class="w3-content w3-display-container" style="position: absolute;
  left:4%;
  top:118px;">
   <img class="mySlides" src="front\images\Capture4.jpg" style=" width: 1100px;
  height: 580px;">
  <img class="mySlides" src="front\images\Capture5.jpg" style=" width: 1100px;
  height: 580px;">
  <img class="mySlides" src="front\images\Capture3.jpg" style=" width: 1100px;
  height: 580px;">
   <img class="mySlides" src="front\images\Capture1.jpg" style=" width: 1100px;
  height: 580px;">
   <img class="mySlides" src="front\images\Capture2.jpg" style=" width: 1100px;
  height: 580px;">
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
     <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(5)"></span>
  </div>
</div>

















<div class="vl" style=" max-width: 100px;
  border-left: 1px solid #E78E0A;
height: 630px;
position: absolute;
left: 80%;
margin-left: -3px;
top: 98px;"></div>

<div class="java" style=" width: 250px; left: 82%; position: absolute;
   background-color: #DAA520;
height: 630px; top: 98px;">
  
  <img src="{{ asset('front\images\lj.jpg') }}" alt="Avatar woman" style="width: 250px; height: 630px;">
</div>
<h3 style="color: #ffffff; position: absolute; left: 83.5%; top: 37%; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; ">My Profile</h3>
<h4 style="color: #ffffff; position: absolute; left: 83.5%; top: 45%; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;"><b>{{Auth::user()->firstName.' '.Auth::user()->lastName}}</b></h4>
<h4 style="color: #ffffff; position: absolute; left: 83.5%; top: 48%; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; ">{{Auth::user()->designation}}</h4>
<h4 style=" color: #ffffff;position: absolute; left: 83.5%; top: 51%; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">{{Auth::user()->email}}</h4>

<!-- <script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}
</script> -->


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}

var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 7000); // Change image every 2 seconds
}


</script>



@endsection
