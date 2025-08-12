<?php 
//define('_PROLIST_',true);
//하단고객센터 노출관련 변수
//define('_FC_', true);
include_once("../config.php");

?>


<?php include_once($kw_path."/inc/header_2025.php"); ?>
<script type="text/javascript" src="/document/js/ext-all.js"></script>
<script type="text/javascript" src="/document/js/ext-langKO.js"></script>
<script language="javascript" type="text/javascript">
	var tmp_html = '<form name="frmSecret" id="frmSecret" method="post" onSubmit="return false;" style="margin:0px;"><table border="0" cellpadding="0" cellspacing="0" width="200" ><tr><td style="padding-top:10px; padding-bottom:10px; text-align:center;">비밀번호를 입력해주세요.</td></tr><tr><td style="text-align:center; vertical-align:middle;"><input type="password" name="secret_passwd" id="secret_passwd" maxlength="16" style="width:100px;"></td></tr></table>';

	function detailWindow(pid) {
			win = new Ext.Window({
				title: '비밀번호 인증',
				layout: "fit",
				width: 200,
				height: 130,
				modal: true,
				closeAction: "close",
				shim: false,
				html:tmp_html,
				buttons: [{
					text: "확 인",
					iconCls: "btnAdd",
					handler:function(){

						if(Ext.isEmpty(Ext.util.Format.trim(Ext.get("secret_passwd").getValue())))
						{
							Ext.Msg.alert("안내", "<br /><b>비밀번호를 입력하세요</b> <br />");
							return false;
						}
						win.body.mask("Lodding..", "x-mask-loading");
						Ext.Ajax.request({url: '../customer/proc_board.php', params:{mode:"secret_view", secret_id:pid,  board_id:"<?php echo $tmp_tc?>"},  method: "post", scope: this, form: "frmSecret",
								success: function(response, action){
								//var r = Ext.util.JSON.decode(response.responseText);
								var r = Ext.JSON.decode(response.responseText);
								win.body.unmask();
								if(r.success == "success"){
									win.close();
									location.href="./qna_view.php?spw="+r.sid+'&'+r.qstring;
								} else if(r.success == 'Fail01'){
									Ext.MessageBox.show({title: "안내", msg: r.msg , buttons: Ext.MessageBox.OK, icon: Ext.MessageBox.WARNING });
								} else {
									Ext.MessageBox.show({title: "안내", msg: r.msg , buttons: Ext.MessageBox.OK, icon: Ext.MessageBox.WARNING });
								}
							},
							failure: function(response, action){ win.body.unmask(); Ext.MessageBox.show({title: "오류", msg: '비밀번호 인증 실패', buttons: Ext.MessageBox.OK, icon: Ext.MessageBox.ERROR});}
						});
					}
				},{
					text: "창 닫기",
					iconCls: "btnDelete",
					handler: function(){ win.close(); }
				}]
			});

		win.show();
		document.getElementById('secret_passwd').focus();

	}
</script>
<script language="javascript" type="text/javascript">
	function searchForm()
	{
		document.getElementById("frmSearch").submit();
	}
</script>
<?php include_once($kw_path."/inc/top_2025.php"); ?>

<!--시공갤러리 목록 리스트-->	







<?php 


/*--- 게시판 코드 무결성 검증 ---*/
$tmp_tc = 'construction';
$view_page = $kw_url.'/page/gallery_view.php';

/*--- 게시판 환경설정값 호출 및 테이블 체크 ---*/
$SQL->select(
	'board_environment',
	array('id', 'board_id', 'board_kind', 'board_name', 'secret_flag', 'write_grade', 'reply_write_flag', 'comment_write_flag', 'pds_flag', 'pds_kind'),
	'board_id=\''.$tmp_tc.'\''
);
$env_board = $SQL->fetch_assoc();
if(!isset($env_board['id']) OR intval($env_board['id']) < 1)
{
	$SQL->rollback_msg_nomove();
	$FUNC->redirect('jv_back', '게시판 코드가 잘못 지정되었습니다.');
}
$table_name = 'bbs_'.$env_board['board_id'];
/*=== 게시판 환경설정값 호출 및 테이블 체크 ===*/


/*--- Page navigation ---*/
$CONF['normal_page_limit'] = 9;
if(!isset($_GET['cpage']))
{
	$cpage = 1;
	$offset = 0;
} else {
	$cpage = $_GET['cpage'];
	if($cpage < 1) $cpage = 1;
	$offset = ($cpage - 1) * $CONF['normal_page_limit'];
}
/*=== Page navigation ===*/

