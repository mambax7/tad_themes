<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2011-12-31
// $Id:$
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_themes_adm_dropdown_tpl.html";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/
//tad_themes_menu編輯表單
function tad_themes_menu_form($of_level="0",$menuid="",$mode="return"){
  global $xoopsDB,$xoopsTpl;

  $icon_arr=array( "icon-glass" , "icon-music" , "icon-search" , "icon-envelope" , "icon-heart" , "icon-star" , "icon-star-empty" , "icon-user" , "icon-film" , "icon-th-large" , "icon-th" , "icon-th-list" , "icon-ok" , "icon-remove" , "icon-zoom-in" , "icon-zoom-out" , "icon-off" , "icon-signal" , "icon-cog" , "icon-trash" , "icon-home" , "icon-file" , "icon-time" , "icon-road" , "icon-download-alt" , "icon-download" , "icon-upload" , "icon-inbox" , "icon-play-circle" , "icon-repeat" , "icon-refresh" , "icon-list-alt" , "icon-lock" , "icon-flag" , "icon-headphones" , "icon-volume-off" , "icon-volume-down" , "icon-volume-up" , "icon-qrcode" , "icon-barcode" , "icon-tag" , "icon-tags" , "icon-book" , "icon-bookmark" , "icon-print" , "icon-camera" , "icon-font" , "icon-bold" , "icon-italic" , "icon-text-height" , "icon-text-width" , "icon-align-left" , "icon-align-center" , "icon-align-right" , "icon-align-justify" , "icon-list" , "icon-indent-left" , "icon-indent-right" , "icon-facetime-video" , "icon-picture" , "icon-pencil" , "icon-map-marker" , "icon-adjust" , "icon-tint" , "icon-edit" , "icon-share" , "icon-check" , "icon-move" , "icon-step-backward" , "icon-fast-backward" , "icon-backward" , "icon-play" , "icon-pause" , "icon-stop" , "icon-forward" , "icon-fast-forward" , "icon-step-forward" , "icon-eject" , "icon-chevron-left" , "icon-chevron-right" , "icon-plus-sign" , "icon-minus-sign" , "icon-remove-sign" , "icon-ok-sign" , "icon-question-sign" , "icon-info-sign" , "icon-screenshot" , "icon-remove-circle" , "icon-ok-circle" , "icon-ban-circle" , "icon-arrow-left" , "icon-arrow-right" , "icon-arrow-up" , "icon-arrow-down" , "icon-share-alt" , "icon-resize-full" , "icon-resize-small" , "icon-plus" , "icon-minus" , "icon-asterisk" , "icon-exclamation-sign" , "icon-gift" , "icon-leaf" , "icon-fire" , "icon-eye-open" , "icon-eye-close" , "icon-warning-sign" , "icon-plane" , "icon-calendar" , "icon-random" , "icon-comment" , "icon-magnet" , "icon-chevron-up" , "icon-chevron-down" , "icon-retweet" , "icon-shopping-cart" , "icon-folder-close" , "icon-folder-open" , "icon-resize-vertical" , "icon-resize-horizontal" , "icon-hdd" , "icon-bullhorn" , "icon-bell" , "icon-certificate" , "icon-thumbs-up" , "icon-thumbs-down" , "icon-hand-right" , "icon-hand-left" , "icon-hand-up" , "icon-hand-down" , "icon-circle-arrow-right" , "icon-circle-arrow-left" , "icon-circle-arrow-up" , "icon-circle-arrow-down" , "icon-globe" , "icon-wrench" , "icon-tasks" , "icon-filter" , "icon-briefcase" , "icon-fullscreen");

  //抓取預設值
  if(!empty($menuid)){
    $DBV=get_tad_themes_menu($menuid);
  }else{
    $DBV=array();
  }

  //預設值設定

  $menuid=(!isset($DBV['menuid']))?$menuid:$DBV['menuid'];
  $of_level=(!isset($DBV['of_level']))?$of_level:$DBV['of_level'];
  $position=(!isset($DBV['position']))?get_max_sort($of_level):$DBV['position'];
  $itemname=(!isset($DBV['itemname']))?"":$DBV['itemname'];
  $itemurl=(!isset($DBV['itemurl']))?"":$DBV['itemurl'];
  $membersonly=(!isset($DBV['membersonly']))?"":$DBV['membersonly'];
  $status=(!isset($DBV['status']))?"":$DBV['status'];
  $target=(!isset($DBV['target']))?"":$DBV['target'];
  $mainmenu=(!isset($DBV['mainmenu']))?"":$DBV['mainmenu'];
  $icon=(!isset($DBV['icon']))?"":$DBV['icon'];

  $xoopsTpl->assign('icon',$icon);

  $op=(empty($menuid))?"insert_tad_themes_menu":"update_tad_themes_menu";


  $get_tad_all_menu="";
  if(!empty($menuid)){
    $get_tad_all_menu="
    <div class='row-fluid'>
      <label class='span3'>"._MA_TADTHEMES_OF_LEVEL._TAD_FOR."</label>
      <div class='span8'>
        <select name='of_level' id='of_level'>
        <option value=''>"._MA_TADTHEMES_ROOT."</option>
        ".get_tad_all_menu("","",$of_level,$menuid,"1")."
        </select>
      </div>
    </div>
    ";
  }else{
    $get_tad_all_menu="<input type='hidden' name='of_level' value='{$of_level}'>";
  }

  $selectpicker="<option value='' $selected>"._MA_TADTHEMES_NONE."</option>";
  foreach($icon_arr as $icon_name){
    $selected=$icon_name==$icon?"selected":"";
    $selectpicker.="<option data-icon='{$icon_name}' value='{$icon_name}' $selected>{$icon_name}</option>\n";
  }

  $main="
  <form method='post' id='myForm' enctype='multipart/form-data'>
    $get_tad_all_menu
    <div class='row-fluid'>
      <label class='span3' for='itemname'>"._MA_TADTHEMES_ITEMNAME._TAD_FOR."</label>
      <div class='span8'>
        <input type='text' name='itemname' id='itemname' value='{$itemname}' class='span12' placeholder='"._MA_TADTHEMES_ITEMNAME."'>
      </div>
    </div>

    <div class='row-fluid'>
      <label class='span3' for='itemurl'>"._MA_TADTHEMES_ITEMURL._TAD_FOR."</label>
      <div class='span8'>
        <input type='text' name='itemurl' id='itemurl' value='{$itemurl}' class='span8' placeholder='"._MA_TADTHEMES_ITEMURL."'>
        <select name='target' class='span4'>
          <option value='_self'></option>
          <option value='_blank' ".chk($target,"_blank",0,'selected').">"._MA_TADTHEMES_TARGET_BLANK."</option>
          <option value='popup' ".chk($target,"popup",0,'selected').">"._MA_TADTHEMES_TARGET_FANCYBOX."</option>
        </select>
      </div>
    </div>

    <div class='row-fluid'>
      <label class='span3' for='icon'>"._MA_TADTHEMES_ICON._TAD_FOR."</label>
      <div class='span8'>
        <select name='icon' class='selectpicker' data-width='auto'>
          $selectpicker
        </select>
      </div>
    </div>

    <div class='row-fluid'>
      <label class='span3' for='image'>"._MA_TADTHEMES_ITEMICON._TAD_FOR."</label>
      <div class='span8'>
        <input type='file' name='image' id='image' class='span12'>
      </div>
    </div>

    <div class='row-fluid'>
      <label class='span3' for='banner_image'>"._MA_TADTHEMES_ITEMBANNER._TAD_FOR."</label>
      <div class='span8'>
        <input type='file' name='banner_image' id='banner_image' class='span12'>
      </div>
    </div>

    <input type='hidden' name='menuid' value='{$menuid}'>
    <input type='hidden' name='status' value='{$status}'>
    <input type='hidden' name='op' value='{$op}'>
    <input type='hidden' name='position' value='{$position}'>
    <button type='button' id='submit' class='btn btn-primary'>"._TAD_SAVE."</button>

  </form>";


  if($mode=="die"){
    $jquery=get_jquery();
    $main2="
    <!DOCTYPE html>
    <html lang='zh-TW'>
      <head>
        <meta charset='utf-8'>
        <title></title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadtools/bootstrap/css/bootstrap.css' />
        <link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadtools/bootstrap/css/bootstrap-responsive.css' />
        <link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadtools/css/xoops_adm.css' />
      </head>
      <body>
        $main
        $jquery
        <script src='".XOOPS_URL."/modules/tadtools/bootstrap/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='".XOOPS_URL."/modules/tad_themes/class/bootstrap-select/bootstrap-select.js'></script>
        <link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/tad_themes/class/bootstrap-select/bootstrap-select.css'>
        <script type='text/javascript'>
          $(document).ready(function(){
            $('.selectpicker').selectpicker();

            $('#myForm').bind('submit', function()
              {
                $.ajax({
                  type: 'POST',
                  url: '{$_SERVER['PHP_SELF']}',
                  //data: $(this).serializeArray(),
                  data: new FormData( this ),
                  processData: false,
                  contentType: false,
                  success: function(data) {
                    parent.$.fancybox.close();
                  }
                });
              });
            $('#submit').click(function(e)
            {
                $('#myForm').trigger('submit');
                e.preventDefault();

            });
          });
        </script>
      </body>
    </html>
    ";
    die($main2);
  }
  return $main;
}


