 <?php
/**
* Database Class
*/ 
class Functions extends cn
{
    use operation;
	use html_function;
	public $lastid;
	public $rowcount;
	public $secured;

	 
	function __construct($database='')
	{
		parent:: __construct($database);
	}
	public function insert($sql)
	{

		$ok = 1;
		if ($ok == 1) {
			$stmt = $this->db->prepare($sql);
			 $cond =  $stmt->execute();
			 $this->lastid = $this->db->lastInsertid();
			 if($cond == 1){
			 	return true;
			 }
			 return false;
		}else{
			return false;
		}
		
	}
	public function edit($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); // affected rows
    }



	public function getdata($sql,$rowcount=false)
	{
		try {
			$stmt= $this->db->prepare($sql);
		    $stmt->execute();
		    if ($rowcount) {
		    	return $stmt->rowCount();
		    }else{
		    	return $stmt->fetchAll();
		    }
		} catch (PDOException $e) {
			return [];
		}
	}
	public function row_count($sql)
	{
		$stmt= $this->db->prepare($sql);
	  $stmt->execute();
		return $stmt->rowCount();
	}
	public function qgetdata($sql,$col="",$value=0,$value_return = '')
	{

		$sql = "select * from $sql";
		if ($col != "") {
			$sql .= "  where $col = $value";
		}
		
		
		$stmt= $this->db->prepare($sql);
	    $stmt->execute();
		$this->rowcount = $stmt->rowCount();
		if ($value_return != '') {
			$d = $stmt->fetchAll();

			if (isset($d[0])) {
				return $d[0][$value_return];
			}


		}else{
			return $stmt->fetchAll();
		}
		
	}



	public function delete($sql)
	{
	    try{
		$stmt= $this->db->prepare($sql);
		return $stmt->execute();
	    } catch (Exception $e) {
			return false;
		}
	}
	public function aut($sql,$value="")
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		if ($value == "") {
			return $stmt->rowCount();
		}
		else
		{
			return true;
		}
	}
	public function qaut($table,$colm,$value)
	{
		$sql = 'select * from $table where $colm ='.$value;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount();

	}

	
	public function adddata($tablename,$data){
		$ok = 1;
		if ($ok == 1) {
			$keys = implode(",", array_keys($data));
			$k = ':'.implode(", :",array_keys($data));

			$sql = "insert into $tablename($keys) values($k)";
			$stmt = $this->db->prepare($sql);
			foreach ($data as $key => $value) {
				$stmt->bindValue($key,$value);
			}
			$cond = $stmt->execute();
			$this->lastid = $this->db->lastInsertId();
			if($cond == 1){
				return true;
			}
			else{
				$this->Error = $stmt->errorInfo();
			}
		}else{
			return false;
		}
		


	}
	public function qedit($tablename,$array,$idtype,$val,$oqury=''){
		
		try {
			$keys = null;
			if (!is_numeric($val)) {
				$val = '"'.$val.'"';
			}
			foreach ($array as $key=>$value) {
				$keys .= ", $key = :$key";
			}
			$keyss = ltrim($keys, ",");
			$sql = "update $tablename set $keyss where ".$idtype." =".$val;
			if ($oqury != '') {
				$sql .= $oqury;
			}
			$stmt = $this->db->prepare($sql);
			foreach ($array as $key => $value) {
				$stmt->bindValue($key,$value);
			}
			return $stmt->execute();
		} catch (Exception $e) {
			return false;
		}
	}

	public function getAll($table,$where='',$fields = '*',$debug=0)
	{
		$sql = "select $fields from $table where id > 0".$where;
		if ($debug === 1) {
			echo $sql;
		}
		$ar = $this->getdata($sql);
		if ($ar) {
			return $ar[0];
		}
	}


	public function getFull($table, $where = '',$rowcount=false)
    {
        $ar = $this->getdata("select * from $table where id > 0".$where,$rowcount);
		return $ar;
    }


public function rpost($value,$rep='')
{
	$ar = array();
	foreach ($value as $key => $val) {
		if (isset($_POST[$val])) {
			$pkey = $val;
			if ($rep != '') {
				$pkey = str_replace($rep, '', $val);
			}
			$ar[$pkey] = $_POST[$val];
		}
	}
	return $ar;
}

public function st($starts,$ends,$v,$fil=0){

  if ($fil == 0) {
  	$starts = 'data-spec="'.$starts.'">';
  	$ends = '</'.$ends.'>';
  }
  if (strpos($v, $starts) !== false) {
  	  $start = strpos($v, $starts);
	  $end = strpos($v, $ends, $start);
	  $length = $end-$start;
	  $output = substr($v, $start, $length);
	  
	  if ($fil == 0) {
	  	return strip_tags(str_replace($starts, '', $output));
	  }
	  else
	  {
	  	return $output;
	  }
  }
  
}
public function token()
{
	return '<input type="hidden" name="token" value="'.$_SESSION['token'].'">';
}

public function check_token()
{
	return @$_POST['token'] == @$_SESSION['token']?1:0;
}
public function unset_ses($value)
{
	if (isset($_SESSION[$value])) {
		unset($_SESSION[$value]);
	}
}

public function unset_ar($ar,$unset_value)
{
	if (!empty($unset_value)) {
		foreach (explode(',', $unset_value) as $v) {
			if (isset($ar[$v])) {
				unset($ar[$v]);
			}
		}
	}
	return $ar;
}


public function dom($code,$tag)
{
   $dom = new DOMDocument;
   @$dom->loadHTML($code);
  return $tag = $dom->getElementsByTagName($tag);
}
public function getbetweenall($str, $startDelimiter, $endDelimiter) {
  $contents = array();
  $startDelimiterLength = strlen($startDelimiter);
  $endDelimiterLength = strlen($endDelimiter);
  $startFrom = $contentStart = $contentEnd = 0;
  while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
    $contentStart += $startDelimiterLength;
    $contentEnd = strpos($str, $endDelimiter, $contentStart);
    if (false === $contentEnd) {
      break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + $endDelimiterLength;
  }
  return $contents;
}