/*-- 분류 호출 --*/
$SQL->select(
	'product_class',
	array('id', 'class_code', 'class_name', 'class_b'),
	'',
	'class_name ASC'
);
$row_class = $tpv_class_big_list = $tpv_class_middle_list = $tpv_class_small_list = array();
while($data = $SQL->fetch_assoc())
{
	//if(intval($data['class_code']) < 1000)
	if(strlen($data['class_code']) == 3)
	{
		$tmp_rowb[] = $data;
		$tpv_class_big_list[] = array('class_code' => $data['class_code'], 'class_name' => $data['class_name'], 'class_b' => $data['class_b']);
		$row_class['big'][$data['class_code']] = $data['class_name'];
		if($data['class_code']==$_GET['skey1']){ $class_name_big=$data['class_name']; $class_name_big_code=$data['class_code']; }
	} else if(strlen($data['class_code']) == 6) {
		$tpv_class_middle_list[] = array('class_code_b' => substr($data['class_code'], 0, 3), 'class_code' => $data['class_code'], 'class_name' => $data['class_name'], 'class_b' => $data['class_b']);
		$row_class['middle'][$data['class_code']] = $data['class_name'];
		if($data['class_code']==$_GET['skey2']){ $class_name_mid=$data['class_name']; $class_name_mid_code=$data['class_code'];  }
	} else {
		$tpv_class_small_list[] = array('class_code_b' => substr($data['class_code'], 0, 3), 'class_code_m' => substr($data['class_code'], 0, 6), 'class_code' => $data['class_code'], 'class_name' => $data['class_name'], 'class_b' => $data['class_b']);
		$row_class['small'][$data['class_code']] = $data['class_name'];
	}

}

sort($tmp_rowb);
if(count($tmp_rowb) > 0)
{
	foreach($tmp_rowb as $data)
	{
		$row_list[] = array(
			'dpv_no'			=> $i,
			'dpv_id'			=> $data['id'],
			'dpv_class_b'		=> $data['class_b'],
			'dpv_class_code'	=> $data['class_code'],
			'dpv_class_name'	=> $data['class_name'],
			'dpv_list_flag'		=> $data['list_flag'],
			//'dpv_first_class'	=> isset($tmp_rowm[$data['first_class']]) ? $tmp_rowm[$data['first_class']] : ''
			'dpv_first_class'	=> (isset($tmp_rowm[$data['class_code']]) AND count($tmp_rowm[$data['class_code']])>0) ? $tmp_rowm[$data['class_code']] : 'n'
		);
	}
}


unset($data);
/*== 분류 호출 ==*/

/*----- 게시판 리스트 -----*/
$total_article = 0;
$row_list = $where_array = $where_array_idx = array();
/*----------------*/
/*--- 검색 조건 ---*/

$tmpSkey = isset($_GET['skey']) ? $_GET['skey'] : '';
if(isset($_GET['sbval']) AND strlen($_GET['sbval']) > 0)
{
	$tmp_sbval = trim($_GET['sbval']);
	$tmp_sbval = $SQL->esc_like($SQL->esc_gpc($tmp_sbval));
	switch($tmpSkey)
	{
		case 1 :	$where_array[] = 'author_name like \'%'.$tmp_sbval.'%\''; break;
		case 2 :	$where_array[] = 'replace(subject, \' \', \'\') LIKE \'%'.str_replace(' ', '', $tmp_sbval).'%\''; break;
		case 3 :	$where_array[] = 'contents LIKE \'%'.$tmp_sbval.'%\''; break;
		default : $where_array[] = '(replace(subject, \' \', \'\') LIKE \'%'.str_replace(' ', '', $tmp_sbval).'%\' OR contents LIKE \'%'.$tmp_sbval.'%\')'; break;
	}
}

if($_GET['skey1']!="" and $_GET['skey1']>0){ 
	$where_array[] = 'skey1_1 = \''.$_GET['skey1'].'\'';
}
if($_GET['place']!=""){ 
	$where_array[] = 'place = \''.base64_decode($_GET['place']).'\'';
}
if($_GET['skey2']!="" and $_GET['skey2']>0){ 
	$where_array[] = 'skey1 = \''.substr($_GET['skey2'],0,3).'\'';
}

