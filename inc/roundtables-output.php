
				<article>
					<h3 class="article-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					
					<p class="article-description"><?php echo category_description( $category_id ); ?></p>
					<div class="article-excerpt"><span class="article-author"><?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?>
							</span><?php the_excerpt();?></div>
				</article>