public function replace_between($str, $needle_start, $needle_end, $replacement) {
    $pos = strpos($str, $needle_start);
    $start = $pos === false ? 0 : $pos + strlen($needle_start);

    $pos = strpos($str, $needle_end, $start);
    $end = $pos === false ? strlen($str) : $pos;

    return substr_replace($str, $replacement, $start, $end - $start);
}



 

public function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}


public function read_file($loc)
{
    if (!empty($loc) && file_exists($loc) && filesize($loc) > 0) {
        return file_get_contents($loc);
    }
    return false;
}




public function texttofile($loc='',$val='')
{
	if ($loc != '' and $val != '') {
		$file = fopen($loc, "w") or die("Unable to open file!");
		$write = fwrite($file, $val);
		fclose($file);
		return true;
	}else{
		return false;
	}
}

public function filetotext($loc='')
{
	if ($loc != '') {
		$file = fopen($loc, "r") or die("Unable to open file!");
		if(filesize($loc) > 0){
			$data = fread($file,filesize($loc));
		fclose($file);
		return $data;
	}else{
		return false;
	}
		
	}else{
		return false;
	}
}



public function writejson($loc='',$array=array())
{
	$lv = strstr($loc, '/',true);
	if ($loc != '' and file_exists($loc) and $lv == 'idata') {
		$file = fopen($loc, "w") or die("Unable to open file!");

		if (!empty($array) and is_array($array)) {
			$en = json_encode($array);
		}else{
			if (is_array($array)) {
				$en = '';
			}else{
				$en = $array;
			}
			
		}
		$write = fwrite($file, $en);
		fclose($file);
		return true;
	}else{
		return false;
	}
}

	
public function getfile($loc='')
{
	$ar = array();
	$ar = scandir($loc);
	$ar = array_slice($ar, 2);
	return $ar;
	
}



public function getm($mname,$url='')
{
	if ($url == '') {
		$url = $_SERVER['REQUEST_URI'];
	}
	$parts = parse_url($url);
	if (isset($parts['query'])) {
		parse_str($parts['query'], $query);
		if (isset($query[$mname])) {
			return $query[$mname];
		}else{
			return false;
		}
	}else{
		return false;
	}
	
	
}
public function getip(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}




public function getid($url='',$sym='_')
{
	$pos = strrpos($url, $sym);
	$id = $pos === false ? $url : substr($url, $pos + 1);
	return $id;
}


public function logout()
{
	if (isset($_SESSION)) {
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$value]);
		}
	}
}



public function render_body($db){
    $pg = 'dashboard';
    $admin_ar = $db->getFull('admin',' and id ='.$db->uid())[0];
    $all_page_name = !empty($admin_ar['page_permission'])?$admin_ar['page_permission']:$db->getonecol('page_permission','user_type','id',$admin_ar['user_type_id']);
    $permission = explode(',', $all_page_name);
	$company_ar = $this->getAll('settings',' and id =1');    
    if(isset($_GET['e'])){
		$url = $_GET['e'];
		$url = rtrim($url,"/");
		$url = explode("/", $url);
        if(file_exists('page/'.$url[0].'.php')){
            if($db->aut('select * from pages where url = "'.$url[0].'"')){
                $pg = in_array('view_'.$url[0], $permission)?$url[0]:'404';
            }else{
                $pg = $url[0];
            }
        }else{
             $pg = '404';
        }
    }
    if(isset($url[0])){
        $db->adddata('visitor',['date'=>$db->cdate('Y-m-d H:i:s'),'page'=>$url[0],'ip'=>$db->getip(),'url'=>str_replace(domain,'',$db->getCurrentUrl()),'admin_id'=>$db->uid()]);
    }
    
    include_once 'page/header.php';
    include_once 'page/'.$pg.'.php';
    include_once 'page/footer.php';
    
}



public function st_render_body($db){
    $pg = 'dashboard';

    if(isset($_GET['e'])){
		$url = $_GET['e'];
		$url = rtrim($url,"/");
		$url = explode("/", $url);
        if(file_exists('page/'.$url[0].'.php')){
            $pg = $url[0];
        }else{
             $pg = '404';
        }
    }
    
    if(isset($url[0])){
        $db->adddata('visitor',['date'=>$db->cdate('Y-m-d H:i:s'),'page'=>$url[0],'ip'=>$db->getip(),'url'=>str_replace(domain,'',$db->getCurrentUrl()),'student_id'=>$db->st_id()]);
    }

    include_once 'page/header.php';
    include_once 'page/'.$pg.'.php';
    include_once 'page/footer.php';
    
}



public function getCurrentUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || 
                 $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    return $protocol . $host . $requestUri;
}

public function rpv($value)
{
	if (isset($_POST[$value])) {
		return $_POST[$value];
	}else{
		return '';
	}
}

public function rget($value)
{
	if (isset($_GET[$value])) {
		return $_GET[$value];
	}else{
		return '';
	}
}


public function redirect($pg)
{
    header("Location:".$pg);
    exit();
}

public function refpg()
{
    return $_SERVER['HTTP_REFERER'];
}

public function domain()
{
    return domain;
}
public function setdate($date)
{
    return !empty($date)&&$date!='0000-00-00'?date('d M, Y', strtotime($date)):'';
}
public function settime($date)
{
    return !empty($date)&&$date!='00:00:00'?date('g:i a', strtotime($date)):'';
}


public function empty_check($values_ar,$array,$red=true)
{   
    if(is_array($values_ar)){
        foreach($values_ar as $key => $v){
            if(isset($array[$key])){
                if(trim($array[$key]) == ''){
                    $_SESSION['msg'] = $v;
                    if($red){
                        $this->redirect($this->refpg());
                    }
                    
                }
            }
        }
    }
}

public function getonecol($col, $tbl, $comCol, $comVal) {
    $sql = "SELECT $col FROM $tbl WHERE $comCol='$comVal' order by id desc";
    foreach($this->getdata($sql) as $v){
        if (isset($v[$col])) {
          return $v[$col];
        }
    }
}
public function cdate($date="Y-m-d")
{
	$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
  	return $dt->format($date);
}



