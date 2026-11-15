<?php
$dataFile = 'data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : ['line_url' => 'https://line.me', 'pixel_code' => '', 'profiles' => []];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>서울/경기 프리미엄 데이팅 커뮤니티</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
    <!-- 后台配置的 TikTok / FB Pixel 代码 -->
    <?php echo $data['pixel_code']; ?>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Pretendard', sans-serif; }
        body { background-color: #f8f9fa; color: #222; padding-bottom: 80px; }
        .header { background: #fff; padding: 16px 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 100; }
        .header h1 { font-size: 18px; font-weight: 700; color: #ff4b6e; }
        .header p { font-size: 12px; color: #777; margin-top: 4px; }
        .container { max-width: 600px; margin: 0 auto; padding: 15px; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06); transition: transform 0.2s; }
        .card img { width: 100%; height: 220px; object-fit: cover; display: block; }
        .card-info { padding: 12px; }
        .card-title { font-size: 16px; font-weight: 700; display: flex; justify-content: space-between; align-items: center; }
        .badge { background: #e6f7ed; color: #00b900; font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: 600; }
        .card-meta { font-size: 12px; color: #666; margin: 4px 0 8px; }
        .card-bio { font-size: 13px; color: #444; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 10px; }
        .btn-line { display: block; width: 100%; background: #06C755; color: #fff; text-align: center; text-decoration: none; padding: 10px 0; border-radius: 8px; font-size: 13px; font-weight: 700; }
        .floating-bar { position: fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 12px 20px; box-shadow: 0 -2px 10px rgba(0,0,0,0.08); display: flex; justify-content: center; z-index: 999; }
        .floating-btn { max-width: 560px; width: 100%; background: #06C755; color: #fff; text-align: center; text-decoration: none; padding: 14px; border-radius: 12px; font-size: 16px; font-weight: 700; box-shadow: 0 4px 12px rgba(6,199,85,0.3); }
    </style>
</head>
<body>

<div class="header">
    <h1>✨ 내 주변 새로운 인연 찾기</h1>
    <p>지금 바로 LINE으로 가볍게 대화를 시작해보세요</p>
</div>

<div class="container">
    <div class="grid">
        <?php if (!empty($data['profiles'])): ?>
            <?php foreach (array_reverse($data['profiles']) as $profile): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($profile['photo']); ?>" alt="Profile">
                    <div class="card-info">
                        <div class="card-title">
                            <span><?php echo htmlspecialchars($profile['name']); ?>, <?php echo htmlspecialchars($profile['age']); ?></span>
                            <span class="badge">접속중</span>
                        </div>
                        <div class="card-meta">📍 <?php echo htmlspecialchars($profile['location']); ?> · <?php echo htmlspecialchars($profile['job']); ?></div>
                        <div class="card-bio"><?php echo htmlspecialchars($profile['bio']); ?></div>
                        <a href="<?php echo htmlspecialchars($data['line_url']); ?>" target="_blank" class="btn-line" onclick="trackLead()">LINE 친구추가</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: span 2; text-align: center; color: #888; padding: 40px 0;">등록된 프로필이 없습니다. 관리자 페이지에서 추가해주세요.</p>
        <?php endif; ?>
    </div>
</div>

<div class="floating-bar">
    <a href="<?php echo htmlspecialchars($data['line_url']); ?>" target="_blank" class="floating-btn" onclick="trackLead()">💬 실시간 1:1 LINE 상담 및 매칭 연결</a>
</div>

<script>
// 广告转化追踪触发函数（兼容 TikTok 与 Meta Pixel）
function trackLead() {
    if (typeof ttq !== 'undefined') { ttq.track('Contact'); }
    if (typeof fbq !== 'undefined') { fbq('track', 'Lead'); }
}
</script>
</body>
</html>
