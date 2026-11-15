<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>서울/경기 프리미엄 데이팅 커뮤니티</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
    <script src="data.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Pretendard', sans-serif; }
        body { background-color: #f8f9fa; color: #222; padding-bottom: 85px; }
        .header { background: #fff; padding: 16px 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 100; }
        .header h1 { font-size: 18px; font-weight: 700; color: #ff4b6e; }
        .header p { font-size: 12px; color: #777; margin-top: 4px; }
        .container { max-width: 600px; margin: 0 auto; padding: 15px; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .card img { width: 100%; height: 220px; object-fit: cover; display: block; background: #eee; }
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
    <div class="grid" id="profileGrid"></div>
</div>

<div class="floating-bar">
    <a id="floatingLineBtn" href="#" target="_blank" class="floating-btn" onclick="trackLead()">💬 실시간 1:1 LINE 상담 및 매칭 연결</a>
</div>

<script>
    // 1. 动态加载广告 Pixel
    if (SITE_DATA.tiktokPixelId) {
        !function (w, d, t) {
            w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://tiktok.com";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
            ttq.load(SITE_DATA.tiktokPixelId); ttq.page();
        }(window, document, 'ttq');
    }
    if (SITE_DATA.fbPixelId) {
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://facebook.net');
        fbq('init', SITE_DATA.fbPixelId); fbq('track', 'PageView');
    }

    // 2. 渲染资料卡片
    document.getElementById('floatingLineBtn').href = SITE_DATA.lineUrl;
    const grid = document.getElementById('profileGrid');
    SITE_DATA.profiles.forEach(p => {
        grid.innerHTML += `
            <div class="card">
                <img src="${p.photo}" alt="${p.name}" loading="lazy">
                <div class="card-info">
                    <div class="card-title">
                        <span>${p.name}, ${p.age}</span>
                        <span class="badge">접속중</span>
                    </div>
                    <div class="card-meta">📍 ${p.location} · ${p.job}</div>
                    <div class="card-bio">${p.bio}</div>
                    <a href="${SITE_DATA.lineUrl}" target="_blank" class="btn-line" onclick="trackLead()">LINE 친구추가</a>
                </div>
            </div>
        `;
    });

    // 3. 点击转化统计
    function trackLead() {
        if (typeof ttq !== 'undefined') ttq.track('Contact');
        if (typeof fbq !== 'undefined') fbq('track', 'Lead');
    }
</script>
</body>
</html>
