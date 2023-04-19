<?php
// 获取分类，数量，返回类型
$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'pc';
$num = !empty($_GET['num']) ? $_GET['num'] : 1;
$num = $num > 100 ? 100 : $num;
$type = !($num > 1) ? $_GET['type'] : 'json';
$urls = [];

// 是否为空判断
if (!file_exists('' . $sort . '.txt')) {
    die('sort为空或文件不存在');
}

// 获取链接数组
$links = file_get_contents('' . $sort . '.txt');
$links = explode(PHP_EOL, $links);
$links = array_diff($links, ['']);
$links = array_values($links);

// 循环随机链接
$i = 0;
do {
    $url = $links[array_rand($links)];
    array_push($urls, $url);
    ++$i;
} while ($i < $num);

// 返回值
switch ($type) {
    case 'json':
        header('Content-type:text/json');
        die(json_encode(['pics' => $urls], JSON_PRETTY_PRINT));

    default:
        header('Location: ' . $url);
}
