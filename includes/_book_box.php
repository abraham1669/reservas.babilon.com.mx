<div class="book <?=$black;?>">
	<form action="<?php echo base_url ?>hotels" id="frm-hotels" method="POST">
		<h1>BOOK A HOTEL</h1>
		<div class="h10"></div>
		<input type="text"  autocomplete="off" name="destino" id="destino" placeholder="Destination" />
		<input type="hidden" name="valor" id="valor" />
		<div class="row">
			<div class="col-sm-6"><input type="text" id="from" name="from" placeholder="Check-in" autocomplete="off"></div>
			<div class="col-sm-6"><input type="text" id="to" name="to" placeholder="Check-out" autocomplete="off"></div>
			<div class="col-sm-4">
				<label>Rooms</label>
				<div class="select">
					<select id="rooms" name="rooms">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<label>Adults</label>
				<div class="select">
					<select id="adults" name="adults">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<label>Children</label>
				<div class="select">
					<select id="children" name="children">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</div>
			</div>
		</div>
		<input type="button" class="btn-gral blue" id="search-hotels" value="SEARCH HOTELS">
	</form>
</div>