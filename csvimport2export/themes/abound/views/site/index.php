<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>

		<form name="request_info_form" action="index.php" method="post">

	<h2> Fill out the form below to request information regarding a particular Declaration of Covenant or similar Instrument. <p></p> 
         <p><p>  IMPORTANT: We administer covenants covering an estimated 250,000 planned and existing homes, retail projects, office buildings and more nationwide.  Therefore, please complete ALL applicable fields in order to help us identify the correct instrument, and to avoid a delayed response.<p></p></h2>
   </div>
 
<h4>STEP 1:  IDENTIFY YOURSELF:</h4>
      <div class="box">
         <table width="100%" cellpadding="5" cellspacing="0" border="0">
         <tr>
         	<td align="left" valign="middle" colspan="2" class="data_description">I am a (an):? &nbsp; &nbsp; &nbsp; <input type="radio" name="inquiring_party" value="T" <?php if ($formData['inquiring_party'] == 'T') echo 'CHECKED'; ?>/> Title Agent &nbsp; &nbsp; <input type="radio" name="inquiring_party" value="A" <?php if ($formData['inquiring_party'] == 'A') echo 'CHECKED'; ?> /> Attorney &nbsp; &nbsp; <input type="radio" name="inquiring_party" value="CO" <?php if ($formData['inquiring_party'] == 'CO') echo 'CHECKED'; ?> /> Current Property Owner&nbsp; &nbsp; <input type="radio" name="inquiring_party" value="O" <?php if ($formData['inquiring_party'] == 'O') echo 'CHECKED'; ?> /> Other</td>
         </tr><tr>
<td align="right" valign="middle" width="220" class="data_description">If Other, please explain:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="other_inquirer" value="<?php echo $formData['other_inquirer']; ?>" class="textfield_input" /></td>
         </tr><tr>
         </table>
         <br />      

         <table width="100%" cellpadding="5" cellspacing="0" border="0">
         	<tr>
         		<td align="right" valign="middle" width="220" class="data_description">
         			Enter Your Email Address <strong>(Required)</strong>:
         		</td>

         		<td align="left" valign="middle" width="*" class="data_cell">
					<input type="text" name="email_address" value="<?php echo $formData['email_address']; ?>" class="textfield_input" />
				</td>
			</tr>

         	<tr>
         		<td align="right" valign="middle" width="220" class="data_description">
         			Confirm Your Email Address:
         		</td>

         		<td align="left" valign="middle" width="*" class="data_cell">
					<input type="text" name="email_address_confirm" value="<?php echo $formData['email_address_confirm']; ?>" class="textfield_input" />
				</td>
			</tr>
		</table>         

         <h4>Type or Paste your Contact Info Here:</h4>
         <textarea name="contact_paste" class="textarea_input"><?php echo $formData['contact_paste']; ?></textarea></td>
         </tr><tr>

			</table>
      </div>

 <h4>STEP 2:  IDENTIFY THE INSTRUMENT:</h4>
      <div class="box">
         <table width="100%" cellpadding="5" cellspacing="0" border="0">
         <tr>
         	<td align="right" valign="middle" width="220" class="data_description">File Number (4 Digits.  Bottom left corner of Instrument.  If no file number, type 0000):</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="document_number" value="<?php echo $formData['document_number']; ?>" class="textfield_input" /></td>
         </tr><tr>
        	<td align="right" valign="middle" width="220" class="data_description">State:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="state" value="<?php echo $formData['state']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">County:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="county" value="<?php echo $formData['county']; ?>" class="textfield_input" /></td>
         </tr><tr>
<td align="right" valign="middle" width="220" class="data_description">Date Instrument was Filed in Public Records:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="date_recorded" value="<?php echo $formData['date_recorded']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Volume/Book/Cabinet:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="volume" value="<?php echo $formData['volume']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Page/Slide:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="page" value="<?php echo $formData['page']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Document Number:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="document" value="<?php echo $formData['document']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Original Declarant Name::</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="declarant" value="<?php echo $formData['declarant']; ?>" class="textfield_input" /></td>
         </tr><tr>

			</table>
      </div>

 <h4>STEP 3:  IDENTIFY THE PROPERTY:</h4>
      <div class="box">
         <table width="100%" cellpadding="5" cellspacing="0" border="0">
         <tr>
         	<td align="right" valign="middle" width="220" class="data_description">Current Owners Name:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="current_owner" value="<?php echo $formData['current_owner']; ?>" class="textfield_input" /></td>
         </tr>
