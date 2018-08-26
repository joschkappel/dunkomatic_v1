
<!-- --------------------------------- BODY --------------------------------- -->
  <td valign="top">
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
   
  
   <table border="0" cellpadding="10" cellspacing="0" width="100%">
    
    <tr>
     <td  "bgcolor="<?php echo $ACTION_COLOR?>" width="100*">

		<h3><?php echo $ACTION_RESULT ?></h3>
  
     </td>
    </tr>
    <tr>
      <td>
         <textarea name="result" cols="100" rows="30" wrap="virtual" readonly>
            <?php echo $ACTION_DATA ?>
         </textarea>
      </td>
            <td>
         <textarea name="fehler" cols="100" rows="30" wrap="virtual" readonly>
            <?php echo $ACTION_ERROR ?>
         </textarea>
      </td>
    </tr>
   </table>
  </td>
 </tr>

 