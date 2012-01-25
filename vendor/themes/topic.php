<?php getHeader(array('forumTree' => $forumTree, 'postData' => $postData)); ?>

	<div>
		<?php if($postData){ ?>
			<div class="row">
				<div class="span4">
					<div class="well">
						<div>
							<img src="https://graph.facebook.com/<?php echo $postData['user']['userID']; ?>/picture?type=normal" />
						</div>
						<?php
							echo isset($postData['user']['Nickname']) ? htmlspecialchars($postData['user']['Nickname']) : 'Anonymous';
						?>
					</div>
				</div>
				<div class="span12">
					<div>
						<h2><?php echo htmlspecialchars($postData['thread']['Name']); ?></h2>
						<div>
							<?php echo nl2br(htmlspecialchars($postData['post']['Content'])); ?>
						</div>
						<hr />
						<div>
							Posted on <?php echo date('Y-m-d H:i:s', $postData['post']['timestamp']); ?>
							<?php
								if($admUser){
							?>
							&nbsp;|&nbsp;<a href="<?php echo $app->urlFor('Topic', array('threadID' => $postData['thread']['_id'], 'action' => 'DELETE')); ?>">Delete</a>
							<?php
								}
							?>
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
							echo isset($post['user']['Nickname']) ? htmlspecialchars($post['user']['Nickname']) : 'Anonymous';
						?>
					</div>
				</div>
				<div class="span12">
					<div>
						<?php if(isset($post['post']['Name'])){ ?>
						<h3><?php echo htmlspecialchars($post['post']['Name']); ?></h3>
						<?php } ?>
						<div>
							<?php echo nl2br(htmlspecialchars($post['post']['Content'])); ?>
						</div>
						<hr />
						<div>
							Posted on <?php echo date('Y-m-d H:i:s', $post['post']['timestamp']); ?>
							<?php
								if($admUser){
							?>
							&nbsp;|&nbsp;<a href="<?php echo $app->urlFor('delPost', array('postID' => $post['post']['_id'])); ?>">Delete</a>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
			?>
			<div>
				<form method="POST" action="<?php echo $app->urlFor('replyTopic', array('threadID' => $threadID)); ?>">
					<fieldset>
						<legend>Reply</legend>
						<div class="clearfix">
							<label>Title (Option)</label>
							<div class="input">
								<input type="text" class="xlarge" name="postName" />
							</div>
						</div>
						<div class="clearfix">
							<label>Content</label>
							<div class="input">
								<textarea class="xxlarge" rows="5" name="postContent"></textarea>
							</div>
						</div>
						<div class="actions">
							<button class="btn primary" type="submit">Reply</button>
						</div>
					</fieldset>
				</form>
			</div>
		<?php
			}else{
		?>
		Topic nod found!
		<?php
			}
		?>
	</div>

<?php getFooter(); ?>