public function get_user_id()
{
    if(isset($_SESSION['user_id'])){
        return $_SESSION['user_id'];
    }else{
        return 0;
    }
 
}




public function is_login()
{
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
}
public function is_customer()
{
    if(isset($_SESSION['customer_id'])){
        return true;
    }else{
        return false;
    }
}

public function uid()
{
    if(isset($_SESSION['user_id'])){
       return $_SESSION['user_id']; 
    }
}
public function st_id()
{
    if(isset($_SESSION['student_id'])){
       return $_SESSION['student_id']; 
    }
}

public function pure_text($text)
{
	return str_replace(['&','"',"'"], ['&amp;','&quot;','&apos;'], $text);
}

public function image_upload($name, $loc, $limit = 9900000, $img_name = '',$add_extra_text='')
{
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'image/webp'];
    $image = '';

    if (isset($_FILES[$name]) && !empty($_FILES[$name]['name'])) {
        $fileTmpPath = $_FILES[$name]['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);

        if (!in_array($fileType, $allowedMimeTypes)) {
            return '';
        }

        // Check image width (if not PDF)
        if ($fileType !== 'application/pdf') {
            $imageInfo = getimagesize($fileTmpPath);
            if ($imageInfo === false || $imageInfo[0] < 5) {
                return '';
            }
        }

        $originalName = basename($_FILES[$name]['name']);
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $timestamp = time();

        if ($img_name !== '') {
            $img_name = preg_replace('/[^A-Za-z0-9_\-]/', '', $img_name);
            $image = (strpos($img_name, '.') === false) ? $img_name . '.' . $ext : $img_name;
        } else {
            $sanitizedName = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $originalName);
            $image = $add_extra_text.$timestamp . $sanitizedName;
        }

        $destinationPath = rtrim($loc, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $image;

        if (!move_uploaded_file($fileTmpPath, $destinationPath)) {
            return '';
        }
    }

    // Return uploaded image OR fallback to old image name from form
    return !empty($image) ? $image : ($_POST[$name] ?? '');
}


public function dictionary_number()
{
	return [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        100000 => 'Lakh',
        10000000 => 'Core',
    ];
}


