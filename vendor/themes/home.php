<?php getHeader(); ?>

		<div>
			<table>
				<thead>
					<tr>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$forums = Forums::getForums();
						if($forums->valid()){
							foreach ($forums as $ID => $forum) {
					?>
					<tr>
						<td><a href="<?php echo $app->urlFor('Home', array('forumID' => $ID)); ?>"><?php echo $forum->Name; ?></a></td>
					</tr>
					<?php
							}
						}else{
					?>
						<tr>
							<td>No forum found!</td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>

<?php getFooter(); ?>
