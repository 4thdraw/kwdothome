<?php 
define('_PROLIST_',true);
//하단고객센터 노출관련 변수
define('_FC_', true);
include_once("../config.php");
 ?>
<?php include_once($kw_path."/inc/header_2025.php"); ?>
<?php include_once($kw_path."/inc/top_2025.php"); ?>

<!--상품목록-->	

<?php
if($_GET['skey1']==""){ $_GET['skey1']="001"; }
$skey1=$_GET['skey1'];
$skey2=$_GET['skey2'];
?>

<?php 

   include "../inc/sub_product.php";
   
	// 제품대메뉴 : $class_name_big
	// 제품소메뉴 : $class_name_mid

?>
<?php

$CONF['normal_page_limit']="25";

if($skey1!='') {
	$sort_query='IFNULL((SELECT sort_num FROM product_info_sort WHERE class_code = \''.$skey1.'\' AND product_id=product_info.id limit 1), 0) AS sortNew';
	if($skey2!='') {
		$sort_query='IFNULL((SELECT sort_num FROM product_info_sort WHERE class_code=\''.$skey2.'\' AND product_id=product_info.id), 0) AS sortNew';
	}
}
else { $sort_query='sortNum AS sortNew'; }


/*-- 상품 리스트 --*/
$tmp_total_article = $SQL->select_num_rows(
'product_info',
'COUNT(id) AS id',
$where_array
);
$total_article = $tmp_total_article['id'];
$SQL->select(
'product_info',
array('id', 'sortNum', 'sold_out', 'class_code', 'product_name', 'product_color', 'price_retail', 'price_retail2', 'price_retail3', 'price_retail4', 'product_status_flag', 'internal_date', 'product_material',$sort_query),
$where_array,
$tmp_squery,
$offset, $CONF['normal_page_limit']
);
$show_no = $total_article - $offset;
$product_cnt=0;
$result_array = $tmp_image_array = $image_array = $tmp_remark_array = array();
while($data = $SQL->fetch_assoc())
{
	$data['product_name']=$FUNC->stringCut($data['product_name'],18);
	$product_cnt++;
	$result_array[] = $data;
	$tmp_remark_array[] = 'product_id='.$data['id'];
}
unset($data);

/*--- 이미지 쿼리(셀력션을 최대한 줄이기 위해) ---*/
if(count($result_array)>0) {
	foreach($result_array as $data)
	{
	$tmp_image_array[] = 'product_id='.$data['id'];
	}
	unset($data);
}
if(count($tmp_image_array) > 0)
{
$SQL->select(
	'product_info_image',
	array('product_id', 'image_path', 'image_name','image_name_s'),
	array(implode(' OR ', $tmp_image_array)),
	'id ASC'
);
while($data = $SQL->fetch_assoc())
{
	if(!isset($image_array[$data['product_id']]))
	{
		$tmp_image_full = $data['image_name_s'];
		if(file_exists('../../_uploadfiles/products/'.($data['image_path']).'/'.($tmp_image_full)) === true)
		{		$image_array[$data['product_id']] = '../../_uploadfiles/products/'.($data['image_path']).'/'.($tmp_image_full);
		} else {
				$image_array[$data['product_id']] = '../img/product/noimg_130.jpg';
		}
	}
}
unset($data);
}
/*=== 이미지 쿼리(셀력션을 최대한 줄이기 위해) ===*/
reset($result_array);
$stock_count['on'] = $stock_count['off'] = $display_count['on'] = $display_count['off'] = 0;

