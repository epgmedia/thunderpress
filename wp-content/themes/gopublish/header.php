<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />
<meta name="viewport" content="width=device-width,initial-scale=.5,user-scalable=yes" />
<meta name="google-site-verification" content="mLvqWdgZv9XcVUB3erSicIjr_j3kOm3x6mE_NeP6Dto" />

<title><?php bloginfo('name'); ?><?php if(wp_title('', false)) { echo ' : '; wp_title(''); } else { echo ' : '; bloginfo('description'); } ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="p:domain_verify" content="2f3297a14500913a2735b416732b991b"/>         
<!-- leave this for stats please -->

<link rel="apple-touch-icon" href="http://www.campinglife.com/wp-content/gallery/my-media/apple-icon.png" />
<link rel="Shortcut Icon" href="<?php echo get_theme_mod('favicon'); ?>" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>

<?php wp_enqueue_style('thickbox'); ?> <!-- inserting style sheet for Thickbox.  -->

<?php wp_enqueue_script('thickbox'); ?> <!--  including Thickbox javascript. -->

<!-- begin content slider -->
<script src="<?php bloginfo('template_url'); ?>/javascript/jquery-latest.pack.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/jquery.cycle.all.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('div.postmeta').append("<p class=sublink><strong>Get more Thunder Press</strong> – <a href=https://w1.buysub.com/servlet/ConvertibleGateway?cds_mag_code=THP&cds_page_id=71627&cds_response_key=THH3DTEXT>subscribe here now!</a></p>");
})();
</script>

<script type="text/javascript">
	var $ = jQuery.noConflict();
		$(document).ready(function(){	
		 	$('#slideshow').cycle({
			fx:      "<?php echo get_theme_mod('top-stories-transition'); ?>", // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pager:   '#pager',  // selector for element to use as pager container
			speed: <?php echo get_theme_mod('top-stories-trans-speed'); ?>,
			<?php if (get_theme_mod('top-stories-automate')=="On") { ?>
			timeout: <?php echo get_theme_mod('top-stories-speed'); ?>,  // milliseconds between slide transitions (0 to disable auto advance)
			pause:   true,	  // true to enable "pause on hover"
			pauseOnPagerHover: true // true to pause when hovering over pager link
			<?php } else { ?>
			timeout: 0
			<?php } ?>
			});
	
		});	
</script>


<script src="<?php bloginfo('template_url'); ?>/javascript/jcarousellite_1.0.1c4.js" type="text/javascript"></script>  

<script type="text/javascript">
$(function() {
$(".newsticker-jcarousellite").jCarouselLite({
        <?php echo get_theme_mod('sports-scroll-style'); ?>: true,
        visible: <?php echo get_theme_mod('sports-scrollbox-visible'); ?>,
        auto: <?php echo get_theme_mod('sports-speed'); ?>,
        speed:<?php echo get_theme_mod('sports-transition'); ?>,
	<?php if (get_theme_mod('sports-scroll-style') == "vertical") {?>scroll: <?php echo get_theme_mod('sports-scrollbox-number'); ?><?php } ?>
    });
});
</script>

<script type="text/javascript">
$(function() {
$(".newsticker2-jcarousellite").jCarouselLite({
        <?php echo get_theme_mod('breaking-scroll-style'); ?>: true,
        visible: <?php echo get_theme_mod('breaking-visible'); ?>,
        auto:<?php echo get_theme_mod('breakingnews-speed'); ?>,
        speed:<?php echo get_theme_mod('breakingnews-transition'); ?>,
	<?php if (get_theme_mod('breaking-scroll-style') == "vertical") {?>scroll: <?php echo get_theme_mod('breaking-scroll-number'); ?><?php } ?>
    });
});
</script>

<script type="text/javascript">
$(function() {
$(".newsticker3-jcarousellite").jCarouselLite({
        <?php echo get_theme_mod('breaking-scroll-style'); ?>: true,
        visible: 1,
        auto:<?php if (get_theme_mod('breakingnews-scrollbox')=="1") { echo '0'; } else { echo get_theme_mod('breakingnews-speed'); } ?>,
        speed:<?php echo get_theme_mod('breakingnews-transition'); ?>
    });
});
</script>


<?php wp_head(); ?>


<style type="text/css" media="screen"><!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); --></style>

<?php include(TEMPLATEPATH . "/customstyles.php"); ?>