public function convert($number) {
        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return 'negative ' . $this->convert(abs($number));
        }

        $string = '';

        if ($number < 21) {
            $string = $this->dictionary_number()[$number];
        } elseif ($number < 100) {
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $this->dictionary_number()[$tens];
            if ($units) {
                $string .= '-' . $this->dictionary_number()[$units];
            }
        } elseif ($number < 1000) {
            $hundreds = (int)($number / 100);
            $remainder = $number % 100;
            $string = $this->dictionary_number()[$hundreds] . ' ' . $this->dictionary_number()[100];
            if ($remainder) {
                $string .= ' ' . $this->convert($remainder);
            }
        } else {
            foreach ([10000000 => 'Core', 100000 => 'Lakh', 1000 => 'thousand'] as $baseUnit => $unitName) {
                if ($number >= $baseUnit) {
                    $numBaseUnits = (int)($number / $baseUnit);
                    $remainder = $number % $baseUnit;
                    $string = $this->convert($numBaseUnits) . ' ' . $unitName;
                    if ($remainder) {
                        $string .= $remainder < 100 ? ' ' : ' ';
                        $string .= $this->convert($remainder);
                    }
                    break;
                }
            }
        }

       return ucwords($string);
}

 public function input_file($file='',$loc='')
	{
		$loc=!empty($loc)?$loc:'student';
		$data = '';$ex = ['jpg','jpeg','png','gif','webp'];
		if ($file != '' and file_exists('image/'.$loc.'/'.$file)) {
			if (in_array($this->getid($file,'.'), $ex)) {
				$data = '<img src="'.domain.'image/'.$loc.'/'.$file.'" style="position: absolute;right: 0px;top: 0px;max-height: 30px;">
				<i class="fa fa-trash input_image_delete" data-file="'.$file.'" data-fol="'.$loc.'" style="position: absolute;right: -6px;top: 2px;max-height: 30px;cursor: pointer;"></i>';
			}else{
				$data = '<a href="'.domain.'image/'.$loc.'/'.$file.'" target="_blank" style="position: absolute;right: 4px;top: 33px;">..'.substr($file,-10).'</a>';
			}
			
		}
		return $data;
	}

	public function input($ar)
	{
		/*
		##Using method
		view_type => hr means horizental and defoult vertical

		*/

		$class = @$ar['class'].' form-control form-control-sm';
		$name = isset($ar['name'])?$ar['name']:'';
		$value = isset($ar['value'])?$ar['value']:'';
		$title = isset($ar['title'])?$ar['title']:ucwords($name);
		$placeholder = isset($ar['placeholder'])?$ar['placeholder']:$title;
		$col = isset($ar['col'])?$ar['col']:'6';
		$type = isset($ar['type'])?$ar['type']:'text';
		$attr = isset($ar['attr'])?$ar['attr']:'';
		$parent_class = isset($ar['parent_class'])?$ar['parent_class']:'';
		$parent_attr = isset($ar['parent_attr'])?$ar['parent_attr']:'';
		$img_folder = isset($ar['img_folder'])?$ar['img_folder']:'';
		$title_status = isset($ar['title_status'])?$ar['title_status']:1;
		$view_type = @$ar['view_type'];
		
		if (strpos(strtolower($attr), 'required')!==false) {
			$req_span = ' <span class="red">*</span>';
		}else{
			$req_span = '<span class="red"></span>';
		}
		$no_col = 'col-md-'.$col;
		if(isset($ar['no_col']) && $ar['no_col'] == 'no'){
		    $no_col = 'no_col';
		}
		$data = '<div class="'.$no_col.' '.$parent_class.'" '.$parent_attr.'>';

    		$data .= $view_type == 'hr'?'<div class="form-group row no-gutters">':'<div class="form-group">';
    			$data .= $view_type == 'hr'?'<div class="col-md-4">':'';
    			$data .= $title_status?'<label for="'.$name.'" class="form-label">'.$title.$req_span.'</label>':'';
    			$data .= $view_type == 'hr'?'</div>':'';

    			$data .= $view_type == 'hr'?'<div class="col-md-8">':'';

    			if ($type == 'file') {
    				$data .= '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
    				$data .= $this->input_file($value,$img_folder);
    			}
    			if ($type == 'textarea') {
    				$data .= '<textarea name="'.$name.'" '.$attr.' id="'.$name.'" class="'.$class.'" placeholder="'.$placeholder.'">'.$value.'</textarea>';
    			}elseif ($type == 'select') {
    				$data .= '<select name="'.$name.'" '.$attr.' id="'.str_replace(['[',']'],'',$name).'" class="'.$class.'">';
    				if (isset($ar['blank'])) {
    					$data .= '<option value="">Select'.($title_status==0?' '.$title:'').'</option>';
    				}

    				if (isset($ar['select_value_type'])) {
    					foreach ($ar['select_ar'] as $key => $v) {
    						if ($ar['select_value_type'] == 'value') {
    							$data .= '<option value="'.$v.'" ';
		    					$data .= $value==$v?'selected':'';
		    					$data .= '>'.$v.'</option>';
    						}elseif ($ar['select_value_type'] == 'key_value') {
    							$data .= '<option value="'.$key.'" ';
		    					$data .= $value==$key?'selected':'';
		    					$data .= '>'.$v.'</option>';
    						}
	    				}
    				}else{
    					foreach ($ar['select_ar'] as $key => $v) {
	    					$data .= '<option value="'.$v['id'].'" ';
	    					$data .= $value==$v['id']?'selected':'';
	    					$data .= isset($ar['select_op_add_attr'])?' data-code="'.$v[$ar['select_op_add_attr']].'"':'';
	    					$data .= isset($ar['data-attr'])?' data-'.$ar['data-attr'].'="'.$v[$ar['data-attr']].'"':'';
	    					$data .= '>'.$v['name'].'</option>';
	    				}
    				}

    				$data .= '</select>';
    			}else{
    				if (strlen($placeholder) > 0) {}else{
    					$placeholder = !empty($title)?'Enter '.$title:'';
    				}
    				$data .= '<input type="'.$type.'" name="'.$name.'" class="'.$class.'" '.$attr.' id="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" />';
    			}

    			$data .= $view_type == 'hr'?'</div>':'';
    			
    		$data .= '</div>
    	</div>';
    	return $data;
	}

	public function start_modal($title='',$width='650px',$form='<form method="post" id="form_area" enctype="multipart/form-data">',$modal_head=1)
	{
		$html = ' 
		<style>
	        .modal-dialog {
		        max-width: '.$width.';
		    } 
	    </style>';
	    if (!empty($title) && $modal_head == 1) {
	    	$html .= '<div class="modal-header">
		    <h1 class="modal-title fs-5" id="staticBackdropLabel">'.$title.'</h1>
		    <button type="button" class="fa fa-times close" data-dismiss="modal" aria-label="Close"></button>
	  	</div>';
	    }
	  if (!empty($form)) {
	  	$form .= $this->token();	
	  }
	  $html .= $form.'
	  <div class="modal-body">';
	  return $html;
	}
	public function modal_footer($id='',$btn_name='save')
	{
		return ' 
		<div class="modal-footer">
	    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
	    <button type="submit" class="btn btn-success btn-sm" value="'.@$id.'" name="'.$btn_name.'">Save</button>
	  </div>';
	}


	public function set_key_from_ar($ar,$index)
	{
		$data = [];
		foreach ($ar as $key => $value) {
			$data[@$value[$index]] = $value;
		}
		return $data;
	}
	public function check_value_in_ar($ar,$search_index,$search_value)
	{
		$status = 0;
		foreach ($ar as $key => $value) {
			if (@$value[$search_index] == $search_value) {
				$status = 1;
			}
		}
		return $status;
	}
	public function blood()
	{
		return ['A+','B+','A-','O+','O-','AB+','AB-','B-'];
	}


	

	public function get_due($id,$date='',$col='student_id',$date_type='date')
	{
		$where = !empty($date)?" and $date_type < '$date'":'';
		return $this->getdata('select (sum(debit)-sum(credit)) as due from ledgers where '.$col.' ='.$id.$where)[0]['due'];
	}
	public function nf($v,$precc=2)
	{
		if ($v != 0) {
			return number_format($v,$precc);
		}else{
		    return '0.00';
		}
	} 
	public function method()
	{
		return ['cash'=>'Cash','bank'=>'Bank','online'=>'Online','bkash'=>'Bkash','nagad'=>'Nagad'];
	}


	public function head($title='',$size='def',$img_status=1)
	{	
		$img_stye = 'position: absolute;left: 0;top: -6px;';
		$hd_style = 'font-size: 30px;';
		if ($size == 'sm') {
			$hd_style = 'font-size:22px;';
			$img_stye .= 'width:110px;';
		}
		$ar = $this->getAll('settings',' and id =1');
		$html = '
		<div style="'.($img_status == 1?'width: 75%;min-width:500px;':'').'margin: 0 auto;text-align: center;overflow:hidden" class="company_info_area">
         <div style="position: relative;" class="pad_head_box">';
         if($img_status != 'hide'){
            $html .= '<img src="'.domain.'image/logo/'.$ar['logo'].'" class="logo pad_logo" style="'.$img_stye.'">'; 
         }
           
            $html .= '<h2 class="company_title" style="'.$hd_style.'margin:0;padding:0;color:black">'.$ar['name'].'</h2>
            <p class="head_address" style="font-size:18px;margin:0;padding:0;color:black">'.$ar['address'].'</p>'.$title.'
         </div>
       </div>
		';
        return $html;
	}
	public function get_age($date, $ref_date = null)
    {
        if (!empty($date)) {
            $birthdate = DateTime::createFromFormat('Y-m-d', $date);
            $today = $ref_date ? DateTime::createFromFormat('Y-m-d', $ref_date) : new DateTime('now');
            if (!$birthdate || !$today) {
                return '';
            }
    
            $age = $today->diff($birthdate);
            $data = '';
    
            if ($age->y > 0) {
                $data .= $age->y . ' years ';
            }
            if ($age->m > 0) {
                $data .= $age->m . ' months ';
            }
            if ($age->d > 0) {
                $data .= $age->d . ' days';
            }
    
            return trim($data);
        }
        return '';
    }



	public function checkbox($ar=[])
	{
		$html = '<div class="checkbox-wrapper-4">
            <input class="inp-cbx '.@$ar['class'].' '.@$ar['id'].'" id="'.@$ar['id'].'" name="'.@$ar['name'].'" value="'.@$ar['value'].'" type="'.(!empty(@$ar['type'])?@$ar['type']:'checkbox').'" '.@$ar['attr'].' '.(@$ar['checked']==@$ar['value']&&strlen(!empty(@$ar['checked'])?@$ar['checked']:'')>0?'checked':'').'/>
            <label class="cbx" for="'.@$ar['id'].'"><span>
            <svg width="12px" height="10px">
              <use xlink:href="#check-4"></use>
            </svg></span>';
            if (!empty(@$ar['title'])) {
            	$html .= '<span>'.$ar['title'].'</span>';
            }
            $html .= '</label>
            <svg class="inline-svg">
              <symbol id="check-4" viewbox="0 0 12 10">
                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
              </symbol>
            </svg>
        </div>';

        return $html;
	}

	public function weekDays($index='')
	{
		$weekDays = [
		    'Sun' => 'Sunday',
		    'Mon' => 'Monday',
		    'Tue' => 'Tuesday',
		    'Wed' => 'Wednesday',
		    'Thu' => 'Thursday',
		    'Fri' => 'Friday',
		    'Sat' => 'Saturday'
		];
		return !empty($index)?@$weekDays[$index]:$weekDays;
	}

	public function get_admin($id,$index='')
	{
		$ar = $this->getAll('admin',' and id ='.$id);
		return !empty($index)&&isset($ar[$index])?$ar[$index]:$ar;
	}
	public function ar2v($ar,$index)
	{
		if (is_array($ar)) {
			if (isset($ar[$index])) {
				return $ar[$index];
			}
		}
	}
	public function colors($index = '',$visible = '0.25')
	{
	    $colors = [
	    	'rgba(144, 238, 144, '.$visible.')',  // Light Green 2
	        'rgba(217, 233, 255, '.$visible.')',  // Light Blue
	        'rgba(255, 217, 217, '.$visible.')',  // Light Red
	        'rgba(217, 255, 217, '.$visible.')',  // Light Green
	        'rgba(255, 255, 217, '.$visible.')',  // Light Yellow
	        'rgba(217, 255, 255, '.$visible.')',  // Light Cyan
	        'rgba(255, 217, 255, '.$visible.')',  // Light Magenta
	        'rgba(255, 182, 193, '.$visible.')',  // Light Pink
	        'rgba(173, 216, 230, '.$visible.')',  // Light Sky Blue
	        
	        'rgba(255, 239, 213, '.$visible.')',  // Papaya Whip
	        'rgba(240, 248, 255, '.$visible.')',  // Alice Blue
	        'rgba(255, 250, 240, '.$visible.')',  // Floral White
	        'rgba(240, 255, 255, '.$visible.')',  // Azure
	        'rgba(255, 228, 225, '.$visible.')',  // Misty Rose
	        'rgba(245, 245, 220, '.$visible.')',  // Beige
	        'rgba(255, 240, 245, '.$visible.')',  // Lavender Blush
	        'rgba(230, 230, 250, '.$visible.')',  // Lavender
	        'rgba(255, 250, 250, '.$visible.')',  // Snow
	        'rgba(250, 235, 215, '.$visible.')',  // Antique White
	        'rgba(245, 255, 250, '.$visible.')',  // Mint Cream
	    ];

	    if (!empty($index) && isset($colors[$index])) {
	        return $colors[$index];
	    }
	}

	public function avg_grade($grades, $point)
	{
	    // Sort grades in descending order of point
	    arsort($grades);

	    foreach ($grades as $grade => $minPoint) {
	        if ($point >= $minPoint) {
	            return $grade;
	        }
	    }

	    return null; // If point is below all grade thresholds
	}


	public function set_zero($n,$d=4)
	{
		$formatted = str_pad($n, $d, '0', STR_PAD_LEFT);
		return $formatted;

	}
	public function show_zero($n)
	{
		return empty($n)?'0.00':$n;;

	}
	

	
	public function remove_numeric_index($ar)
	{
		$data = [];
		foreach ($ar as $key => $value) {
			$single = [];
			foreach ($value as $key => $rows) {
				if (!is_numeric($key)) {
					$single[$key] = $rows;
				}
			}
			$data[] = $single;
		}
		return $data;
	}

	
	public function in_sql($value='',$col='id')
	{
		return !empty($value)?' and '.$col.' in('.$value.')':'';
	}

	public function bus_type()
	{
		return [1=>"Large Bus",2=>"Mini Bus",3=>'AC Bus'];
	}

	public function get_method($index='')
	{
		$ar = [];
		foreach ($this->getFull('method') as $key => $v) {
			$ar[$v['id']] = ['name'=>$v['name'],'parent_id'=>$v['parent_id']];
		}
		if (!empty($index)) {
			$parent_id = isset($ar[$index])?$ar[$index]['parent_id']:'';
			$parent_name = isset($ar[$parent_id])?$ar[$parent_id]['name']:'';
			if (!empty($parent_name)) {
				return $parent_name.' ('.(isset($ar[$index])?$ar[$index]['name']:'').')';
			}else{
				return isset($ar[$index])?$ar[$index]['name']:'';
			}
			
		}else{
			return $ar;
		}
		
	}
	public function get_method_option($selected_id=0)
	{
		$html = '';
		foreach ($this->getFull('method',' and parent_id = 0') as $key => $v) {
			$ar[$v['id']] = $v['name'];
			$sub_acc = '';
			foreach ($this->getFull('method',' and parent_id = '.$v['id']) as $key => $s) {
				$sub_acc .= '<option value="'.$s['id'].'" ';
				$sub_acc .= $selected_id == $s['id']?'selected':'';
				$sub_acc .= '>&nbsp;&nbsp;&nbsp;&nbsp;'.$s['name'].'</option>';
			}
			$html .= '<option data-other="'.$v['other'].'" value="'.$v['id'].'" '.(!empty($sub_acc)?'disabled':'').' ';
			$html .= $selected_id == $v['id']?'selected':'';
			$html .= '>'.$v['name'].'</option>'.$sub_acc;
			
		}
		return $html;
	}

	public function getUniqueValues($json, $key) {
	    $data = json_decode($json, true);
	    $values = [];
	    if (is_array($data)) {
	    	foreach ($data as $row) {
		        if (!empty($row[$key])) {
		            $values[] = $row[$key];
		        }
		    }
	    }
	    
	    return implode(',', array_unique($values));
	}

	public function st_link($id,$name,$target='_blank')
	{
		return '<a href="'.domain.'student_profile&id='.$id.'" target="'.$target.'">'.$name.'</a>';
	}
	public function link($id,$name,$type='student',$target='_blank')
	{
		$l = '';
		if ($type == 'student') {
			$l = 'student_profile&id='.$id;
		}elseif ($type == 'user') {
			$l = 'user_profile&id='.$id;
		}elseif ($type == 'ledger') {
			$l = 'ledger&id='.$id;
		}
		return '<a href="'.domain.$l.'" target="'.$target.'">'.$name.'</a>';
	}
	public function make_space($num)
	{
		$s = '';
		for ($i=0; $i <= $num; $i++) { 
			$s .= '&nbsp;';
		}
		return $s;
	}
	public function buildTree(array $elements, $parentId = 0) {
	    $branch = [];

	    // Build a map of all element IDs
	    $ids = array_column($elements, 'id');

	    foreach ($elements as $element) {
	        // If parentid matches, or parentid doesn't exist in data (orphan)
	        if ($element['parentid'] == $parentId || 
	            ($parentId == 0 && !in_array($element['parentid'], $ids))) {
	            
	            $children = $this->buildTree($elements, $element['id']);
	            if ($children) {
	                $element['children'] = $children;
	            }
	            $branch[] = $element;
	        }
	    }

	    return $branch;
	}
	public function getAllChildrenIds(array $elements, $parentId,$include_this_id=0) {
	    $childrenIds = [];

	    foreach ($elements as $element) {
	        if ($element['parentid'] == $parentId) {
	            $childrenIds[] = $element['id'];
	            // Recursive call to get children of this child
	            $childIds = $this->getAllChildrenIds($elements, $element['id']);
	            if (!empty($childIds)) {
	                $childrenIds = array_merge($childrenIds, explode(',', $childIds));
	            }
	        }
	    }
	    if ($include_this_id == 1) {
	    	$childrenIds[] = $parentId;
	    }
	    return implode(',', $childrenIds);
	}


	public function option_group_tree($ar,$left_space=0,$selected_id='')
	{
	  	foreach ($ar as $key => $value) {
	  		echo '<option class="'.$class.'" value="'.$value['id'].'" ';
		    echo $selected_id == $value['id']?'selected':'';
		    echo '>'.$this->make_space($left_space).$value['name'].'</option>';
	      	if (isset($value['children'])) {
	        	$this->option_group_tree($value['children'],$left_space+3,$selected_id);
	      	}
	  	}
	  
	}

	public function get_ledger_ids($groups)
	{
		$ids = '';
	  	foreach ($this->getFull('ledger_name',' and groups_id in('.$groups.')') as $key => $v) {
	  		$ids .= $v['id'].',';
	  	}
	  	return trim($ids,',');
	}
	


