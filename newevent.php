<!-- Add New -->

<div class="modal fade" id="addevent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add Reminder</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addevent.php">


					 
                <div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Reminder</label>
						</div>
				</div>

<div style="height:3px;"></div>

					<div class="row">
						<div class="col">
							
							<input type="text" name="title" class="form-control">
						</div>
					</div>
					<div style="height:10px;"></div>

					      <div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Start Date</label>
						</div>
				</div>

<div style="height:3px;"></div>

					<div class="row">
						<div class="col">
							
				<div class='input-group date' id='datetimepicker1'>
                    <input type='text' name="startdate" id="startdate" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
							
				</div>
					</div>
					<div style="height:10px;"></div>

					 <div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">End Date</label>
						</div>
				</div>

<div style="height:3px;"></div>

					<div class="row">
						<div class="col">
							
				<div class='input-group date' id='datetimepicker1'>
                    <input type='text' name="enddate" id="enddate" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
							
				</div>
					</div>

					<div style="height:10px;"></div>
					 <div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Choose Color</label>
						</div>
				</div>

				<div style="height:3px;"></div>

					<div class="row">
						<div class="col">
 
<select class="form-control select2" name="class" style="width: 100%;">
	<option selected="selected" value="event-success">Green</option>
	<option value="event-success" style="background:#006400">Green</option>
    <option value="event-important" style="background:#ad2121">Red</option>
    <option value="event-info" style="background:#1e90ff">Blue</option>
    <option value="event-warning" style="background:#e3bc08">Orange</option>
    <option value="event-inverse" style="background:#1b1b1b">Black</option>
    <option value="event-special" style="background:#800080">Purple</option>
</select>
</div>
</div>

			<div style="height:10px;"></div>
                <div class="modal-footer">

        <button id="btn-pay" type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>

                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a></button>
                </div>

				</form>
                </div>
				
            </div>
        </div>
    </div>
</div>
   