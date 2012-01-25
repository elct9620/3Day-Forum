<?php getHeader(array('forumTree' => $forumTree)); ?>

	<div>
		<?php
			if(!empty($subForums)){
		?>
		<table class="bordered-table zebra-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Last Post</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($subForums as $forum) {
				?>
				<tr>
					<td><a href="<?php echo $app->urlFor('Home', array('forumID' => $forum['forum']['_id'])); ?>"><?php echo $forum['forum']['Name']; ?></a></td>
						<td><?php echo isset($forum['lastPost']['timestamp']) ? date('Y-m-d H:i:s', $forum['lastPost']['timestamp']) : 'No Post'; ?></td>
				</tr>
				<?php
						}
				?>
			</tbody>
		</table>
		<?php
			}
		?>
		<div class="row">
			<div class="span16 new-post-bar">
				<a href="<?php echo $app->urlFor('createTopic', array('forumID' => $forumID)); ?>" class="btn primary">New Post</a>
			</div>
		</div>
		<table class="bordered-table zebra-striped">
			<thead>
				<tr>
					<th>Topic</th>
					<th>Poster</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($threads)){
						foreach ($threads as $ID =>  $thread) {
				?>
					<tr>
						<td><a href="<?php echo $app->urlFor('Topic', array('threadID' => $thread['thread']['_id'])); ?>"><?php echo $thread['thread']['Name']; ?></a></td>
						<td><?php echo isset($thread['user']) ? $thread['user']['Nickname'] : 'Unknow'; ?></td>
						<td><?php echo date('Y-m-d H:i:s', $thread['thread']['timestamp']); ?></td>
					</tr>
				<?php
						}
					}else{
				?>
					<tr>
						<td colspan="3">No thread found!</td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>

<?php getFooter(); ?>