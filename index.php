<?php
require_once("header.php");
?>
		<div id="availableData">
		<div style="padding-bottom: 10px; float: right;">
		<!--<a href="fbloginsdk/fblogin.php"></a>-->
		<button type="button" class="btn btn-primary" id="addEntry" data-toggle="modal" data-target="#myModal">Add your input</button>
		</div>
			<table id="myTable" class="mdl-data-table display">  
				<thead>  
				  <tr>  
					<th>Location</th>  
					<th>Vendor Name</th>  
					<th>CC/DC</th>  
					<th>CC/DC extra tax</th>  
					<th>Paytm</th>  
				  </tr>  
				</thead>  
				<tbody> 
				 <?php
				 require_once("db/getAllRecords.php");
				 global $result;
				 while($row = mysqli_fetch_assoc($result))
				 {
					echo "<tr>
							<span data-toggle='tooltip' title='Click on the vendor name to edit'>
							<td style='cursor:pointer;' class='btn-link vendorName' vid=".$row['vendorid']." locid=".$row['locationid']." 
							data-toggle='modal' data-target='#myModal'>".$row['name']."</td></span>
							<td>".$row['area'].", ".$row['street']."</td>
							<td>".($row['ccdc'] ? "Accepted" : "Not Accepted")."</td>
							<td>".$row['ccdctax']."</td>
							<td>".($row['paytm'] ? "Accepted" : "Not Accepted")."</td>
						</tr>";
				 }
				 ?>								
				</tbody>
			</table>
	
	</div>
	<div id="enterYourInput" style="display:none;" class="col-md-4">
	<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content"  style="background-image: linear-gradient( to bottom, #FF9933, white , green );">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Add shop details</h3>
        </div>
        <div class="modal-body">
		<form method="post" id="vendorDetails" name="vendorDetails" action="db/addEntry.php" role="form">
		  <div class="form-group">
			<label for="state">Location(State)</label>
			<select class="form-control" id="state" name="state">
			  <option value="Maharashtra" selected>Maharashtra</option>
			  <option value="Karnatka">Karnatka</option>
			  <option value="Andhra Pradesh">Andhra Pradesh</option>
			  <option value="Delhi">Delhi</option>
			</select>
		  </div>
		  <div class="form-group has-feedback">
			<label for="area">Location(City/Village)</label>
			<input type="text" class="form-control clearable" id="cityVillage" name="cityVillage" placeholder="Enter City" required data-error="This field is required">
			<div class="help-block with-errors"></div>
		  </div>
		  <div class="form-group">
			<label for="area">Location(Area)</label>
			<input type="text" class="form-control clearable" id="area" name="area" placeholder="Enter Area">
		  </div>
		  <div class="form-group">
			<label for="street">Location(Street)</label>
			<input type="text" class="form-control clearable" id="street" name="street" placeholder="Enter Street">
		  </div>
		  <div class="form-group">
			<label for="vendor">Vendor Name</label>
			<input type="text" class="form-control clearable" id="vendor" name="vendor" placeholder="Enter vendor">
		  </div>
		  <div class="form-inline">
			  <div class="form-group checkbox">
				<label>
				<input type="checkbox" id="ccdc" name="ccdc" value="0" >CC/DC Accepted</label>
				<input type="text" id="ccdcValue" name="ccdcValue" value="0" hidden>
			  </div>
			  <div class="form-group" id="percentageTax" style="display:none;">
				<label class="sr-only" for="ccdcTax">%Tax</label>
				 <div class="input-group">
					<input type="text" class="form-control" id="ccdcTax" name="ccdcTax" placeholder="Total % tax">
					<span class="input-group-addon">%</span>
				</div>
			  </div>
			  <div class="form-group checkbox">
				<label>
				<input type="checkbox" class="custom-control-input" id="paytm" name="paytm" value="0">Paytm Accepted</label>
				<input type="text" id="paytmValue" name="paytmValue" value="0" hidden>
		  </div>
		  </div>
		  
		</div>
	  <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit input</button>
	  </div>
	  </form>
	  </div>
	  </div>
	  </div>
	  </div>
	<?php
require_once("footer.php");
?>