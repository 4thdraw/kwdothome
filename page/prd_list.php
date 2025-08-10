<?php 
define('_PROLIST_',true);
//하단고객센터 노출관련 변수
define('_FC_', true);
include_once("../config.php");


if($_GET['skey1']==""){ $_GET['skey1']="001"; }
$skey1=$_GET['skey1'];
$skey2=$_GET['skey2'];

 ?>
<?php include_once($kw_path."/inc/header_2025.php"); ?>

<?php 
   include "../inc/sub_product.php";   
	//제품대메뉴 : $class_name_big
	//제품소메뉴 : $class_name_mid
	
?>
<?php include_once($kw_path."/inc/top_2025.php"); ?>

<!--상품목록-->	


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
	if($tmp_data['imgfile']!='' and count($case_data)< 16){
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











<div class=' position-relative content_wrapper mainContentwrapper'  >
	 <!-- 제품하위카테고리 -->
	 <div class='subMn border-bottom py-5'>
			<div class="max-width mx-auto px-3 px-xl-0 d-flex w-100 justify-content-between align-items-center pt-5">
				<div>
					<h2 class='page_title fs-48 fw400'>
							<span >
								<?php echo $class_name_big; ?>
							</span>
							
							<strong class='active-color fw400 text-uppercase'>
								<?php echo $board_title_en; ?>
							</strong>
					</h2> 
					<p class='fs-20 gray-dark mt-3'>
						세련된 디자인과 실용성을 모두 갖춘 카페트! <br>
						지금 바로 특별 할인 혜택을 만나보세요
					</p>
				</div>
					
					<ul class='d-flex gap-3 text-nowrap'>
						<li>
							<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=<?php echo substr($data['class_code'],0,3);?>" class="smn rounded-pill px-3 py-2 <?php if($_GET['skey2']==""){ echo "_s"; } ?>">전체</a>
					
						</li>
						<?php
						if(count($class_mid_arr)>0) {
							foreach($class_mid_arr as $data){ 
						?>
						<li>
							<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=<?php echo substr($data['class_code'],0,3);?>&skey2=<?php echo $data['class_code'];?>" class="smn rounded-pill px-3 py-2 <?php if($_GET['skey2']==$data['class_code']){ echo " active-bg text-white "; } ?>"><?php echo $data['class_name'];?></a>
						</li>
						<?php } 
							}
						?>
					</ul>
			</div>
	 </div>
	 <!-- 상품리스트			 -->

	<div class='border-bottom'>
		
	  
		<div class='kw_wrap d-flex flex-column align-items-center max-width mx-auto px-3 px-xl-0 py-5 '>
		
		
	
		 
		 <!--추천상품 리스트-->
			<div class="subList row row-cols-2 row-cols-md-4 d-none">
			
					
			
					<?php if($reco_result_array[1]['product_id']!=''){ ?>
					<div class="proBox2 col">
					
						<p class="border">
							<a href="../product/product_detail.php?id=<?php echo $reco_result_array[1]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[1]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[1]['class_code']; ?>">
								<img src="<?php echo $image_array_s[$reco_result_array[1]['product_id']];?>" class='img-fluid'/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[1]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[1]['product_name']; ?></p>
					</div>
					<?php }  ?>
					<?php if($reco_result_array[2]['product_id']!=''){ ?>
					<div class="proBox2 col">
					
						<p class="border">
							<a href="../product/product_detail.php?id=<?php echo $reco_result_array[2]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[2]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[2]['class_code']; ?>">
								<img src="<?php echo $image_array_s[$reco_result_array[2]['product_id']];?>" class='img-fluid'/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[2]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[2]['product_name']; ?></p>
					</div>
					<?php }  ?>
					<?php if($reco_result_array[3]['product_id']!=''){ ?>
					<div class="proBox2 col">
					
						<p class="border">
							<a href="../product/product_detail.php?id=<?php echo $reco_result_array[3]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[3]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[3]['class_code']; ?>">
								<img src="<?php echo $image_array_s[$reco_result_array[3]['product_id']];?>" class='img-fluid'/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[3]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[3]['product_name']; ?></p>
					</div>
					<?php }  ?>
					<?php if($reco_result_array[4]['product_id']!=''){ ?>
					<div class="proBox2 col">
					
						<p class="border">
							<a href="../product/product_detail.php?id=<?php echo $reco_result_array[4]['product_id']; ?>&skey1=<?php echo substr($reco_result_array[4]['class_code'],0,3); ?>&skey2=<?php echo $reco_result_array[4]['class_code']; ?>">
								<img src="<?php echo $image_array_s[$reco_result_array[4]['product_id']];?>" class='img-fluid'/></a></p>
						<h5><?php echo $row_class['middle'][$reco_result_array[4]['class_code']]; ?></h5>
						<p class="stxt"><?php echo $reco_result_array[4]['product_name']; ?></p>
					</div>
					<?php }  ?>
					
				
			</div>
		 <!--일반상품 리스트-->	

			<div class="contents w-100" >
				<div class="subList row row-cols-2 row-cols-md-4 w-100">
			
					<?php
					if(count($row)>0) {
						$i=0;
						foreach($row as $data) {
					?>
					<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between" >
							
						<p class="border flex-grow-1">
							<a href="prd_view.php?id=<?php echo $data['dpv_id']?><?php echo $tmp_qstring2?>" class='d-block h-100'>
								<?php echo $data['dpv_product_image']?>
							</a>
						</p>
						<h5 class='text-center fs-18 mt-2'><?php echo $data['dpv_class_name_m'];?></h5>
						<p class="stxt text-center fs-16 "><?php echo $data['dpv_product_name']; ?>
						<?php
							
							$diff=$FUNC->dateDiff($data['internal_Date'],date('Y-m-d'));
							if($diff['d']<=30) {
						?>
							<img src="../img/common/new.gif">
						<?php } ?>
						<strong><?php echo $data['dpv_price_retail']; ?></strong>
					</p>
					</div>
					<?php
						$i++;
						}
					} else {
					?>
					<div class="proBox3" >
						등록 혹은 검색된 상품이 없습니다.
					
					</div>
					<?php
					}
					?>
		
			</div>
			<div class="paging pt-5 d-flex justify-content-center gap-2 align-items-center">
				<span class='prev_arrow d-flex flex-column justify-content-center px-2'>
					<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.11469 7.50024L6.90094 13.2872C7.01094 13.3972 7.06544 13.5292 7.06444 13.6832C7.06344 13.8372 7.00744 13.9695 6.89644 14.08C6.78544 14.1905 6.65319 14.2457 6.49969 14.2457C6.34619 14.2457 6.21394 14.1905 6.10294 14.08L0.372188 8.35299C0.251188 8.23149 0.162687 8.09649 0.106687 7.94799C0.0511875 7.79849 0.0234375 7.64924 0.0234375 7.50024C0.0234375 7.35124 0.0511875 7.20224 0.106687 7.05324C0.162687 6.90424 0.251188 6.76924 0.372188 6.64824L6.10219 0.915239C6.21269 0.804739 6.34569 0.750239 6.50119 0.751739C6.65619 0.753239 6.78919 0.809239 6.90019 0.919739C7.01019 1.03024 7.06519 1.16249 7.06519 1.31649C7.06519 1.47049 7.01019 1.60274 6.90019 1.71324L1.11469 7.50024Z" fill="black"/>
					</svg>
				</span>
				<?php echo $FUNC->getPageIndexH($CONF['request_uri'], $CONF['query_flag'], $cpage, $CONF['normal_page_limit'], $total_article); ?>
				<span class='next_arrow d-flex flex-column justify-content-center px-2'>
					<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.88531 7.50025L1.09906 1.71325C0.989062 1.60325 0.934562 1.47125 0.935562 1.31725C0.936562 1.16325 0.992562 1.031 1.10356 0.9205C1.21456 0.81 1.34681 0.754751 1.50031 0.754751C1.65381 0.754751 1.78606 0.81 1.89706 0.9205L7.62781 6.6475C7.74881 6.769 7.83731 6.904 7.89331 7.0525C7.94881 7.202 7.97656 7.35125 7.97656 7.50025C7.97656 7.64925 7.94881 7.79825 7.89331 7.94725C7.83731 8.09625 7.74881 8.23125 7.62781 8.35225L1.89781 14.0852C1.78731 14.1957 1.65431 14.2502 1.49881 14.2487C1.34381 14.2472 1.21081 14.1912 1.09981 14.0807C0.989811 13.9702 0.934812 13.838 0.934812 13.684C0.934812 13.53 0.989811 13.3977 1.09981 13.2872L6.88531 7.50025Z" fill="black"/>
					</svg>
				</span>
			</div>
		</div>
	</div>	

	<div class="caseList py-5 border-top " id="caseexpl">
		
		<!-- 시공사례 : ../case/case_list.php -->
	<div class='kw_wrap  max-width mx-auto py-5 px-3 px-xl-0'>
		<h2 class='fw400 fs-20 line-height-1 px-3 px-lg-0 mb-lg-4 mb-4 d-flex flex-column  gap-2 align-items-center align-items-lg-start  justify-content-center justify-content-lg-start letter-spacing-0-5'>
			<strong class='active-color fs-37 fw700 col-12 text-center text-lg-start col-lg-auto'>
				시공갤러리
			</strong>
			<span><span class='fw800'>20년 시공노하우</span>로 완성한 공간들</span>
		</h2>
		<div class="swiper overflow-visible">
			<div class="swiper-wrapper">
				<?php if(count($case_data)>0){ ?>
					<?php foreach($case_data as $data){ ?>
						<div class="swiper-slide">
							<div class="imgThumb">
								<?php if($row_img_case[$data['id']]!==''){ ?>
									<a href="<?php echo $kw_url; ?>/case/case_view.php?tc=construction&id=<?php echo $data['id'];?>" class='d-block'>
										<img src="../inc/parseImage_s.php?id=<?php echo $row_img_case[$data['id']]?>" class='img-fluid w-100' alt="">
									</a>
								<?php } else { ?>
									<a href="<?php echo $kw_url; ?>/case/case_view.php?tc=construction&id=<?php echo $data['id'];?>" class='d-block'>
										<img src="../img/product/noimg.jpg" alt="" class='img-fluid  w-100'>
									</a>							
								<?php } ?>
									<a href="<?php echo $kw_url; ?>/case/case_view.php?tc=construction&id=<?php echo $data['id'];?>" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
										<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
										<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
										<span class='fs-16 fw600'><?php echo $FUNC->stringCut($data['subject'],15); ?></span>
									</a>
								
							</div>
						</div>
						
					<?php } ?>
				<?php } else { ?>
				<div class="proBox1 swiper-slide" > 등록된 시공사례가 없습니다. </div>
				<?php } ?>
			</div>
		</div>
		<script>
	
		
	const caseexpl = new Swiper('#caseexpl .swiper', {
    loop: true,
    slidesPerView: 4,       // 기본값 (1300px 이상)
    spaceBetween: 25,       // 기본 간격
    loopedSlides: 6,
    autoplay: {
         delay: 5000,
         disableOnInteraction: false,
     },
    watchSlidesProgress: true,
    watchSlidesVisibility: true,

    breakpoints: {
        1300: { // 1300px 이상
            slidesPerView: 4,
            spaceBetween: 25,
            centeredSlides: false
        },
        1080: { // 1080px 이상 ~ 1299px
            slidesPerView: 3,
            spaceBetween: 16,
            centeredSlides: true
        },
        768: {  // 768px 이상 ~ 1079px
            slidesPerView: 1,
            spaceBetween: 16,
            centeredSlides: true
        },
        0: { // 0px 이상 ~ 767px
            slidesPerView: 1,
            spaceBetween: 16,
            centeredSlides: true
        }
    },

  
});

			</script>
		
	</div>

			
		
					
				
		
		
			<!--//리스트-->
	</div>
	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>