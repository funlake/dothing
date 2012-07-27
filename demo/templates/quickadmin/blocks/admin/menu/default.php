<div>
	<ul class="nav-user-options">
		<?php foreach($this->GetMenu() as $data) : ?>
			<li>
				<a href="<?php echo $data['link'];?>">
					<img src="<?php echo DO_THEME_BASE;?>/_layout/images/icons/<?php echo $data['icon'];?>" alt="<?php echo $data['alt'];?>	" />
					&nbsp; <?php echo $data['title'];?>						
				</a>
				<?php if(!!$data['child']) :?>
				<ul>
					<?php foreach((array)$data['child'] as $key=>$childData) :?>
						<li class="<?php echo $childData['class'];?> last">
							<a href="<?php echo $childData['link'];?>">
								<?php echo $childData['title'];?>
							</a>
						</li>
					<?php endforeach;?>
					<li class="pin"></li>
				</ul>
				<?php endif;?>
			</li>
		<?php endforeach;?>
	</ul>
</div>