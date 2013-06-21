

  var currentImage_2 = -1;
  
  var currentText_2 = -1;
  
  function RotateImages_2()
  {
    var a_2 = new Array("ads/add_2/anuradhapura.jpg","ads/add_2/arugambay.jpg","ads/add_2/cinnamon_grand.jpg", "ads/add_2/hikkaduwa.jpg", "ads/add_2/sigiriya.jpg");
	
   // var c = new Array("url1", "url2", "url3", "url4");
    var b_2 = document.getElementById('adds_2');
	
   // var d = document.getElementById('imageurl');

    currentImage_2++;

    if(currentImage_2>= a_2.length)
      currentImage_2=0;

    b_2.src = a_2[currentImage_2];
  //  d.href = c[currentImage];

    rotator_2 = window.setTimeout("RotateImages_2(" + (currentImage_2+1) + ")",3000);
	
  }
  
	  /*var text = new Array("Yala National Park","Jetwing Vil Uyana, Sigiriya. Call : +9466 4 923586","Dalada Maligawa, Kandy", "Dunhida Water Fall", "Amaya Lake, Dambulla. Call : +9466 4 461500");
	  
	  
	  var maxSlogans = text.length-1;
	  var current = 0;
	  function rotateText() {
	  if (++current > maxSlogans) current = 0;
	  document.getElementById("textDiv").innerHTML = '<b>'+text[current]+'</b>';
	  window.setInterval("rotateText()", 3000);
	  
	  }*/
	  	  
 	  function RotateText_2()
	  {
		  var text_2 = new Array("Anuradhapura ancient Monuments","Arugambay Beach Surfing","Cinnamon Grand Hotel, Colombo. Call : +9411 2 437437", "Hikkaduwa Beach", "Sigiriya Ancient Palace");
		  
		  //var text2 = document.getElementById('textDiv');
	  
	  currentText_2++;
	  
	  if(currentText_2 >= text_2.length-1)
      currentText_2 = -1;

   	  //text2.src = text[currentText];
  	  //  d.href = c[currentImage];
	  
	  document.getElementById("textDiv_2").innerHTML = '<b>'+text_2[currentText_2+1]+'</b>';

   	  rotator_2 = window.setTimeout("RotateText_2()",3000);
	  }

  function StopRotation_2()
  {
    window.clearTimeout(rotator_2);
	//window.clearTimeout(rotator_2);
  }

  RotateImages_2();
  RotateText_2();
  //rotateText();

