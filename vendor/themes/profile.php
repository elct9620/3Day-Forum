<?php getHeader(); ?>

	<div>
		<form method="POST">
			<fieldset>
				<legend>Profile</legend>
				<div class="clearfix">
					<label>Nickname</label>
					<div class="input">
						<input type="text" class="large" name="Nickname" value="<?php echo isset($user->Nickname) ? $user->Nickname : ''; ?>" />
					</div>
				</div>
				<div class="actions">
					<button class="btn primary" type="submit">Update</button>
				</div>
			</fieldset>
		</form>
	</div>

<?php getFooter(); ?>