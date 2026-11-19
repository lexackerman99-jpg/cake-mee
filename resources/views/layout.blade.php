<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Cake & Mee Mom Sitty</title>
<link rel="icon" href="/logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script>document.documentElement.classList.add('js')</script>
<style>
:root{
  --pink:#c8076f;--pink-d:#a30559;--pink-soft:#f7e6dd;--pink-tint:#efd3c6;
  --cream:#fbf5ec;--paper:#fffdf8;--sand:#f1e7d8;
  --ink:#2e2421;--mut:#74655e;--line:#e6d9c8;--green:#1f7a4d;--wa:#1f7a4d;
  --serif:'Fraunces',Georgia,'Times New Roman',serif;
  --sans:'Public Sans',system-ui,sans-serif;
}
*{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:90px}
body{min-height:100vh;margin:0;display:flex;flex-direction:column;font-family:var(--sans);color:var(--ink);background:var(--cream);line-height:1.6;-webkit-font-smoothing:antialiased}
main{flex:1}
a{color:var(--pink-d)}
img{max-width:100%}
h1,h2,h3{font-family:var(--serif);font-weight:600;letter-spacing:-.01em}
:focus-visible{outline:2px solid var(--pink);outline-offset:2px}
.i{width:1.15em;height:1.15em;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex:none}

/* ---------- Entrance & Scroll Animations ---------- */
@keyframes fadeInUp{
  from{opacity:0;transform:translateY(24px)}
  to{opacity:1;transform:translateY(0)}
}
.fx{
  animation:fadeInUp .75s cubic-bezier(.16,1,.3,1) forwards;
  animation-delay:var(--d,0s);
  opacity:0;
}
.fx2{
  animation:fadeInUp .9s cubic-bezier(.16,1,.3,1) forwards;
  animation-delay:var(--d,.18s);
  opacity:0;
}

/* Scroll reveal for elements as user scrolls down */
.reveal{
  opacity:0;
  transform:translateY(28px);
  transition:opacity .65s cubic-bezier(.16,1,.3,1), transform .65s cubic-bezier(.16,1,.3,1);
  transition-delay:var(--d,0s);
  will-change:opacity,transform;
}
.reveal.in{
  opacity:1;
  transform:translateY(0);
}

