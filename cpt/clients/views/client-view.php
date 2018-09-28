<div class="inner-meta">
	<label>Email: </label>
	<br/>
	<input type="text" name="email" size="20" placeholder="ex: john@gmail.com" value="<?= $custom['email'][0] ?>"/>
	<br/>
	<br/>

	<label>Phone: </label>
	<br/>
	<input type="text" name="phone" size="20" placeholder="ex: 888-123-4567" value="<?= $custom['phone'][0] ?>"/>
	<br/>
	<br/>

	<label>From Address or Zip: </label>
	<br/>
	<input type="text" name="from" size="60" placeholder="ex: 1600 Amphitheatre Parkway Mountain View, CA 94043" value="<?= $custom['from'][0] ?>"/>
	<br/>
	<br/>

	<label>To Address or Zip: </label>
	<br/>
	<input type="text" name="to" size="60" placeholder="ex: 1600 Amphitheatre Parkway Mountain View, CA 94043" value="<?= $custom['to'][0] ?>"/>
	<br/>
	<br/>

	<label>Moving Type: </label>
	<br/>
	<select name="type">
	  <option <?= $custom['type'][0] == "Local" ? "selected" : null ?> value="Local">Local</option>
	  <option <?= $custom['type'][0] == "Long Distance" ? "selected" : null ?> value="Long Distance">Long Distance</option>
	  <option <?= $custom['type'][0] == "Auto Transport" ? "selected" : null ?> value="Auto Transport">Auto Transport</option>
	  <option <?= $custom['type'][0] == "International" ? "selected" : null ?> value="International">International</option>
	</select>
	<br/>
	<br/>

	<label>Auto Transport: </label>
	<br/>
	<select name="auto_transport" value="<?= $custom['auto_transport'][0] ?>">
	  <option <?= $custom['auto_transport'][0] == "false" ? "selected" : null ?> value="false">No</option>
	  <option <?= $custom['auto_transport'][0] == "true" ? "selected" : null ?> value="true">Yes</option>
	</select>
	<br/>
	<br/>
</div>