//做縮圖
if(!function_exists('thumbnail')){
  function thumbnail($filename="",$thumb_name="",$type="image/png",$width="160"){

    set_time_limit(0);
    ini_set('memory_limit', '100M');
    // Get new sizes
    list($old_width, $old_height) = getimagesize($filename);

    $percent=($old_width>$old_height)?round($width/$old_width,2):round($width/$old_height,2);
    $newwidth = ($old_width>$old_height)?$width:round($old_width * $percent,0);
    $newheight = ($old_width>$old_height)?round($old_height * $percent,0):$width;

    // Load
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    if($type=="image/jpeg" or $type=="image/jpg" or $type=="image/pjpg" or $type=="image/pjpeg"){
      $source = imagecreatefromjpeg($filename);
      $type="image/jpeg";
    }elseif($type=="image/png"){
      $source = imagecreatefrompng($filename);
      $type="image/png";
    }elseif($type=="image/gif"){
      $source = imagecreatefromgif($filename);
      $type="image/gif";
    }else{
      die($type);
    }

    imagealphablending($thumb, false);
    // Resize
    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $old_width, $old_height);

    imagesavealpha($thumb, true);

    // Output
    imagepng($thumb,$thumb_name);
    imagedestroy($source);
    imagedestroy($thumb);
  }
}