/* ---------- header ---------- */
.top{position:sticky;top:0;z-index:50;background:rgba(251,245,236,.88);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-bottom:1px solid rgba(230,217,200,.75);transition:all .3s ease}
.top.scrolled{background:rgba(251,245,236,.96);box-shadow:0 4px 20px -2px rgba(46,36,33,.08)}
.bar{max-width:1160px;margin:0 auto;padding:0 24px;height:72px;display:flex;align-items:center;gap:24px}
.brand{display:flex;align-items:center;gap:12px;text-decoration:none}
.brand img{width:48px;height:48px;border-radius:50%}
.brand b{display:block;font-family:var(--serif);color:var(--ink);font-weight:700;font-size:1.25rem;line-height:1.1}
.brand small{color:var(--pink-d);font-size:.82rem;font-weight:500}
.menu{display:flex;align-items:center;gap:26px;margin:0 auto}
.menu a,.menu .lnk{color:var(--ink);text-decoration:none;font:500 .95rem var(--sans);padding:6px 0;background:none;border:0;cursor:pointer;display:inline-flex;align-items:center;gap:6px;border-bottom:2px solid transparent}
.menu a:hover,.menu a.on,.menu .lnk:hover{border-bottom-color:var(--pink)}
.menu a.mut{color:var(--mut)}
.menu a.tel{color:var(--green)}
.menu .admin-link{color:var(--pink-d);font-weight:700}
.menu .who{color:var(--mut);font-size:.92rem;max-width:130px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.menu form{margin:0}
.cart{display:inline-flex;align-items:center;gap:9px;background:var(--pink);color:#fff!important;text-decoration:none;font-weight:600;padding:10px 18px;border-radius:6px;transition:background .15s}
.cart:hover{background:var(--pink-d)}
.cart .n{background:#fff;color:var(--pink-d);border-radius:4px;min-width:22px;height:22px;display:grid;place-items:center;font-size:.8rem;font-weight:700;padding:0 6px}
.burger{display:none;width:44px;height:44px;border:0;border-radius:6px;background:none;cursor:pointer;color:var(--ink)}
.burger span,.burger span::before,.burger span::after{display:block;width:22px;height:2px;background:currentColor;position:relative}
.burger span::before,.burger span::after{content:"";position:absolute;left:0}
.burger span::before{top:-7px}
.burger span::after{top:7px}
.top.open .burger span{background:transparent}
.top.open .burger span::before{top:0;transform:rotate(45deg)}
.top.open .burger span::after{top:0;transform:rotate(-45deg)}

.toast{position:fixed;top:88px;right:20px;z-index:60;background:var(--paper);border:1px solid var(--line);border-left:4px solid var(--green);padding:12px 16px;border-radius:6px;display:flex;gap:10px;max-width:340px;box-shadow:0 2px 8px rgba(46,36,33,.12)}
.toast.cart-warning-toast{top:150px;border-left-color:#b07d00;color:#6b4c00}
.toast.out{opacity:0;transition:opacity .4s}

/* ---------- hero ---------- */
.hero{border-bottom:1px solid var(--line)}
.hero-in{max-width:1160px;margin:0 auto;padding:56px 24px 52px;display:grid;grid-template-columns:1.05fr .95fr;gap:56px;align-items:center}
.hero h1{font-size:clamp(2.1rem,4.4vw,3.4rem);line-height:1.12;font-weight:600;margin:0 0 20px;text-wrap:balance}
.hl{color:var(--pink-d);font-style:italic}
.lead{font-size:1.08rem;color:#4d3f39;margin:0 0 24px;max-width:540px}
.lead b{color:var(--ink);font-weight:600}
.info{display:flex;align-items:center;gap:14px;border-top:1px solid var(--line);border-bottom:1px solid var(--line);padding:14px 0;margin-bottom:26px;max-width:540px}
.info img{width:44px;height:44px;border-radius:50%;flex:none}
.info>div{min-width:0}
.info i{display:block;color:var(--mut);font-size:.85rem}
.info strong{display:block;font-size:1rem}
.info .wa{margin-left:auto;white-space:nowrap;color:var(--green);border:1px solid var(--green);border-radius:6px;padding:7px 12px;font-weight:600;font-size:.85rem;text-decoration:none}
.info .wa:hover{background:var(--green);color:#fff}
.cta{display:inline-flex;align-items:center;gap:10px;background:var(--pink);color:#fff;text-decoration:none;font-weight:600;padding:14px 24px;border-radius:6px;transition:background .15s}
.cta:hover{background:var(--pink-d)}
.visual{margin:0}
.visual .ph{aspect-ratio:4/4.3;overflow:hidden;border-radius:4px;background:var(--sand);border:1px solid var(--line)}
.visual .ph img{width:100%;height:100%;object-fit:cover;display:block}
.hero-placeholder{display:none}
.visual .cap{padding:10px 2px 0;color:var(--mut);font-size:.88rem}
.cap small{display:none}
.cap span{font-family:var(--serif);font-style:italic}

.feats{max-width:1160px;margin:0 auto;padding:0 24px}
.feats ul{list-style:none;margin:0;padding:18px 0 20px;border-top:1px solid var(--line);display:flex;flex-wrap:wrap;gap:8px 34px;color:var(--mut);font-size:.95rem}
.feats li{display:block}
.feats .ic{display:none}
.feats b{font-weight:600;color:var(--ink)}
.feats span.s::before{content:" — "}

/* ---------- sections ---------- */
.sec{max-width:1160px;margin:0 auto;padding:60px 24px 10px}
.eyebrow{display:block;color:var(--pink-d);font-weight:600;font-size:.8rem;letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px}
.sec h2.t{font-size:clamp(1.7rem,3.2vw,2.4rem);margin:0 0 10px;line-height:1.2}
.sec .sub{color:var(--mut);max-width:620px;margin:0 0 22px}
.promo{border:1px dashed var(--pink);padding:12px 18px;border-radius:4px;margin-bottom:20px}
.promo a{font-weight:600}
.chips{display:flex;gap:8px;overflow-x:auto;position:sticky;top:72px;z-index:20;background:var(--cream);padding:12px 0;border-bottom:1px solid var(--line);scrollbar-width:none}
.chips::-webkit-scrollbar{display:none}
.chips a{flex:none;text-decoration:none;color:var(--ink);border:1px solid var(--line);background:var(--paper);padding:7px 16px;border-radius:4px;font-weight:500;font-size:.9rem}
.chips a:hover{border-color:var(--pink)}
.chips a.on{background:var(--ink);border-color:var(--ink);color:var(--cream)}
.cat{font-size:1.5rem;margin:40px 0 16px;scroll-margin-top:140px;padding-bottom:8px;border-bottom:1px solid var(--line)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:26px 22px}
.card{display:flex;flex-direction:column}
.thumb{aspect-ratio:1/1;display:grid;place-items:center;position:relative;background:var(--sand);border-radius:4px;overflow:hidden}
.thumb.ph{display:block}
.thumb.ph img{width:100%;height:100%;object-fit:cover;display:block}
.cake-placeholder{display:block;width:58%;aspect-ratio:1;border-radius:50%;background:var(--paper);border:10px solid var(--pink-tint)}
.size{position:absolute;top:10px;left:10px;z-index:1;background:var(--paper);color:var(--ink);font-weight:600;font-size:.76rem;padding:3px 9px;border-radius:3px}
.cbody{padding:12px 0 0;display:flex;flex-direction:column;flex:1}
.cbody h3{margin:0 0 2px;font-size:1.12rem;line-height:1.3}
.cbody small{color:var(--mut);font-size:.84rem}
.price{font-family:var(--serif);color:var(--ink);font-weight:600;font-size:1.2rem;margin:8px 0 12px}
.buy{display:flex;gap:8px;margin-top:auto;align-items:center}
.buy .btn{flex:1;padding:9px 12px}
.qty{display:flex;align-items:center;border:1px solid var(--line);border-radius:6px;overflow:hidden;background:var(--paper)}
.qty button{width:30px;height:38px;border:0;background:none;font-size:1.1rem;cursor:pointer;color:var(--ink)}
.qty button:hover{background:var(--sand)}
.qty input{width:34px;border:0;border-radius:0;text-align:center;margin:0;padding:0;font:600 .95rem var(--sans);background:none;-moz-appearance:textfield}
.qty input:focus{box-shadow:none}
.qty input::-webkit-outer-spin-button,.qty input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}
.note{margin-top:30px;color:var(--mut);font-size:.9rem}
.steps{list-style:none;margin:8px 0 0;padding:0;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:28px;counter-reset:s}
.step{border-top:2px solid var(--ink);padding-top:14px}
.step .no{font-family:var(--serif);font-style:italic;color:var(--pink-d);font-size:1.5rem;line-height:1;margin-bottom:6px}
.step h3{margin:0 0 4px;font-size:1.1rem}
.step p{margin:0;color:var(--mut);font-size:.93rem}

/* ---------- shared ---------- */
.page{width:100%;max-width:1160px;margin:0 auto;padding:44px 24px 70px}
.page h2{font-size:1.9rem;margin:0 0 18px}
.page .cart-title{text-align:center}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:var(--pink);color:#fff;border:0;border-radius:6px;padding:10px 18px;font:600 .92rem var(--sans);cursor:pointer;text-decoration:none;transition:background .15s}
.btn:hover{background:var(--pink-d)}
.btn.sm{padding:6px 12px;font-size:.8rem}
.btn.g{background:var(--green)}
.btn.g:hover{background:#17603c}
input,textarea,select{width:100%;padding:11px 14px;border:1px solid #cdbca8;border-radius:6px;margin:6px 0 14px;font:inherit;background:var(--paper);color:var(--ink)}
input:focus,textarea:focus,select:focus{outline:2px solid var(--pink);outline-offset:0;border-color:var(--pink)}
label{font-weight:600;font-size:.9rem}
.err{color:#b3202f;font-size:.84rem;margin:-8px 0 12px}
table{width:100%;border-collapse:separate;border-spacing:0;background:var(--paper);border:1px solid var(--line);border-radius:6px;overflow:hidden;margin-bottom:18px}
th{background:var(--sand);font-weight:600}
td,th{padding:13px 16px;border-bottom:1px solid var(--line);text-align:left}
tr:last-child td,tr:last-child th{border-bottom:0}
.total-row th,.total-row td{background:var(--sand);font-weight:600}
.right{text-align:right}
.box{background:var(--paper);border:1px solid var(--line);border-radius:6px;padding:30px;max-width:460px;margin:0 auto}
.box.left{margin:0}
.box h2{text-align:center;margin-bottom:6px}
.box .hint{text-align:center;color:var(--mut);margin:0 0 22px}
.box .btn{width:100%;padding:13px}
.box p{text-align:center}
.auth-box{margin-top:32px}
.note-admin{margin-top:18px;padding:12px 14px;border-radius:4px;background:var(--sand);font-size:.92rem;text-align:center}
.admin-page .hint{text-align:left}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin:24px 0 30px}
.stats-grid:has(.stat-revenue){grid-template-columns:minmax(270px,1.4fr) repeat(3,minmax(0,1fr))}
.stat-card{display:flex;flex-direction:column;justify-content:space-between;gap:12px;min-width:0;background:var(--paper);border:1px solid var(--line);border-radius:12px;padding:22px 24px;box-shadow:0 2px 8px -2px rgba(46,36,33,.04);transition:transform .25s cubic-bezier(.16,1,.3,1),box-shadow .25s cubic-bezier(.16,1,.3,1)}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 10px 24px -4px rgba(46,36,33,.08)}
.stat-card span{display:block;color:var(--mut);font-size:.84rem;font-weight:600;letter-spacing:.03em;text-transform:uppercase;margin:0}
.stat-card strong{font-family:var(--serif);font-size:2.05rem;line-height:1.1;font-weight:700;color:var(--ink)}
.stat-revenue{background:linear-gradient(135deg, #2e2421 0%, #171110 100%);border-color:#2e2421;box-shadow:0 4px 16px -2px rgba(46,36,33,.2)}
.stat-revenue span{color:#dfd0c4}
.stat-revenue strong{color:#fff;font-size:clamp(1.7rem,2.5vw,2.2rem);white-space:nowrap}
@media(max-width:1100px){.stats-grid:has(.stat-revenue){grid-template-columns:repeat(2,minmax(0,1fr))}.stat-revenue{grid-column:1/-1}}
.admin-page{max-width:1360px;margin:0 auto;width:100%}
.page:has(.admin-page),body.is-admin .page{max-width:1360px;padding:32px 28px 70px}
body.is-admin .bar{max-width:1360px;padding:0 28px}
body.is-admin footer .fin{max-width:1360px;padding:20px 28px}
.admin-nav{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin:0 0 26px;padding:6px;background:var(--paper);border:1px solid var(--line);border-radius:10px;box-shadow:0 2px 6px rgba(46,36,33,.03)}
.admin-nav a,.admin-nav button{display:inline-flex;align-items:center;padding:8px 16px;border:0;border-radius:7px;background:transparent;color:var(--mut);font:600 .88rem var(--sans);text-decoration:none;cursor:pointer;transition:all .2s cubic-bezier(.16,1,.3,1)}
.admin-nav a:hover,.admin-nav button:hover{background:var(--sand);color:var(--ink)}
.admin-nav a.active{background:var(--ink);color:#fff;box-shadow:0 2px 8px rgba(46,36,33,.14)}
.admin-nav form{margin-left:auto}
.admin-nav form button{color:#b3202f;background:transparent}
.admin-nav form button:hover{background:#fee2e2;color:#991b1b}
.admin-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:24px}
.admin-heading h2{margin:0 0 5px}
.admin-subtitle{margin:0;color:var(--mut)}
.admin-heading .eyebrow{margin-bottom:4px}
.admin-panel{padding:24px;background:var(--paper);border:1px solid var(--line);border-radius:12px;box-shadow:0 4px 16px -2px rgba(46,36,33,.04)}
.panel-heading{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--line)}
.panel-heading h3{margin:0;font-size:1.2rem;font-weight:700}
.panel-heading p{margin:4px 0 0;color:var(--mut);font-size:.86rem}
.panel-heading>a{font-weight:600;font-size:.9rem;display:inline-flex;align-items:center;gap:4px;transition:transform .2s ease}
.panel-heading>a:hover{transform:translateX(3px)}
.admin-table{width:100%;min-width:840px;margin:0;border:0;border-collapse:separate;border-spacing:0}
.admin-table thead tr th{background:#f6ece0;color:var(--ink);font-size:.82rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:14px 16px;border-bottom:2px solid var(--line);white-space:nowrap}
.admin-table thead tr th:first-child{border-top-left-radius:8px}
.admin-table thead tr th:last-child{border-top-right-radius:8px}
.admin-table tbody tr td{padding:14px 16px;vertical-align:middle;border-bottom:1px solid #f2e7db;font-size:.92rem;transition:background .15s ease}
.admin-table tbody tr:hover td{background:#faf4eb}
.admin-table tbody tr:last-child td{border-bottom:0}
.col-order-num{font-weight:700;color:var(--ink);white-space:nowrap}
.col-date{white-space:nowrap;font-variant-numeric:tabular-nums;color:#4d3f39;font-size:.88rem}
.col-total{white-space:nowrap;font-weight:700;font-variant-numeric:tabular-nums;color:var(--ink)}
.col-customer{font-weight:600;color:var(--ink);white-space:nowrap}
.col-wa a{color:var(--green);font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;white-space:nowrap}
.col-wa a:hover{text-decoration:underline}
.pay-wrap{display:flex;flex-direction:column;gap:2px}
.pay-title{font-weight:600;color:var(--ink);white-space:nowrap}
.pay-sub{font-size:.78rem;color:var(--mut);white-space:nowrap}
.table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:8px}
.table-note{display:block;color:var(--mut);font-size:.8rem;margin-top:3px}
.table-actions{display:flex;gap:7px;align-items:center}
.table-actions form{margin:0}
.btn-danger{background:#a62235}
.btn-danger:hover{background:#861a29}
.btn-muted{background:var(--sand);color:var(--ink)}
.btn-muted:hover{background:var(--pink-tint);color:var(--ink)}
.btn-detail{display:inline-flex;align-items:center;justify-content:center;padding:6px 15px;background:var(--pink);color:#fff!important;font-weight:600;font-size:.8rem;border-radius:9999px;text-decoration:none;box-shadow:0 2px 6px rgba(200,7,111,.22);transition:all .2s cubic-bezier(.16,1,.3,1)}
.btn-detail:hover{background:var(--pink-d);transform:translateY(-1px);box-shadow:0 4px 10px rgba(200,7,111,.32)}
.status-badge{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:9999px;font-size:.78rem;font-weight:700;white-space:nowrap;letter-spacing:.02em}
.status-badge::before{content:"";width:6px;height:6px;border-radius:50%;display:inline-block}
.status-menunggu{background:#fef3c7;color:#92400e;border:1px solid #fde68a}
.status-menunggu::before{background:#d97706}
.status-diproses{background:#e0f2fe;color:#0369a1;border:1px solid #bae6fd}
.status-diproses::before{background:#0284c7}
.status-selesai{background:#dcfce7;color:#15803d;border:1px solid #bbf7d0}
.status-selesai::before{background:#16a34a}
.status-dibatalkan{background:#ffe4e6;color:#be123c;border:1px solid #fecdd3}
.status-dibatalkan::before{background:#e11d48}
.empty-state{margin:0;padding:24px 8px;text-align:center;color:var(--mut)}
.admin-alert{margin-bottom:18px;padding:12px 16px;border:1px solid #b9dcc6;border-radius:4px;background:#dcefe3;color:#17603c}
.admin-filter{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0 0 18px}
.admin-filter input,.admin-filter select{width:auto;min-width:220px;margin:0}
.admin-filter a{font-size:.9rem;font-weight:600}
.pagination-wrap{padding-top:18px}
.admin-pagination{display:flex;align-items:center;justify-content:space-between;gap:16px}
.admin-pagination-summary{color:var(--mut);font-size:.86rem}
.admin-pagination-links{display:flex;align-items:center;gap:5px}
.admin-pagination-links a,.admin-pagination-links span{display:inline-flex;min-width:38px;height:38px;align-items:center;justify-content:center;padding:0 10px;border:1px solid var(--line);border-radius:4px;background:var(--paper);color:var(--ink);font-size:.9rem;text-decoration:none}
.admin-pagination-links a:hover{border-color:var(--pink);color:var(--pink-d)}
.admin-pagination-links span[aria-current="page"]{border-color:var(--ink);background:var(--ink);color:var(--cream)}
.admin-pagination-links span[aria-disabled="true"]{color:#aaa;background:var(--cream)}
.admin-pagination-links a[rel="prev"],.admin-pagination-links a[rel="next"],.admin-pagination-links span[aria-label="pagination.previous"],.admin-pagination-links span[aria-label="pagination.next"]{min-width:78px}
.product-form{max-width:760px}
.product-form label{display:block}
.product-form input[type=file]{padding:10px}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-grid>div{min-width:0}
.form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:10px}
.form-actions .btn{width:auto}
.current-image{margin:0 0 12px;color:var(--mut);font-size:.88rem}
.check{display:flex;align-items:center;gap:10px;font-weight:500;margin:2px 0 18px;cursor:pointer}
.check input{width:auto;margin:0;accent-color:var(--pink)}
.detail-grid,.report-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px}
.detail-list{margin:0}
.detail-list>div{display:grid;grid-template-columns:110px 1fr;gap:12px;padding:10px 0;border-bottom:1px solid var(--line)}
.detail-list>div:last-child{border:0}
.detail-list dt{color:var(--mut);font-size:.87rem}
.detail-list dd{margin:0;overflow-wrap:anywhere}
.detail-grid select{margin-bottom:16px}
.order-items{margin-top:18px}
.report-stats .stat-card strong{font-size:1.5rem}
.report-status-list{display:grid;gap:12px}
.report-status-list>div{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--line)}
.report-status-list>div:last-child{border:0}

/* ---------- checkout ---------- */
.opt{font-weight:400;color:var(--mut)}
.co{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.85fr);gap:24px;align-items:start}
.co .box{max-width:none;margin:0}
.auto{background:var(--sand);border-radius:4px;padding:12px 16px;font-size:.88rem;margin-bottom:18px}
.auto a{font-weight:600}
.sum{background:var(--paper);border:1px solid var(--line);border-radius:6px;padding:24px;position:sticky;top:96px}
.sum h3{margin:0 0 12px;font-size:1.2rem}
.sum .row{display:flex;justify-content:space-between;gap:14px;padding:9px 0;border-bottom:1px dotted #cdbca8;font-size:.93rem}
.sum small{color:var(--mut)}
.sum .disc{color:var(--green)}
.sum .tot{border:0;font-size:1.05rem;padding-top:14px}
.sum .tot b{font-family:var(--serif);color:var(--ink);font-size:1.35rem}
.sumhint{margin:12px 0 0;background:#f8ebc4;border-radius:4px;padding:10px 14px;font-size:.85rem}
.payment-options{margin:20px 0;padding:16px;border:1px solid var(--line);border-radius:6px}
.payment-options legend{padding:0 6px;font-weight:600}
.payment-help{margin:0 0 12px;color:var(--mut);font-size:.86rem}
.payment-option{display:flex;align-items:center;gap:12px;margin:9px 0;padding:12px;border:1px solid var(--line);border-radius:6px;cursor:pointer}
.payment-option:has(input:checked){border-color:var(--pink);background:var(--pink-soft)}
.payment-option input{width:18px;height:18px;margin:0;accent-color:var(--pink);flex:none}
.payment-option-copy strong,.payment-option-copy small{display:block}
.payment-option-copy small{font-weight:400;color:var(--mut);font-size:.82rem}
.payment-card-group{margin:9px 0;border:1px solid var(--line);border-radius:6px;background:var(--paper);overflow:hidden}
.payment-card-group:has(input[name="payment_method"]:checked){border-color:var(--pink);background:var(--pink-soft)}
.payment-card-group .payment-option{margin:0;border:0;border-radius:0;background:transparent!important}
.payment-sub-box{display:none;padding:0 16px 14px 44px}
.payment-card-group.open .payment-sub-box,.payment-card-group:has(input[name="payment_method"]:checked) .payment-sub-box{display:block}
.payment-sub-label{display:block;font-size:.8rem;font-weight:600;color:var(--mut);margin-bottom:8px}
.payment-sub-grid{display:flex;gap:8px;flex-wrap:wrap}
.payment-sub-chip{cursor:pointer;margin:0;display:inline-flex}
.payment-sub-chip input{position:absolute;opacity:0;width:0;height:0;margin:0;pointer-events:none}
.payment-sub-chip span{display:inline-flex;align-items:center;padding:6px 14px;border-radius:4px;font-size:.84rem;font-weight:600;background:var(--paper);border:1px solid #cdbca8;color:var(--ink)}
.payment-sub-chip:hover span{border-color:var(--pink)}
.payment-sub-chip input:checked+span{background:var(--ink);border-color:var(--ink);color:var(--cream)}
.payment-sub-chip input:focus-visible+span{outline:2px solid var(--pink);outline-offset:2px}
.order-confirmation{max-width:680px;padding:24px;background:var(--paper);border:1px solid var(--line);border-radius:6px}
.order-confirmation p{margin:0 0 12px}
@media(max-width:900px){.co{grid-template-columns:1fr}.sum{position:static;order:-1}}

/* ---------- footer ---------- */
footer{background:var(--sand);border-top:1px solid var(--line);color:var(--ink);margin-top:50px}
.fin{max-width:1160px;margin:0 auto;padding:20px 24px;display:flex;gap:16px;align-items:center;flex-wrap:wrap;justify-content:space-between}
.fin .fb{display:flex;align-items:center;gap:12px}
.fin img{width:40px;height:40px;border-radius:50%}
.fin b{display:block;font-family:var(--serif)}
.fin small{color:var(--mut)}
.fin a{color:var(--pink-d);font-weight:600}
.copy{border-top:1px solid var(--line);text-align:center;font-size:.78rem;color:var(--mut);padding:12px 16px}

/* ---------- responsive ---------- */
@media(max-width:900px){
  .bar{height:64px;gap:10px}
  .brand{margin-right:auto}
  .burger{display:grid;place-items:center}
  .menu{position:absolute;top:100%;left:0;right:0;margin:0;background:var(--cream);flex-direction:column;align-items:stretch;gap:0;padding:6px 24px 16px;border-bottom:1px solid var(--line);opacity:0;visibility:hidden}
  .top.open .menu{opacity:1;visibility:visible}
  .menu a,.menu .lnk{padding:14px 0;border-bottom:1px solid var(--line);width:100%}
  .menu .who{padding:14px 0;max-width:none}
  .hero-in{grid-template-columns:1fr;padding-top:30px;gap:30px}
  .chips{top:64px}
  .cat{scroll-margin-top:130px}
  .toast{top:76px}
  .toast.cart-warning-toast{top:138px}
  .admin-heading{align-items:flex-start;flex-direction:column}
}
@media(max-width:520px){
  .cart .lbl{display:none}
  .cart{padding:10px 14px}
  .brand img{width:42px;height:42px}
  .brand b{font-size:1.1rem}
  .info{flex-wrap:wrap}
  .info>div{flex:1}
  .info .wa{margin-left:0;flex-basis:100%;text-align:center}
  .feats ul{flex-direction:column;gap:6px}
  .grid{grid-template-columns:repeat(2,1fr);gap:20px 12px}
  .buy{flex-direction:column;align-items:stretch}
  .admin-nav{gap:4px}
  .admin-nav a,.admin-nav button{padding:8px 9px;font-size:.82rem}
  .admin-nav form{margin-left:0}
  .admin-page .stats-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}
  .admin-page .stat-card{padding:14px}
  .admin-page .stat-card strong{font-size:1.35rem;overflow-wrap:anywhere}
  .admin-page .stat-card.stat-revenue{grid-column:1/-1}
  .admin-page .stat-card.stat-revenue strong{font-size:1.6rem;white-space:normal}
  .admin-panel{padding:16px}
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
  .box{padding:22px}
}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important}}
</style>
</head>
<body class="{{ (request()->is('admin') || request()->is('admin/*') || request()->is('loginadmin/*')) ? 'is-admin' : '' }}">
<header class="top" id="top">
  <div class="bar">
    <a class="brand" href="{{ route('home') }}">
      <img src="/logo.png" alt="Logo Mom Sitty">
      <span><b>Cake & Mee</b><small>Mom Sitty</small></span>
    </a>
    @unless(request()->is('admin') || request()->is('admin/*') || request()->is('loginadmin') || request()->is('loginadmin/*'))
    <nav class="menu" id="menu">
      <a href="{{ route('home') }}#katalog" class="{{ request()->routeIs('home') ? 'on' : '' }}">Pesan Sekarang</a>
      <a href="{{ route('home') }}#cara-pesan">Cara Pesan</a>
      <a class="tel" href="https://wa.me/6281341591765" target="_blank" rel="noopener"><svg class="i" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>0813 4159 1765</a>
    </nav>
    <a class="cart" href="{{ route('cart') }}">
      <svg class="i" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      <span class="lbl">Keranjang</span>
      <span class="n {{ session('ok') ? 'bump' : '' }}">{{ array_sum(session('cart', [])) }}</span>
    </a>
    <button class="burger" id="burger" type="button" aria-label="Buka menu" aria-expanded="false"><span></span></button>
    @endunless
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
  if('IntersectionObserver' in window){
    var io=new IntersectionObserver(function(es){
      es.forEach(function(e){
        if(e.isIntersecting){
          e.target.classList.add('in');
          io.unobserve(e.target);
        }
      });
    },{threshold:.08,rootMargin:'0px 0px -30px 0px'});
    els.forEach(function(el){io.observe(el)});
  }else{
    els.forEach(function(el){el.classList.add('in')});
  }

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