<td align="right" valign="middle" width="220" class="data_description">Property Street Address:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="property_street" value="<?php echo $formData['property_street']; ?>" class="textfield_input" /></td>
         </tr>
<td align="right" valign="middle" width="220" class="data_description">City:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="property_city" value="<?php echo $formData['property_city']; ?>" class="textfield_input" /></td>
         </tr>
<td align="right" valign="middle" width="220" class="data_description">Property ZIP:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="property_zip" value="<?php echo $formData['property_zip']; ?>" class="textfield_input" /></td>
         </tr>
            	<td align="right" valign="middle" width="220" class="data_description">Subdivision Name (If Applicable):</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="Subdivision Name" value="<?php echo $formData['subdivision_name']; ?>" class="textfield_input" /></td>
         </tr><tr>
	<td align="right" valign="middle" width="220" class="data_description">Lot:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="lot" value="<?php echo $formData['lot']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Block:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="block" value="<?php echo $formData['block']; ?>" class="textfield_input" /></td>
         </tr><tr>
	<td align="right" valign="middle" width="220" class="data_description">Section:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="section" value="<?php echo $formData['section']; ?>" class="textfield_input" /></td>
         </tr><tr>

			</table>
      </div>

      <h4>STEP 4:  PROPOSED TRANSACTION:</h4>
      <div class="box">
         <table width="100%" cellpadding="5" cellspacing="0" border="0">
         <tr>
         	<td align="left" valign="middle" colspan="2" class="data_description">What type of transaction is this regarding? &nbsp; &nbsp; &nbsp; <input type="radio" name="transaction_type" value="S" <?php if ($formData['transaction_type'] == 'P') echo 'CHECKED'; ?>/> Sale &nbsp; &nbsp; <input type="radio" name="transaction_type" value="R" <?php if ($formData['transaction_type'] == 'R') echo 'CHECKED'; ?> /> Refinance &nbsp; &nbsp; <input type="radio" name="transaction_type" value="F" <?php if ($formData['transaction_type'] == 'F') echo 'CHECKED'; ?> /> Foreclosure&nbsp; &nbsp; <input type="radio" name="transaction_type" value="O" <?php if ($formData['transaction_type'] == 'O') echo 'CHECKED'; ?> /> Other</td>
         </tr><tr>
<td align="right" valign="middle" width="220" class="data_description">If Other, please explain::</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="other_explain" value="<?php echo $formData['other_explain']; ?>" class="textfield_input" /></td>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Buyers Name (If Applicable):</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="buyer" value="<?php echo $formData['buyer']; ?>" class="textfield_input" /></td>
         </tr>
         </tr><tr>
         	<td align="right" valign="middle" width="220" class="data_description">Transaction Amt: (gross sales price, loan amount, or amount of lien being foreclosed, as applicable:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="sales_price" value="<?php echo $formData['sales_price']; ?>" class="textfield_input" /></td>
         </tr>
<td align="right" valign="middle" width="220" class="data_description">Anticipated Closing Date:</td>
            <td align="left" valign="middle" width="*" class="data_cell"><input type="text" name="closing_date" value="<?php echo $formData['closing_date']; ?>" class="textfield_input" /></td>
         </tr>
         </table>
</div>
         
         <h4>STEP 5: HOW CAN WE HELP YOU?</h4>
         	<textarea name="remarks" class="textarea_input"><?php echo $formData['remarks']; ?></textarea><br /><br />
      
      <div class="box">
			<input type="checkbox" name="certify" /> I certify that the above information is true to the best of my knowledge.  
      </div>
      
      <br />
      <input type="submit" name="request_info" value="Submit" class="submit_button" />

		</form>
