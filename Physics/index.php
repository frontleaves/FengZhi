<?PHP
// 开启session
session_start();
// 禁用错误报告
error_reporting(0);
// 引入设置
$cp = htmlspecialchars($_GET["cp"]);
$rep = htmlspecialchars($_GET["rep"]);
include("../config.inc.php");
include("../plugins/mysql_conn.php");
// 引入插件
include("../plugins/color.php");  // 引入主题颜色修改
include("../plugins/img.php"); // 图片库自动判断
$listOnL = 5;
$listOn = 501;
// 导入数据库
$SQL = mysqli_query($conn,"SELECT * FROM equation_inorganic");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="full-screen" content="yes"><!--UC强制全屏-->
    <meta name="browsermode" content="application"><!--UC应用模式-->
    <meta name="x5-fullscreen" content="true"><!--QQ强制全屏-->
    <meta name="x5-page-mode" content="app"><!--QQ应用模式-->
    <!-- QQ标签识别 -->
    <meta itemprop="name" content="<?php echo $setting["Info"]["name"] ?>">
    <meta name="description" itemprop="description" content="<?php echo $setting["INFO"]["subname"] ?>">
    <meta itemprop="image" content="<?php echo $setting["Web"]["Icon"] ?>">
    <!-- 主要 -->
    <title><?PHP echo $setting["Info"]["name"] ?> &mdash; <?PHP echo $setting["Info"]["subname"] ?></title>
    <link rel="shortcut icon" href="<?php echo $setting["Web"]["Icon"] ?>" type="image/x-icon">
    <!-- MDUI CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
        integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
        crossorigin="anonymous"
    />
</head>
<body class="mdui-theme-primary-<?php echo check_night_time_primary() ?> mdui-theme-accent-<?php echo check_night_time_accent() ?> padding-top mdui-appbar-with-toolbar mdui-drawer-body-left <?PHP echo check_night_black() ?>">
<!-- 顶部TAB -->
<?PHP include_once('../header.php'); ?>
<!-- 菜单 -->
<?PHP include_once('../menu.php'); ?>
<!-- 正文 -->
<div class="mdui-container">
    <div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-y-1">
        <div class="mdui-typo mdui-center">
            <h2><?PHP echo $setting["Info"]["name"] ?> &mdash; 物理 | 目录</h2>
        </div>
    </div>
</div>
<div class="mdui-container">
    <div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-y-1">
        <div class="mdui-typo mdui-center">
            <p>如果较难查找可以按下 "CTrl+F" 以打开查询功能</p>
        </div>
    </div>
</div>
<div class="mdui-container">
    <div class="mdui-table-fluid mdui-m-y-4">
        <table class="mdui-table mdui-table-hoverable">
            <thead>
                <tr>
                    <th>章节</th>
                    <th>名字</th>
                    <th>进入</th>
                </tr>
            </thead>
            <tbody>
    <?PHP
    $handle=opendir('./chapter');
    while($dir = readdir($handle))
    {
        ?>
        <tr>
            <?PHP
            //过滤当前文件夹和父文件
            if($dir == '.' || $dir == '..' )
            {
                continue;
            }
            $str = str_replace('.md','',$dir);
            ?>
            <td><strong><?PHP echo mb_substr($str,0,5); ?></strong></td>
            <td><?PHP echo mb_substr($str,6); ?></td>
            <td><a href="./mathjax.php?cp=<?PHP echo $str ?>"><button class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-theme-accent mdui-ripple">查阅</button></a></td>
        </tr>
    <?PHP
    }
    ?>
            </tbody>
        </table>
    </div>
</div>
<!-- 页脚版权内容 -->
<?PHP include("../footer.html") ?>
</body>
<!-- MDUI JavaScript -->
<script
    src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
    integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
    crossorigin="anonymous"
></script>
</html>
<?PHP
mysqli_free_result($SQL);
mysqli_close($conn);
?>