$tmp_sbval = isset($_GET['sbval']) ? htmlspecialchars($_GET['sbval'], ENT_QUOTES) : '';
/*- 인덱스 쿼리 -*/
$SQL->select(
	$table_name,
	array('list_group', 'list_order'),
	$where_array,
	'list_group ASC, list_order ASC',
	(($cpage - 1) * $CONF['normal_page_limit']), 1
);
$data = $SQL->fetch_assoc();
if(isset($data['list_group']) AND !empty($data['list_group'])) $where_array_idx[] = '(list_group='.$data['list_group'].' AND list_order >= '.$data['list_order'].') OR list_group > '.$data['list_group'];
if($tmp_tc <> 'qna') $where_array[] = 'list_depth=0';
$where_array_total = $where_array;
if(count($where_array_idx) > 0) $where_array = array_merge($where_array, $where_array_idx);
/*= 인덱스 쿼리 =*/
/*=== 검색 조건 ===*/
/*================*/


/*--- 답변 여부 확인용 ---*/
$reply_row = array();
if($tmp_tc == 'qna')
{
	$SQL->select(
		$table_name,
		array('id', 'list_group'),
		array_merge($where_array_idx, array('list_depth > 0'))
	);
	while($data = $SQL->fetch_assoc()) $reply_row[] = $data['list_group'];
	unset($data);
}
/*=== 답변 여부 확인용 ===*/

//print_r($where_array_total);
$tmp_total_article = $SQL->select_num_rows(
	$table_name,
	'COUNT(id) AS id',
	$where_array_total
);
$total_article = $tmp_total_article['id'];
if($tmp_tc == 'faq') $field_array = array('id', 'list_group', 'list_depth', 'author_id', 'author_name', 'subject', 'contents', 'hit_count', 'attach_flag', 'secret_flag', 'secret_id', 'internal_date', 'html_flag', 'kind_flag');
else $field_array = array('id', 'list_group', 'list_depth', 'author_id', 'author_name', 'subject', 'hit_count', 'attach_flag', 'secret_flag', 'secret_id', 'internal_date', 'kind_flag', 'etc_field');
if($tmp_tc == 'construction') $field_array = array('id', 'list_group', 'list_order', 'list_depth', 'top_flag', 'author_id', 'author_name', 'author_mail', 'author_phone', 'subject', 'contents', 'html_flag', 'hit_count', 'attach_flag', 'internal_date', 'internal_remote_addr', 'internal_remote_addr_for', 'modify_date', 'modify_remote_addr', 'modify_remote_addr_for', 'kind_flag', 'etc_field','skey1','skey1_1');
$order_array = array('list_group ASC', 'list_order ASC');

$SQL->select(
	$table_name,
	$field_array,
	$where_array,
	$order_array,
	0, $CONF['normal_page_limit']
);

$row_list = $comment_where_str = $while_data = array();
while($tmp_data = $SQL->fetch_assoc())
{
	$comment_where_str[] = 'board_id='.$tmp_data['id']; //코멘트 호출 번호 부여
	$while_data[] = $tmp_data;
}

/*-- 코멘트 개수 호출 --*/
if($env_board['comment_write_flag'] == 'y' AND count($comment_where_str) > 0)
{
	$SQL->select(
		'board_comment',
		array('board_id', 'author_id'),
		array('board_environment_id=\''.$env_board['board_id'].'\'', implode(' OR ', $comment_where_str))
	);
	$row_comment = $row_comment_flag = array();
	while($data = $SQL->fetch_assoc())
	{
		if($data['author_id'] == '1' OR $data['author_id']=='wiseinha') $row_comment_flag[$data['board_id']] = 'yes';
		if(isset($row_comment[$data['board_id']])) ++$row_comment[$data['board_id']];
		else $row_comment[$data['board_id']] = 1;
	}
	unset($data);
}

//첨부파일

if(count($comment_where_str)>0){
	$SQL->select(
		'board_attachments',
		array('id', 'board_id','filename'),
		array('board_environment_id=\''.$env_board['board_id'].'\'', implode(' OR ', $comment_where_str)),
		'id DESC'
	);
	$row_img = array();
	while($data = $SQL->fetch_assoc())
	{
		$tmp_ext = substr(strrchr(strtolower($data['filename']),'.'),1);
		
		if(in_array($tmp_ext,array('gif', 'jpg', 'jpeg','png'))){
			$row_img[$data['board_id']]=$data['id'];
		}
	}
	unset($data);
}

