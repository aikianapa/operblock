<?
$start=time();
session_start();
parse_str($_SERVER["REQUEST_URI"],$tmp);
if (isset($tmp["person_id"])) {parse_str($_SERVER["REQUEST_URI"],$_SESSION["dr"]);}
$path=$_SERVER['DOCUMENT_ROOT'];
$url="http://".$_SERVER['HTTP_HOST'];
if (!is_file($url."/engine/tpl/".$_GET["form"].".php")) {$tpl="engine/tpl/page.php";} else {$tpl="engine/tpl/".$_GET["form"].".php";}
include_once("$path/engine/engine.php");



$aType='Протокол операции';
$form=getActionTypeForm($aType);
$SQL="CREATE TABLE IF NOT EXISTS `JsonData` (
  `id` varchar(255) NOT NULL,
  `json` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

UPDATE ActionPropertyType SET typeName = 'String' WHERE  actionType_id = {$aType} AND idx = 1;

";

mysql_query($SQL);


$content=phpQuery::newDocument("");
if ($_GET["mode"]!="listview") {
	$content=phpQuery::newDocument(file_get_contents($url."/".$tpl));
}

if (substr($_SERVER['REQUEST_URI'],0,10)!="/index.php") {
// JQMobile
$content["head"]->append('<link rel="stylesheet" href="/themes/operblock/operblock.min.css" />');
$content["head"]->append('<link rel="stylesheet" href="/themes/operblock/jquery.mobile.icons.min.css" />');
// Engine
$content["head"]->append('<script language="javascript" src="/engine/js/functions.js"></script>');
$content["head"]->append('<link rel="stylesheet" href="/engine/engine.css" type="text/css" />');
$content["head"]->append('<link rel="stylesheet" href="/style.css" type="text/css" />');
$content["head"]->append('<script type="text/javascript" src="/js/scripts.js"></script>');
$content["head"]->append('<script type="text/javascript" src="/js/jquery.selection.js"></script>');
}

$content=phpQuery::newDocument(engine($content));

if ($content["ul.commonGallery"]->length()) {
// PhotoSwipe
	$content["head"]->append('<script src="/engine/js/photoswipe/klass.min.js" type="text/javascript" ></script>');
	$content["head"]->append('<script src="/engine/js/photoswipe/code.photoswipe.jquery-3.0.5.min.js" type="text/javascript" ></script>');
	$content["head"]->append('<link rel="stylesheet" href="/engine/js/photoswipe/photoswipe.css" type="text/css" />');	
}

if ($content["textarea.ckeditor"]->length()) {
// CKEditor	
	$content["head"]->append(phpQuery::newDocumentFilePHP($url."/engine/editors/editor.php"));
}

$content["head"]->append('
<link rel="stylesheet" href="/js/datetimepicker/jquery.datetimepicker.css" type="text/css" />
<script src="/js/datetimepicker/jquery.datetimepicker.js" type="text/javascript" ></script>
');


//$content["#DeleteConfirm"]->remove();
if (!$content["body #DeleteConfirm]"]->length()) {
	$confirm=phpQuery::newDocument(formGetContent("admin","confirm"));
	$content["body"]->append($confirm);
}

if ($_SESSION["User"]=="Admin") {
	$admin="/forms/admin_show.php"; 
	if (!is_file($path.$admin)) { $admin="/engine/forms/admin_show.php"; }
	$content["body"]->append( phpQuery::newDocumentFilePHP($url.$admin) );
}
$content["*[data-theme]"]->attr("data-theme","a");
echo $content->htmlOuter();
mysql_close();
?>
