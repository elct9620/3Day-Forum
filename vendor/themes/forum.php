<?php getHeader(); ?>

	<div>
		<?php
			if($subForums->valid()){
		?>
		<table>
			<thead>
				<tr>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($subForums as $ID => $forum) {
				?>
				<tr>
					<td><a href="<?php echo $app->urlFor('Home', array('forumID' => $ID)); ?>"><?php echo $forum->Name; ?></a></td>
				</tr>
				<?php
						}
				?>
			</tbody>
		</table>
		<?php
			}
		?>
		<table>
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
						<td colspan="2">No thread found!</td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>

<?php getFooter(); ?>