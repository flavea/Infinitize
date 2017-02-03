jQuery(document).ready(function(event){
  var isAnimating = false,
    newLocation = '';
    firstLoad = false;
     $("#about-project").hide();
     $(".ost").fadeIn();

     if(window.location.hash) {
        var string = '#navigation a[href="' + window.location.hash + '"]';
        $(string).addClass("clicked");
      } else {
        $("#navigation a:first-child").addClass("clicked");
      }

        $(document).on('click', '#navigation a', function(event){
          $("#navigation a").removeClass("clicked");
        $(this).addClass("clicked");
      });

    $(document).on('click', '.opener', function(event){
     $( "#bigMenu" ).animate({
        top: "0"
      }, 500 );

     $( "#hamburger" ).removeClass("opener");
     $( "#hamburger" ).addClass("close");
     if($( "#hamburger" ).hasClass("hiddener")) {
       $( "#hamburger" ).css("display", "block");
     }

    });
  
    $(document).on('click', '.close', function(event){
      $( "#bigMenu" ).animate({
        top: "-100%"
      }, 500 );
     $("#about-project").hide();
     $( "#hamburger" ).addClass("opener");
     $( "#hamburger" ).removeClass("close");
     if($( "#hamburger" ).hasClass("close")) {
      alert("dung");
     }
     if($( "#hamburger" ).hasClass("hiddener")) {
       $( "#hamburger" ).css("display", "none");
     }
    });

    $(document).on('click', '.sort', function(event){
      var data_id = $(this).attr('data-sorter');
          $(".sort").removeClass("white-border");
          $(this).addClass("white-border");
          if(data_id == "all") {
            $(".album").fadeIn();
          } else {
            $(".album").fadeOut();
            $("#albums ." + data_id).fadeIn();
          }
    });


  
    /*$(document).on('click', '.album', function(event){
      var album_id = $(this).attr('data-album');

      $("#album-detail").removeClass("inactive");
      $("#albums .album").fadeOut();
      $(this).fadeIn(0);
      $("#albums").animate({width: "250px"});
      $("#line").animate({width: "2.4em"});
          $("#album-detail .al").addClass("inactive");
          $("#album-close").removeClass("inactive");
          $("#album-detail #"+album_id).removeClass("inactive");
      $('#sorter').hide();

    });
  
    $(document).on('click', '#album-close', function(event){
      $("#album-detail").addClass("inactive");
          $("#albums .album").fadeIn(0);
          $("#albums").css("width", "calc(100% - 16em)");
          $("#line").css("width", "calc(100% - 8em - 340px)");
          $("#album-close").addClass("inactive");
      $('#sorter').show();

    });*/

    $('.drama').on('mouseover', function(event){
   console.log("loog");
  });

  $('main').on('click', '[data-type="page-transition"]', function(event){
    event.preventDefault();
    $( "#hamburger" ).removeClass("close");
    var newPage = $(this).attr('href');
    if( !isAnimating ) changePage(newPage, true);
    firstLoad = true;
  });

  $(window).on('popstate', function() {
  	if( firstLoad ) {
      var newPageArray = location.pathname.split('/'),
        newPage = newPageArray[newPageArray.length - 1];

      if( !isAnimating  &&  newLocation != newPage ) changePage(newPage, false);
    }
    firstLoad = true;
	});

	function changePage(url, bool) {
    isAnimating = true;
    $('body').addClass('page-is-changing');
    loadNewContent(url, bool);
    newLocation = url;
    isAnimating = false;
	}

	function loadNewContent(url, bool) {
		url = ('' == url) ? 'index.php' : url;
  	var newSection = 'cd-'+url.replace('.php', '');
  	var section = $('<div class="cd-main-content '+newSection+'"></div>');
  		
  	section.load(url+' .cd-main-content > *', function(event){
      $('main').html(section);
      var delay = ( transitionsSupported() ) ? 1200 : 0;
      setTimeout(function(){
        ( section.hasClass('cd-about') ) ? $('body').addClass('cd-about') : $('body').removeClass('cd-about');
        $('body').removeClass('page-is-changing');
        $('.cd-loading-bar').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
          isAnimating = false;
          $('.cd-loading-bar').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
        });

        if( !transitionsSupported() ) isAnimating = false;
      }, delay);
      
      if(url!=window.location && bool){
        window.history.pushState({path: url},'',url);
      }
		});
  }

  function transitionsSupported() {
    return $('html').hasClass('csstransitions');
  }

  
});