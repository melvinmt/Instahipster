var lastPic="";
function showHandles(){
    var thisPic = "#"+$(this).attr('id');
    
    //hide the elements on the last one clicked
    if(lastPic !="" && lastPic!=thisPic){
      $(lastPic).find(".ui-rotatable-handle").hide();
      $(lastPic).find(".ui-resizable-handle").hide();
      $(lastPic).find(".ic_x").hide();
      $(this).css('z-index',30);
      $(lastPic).css('z-index',25);
    }
    
    //if this doesn't have the handles yet then add them
    var acheck = $(this).hasClass('hasHandles');
    
    if(acheck==false){
      //alert("new");
      var theID = $(this).attr('id');
      $("#"+theID).rotatable();     
      $(this).find(".elem-wrapper").resizable({aspectRatio: true, handles:'se'});
      $(this).find(".ic_x").show();
      $(this).addClass('hasHandles');
    }

    else{
      $(this).find(".ic_x").show();
      $(this).find(".ui-rotatable-handle").show();
      $(this).find(".ui-resizable-handle").show();
      $(this).find(".elem-wrapper").resizable({aspectRatio: true, handles:'se'});
    }
      
  lastPic = "#"+$(this).attr('id');
}
//============================
//this gets the degree of rotation and scale
function getRotation(el){
  
    var el = document.getElementById($(el).attr('id'));
    $(el).animate({left:'-=1',},0);
    $(el).animate({left:'+=1',},0);

    var st = window.getComputedStyle(el, null); 
    var tr = st.getPropertyValue("-webkit-transform") ||
         st.getPropertyValue("-moz-transform") ||
         st.getPropertyValue("-ms-transform") ||
         st.getPropertyValue("-o-transform") ||
         st.getPropertyValue("transform") ||
         "fail...";

    //if there is no tr then rotate is 0 and scale is 1
  if(tr!='none'){
       if(jQuery.browser.webkit){tr = $(el).css("-webkit-transform");}
       else if(jQuery.browser.mozilla){tr = $(el).css("-moz-transform");}
       else if(jQuery.browser.msie){tr = $(el).css("-ms-transform");}
       else if(jQuery.browser.opera){tr = $(el).css("-o-transform");}
       else{tr = $(el).css("transform");}

       console.log('Matrix: ' + tr);
       var values = tr.split('(')[1];
     values = values.split(')')[0];
       values = values.split(',');
       var a = values[0];
       var b = values[1];
       var c = values[2];
       var d = values[3];

       var scale = Math.sqrt(a*a + b*b);
       var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
  }
  else{angle=0;}

    //alert('Rotate: ' + angle + 'deg.');
    return angle;
}

//=========================
//this gets the coordinates and then sends them via ajax
function getCoords(){
  //go through all of the added elements
  
  //first we get the offset of the main pic
  var mainoffset = $('#mainPic').offset();
    //alert("main pic left: " + mainoffset.left + ", top: " + mainoffset.top);

  var details = {
    mainPic: $('#mainPic').attr('src'),
    cliparts: []
  };
  
  var detail;
  
  $('.draggable-wrapper').each(function() {

    detail = {};
    detail.url = $(this).find('.elem-wrapper').attr('src');
    
    var position = $(this).offset();
    
    //now we use the main pic to 0 out the offset and get the true relative x and y of the elements
    var x = position.left-mainoffset.left;
    var y = position.top -mainoffset.top;
    //alert(x+" element "+y);
    
    detail.x = x;
    detail.y = y;
    
    var theID = "#"+$(this).attr('id');
        var theAngle = getRotation(theID);

    detail.rotation = theAngle;   
    var oldWidth = 150;
    var newWidth = parseInt($(this).find('.elem-wrapper').css('width'));
    
    detail.scale = newWidth/oldWidth;   
    details.cliparts.push(detail);  
    
  });
  
  details = JSON.stringify(details);
  console.log(details);
  //alert(details);
   //now send this to the processor and then go to the next page.
   //we will get a url returned and put that in the next page.
   //url to use is hipsterize/save
   //ajax bit
   
    $.ajax({
        type: "POST",
        url: "/hipsterize/save",
        data: {
      json: details
    },
        success: function(msg){
      if (msg.via_id){
            window.location = 'http://via.me/-' + msg.via_id;
          }
      else{       
        alert('Something went wrong. Please try again');
        $('#submit').removeAttr('disabled').text('Done!');
      }
      //redirect to the next page
     }//success function ender
      });//ajax ender
  
    $('#submit').attr('disabled', 'disabled').text('Processing..');
    //end ajax bit
    
}

$(document).ready(function() {

    var imnum=0;
    var picWidth;
    var picHeight;
    $('.ic_x').hide();

    //resize the holder div
    $('#mainPic').load(function() {
        picWidth = this.width;   // Note: $(this).width() will not
        picHeight = this.height; // work for in memory images.

        $('#screen').width(picWidth);
        $('#screen').height(picHeight);
    });

    $('#mainPic').bind('dragstart', function(event) { event.preventDefault(); });

    //setup the logo pic
    $("#watermark").css('position','absolute');
    $('#watermark').css('transform', 'rotate(1deg)');

        //get the dimensions of the main pic and put the new images in the center
        var thex = Math.floor(picWidth/2)-100;
        var they = Math.floor(picHeight/2)-50;
        $("#watermark").css('right',20);
        $("#watermark").css('top',20);

        $("#watermark").draggable();
      $("#watermark").mousedown(showHandles);

        var newID = "clip"+imnum;
        $("(#watermark").attr('id',newID);

      imnum++;


    //===========================
    //set up the clone function
    $('.stock').click(function(){
  
      //make a copy and put it with the picture
      clone = $(this).clone();
      $(clone).unbind();
      $(clone).removeClass('stock').addClass('draggable-wrapper');
     
        //give this clone a new id
        var newID = "clip"+imnum;
        $(clone).attr('id',newID);

        $(clone).css('position','absolute');

        //get the dimensions of the main pic and put the new images in the center
        var thex = Math.floor(picWidth/2)-100;
        var they = Math.floor(picHeight/2)-50;
        $(clone).css('left',thex);
        $(clone).css('top',they);

        //add it to the screen
        $(clone).prependTo('#screen');
        $(clone).draggable();
      $(clone).mousedown(showHandles);
    
      imnum++;
      });

      //========================
      //this hides all handles when the user clicks on the main image
      $("#mainPic").live("click", function(){ 
        $(".ui-rotatable-handle").hide();
        $(".ui-resizable-handle").hide();
        $(".ic_x").hide();
      });

      //=====================
      //this will kill the element on the canvas 
      $('.ic_x').live("mousedown",function(){$(this).parent().remove();});

      //====================
      $('#thumbsList').animate({top: '-=40', opacity: 1,}, 150, 'linear');

    var myList = $('#my-list');

    // Creating hoverscroll
    myList.hoverscroll({
      width:    895,        // Width of the list
            height:   120,  
            arrows: false,
            rtl: false
        });
        // Starting the movement automatically at loading
        // @param direction: right/bottom = 1, left/top = -1
        // @param speed: Speed of the animation (scrollPosition += direction * speed)
        var direction = -1, speed = 3;

      myList[0] && myList[0].startMoving(direction, speed);
});