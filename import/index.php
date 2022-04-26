<?php
$con=mysqli_connect('localhost','root','','xltodata');
if(isset($_POST['submit'])){
	$file=$_FILES['doc']['tmp_name'];
	
	$ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
	if($ext=='xlsx'){
		require('PHPExcel/PHPExcel.php');
		require('PHPExcel/PHPExcel/IOFactory.php');
		
		
		$obj=PHPExcel_IOFactory::load($file);
		foreach($obj->getWorksheetIterator() as $sheet){
			$getHighestRow=$sheet->getHighestRow();
			for($i=0;$i<=$getHighestRow;$i++){
				$row0=$sheet->getCellByColumnAndRow(0,$i)->getValue();
				$row1=$sheet->getCellByColumnAndRow(1,$i)->getValue();
				$row2=$sheet->getCellByColumnAndRow(2,$i)->getValue();
				$row3=$sheet->getCellByColumnAndRow(3,$i)->getValue();
				$row4=$sheet->getCellByColumnAndRow(4,$i)->getValue();
				$row5=$sheet->getCellByColumnAndRow(5,$i)->getValue();
				$row6=$sheet->getCellByColumnAndRow(6,$i)->getValue();
				
				
				
				
				if($row0!=''){
					mysqli_query($con,"insert into xl2(`from_account`, `t_type`, `to_account`, `outlet_num`, `transection_id`, `t_amount`, `total_t_amount`) values('$row0','$row1','$row2','$row3','$row4','$row5','$row6')");
				}
			}
		}
	}else{
		echo "Invalid file format";
	}
}
?>
<form method="post" enctype="multipart/form-data">
	<input type="file" name="doc"/>
	<input type="submit" name="submit"/>
</form>