public function get_courier(){
    return ['Steadfast','E-courier','Tiger','Sundorbon','Redx'];
}
public function get_voucher_num($id,$type)
{
	$type_ar = ['journal','contra','sales','purchase','sales-return','purchase-return','collection','payment','req'];
	$replace = ['JV','CV','SI','PI','SRI','PRI','RV','PV','REQ'];
	$name = str_replace($type_ar, $replace, $type);
	return $name.'-'.$this->set_zero($id,2);

}

public function get_order_status($st){
    $ar = $this->order_status();
    if(isset($ar[$st])){
        return '<span style="padding: 2px 10px;color: #fff;border-radius: 8px;background:'.$ar[$st]['color'].'">'.$ar[$st]['name'].'</span>';
    }
}
public function order_status()
{
    return [
        'pending' => [
            'name'  => 'Pending',
            'color' => '#dc3545', // gray
        ],
        'confirmed' => [
            'name'  => 'Confirmed',
            'color' => '#0d6efd', // blue
        ],
        // 'in_progress' => [
        //     'name'  => 'In Progress',
        //     'color' => '#0dcaf0', // info
        // ],
        // 'dispatched' => [
        //     'name'  => 'Dispatched',
        //     'color' => '#6610f2', // indigo
        // ],
        // 'delivered' => [
        //     'name'  => 'Delivered',
        //     'color' => '#198754', // green
        // ],
        // 'cancelled' => [
        //     'name'  => 'Cancelled',
        //     'color' => '#dc3545', // red
        // ],
        // 'return' => [
        //     'name'  => 'Return',
        //     'color' => '#fd7e14', // orange
        // ],
        // 'return_in_progress' => [
        //     'name'  => 'Return in Progress',
        //     'color' => '#ffc107', // yellow
        // ],
        // 'returned' => [
        //     'name'  => 'Returned',
        //     'color' => '#20c997', // teal
        // ],
    ];
}

