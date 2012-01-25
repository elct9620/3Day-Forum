<?php getHeader(); ?>

		<div>
			<table class="bordered-table zebra-striped">
				<thead>
					<tr>
						<th class="span12">Name</th>
						<th class="span4">Last Post</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$forums = Forums::getForums();
						if(!empty($forums)){
							foreach ($forums as $forum) {
					?>
					<tr>
						<td><a href="<?php echo $app->urlFor('Home', array('forumID' => $forum['forum']['_id'])); ?>"><?php echo $forum['forum']['Name']; ?></a></td>
						<td><?php echo isset($forum['lastPost']['timestamp']) ? date('Y-m-d H:i:s', $forum['lastPost']['timestamp']) : 'No Post'; ?></td>
					</tr>
					<?php
							}
						}else{
					?>
						<tr>
							<td colspan="2">No forum found!</td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<?php if(isset($user->Type) && intval($user->Type) === 1){ ?>
			<div class="well">
				<form method="POST" class="no-bottom-space">
					<label>New Forum</label>
					<div class="input">
						<input type="text" name="forumName" title="Type new forum name" />
						<button class="btn primary">Create</button>
					</div>
				</form>
			</div>
			<?php } ?>
		</div>

<?php getFooter(); ?>