if(count($result_array)>0) {
foreach($result_array as $data)
{
//분류 검색
$tmp_class_big = substr($data['class_code'], 0, 3);
$tmp_class_name_big = isset($row_class['big'][$tmp_class_big]) ? $row_class['big'][$tmp_class_big] : '-';
$tmp_class_name_middle = isset($row_class['middle'][$data['class_code']]) ? $row_class['middle'][$data['class_code']] : '-';
$tmp_class_name = $tmp_class_name_big.'<br/>'.$tmp_class_name_middle;


//상품명
if(isset($_GET['skey4']) AND isset($_GET['sval']) AND $_GET['skey4'] == 1 AND strlen($_GET['sval']) > 0) $tmp_product_name = $FUNC->stringHighLight($data['product_name'], $_GET['sval'], '#D7B104');
else $tmp_product_name = $data['product_name'];

//품절
if($data['product_stock'] > 0)
{
	$tmp_product_stock = '-';
	++$stock_count['on'];
} else {
	$tmp_product_stock = '<span style="color: #C00;">품절</span>';
	++$stock_count['off'];
}

//디스플레이
if($data['product_status_flag'] > 0) ++$display_count['on'];
else ++$display_count['off'];

//비고
if(isset($tmp_item_array)) unset($tmp_item_array);
if(isset($row_remark[$data['id']])) $tmp_item_array = $row_remark[$data['id']];
else $tmp_stock = isset($row_inventory[$data['id']][0]) ? $row_inventory[$data['id']][0] : 0;

$price_retail = number_format($data['price_retail'])." 원";
if($price_retail==0){ $price_retail="&nbsp;"; }

$row[] = array(
	'dpv_show_no'				=> $show_no,
	'dpv_id'					=> $data['id'],
	'dpv_sortNum'				=> $data['sortNum'],
	'dpv_sold_out'				=> $data['sold_out'],
	'dpv_class_code'			=> $data['id'],
	'dpv_product_color'			=> $data['product_color'],
	'dpv_product_material'		=> $data['product_material'],
	'dpv_class_name_b'			=> trim($tmp_class_name_big),
	'dpv_class_name_m'			=> trim($tmp_class_name_middle),
	'dpv_product_name'			=> $tmp_product_name,
	'dpv_price_retail'			=> $price_retail,
	'dpv_price_retail2'			=> number_format($data['price_retail2']),
	'dpv_price_retail3'			=> $data['price_retail3'],
	'dpv_price_retail4'			=> $data['price_retail4'],
	'dpv_product_image'			=> isset($image_array[$data['id']]) ? '<img src="'.$image_array[$data['id']].'" border="0"width="180px" height="180px" />' : '<img src="../img/product/noimg.jpg" border="0"width="180px" height="180px" />',
	'dpv_product_status_flag'	=> $data['product_status_flag'],
	'dpv_internal_date'			=> $FUNC->dateConvert($data['internal_date'], 3),
	'dpv_product_inventory'		=> isset($tmp_stock) ? $tmp_stock : 0,
	'item'						=> isset($tmp_item_array) ? $tmp_item_array : '',
	'item_cnt'					=> isset($tmp_item_array) ? count($tmp_item_array) : 0
);
--$show_no;
$tmp_class_big = $tmp_class_name_big = $tmp_class_name_middle = $tmp_class_name = $tmp_character_name = null;
}
}


//상품 부족분 처리
if($skey2!=''){
	$category_query = ' and class_code='.$skey2.'';
} else {
	$category_query = ' and left(class_code,3)='.$skey1.'';
}

$SQL->select(
	'product_info',
	array('id as product_id', 'sortNum', 'sold_out', 'class_code', 'product_name', 'product_color', 'price_retail', 'price_retail2', 'price_retail3', 'price_retail4', 'product_status_flag', 'internal_date', 'product_material',$sort_query),
	'product_status_flag=1 '.$category_query,
	'sortNew ASC, id DESC',
	'0',
	'20'
);
while($data = $SQL->fetch_assoc())
{
	$data['product_name']=$FUNC->stringCut($data['product_name'],20);
	if($skey2!=''){
		if($skey2==$data['class_code']){
			$category_result_array[] = $data;
		} else {
			$category_result_array2[] = $data;
		}
	} else {
		$category_result_array[] = $data;
	}
}

/*-- 추천상품 리스트 --*/
$tmp_total_article = $SQL->select_num_rows(
'product_best_select',
'COUNT(id) AS id',
'event_kind=\'1\''
);
$reco_total_article = $tmp_total_article['id'];

$SQL->select(
'product_best_select as pbs',
array(
	'id', 'product_id', 'event_kind'
	, '(SELECT class_code FROM product_info WHERE product_info.id=pbs.product_id) as class_code'
	, '(SELECT product_name FROM product_info WHERE product_info.id=pbs.product_id) as product_name'
	, '(SELECT price_retail FROM product_info WHERE product_info.id=pbs.product_id) as price_retail'
	, '(SELECT price_retail2 FROM product_info WHERE product_info.id=pbs.product_id) as price_retail2'
),
'event_kind=\'1\'',
'sort DESC, id DESC',
'0,4'

);
$show_no = $total_article - $offset;
$result_array = $tmp_image_array = $image_array = $tmp_remark_array = array();
while($data = $SQL->fetch_assoc())
{
	$reco_product_id[]=$data['product_id'];
	$data['product_name']=$FUNC->stringCut($data['product_name'],20);
	if($_GET['skey2']==""){
		if(substr($data['class_code'],0,3)==$_GET['skey1']){
			$reco_result_array[] = $data;
		}
	} else {
		if($data['class_code']==$_GET['skey2']){
			$reco_result_array[] = $data;
		}
	}
}

