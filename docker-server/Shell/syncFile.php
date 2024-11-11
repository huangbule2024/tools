<?php
/**
 * 复制文件工具+deploy
 * @author hbl
 */
$srcFile = 'C:\phpstudy_pro\WWW\saas-srv-api\saas-srv\saas-file-srv\LICENSE';
$createFolderOrNot = false;
$dirFolder = [
    'saas-api',
    'saas-srv'
];
$baseurl = substr(__DIR__, 0, -strlen(DIRECTORY_SEPARATOR . 'docker-server' . DIRECTORY_SEPARATOR . 'Shell'));

$srcFileSuffix = str_replace([
    $baseurl . DIRECTORY_SEPARATOR . "saas-api",
    $baseurl . DIRECTORY_SEPARATOR . "saas-srv",
], "", $srcFile);
$arr = explode(DIRECTORY_SEPARATOR, $srcFileSuffix);
array_shift($arr);
array_shift($arr);
$srcFileSuffix = implode(DIRECTORY_SEPARATOR, $arr);

foreach ($dirFolder as $folder) {
    foreach (scandir($baseurl . DIRECTORY_SEPARATOR . $folder) as $subFolder) {
        if ($subFolder == '.' || $subFolder == '..' || $subFolder == '.DS_Store') continue;
        $originPath = $baseurl . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $subFolder . DIRECTORY_SEPARATOR . $srcFileSuffix;
        if (!file_exists(dirname($originPath)) && $createFolderOrNot) {
            mkdir(dirname($originPath), 0777, true);
        }
        if (file_exists(dirname($originPath))) {
            copy($srcFile, $originPath);
            var_dump("copy to " . $originPath);
        }
    }
}


