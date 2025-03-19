<?php
	require_once __DIR__ . "/../config/db.php";

	class qrylogic{
		private $class_var;

		function __construct(){
			global $con;
			$this->class_var=$con;
		}

		

		//selecting * with logical operator
		function select_logic($table,$where1 = array(),$logic,$where2 = array()){
			global $con;
			$list = array();
			
		
			
			if(count($where1) === 3 AND  count($where2) === 3){
			$operators = array('=', '>', '<', '>=', '<=');

			$field1		= $where1[0];
			$operator1 	= $where1[1];
			$value1		= $where1[2];
			$field2		= $where2[0];
			$operator2 	= $where2[1];
			$value2		= $where2[2];

				if(in_array($operator1, $operators) AND in_array($operator2, $operators)) {
					$sql = "SELECT * FROM {$table} WHERE {$field1} {$operator1} '{$value1}' {$logic} {$field2} {$operator2} '{$value2}' ";				
					
					$qry = $con->query($sql);
			
					$rowcount = mysqli_num_rows($qry);
					
					//echo '<script>alert("'.rowcount.'");</script>';
										
					if ($rowcount!=0){
						for($x=1;$x<=$rowcount;$x++){
						$row = mysqli_fetch_assoc($qry);
						//print_r($row);
							
						$list[] = $row;
						}
						return $list;
					}
						return null;
				}
			}
		}
		
		/*sample procedure select_logic row
		$cemail = $func->select_logic('users',array('username','=','alex'),'AND',array('name','=','alex'));
		print_r($cemail);

		for($x=0;$x<count($cemail);$x++){
			
			echo $cemail[$x]['name'] .'<br>';
			
		}
		*/
		
		//selecting * with where parameters
		function select_one($table,$where = array()){
			global $con;
			$list = array();
		
			if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

				if(in_array($operator, $operators)) {
					$sql = "SELECT * FROM {$table} WHERE {$field} {$operator} '{$value}'";
									
					$qry = $con->query($sql);										
					$rowcount = mysqli_num_rows($qry);
				
					if ($rowcount!=0){
						for($x=1;$x<=$rowcount;$x++){
						$row = mysqli_fetch_assoc($qry);
						$list[] = $row;
						}
						return $list;
					}
						return null;
				}
			}
		}
		

		


		/*sample procedure select_one row
		
				$cemail = $func->select_one('users',array('username','=','alex'));
		print_r($cemail);

		for($x=0;$x<count($cemail);$x++){
			
			echo $cemail[$x]['name'] .'<br>';
			
		}
		*/

		//selecting * with where parameters
		function select_one_orderby($table,$where = array(),$orderfield,$sortorder){
			global $con;
			$list = array();
		
			if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

				if(in_array($operator, $operators)) {
					$sql = "SELECT * FROM {$table} WHERE {$field} {$operator} '{$value}' ORDER BY {$orderfield}  {$sortorder}  ";
									
					$qry = $con->query($sql);										
					$rowcount = mysqli_num_rows($qry);
				
					if ($rowcount!=0){
						for($x=1;$x<=$rowcount;$x++){
						$row = mysqli_fetch_assoc($qry);
						$list[] = $row;
						}
						return $list;
					}
						return null;
				}
			}
		}
		
		/*sample procedure select_one row
		
				$cemail = $func->select_one('users',array('username','=','alex'),'date','DESC');
		print_r($cemail);

		for($x=0;$x<count($cemail);$x++){
			
			echo $cemail[$x]['name'] .'<br>';
			
		}
		*/


		//selecting * with where parameters
		function select_one_orderbylimit($table,$where = array(),$orderfield,$sortorder,$start,$perPage){
			global $con;
			$list = array();
		
			if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

				if(in_array($operator, $operators)) {
					$sql = "SELECT * FROM {$table} WHERE {$field} {$operator} '{$value}' ORDER BY {$orderfield}  {$sortorder} LIMIT {$start}, {$perPage}";
									
					$qry = $con->query($sql);										
					$rowcount = mysqli_num_rows($qry);
				
					if ($rowcount!=0){
						for($x=1;$x<=$rowcount;$x++){
						$row = mysqli_fetch_assoc($qry);
						$list[] = $row;
						}
						return $list;
					}
						return null;
				}
			}
		}
		
		/*sample procedure select_one row
		
				$cemail = $func->select_one('users',array('username','=','alex'),'date','DESC');
		print_r($cemail);

		for($x=0;$x<count($cemail);$x++){
			
			echo $cemail[$x]['name'] .'<br>';
			
		}
		*/






		//selecting * with where  Like parameters
		function select_like($table,$where = array()){
			global $con;
			$list = array();


			if(count($where) === 3) {
				

			$field		= $where[0];
			$field2 	= $where[1];
			$value 	= $where[2];
			$valued = '%' . $value . '%';


			$sql = "SELECT * FROM {$table} WHERE {$field} LIKE '%{$valued}%' OR {$field2} LIKE '%{$valued}%'";

		
			}else if(count($where) === 4) {
				

			$field		= $where[0];
			$field2 	= $where[1];
			$field3 	= $where[2];
			$value 	= $where[3];
			$valued = '%' . $value . '%';
			

			
					$sql = "SELECT * FROM {$table} WHERE {$field} LIKE '%{$valued}%' OR {$field2} LIKE '%{$valued}%' OR {$field3} LIKE '%{$valued}%'";


				
			} else if(count($where) === 5) {
			

			$field		= $where[0];
			$field2 	= $where[1];
			$field3 	= $where[2];
			$value 	= $where[3];
			$sortorder 	= $where[4];
			$valued = '%' . $value . '%';


			$sql = "SELECT * FROM {$table} WHERE {$field} LIKE '%{$valued}%' OR {$field2} LIKE '%{$valued}%' OR {$field3} LIKE '%{$value}%' ORDER BY {$field} {$sortorder} ";
			
			}

			
					
						
					$qry = $con->query($sql);										
					$rowcount = mysqli_num_rows($qry);
				
					if ($rowcount!=0){
						for($x=1;$x<=$rowcount;$x++){
						$row = mysqli_fetch_assoc($qry);
						$list[] = $row;
						}
						return $list;
					}
						return null;
				
			
		


		}
		
		/*sample procedure select_like row
		
				$cemail = $func->select_one('users',array('fname','lname','mname','alex'));
		print_r($cemail);

		for($x=0;$x<count($cemail);$x++){
			
			echo $cemail[$x]['name'] .'<br>';
			
		}
		*/



		

		
		//generic select * function
		function selectall($table){
			global $con;
			
			$list = array();
			$sql = "SELECT * FROM {$table}";
			$qry = $con->query($sql);
			while($row = mysqli_fetch_assoc($qry)){
				$list[] = $row;
			}
			return $list;
		}

			/*	sample procedure selectall	
			$cemail = $func->selectall('users');
			print_r($cemail);

			for($x=0;$x<count($cemail);$x++){
				
				echo $cemail[$x]['password'] .'<br>';
				
			}
			*/

		//generic select * function
		function selectall_distinct($table,$todisct){
			global $con;
			
			$list = array();
			$sql = "SELECT DISTINCT {$todisct} FROM {$table}";
			$qry = $con->query($sql);
			while($row = mysqli_fetch_assoc($qry)){
				$list[] = $row;
			}
			return $list;
		}

			/*	sample procedure selectall	
			$cemail = $func->selectall('users');
			print_r($cemail);

			for($x=0;$x<count($cemail);$x++){
				
				echo $cemail[$x]['password'] .'<br>';
				
			}
			*/
		


		//generic select * function
		function selectall_where($table,$where = array()){
			global $con;
			
			$list = array();


			if(count($where) === 3) {	

			$field		= $where[0];
			$operator 	= $where[1];
			$value 	= $where[2];

			}

			$sql = "SELECT * FROM {$table} WHERE {$field} {$operator} '{$value}'";
			$qry = $con->query($sql);
			while($row = mysqli_fetch_assoc($qry)){
				$list[] = $row;
			}
			return $list;
		}


		



		function selectall_where_orderby($table,$where = array(),$col,$sortorder){
			global $con;
			
			$list = array();


			if(count($where) === 3) {	

			$field		= $where[0];
			$operator 	= $where[1];
			$value 	= $where[2];

			}

			$sql = "SELECT * FROM {$table} WHERE {$field} {$operator} '{$value}' ORDER BY {$col} {$sortorder}";
			$qry = $con->query($sql);
			while($row = mysqli_fetch_assoc($qry)){
				$list[] = $row;
			}
			return $list;
		}

		


		//generic select * function with sorting
		function selectallorderby($table,$col,$sortorder){
			global $con;
			
			$list = array();
			$sql = "SELECT * FROM {$table} ORDER BY {$col} {$sortorder}";
			$qry = $con->query($sql);
			while($row = mysqli_fetch_assoc($qry)){
				$list[] = $row;
			}
			return $list;
		}

			

				
		function delete($table,$where = array()){
			global $con;
			$list = array();
						
			if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

				if(in_array($operator, $operators)) {
					$sql = "DELETE FROM {$table} WHERE {$field} {$operator} '{$value}'";
									
					$qry = $con->query($sql);
					
					return true;
				}
			}
			return false;
		}
		
		/* delete procedure
			$cemail = $func->delete('users',array('username','=','Dale'));

			if ($cemail){
				echo "record Deleted";
			} else {
				echo "failed";
			}
		*/
		
		//generic insert function
		//  parameter table and fields
		function insert($table, $fields = array()) {
		global $con;
		$keys = array_keys($fields);
		$values = '';
		$x = 1;

				foreach($fields as $field) {
					$values .= "'".$field."'";
					if($x < count($fields)) {
						$values .= ', ';
					}
					$x++;
				}

		$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
		
		$qry = $con->query($sql);
		
		
		if($qry){
				return true;
			} else {	
				return false;
			}
	}
	  /* sample procedure for page
		$userInsert = $func->insert('users',array(
		'name' => 'Dale',
		'username' => 'Dale',
		'password' => 'password'
		));
		*/
				
		function update($table,$param, $param_value, $fields) {
			global $con;
		$set = '';
		$x = 1;

		foreach($fields as $name => $value) {
			$set .= "{$name} = '{$value}'";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE {$param} = {$param_value}";
		//echo $sql;
		$qry = $con->query($sql);
		if($qry){
				return true;
			} else {	
				return false;
			}
	}
	
		/* sample update procedure
			$userUpdate = $func->update('users','userid',3, array(
					'password' => 'newpassword', 
					 'name' => 'Dale Garret'
				));

				
			if ($userUpdate){
				echo "record updated";
			} else {
				echo "failed";
			}
		*/
				
	function uploadfiles($filetoupload,$dir){
		
		$error='';

  	//make the allowed extensions
	$goodExtensions = array(
  	'.jpg', '.png','.jpeg',); 
  	
  	//set the current directory where you wanna upload the doc/docx  or pdf files
	$uploaddir = $dir;
	//get the names of the file that will be uploaded
			
  	$fname = $_FILES[$filetoupload]['name'];	
  	$min_filesize=10;//set up a minimum file size(a doc/docx can't be lower then 10 bytes)
  	$stem=substr($fname,0,strpos($fname,'.'));
	
  	//take the file extension
  	$extension = substr($fname, strpos($fname,'.'), strlen($fname)-1);
	 	
	//verify if the file extension is jpeg or png or jpg
   	if(!in_array($extension,$goodExtensions) )
     $error.='Extension not allowed<br>';
	 echo "<span> </span>"; //verify if the file size of the file being uploaded is greater then 1
   
   	if(filesize($_FILES[$filetoupload]['tmp_name']) < $min_filesize )
     $error.='File size too small<br>'."\n";
  	$uploadfile = $uploaddir . $stem.$extension;
		
	$filename=$stem.$extension;
	
	//upload the file to

		if (move_uploaded_file($_FILES[$filetoupload]['tmp_name'], $uploadfile)) {
		//echo $fname .' has been uploaded... ' ;
		} 
		
	return $uploadfile;
		
	} //end of  upload


		function uploadfiles_extraname($filetoupload,$dir,$xname){
		
		$error='';

  	//make the allowed extensions
	$goodExtensions = array(
  	'.jpg', '.png','.jpeg',); 
  	
  	//set the current directory where you wanna upload the doc/docx  or pdf files
	$uploaddir = $dir;
	//get the names of the file that will be uploaded
			
  	$fname = $_FILES[$filetoupload]['name'];	
  	$min_filesize=10;//set up a minimum file size(a doc/docx can't be lower then 10 bytes)
  	$stem=substr($fname,0,strpos($fname,'.'));
	
  	//take the file extension
  	$extension = substr($fname, strpos($fname,'.'), strlen($fname)-1);
	 	
  	//rename
  	$stem= $stem.$xname;
	//verify if the file extension is jpeg or png or jpg
   	if(!in_array($extension,$goodExtensions) )
     $error.='Extension not allowed<br>';
	 echo "<span> </span>"; //verify if the file size of the file being uploaded is greater then 1
   
   	if(filesize($_FILES[$filetoupload]['tmp_name']) < $min_filesize )
     $error.='File size too small<br>'."\n";
  	$uploadfile = $uploaddir . $stem.$extension;
		
	$filename=$stem.$extension;
	
	//upload the file to

		if (move_uploaded_file($_FILES[$filetoupload]['tmp_name'], $uploadfile)) {
	//	echo $fname .' has been uploaded... ' ;
		} 
		
	return $uploadfile;
		
	} //end of  upload



		
	// End of functions
	}
	
	$qrys = new qrylogic();



?>
