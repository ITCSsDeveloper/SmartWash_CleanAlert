<div class="main-content-inner" class="fade active in">
	<div class="row">
		<div class="col-md-6">
			<table width="100%">
				<tr>
					<td width="15%"><label>ช่องค้นหา : </label></td>
					<td><input type="text" id="Search" name="Search" onkeyup="Search()" onkeypress="Search()" onkeydown="Search()" placeholder="ID , ชื่อ , Email , Level , Phone , DATE" class="form-control" value=""></input></td>
					<td><button class="form-control" onclick="Clear()" ><i class="ace-icon fa fa-undo bigger-30"></i></button></td>
					<input type="hidden" id="Token" value="<?php echo $_token; ?>"></input>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<table id="ajax_memberManage" class="table table-striped table-bordered table-hover" width="100%"></table>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function(){
		Search();
	};
	function Search() {
		var Search = document.getElementById("Search").value;
		var Token = document.getElementById("Token").value;
		$.post('../ajax/ajax_memberManage.php',{ Search:Search, _token:Token },
			function(data)
			{
				document.getElementById("ajax_memberManage").innerHTML =  data;
			});
	};

	function Clear()
	{
		document.getElementById("Search").value = "";
		Search();
	}

	function popup(url,name,windowWidth,windowHeight)
	{      
		myleft=(screen.width)?(screen.width-windowWidth)/2:100;   
		mytop=(screen.height)?(screen.height-windowHeight)/2:100;     
		properties = "width="+windowWidth+",height="+windowHeight;  
		properties +=",scrollbars=yes, top="+mytop+",left="+myleft;     
		var www = window.open(url,name,properties); 
	}  
</script>