//自動取得新排序
function get_max_sort($of_level=""){
  global $xoopsDB,$xoopsModule;
  $sql = "select max(position) from ".$xoopsDB->prefix("tad_themes_menu")." where of_level='$of_level'";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  list($sort)=$xoopsDB->fetchRow($result);
  return ++$sort;
}


//新增資料到tad_themes_menu中
function insert_tad_themes_menu(){
  global $xoopsDB;
  $sql = "insert into ".$xoopsDB->prefix("tad_themes_menu")." (`of_level`,`position`,`itemname`,`itemurl`,`membersonly`,`status`,`mainmenu`,`target`,`icon`) values('{$_POST['of_level']}','{$_POST['position']}','{$_POST['itemname']}','{$_POST['itemurl']}','0','1',0,'{$_POST['target']}','{$_POST['icon']}')";
  $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  //取得最後新增資料的流水編號
  $menuid=$xoopsDB->getInsertId();

  $type_to_mime['png']="image/png";
  $type_to_mime['jpg']="image/jpg";
  $type_to_mime['peg']="image/jpg";
  $type_to_mime['gif']="image/gif";
  //處理上傳的檔案
  if(!empty($_FILES['image']['name'])){
    $file_ending= substr(strtolower($_FILES['image']["name"]), -3); //file extension
    $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_icons";
    mk_dir($dir);
    $filename=$_FILES['image']['tmp_name'];
    $thumb_name1="{$dir}/{$menuid}_64.png";
    thumbnail($filename,$thumb_name1,$type_to_mime[$file_ending],64);
    $thumb_name2="{$dir}/{$menuid}_32.png";
    thumbnail($filename,$thumb_name2,$type_to_mime[$file_ending],32);
  }


  if(!empty($_FILES['banner_image']['name'])){
    $file_ending= substr(strtolower($_FILES['banner_image']["name"]), -3); //file extension
    $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_banner";
    mk_dir($dir);
    $filename=$_FILES['banner_image']['tmp_name'];
    $destination="{$dir}/{$menuid}.png";
    $thumb="{$dir}/{$menuid}_thumb.png";
    move_uploaded_file($filename , $destination);
    thumbnail($destination,$thumb,$type_to_mime[$file_ending],120);
  }

  return $menuid;
}



