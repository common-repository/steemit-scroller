<?php
/**
 * This file is used to markup the caption layout.
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/public/partials/templates
 */

foreach($items as $key => $item) 
{ ?>

	<?php
	if ($scroller_show_images === 'yes' && isset($item->image) && $item->image) {
		$active_class = '';
	}
	else
	{
		$active_class = 'no-image';
	}
	?>
	
	<div class="ssc-item <?php echo $active_class; ?>">
		
		<?php // Image
		if ($scroller_show_images === 'yes' && isset($item->image) && $item->image)
		{ ?>
			<div class="ssc-media">
					
				<a href="https://steemit.com<?php echo $item->url.''.$referral_code; ?>" class="ssc-image" target="_blank">
					<img class="lazyOwl" data-src="<?php echo $item->image; ?>" src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>" />
				</a>
					
			</div>
		<?php } ?>
		
		<?php if ($this->detailBoxTitle === 'yes') { ?>
			<div class="ssc-title go-to-top">
				<h4>
					<a href="https://steemit.com<?php echo $item->url.''.$referral_code; ?>" target="_blank"><?php echo $item->short_title; ?></a>
				</h4>
			</div>
		<?php } ?>
				
		<div class="ssc-details">
		
			<div class="reveal_wrapper">
															
				<?php // Body
				if ($this->detailBoxIntrotext === 'yes')
				{ ?>
					<div class="ssc-intro-outer">
						<span class="ssc-intro"><?php echo $item->short_body; ?></span>
					</div>
				<?php }
				
				// Date
				if ($this->detailBoxDate === 'yes')
				{ ?>
					 <div class="ssc-date"><?php echo $item->formatted_date; ?></div>
				<?php } ?>
					
				<div class="ssc-extras">
					
					<?php // Category
					if ($this->detailBoxCategory === 'yes')
					{ ?>
						<span class="ssc-category">
							<span><?php echo __('in', 'steemit-scroller' ); ?></span>
							<span><a href="https://steemit.com/trending/<?php echo $item->category.''.$referral_code; ?>" target="_blank">
								<?php echo $item->category; ?>
							</a></span>
						</span>
					<?php }
					
					// Author
					if ($this->detailBoxAuthor === 'yes')
					{ ?>
						<span class="ssc-author">
							<span><?php echo __('by', 'steemit-scroller' ); ?></span>
							<span><a href="https://steemit.com/@<?php echo $item->author.''.$referral_code; ?>" target="_blank">
								<?php echo $item->author; ?>
							</a></span>
							<?php if ($this->detailBoxAuthorRep === 'yes')
							{ ?>
								<span class="ssc-rep"><?php echo $item->author_reputation; ?></span>
							<?php } ?>
						</span>
					<?php }
					
					// Tags
					if ($this->detailBoxTags === 'yes')
					{ ?>
						<div class="ssc-tags">
							<?php foreach ($item->tags as $tag)
							{ ?>
								<a href="https://steemit.com/trending/<?php echo $tag.''.$referral_code; ?>" class="ssc-li-tag" target="_blank">&#35;<?php echo $tag; ?></a>
							<?php } ?>
						</div>
					<?php } ?>
					
					<div class="ssc-footer">
					
						<?php		
						// Reward
						if ($this->detailBoxReward === 'yes')
						{ ?>
							<span class="ssc-reward">
								<span class="ssc-dollar-sign">&#36;</span><?php echo $item->total_reward; ?>
							</span>
						<?php }
						
						// Votes
						if ($this->detailBoxVotes === 'yes')
						{ ?>
							<span class="ssc-votes">
								<i class="fa fa-chevron-up"></i>&nbsp;
								<?php echo $item->net_votes; ?>
							</span>
						<?php }
						
						// Replies
						if ($this->detailBoxComments === 'yes')
						{ ?>
							<span class="ssc-replies">
								<a href="https://steemit.com<?php echo $item->url.''.$referral_code; ?>#comments" target="_blank">
									<i class="fa fa-comments"></i>&nbsp;
									<span><?php echo $item->replies_count; ?></span>
								</a>
							</span>
						<?php } ?>
						
					</div>
									
				</div>
		
			</div>
			
		</div>
		
		<a class="reveal_opener show_on_hover">
			<span class="openme">+</span>
			<span class="closeme">-</span>
		</a>
	
	</div>
<?php }
