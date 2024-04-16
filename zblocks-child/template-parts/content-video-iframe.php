<figure class="video-post">
  <div class="embed-responsive embed-responsive-16by9">
							<?php
							$colorPrime = get_field('color_prime', 'option');
							$colorSecond = get_field('color_second', 'option');
							$vidSource = get_field( 'post_video_source' );

							if ($vidSource == 'youtube') {
														?>
														<iframe
															tabindex="0"
															width="560"
															height="315"
															src="https://www.youtube.com/embed/<?php the_field( 'video_embed_code' ); ?>?rel=0"
															srcdoc="<style>
                                /* Edit in template-plates/content-video-iframe.php */

																*{padding:0;margin:0;overflow:hidden}html,body{height:100%}
																img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}
																span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black;overflow: visible;}
																.video-block__play-btn {
															  position: absolute;
															  top: 50%;
															  left: 50%;
															  transform: translateX(-50%) translateY(-50%);
															  display: flex;
															  justify-content: center;
															  align-items: center;
															  width: 120px;
															  height: 120px;
															  border-radius: 50%;
															  font-size: 42px;
															  text-indent: 0.125em;
															  background-color: <?php echo $colorPrime; ?>;
															  color: #fff;
																transition: all 0.3s ease-in-out;
															}
															a:focus .video-block__play-btn,a:hover .video-block__play-btn {
																background-color: <?php echo $colorSecond; ?>;
																color: <?php echo $colorPrime; ?>;
															}
														</style><a href=https://www.youtube.com/embed/<?php the_field( 'video_embed_code' ); ?>?autoplay=1><?php if ( get_field( 'vid-thumb' ) ) { ?><img src='<?php the_field( 'vid-thumb' ); ?>'  alt='<?php the_title(); ?>' style='height: 100%;margin:0;object-fit:cover;'/><?php } else { ?><img src='https://img.youtube.com/vi/<?php the_field( 'video_embed_code' ); ?>/hqdefault.jpg' alt='<?php the_title(); ?>'>
																<?php } ?>
															<div class='video-block__play-btn'>
																▶
															</div></a>"
															frameborder="0"
															allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
															allowfullscreen
															title="<?php the_title(); ?>"
														></iframe>
														<?php } elseif ($vidSource == 'vimeo') {
															$vimeoID = get_field( 'vimeo_video_id' );
															$imgid = $vimeoID;
															$hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$imgid.php"));
														?>
														<iframe
															tabindex="0"
															width="560"
															height="315"
															src="https://player.vimeo.com/video/<?php the_field( 'vimeo_video_id' ); ?>"
															srcdoc="<style>
																*{padding:0;margin:0;overflow:hidden}html,body{height:100%}
																img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}
																span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black;overflow: visible;}
																.video-block__play-btn {
															  position: absolute;
															  top: 50%;
															  left: 50%;
															  transform: translateX(-50%) translateY(-50%);
															  display: flex;
															  justify-content: center;
															  align-items: center;
															  width: 90px;
															  height: 90px;
															  border-radius: 50%;
															  font-size: 42px;
															  text-indent: 0.125em;
															  background-color: <?php echo $colorPrime; ?>;
															  color: #fff;
																transition: all 0.3s ease-in-out;
															}
															a:focus .video-block__play-btn,a:hover .video-block__play-btn {
																background-color: <?php echo $colorSecond; ?>;
																color: <?php echo $colorPrime; ?>;
															}
														</style><a href='https://player.vimeo.com/video/<?php the_field( 'vimeo_video_id' ); ?>?autoplay=1'><?php if ( get_field( 'vid-thumb' ) ) { ?><img src='<?php the_field( 'vid-thumb' ); ?>'  alt='<?php the_title(); ?>' style='height: 100%;margin:0;object-fit:cover;'/><?php }
															else { ?><img src='<?php echo $hash[0]['thumbnail_large']; ?>'  alt='<?php the_title(); ?>' style='height: 100%;margin:0;object-fit:cover;'/>  <?php } ?>
															<div class='video-block__play-btn'>
																▶
															</div></a>"
															frameborder="0"
															allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
															allowfullscreen
															title="<?php the_title(); ?>"
														></iframe>

														<?php } ?>
						</div>
				</figure>