//列出所有tad_themes_menu資料
function list_tad_themes_menu($add_of_level="",$menuid=""){
  global $xoopsDB , $xoopsModule , $xoopsTpl;


  $all=get_tad_level_menu("","",$menuid,"",$add_of_level);

  $op = (!isset($_REQUEST['op']))? "":$_REQUEST['op'];
  $option="";



  //$all=(empty($all))?"<tr><td colspan=2>".tad_themes_menu_form()."</td></tr>":$all;

  $jquery=get_jquery(true);

  $xoopsTpl->assign('jquery',$jquery);
  $xoopsTpl->assign('all',$all);
  $xoopsTpl->assign('option',$option);
  $xoopsTpl->assign('add_item',sprintf(_MA_TADTHEMES_ADDITEM,_MA_TADTHEMES_ROOT));

  if(!file_exists(XOOPS_ROOT_PATH."/modules/tadtools/treetable.php")){
     redirect_header("index.php",3, _MA_NEED_TADTOOLS);
    }
  include_once XOOPS_ROOT_PATH."/modules/tadtools/treetable.php";

  //treetable($show_jquery=true , $sn="cat_sn" , $of_sn="of_cat_sn" , $tbl_id="#tbl" , $post_url="save_drag.php" ,$folder_class=".folder", $msg="#save_msg" ,$expanded=true,$sort_id="", $sort_url="save_sort.php", $sort_msg="#save_msg2")
  $treetable=new treetable(false , "menuid" , "of_level" , "#tbl" , "save_drag.php" , ".folder" , "#save_msg" , true , ".sort", "save_sort.php" , "#save_msg");
  $treetable_code=$treetable->render();

  $xoopsTpl->assign('treetable_code',$treetable_code);

  if(!file_exists(XOOPS_ROOT_PATH."/modules/tadtools/fancybox.php")){
    redirect_header("index.php",3, _MA_NEED_TADTOOLS);
  }
  include_once XOOPS_ROOT_PATH."/modules/tadtools/fancybox.php";
  $fancybox=new fancybox('.edit_dropdown','800','90%');
  $fancybox_code=$fancybox->render();
  $xoopsTpl->assign('fancybox_code',$fancybox_code);

/*
  include_once(XOOPS_ROOT_PATH."/modules/tadtools/ztree.php");
  $sql = "select `menuid`,`of_level`,`itemname`,`position`,`itemurl`,`status`,`mainmenu`,`target`,`icon` from ".$xoopsDB->prefix("tad_themes_menu")." order by position";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  while(list($menuid,$of_level,$itemname,$position,$itemurl,$status,$mainmenu,$target,$icon)=$xoopsDB->fetchRow($result)){
    $item[$menuid]['id']=$menuid;
    $item[$menuid]['parent_id']=$of_level;
    $item[$menuid]['title']=$itemname;
    //$item[$menuid]['url']=$itemurl;
    $item[$menuid]['open']=true;
    if($of_level==0){
      $item[$menuid]['iconOpen']=XOOPS_URL."/modules/tadtools/zTree/css/zTreeStyle/img/diy/1_open.png";
      $item[$menuid]['iconClose']=XOOPS_URL."/modules/tadtools/zTree/css/zTreeStyle/img/diy/1_close.png";
    }else{
      $item[$menuid]['icon']=XOOPS_URL."/modules/tadtools/zTree/css/zTreeStyle/img/diy/2.png";
    }
  }

  $ztree=new zTree($item,true,true);
  $ztreeCode=$ztree->render();
//die($ztreeCode);
  $xoopsTpl->assign('ztreeCode',$ztreeCode);
  */
}