if(count($reco_result_array)<5){
	if(count($category_result_array)>0){
		foreach($category_result_array as $data)
		{
			if($reco_product_id!=""){
				if(!in_array($data['product_id'],$reco_product_id)){
					$reco_result_array[] = $data;
					$tmp_image_array[] = 'product_id='.$data['product_id'];
					$use_product_id[]=$data['product_id'];
					if(count($reco_result_array)>5){
						break;
					}
				}
			} else {
				$reco_result_array[] = $data;
				$tmp_image_array[] = 'product_id='.$data['product_id'];
				$use_product_id[]=$data['product_id'];
				if(count($reco_result_array)>5){
					break;
				}
			}
		}
	}
}

if(count($reco_result_array)<5){
	if(count($category_result_array2)>0){
		$i=0;
		foreach($category_result_array2 as $data)
		{
			if($reco_product_id!=""){
				if(!in_array($data['product_id'],$reco_product_id)){
					$reco_result_array[] = $data;
					$tmp_image_array[] = 'product_id='.$data['product_id'];
					$use_product_id[]=$data['product_id'];
					if(count($reco_result_array)>4){
						break;
					}
				}
			} else {
					$reco_result_array[] = $data;
					$tmp_image_array[] = 'product_id='.$data['product_id'];
					$use_product_id[]=$data['product_id'];
					if(count($reco_result_array)>4){
						break;
					}
			}
		}
	}
}


/*-- 추천상품 리스트 --*/

/*-- 시즌상품 리스트 --*/

$SQL->select(
'product_best_select as pbs',
array(
	'id', 'product_id', 'event_kind'
	, '(SELECT class_code FROM product_info WHERE product_info.id=pbs.product_id) as class_code'
	, '(SELECT product_name FROM product_info WHERE product_info.id=pbs.product_id) as product_name'
	, '(SELECT price_retail FROM product_info WHERE product_info.id=pbs.product_id) as price_retail'
	, '(SELECT price_retail2 FROM product_info WHERE product_info.id=pbs.product_id) as price_retail2'
	, '(SELECT product_status_flag FROM product_info WHERE product_info.id=pbs.product_id) as product_status_flag'
),
'event_kind=\'5\'',
'sort DESC, id DESC'
);
$show_no = $total_article - $offset;
$result_array = $tmp_image_array = $image_array = $tmp_remark_array = array();
while($data = $SQL->fetch_assoc())
{
	if($data['product_status_flag']==1){
		$reco_total_article++;
		$data['product_name']=$FUNC->stringCut($data['product_name'],10);
		$season_result_array[] = $data;
		$tmp_image_array[] = 'product_id='.$data['product_id'];
	}
}
/*-- 시즌상품 리스트 --*/

/*--- 이미지 쿼리(셀력션을 최대한 줄이기 위해) ---*/
if(count($reco_result_array) > 0)
{
	foreach($reco_result_array as $data)
	{
	$tmp_image_array[] = 'product_id='.$data['product_id'];
	}
}
unset($data);
if(count($tmp_image_array) > 0)
{
$SQL->select(
	'product_info_image',
	array('product_id', 'image_path', 'image_name_b', 'image_name'),
	array(implode(' OR ', $tmp_image_array)),
	'id ASC'
);
while($data = $SQL->fetch_assoc())
{
	if(!isset($image_array[$data['product_id']]))
	{
		//$tmp_image_front = substr($data['image_name'], 0, -4);
		//$tmp_image_ext	= substr($data['image_name'], -3);
		//$tmp_image_full = $tmp_image_front.'_s.'.$tmp_image_ext;
		$tmp_image_full = $data['image_name_b'];
		$tmp_image_full_s = $data['image_name'];

		if(file_exists('../../_uploadfiles/products/'.($data['image_path']).'/'.($tmp_image_full)) === true)
		{		$image_array[$data['product_id']] = '../../_uploadfiles/products/'.($data['image_path']).'/'.($tmp_image_full);
		} else {
				$image_array[$data['product_id']] = '../img/product/noimg_big.jpg';
		}
		if(file_exists('../../_uploadfiles/products/'.($data['image_path']).'/'.($tmp_image_full_s)) === true)
		{		$image_array_s[$data['product_id']] = '../../_uploadfiles/products/'.($data['image_path']).'/'.($tmp_image_full_s);
		} else {
				$image_array_s[$data['product_id']] = '../img/product/noimg_130.jpg';
		}

		//$image_array[$data['product_id']] = 'http://'.$CONF['image_url'].'/_product_images/'.$data['image_path'].'/'.$data['image_name'];
	}
}
unset($data);
}
/*=== 이미지 쿼리(셀력션을 최대한 줄이기 위해) ===*/