<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("nav").getElementsByTagName("li");

	// if you only have one main menu - delete the line below //
	var sfEls1 = document.getElementById("subnav").getElementsByTagName("li");
	//

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}

	// if you only have one main menu - delete the "for" loop below //
	for (var i=0; i<sfEls1.length; i++) {
		sfEls1[i].onmouseover=function() {
			this.className+=" sfhover1";
		}
		sfEls1[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover1\\b"), "");
		}
	}
	//

}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>


<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/togglemenu.js"></script>

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/35190362/THP_ROS_160_SB1', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-0').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_160_SB2', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-1').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_160_SB3', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-2').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_160_SB4', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-3').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_160_SB5', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-4').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_160_SB6', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-5').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_160_SB7', [[120, 240], [125, 125], [120, 600], [160, 160], [160, 240], [160, 600]], 'div-gpt-ad-1375829240899-6').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_300_LR', [[300, 250], [300, 600]], 'div-gpt-ad-1375829240899-7').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_300_Mid', [[300, 250], [300, 600]], 'div-gpt-ad-1375829240899-8').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_300_Mid2', [[300, 250], [300, 600]], 'div-gpt-ad-1375829240899-9').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_300_UR', [[300, 250], [300, 600]], 'div-gpt-ad-1375829240899-10').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_Footerboard', [[728, 90], [468, 60]], 'div-gpt-ad-1375829240899-11').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_Leaderboard', [728, 90], 'div-gpt-ad-1375829240899-12').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_middle468', [468, 60], 'div-gpt-ad-1375829240899-13').addService(googletag.pubads());
googletag.defineSlot('/35190362/THP_ROS_middle468_2', [468, 60], 'div-gpt-ad-1375829240899-14').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42840259-5', 'thunderpress.net');
  ga('send', 'pageview');

</script>


</head>


<body>
<div id="rightcolumnads">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(6) ) : else : endif; ?>
</div>
<div id="pagetop"></div>

	<?php if (get_theme_mod('leaderboard-location') == "Above Header") include(TEMPLATEPATH . "/leaderboardhead.php"); ?>



<?php if (get_theme_mod('breakingnews-location') == "Header") { ?>
<?php $scrollspeed = get_theme_mod('breakingnews-speed'); ?>

<?php $bncheck = get_option('bsno'); if ($bncheck == "bsno837625b") 

	{ include(TEMPLATEPATH."/tools/breakingnews.php"); } ?>

<?php } ?>

<div id="wrap">

<div id="header">

  <div id="headerleft" <?php if(get_theme_mod('header_blog_title') == 'Image') { ?>style="padding-left:0px;width:960px;" <?php } ?>>

    <?php if(get_theme_mod('header_blog_title') == 'Image') { ?>

            <a href="<?php echo get_settings('home'); ?>/"><img src="<?php echo get_theme_mod('header-image'); ?>" style="width:<?php echo get_theme_mod('header-width'); ?>px;height:<?php echo get_theme_mod('header-height'); ?>px" alt="<?php bloginfo('description'); ?>" /></a>

    <?php } else { ?>


                <a href="<?php echo get_settings('home'); ?>/"><h1><?php bloginfo('name'); ?></h1></a>
                <p><?php bloginfo('description'); ?></p>  


    <?php } ?>
	</div>
	
	

</div>

<div id="navbar">

	<div id="navbarleft">
		<ul id="nav">
   			<?php wp_nav_menu( array('menu' => 'Top Menu') ); ?>
		</ul>
	</div>
	
	<div id="navbarright">
		<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" value="search our site..." name="s" id="searchbox" onfocus="if (this.value == 'search our site...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'search our site...';}" /><input type="image" style="vertical-align:top;" src="<?php bloginfo('template_url'); ?>/images/search.png" alt="Search" /></form>
	</div>
	
</div>


<?php if (get_theme_mod('bottomnav')=="Show") { ?>

<div id="subnavbar">
	<ul id="subnav">
   			<?php wp_nav_menu( array('menu' => 'Bottom Menu') ); ?>
	</ul>

		<div class="subnavbarright">
		<p><a href="http://feeds.feedburner.com/ThunderPressMagazine"><img style="vertical-align:middle" src="<?php bloginfo('template_url'); ?>/images/rss.gif" alt="Subscribe to <?php bloginfo('name'); ?>" /></a></p>
		</div>
</div>


<?php } ?>

	<?php if (get_theme_mod('leaderboard-location') == "Below Header") include(TEMPLATEPATH . "/leaderboardhead.php"); ?>

<div class="innerwrap">