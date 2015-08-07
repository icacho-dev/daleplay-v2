<div class="clearfix"></div>


<footer class="footer style3">



<div class="container">

 </div><!-- end footer -->



<div class="clearfix"></div>



<div class="copyright_info">

<div class="container">



    <div class="clearfix divider_dashed10"></div>



    <div class="one_half animate" data-anim-type="fadeInRight">



        Copyright © 2014 Aaika.com. All rights reserved.  <a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a>



    </div>



    <div class="one_half last">



        <ul class="footer_social_links">

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-facebook"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-twitter"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-google-plus"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-linkedin"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-skype"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-flickr"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-html5"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-youtube"></i></a></li>

            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-rss"></i></a></li>

        </ul>



    </div>



</div>

</div><!-- end copyright info -->



</footer>



<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->



</div>



<!-- ######### JS FILES ######### -->

<!-- get jQuery from the google apis -->

<script type="text/javascript" src="<?=base_url()?>js/universal/jquery.js"></script>



<!-- style switcher -->

<script src="<?=base_url()?>js/style-switcher/jquery-1.js"></script>

<script src="<?=base_url()?>js/style-switcher/styleselector.js"></script>



<!-- animations -->

<script src="<?=base_url()?>js/animations/js/animations.min.js" type="text/javascript"></script>



<!-- slide panel -->

<script type="text/javascript" src="<?=base_url()?>js/slidepanel/slidepanel.js"></script>



<!-- mega menu -->

<script src="<?=base_url()?>js/mainmenu/bootstrap.min.js"></script>

<script src="<?=base_url()?>js/mainmenu/customeUI.js"></script>


<!-- MasterSlider -->
<script src="<?=base_url()?>js/masterslider/jquery.easing.min.js"></script>
<script src="<?=base_url()?>js/masterslider/masterslider.min.js"></script>
<script type="text/javascript">
(function($) {
 "use strict";

	var slider3 = new MasterSlider();

		slider3.control('arrows');
		slider3.control('circletimer' , {color:"#FFFFFF" , stroke:9});
		slider3.control('thumblist' , {autohide:false ,dir:'h', type:'tabs',width:234,height:120, align:'bottom', space:0 , margin:-12, hideUnder:400});

		slider3.setup('masterslider3' , {
			width:1170,
			height:620,
			space:0,
			preload:'all',
			layout:'fullwidth',
			view:'basic'
		});

		$('#myTab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});

		SyntaxHighlighter.all();

	var slider2 = new MasterSlider();

	 slider2.setup('masterslider2' , {
		 width:1400,    // slider standard width
		 height:520,   // slider standard height
		 space:0,
		 speed:45,
		 layout:'fullwidth',
		 loop:true,
		 preload:0,
		 autoplay:true,
		 view:"basic"
	});

})(jQuery);
</script>

<!-- scroll up -->
<script src="<?=base_url()?>js/scrolltotop/totop.js" type="text/javascript"></script>


<!-- sticky menu -->
<script type="text/javascript" src="<?=base_url()?>js/mainmenu/sticky-6.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/mainmenu/modernizr.custom.75180.js"></script>

<!-- start : evaluar -->
<!-- cubeportfolio -->
<script type="text/javascript" src="<?=base_url()?>js/cubeportfolio/jquery.cubeportfolio.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/cubeportfolio/main.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/cubeportfolio/main2.js"></script>

<!-- flexslider -->
<script defer src="<?=base_url()?>js/flexslider/jquery.flexslider.js"></script>
<script defer src="<?=base_url()?>js/flexslider/custom.js"></script>

<!-- owl carousel -->
<script src="<?=base_url()?>js/carouselowl/owl.carousel.js"></script>

<!-- basic slider -->
<script type="text/javascript" src="<?=base_url()?>js/basicslider/bacslider.js"></script>
<script type="text/javascript">
(function($) {
 "use strict";

	$(document).ready(function() {
		$(".main-slider-container").sliderbac();
	});

})(jQuery);
</script>

<!-- tabs -->
<script src="<?=base_url()?>js/tabs/assets/js/responsive-tabs.min.js" type="text/javascript"></script>

<!-- Accordion-->
<script type="text/javascript" src="<?=base_url()?>js/accordion/jquery.accordion.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/accordion/custom.js"></script>
<!-- end : evaluar -->


<script type="text/javascript" src="<?=base_url()?>js/universal/custom.js"></script>



</body>

</html>
