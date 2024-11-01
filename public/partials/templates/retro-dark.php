<?php
/**
 * This file is used to markup the retro-dark layout.
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/public/partials/templates
 */

foreach($items as $key => $item) 
{ ?>
	<div class="ssc-item">
		
		<?php // Image
		if ($scroller_show_images === 'yes' && isset($item->image) && $item->image)
		{ ?>
			<div class="ssc-media">
					
				<div class="ssc-media-inner">
				
					<a href="https://steemit.com<?php echo $item->url.''.$referral_code; ?>" class="ssc-image" target="_blank">
						<img class="lazyOwl" data-src="<?php echo $item->image; ?>" src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>" />
					</a>
					
					<?php if ($scroller_hover_box === 'yes') { ?>
						<div class="ssc-hover">
						
							<?php if ($scroller_hover_link === 'yes') { ?>
								<a href="<?php echo $item->itemLink; ?>" class="ssc-link-icon">
									<i class="fa fa-link"></i>
								</a>
							<?php } ?>
							
							<?php if ($scroller_hover_lightbox === 'yes' && isset($item->image) && $item->image) { ?>
								<a class="ssc-lightbox-icon" href="<?php echo $item->image;?>" data-lightbox="lb-<?php echo $scroller_id; ?>" data-title="<?php echo htmlspecialchars($item->title); ?>">
									<i class="fa fa-search"></i>
								</a>
							<?php } ?>
							 
						</div>
					<?php } ?>
					
				</div>
					
			</div>
		<?php } ?>
				
		<div class="ssc-details">
		
			<?php // Title
			if ($this->detailBoxTitle === 'yes')
			{ ?>
				<div class="ssc-title">
					<h4>
						<a href="https://steemit.com<?php echo $item->url.''.$referral_code; ?>" target="_blank"><?php echo $item->short_title; ?></a>
					</h4>
				</div>
			<?php }
			
			// Body
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
<?php }