/*== 코멘트 개수 호출 ==*/
if(count($while_data) > 0)
{//실 리스트 데이터
	$show_no = $total_article - $offset;
	foreach($while_data as $data)
	{
		$data['subject'] = $FUNC->stringCut($data['subject'], 32, '..');
		if(ereg('dDb'.chr(27).'D.e.l.e.t.e', $data['subject']))
		{
			$tmp_subject_flag = 'delete';
			$tmp_subject = '';
		} else {
			$tmp_subject_flag = '';
			//제목 검색시 하일라이트
			if(isset($_GET['sbval']) AND strlen($_GET['sbval']) > 0) $tmp_subject = $FUNC->stringHighLight(htmlspecialchars($data['subject'], ENT_NOQUOTES), $_GET['sbval'], '#D7B104');
			else $tmp_subject = htmlspecialchars($data['subject'], ENT_QUOTES);
			//if(isset($_GET['sbval']) AND strlen($_GET['sbval']) > 0) $tmp_subject = $FUNC->stringHighLight($data['subject'], $_GET['sbval'], '#D7B104');
			//else $tmp_subject = $data['subject'];
		}

		//최근글 표현
		if((mktime() - strtotime($data['internal_date'])) < 48*60*60 ) $tmp_new_flag = 'new';
		else $tmp_new_flag = '';

		//코멘트 개수 및 새창 표현 링크
		$tmp_admin_flag = 'no';
		if(isset($row_comment[$data['id']]))
		{
			//if($data['secret_flag'] == 1) $tmp_comment_link = '<span style="font-size: 8pt;">['.$row_comment[$data['id']].']</span>';
			$tmp_comment_link = '<span style="font-size: 8pt;">['.$row_comment[$data['id']].']</span>';
			if(isset($row_comment_flag[$data['id']]) AND $row_comment_flag[$data['id']] == 'yes') $tmp_admin_flag = 'yes';
		} else {
			$tmp_comment_link = '';
		}

		$tmp_contents = '';
		if($tmp_tc == 'faq')
		{
			//내용
			if($data['html_flag'] == 1) $tmp_contents = $FUNC->escapeScriptNl2Br($data['contents'], 'yes');
			else $tmp_contents = $FUNC->escapeScriptNl2Br($data['contents'], 'no');
		}
		
		$img_id='';
		if(isset($row_img[$data['id']])) $img_id=$row_img[$data['id']];

		$tmp_reply_flag = 'n';
		if(in_array(intval($data['list_group']), $reply_row)) $tmp_reply_flag = 'y';
		//echo $tmp_admin_flag;
		$row_list[] = array(
			'dpv_admin_flag'	 => $tmp_admin_flag,
			'dpv_show_no'		=> number_format($show_no),
			'dpv_id'			=> $data['id'],
			'dpv_list_depth'	=> isset($data['list_depth']) ? ($data['list_depth'] * 10) : 0,
			'dpv_author_id'		=> $data['author_id'],
			'dpv_author_name'	=> htmlspecialchars($data['author_name'], ENT_QUOTES),
			'dpv_reply_delete'	=> $tmp_subject_flag,
			'dpv_subject'		=> $tmp_subject,
			'dpv_hit_count'		=> number_format($data['hit_count']),
			'dpv_attach_flag'	=> $data['attach_flag'],
			'dpv_secret_flag'	=> $data['secret_flag'],
			'dpv_secret_id'		=> $data['secret_id'],
			'dpv_internal_date'	=> $FUNC->dateConvert($data['internal_date'], 2),
			'dpv_new_flag'		=> $tmp_new_flag,
			'dpv_kind_flag'		=> $data['kind_flag'],
			'dpv_comment_cnt'	=> $tmp_comment_link,
			'dpv_comment_cnt2'	=> $row_comment[$data['id']],
			'dpv_contents'		=> $tmp_contents,
			'dpv_reply_flag'	=> $tmp_reply_flag,
			'dpv_skey1_1'		=> $row_class['big'][$data['skey1_1']],
			'dpv_skey1'			=> $row_class['middle'][$data['skey1']],
			'dpv_img_id'		=> $img_id,
			'dpv_etc'			=> $data['etc_field']
		);
		--$show_no;
	}
}
unset($data, $tmp_data, $while_data, $comment_where_str);
/*===== 게시판 리스트 =====*/