/*-- 시공사례 리스트 --*/
if($_GET['skey1']!=''){
	$category_query=' and (skey1_1='.$_GET['skey1'].')';
}
if($_GET['skey2']!=''){
	$category_query=' and (skey1='.$_GET['skey2'].')';
}
$SQL->select(
'bbs_construction',
'id, list_group, list_order, list_depth, top_flag, author_id, author_name, author_mail, author_phone, subject, contents, html_flag, hit_count, attach_flag, internal_date, internal_remote_addr, internal_remote_addr_for, modify_date, modify_remote_addr, modify_remote_addr_for, kind_flag, etc_field, skey1, skey1_1,
	(SELECT id FROM board_attachments WHERE board_attachments.board_id=bbs_construction.id AND board_environment_id=\'construction\' limit 1) AS imgfile',
'id>0',
'list_group ASC, list_order ASC',
'0',
'6'
);
while($tmp_data = $SQL->fetch_assoc())
{
	if($tmp_data['imgfile']!='' and count($case_data)<3){
		$comment_where_str[] = 'board_id='.$tmp_data['id']; //코멘트 호출 번호 부여
		$case_data[] = $tmp_data;
	}
}
if(count($comment_where_str)>0){
$SQL->select(
	'board_attachments',
	array('id', 'board_id','filename'),
	array('board_environment_id=\'construction\'', implode(' OR ', $comment_where_str)),
	'id DESC'
);
$row_img = array();
while($data = $SQL->fetch_assoc())
{
	$tmp_ext = substr(strrchr(strtolower($data['filename']),'.'),1);

	if(in_array($tmp_ext,array('gif', 'jpg', 'jpeg','png'))){
		$row_img_case[$data['board_id']]=$data['id'];
	}
}
unset($data);
}
/*-- //시공사례 리스트 --*/

$tmp_qstring = $CONF['query_string'];
$tmp_qstring2 = $FUNC->requestDrop($tmp_qstring, 'id', $_GET['id']);
$tmp_qstring2 = $FUNC->requestDrop($tmp_qstring2, 'id', $_GET['id']);
$tmp_qstring = $tmp_qstring;
$tmp_qstring2 = $tmp_qstring2;
if(!empty($tmp_qstring2)) $tmp_qstring2 = '&'.$tmp_qstring2;

?>


<!--서브컨텐츠-->

			
		<div class="subMn">
			<?php
			if(count($class_mid_arr)>0) {
				foreach($class_mid_arr as $data){ ?>
			<a href="../product/product_list.php?skey1=<?php echo substr($data['class_code'],0,3);?>&skey2=<?php echo $data['class_code'];?>" class="smn<?php if($_GET['skey2']==$data['class_code']){ echo "_s"; } ?>"><?php echo $data['class_name'];?></a>
			<?php }
			}
			?>
			<a href="../product/product_list.php?skey1=<?php echo substr($data['class_code'],0,3);?>" class="smn<?php if($_GET['skey2']==""){ echo "_s"; } ?>">전체</a>
			<?php if($_GET['skey1']=='004'){ ?>
			<a href="../customer/gallery_list.php" class="smn_s" style="margin-right:10px;background:#5ca5ea">로고매트 시안보기</a>
			<?php } ?>
			<p class="clr"></p>
		</div>
		<div class="subcontents">
			<p><img src="../img/product/stit1.gif" alt="추천상품" /></p>
			<!--리스트-->
			<div class="subList">
				<div class="flL">
					<?php if($reco_result_array[1]['product_id']!=''){ ?>
					<div class="proBox">
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:450px;height:400px;'><a href='../product/product_detail.php?id=".$reco_result_array[0]['product_id']."&skey1=".substr($reco_result_array[0]['class_code'],0,3)."&skey2=".$reco_result_array[0]['class_code']."'><img src='../img/product/water_m.gif' style='padding-top:180px' border='0'></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:450px;height:400px;'><a href='../product/product_detail.php?id=".$reco_result_array[0]['product_id']."&skey1=".substr($reco_result_array[0]['class_code'],0,3)."&skey2=".$reco_result_array[0]['class_code']."'><img src='../img/product/water_mid.png' style='padding:140px 180px 280px 100px' border='0'></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:450px;height:400px;'><a href='../product/product_detail.php?id=".$reco_result_array[0]['product_id']."&skey1=".substr($reco_result_array[0]['class_code'],0,3)."&skey2=".$reco_result_array[0]['class_code']."'><img src='../img/product/water_mid.png' style='padding-top:180px' border='0'></div></div></div>";
						}
						?>
						<p class="border"><a href="../product/product_detail.php?id=<?php echo $reco_result_array[0]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[0]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[0]['class_code']; ?>"><img src="<?php echo $image_array[$reco_result_array[0]['product_id']];?>" width="410px" height="405px"/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[0]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[0]['product_name']; ?></p>
					</div>
					<?php } else { ?>
					<div class="proBox2">
						<p class="border"><img src="../img/product/noimg_big.jpg" style="width:400px;*height:410px" /></p>
					</div>
					<?php } ?>
				</div>
				<div class="flL">
					<?php if($reco_result_array[1]['product_id']!=''){ ?>
					<div class="proBox2">
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[1]['product_id']."&skey1=".substr($reco_result_array[1]['class_code'],0,3)."&skey2=".$reco_result_array[1]['class_code']."'><img src='../img/product/water_m.gif' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[1]['product_id']."&skey1=".substr($reco_result_array[1]['class_code'],0,3)."&skey2=".$reco_result_array[1]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[1]['product_id']."&skey1=".substr($reco_result_array[1]['class_code'],0,3)."&skey2=".$reco_result_array[1]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
						}
						?>
						<p class="border"><a href="../product/product_detail.php?id=<?php echo $reco_result_array[1]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[1]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[1]['class_code']; ?>"><img src="<?php echo $image_array_s[$reco_result_array[1]['product_id']];?>" width="180px" height="180px"/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[1]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[1]['product_name']; ?></p>
					</div>
					<?php } else { ?>
					<div class="proBox2">
						<p class="border"><img src="../img/product/noimg.jpg" /></p>
					</div>
					<?php } ?>
					<?php if($reco_result_array[2]['product_id']!=''){ ?>
					<div class="proBox2">
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[2]['product_id']."&skey1=".substr($reco_result_array[2]['class_code'],0,3)."&skey2=".$reco_result_array[2]['class_code']."'><img src='../img/product/water_m.gif' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[2]['product_id']."&skey1=".substr($reco_result_array[2]['class_code'],0,3)."&skey2=".$reco_result_array[2]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[2]['product_id']."&skey1=".substr($reco_result_array[2]['class_code'],0,3)."&skey2=".$reco_result_array[2]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
						}
						?>
						<p class="border"><a href="../product/product_detail.php?id=<?php echo $reco_result_array[2]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[2]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[2]['class_code']; ?>"><img src="<?php echo $image_array_s[$reco_result_array[2]['product_id']];?>" width="180px" height="180px"/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[2]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[2]['product_name']; ?></p>
					</div>
					<?php } else { ?>
					<div class="proBox2">
						<p class="border"><img src="../img/product/noimg.jpg"/></p>
					</div>
					<?php } ?>
					<p class="clr"></p>
					<?php if($reco_result_array[3]['product_id']!=''){ ?>
					  <div class="proBox2">
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[3]['product_id']."&skey1=".substr($reco_result_array[3]['class_code'],0,3)."&skey2=".$reco_result_array[3]['class_code']."'><img src='../img/product/water_m.gif' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[3]['product_id']."&skey1=".substr($reco_result_array[3]['class_code'],0,3)."&skey2=".$reco_result_array[3]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[3]['product_id']."&skey1=".substr($reco_result_array[3]['class_code'],0,3)."&skey2=".$reco_result_array[3]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
						}
						?>
							<p class="border"><a href="../product/product_detail.php?id=<?php echo $reco_result_array[3]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[3]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[3]['class_code']; ?>"><img src="<?php echo $image_array_s[$reco_result_array[3]['product_id']];?>" width="180px" height="180px"/></a></p>
							<h5><?php echo $row_class['middle'][$reco_result_array[3]['class_code']]; ?></h5>
							<p class="stxt"><?php echo $reco_result_array[3]['product_name']; ?></p>
					  </div>
					<?php } else { ?>
					<div class="proBox2" style="<?php if($reco_result_array[3]['product_name']==''){ ?>margin-top:30px;*margin-top:0px<?php } ?>">
						<p class="border"><img src="../img/product/noimg.jpg" /></p>
					</div>
					<?php } ?>
					<?php if($reco_result_array[4]['product_id']!=''){ ?>
					<div class="proBox2">
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[4]['product_id']."&skey1=".substr($reco_result_array[4]['class_code'],0,3)."&skey2=".$reco_result_array[4]['class_code']."'><img src='../img/product/water_m.gif' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[4]['product_id']."&skey1=".substr($reco_result_array[4]['class_code'],0,3)."&skey2=".$reco_result_array[4]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:190px;height:190px;'><a href='../product/product_detail.php?id=".$reco_result_array[4]['product_id']."&skey1=".substr($reco_result_array[4]['class_code'],0,3)."&skey2=".$reco_result_array[4]['class_code']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
						}
						?>
						<p class="border"><a href="../product/product_detail.php?id=<?php echo $reco_result_array[4]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[4]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[4]['class_code']; ?>"><img src="<?php echo $image_array_s[$reco_result_array[4]['product_id']];?>" width="180px" height="180px"/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[4]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[4]['product_name']; ?></p>
					</div>
					<?php } else { ?>
					<div class="proBox2" style="<?php if($reco_result_array[3]['product_name']==''){ ?>margin-top:30px;*margin-top:0px<?php } ?>">
						<p class="border"><img src="../img/product/noimg.jpg" /></p>
					</div>
					<?php } ?>
				</div>
				<p class="clr"></p>
			</div>
			<!--//리스트-->
			<!--이벤트상품-->
			<p align="right" style="position:absolute;margin-left:738px;margin-top:25px;*margin-left:730px;z-index:10"><a href="../product/product_best.php"><img src="../img/main/more.gif" border="0" style=""/></a></p>
			<script language="javascript">
				var season;
				function SeasonMoveNext(){
					clearTimeout(season);
					var cdiv=document.getElementById("currentDIV").value*1;
					for(var i=1;i<=<?php echo number_format(count($season_result_array)/5,0); ?>;i++){
						document.getElementById("seasonlayer"+i).style.display="none";
					}
					if(cdiv==<?php echo number_format(count($season_result_array)/5,0); ?>){ cdiv=0; }
					document.getElementById("seasonlayer"+(cdiv+1)).style.display="";
					document.getElementById("currentDIV").value = cdiv+1;
					season = setTimeout("SeasonMoveNext()", 9000);
				}
				function SeasonMoveBack(){
					clearTimeout(season);
					var cdiv=document.getElementById("currentDIV").value*1;
					for(var i=1;i<=<?php echo number_format(count($season_result_array)/5,0); ?>;i++){
						document.getElementById("seasonlayer"+i).style.display="none";
					}
					var tdiv = cdiv-1;
					if(tdiv<1){ tdiv = <?php echo number_format(count($season_result_array)/5,0); ?>; }
					document.getElementById("seasonlayer"+(tdiv)).style.display="";
					document.getElementById("currentDIV").value = tdiv;
				}
				window.onload = function() {
					season = setTimeout("SeasonMoveNext()", 9000);
				};
			</script>
			<div class="eventList" style="margin-left:0px">
				<a href="javascript:SeasonMoveBack()" class="arwBtnB" style="float:left;margin-right:2px;margin-left:-15px;"></a>
				<?php if(count($season_result_array)>0){ ?>
				<?php $i=0; ?>
					<?php foreach($season_result_array as $season){ ?>
					<?php if(($i%5)==0){ ?>
					<div id="seasonlayer<?php echo ($i/5)+1; ?>" style="<?php if($i>0){ echo ";display:none"; } ?>">
					<?php } ?>
					<div class="proBox1">
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:120px;height:150px;'><a href='../product/product_detail.php?id=".$season['product_id']."&skey1=".substr($season['class_code'],0,3)."&skey2=".$season['class_code']."'><img src='../img/product/water_m.gif' style='padding:40px 0px' border='0' ></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:120px;height:150px;'><a href='../product/product_detail.php?id=".$season['product_id']."&skey1=".substr($season['class_code'],0,3)."&skey2=".$season['class_code']."'><img src='../img/product/water_mid.png' style='padding:40px 0px' border='0' ></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:120px;height:150px;'><a href='../product/product_detail.php?id=".$season['product_id']."&skey1=".substr($season['class_code'],0,3)."&skey2=".$season['class_code']."'><img src='../img/product/water_mid.png' style='padding:40px' border='0' ></div></div></div>";
						}
						?>
						<p class="border"><a href="../product/product_detail.php?id=<?php echo $season['product_id']; ?>&skey1=<?php echo substr($season['class_code'],0,3); ?>&skey2=<?php echo $season['class_code']; ?>"><?php if($image_array_s[$season['product_id']]==''){ ?><img src="../img/product/noimg.jpg" width="110px" height="110px" border="0"/><?php } else { ?><img src="<?php echo $image_array_s[$season['product_id']];?>" width="110px" height="110px"/><?php } ?></p>
						<p class="stxt" style="width:113px;margin-top:5px"><?php echo $season['product_name']; ?></a></p>
					</div>
					<?php $i++; ?>
					<?php if(($i%5)==0){ ?></div><?php } ?>
					<?php } ?>
					<?php if(($i%5)>0){ ?></div><?php } ?>
				<?php } else { ?>
				<div class="proBox1" style="height:180px">&nbsp;</div>
				<?php } ?>
				<a href="javascript:SeasonMoveNext()" class="arwBtn" style="float:right;margin-left:-15px;"></a>
				<p class="clr"></p>
			<input type="hidden" id="currentDIV"  name="currentDIV" value="1">
			</div>
			<!--//이벤트상품-->
		</div>
	</div>
