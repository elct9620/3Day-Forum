<?php getHeader(); ?>

	<div>
		<form method="POST">
			<fieldset>
				<legend>New Topic</legend>
				<div class="clearfix">
					<label>Subject</label>
					<div class="input">
						<input type="text" name="postName" class="xlarge" />
					</div>
				</div>
				<div class="clearfix">
					<label>Content</label>
					<div class="input">
						<textarea name="postContent" class="xxlarge" rows="5"></textarea>
					</div>
				</div>
				<div class="actions">
					<button class="btn primary" type="submit">Create</button>
				</div>
			</fieldset>
		</form>
	</div>

<?php getFooter(); ?>