/*--- 최상위 게시물 ---*/
if($tmp_tc == 'faq') $top_field_array = array('id', 'author_id', 'author_name', 'subject', 'contents', 'hit_count', 'attach_flag', 'secret_flag', 'secret_id', 'internal_date', 'html_flag', 'kind_flag');
else $top_field_array = array('id', 'author_id', 'author_name',  'subject', 'hit_count', 'attach_flag', 'secret_flag', 'secret_id', 'internal_date', 'kind_flag');
$SQL->select(
	$table_name,
	$top_field_array,
	'top_flag=1',
	'list_group ASC, list_order ASC'
);
$while_data = $comment_where_str = array();
while($tmp_data = $SQL->fetch_assoc())
{
	//코멘트 호출 번호 부여
	$comment_where_str[] = 'board_id='.$tmp_data['id'];
	$while_data[] = $tmp_data;
}

/*-- 코멘트 개수 호출 --*/
if($env_board['comment_write_flag'] == 'y' AND count($comment_where_str) > 0)
{
	$SQL->select(
		'board_comment',
		'board_id',
		array('board_environment_id=\''.$env_board['board_id'].'\'', implode(' OR ', $comment_where_str))
	);
	$row_comment_top = array();
	while($data = $SQL->fetch_assoc())
	{
		if(isset($row_comment_top[$data['board_id']])) ++$row_comment_top[$data['board_id']];
		else $row_comment_top[$data['board_id']] = 1;
	}
	unset($data);
}
/*== 코멘트 개수 호출 ==*/

$row_top = array();
if(count($while_data) > 0)
{
	foreach($while_data as $data)
	{
		//코멘트 개수 및 새창 표현 링크
		if(isset($row_comment_top[$data['id']]))
		{
			if($data['secret_flag'] == 1) $tmp_comment_link = '<span style="font-size: 8pt;">['.$row_comment_top[$data['id']].']</span>';
			else $tmp_comment_link = '<span style="font-size: 8pt;">['.$row_comment_top[$data['id']].']</span>';
		} else {
			$tmp_comment_link = '';
		}
		$data['subject'] = $FUNC->stringCut($data['subject'], 46, '..');
		$tmp_contents = '';
		if($tmp_tc == 'faq')
		{
			//내용
			if($data['html_flag'] == 1) $tmp_contents = $data['contents'];
			else $tmp_contents = $FUNC->escapeScriptNl2Br($data['contents'], 'yes');
		}
		$row_top[] = array(
			'top_id'			=> $data['id'],
			'top_kind_flag'		=> $data['kind_flag'],
			'top_author_id'		=> $data['author_id'],
			'top_author_name'	=> htmlspecialchars($data['author_name'], ENT_QUOTES),
			'top_subject'		=> htmlspecialchars($data['subject'], ENT_QUOTES),
			'top_hit_count'		=> number_format($data['hit_count']),
			'top_attach_flag'	=> $data['attach_flag'],
			'top_secret_flag'	=> $data['secret_flag'],
			'top_secret_id'		=> $data['secret_id'],
			'top_internal_date'	=> $FUNC->dateConvert($data['internal_date'], 2),
			'top_comment_cnt'	=> $tmp_comment_link,
			'top_contents'		=> $tmp_contents
		);
	}
}
/*=== 최상위 게시물 ===*/

//장소

	$SQL->select(
		'bbs_construction',
		'place',
		"place<>''"
	);
	$row_comment_top = array();
	while($data = $SQL->fetch_assoc())
	{
		$tpv_place_list[] = $data['place'];
	}
	

