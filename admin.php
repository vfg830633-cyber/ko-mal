<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>静态网站后台配置生成器</title>
    <script src="data.js"></script>
    <style>
        body { font-family: sans-serif; background: #f4f6f8; margin: 0; padding: 20px; }
        .box { max-width: 800px; margin: 0 auto 20px; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; font-size: 18px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        input, textarea { width: 100%; padding: 10px; margin: 6px 0 14px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { background: #007bff; color: #fff; border: none; padding: 10px 18px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .item { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding: 10px 0; }
        .del-btn { background: #dc3545; padding: 6px 12px; font-size: 12px; }
    </style>
</head>
<body>

<div class="box">
    <h2>⚙️ 1. 引流链接与像素 ID 设置</h2>
    <label>LINE 跳转链接</label>
    <input type="text" id="lineUrl" placeholder="https://line.me">
    <label>TikTok Pixel ID（纯数字/字母ID，留空则不启用）</label>
    <input type="text" id="tiktokPixelId" placeholder="例如：C1234567890ABCDEF">
    <label>Facebook (Meta) Pixel ID（纯数字ID，留空则不启用）</label>
    <input type="text" id="fbPixelId" placeholder="例如：123456789012345">
</div>

<div class="box">
    <h2>➕ 2. 添加新女性资料</h2>
    <label>照片路径（请将照片放入 images 文件夹，此处填写文件名，如 images/3.jpg）</label>
    <input type="text" id="pPhoto" placeholder="images/3.jpg">
    <label>韩文昵称</label>
    <input type="text" id="pName" placeholder="예: 하은">
    <label>年龄</label>
    <input type="text" id="pAge" placeholder="예: 26">
    <label>所在地区</label>
    <input type="text" id="pLoc" placeholder="예: 부산 해운대">
    <label>职业</label>
    <input type="text" id="pJob" placeholder="예: 승무원">
    <label>韩文自我介绍</label>
    <textarea id="pBio" rows="2" placeholder="예: 좋은 인연 만들고 싶어요 :)"></textarea>
    <button onclick="addProfile()">添加到下方列表</button>
</div>

<div class="box">
    <h2>📋 3. 当前资料列表</h2>
    <div id="list"></div>
</div>

<div class="box" style="background:#e8f5e9;border:1px solid #06C755;">
    <h2>🚀 4. 一键生成并导出 data.js</h2>
    <p style="font-size:13px;color:#333;margin-bottom:10px;">修改完成后点击下方按钮下载最新的 <strong>data.js</strong>，上传覆盖到 GitHub 仓库即可全站生效。</p>
    <button style="background:#06C755;font-size:16px;" onclick="downloadDataJs()">下载最新 data.js 文件</button>
</div>

<script>
    let currentData = typeof SITE_DATA !== 'undefined' ? JSON.parse(JSON.stringify(SITE_DATA)) : { lineUrl: '', tiktokPixelId: '', fbPixelId: '', profiles: [] };
    document.getElementById('lineUrl').value = currentData.lineUrl;
    document.getElementById('tiktokPixelId').value = currentData.tiktokPixelId;
    document.getElementById('fbPixelId').value = currentData.fbPixelId;

    function renderList() {
        const list = document.getElementById('list');
        list.innerHTML = '';
        currentData.profiles.forEach((p, idx) => {
            list.innerHTML += `<div class="item">
                <div><strong>${p.name} (${p.age}세)</strong> · ${p.location} · 图片: ${p.photo}<br><small style="color:#666;">${p.bio}</small></div>
                <button class="del-btn" onclick="delProfile(${idx})">删除</button>
            </div>`;
        });
    }
    renderList();

    function addProfile() {
        const photo = document.getElementById('pPhoto').value.trim();
        const name = document.getElementById('pName').value.trim();
        if (!photo || !name) return alert('请至少填写照片路径和昵称');
        currentData.profiles.unshift({
            name: name,
            age: document.getElementById('pAge').value.trim() || '24',
            location: document.getElementById('pLoc').value.trim() || '서울',
            job: document.getElementById('pJob').value.trim() || '프리랜서',
            bio: document.getElementById('pBio').value.trim() || '반가워요!',
            photo: photo
        });
        renderList();
        document.getElementById('pPhoto').value = ''; document.getElementById('pName').value = ''; document.getElementById('pBio').value = '';
    }

    function delProfile(idx) {
        currentData.profiles.splice(idx, 1);
        renderList();
    }

    function downloadDataJs() {
        currentData.lineUrl = document.getElementById('lineUrl').value.trim();
        currentData.tiktokPixelId = document.getElementById('tiktokPixelId').value.trim();
        currentData.fbPixelId = document.getElementById('fbPixelId').value.trim();
        const content = "const SITE_DATA = " + JSON.stringify(currentData, null, 4) + ";";
        const blob = new Blob([content], { type: "application/javascript;charset=utf-8" });
        const a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        a.download = "data.js";
        a.click();
    }
</script>
</body>
</html>
