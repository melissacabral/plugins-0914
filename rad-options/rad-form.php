<div class="wrap">
	<h2>Company Information Settings</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'rad_options_group' ); //allow this form to submit to the DB 
			//get current values so the form 'sticks'
			$values = get_option('rad_options');
		?>

		<label>Company Phone Number:</label>
		<br>
		<input type="tel" name="rad_options[phone]" value="<?php echo $values['phone'] ?>" class="regular-text">

		<br><br>

		<label>Customer Service Email:</label>
		<br>
		<input type="email" name="rad_options[email]" value="<?php echo $values['email'] ?>" class="regular-text">

		<br><br>

		<label>Mailing Address</label>
		<br>
		<textarea name="rad_options[address]" class="large-text code"><?php 
			echo $values['address'] ?></textarea>

		<?php submit_button( 'Save Company Info' ); ?>

	</form>
</div>