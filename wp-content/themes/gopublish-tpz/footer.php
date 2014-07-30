</div><!--innerwrap-->



<!-- begin footer -->

<?php if (get_theme_mod('display-leader-footer') == "Yes") include(TEMPLATEPATH . "/leaderboardfoot.php"); ?>

<div style="clear:both;"></div>

<form method="post" action="https://w1.buysub.com/servlet/PrePopGateway?cds_mag_code=THP&cds_page_id=71627&cds_response_key=THH4DEMB">
<table width="960" height="300" align="left" background="/wp-content/uploads/2012/09/05512i-TP-sub-form-R2.jpg" no-repeat>
    <tr>
      <td width="640" height="15"></td>
    </tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
       <tr>
      <td width="750"></td>
      <td height="35" td width="100"><div align="right">
        <p style="color:white;font-size:20px;">Name:</p>
      </div></td>
      <td colspan="3"><div align="left">
        <input type="text" value="" name="cds_name" size="45"/>
      </div></td>
    </tr>
    <tr>
      <td width="750"></td>
      <td height="35" td width="100"><div align="right">
        <p style="color:white;font-size:20px;">Address:</p>
      </div></td>
      <td colspan="3"><div align="left">
        <input type="text" value="" name="cds_address_1" size="45" />
      </div></td>
    </tr>
    <tr>
      <td width="750"></td>
      <td height="35" td width="100"><div align="right">
       <p style="color:white;font-size:20px;">City:</p>
      </div></td>
      <td colspan=3><div align="left">
        <input type="text" value="" name="cds_city" size="45"/>
      </div></td>
    </tr>
    <tr>
      <td width="750"></td>
      <td height="35" td width="100"><div align="right">
        <p style="color:white;font-size:20px;">State:</p>
      </div></td>
      <td width="23"><div align="left">
        <input type="text" name="cds_state" size="6" maxlength="2" /> 
      </div></td>
      <td width="80" height="35"><div align="right">
        <p style="color:white;font-size:20px;">ZIP:</p>
      </div></td>
      <td width="135"><div align="left">
        <input type="text" name="cds_zip" size="15" /> 
      </div></td>
    </tr>
        <tr>
      <td width="750"></td>
      <td colspan="4" height="40" align="center"><input type="submit" value="Subscribe Now!" name="send"></input></td>
         </tr>
<tr></tr>
<tr></tr>
<td><tr></tr></td>
</table></form>






<div style="clear:both"></div>

</div><!--wrap-->

<div id="footer">
<?php wp_reset_query(); ?>
	<p>&bull; Copyright &copy; <?php echo date('Y'); ?> &bull; <a href="<?php if (get_theme_mod('google-apps')) { echo get_theme_mod('google-apps'); } else { bloginfo('url'); } ?>"><?php bloginfo('name'); ?></a> &bull; <a href="/sitemap.xml">Sitemap</a> &bull; <a href="/advertise-with-thunder-press" >ADVERTISE</a> &bull; <a href="/contact-us#contribute">Contribute</a> &bull; <a href="https://plus.google.com/110936562045677799429" rel="publisher">Google+</a> &bull; 

</p>


</div>

<?php do_action('wp_footer'); ?>


            <?php if(get_theme_mod('analytics') == 'Yes') { ?>
                
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo get_theme_mod('analytics_code'); ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

            <?php } ?> 

</body>
</html>