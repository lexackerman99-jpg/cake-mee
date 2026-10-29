<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Cake & Mee Mom Sitty</title>
<link rel="icon" href="/logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script>document.documentElement.classList.add('js')</script>
<style>
:root{
  --pink:#e4087f;--pink-d:#bf0668;--pink-soft:#fff1f8;--pink-tint:#fde0ee;
  --ink:#1a1a1f;--mut:#6d6670;--line:#f0e2ea;--green:#0e9f5a;--wa:#25d366;
  --ease:cubic-bezier(.22,1,.36,1);
}
*{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:90px}
body{min-height:100vh;margin:0;display:flex;flex-direction:column;font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:var(--ink);background:#fff;line-height:1.6;-webkit-font-smoothing:antialiased}
main{flex:1}
a{color:var(--pink)}
img{max-width:100%}
.i{width:1.15em;height:1.15em;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex:none}

/* ---------- keyframes ---------- */
@keyframes fadeUp{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:none}}
@keyframes fadeLeft{from{opacity:0;transform:translateX(50px) scale(.96)}to{opacity:1;transform:none}}
@keyframes floaty{50%{transform:translateY(-12px)}}
@keyframes bob{50%{transform:translateY(-14px) rotate(6deg)}}
@keyframes drift{to{transform:translate(40px,30px) scale(1.12)}}
@keyframes nudge{50%{transform:translateY(4px)}}
@keyframes bump{0%{transform:scale(1)}30%{transform:scale(1.6)}60%{transform:scale(.9)}100%{transform:scale(1)}}
@keyframes shine{60%,100%{transform:translateX(100%)}}
@keyframes toastIn{from{opacity:0;transform:translateX(40px) scale(.96)}to{opacity:1;transform:none}}
@keyframes toastOut{to{opacity:0;transform:translateX(40px)}}
.fx{animation:fadeUp .85s var(--ease) both;animation-delay:var(--d,0s)}
.fx2{animation:fadeLeft .95s var(--ease) both;animation-delay:var(--d,0s)}
.js .reveal{opacity:0;transform:translateY(30px);transition:opacity .8s var(--ease),transform .8s var(--ease);transition-delay:var(--d,0ms)}
.js .reveal.in{opacity:1;transform:none}
.js .card.reveal.in:hover{transform:translateY(-8px)}
.js .step.reveal.in:hover{transform:translateY(-6px)}

