		<!--<footer id="footer" class="source-org vcard copyright">
			<small>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></small>
		</footer>-->

	</div>

	<?php wp_footer(); ?>


<!-- here comes the javascript -->

<!--jQuery ui-->
<!--<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery-ui-1.8.23.custom.js"></script>-->
<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.ui.core.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.ui.widget.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.ui.mouse.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.ui.sortable.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.ba-bbq.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>



<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=201386319992907";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->

<!--Twitter share script-->

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<!-- jQuery is called via the Wordpress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>







<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.-->

<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34728704-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
	
</body>

</html>
