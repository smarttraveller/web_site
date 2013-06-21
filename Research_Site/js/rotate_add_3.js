

  var currentImage_3 = -1;
  
  var currentText_3 = -1;
  
  function RotateImages_3()
  {
    var a_3 = new Array("ads/add_3/galadari.jpg","ads/add_3/galle_face_hotel.jpg","ads/add_3/hilton.jpg", "ads/add_3/taj_samudra.jpg");
	
   // var c = new Array("url1", "url2", "url3", "url4");
    var b_3 = document.getElementById('adds_3');
	
   // var d = document.getElementById('imageurl');

    currentImage_3++;

    if(currentImage_3>= a_3.length)
      currentImage_3=0;

    b_3.src = a_3[currentImage_3];
  //  d.href = c[currentImage];

    rotator_3 = window.setTimeout("RotateImages_3(" + (currentImage_3+1) + ")",3000);
	
  }
  
	  /*var text = new Array("Yala National Park","Jetwing Vil Uyana, Sigiriya. Call : +9466 4 923586","Dalada Maligawa, Kandy", "Dunhida Water Fall", "Amaya Lake, Dambulla. Call : +9466 4 461500");
	  
	  
	  var maxSlogans = text.length-1;
	  var current = 0;
	  function rotateText() {
	  if (++current > maxSlogans) current = 0;
	  document.getElementById("textDiv").innerHTML = '<b>'+text[current]+'</b>';
	  window.setInterval("rotateText()", 3000);
	  
	  }*/
	  	  
 	  function RotateText_3()
	  {
		  var text_3 = new Array("Galadari Hotel, Colombo 1. Call : +9411 2 544544","Galle Face Hotel, Colombo. Call : +9411 2 541010","Hilton Hotel, Colombo. Call : +9411 2 492492", "Taj Samudra Hotel, Colombo 3. Call : +9411 2 446622");
		  
		  //var text2 = document.getElementById('textDiv');
	  
	  currentText_3++;
	  
	  if(currentText_3>= text_3.length-1)
      currentText_3 = -1;

   	  //text2.src = text[currentText];
  	  //  d.href = c[currentImage];
	  
	  document.getElementById("textDiv_3").innerHTML = '<b>'+text_3[currentText_3+1]+'</b>';

   	  rotator_3 = window.setTimeout("RotateText_3()",3000);
	  }

  function StopRotation_3()
  {
    window.clearTimeout(rotator_3);
	//window.clearTimeout(rotator_2);
  }

  RotateImages_3();
  RotateText_3();
  //rotateText();

