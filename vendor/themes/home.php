<?php getHeader(); ?>

		<div>
			<table class="bordered-table zebra-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Last Post</th>
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
		</div>

<?php getFooter(); ?>
