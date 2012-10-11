<?php get_header(); ?>
	
	<img class="toplogo" src="<?php bloginfo('template_directory'); ?>/_/img/toplogo.png" alt="Phillip Island" />
	
	
	
	<div id="map">
	
		<div class="mapcontainer">
	
			<div id="worldmap">
				
				
				
				<?php // Get all the subworld areas on the main map ?>
				
				<?php $query = new WP_Query('post_type=mapimage&post_parent=28') ?>
					
				<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
					
					<a href="#<?php echo $post->post_name; ?>" id="<?php echo $post->post_name; ?>-section" class="maparea" rel="tootip" title="<?php echo $post->post_title; ?>" style="left: <?php echo(types_render_field("horizontal-map-position-percentage", array('raw' => 'false'))); ?>px; top: <?php echo(types_render_field("vertical-map-position-percentage", array('raw' => 'false'))); ?>px; width: <?php echo(types_render_field("width-on-map-percentage", array('raw' => 'false'))); ?>px; height: <?php echo(types_render_field("height-on-map-percentage", array('raw' => 'false'))); ?>px;">
					</a>
			
				<?php endwhile; endif; ?>
				
				<div class="imagedimmer"></div>				
				
				<?php // Get the parent map (main map) ?>
				
				<?php $query = new WP_Query('post_type=mapimage&p=28') ?>
					
				<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
				
					<?php //the_title(); ?>
			
					<?php //the_content(); ?>
						
					<span class="mapimage"><?php the_post_thumbnail('large'); ?></span>
			
				<?php endwhile; endif; ?> 
				
				
			
			</div>
			
			
			
			<?php // Get the children of the main map images to for each sub section ?>
			
			<?php $query = new WP_Query('post_type=mapimage&post_parent=28') ?>
			
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
				
				<div id="<?php echo $post->post_name; ?>" class="subworld">
				
					<span class="closesubworld"><img src="<?php bloginfo('template_directory'); ?>/_/img/backtomainmapbutton.png" alt="Main" /></span>
					
					<span class="nextmap"><img src="<?php bloginfo('template_directory'); ?>/_/img/nextmapbutton.png" alt="Next" /></span>
				
					<?php // Display the sub section image ?>
					
					<span class="mapimage"><?php the_post_thumbnail('large'); ?></span>
					
					<?php // get related posts which are children of the sub map
					
					$child_posts = types_child_posts(‘location’);
					
					//foreach ($child_posts as $key => $value) {
					//	echo "<p>";
						//echo $value->ID;
					//	print_r($value);
					//	echo "</p>";
					//}
					
					//print_r($child_posts); 
					
					// If there are an children of the sub section map, go through each one and query each of them individually to get access to each location post
					
					if (!empty($child_posts)) { ?>
					
						<?php
						foreach ($child_posts as $child_post) {
							
							$childpostid = $child_post->ID; 
							
							//echo($childpostid);
							
							?>
							
							<?php $queryargs = "post_type=location&p=".$childpostid; ?>
							
							<?php $Query = new WP_Query($queryargs); ?>
							
							<?php if ($Query->have_posts()) : while ($Query->have_posts()) : $Query->the_post(); ?>
								
								<div id="<?php //echo $post->post_name; ?><?php echo $post->ID; ?>" class="subworld maparea <?php if(types_render_field("horizontal-map-position-percentage", array('raw' => 'true')) > 50) { echo "rightsidelocation"; } ?>" style="left: <?php echo(types_render_field("horizontal-map-position-percentage", array('raw' => 'false'))); ?>%; top: <?php echo(types_render_field("vertical-map-position-percentage", array('raw' => 'false'))); ?>%;">
									
									
									
									<span class="locationicon" <?php //echo 'class="badge"'; ?>><?php //the_title(); ?><?php echo(types_render_field("icon", array('raw' => 'false'))); ?></span>
									
									<div class="subworldsectiondetail well <?php echo $post->ID; ?> <?php echo(types_render_field("locaion_type", array('raw' => 'false'))); ?>">
										
										<a class="close">&times;</a></li>
										<h3 class="title"><?php the_title(); ?></h3>
										<h4 class="subtitle"><?php echo(types_render_field("sub-title", array('raw' => 'false'))); ?></h4>
										<p class="description"><?php echo(types_render_field("description", array('raw' => 'false'))); ?></p>
										<!--<img src="img/tempimage.png" alt="Image" width="200" height="150" />-->
										<span class="image"><?php echo(types_render_field("image", array('raw' => 'false'))); ?></span>
										<span class="video"><?php echo(types_render_field("video", array('raw' => 'false'))); ?></span>
										
										<div class="subsectiondetailscollumn1">
										
											<p class="phonenumber"><strong>Phone:</strong><br> <?php echo(types_render_field("phone-number", array('raw' => 'false'))); ?></p>
											<?php if (types_render_field("email", array('raw' => 'false'))) { 
												echo "<p class='email'><strong>Email:</strong><br> ".types_render_field("email", array('raw' => 'false'))."</p>";
											} ?>
											
											<?php if (types_render_field("url", array('raw' => 'false'))) {
												echo "<p class='url'><a href='".types_render_field("url", array('raw' => 'true'))."'>Find out more</a></p>"; 
											}?>
										
										</div>
										
										<div class="subsectiondetailscollumn2">
										
											
											<p class="hours"><strong>Hours:</strong><br>
											<?php echo(types_render_field("hours", array('raw' => 'false'))); ?></p>
											<p class="googlemap"><a href="<?php echo(types_render_field("google-maps-url", array('raw' => 'true'))); ?>">Click for a map</a></p>
											
										</div>
										
										<div class="clear"></div>
										
										<?php if(types_render_field("locaion_type", array('raw' => 'false')) != "location_type_1") { ?>	
										<a href="#" class="btn btn-primary addtowishlist <?php echo $post->ID; ?>" title="<?php echo $post->ID; ?>">Add to Wishlist</a>
										<?php } else { ?>
										
										<?php } ?>
										
										<!--<div class="fb-send" data-href="<?php //bloginfo('url'); ?><?php echo("http://finnrobertson.com"); //temp to remove ?>/#sharedlocation=<?php echo $post->ID; ?>"></div>-->
										
										<!--<a href="https://www.facebook.com/dialog/feed?
										    app_id=201386319992907&
										    redirect_uri=<?php bloginfo('url'); ?>/#sharedlocation=<?php echo $post->ID; ?>&display=iframe" class="btn btn-primary facebookshare">Facebook</a>-->
										    
										<small>Share: </small>
										
										<a href="#" data-link="<?php bloginfo('url'); ?>/#sharedlocation=<?php echo $post->ID; ?>" class="facebookshare"><img src="<?php bloginfo('template_directory'); ?>/_/img/facebooksharebutton.png" alt="Share on Facebook" /></a>
										
										<!--<a href="https://twitter.com/share" data-url="<?php bloginfo('url'); ?>/#sharedlocation=<?php echo $post->ID; ?>" data-text="Tweet This location" hashtags="phillipisland" class="btn btn-primary">Twitter</a>-->
										
										<?php //get_bloginfo() ?>
										
										<a href="<?php echo 'https://twitter.com/share?url='.rawurlencode ( get_bloginfo('url').'/#sharedlocation='.$post->ID ).'&text='.rawurlencode (types_render_field("sub-title", array('raw' => 'false'))).'&via='.rawurlencode('phillipislandvia').'&related='.rawurlencode('phillipislandrelated').'&hashtags='.rawurlencode('phillipislandhashtag');?>" target="_blank" class="twittershare"><img src="<?php bloginfo('template_directory'); ?>/_/img/twittertweetbutton.png" alt="Tweet" /></a>
										
										<!--<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://test" data-text="Tweet This location" data-hashtags="phillipisland">Tweet</a>-->
										
										
										<small>Copy link: </small><input type="text" class="copysharelink" name="sharelink" value="<?php bloginfo('url');  ?>/#sharedlocation=<?php echo $post->ID; ?>" />
										
									</div>
									
								</div>
								
								
							
							<?php endwhile; endif; ?> 
							
							<?php wp_reset_postdata(); ?>
							
							<?
							
						}
					
					}
					
					?>
					
				</div>
		
			<?php endwhile; endif; ?> 
			
			<?php wp_reset_postdata(); ?>
		
		
		
			<div class="planandwinpanel">
			
				<div class="welcomepanel panel">
							
					<div class="collumn1 collumn">
					
						<!--<h2>Plan &amp; Win</h2>
						
						<h3>Your Perfect Family Getaway!</h3>-->
						
						<img src="<?php bloginfo('template_directory'); ?>/_/img/planandwinbiglogo.png" alt="Plan and win your perfect family getaway!" />
						
					</div>
					
					<div class="collumn2 collumn">
					
						<p>So much fun... so close to home! Philip Island is Victoria’s natural playground, located just two hours from Melbourne.</p>
						
						<p>Now you can plan and win your perfect family getaway by using our new fun interactive map. One happy family will win their perfect Phillip Island long-weekend each week for four weeks! <br><a href="#" class="detailslink">Click here for more details.</a></p>
						
					</div>
					
					<div class="collumn3 collumn">
					
						<a href="#" class="btn">ENTER NOW</a>
							
					</div>
					
					<div class="clear"></div>
					
				</div>
				
				<div class="sortablelist panel">
					
					<div class="collumn1 collumn">
					
						<img src="<?php bloginfo('template_directory'); ?>/_/img/planandwintab.png" class="planandwintab" alt="Plan and win your perfect family getaway!" />
						
						<img src="<?php bloginfo('template_directory'); ?>/_/img/steps1.png" class="steps" alt="Step 1" />
						
						<div class="newlist">
						
							<p>Explore the map and choose nine great activities to add to your wishlist:</p>
						
						</div>
						
						<div class="sharedlist">
						
							
						
						</div>
					
					</div>
					
					<div class="collumn2 collumn">
						
						<div class="daytitles">
							<h2>Day 1:</h2>
							<hr>
							<h2>Day 2:</h2>
							<hr>
							<h2>Day 3:</h2>
						</div>
						
						<ul id="sortable1" class="connectedSortable">
							
						</ul>
						
					</div>
					
					<div class="collumn3 collumn">
					
						<div class="newlist">
					
							<a href="#" class="btn">CONTINUE</a>
							
						</div>
						
						<div class="sharedlist">
						
							<a href="#" class="btn makenewitinerary">MAKE YOUR<br> OWN ITINERY</a>
						
						</div>
					
					</div>
					
					<div class="clear"></div>
					
				</div>
				
				<div class="sentancepanel panel">
					
					<div class="collumn1 collumn">
					
						<img src="<?php bloginfo('template_directory'); ?>/_/img/planandwintab.png" class="planandwintab" alt="Plan and win your perfect family getaway!" />
						
						<img src="<?php bloginfo('template_directory'); ?>/_/img/steps2.png" class="steps" alt="Step 2" />
						
						<a href="#"class="back">&laquo; Back</a>
					
					</div>
					
					<div class="collumn2 collumn">
						
						<p>Complete the following sentence: ‘Phillip Island is Victoria’s natural playground because...’ (up to 25 words)</p>
						
						<textarea></textarea>
						
					</div>
					
					<div class="collumn3 collumn">
					
						<a href="#" class="btn">CONTINUE</a>
							
					</div>
					
					<div class="clear"></div>
					
				</div>
				
				<div class="submitpanel panel">
					
					<form method="get" action="" class="detailsform">
					
						<div class="collumn1 collumn">
												
							<img src="<?php bloginfo('template_directory'); ?>/_/img/planandwintab.png" class="planandwintab" alt="Plan and win your perfect family getaway!" />
							
							<img src="<?php bloginfo('template_directory'); ?>/_/img/steps3.png" class="steps" alt="Step 3" />
							
							<p>Please enter your details:</p>
							
							<a href="#"class="back">&laquo; Back</a>
						
						</div>
						
						<div class="collumn2 collumn">
						
							<p><label>Your name:</label> <input type="text" name="name" value="" class="text-field required name" minlength="2" /></p>
							
							<p><label>Your email:</label> <input type="text" name="email" value="" class="text-field required email" /></p>
							
							<small>Please send me further details regarding Phillip Island activities and promotions</small>
							
						</div>
						
						<div class="collumn3 collumn">
							
							<p><label>Daytime phone: </label><input type="text" name="phone" value="" class="text-field required digits phone-number" minlength="10" /></p>
							
							<p><label>Postcode: </label><input type="text" name="postcode" value="" class="text-field required number postcode" minlength="4" /></p>
							
							<small>I agree to the <a href="#" class="termsandconditions">Terms &amp; Conditions</a></small>
							
						</div>
						
						<div class="collumn4 collumn">
							
							<input class="submit btn" type="submit" value="CONTINUE"/>
							
						</div>
						
						<div class="clear"></div>
					
					</form>
					
					
							
				</div>
				
				<div class="sharepanel panel">
					
					<div class="collumn1 collumn">
						
						<img src="<?php bloginfo('template_directory'); ?>/_/img/planandwintab.png" class="planandwintab" alt="Plan and win your perfect family getaway!" />
						
						<img src="<?php bloginfo('template_directory'); ?>/_/img/steps3.png" class="steps" alt="Step 3" />
						
					</div>
						
					<div class="collumn2 collumn">
						
						<p>You can share your perfect Phillip Island getaway with friends and family (sharing improves your entry score!)</p>
						
					</div>
					
					<div class="collumn3 collumn">
						
						
						
						<!--<a href="<?php echo 'https://twitter.com/intent/tweet?url='.rawurlencode ( get_bloginfo('url') . "/" );?>" target="_blank" class="twittershare btn"><img src="<?php bloginfo('template_directory'); ?>/_/img/bigtwitterbuttonicon.png" alt="Tweet" /><img class="done" title="" src="<?php bloginfo('template_directory'); ?>/_/img/doneicon.png" alt="" />SHARE ON<br>TWITTER</a>-->
						
						<!--<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_email_large' displayText='Email'></span>-->
						
						<!-- AddThis Button BEGIN -->
						<!--<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
							<a class="addthis_button_facebook" style="cursor:pointer" addthis:url="http://pinp.brandtopia.net/" addthis:title="Testing" addthis:description="An Example Description">
							</a><a class="addthis_button_twitter" style="cursor:pointer"></a>
							<a class="addthis_button_email" style="cursor:pointer"></a>
						</div>-->
						
						<div class="addthis_toolbox" addthis:url="<?php bloginfo('url'); ?>/" addthis:title="My Perfect Phillip Island getaway" addthis:description="My Perfect Phillip Island getaway">
							<a class="addthis_button_email emailshare btn"><img src="<?php bloginfo('template_directory'); ?>/_/img/bigemailbuttonicon.png" alt="Share via Email" /><img class="done" title="" src="<?php bloginfo('template_directory'); ?>/_/img/doneicon.png" alt="" />SHARE VIA<br>EMAIL</a>
							<!--<a href="#" data-link="<?php bloginfo('url'); ?>/" class="facebookshare btn"><img src="<?php bloginfo('template_directory'); ?>/_/img/bigfacebookbuttonicon.png" alt="Share on Facebook" /><img class="done" title="" src="<?php bloginfo('template_directory'); ?>/_/img/doneicon.png" alt="" />SHARE ON<br>FACEBOOK</a>-->
							<a class="addthis_button_facebook facebookshare btn"><img src="<?php bloginfo('template_directory'); ?>/_/img/bigfacebookbuttonicon.png" alt="Share on Facebook" /><img class="done" title="" src="<?php bloginfo('template_directory'); ?>/_/img/doneicon.png" alt="" />SHARE ON<br>FACEBOOK</a>
							<a class="addthis_button_twitter twittershare btn"><img src="<?php bloginfo('template_directory'); ?>/_/img/bigtwitterbuttonicon.png" alt="Tweet" /><img class="done" title="" src="<?php bloginfo('template_directory'); ?>/_/img/doneicon.png" alt="" />SHARE ON<br>TWITTER</a>
						</div>
						
						
						<!--"data_track_addressbar":true-->
						<!--<script type="text/javascript">var addthis_config = {};</script>-->
						<!--<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>-->
						<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5074ba432f7f9717"></script>
						<!-- AddThis Button END -->
						
					</div>
					
					<div class="collumn4 collumn">
						
						<p>Click 'submit' to complete your entry</p>
						
						<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
						
						<!--<a href="#" class="btn">SUBMIT</a>-->
						
					</div>
					
					<div class="clear"></div>
							
				</div>
				
				
				
				<div class="finishpanel panel">
				
					<div class="collumn1 collumn">
						
						<img src="<?php bloginfo('template_directory'); ?>/_/img/planandwintab.png" class="planandwintab" alt="Plan and win your perfect family getaway!" />
						
					</div>
					
					<div class="collum2 collumn">
						
						<p><h3>Congratulations!</h3> Your entry is now complete. Good luck in the competition and see you on Phillip Island!</p>
						
					</div>
					
					<div class="collumn2 collumn">
					
						<a href="#" class="btn">RETURN TO START</a>
					
					</div>
					
					<div class="clear"></div>
				
				</div>
				
				
			
			</div>
			
			
			
			
			
			
			
		
		
		</div>
		
	</div>
	
	

<?php get_footer(); ?>