//取得分類項目
function get_tad_level_menu($of_level=0,$level=0,$v="",$this_menuid="",$add_of_level="0"){
  global $xoopsDB,$xoopsUser,$xoopsModule;

  $left=$level*30;
  $font_size=16-($level*2);
  $level+=1;


  $left=(empty($left))?4:$left;

  $option="";
  $sql = "select `menuid`,`of_level`,`itemname`,`position`,`itemurl`,`status`,`mainmenu`,`target`,`icon` from ".$xoopsDB->prefix("tad_themes_menu")." where of_level='{$of_level}'  order by position";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  $op = (!isset($_REQUEST['op']))? "":$_REQUEST['op'];
  $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_icons";
  $banner_dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_banner";
  $url=XOOPS_URL."/uploads/tad_themes/menu_icons";
  $banner_url=XOOPS_URL."/uploads/tad_themes/menu_banner";
  while(list($menuid,$of_level,$itemname,$position,$itemurl,$status,$mainmenu,$target,$icon)=$xoopsDB->fetchRow($result)){

    $item=(empty($itemurl))?$itemname:"<a name='$menuid' href='{$itemurl}'><i class='{$icon}'></i> $itemname</a>";

    $add_img=($level>=3)?"":"<a href='{$_SERVER['PHP_SELF']}?op=add_tad_themes_menu&of_level={$menuid}' class='edit_dropdown' data-fancybox-type='iframe'><img src='../images/001_01.gif' align='absmiddle' alt='".sprintf(_MA_TADTHEMES_ADDITEM,$itemname)."' title='".sprintf(_MA_TADTHEMES_ADDITEM,$itemname)."'></a>";

    $status_tool=($status=='1')?"<a href='{$_SERVER['PHP_SELF']}?op=tad_themes_menu_status&menuid=$menuid&status=0' class='btn btn-mini btn-warning'>"._TAD_UNABLE."</a>":"<a href='{$_SERVER['PHP_SELF']}?op=tad_themes_menu_status&menuid=$menuid&status=1' class='btn btn-mini btn-info'>"._TAD_ENABLE."</a>";

    $status_color=($status=='1')?"":"style='background-color:#D0D0D0'";
    $status_color2=($status=='1')?"":"background-color:#D0D0D0";
    $target_icon=($target=="_blank")?"<span class='label' style='padding: 2px 4px;'>"._MA_TADTHEMES_TARGET_BLANK."</span>":"";
    $target_icon=($target=="popup")?"<span class='label label-success' style='padding: 2px 4px;'>popup</span>":$target_icon;

    $class=(empty($of_level))?"":"class='child-of-node-{$of_level}'";
    $parent=empty($of_level)?"":"data-tt-parent-id='$of_level'";


    $icon="";
    if(file_exists("{$dir}/{$menuid}_32.png")){
      $icon="<a href='{$url}/{$menuid}_32.png' class='edit_dropdown'><img src=\"{$url}/{$menuid}_32.png\"></a><a href=\"javascript:delete_tad_themes_pic('icon',$menuid);\"><img src='../images/delete.png'></a>";
    }
    $banner="";
    if(file_exists("{$banner_dir}/{$menuid}_thumb.png")){
      $banner="<a href='{$banner_url}/{$menuid}.png' class='edit_dropdown'><img src=\"{$banner_url}/{$menuid}_thumb.png\"></a><a href=\"javascript:delete_tad_themes_pic('banner' , $menuid);\"><img src='../images/delete.png'></a>";
    }

    $content="
    <td style='padding-left:{$left}px;$status_color2' >
      <a name='menuid_{$menuid}'></a>
      <img src='".XOOPS_URL."/modules/tadtools/treeTable/images/move_s.png' class='folder' alt='"._MA_TREETABLE_MOVE_PIC."' title='"._MA_TREETABLE_MOVE_PIC."'>
      <img src='".XOOPS_URL."/modules/tadtools/treeTable/images/updown_s.png' style='cursor: s-resize;margin:0px 4px;' alt='"._MA_TADTHEMES_SAVE_SORT."' title='"._MA_TADTHEMES_SAVE_SORT."'>
      {$position}
      <span style='font-size:{$font_size}px;' class='folder'>{$item}</span>
      $target_icon
      $add_img
    </td>
    <td $status_color>
      <a href=\"javascript:delete_tad_themes_menu_func($menuid);\" class='btn btn-mini btn-danger'>"._TAD_DEL."</a>
      <a href='{$_SERVER['PHP_SELF']}?op=modify_tad_themes_menu&menuid=$menuid#menuid_{$menuid}' class='btn btn-mini btn-success edit_dropdown' data-fancybox-type='iframe'>"._TAD_EDIT."</a>
      $status_tool

      $icon
      $banner
    </td>";


    $option.="<tr data-tt-id='{$menuid}' $parent id='node-_{$menuid}' $class style='letter-spacing: 0em;'>$content</tr>";



    $option.=get_tad_level_menu($menuid,$level,$v,$this_menuid,$add_of_level);

    if($add_of_level==$menuid){
      $col_left=$level*30;
      $option.="<tr id='tr_{$menuid}'><td style='padding-left:{$col_left}px;' colspan=2;>".tad_themes_menu_form($add_of_level)."</td></tr>";
    }
  }
  return $option;
}