public function get_delivery_status($st){
    $ar = $this->delivery_status();
    if(isset($ar[$st])){
        return '<span style="padding: 2px 10px;color: #fff;border-radius: 8px;background:'.$ar[$st]['color'].'">'.$ar[$st]['name'].'</span>';
    }
}
public function delivery_status()
{
    return [
        'not_sent' => [
            'name'  => 'Not Sent',
            'color' => '#007bff', // gray
        ],'pending' => [
            'name'  => 'Pending',
            'color' => '#6c757d', // gray
        ],
        'delivered_approval_pending' => [
            'name'  => 'Delivered (Approval Pending)',
            'color' => '#0d6efd', // blue
        ],
        'partial_delivered_approval_pending' => [
            'name'  => 'Partial Delivered (Approval Pending)',
            'color' => '#0dcaf0', // info
        ],
        'cancelled_approval_pending' => [
            'name'  => 'Cancelled (Approval Pending)',
            'color' => '#fd7e14', // orange
        ],
        'unknown_approval_pending' => [
            'name'  => 'Unknown (Approval Pending)',
            'color' => '#adb5bd', // light gray
        ],
        'delivered' => [
            'name'  => 'Delivered',
            'color' => '#198754', // green
        ],
        'partial_delivered' => [
            'name'  => 'Partial Delivered',
            'color' => '#20c997', // teal
        ],
        'cancelled' => [
            'name'  => 'Cancelled',
            'color' => '#dc3545', // red
        ],
        'hold' => [
            'name'  => 'On Hold',
            'color' => '#ffc107', // yellow
        ],
        'in_review' => [
            'name'  => 'In Review',
            'color' => '#6610f2', // indigo
        ],
        'unknown' => [
            'name'  => 'Unknown',
            'color' => '#adb5bd', // gray
        ],
    ];
}