/* ---------- header ---------- */
.top{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.9);backdrop-filter:saturate(1.4) blur(12px);-webkit-backdrop-filter:saturate(1.4) blur(12px);border-bottom:1px solid transparent;transition:box-shadow .3s,border-color .3s}
.top.scrolled{box-shadow:0 6px 24px rgba(228,8,127,.10);border-color:var(--line)}
.bar{max-width:1160px;margin:0 auto;padding:0 24px;height:76px;display:flex;align-items:center;gap:24px}
.brand{display:flex;align-items:center;gap:12px;text-decoration:none}
.brand img{width:54px;height:54px;border-radius:50%;box-shadow:0 0 0 3px var(--pink-tint);transition:transform .5s var(--ease)}
.brand:hover img{transform:rotate(-10deg) scale(1.07)}
.brand b{display:block;color:var(--pink);font-weight:800;font-size:1.3rem;line-height:1.1;letter-spacing:-.02em}
.brand small{color:var(--pink);opacity:.8;font-size:.85rem;font-weight:500}
.menu{display:flex;align-items:center;gap:26px;margin:0 auto}
.menu a,.menu .lnk{color:var(--ink);text-decoration:none;font:500 .97rem 'Plus Jakarta Sans',sans-serif;position:relative;padding:6px 0;background:none;border:0;cursor:pointer;display:inline-flex;align-items:center;gap:7px}
.menu a::after,.menu .lnk::after{content:"";position:absolute;left:0;right:0;bottom:-2px;height:2px;background:var(--pink);transform:scaleX(0);transform-origin:left;transition:transform .35s var(--ease)}
.menu a:hover::after,.menu a.on::after,.menu .lnk:hover::after{transform:scaleX(1)}
.menu a.on,.menu a:hover,.menu .lnk:hover{color:var(--pink)}
.menu a.mut{color:var(--mut)}
.menu a.tel{color:var(--green)}
.menu a.tel::after{background:var(--green)}
.menu .admin-link{color:var(--pink);font-weight:700}
.menu .who{color:var(--mut);font-size:.92rem;max-width:130px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.menu form{margin:0}
.cart{display:inline-flex;align-items:center;gap:9px;background:var(--pink);color:#fff!important;text-decoration:none;font-weight:700;padding:11px 20px;border-radius:999px;box-shadow:0 8px 20px rgba(228,8,127,.28);transition:transform .25s var(--ease),box-shadow .25s,background .25s}
.cart:hover{transform:translateY(-2px);box-shadow:0 12px 26px rgba(228,8,127,.36);background:var(--pink-d)}
.cart .n{background:#fff;color:var(--pink);border-radius:999px;min-width:24px;height:24px;display:grid;place-items:center;font-size:.8rem;font-weight:800;padding:0 6px}
.cart .n.bump{animation:bump .7s var(--ease) .3s}
.burger{display:none;width:44px;height:44px;border:0;border-radius:12px;background:none;cursor:pointer;color:var(--ink)}
.burger span,.burger span::before,.burger span::after{display:block;width:22px;height:2px;background:currentColor;border-radius:2px;position:relative;transition:.3s}
.burger span::before,.burger span::after{content:"";position:absolute;left:0}
.burger span::before{top:-7px}
.burger span::after{top:7px}
.top.open .burger span{background:transparent}
.top.open .burger span::before{top:0;transform:rotate(45deg)}
.top.open .burger span::after{top:0;transform:rotate(-45deg)}

.toast{position:fixed;top:92px;right:20px;z-index:60;background:#fff;border-left:5px solid var(--green);box-shadow:0 14px 40px rgba(0,0,0,.16);padding:14px 18px;border-radius:14px;display:flex;gap:10px;align-items:center;max-width:min(360px,calc(100vw - 40px));font-weight:500;font-size:.93rem;animation:toastIn .6s var(--ease) both}
.toast.cart-warning-toast{top:154px;border-left-color:#d29b00;color:#765500}
.toast.out{animation:toastOut .5s ease forwards}

/* ---------- hero ---------- */
.hero{position:relative;overflow:hidden;background:linear-gradient(180deg,#fff 0%,var(--pink-soft) 65%,#fff 100%)}
.hero::before,.hero::after{content:"";position:absolute;border-radius:50%;filter:blur(60px);opacity:.55;z-index:0;animation:drift 14s ease-in-out infinite alternate}
.hero::before{width:420px;height:420px;background:#ffc9e3;top:-120px;right:-80px}
.hero::after{width:320px;height:320px;background:#ffe9a8;bottom:-120px;left:-80px;animation-delay:-6s}
.hero-in{position:relative;z-index:1;max-width:1160px;margin:0 auto;padding:64px 24px 48px;display:grid;grid-template-columns:1.1fr .9fr;gap:48px;align-items:center}
.hero h1{font-size:clamp(2.2rem,4.8vw,3.7rem);line-height:1.08;font-weight:800;letter-spacing:-.035em;margin:0 0 22px;text-wrap:balance}
.hl{color:var(--pink)}
.lead{font-size:1.1rem;color:#4a444d;margin:0 0 26px;max-width:580px}
.lead b{color:var(--ink);font-weight:700}
.info{display:flex;align-items:center;gap:14px;background:#fff;border:1px solid var(--line);border-radius:20px;padding:14px 18px;box-shadow:0 10px 30px rgba(228,8,127,.07);margin-bottom:28px;max-width:600px}
.info img{width:52px;height:52px;border-radius:50%;flex:none}
.info>div{min-width:0}
.info i{display:block;color:var(--mut);font-size:.83rem}
.info strong{display:block;font-size:1rem}
.info .wa{margin-left:auto;white-space:nowrap;background:#e8f8ef;color:#0b7a45;border:1px solid #bfeccf;border-radius:999px;padding:8px 14px;font-weight:700;font-size:.85rem;text-decoration:none;transition:.25s}
.info .wa:hover{background:var(--wa);color:#fff;border-color:var(--wa)}
.cta{display:inline-flex;align-items:center;gap:10px;background:var(--pink);color:#fff;text-decoration:none;font-weight:700;padding:16px 28px;border-radius:999px;box-shadow:0 12px 28px rgba(228,8,127,.32);transition:transform .25s var(--ease),box-shadow .25s,background .25s}
.cta:hover{transform:translateY(-3px);background:var(--pink-d);box-shadow:0 18px 34px rgba(228,8,127,.4)}
.cta .i{animation:nudge 1.6s ease-in-out infinite}
.visual{position:relative;border-radius:30px;aspect-ratio:4/3.4;background:#fff;box-shadow:0 24px 60px rgba(228,8,127,.2);animation:floaty 6s ease-in-out infinite}
.visual .ph{position:absolute;inset:6px;border-radius:26px;overflow:hidden;background:linear-gradient(145deg,#ff8fc2,#e4087f 55%,#ff6aa9)}
.visual .ph img{width:100%;height:100%;object-fit:cover;display:block}
.hero-placeholder{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;gap:12px;padding:20px}
.hero-placeholder span{width:17%;aspect-ratio:1;border:8px solid rgba(255,255,255,.82);border-radius:50%;background:radial-gradient(circle,#fff7fb 0 28%,#f6b6d2 29% 45%,#fff7fb 46% 58%,#d985ad 59% 100%);box-shadow:0 12px 26px rgba(80,0,40,.22)}
.hero-placeholder span:nth-child(2),.hero-placeholder span:nth-child(4){width:21%}
.hero-placeholder span:nth-child(3){width:27%}
.visual .cap{position:absolute;left:6px;right:6px;bottom:6px;padding:46px 22px 20px;border-radius:0 0 26px 26px;background:linear-gradient(transparent,rgba(30,0,16,.72));color:#fff;z-index:2}
.cap small{display:block;letter-spacing:.12em;font-size:.72rem;font-weight:700;color:#ffc3e0;text-transform:uppercase}
.cap span{font-weight:600}
.float{position:absolute;font-size:4.2rem;line-height:1;filter:drop-shadow(0 10px 14px rgba(0,0,0,.25));animation:bob 5s ease-in-out infinite}
.float:nth-child(1){top:10%;left:10%}
.float:nth-child(2){top:14%;right:12%;font-size:5.4rem;animation-delay:-1.2s}
.float:nth-child(3){top:38%;left:32%;font-size:6.2rem;animation-delay:-2.4s}
.float:nth-child(4){top:44%;right:8%;animation-delay:-3.2s}
.float:nth-child(5){top:52%;left:6%;font-size:3.4rem;animation-delay:-.6s}

.feats{position:relative;z-index:1;max-width:1160px;margin:0 auto;padding:0 24px}
.feats ul{list-style:none;margin:0;padding:26px 0 30px;border-top:1px solid var(--line);display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.feats li{display:flex;gap:14px;align-items:center}
.feats .ic{flex:none;width:46px;height:46px;border-radius:14px;background:#fff;color:var(--pink);display:grid;place-items:center;box-shadow:0 6px 16px rgba(228,8,127,.1);transition:.35s var(--ease)}
.feats li:hover .ic{background:var(--pink);color:#fff;transform:rotate(-8deg) scale(1.1)}
.feats b{display:block;font-size:.98rem}
.feats span.s{color:var(--mut);font-size:.86rem}

/* ---------- sections ---------- */
.sec{max-width:1160px;margin:0 auto;padding:64px 24px 10px}
.eyebrow{display:inline-block;background:var(--pink-soft);color:var(--pink);font-weight:700;font-size:.78rem;letter-spacing:.1em;text-transform:uppercase;padding:6px 14px;border-radius:999px;margin-bottom:12px}
.sec h2.t{font-size:clamp(1.8rem,3.4vw,2.6rem);font-weight:800;letter-spacing:-.03em;margin:0 0 10px;line-height:1.15}
.sec .sub{color:var(--mut);max-width:620px;margin:0 0 24px}
.promo{display:flex;gap:12px;align-items:center;background:linear-gradient(90deg,#fff7d6,#fff1bd);border:1.5px dashed #f2c200;padding:14px 20px;border-radius:16px;font-weight:500;margin-bottom:20px;position:relative;overflow:hidden}
.promo::after{content:"";position:absolute;inset:0;background:linear-gradient(100deg,transparent 30%,rgba(255,255,255,.7) 50%,transparent 70%);transform:translateX(-100%);animation:shine 4s ease-in-out infinite;pointer-events:none}
.promo a{font-weight:700}
.chips{display:flex;gap:10px;overflow-x:auto;position:sticky;top:76px;z-index:20;background:rgba(255,255,255,.92);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);padding:12px 0;scrollbar-width:none}
.chips::-webkit-scrollbar{display:none}
.chips a{flex:none;text-decoration:none;color:var(--ink);background:#fff;border:1.5px solid var(--line);padding:8px 18px;border-radius:999px;font-weight:600;font-size:.9rem;transition:.25s var(--ease)}
.chips a:hover{border-color:var(--pink);color:var(--pink);transform:translateY(-2px)}
.chips a.on{background:var(--pink);border-color:var(--pink);color:#fff;box-shadow:0 8px 18px rgba(228,8,127,.28)}
.cat{display:flex;align-items:center;gap:10px;font-size:1.35rem;font-weight:800;margin:34px 0 16px;scroll-margin-top:150px}
.cat::after{content:"";flex:1;height:2px;background:linear-gradient(90deg,var(--line),transparent)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px}
.card{background:#fff;border:1px solid var(--line);border-radius:24px;overflow:hidden;display:flex;flex-direction:column;transition:transform .4s var(--ease),box-shadow .4s var(--ease),border-color .3s}
.card:hover{transform:translateY(-8px);box-shadow:0 22px 44px rgba(228,8,127,.16);border-color:var(--pink-tint)}
.thumb{height:132px;display:grid;place-items:center;font-size:3.6rem;position:relative;background:linear-gradient(135deg,var(--c1,#ffe3f0),var(--c2,#ffb8d9));overflow:hidden}
.thumb .em{display:block;line-height:1;transition:transform .5s var(--ease);filter:drop-shadow(0 8px 10px rgba(0,0,0,.18))}
.card:hover .thumb .em{transform:scale(1.25) rotate(-8deg)}
.thumb::after{content:"";position:absolute;inset:0;background:linear-gradient(100deg,transparent 35%,rgba(255,255,255,.55) 50%,transparent 65%);transform:translateX(-120%);transition:transform .8s var(--ease)}
.card:hover .thumb::after{transform:translateX(120%)}
.thumb.ph{height:auto;aspect-ratio:1/1;display:block;background:#f6e9ef}
.thumb.ph img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .8s var(--ease)}
.card:hover .thumb.ph img{transform:scale(1.07)}
.cake-placeholder{display:block;width:64%;aspect-ratio:1;border:7px solid rgba(255,255,255,.85);border-radius:50%;background:radial-gradient(circle,#fff9fc 0 28%,#f6bad6 29% 41%,#fff9fc 42% 53%,#dc7ca8 54% 100%);box-shadow:0 8px 18px rgba(70,0,35,.18)}
.size{position:absolute;top:12px;left:12px;z-index:1;background:#fff;color:var(--pink);font-weight:800;font-size:.76rem;padding:4px 11px;border-radius:999px;box-shadow:0 4px 10px rgba(0,0,0,.08)}
.cbody{padding:16px 18px 18px;display:flex;flex-direction:column;flex:1}
.cbody h3{margin:0 0 2px;font-size:1.02rem;font-weight:700;line-height:1.3}
.cbody small{color:var(--mut);font-size:.82rem}
.price{color:var(--pink);font-weight:800;font-size:1.3rem;margin:8px 0 14px;letter-spacing:-.02em}
.buy{display:flex;gap:8px;margin-top:auto;align-items:center}
.buy .btn{flex:1;padding:10px 12px}
.qty{display:flex;align-items:center;border:1.5px solid var(--line);border-radius:999px;overflow:hidden;background:#fff}
.qty button{width:30px;height:38px;border:0;background:none;font-size:1.1rem;cursor:pointer;color:var(--pink);font-weight:700;transition:background .2s}
.qty button:hover{background:var(--pink-soft)}
.qty input{width:34px;border:0;border-radius:0;text-align:center;margin:0;padding:0;font:700 .95rem 'Plus Jakarta Sans',sans-serif;background:none;-moz-appearance:textfield}
.qty input:focus{box-shadow:none}
.qty input::-webkit-outer-spin-button,.qty input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}
.note{margin-top:30px;color:var(--mut);font-size:.9rem}
.steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:20px;margin-top:8px}
.step{background:var(--pink-soft);border-radius:24px;padding:26px 24px;transition:transform .4s var(--ease),box-shadow .4s var(--ease)}
.step:hover{transform:translateY(-6px);box-shadow:0 18px 36px rgba(228,8,127,.14)}
.step .no{width:46px;height:46px;border-radius:14px;background:var(--pink);color:#fff;font-weight:800;display:grid;place-items:center;margin-bottom:14px;font-size:1.1rem;transition:transform .4s var(--ease)}
.step:hover .no{transform:rotate(-10deg) scale(1.1)}
.step h3{margin:0 0 6px;font-size:1.05rem}
.step p{margin:0;color:var(--mut);font-size:.92rem}

/* ---------- shared (halaman lain) ---------- */
.page{max-width:1160px;margin:0 auto;padding:44px 24px 70px;animation:fadeUp .6s var(--ease) both}
.page h2{font-size:1.9rem;font-weight:800;letter-spacing:-.03em;margin:0 0 18px}
.page .cart-title{text-align:center}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:var(--pink);color:#fff;border:0;border-radius:999px;padding:11px 20px;font:700 .92rem 'Plus Jakarta Sans',sans-serif;cursor:pointer;text-decoration:none;box-shadow:0 6px 16px rgba(228,8,127,.25);transition:transform .2s var(--ease),box-shadow .25s,background .25s}
.btn:hover{background:var(--pink-d);transform:translateY(-2px);box-shadow:0 10px 22px rgba(228,8,127,.34)}
.btn:active{transform:scale(.96)}
.btn.sm{padding:7px 14px;font-size:.8rem}
.btn.g{background:var(--wa);box-shadow:0 6px 16px rgba(37,211,102,.3)}
.btn.g:hover{background:#1ebe5b}
input,textarea{width:100%;padding:13px 16px;border:1.5px solid var(--line);border-radius:14px;margin:6px 0 14px;font:inherit;background:#fff;transition:border-color .2s,box-shadow .2s}
input:focus,textarea:focus{outline:0;border-color:var(--pink);box-shadow:0 0 0 4px rgba(228,8,127,.12)}
label{font-weight:600;font-size:.9rem}
.err{color:#c0204f;font-size:.84rem;margin:-8px 0 12px}
table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;margin-bottom:18px}
th{background:var(--pink-soft);font-weight:700}
td,th{padding:14px 16px;border-bottom:1px solid var(--line);text-align:left}
tr:last-child td,tr:last-child th{border-bottom:0}
.total-row th,.total-row td{background:var(--pink-soft);font-weight:700}
.right{text-align:right}
.box{background:#fff;border:1px solid var(--line);border-radius:26px;padding:32px;max-width:460px;margin:0 auto;box-shadow:0 20px 50px rgba(228,8,127,.1)}
.box.left{margin:0}
.box h2{text-align:center;margin-bottom:6px}
.box .hint{text-align:center;color:var(--mut);margin:0 0 22px}
.box .btn{width:100%;padding:14px}
.box p{text-align:center}
.auth-box{margin-top:32px}
.note-admin{margin-top:18px;padding:12px 14px;border-radius:12px;background:var(--pink-soft);color:var(--ink);font-size:.92rem;text-align:center}
.admin-page .hint{text-align:left}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:18px;margin:24px 0 30px}
.stat-card{background:#fff;border:1px solid var(--line);border-radius:18px;padding:18px 20px;box-shadow:0 12px 26px rgba(228,8,127,.06)}
.stat-card span{display:block;color:var(--mut);font-size:.84rem;margin-bottom:6px}
.stat-card strong{font-size:2rem;letter-spacing:-.04em;color:var(--ink)}
.admin-page{max-width:1160px;margin:0 auto}
.admin-nav{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin:0 0 30px;padding:8px;background:#fff;border:1px solid var(--line);border-radius:16px}
.admin-nav a,.admin-nav button{display:inline-flex;align-items:center;padding:9px 14px;border:0;border-radius:10px;background:transparent;color:var(--mut);font:600 .9rem 'Plus Jakarta Sans',sans-serif;text-decoration:none;cursor:pointer}
.admin-nav a:hover,.admin-nav button:hover,.admin-nav a.active{background:var(--pink-soft);color:var(--pink)}
.admin-nav form{margin-left:auto}
.admin-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:24px}
.admin-heading h2{margin:0 0 5px}
.admin-subtitle{margin:0;color:var(--mut)}
.admin-heading .eyebrow{margin-bottom:8px}
.admin-panel{padding:22px;background:#fff;border:1px solid var(--line);border-radius:20px;box-shadow:0 12px 28px rgba(228,8,127,.05)}
.panel-heading{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:16px}
.panel-heading h3{margin:0;font-size:1.08rem}
.panel-heading p{margin:4px 0 0;color:var(--mut);font-size:.86rem}
.panel-heading>a{font-weight:700;text-decoration:none}
.admin-table{min-width:720px;margin:0;border:0;border-radius:0}
.admin-table th,.admin-table td{padding:13px 14px}
.admin-table td{vertical-align:middle}
.admin-table th{white-space:nowrap}
.table-wrap{overflow-x:auto}
.table-note{display:block;color:var(--mut);font-size:.8rem;margin-top:3px}
.table-actions{display:flex;gap:7px;align-items:center}
.table-actions form{margin:0}
.btn-danger{background:#b4233b;box-shadow:0 6px 16px rgba(180,35,59,.18)}
.btn-danger:hover{background:#921a2c;box-shadow:0 10px 22px rgba(180,35,59,.25)}
.btn-muted{background:#f4edf1;color:var(--ink);box-shadow:none}
.btn-muted:hover{background:#eadfe5;color:var(--ink);box-shadow:none}
.status-badge{display:inline-flex;align-items:center;padding:5px 10px;border-radius:999px;font-size:.78rem;font-weight:700;white-space:nowrap}
.status-menunggu{background:#fff4d6;color:#805900}
.status-diproses{background:#e8f1ff;color:#2459a6}
.status-selesai{background:#e8f8ef;color:#087343}
.status-dibatalkan{background:#fdecee;color:#a21c30}
.empty-state{margin:0;padding:24px 8px;text-align:center;color:var(--mut)}
.admin-alert{margin-bottom:18px;padding:12px 16px;border:1px solid #bfeccf;border-radius:12px;background:#e8f8ef;color:#087343}
.admin-filter{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0 0 18px}
.admin-filter input,.admin-filter select{width:auto;min-width:220px;margin:0}
.admin-filter a{font-size:.9rem;font-weight:600}
.pagination-wrap{padding-top:18px}
.admin-pagination{display:flex;align-items:center;justify-content:space-between;gap:16px}
.admin-pagination-summary{color:var(--mut);font-size:.86rem}
.admin-pagination-links{display:flex;align-items:center;gap:5px}
.admin-pagination-links a,.admin-pagination-links span{display:inline-flex;min-width:38px;height:38px;align-items:center;justify-content:center;padding:0 10px;border:1px solid var(--line);border-radius:10px;background:#fff;color:var(--ink);font-size:.9rem;font-weight:600;text-decoration:none}
.admin-pagination-links a:hover{border-color:var(--pink);color:var(--pink);background:var(--pink-soft)}
.admin-pagination-links span[aria-current="page"]{border-color:var(--pink);background:var(--pink);color:#fff}
.admin-pagination-links span[aria-disabled="true"]{color:#aaa;background:#fafafa}
.admin-pagination-links a[rel="prev"],.admin-pagination-links a[rel="next"],.admin-pagination-links span[aria-label="pagination.previous"],.admin-pagination-links span[aria-label="pagination.next"]{min-width:78px}
.product-form{max-width:760px}
.product-form label{display:block}
.product-form input[type=file]{padding:10px}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-grid>div{min-width:0}
.form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:10px}
.form-actions .btn{width:auto}
.current-image{margin:0 0 12px;color:var(--mut);font-size:.88rem}
.check{display:flex;align-items:center;gap:8px;margin:4px 0 18px;cursor:pointer}
.check input{width:auto;margin:0;accent-color:var(--pink)}
.detail-grid,.report-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px}
.detail-list{margin:0}
.detail-list>div{display:grid;grid-template-columns:110px 1fr;gap:12px;padding:10px 0;border-bottom:1px solid var(--line)}
.detail-list>div:last-child{border:0}
.detail-list dt{color:var(--mut);font-size:.87rem}
.detail-list dd{margin:0;overflow-wrap:anywhere}
.detail-grid select{margin-bottom:16px}
.order-items{margin-top:18px}
.report-stats .stat-card strong{font-size:1.55rem}
.report-status-list{display:grid;gap:12px}
.report-status-list>div{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--line)}
.report-status-list>div:last-child{border:0}

/* ---------- checkout ---------- */
.opt{font-weight:400;color:var(--mut)}
.co{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.85fr);gap:24px;align-items:start}
.co .box{max-width:none;margin:0}
.auto{background:var(--pink-soft);border:1px dashed #f5b5d5;color:#7a2652;border-radius:14px;padding:12px 16px;font-size:.88rem;margin-bottom:18px}
.auto a{font-weight:700}
.check{display:flex;align-items:center;gap:10px;font-weight:500;margin:2px 0 18px;cursor:pointer}
.check input{width:auto;margin:0;accent-color:var(--pink)}
.sum{background:#fff;border:1px solid var(--line);border-radius:26px;padding:26px;box-shadow:0 20px 50px rgba(228,8,127,.08);position:sticky;top:96px}
.sum h3{margin:0 0 12px;font-size:1.1rem}
.sum .row{display:flex;justify-content:space-between;gap:14px;padding:9px 0;border-bottom:1px dashed var(--line);font-size:.93rem}
.sum small{color:var(--mut)}
.sum .disc{color:var(--green)}
.sum .tot{border:0;font-size:1.05rem;padding-top:14px}
.sum .tot b{color:var(--pink);font-size:1.3rem}
.sumhint{margin:12px 0 0;background:#fff6cc;border-radius:12px;padding:10px 14px;font-size:.85rem}
.payment-options{margin:20px 0;padding:16px;border:1px solid var(--line);border-radius:16px}
.payment-options legend{padding:0 6px;font-weight:700}
.payment-help{margin:0 0 12px;color:var(--mut);font-size:.86rem}
.payment-option{display:flex;align-items:center;gap:12px;margin:9px 0;padding:12px;border:1px solid var(--line);border-radius:12px;cursor:pointer;transition:border-color .2s,background .2s}
.payment-option:has(input:checked){border-color:var(--pink);background:var(--pink-soft)}
.payment-option input{width:18px;height:18px;margin:0;accent-color:var(--pink);flex:none}
.payment-option-copy strong,.payment-option-copy small{display:block}
.payment-option-copy small{font-weight:400;color:var(--mut);font-size:.82rem}
.order-confirmation{max-width:680px;padding:24px;background:#fff;border:1px solid var(--line);border-radius:20px;box-shadow:0 12px 28px rgba(228,8,127,.06)}
.order-confirmation p{margin:0 0 12px}
@media(max-width:900px){.co{grid-template-columns:1fr}.sum{position:static;order:-1}}

/* ---------- footer ---------- */
footer{background:#1a0b14;color:#f3d9e6;margin-top:50px}
.fin{max-width:1160px;margin:0 auto;padding:20px 24px;display:flex;gap:16px;align-items:center;flex-wrap:wrap;justify-content:space-between}
.fin .fb{display:flex;align-items:center;gap:12px}
.fin img{width:42px;height:42px;border-radius:50%}
.fin b{display:block;font-size:1rem;color:#fff}
.fin small{color:#cfa9bd}
.fin a{color:#ffd2e8;text-decoration:none;font-weight:600}
.fin a:hover{color:#fff}
.copy{border-top:1px solid rgba(255,255,255,.08);text-align:center;font-size:.78rem;color:#b58aa2;padding:12px 16px}

/* ---------- responsive ---------- */
@media(max-width:900px){
  .bar{height:68px;gap:10px}
  .brand{margin-right:auto}
  .burger{display:grid;place-items:center}
  .menu{position:absolute;top:100%;left:0;right:0;margin:0;background:#fff;flex-direction:column;align-items:stretch;gap:0;padding:6px 24px 16px;border-bottom:1px solid var(--line);box-shadow:0 18px 30px rgba(228,8,127,.1);opacity:0;visibility:hidden;transform:translateY(-10px);transition:opacity .3s,transform .35s var(--ease),visibility .3s}
  .top.open .menu{opacity:1;visibility:visible;transform:none}
  .menu a,.menu .lnk{padding:14px 0;border-bottom:1px solid var(--line);width:100%}
  .menu a::after,.menu .lnk::after{display:none}
  .menu .who{padding:14px 0;max-width:none}
  .hero-in{grid-template-columns:1fr;padding-top:34px;gap:34px}
  .feats ul{grid-template-columns:repeat(2,1fr)}
  .chips{top:68px}
  .cat{scroll-margin-top:140px}
  .toast{top:80px}
  .toast.cart-warning-toast{top:142px}
  .admin-heading{align-items:flex-start;flex-direction:column}
}
@media(max-width:520px){
  .cart .lbl{display:none}
  .cart{padding:10px 14px}
  .brand img{width:46px;height:46px}
  .brand b{font-size:1.1rem}
  .info{flex-wrap:wrap}
  .info>div{flex:1}
  .info .wa{margin-left:0;flex-basis:100%;text-align:center}
  .feats ul{grid-template-columns:1fr}
  .grid{grid-template-columns:repeat(2,1fr);gap:12px}
  .thumb{height:104px;font-size:2.8rem}
  .cbody{padding:12px 12px 14px}
  .buy{flex-direction:column;align-items:stretch}
  .admin-nav{gap:4px;padding:6px}
  .admin-nav a,.admin-nav button{padding:8px 9px;font-size:.82rem}
  .admin-nav form{margin-left:0}
  .admin-page .stats-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}
  .admin-page .stat-card{padding:14px}
  .admin-page .stat-card strong{font-size:1.35rem;overflow-wrap:anywhere}
  .admin-panel{padding:16px;border-radius:16px}
  .admin-pagination{align-items:flex-start;flex-direction:column}
  .admin-pagination-links{max-width:100%;overflow-x:auto;padding-bottom:4px}
  .admin-filter{align-items:stretch}
  .admin-filter input,.admin-filter select{flex:1;min-width:100%}
  .form-grid,.detail-grid,.report-grid{grid-template-columns:1fr}
  .form-actions{flex-direction:column-reverse}
  .form-actions .btn{width:100%}
  .report-stats .stat-card strong{font-size:1.2rem}
  .qty{align-self:flex-start}
  .page{padding-top:30px}
  .box{padding:24px}
}
@media(prefers-reduced-motion:reduce){
  *,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important;scroll-behavior:auto!important}
  .js .reveal{opacity:1;transform:none}
}
</style>
</head>
<body>
<header class="top" id="top">
  <div class="bar">
    <a class="brand" href="{{ route('home') }}">
      <img src="/logo.png" alt="Logo Mom Sitty">
      <span><b>Cake & Mee</b><small>Mom Sitty</small></span>
    </a>
    <nav class="menu" id="menu">
      <a href="{{ route('home') }}#katalog" class="{{ request()->routeIs('home') ? 'on' : '' }}">Pesan Sekarang</a>
      <a href="{{ route('home') }}#cara-pesan">Cara Pesan</a>
      <a class="tel" href="https://wa.me/6281341591765" target="_blank" rel="noopener"><svg class="i" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>0813 4159 1765</a>
      <a class="admin-link" href="{{ route('admin.login') }}">Login Admin</a>
    </nav>
    <a class="cart" href="{{ route('cart') }}">
      <svg class="i" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      <span class="lbl">Keranjang</span>
      <span class="n {{ session('ok') ? 'bump' : '' }}">{{ array_sum(session('cart', [])) }}</span>
    </a>
    <button class="burger" id="burger" type="button" aria-label="Buka menu" aria-expanded="false"><span></span></button>
  </div>
</header>

@if(session('ok'))<div class="toast" role="status"><span>{{ session('ok') }}</span></div>@endif
@if(session('cart_warning'))<div class="toast cart-warning-toast" role="status"><span>{{ session('cart_warning') }}</span></div>@endif

@hasSection('hero')
  @yield('hero')
  <main>@yield('content')</main>
@else
  <main class="page">@yield('content')</main>
@endif

<footer>
  <div class="fin">
    <div class="fb"><img src="/logo.png" alt=""><div><b>Cake & Mee Mom Sitty</b><small>Menerima Pesanan</small></div></div>
    <div><small>Jazakallah Khairan Syukron Katsiran</small><br><a href="https://wa.me/6281341591765" target="_blank" rel="noopener">WhatsApp 0813 4159 1765</a></div>
  </div>
  <div class="copy">© {{ date('Y') }} Cake & Mee Mom Sitty. Semua hak dilindungi.</div>
</footer>

<script>
(function(){
  var top=document.getElementById('top');
  function sc(){top.classList.toggle('scrolled',window.scrollY>8)}
  sc();window.addEventListener('scroll',sc,{passive:true});

  var b=document.getElementById('burger');
  if(b){
    b.addEventListener('click',function(){var o=top.classList.toggle('open');b.setAttribute('aria-expanded',o)});
    document.querySelectorAll('#menu a').forEach(function(a){a.addEventListener('click',function(){top.classList.remove('open')})});
  }

  var els=[].slice.call(document.querySelectorAll('.reveal'));
  function show(el){el.classList.add('in');setTimeout(function(){el.classList.remove('reveal','in')},1700)}
  if('IntersectionObserver' in window){
    var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){show(e.target);io.unobserve(e.target)}})},{threshold:.12,rootMargin:'0px 0px -40px 0px'});
    els.forEach(function(el){io.observe(el)});
  }else{els.forEach(show)}

  document.querySelectorAll('.qty').forEach(function(q){
    var i=q.querySelector('input');
    q.querySelectorAll('button').forEach(function(bt){
      bt.addEventListener('click',function(){
        var v=(parseInt(i.value,10)||1)+parseInt(bt.getAttribute('data-step'),10);
        i.value=Math.max(1,Math.min(99,v));
      });
    });
  });

  try{
    var y=sessionStorage.getItem('sy');
    if(y!==null){sessionStorage.removeItem('sy');window.scrollTo({top:parseInt(y,10),behavior:'instant'})}
  }catch(e){}
  document.querySelectorAll('form.buy').forEach(function(f){
    f.addEventListener('submit',function(){try{sessionStorage.setItem('sy',window.scrollY)}catch(e){}});
  });

  document.querySelectorAll('.toast').forEach(function(t){
    setTimeout(function(){t.classList.add('out')},3600);
    setTimeout(function(){t.remove()},4200);
  });

  var chips=[].slice.call(document.querySelectorAll('.chips a'));
  if(chips.length&&'IntersectionObserver' in window){
    var spy=new IntersectionObserver(function(es){
      es.forEach(function(e){
        if(e.isIntersecting){chips.forEach(function(a){a.classList.toggle('on',a.getAttribute('href')==='#'+e.target.id)})}
      });
    },{rootMargin:'-30% 0px -60% 0px'});
    chips.forEach(function(a){var h=document.querySelector(a.getAttribute('href'));if(h)spy.observe(h)});
  }
})();
</script>
</body>
</html>
