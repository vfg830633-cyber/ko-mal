<!DOCTYPE html>
<html lang="es-CL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>¡Regalo Exclusivo! Descarga la App y recibe 1 Caja de Papel Tissue Gratis</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }
        body { background-color: #fff5f5; color: #333; padding-bottom: 90px; }
        
        /* 顶部滚动播报栏 */
        .notice-bar { background: #ff2e4d; color: #fff; font-size: 12px; padding: 8px 15px; text-align: center; font-weight: 600; }
        
        /* 主容器 */
        .container { max-width: 540px; margin: 0 auto; padding: 16px; }
        
        /* 首屏福利卡片 */
        .hero-card { background: linear-gradient(180deg, #ffffff 0%, #fff0f0 100%); border-radius: 18px; padding: 24px 18px; text-align: center; box-shadow: 0 8px 24px rgba(255, 46, 77, 0.12); border: 2px solid #ffd6dc; margin-bottom: 18px; }
        .tag { display: inline-block; background: #ff2e4d; color: #fff; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 20px; margin-bottom: 10px; }
        .hero-title { font-size: 23px; font-weight: 800; color: #1a1a1a; line-height: 1.3; margin-bottom: 8px; }
        .hero-title span { color: #ff2e4d; }
        .hero-sub { font-size: 14px; color: #666; margin-bottom: 18px; }
        
        /* 礼品展示区 */
        .gift-box { background: #fff; border-radius: 14px; padding: 15px; margin-bottom: 18px; border: 1px dashed #ff8598; position: relative; }
        .gift-img { width: 100%; max-height: 220px; object-fit: contain; border-radius: 10px; margin-bottom: 10px; background: #f9f9f9; }
        .gift-name { font-size: 16px; font-weight: 700; color: #222; }
        .gift-price { font-size: 13px; color: #888; margin-top: 4px; }
        .gift-price strong { color: #ff2e4d; font-size: 18px; }
        
        /* 剩余名额进度条 */
        .stock-wrap { margin-bottom: 18px; text-align: left; }
        .stock-text { display: flex; justify-content: space-between; font-size: 12px; color: #555; margin-bottom: 6px; font-weight: 600; }
        .progress-bg { width: 100%; height: 10px; background: #ffe0e5; border-radius: 10px; overflow: hidden; }
        .progress-fill { width: 84%; height: 100%; background: linear-gradient(90deg, #ff6b81, #ff2e4d); border-radius: 10px; }
        
        /* 主行动按钮 */
        .btn-download { display: block; width: 100%; background: linear-gradient(90deg, #ff4757, #ff1e38); color: #fff; text-align: center; text-decoration: none; padding: 16px; border-radius: 50px; font-size: 17px; font-weight: 800; box-shadow: 0 6px 20px rgba(255, 30, 56, 0.35); animation: pulse 1.8s infinite; cursor: pointer; border: none; }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }
        .btn-tip { font-size: 12px; color: #888; margin-top: 10px; }

        /* 领取步骤卡片 */
        .section-card { background: #fff; border-radius: 16px; padding: 20px 18px; margin-bottom: 18px; box-shadow: 0 4px 14px rgba(0,0,0,0.04); }
        .section-title { font-size: 17px; font-weight: 700; color: #222; margin-bottom: 16px; text-align: center; }
        .steps { display: flex; justify-content: space-between; gap: 10px; }
        .step-item { flex: 1; background: #fff8f9; padding: 14px 8px; border-radius: 12px; text-align: center; border: 1px solid #ffebee; }
        .step-num { width: 26px; height: 26px; background: #ff2e4d; color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; margin-bottom: 8px; }
        .step-title { font-size: 13px; font-weight: 700; color: #222; margin-bottom: 4px; }
        .step-desc { font-size: 11px; color: #666; line-height: 1.4; }

        /* 活动规则 */
        .rules-list { font-size: 12px; color: #666; line-height: 1.7; padding-left: 16px; }
        .rules-list li { margin-bottom: 6px; }

        /* 底部页脚合规信息 */
        .footer { text-align: center; font-size: 11px; color: #999; padding: 10px 20px; line-height: 1.6; }

        /* 底部悬浮栏 */
        .floating-bar { position: fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 10px 16px; box-shadow: 0 -4px 16px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: space-between; z-index: 999; max-width: 540px; margin: 0 auto; }
        .float-info { font-size: 13px; font-weight: 700; color: #222; }
        .float-info span { display: block; font-size: 11px; color: #ff2e4d; font-weight: 500; }
        .float-btn { background: #ff2e4d; color: #fff; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-size: 13px; font-weight: 700; }
    </style>
</head>
<body>

<div class="notice-bar" id="liveNotice">🎉 ¡Recién! Usuario +56 9 **** 9214 reclamó su caja de papel tissue gratis</div>

<div class="container">
    <!-- 首屏核心区 -->
    <div class="hero-card">
        <div class="tag">🔥 PROMOCIÓN EXCLUSIVA NUEVOS USUARIOS</div>
        <h1 class="hero-title">Descarga nuestra App<br>y lleva <span>1 Caja de Papel Tissue GRATIS</span></h1>
        <p class="hero-sub">Sin compras obligatorias · Envío gratis a todo Chile · Stock limitado</p>

        <div class="gift-box">
            <!-- Reemplaza el src con la foto real de tu caja de papel tissue -->
            <img src="https://unsplash.com" alt="Caja de Papel Tissue 24 Paquetes" class="gift-img">
            <div class="gift-name">Caja de Papel Tissue Suave Doble Hoja (24 Paquetes)</div>
            <div class="gift-price">Precio normal: <s>$14.990 CLP</s> &nbsp; Hoy para ti: <strong>$0 GRATIS</strong></div>
        </div>

        <div class="stock-wrap">
            <div class="stock-text">
                <span>Stock promocional reclamado: 84%</span>
                <span style="color:#ff2e4d;">¡Quedan solo 32 cajas!</span>
            </div>
            <div class="progress-bg">
                <div class="progress-fill"></div>
            </div>
        </div>

        <button class="btn-download" onclick="handleDownload()">DESCARGAR APP Y RECLAMAR GRATIS</button>
        <div class="btn-tip">Disponible para iOS y Android · Descarga 100% segura y oficial</div>
    </div>

    <!-- 三步领取流程 -->
    <div class="section-card">
        <div class="section-title">¿Cómo recibir tu caja gratis en 3 simples pasos?</div>
        <div class="steps">
            <div class="step-item">
                <div class="step-num">1</div>
                <div class="step-title">Descarga</div>
                <div class="step-desc">Pulsa el botón e instala la App oficial</div>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-title">Regístrate</div>
                <div class="step-desc">Abre la App y crea tu cuenta nueva</div>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-title">Pide tu envío</div>
                <div class="step-desc">Ingresa tu dirección en Chile y listo</div>
            </div>
        </div>
    </div>

    <!-- 活动规则说明 -->
    <div class="section-card">
        <div class="section-title">Términos y Condiciones de la Promoción</div>
        <ul class="rules-list">
            <li><strong>Participantes:</strong> Válido únicamente para nuevos usuarios que descarguen y registren su cuenta por primera vez (1 caja por persona/dispositivo).</li>
            <li><strong>Despacho a domicilio:</strong> Una vez confirmada tu dirección en la App, el envío se realizará en un plazo máximo de 48 horas hábiles a cualquier región de Chile.</li>
            <li><strong>Uso justo:</strong> Nos reservamos el derecho de cancelar solicitudes duplicadas o realizadas mediante cuentas falsas.</li>
            <li><strong>Soporte al cliente:</strong> Si tienes dudas con tu despacho, contáctanos directamente en la sección "Ayuda" dentro de la App.</li>
        </ul>
    </div>

    <div class="footer">
        <p>Esta promoción es organizada por nuestro equipo oficial y no está patrocinada ni administrada por Facebook o TikTok.</p>
        <p>© 2026 Todos los derechos reservados · Política de Privacidad · Términos de Uso</p>
    </div>
</div>

<!-- 底部悬浮条 -->
<div class="floating-bar">
    <div class="float-info">
        Caja de 24 Paquetes ¡GRATIS!
        <span>⏰ Últimas unidades disponibles hoy</span>
    </div>
    <a href="javascript:void(0)" class="float-btn" onclick="handleDownload()">Reclamar ahora</a>
</div>

<script>
    // ==========================================
    // 【CONFIGURACIÓN】Pega aquí tus enlaces de descarga y Pixel IDs
    // ==========================================
    const CONFIG = {
        iosDownloadUrl: "https://apple.com",      // Enlace de App Store (iOS)
        androidDownloadUrl: "https://google.com", // Enlace de Google Play o APK (Android)
        tiktokPixelId: "",                              // Tu TikTok Pixel ID
        fbPixelId: ""                                   // Tu Facebook (Meta) Pixel ID
    };

    // Cargar TikTok Pixel automáticamente
    if (CONFIG.tiktokPixelId) {
        !function (w, d, t) {