<!--//서브컨텐츠-->
</div>
<!--//컨텐츠-->
<!--컨텐츠-->
<p class="clr"></p>
<div class="contents" style="*margin-top:-10px">
	<div class="subListBlue">
		<div class="listTop">
			<h2><?php echo $class_name_big;?> <?php if($class_name_mid!=''){ ?><  <b><?php echo $class_name_mid;?></b><?php } ?>에는 <span class="txtBlue"><?php echo $total_article;?> 개</span>의 상품이 있습니다.</h2>
			<!--제품정렬-->
			<form id="seFrm" action="./product_list.php" method="GET" onSubmit="return false">
			<input type="hidden" name="cc" id="cc" value="<?php echo $tmp_class_code?>" />
			<input type="hidden" name="skey1" id="skey1" value="<?php echo $_GET['skey1']; ?>" />
			<input type="hidden" name="skey2" id="skey2" value="<?php echo $_GET['skey2']; ?>" />
			<!--셀렉트박스-->
			<div class="sortbox1">
			<script type="text/javascript">
			function shMenuS() {
				var obj=document.getElementById('caMenuS');
				if(obj.style.display=='none') obj.style.display='';
				else obj.style.display='none';
			}

			function sCaS(code, cname) {
				document.getElementById('nowCaS').innerHTML=cname;
				document.getElementById('trKeys').value=code;
				document.getElementById("seFrm").submit();
				//shMenuS();
			}
			</script>
			<style>
			.onSr { background: #65aaeb; color:#fff; };
			.outSr { background: #FFF;};
			</style>
			<!--//셀렉트박스-->
			<div class="cateBox" style="height:35px">
			<div class="pro_sortBox">
			  <!--셀렉트박스-->
			<div class="selectBox" style="width:120px; height:15px;cursor:pointer; background:#fff;">
				<table border="0" cellpadding="0" cellspacing="0" onClick="shMenuS()">
					<tr>
						<td width="100" align="left"><span style="margin-left:10px" id="nowCaS"><?php echo $tmp_searchText?></span></td>
						<td align="right"><img src="../img/common/arw1.gif" align="absmiddle" style="vertical-align:middle" /></td>
					</tr>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" style="z-index:999;">
				<tr><td>
				<div style="z-index:999;position:relative;margin-top:3px;*margin-left:-60px">
				<div id="caMenuS" class="selectBox" style="border-top:none;width:120px;background:#FFF;top:0px;left:0px;margin-left:-1px;display:none;z-index:999;position:absolute">
					<table border="0" width="100%" cellpadding="0" cellspacing="0" onClick="sCaS('1', '신상품순')" onmouseover="this.className='onSr'" onmouseout="this.className='outSr'">
						<tr>
							<td width="80" align="left"><span style="margin-left:10px">신상품순</span></td>
							<td align="right">&nbsp;</td>
						</tr>
					</table>
					<table border="0" width="100%" cellpadding="0" cellspacing="0" onClick="sCaS('2', '낮은가격순')" onmouseover="this.className='onSr'" onmouseout="this.className='outSr'">
						<tr>
							<td width="80" align="left"><span style="margin-left:10px">낮은가격순</span></td>
							<td align="right">&nbsp;</td>
						</tr>
					</table>
					<table border="0" width="100%" cellpadding="0" cellspacing="0" onClick="sCaS('3', '높은가격순')" onmouseover="this.className='onSr'" onmouseout="this.className='outSr'">
						<tr>
							<td width="80" align="left"><span style="margin-left:10px">높은가격순</span></td>
							<td align="right">&nbsp;</td>
						</tr>
					</table>
					<input type="hidden" id="trKeys" name="trKeys" value="1" />
				</div>
				</div>
				</td></tr></table>
			</div>
			  <!--//셀렉트박스-->
			<!--제품카테고리-->
			</div>
			<p class="clr"></p>
		  </div>
		  </form>
			<!--//제품정렬-->
			<p class="clr"></p>
		</div>
		<?php
		if(count($row)>0) {
			$i=0;
			foreach($row as $data) {
		?>
		<div class="proBox3" <?php if($i%5==0){ ?>style="margin-left:0;"<?php } ?>>
					<?php
						if ( ereg("MSIE", $_SERVER[HTTP_USER_AGENT]) ) {
							if ( ereg("MSIE 6.0", $_SERVER[HTTP_USER_AGENT]) ) {
								//익스플로어 6
								echo  "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:200px;height:200px;'><a href='../product/product_detail.php?id=".$data['dpv_id']."><img src='../img/product/water_m.gif' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							} else {
								//익스플로어
								echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:0px;margin-top:0px;width:200px;height:200px;'><a href='../product/product_detail.php?id=".$data['dpv_id']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
							}
						} else {
							echo "<div style=''><div style='position: relative;'><div style='position: absolute;float:left;margin-left:-25px;margin-top:0px;width:200px;height:200px;'><a href='../product/product_detail.php?id=".$data['dpv_id']."'><img src='../img/product/water_mid.png' style='padding:70px 80px 100px 50px' border='0' ></div></div></div>";
						}
						?>
			<p class="border"><a href="product_detail.php?id=<?php echo $data['dpv_id']?><?php echo $tmp_qstring2?>"><?php echo $data['dpv_product_image']?></a></p>
			<h5><?php echo $data['dpv_class_name_m'];?></h5>
			<p class="stxt"><?php echo $data['dpv_product_name']?>
			<?php
				$diff=$FUNC->dateDiff($data['internal_Date'],date('Y-m-d'));
				if($diff['d']<=30) {
			?><img src="../img/common/new.gif">
			<?php } ?>
			<br><?php echo $data['dpv_price_retail']?></p>
		</div>
		<?php
			$i++;
			}
		} else {
		?>
		<div class="proBox3" style="margin-left:0;">
			등록 혹은 검색된 상품이 없습니다.
			<p class="clr"></p>
		</div>
		<?php
		}
		?>
		<p class="clr"></p>
		</div>
		<div class="paging">
		<?php echo $FUNC->getPageIndexH($CONF['request_uri'], $CONF['query_flag'], $cpage, $CONF['normal_page_limit'], $total_article)?>
	</div>
</div>

</div>


<!--상품목록  DB-->

<div class='subpage_submenu py-2 py-xl-1 bg-gray px-3 px-xl-0'>
					<ul class="mx-auto max-width py-2 navilist fw600 fs-18 d-flex justify-content-between align-items-center">                     
                      <li class="navili d-none d-xl-block"><a href="https://ghmat.com/document/page/prd_list.php?pronm=prd_all">제품보기</a></li>
                      <li class="navili d-none d-xl-block"><a href="">공간별추천</a></li>
                      <li class="navili d-none d-xl-block"><a href="https://ghmat.com/document/page/gallery_list.php?pronm=prd_all">시공갤러리</a></li>
                      <!-- <li class="navili d-none d-xl-block"><a href="">시공가이드</a></li> -->
                      <li class="navili d-none d-xl-block"><a href="">주문제작</a></li>
                      <li class="navili d-none d-xl-block"><a href="https://ghmat.com/document/page/board_list.php?boarden=Inquiries&amp;board=견적문의" class="orange-color">견적문의</a></li>
					 
                	</ul>
</div>
<div class='max-width d-flex mx-auto  position-relative mainContentwrapper'  >
	<div class='kw_wrap d-flex flex-column align-items-center max-width mx-auto'>
		<h2 class='page_title'>
		<?php echo //$class_name_big; ?>
		<strong>
			<?php echo $board_title_en; ?>
		</strong>
		</h2> 
	</div>
	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>