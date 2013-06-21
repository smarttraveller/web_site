
  var currentImage = -1;
  
  var currentText = -1;
  
  function RotateImages()
  {
    var a = new Array("ads/add_1/yala.jpg","ads/add_1/vil_uyana.jpg","ads/add_1/kandy.jpg", "ads/add_1/dunhida.jpg", "ads/add_1/amaya_lake.jpg");
	
   // var c = new Array("url1", "url2", "url3", "url4");
    var b = document.getElementById('adds_1');
	
   // var d = document.getElementById('imageurl');

    currentImage++;

    if(currentImage>= a.length)
      currentImage=0;

    b.src = a[currentImage];
  //  d.href = c[currentImage];

    rotator = window.setTimeout("RotateImages(" + (currentImage+1) + ")",3000);
	
  }
  
	  /*var text = new Array("Yala National Park","Jetwing Vil Uyana, Sigiriya. Call : +9466 4 923586","Dalada Maligawa, Kandy", "Dunhida Water Fall", "Amaya Lake, Dambulla. Call : +9466 4 461500");
	  
	  
	  var maxSlogans = text.length-1;
	  var current = 0;
	  function rotateText() {
	  if (++current > maxSlogans) current = 0;
	  document.getElementById("textDiv").innerHTML = '<b>'+text[current]+'</b>';
	  window.setInterval("rotateText()", 3000);
	  
	  }*/
	  	  
 	  function RotateText()
	  {
		  var text = new Array("Yala National Park","Jetwing Vil Uyana, Sigiriya. Call : +9466 4 923586","Dalada Maligawa, Kandy", "Dunhida Water Fall", "Amaya Lake, Dambulla. Call : +9466 4 461500");
		  
		  //var text2 = document.getElementById('textDiv');
	  
	  currentText++;
	  
	  if(currentText >= text.length-1)
      currentText=-1;

   	  //text2.src = text[currentText];
  	  //  d.href = c[currentImage];
	  
	  document.getElementById("textDiv").innerHTML = '<b>'+text[currentText+1]+'</b>';
	  
   	  rotator_2 = window.setTimeout("RotateText()",3000);
	  }
	  

  function StopRotation()
  {
    window.clearTimeout(rotator);
	//window.clearTimeout(rotator_2);
  }

  RotateImages();
  RotateText();
  //rotateText();

