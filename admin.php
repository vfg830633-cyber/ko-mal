<?php
session_start();
$adminPass = '123456'; // 请修改此后台登录密码
$dataFile = 'data.json';

if (!is_dir('uploads')) { mkdir('uploads', 0755, true); }
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : ['line_url' => '', 'pixel_code' => '', 'profiles' => []];

// 登录验证
if (isset($_POST['login_pass'])) {
    if ($_POST['login_pass'] === $adminPass) { $_SESSION['logged_in'] = true; }
    else { $error = "密码错误"; }
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: admin.php"); exit; }

if (empty($_SESSION['logged_in'])):
?>
<!DOCTYPE html>
<html lang="zh">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>后台登录</title></head>
<body style="font-family:sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f2f5;">
    <form method="post" style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.1);width:300px;">
        <h3 style="margin-bottom:15px;">交友网站后台登录</h3>
        <?php if(!empty($error)) echo "<p style='color:red;font-size:13px;'>$error</p>"; ?>
        <input type="password" name="login_pass" placeholder="请输入后台密码" required style="width:100%;padding:10px;margin-bottom:15px;border:1px solid #ddd;border-radius:5px;box-sizing:border-box;">
        <button type="submit" style="width:100%;padding:10px;background:#06C755;color:#fff;border:none;border-radius:5px;font-weight:bold;cursor:pointer;">登录</button>
    </form>
</body>
</html>
<?php exit; endif;

// 保存全局设置（LINE链接 & Pixel代码）
if (isset($_POST['save_settings'])) {
    $data['line_url'] = $_POST['line_url'];
    $data['pixel_code'] = $_POST['pixel_code'];
    file_put_contents($dataFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    $msg = "全局设置已保存！";
}

// 添加女性资料
if (isset($_POST['add_profile']) && isset($_FILES['photo'])) {
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $fileName = 'uploads/' . time() . '_' . rand(100,999) . '.' . $ext;
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $fileName)) {
        $data['profiles'][] = [
            'id' => uniqid(),
            'name' => $_POST['name'],
            'age' => $_POST['age'],
            'location' => $_POST['location'],
            'job' => $_POST['job'],
            'bio' => $_POST['bio'],
            'photo' => $fileName
        ];
        file_put_contents($dataFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $msg = "资料发布成功！";
    }
}

// 删除资料
if (isset($_GET['delete'])) {
    $delId = $_GET['delete'];
    foreach ($data['profiles'] as $k => $v) {
        if ($v['id'] === $delId) {
            if (file_exists($v['photo'])) unlink($v['photo']);
            unset($data['profiles'][$k]);
        }
    }
    $data['profiles'] = array_values($data['profiles']);
    file_put_contents($dataFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    header("Location: admin.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>交友网站管理后台</title>
    <style>
        body { font-family: sans-serif; background: #f4f6f8; margin: 0; padding: 20px; }
        .box { max-width: 800px; margin: 0 auto 20px; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; font-size: 18px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        input, textarea { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { background: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .item { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0; }
        .item img { width: 50px; height: 50px; object-fit: cover; border-radius: 6px; margin-right: 12px; }
        .del-btn { background: #dc3545; color: #fff; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>

<div class="box">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2>⚙️ 1. 引流与广告设置</h2>
        <a href="?logout=1" style="color:#666;font-size:13px;">退出登录</a>
    </div>
    <?php if(!empty($msg)) echo "<p style='color:green;font-weight:bold;'>$msg</p>"; ?>
    <form method="post">
        <label>LINE 跳转链接（例如：https://line.me）</label>
        <input type="text" name="line_url" value="<?php echo htmlspecialchars($data['line_url']); ?>" required>
        
        <label>TikTok / Facebook 像素统计代码（直接粘贴官方给的 &lt;script&gt; 代码）</label>
        <textarea name="pixel_code" rows="4" placeholder="粘贴 TikTok Pixel 或 Meta Pixel 代码..."><?php echo htmlspecialchars($data['pixel_code']); ?></textarea>
        
        <button type="submit" name="save_settings" style="background:#06C755;">保存全局设置</button>
    </form>
</div>

<div class="box">
    <h2>➕ 2. 发布新女性资料（建议填写韩文）</h2>
    <form method="post" enctype="multipart/form-data">
        <label>上传照片</label>
        <input type="file" name="photo" accept="image/*" required>
        
        <label>韩文昵称（例如：지민, 수진）</label>
        <input type="text" name="name" placeholder="예: 지민" required>
        
        <label>年龄</label>
        <input type="number" name="age" placeholder="예: 25" required>
        
        <label>所在地区（例如：서울 강남, 부산）</label>
        <input type="text" name="location" placeholder="예: 서울 강남" required>
        
        <label>职业（例如：필라테스 강사, 디자이너）</label>
        <input type="text" name="job" placeholder="예: 프리랜서" required>
        
        <label>韩文个性签名 / 自我介绍</label>
        <textarea name="bio" rows="2" placeholder="예: 주말에 같이 카페 가고 편하게 대화할 친구 찾아요 :)" required></textarea>
        
        <button type="submit" name="add_profile">立即发布到首页</button>
    </form>
</div>

<div class="box">
    <h2>📋 3. 已发布资料列表</h2>
    <?php foreach (array_reverse($data['profiles']) as $p): ?>
        <div class="item">
            <div style="display:flex;align-items:center;">
                <img src="<?php echo htmlspecialchars($p['photo']); ?>">
                <div>
                    <strong><?php echo htmlspecialchars($p['name']); ?> (<?php echo htmlspecialchars($p['age']); ?>세)</strong> - <?php echo htmlspecialchars($p['location']); ?><br>
                    <small style="color:#666;"><?php echo htmlspecialchars($p['bio']); ?></small>
                </div>
            </div>
            <a href="?delete=<?php echo $p['id']; ?>" class="del-btn" onclick="return confirm('确定删除吗？')">删除</a>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