$total_page = ceil($total_article / $CONF['normal_page_limit']);
if($total_page < 1) $now_page = 0;
else $now_page = $cpage;
$tmp_qstring = $CONF['query_string'];
$row_list_count = count($row_list);
?>

	 <!-- 제품하위카테고리 -->
	 <div class='subMn border-bottom py-5'>
			<div class="max-width mx-auto px-3 px-xl-0 d-flex w-100 justify-content-between align-items-center pt-0">
				<div>
					<h2 class='page_title fs-48 fw400 backgroundnone'>
							<span >
								시공갤러리
							</span>
							
							<strong class='active-color fw400 text-uppercase'>
								 Gallery
							</strong>
					</h2> 
					<p class='fs-20 gray-dark mt-3'>
						고객 공간에 최적화된 맞춤 시공으로 완성된<br>
                        다양한 카페트 사례를 만나보세요.
					</p>
				</div>
					
				<!--검색-->
				<div class='kw_gallery_searchdom'>
					<form name="frmSearch" id="frmSearch" class="d-flex align-items-center gap-3 " action="<?php echo $_SERVER['PHP_SELF']?>" method="GET" onSubmit="return searchForm();">
							
							<select name="place" id="place" size="1"  class='d-none' onChange="searchForm()">
							<option value="0">:: 전체 ::</option>
							<?php foreach($tpv_place_list as $place_list){ ?>
								<option value="<?php echo base64_encode($place_list); ?>" <?php if($place_list==base64_decode($_GET['place']) ){ ?> selected="selected" <?php } ?>><?php echo $place_list; ?></option>
							<?php } ?>
							</select>

							<select name="skey1" id="skey1" size="1" class='border border-dark-gray  px-3 rounded-3 h43 bg-white' onChange="searchForm()">
								
								<option value="0" class='d-flex bg-white'>  전체보기 
								</option>
								<?php foreach($tpv_class_big_list as $class){ ?>
									<option value="<?php echo $class['class_code']; ?>" <?php if($class['class_code']==$_GET['skey1'] || $class['class_code']==substr($_GET['skey2'],0,3)){ ?> selected="selected" <?php } ?>><?php echo $class['class_name']; ?></option>
								<?php } ?>
							</select>
							<div class='border border-dark-gray  px-3 rounded-3 d-flex align-items-center h43 '>
								<input type="text" name="sbval" id="sbval" maxlength="50" class='border-0' value="<?php echo $tmp_sbval?>" 
								placeholder="검색어를 입력해주세요."   />
								<input type="image" src="../img/2025/ui/search_icon.png"  />
							</div>
							
					</form>
			  	</div>
			
				<!--//검색-->
			</div>
	 </div>

<div class=' position-relative content_wrapper mainContentwrapper'  >

	 <!-- 갤러리 게시판 목록			 -->

	<div>
	<!--서브컨텐츠-->
		<div class="contents max-width mx-auto px-3 px-xl-0"  >				
			<!--게시판-->
			<?php if($class_name_big!=''){ ?>
			<div class='board_gallery'>				
				<?php echo $class_name_big;?> <?php if($class_name_mid!=''){ ?><  <b><?php echo $class_name_mid;?></b><?php } ?>
			</div>
			<?php } ?>	



			<div class="subList row row-cols-2 row-cols-md-4 w-100 pt-5">			
				
		
				<?php 
					$idx=0;
					if($row_list_count>0){
					$show_no = $total_article-$offset;

					foreach($row_list as $data) {
					?>
					
						<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between" >
							<p class="border flex-grow-1">						
							
							<? if(!empty($tmp_qstring)){ ?>
								<a href="<?php echo $view_page;?>?tc=<?php echo $tmp_tc;?>&id=<?php echo $data['dpv_id'].'&amp;'.$tmp_qstring;?>" class='d-block h-100'>
							<?php } else { ?>
								<a href="<?php echo $view_page;?>?tc=<?php echo $tmp_tc;?>&id=<?php echo $data['dpv_id']?>" class='d-block h-100'>
							<?php } ?>
							<?php if($data['dpv_img_id']!=''){ ?>
								<img src="../inc/parseImage_s.php?id=<?php echo $data['dpv_img_id']?>" class='img-fluid w-100' />
							<?php } else { ?>
								<img src="../img/product/noimg.jpg" class='img-fluid w-100' />
							<?php } ?>
								</a>
							
							<h5 class='text-center fs-18 mt-2'><?php if($data['dpv_skey1_1']!=""){ echo $data['dpv_skey1_1']; if($data['dpv_skey1']!=""){ echo " > ".$data['dpv_skey1']; }  } ?></h5>
							<span class="stxt text-center fs-16 "><?php echo $data['dpv_subject']?></span>
							</a>
							</p>				
					
						</div>
					
					<?php
						$idx++;
						$show_no--;
						}
					} else {// 게시물이 없거나 검색결과가 없을때
						if(isset($_GET['sbval']) AND strlen($_GET['sbval']) > 0) $s_comment = '검색어 [ <span style="color: #489742;">'.htmlspecialchars($_GET['sbval'], ENT_QUOTES).'</span> ]로 검색된 게시물이 없습니다.';
						else $s_comment = '해당분류에 등록된 시공사례가 없습니다.';
					?>
					
						<?php echo $s_comment; ?>
						
					<?php
					}
				?>
			</div>
			
			<div class="paging pt-5 pb-5 mb-4 d-flex justify-content-center gap-2 align-items-center">
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
	
	
	<!--//컨텐츠-->
		<?php $SQL->close(); ?>
	</div>	


	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>