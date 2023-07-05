<table>
<?php
	
	$sql0 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='U2' order by B_ACTY.D0600.ACTUALDT";
	
	$statment = oci_parse($connection,$sql0);
	oci_execute($statment);
	$no = 1;

	while($baris=oci_fetch_array($statment)){
?>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $baris['HMCD']; ?></td>
		<td><?php echo $baris['HMNM']; ?></td>
	
	</tr>
<?php
	$no++;
	}
?>
</table>
<?php
	oci_free_statement($statment);
	oci_close($connection);
?>