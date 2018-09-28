<div class="inner-meta">
	<label>Email: </label>
	<br/>
	<input type="text" name="email" size="20" placeholder="ex: info@mover.com" value="<?= $custom['email'][0] ?>"/>
	<br/>
	<br/>

	<label>Phone: </label>
	<br/>
	<input type="text" name="phone" size="20" placeholder="ex: 888-123-4567" value="<?= $custom['phone'][0] ?>"/>
	<br/>
	<br/>

	<label>Location: </label>
	<br/>
	<input type="text" name="location" size="60" placeholder="ex: 1600 Amphitheatre Parkway, Mountain View, CA, 94043" value="<?= $custom['location'][0] ?>"/>
	<br/>
	<br/>

	<label>Moving Services Offered: </label>
	<br/>
	<input type="checkbox" name="Local" value="Local" <?= $custom['Local'][0] ? "checked" : null ?>> Local<br>
	<input type="checkbox" name="LongDistance" value="LongDistance" <?= $custom['LongDistance'][0] ? "checked" : null ?>> Long Distance<br>
	<input type="checkbox" name="AutoTransport" value="AutoTransport" <?= $custom['AutoTransport'][0] ? "checked" : null ?>> Auto Transport<br>
	<input type="checkbox" name="International" value="International" <?= $custom['International'][0] ? "checked" : null ?>> International<br>
	<br/>
	<br/>
</div>