public function placeOrder($data = [])
{
    $api_key = $this->steadfast_api()['api_key'];
    $secret_key = $this->steadfast_api()['sec_key'];
    $url        = 'https://portal.packzy.com/api/v1/create_order';

    $payload = [
        'invoice'           => $data['invoice'],
        'recipient_name'    => $data['recipient_name'],
        'recipient_phone'   => $data['recipient_phone'],
        'recipient_address' => $data['recipient_address'],
        'cod_amount'        => $data['cod_amount'],

        // optional
        'alternative_phone' => $data['alternative_phone'] ?? null,
        'recipient_email'   => $data['recipient_email'] ?? null,
        'note'              => $data['note'] ?? null,
        'item_description'  => $data['item_description'] ?? null,
        'total_lot'         => $data['total_lot'] ?? null,
        'delivery_type'     => $data['delivery_type'] ?? 0,
    ];

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => [
            'Api-Key: ' . $api_key,
            'Secret-Key: ' . $secret_key,
            'Content-Type: application/json',
        ],
        CURLOPT_TIMEOUT        => 30,
    ]);

    $response = curl_exec($ch);
    $error    = curl_error($ch);
    curl_close($ch);
    // print_r($response);exit;

    if ($error) {
        return [
            'status' => 'error',
            'message' => $error
        ];
    }

    return json_decode($response, true);
}

public function BulkPlaceOrder($data = [])
{
    $api_key = $this->steadfast_api()['api_key'];
    $secret_key = $this->steadfast_api()['sec_key'];
    $url        = 'https://portal.packzy.com/api/v1/create_order/bulk-order';

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode(['data'=>$data]),
        CURLOPT_HTTPHEADER     => [
            'Api-Key: ' . $api_key,
            'Secret-Key: ' . $secret_key,
            'Content-Type: application/json',
        ],
        CURLOPT_TIMEOUT        => 30,
    ]);

    $response = curl_exec($ch);
    $error    = curl_error($ch);
    curl_close($ch);
    // print_r($response);exit;

    if ($error) {
        return [
            'status' => 'error',
            'message' => $error
        ];
    }

    return json_decode($response, true);
}




public function steadfast_status($tracking_code)
{
    $api_key = $this->steadfast_api()['api_key'];
    $secret = $this->steadfast_api()['sec_key'];
    $url     = "https://portal.packzy.com/api/v1/status_by_trackingcode/{$tracking_code}";
    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Api-Key: {$api_key}",
            "Secret-Key: {$secret}",
            "Content-Type: application/json"
        ],
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $error    = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return ['status' => 'error', 'message' => $error];
    }

    return json_decode($response, true);
}   

public function steadfast_api(){
    return ['api_key'=>'ppepagsxehigxfk7bi9syw4oygm8ib7g','sec_key'=>'fpo26filkqq5mskbapxc2qho'];
}
public function get_steadfast_balance()
{
    $cred = $this->steadfast_api();
    $url  = 'https://portal.packzy.com/api/v1/get_balance';

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Api-Key: ' . $cred['api_key'],
            'Secret-Key: ' . $cred['sec_key'],
            'Content-Type: application/json',
        ],
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $error    = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return [
            'status'  => 'error',
            'message' => $error
        ];
    }

    return (float)@json_decode($response, true)['current_balance'];
}

public function ledger_type($index='')
{
	$ar = [
		'cus'=>'Customer',
		'sup'=>'Supplier',
		'other'=>'Others',
	];
	return !empty($index)?$ar[$index]:$ar;
}



public function dd($ar)
{
	echo '<pre>';
	print_r($ar);
	echo '</pre>';
	exit;
}




public function get_ledger($id){
	return '<a href="'.domain.'ledger&id='.$id.'" target="_blank">'.$this->getonecol('name','ledger_name','id',$id).'</a>';
}



// ---------- Bangla digits ----------
// ---------- Bangla digits ----------
public function toBanglaNumber($number) {
    $eng = ['0','1','2','3','4','5','6','7','8','9'];
    $bng = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return str_replace($eng, $bng, $number);
}


