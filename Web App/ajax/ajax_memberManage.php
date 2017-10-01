<?php
include("../checkAdmin.php");
if(isset($_POST["Search"]))
{
	include("../checkToken.php");
	checkToken($_POST["_token"]);

	$_token = @$_POST["_token"];

	include("../controller/dbms.php");
	$obj = new dbms();

	if($_POST["Search"] != "")
	{
		$Search = @$_POST["Search"];

		$sql_comm = "SELECT * FROM `member_tb` WHERE 
		`mem_id`LIKE '%$Search%' OR 
		`mem_name` LIKE '%$Search%' OR
		`mem_date_reg` LIKE '%$Search%' OR 
		`mem_email` LIKE '%$Search%' OR 
		`mem_phone` LIKE '%$Search%' OR 
		`mem_level` LIKE '%$Search%'
		ORDER BY `mem_name` ASC";
	}
	else
	{
		$sql_comm = "SELECT * FROM `member_tb` ORDER BY mem_name ASC";
	}

	$result = $obj->dbms_select($sql_comm);
	$temp = "
	<tr>
		<th>id</th>	    
		<th>name</th>	    
		<th>email</th>	    
		<th>date_reg</th>	    
		<th>phone</th>	    
		<th>coin</th>	    
		<th>point</th>	    
		<th>level</th>
		<th>command</th>
		<th witdh='5%'></th>
	</tr>";
	echo $temp;
	foreach ($result as $key => $value) { ?>
	<tr>
		<td><?php echo $value->mem_id; ?></td>	    
		<td><?php echo $value->mem_name; ?></td>
		<td><?php echo $value->mem_email; ?></td>	    
		<td><?php echo $value->mem_date_reg; ?></td>	    
		<td><?php echo $value->mem_phone; ?></td>	    
		<td><?php echo $value->mem_coin; ?></td>	    
		<td><?php echo $value->mem_point; ?></td>	    
		<td><?php echo $value->mem_level; ?></td>
		<td><?php echo $value->mem_command_admin; ?></td>
		<td align="center">
		<a href="" onclick="popup('../controller/popup_admin_memberEdit.php?id=<?php echo $value->mem_id; ?>&_token=<?php echo $_token; ?>','',480,760);">
				<i class="ace-icon fa fa-pencil-square-o bigger-15"></i>
			</a>
		</td>    
	</tr>
	
	<?php }

	if(!$result)
		{ ?>
	<tr><td colspan="8"><center>ไม่พบข้อมูล</center></td></tr>
	<?php }
}
?>
