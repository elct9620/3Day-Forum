<?php getHeader(array('forumTree' => $forumTree, 'postData' => $postData, 'title' => $postData['thread']['Name'])); ?>

	<div>
		<?php if($postData){ ?>
			<div class="row">
				<div class="span3">
					<div class="well">
						<div class="profile">
							<div>
								<img src="https://graph.facebook.com/<?php echo $postData['user']['userID']; ?>/picture?type=normal" />
							</div>
							<strong>
							<?php
								echo isset($postData['user']['Nickname']) ? htmlspecialchars($postData['user']['Nickname']) : 'Anonymous';
							?>
							</strong>
						</div>
					</div>
				</div>
				<div class="span13">
					<article>
						<header>
						<h2><?php echo htmlspecialchars($postData['thread']['Name']); ?></h2>
						</header>
						<div class="article"><?php echo nl2br(htmlspecialchars($postData['post']['Content'])); ?></div>
						<footer>
							Posted on <?php echo date('Y-m-d H:i:s', $postData['post']['timestamp']); ?>
							<?php
								if($admUser){
							?>
							<a class="btn danger small" href="<?php echo $app->urlFor('Topic', array('threadID' => $postData['thread']['_id'], 'action' => 'DELETE')); ?>">Delete</a>
							<?php
								}
							?>
						</footer>
					</article>
				</div>
			</div>
			<?php
				if($postData['posts']){
					foreach ($postData['posts'] as $post) {
			?>
			<div class="row">
				<div class="span3">
					<div class="well">
						<div class="profile">
							<div>
								<img src="https://graph.facebook.com/<?php echo $post['user']['userID']; ?>/picture?type=normal" />
							</div>
							<strong>
							<?php
								echo isset($post['user']['Nickname']) ? htmlspecialchars($post['user']['Nickname']) : 'Anonymous';
							?>
							</strong>
						</div>
					</div>
				</div>
				<div class="span13">
					<article>
						<?php if(isset($post['post']['Name'])){ ?>
						<header>
							<h3><?php echo htmlspecialchars($post['post']['Name']); ?></h3>
						</header>
						<?php } ?>
						<div class="article"><?php echo nl2br(htmlspecialchars($post['post']['Content'])); ?></div>
						<footer>
							Posted on <?php echo date('Y-m-d H:i:s', $post['post']['timestamp']); ?>
							<?php
								if($admUser){
							?>
							<a class="btn danger small" href="<?php echo $app->urlFor('delPost', array('postID' => $post['post']['_id'])); ?>">Delete</a>
							<?php
								}
							?>
						</footer>
					</article>
				</div>
			</div>
			<?php
					}
				}
			?>
			<div class="well">
				<form class="no-bottom-space" method="POST" action="<?php echo $app->urlFor('replyTopic', array('threadID' => $threadID)); ?>">
					<fieldset class="no-bottom-space">
						<legend>Reply</legend>
						<div class="clearfix">
							<label>Title (Option)</label>
							<div class="input">
								<input type="text" class="xlarge" name="postName" title="This can skip" />
							</div>
						</div>
						<div class="clearfix">
							<label>Content</label>
							<div class="input">
								<textarea class="xxlarge" rows="5" name="postContent" title="Type something you want to reply."></textarea>
							</div>
						</div>
						<div class="actions no-bottom-space">
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