public function getBanglaDate($timestamp = null) {
    if ($timestamp === null) {
        $timestamp = time();
    }

    // Convert to Y-m-d
    $year  = (int)date('Y', $timestamp);
    $month = (int)date('n', $timestamp);
    $day   = (int)date('j', $timestamp);

    // Bangla months
    $banglaMonths = [
        "বৈশাখ", "জ্যৈষ্ঠ", "আষাঢ়", "শ্রাবণ", "ভাদ্র",
        "আশ্বিন", "কার্তিক", "অগ্রহায়ণ", "পৌষ", "মাঘ",
        "ফাল্গুন", "চৈত্র"
    ];

    // Mid dates (approximate start of each Bangla month in Gregorian calendar)
    $bnMonthStart = [
        4 => 14, // Boishakh starts 14 April
        5 => 15, 6 => 15, 7 => 16, 8 => 17, 9 => 17,
        10 => 18, 11 => 17, 12 => 16, 1 => 15, 2 => 13, 3 => 15
    ];

    // Find Bangla year
    $bnYear = $year - 593;
    if ($month < 4 || ($month == 4 && $day < 14)) {
        $bnYear -= 1;
    }

    // Find Bangla month
    $bnMonthIndex = $month;
    if ($day < $bnMonthStart[$month]) {
        $bnMonthIndex -= 1;
        if ($bnMonthIndex == 0) {
            $bnMonthIndex = 12;
        }
    }
    $bnMonth = $banglaMonths[$bnMonthIndex - 1];

    // Find Bangla day
    if ($day >= $bnMonthStart[$month]) {
        $bnDay = $day - $bnMonthStart[$month] + 1;
    } else {
        // Previous month days
        $prevMonth = $month - 1;
        if ($prevMonth == 0) $prevMonth = 12;
        $daysInPrevMonth = cal_days_in_month(CAL_GREGORIAN, $prevMonth, $year);
        $bnDay = $daysInPrevMonth - $bnMonthStart[$month] + $day + 1;
    }

    // Convert digits to Bangla
    $western = ['0','1','2','3','4','5','6','7','8','9'];
    $bangla  = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];

    $bnDay  = str_replace($western, $bangla, $bnDay);
    $bnYear = str_replace($western, $bangla, $bnYear);

    return "{$bnDay} {$bnMonth} {$bnYear}";
}

// ---------- Bangla Calendar ----------
public function getTodayBanglaDate() {
    // Bengali digits
    $banglaDigits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    $englishDigits = range('0', '9');
    
    // Bengali month names
    $banglaMonths = array(
        'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন',
        'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'
    );
    
    // Get today's date
    $today = new DateTime();
    $day = (int)$today->format('d');
    $month = (int)$today->format('m') - 1; // Convert to 0-based index
    $year = (int)$today->format('Y') - 593; // Approximate conversion to Bengali year
    
    // Convert digits to Bengali
    $convertToBangla = function($number) use ($banglaDigits, $englishDigits) {
        return str_replace($englishDigits, $banglaDigits, (string)$number);
    };
    
    $banglaDay = $convertToBangla($day);
    $banglaYear = $convertToBangla($year);
    
    return $banglaDay . ' ' . $banglaMonths[$month] . ', ' . $banglaYear;
}


public function sendFCMssss($tokens, $title, $body, $icon = '', $url = '') {
    $SERVER_API_KEY = 'YOUR_FCM_SERVER_KEY_HERE';

    $data = [
        "registration_ids" => $tokens,  // multiple tokens
        "notification" => [
            "title" => $title,
            "body" => $body,
            "icon" => $icon,
            "click_action" => $url
        ],
        "priority" => "high",
    ];

    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

public function sms_balance() {
    $request=[
        'api_key'=>'9e3bab7f74b744de2d5143427c18fa43',
    ];
    $curl=curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sms.xylub.com/?api=getBalance',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($request),
        CURLOPT_HTTPHEADER =>[
            'Content-Type: application/json'
        ],
    ));
    $response=curl_exec($curl);
    $response = json_decode($response,true);
    return $response['balance'];
}

public function send_sms($sms, $to, $st_id=0) {
    if(strlen($sms) > 5 && strlen($to) > 9){
        
        $request=[
            'api_key'=>'9e3bab7f74b744de2d5143427c18fa43',
            'mobile'=>$to,
            'text'=>$sms
        ];
        $curl=curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sms.xylub.com/?api=send-single-message&showe=null',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($request),
            CURLOPT_HTTPHEADER =>[
                'Content-Type: application/json'
            ],
        ));
        $response=curl_exec($curl);
        $response = json_decode($response,true);
        if($response['status'] == 1){
            return $this->adddata('sms_his',['type'=>'sms','student_id'=>$st_id,'message'=>$sms,'number'=>$to,'date'=>$this->cdate('Y-m-d h:i:s'),'created_by'=>$this->uid()]);
        }
    }
        
}

public function key_name($tab,$index='id',$value='name'){
    $ar = [];
    foreach($this->getFull($tab) as $v){
        $ar[$v[$index]] = $v[$value];
    }
    return $ar;
}
public function is_apps(){
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (stripos(strtolower($userAgent), 'android') !== false) {
        return true;
    }else{
        return false;
    }
}

public function en2bn($text)
{
    $en = ['0','1','2','3','4','5','6','7','8','9','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯',
           'জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];

    return str_replace($en, $bn, $text);
}

public function bn2en($number)
{
	$en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
	$bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
	return str_replace($bn, $en, $number);
}
public function build_search_where($search, $col='name,slug') {
    if ($search == '') return '';

    $columns = is_array($col) ? $col : explode(',', $col);
    $columns = array_values(array_filter(array_map('trim', $columns), function($column) {
        return $column !== '';
    }));
    if (empty($columns)) return '';

    $words = preg_split('/\s+/', trim($search));
    $conditions = [];
    foreach ($words as $word) {
        $word = trim($word);
        if ($word == '') continue;

        $columnConditions = [];
        foreach ($columns as $column) {
            $columnConditions[] = "$column LIKE '%$word%'";
        }
        $conditions[] = '(' . implode(' OR ', $columnConditions) . ')';
    }
    if (empty($conditions)) return '';
    return ' AND (' . implode(' AND ', $conditions) . ')';
}


}
?>
