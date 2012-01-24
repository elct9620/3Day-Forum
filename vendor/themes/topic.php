<?php getHeader(); ?>

	<div>
		<?php if($postData){ ?>
			<div class="row">
				<div class="span4">
					<div class="well">
						<div>
							<img src="https://graph.facebook.com/<?php echo $postData['user']['userID']; ?>/picture?type=normal" />
						</div>
						<?php
							echo isset($postData['user']['Nickname']) ? $postData['user']['Nickname'] : 'Anonymous';
						?>
					</div>
				</div>
				<div class="span12">
					<div>
						<h2><?php echo $postData['thread']['Name']; ?></h2>
						<div>
							<?php echo $postData['post']['Content']; ?>
						</div>
						<hr />
						<div>
							Posted on <?php echo date('Y-m-d H:i:s', $postData['post']['timestamp']); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				if($postData['posts']){
					foreach ($postData['posts'] as $post) {
			?>
			<div class="row">
				<div class="span4">
					<div class="well">
						<div>
							<img src="https://graph.facebook.com/<?php echo $post['user']['userID']; ?>/picture?type=normal" />
						</div>
						<?php
							echo isset($post['user']['Nickname']) ? $post['user']['Nickname'] : 'Anonymous';
						?>
					</div>
				</div>
				<div class="span12">
					<div>
						<?php if(isset($post['post']['Name'])){ ?>
						<h3><?php echo $post['post']['Name']; ?></h3>
						<?php } ?>
						<div>
							<?php echo $post['post']['Content']; ?>
						</div>
						<hr />
						<div>
							Posted on <?php echo date('Y-m-d H:i:s', $postData['post']['timestamp']); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
			?>
		<?php
			}else{
		?>
		Topic nod found!
		<?php
			}
		?>
	</div>

<?php getFooter(); ?>