//以流水號取得某筆tad_themes_menu資料
function get_tad_themes_menu($menuid=""){
  global $xoopsDB;
  if(empty($menuid))return;
  $sql = "select * from ".$xoopsDB->prefix("tad_themes_menu")." where menuid='$menuid'";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  $data=$xoopsDB->fetchArray($result);
  return $data;
}

//更新tad_themes_menu某一筆資料
function update_tad_themes_menu($menuid=""){
  global $xoopsDB;
  $sql = "update ".$xoopsDB->prefix("tad_themes_menu")." set  `of_level` = '{$_POST['of_level']}', `position` = '{$_POST['position']}', `itemname` = '{$_POST['itemname']}', `itemurl` = '{$_POST['itemurl']}', `membersonly` = '0', `status` = '{$_POST['status']}',`target`='{$_POST['target']}',`icon`='{$_POST['icon']}' where menuid='$menuid'";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  $type_to_mime['png']="image/png";
  $type_to_mime['jpg']="image/jpg";
  $type_to_mime['peg']="image/jpg";
  $type_to_mime['gif']="image/gif";
  //處理上傳的檔案
  if(!empty($_FILES['image']['name'])){
    $file_ending= substr(strtolower($_FILES['image']["name"]), -3); //file extension
    $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_icons";
    mk_dir($dir);
    $filename=$_FILES['image']['tmp_name'];
    $thumb_name1="{$dir}/{$menuid}_64.png";
    thumbnail($filename,$thumb_name1,$type_to_mime[$file_ending],64);
    $thumb_name2="{$dir}/{$menuid}_32.png";
    thumbnail($filename,$thumb_name2,$type_to_mime[$file_ending],32);
  }


  if(!empty($_FILES['banner_image']['name'])){
    $file_ending= substr(strtolower($_FILES['banner_image']["name"]), -3); //file extension
    $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_banner";
    mk_dir($dir);
    $filename=$_FILES['banner_image']['tmp_name'];
    $destination="{$dir}/{$menuid}.png";
    $thumb="{$dir}/{$menuid}_thumb.png";
    move_uploaded_file($filename , $destination);
    thumbnail($destination,$thumb,$type_to_mime[$file_ending],120);
  }
  return $menuid;
}

//刪除tad_themes_menu某筆資料資料
function delete_tad_themes_menu($menuid=""){
  global $xoopsDB;
  $sql = "delete from ".$xoopsDB->prefix("tad_themes_menu")." where menuid='$menuid'";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
}


//取得分類下拉選單
function get_tad_all_menu($of_level=0,$level=0,$v="",$this_menuid="",$no_self="1"){
  global $xoopsDB,$xoopsUser,$xoopsModule;

 if($level>=2)return;

  //$left=$level*10;
  $blank=str_repeat("&nbsp;",$level*3);
  $level+=1;


  $option="";
  $sql = "select `menuid`,`of_level`,`itemname` from ".$xoopsDB->prefix("tad_themes_menu")." where of_level='{$of_level}'  order by position";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  while(list($menuid,$of_level,$itemname)=$xoopsDB->fetchRow($result)){

    if($no_self=='1' and $this_menuid==$menuid)continue;
    $selected=($v==$menuid)?"selected":"";
    $color=($level=='1')?"#330033":"#990099";
    $option.="<option value='{$menuid}' style=color:{$color};' $selected>{$blank}{$itemname}</option>";
    $option.=get_tad_all_menu($menuid,$level,$v,$this_menuid,$no_self);
  }
  return $option;
}

