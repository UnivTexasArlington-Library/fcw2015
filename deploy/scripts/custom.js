      <script>
    $(document).ready(function() {
         $(".facimg img").each(function() {
         $(this).bind('load', function() {
            var image = $(this);
            var theImage = new Image();
            theImage.src = image.attr("src");
            var imageWidth = theImage.width;
            var imageHeight = theImage.height;
            var ratio = parseInt(imageWidth) / parseInt(imageHeight);
         if (ratio > 1) {
            $(this).addClass("horizontalimg");
         }
         });
         });
         
      });
      
      </script>
      <script>
      $(document).ready(function() {
         var inwidth = $(".navbar-toggle").width();
         var leftwidth = $("#mobilemenu").width();
         var paddLeft = (leftwidth - inwidth - 15)/2;
         $("#mobilenav").css("margin-left", paddLeft);
         var winwidth = $(window).width();
         if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         } 
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         else if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         }
         
         $(window).resize(function() {
         var inwidth = $(".navbar-toggle").width();
         var leftwidth = $("#mobilemenu").width();
         var paddLeft = (leftwidth - inwidth - 15)/2;
         $("#mobilenav").css("margin-left", paddLeft);
         var winwidth = $(window).width();
         if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         }
         if (winwidth < 612) {
         var sharewid = $("#share").width();
         var marLeft = ((sharewid - 32)/2) + 35;
         $("#sharediv").css("left", marLeft);
         }
         else if (winwidth < 799) {
            var spaceleft = (winwidth * .02);
           var marLeft = 10 + 35 + 32 + spaceleft;
         $("#sharediv").css("left", marLeft);
         }
          });
       });
      </script>
         <script>
      $(document).ready(function() {
         var busHeight = $("#topcollege").height();
            //for ff
            var isFirefox = typeof InstallTrigger !== 'undefined'; 
         if (isFirefox == true) {
            var docheight = $('html, body').scrollTop();
         } else {
            //for chrome
            var docheight = document.body.scrollTop;
         }
            
            if (docheight > busHeight) {
               $("#collegenav").fadeIn(400).css("display", "table");
            }
         else {
            $('#collegenav').fadeOut(400);
         }
        });
      </script>
      <script> 
      $(document).ready(function() {
         var winHeight = $(window).height();
         if ($(".depthead").height() > winHeight) {
            $(".depthead").css("overflow", "hidden");
         }
      });
      </script>
            <script>
      $(document).ready(function() {
      $(".morelink").on('click', function(e) {
            e.preventDefault();
         var thishref = $(this).parent().next().next(".imgdiv");
         var top = thishref.offset()['top'];
         $('html,body').animate({
                  scrollTop: top
               }, 500
            );
            //measure the remaining the height of the depthead and if it's less than height of the window then add padding underneath
      });
   });
      $(window).resize(function() {
               $(".morelink").on('click', function(e) {
            e.preventDefault();
         var thishref = $(this).parent().next().next(".imgdiv");
         var top = thishref.offset()['top'];
         $('html,body').animate({
                  scrollTop: top
               }, 500
            );
            //measure the remaining the height of the depthead and if it's less than height of the window then add padding underneath
      });
      });
      </script>
      <script>
      $("#arrow").hover(function() {
         $("#arrowtext").toggle('slide');
      });
      $("#infoparent").hover(function() {
         $("#infoText").toggle('slide');
      });
     $("#shareparent").hover(function() {
         var winwidth = $(window).width();
         if (winwidth > 800) {
         $("#sharediv").toggle('slide');
         $("#share").animate({opacity:'1'},1);
      }
      });
      $("#shareparent").mouseleave(function() {
         $("#share").animate({opacity:'.4'},1);
         $("#sharediv").hide();
      });
       
     $("#share").click(function(e) {
               e.preventDefault();
         var winwidth = $(window).width();
         if (winwidth < 799) {
         $("#sharediv").toggle();
         $("#share").animate({opacity:'1'},1);
     }
      });
      </script>
            <script>
      $('#top').on('click', function(e) {
            e.preventDefault();
            var aHref = $('#top').attr('href');
            var top = $(aHref).offset().top;
            $('html,body').animate({
               scrollTop: top
            }
            );
      });
      </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16674574-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>