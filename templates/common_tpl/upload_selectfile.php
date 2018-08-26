
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
  <div><center><table border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td>
      <p align="center"><b>Daten Einspielen</b></td>
    </tr>
    <tr>
      <td>Folgende Einschränkungen gelten:<ul type="square">
        <li>Der Dateityp: <b>
<?php        
        if (($extensions == "") or ($extensions == " ") or ($ext_count == "0") or ($ext_count == "") or ($limit_ext != "yes") or ($limit_ext == "")) {
           echo "keine Einschränkung";
        } else {
        $ext_count2 = $ext_count+1;
        for($counter=0; $counter<$ext_count; $counter++) {
            echo "&nbsp; $extensions[$counter]";
        }
        }
        if (($limit_size == "") or ($size_limit != "yes")) {
            $limit_size = "keine Größenbeschränkung";
        } else {
            $limit_size .= " bytes";
        }
        ?>
        </b></li>
        <li>Maximale Dateigröße ist <?php echo $limit_size ?></li>
        <li>Keine Leerzeichen im Dateinamen</li>
        <li>Keine Sonderzeichen im Dateinamen  
        (/,*,\,etc)<BR>
        </li>
      </ul>
      <form method="POST" action="<?php echo $process_upload ?>" enctype="multipart/form-data">
<p align="center">
<input type="file" name="file" size="30" ><br>
<br>
<button name="submit" type="submit">Verarbeiten</button>
</p>
</form>
      <p>
</td>
    </tr>
  </table>
  </center>
</div>

  </td>
 </tr>