//儲存排序
function save_sort(){
  global $xoopsDB;
  foreach($_POST['sort'] as $menuid=>$position){
    $sql= "update ".$xoopsDB->prefix("tad_themes_menu")." set  `position` = '{$position}' where menuid='{$menuid}'";
    $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  }
}


//自動匯入
function auto_import(){
  global $xoopsDB,$xoopsUser,$xoopsModule;

  $position=get_max_sort(0);
  $sql = "insert into ".$xoopsDB->prefix("tad_themes_menu")." (`of_level`,`position`,`itemname`,`itemurl`,`membersonly`,`status`) values(0,'{$position}','"._MA_TADTHEMES_WEB_MENU."','','0','1')";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  //取得最後新增資料的流水編號
  $of_level=$xoopsDB->getInsertId();


  $sql = "select name,dirname from ".$xoopsDB->prefix("modules")." where isactive='1' and hasmain='1' order by weight";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  while(list($name,$dirname)=$xoopsDB->fetchRow($result)){
   $position=get_max_sort($of_level);
    $sql = "insert into ".$xoopsDB->prefix("tad_themes_menu")." (`of_level`,`position`,`itemname`,`itemurl`,`membersonly`,`status`) values('{$of_level}','{$position}','{$name}','".XOOPS_URL."/modules/{$dirname}/','0','1')";
    $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  }

  return;
}


function tad_themes_menu_status($menuid,$status){
  global $xoopsDB;
  $sql = "update ".$xoopsDB->prefix("tad_themes_menu")." set  `status` = '$status' where menuid='$menuid'";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
}


//刪除圖片
function del_pic($type,$menuid){
  if($type=="icon"){
    $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_icons";
    $file1="{$dir}/{$menuid}_64.png";
    $file2="{$dir}/{$menuid}_32.png";

  }elseif($type=="banner"){
    $dir=XOOPS_ROOT_PATH."/uploads/tad_themes/menu_banner";
    $file1="{$dir}/{$menuid}.png";
    $file2="{$dir}/{$menuid}_thumb.png";
  }

  if(file_exists($file1)) unlink($file1);
  if(file_exists($file2)) unlink($file2);
}

/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "":$_REQUEST['op'];
$menuid = (!isset($_REQUEST['menuid']))? "":intval($_REQUEST['menuid']);
$of_level = (!isset($_REQUEST['of_level']))? "":intval($_REQUEST['of_level']);
$status = (!isset($_REQUEST['status']))? "1":intval($_REQUEST['status']);
$type = (!isset($_REQUEST['type']))? "":$_REQUEST['type'];

$xoopsTpl->assign('now_op',$op);

switch($op){

  //更新資料
  case "update_tad_themes_menu":
  update_tad_themes_menu($menuid);
  header("location: {$_SERVER['PHP_SELF']}#{$menuid}");
  break;

  //新增資料
  case "insert_tad_themes_menu":
  insert_tad_themes_menu();
  header("location: {$_SERVER['PHP_SELF']}#{$menuid}");
  break;


  //刪除資料
  case "delete_tad_themes_menu":
  delete_tad_themes_menu($menuid);
  header("location: {$_SERVER['PHP_SELF']}");
  break;


  //新增項目
  case "add_tad_themes_menu";
  $main=tad_themes_menu_form($of_level,$menuid,"die");
  break;

  //儲存排序
  case "save_sort":
  save_sort();
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  //修改項目
  case "modify_tad_themes_menu":
  $main=tad_themes_menu_form($of_level,$menuid,"die");
  break;


  //修改項目
  case "import":
  auto_import();
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  case "tad_themes_menu_status":
  tad_themes_menu_status($menuid,$status);
  header("location: {$_SERVER['PHP_SELF']}#{$menuid}");
  break;

  case "del_pic":
  del_pic($type,$menuid);
  header("location: {$_SERVER['PHP_SELF']}#{$menuid}");
  break;


  //預設動作
  default:
  //$main=mk_menu();
  $main=list_tad_themes_menu();
  break;

}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>