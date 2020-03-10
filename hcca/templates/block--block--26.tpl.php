<div id="block-block-26">
	<form>
		<label for="state">Or select another state: &nbsp;</label>
		<select name="state" size="1" onchange="submitState(this.value)">
			<option value="--" selected="selected">--</option>
			<?php
			if (isset($_SESSION['states'])) {
				foreach ($_SESSION['states'] as $state_code => $state_name) {
					$state_url = '/'.str_replace( " ", "-", $state_name);
					echo '<option value="'.$state_code.'|'.$state_url.'">'.$state_code.'</option>';
				}
			}
			?>
		</select>
	</form>
	<script type="text/javascript">
		function submitState(str) {
			var exploded = str.split('|');
			loadSessionState(exploded[0], exploded[1]);
		}
	</script>
</div>