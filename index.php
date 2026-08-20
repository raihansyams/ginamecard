<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kokobear — Status Joki Live</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600&family=Spectral:ital,wght@0,400;0,600;1,400&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#0e1018;
    --ink-2:#171a26;
    --ink-3:#1e2233;
    --line: rgba(202,161,93,0.20);
    --line-bright: rgba(202,161,93,0.45);
    --gilt:#caa15d;
    --gilt-bright:#ecca8c;
    --parchment:#f4ecda;
    --muted:#8b8fa3;
    --danger:#e2604f;
    --spiral:#8b7fc7;
    --so:#c1622e;
    --it:#3f9a92;
    --font-display: 'Spectral', serif;
    --font-label: 'Cinzel', serif;
    --font-ui: 'Inter', system-ui, sans-serif;
    --font-mono: 'JetBrains Mono', monospace;
  }

  *{ box-sizing:border-box; }
  html,body{ height:100%; }
  body{
    margin:0;
    background:
      radial-gradient(1100px 520px at 18% -8%, rgba(202,161,93,0.08), transparent 60%),
      radial-gradient(900px 500px at 100% 110%, rgba(139,127,199,0.07), transparent 55%),
      var(--ink);
    color: var(--parchment);
    font-family: var(--font-ui);
    -webkit-font-smoothing: antialiased;
    min-height:100%;
  }

  .app{ max-width:1180px; margin:0 auto; padding: 28px 20px 60px; }

  /* ---------- Header ---------- */
  header.top{
    display:flex; align-items:baseline; justify-content:space-between;
    gap:16px; margin-bottom:26px; flex-wrap:wrap;
    border-bottom:1px solid var(--line); padding-bottom:16px;
  }
  header.top .brand{ display:flex; align-items:baseline; gap:10px; }
  header.top .mark{
    font-family:var(--font-label); font-size:12px; letter-spacing:0.22em;
    color:var(--gilt); border:1px solid var(--line-bright); padding:5px 10px;
    border-radius:2px; text-transform:uppercase;
  }
  header.top h1{
    font-family:var(--font-display); font-weight:600; font-size:22px; margin:0;
    letter-spacing:0.01em; color:var(--parchment);
  }
  header.top p{ margin:0; color:var(--muted); font-size:13px; }

  /* ---------- Layout ---------- */
  .layout{ display:grid; grid-template-columns: 340px 1fr; gap:26px; align-items:start; }
  @media (max-width:860px){ .layout{ grid-template-columns:1fr; } }

  section.panel{
    background:var(--ink-2);
    border:1px solid var(--line);
    border-radius:10px;
    padding:20px;
  }

  .zone-label{
    font-family:var(--font-label); font-size:11px; letter-spacing:0.16em;
    text-transform:uppercase; color:var(--gilt); margin:0 0 4px;
  }
  .zone-hint{ font-size:12px; color:var(--muted); margin:0 0 18px; line-height:1.5; }

  /* ---------- Form ---------- */
  label.field-label{
    display:block; font-size:12px; color:var(--muted); margin-bottom:6px;
    font-weight:500;
  }
  input#uid{
    width:100%; background:var(--ink); border:1px solid var(--line);
    color:var(--parchment); font-family:var(--font-mono); font-size:16px;
    padding:11px 12px; border-radius:6px; letter-spacing:0.03em;
  }
  input#uid:focus{ outline:2px solid var(--gilt); outline-offset:1px; border-color:var(--gilt); }
  input#uid::placeholder{ color:#565b70; }

  .field{ margin-bottom:16px; }

  .segmented{ display:flex; gap:8px; }
  .seg-btn{
    flex:1; background:var(--ink); border:1px solid var(--line);
    color:var(--muted); font-family:var(--font-ui); font-weight:600; font-size:12.5px;
    padding:10px 6px; border-radius:6px; cursor:pointer; text-align:center;
    transition: border-color .15s, color .15s, background .15s;
  }
  .seg-btn:hover{ border-color:var(--line-bright); color:var(--parchment); }
  .seg-btn[aria-pressed="true"]{
    color: var(--ink); font-weight:700; border-color: transparent;
  }
  .seg-btn[data-cat="spiral"][aria-pressed="true"]{ background:var(--spiral); }
  .seg-btn[data-cat="so"][aria-pressed="true"]{ background:var(--so); }
  .seg-btn[data-cat="it"][aria-pressed="true"]{ background:var(--it); }

  button#submit-btn{
    width:100%; margin-top:6px; background:var(--gilt); color:#241a08;
    border:none; font-family:var(--font-ui); font-weight:700; font-size:14px;
    padding:12px; border-radius:6px; cursor:pointer; letter-spacing:0.01em;
    transition: background .15s, transform .05s;
  }
  button#submit-btn:hover{ background:var(--gilt-bright); }
  button#submit-btn:active{ transform: translateY(1px); }
  button#submit-btn:disabled{ opacity:0.55; cursor:not-allowed; }

  button#reset-btn{
    width:100%; margin-top:10px; background:transparent; color:var(--muted);
    border:1px solid var(--line); font-family:var(--font-ui); font-weight:600; font-size:12.5px;
    padding:9px; border-radius:6px; cursor:pointer;
  }
  button#reset-btn:hover{ color:var(--parchment); border-color:var(--line-bright); }

  .status-msg{
    margin-top:14px; font-size:12.5px; line-height:1.5; min-height:18px;
  }
  .status-msg[data-kind="error"]{ color: var(--danger); }
  .status-msg[data-kind="loading"]{ color: var(--gilt); }
  .status-msg[data-kind="ok"]{ color:#8fbf8a; }

  .tip{
    margin-top:22px; padding-top:16px; border-top:1px dashed var(--line);
    font-size:11.5px; color:var(--muted); line-height:1.6;
  }
  .tip b{ color:var(--gilt); font-weight:600; }

  /* ---------- Stage ---------- */
  .stage-head{ display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
  .live-indicator{ display:flex; align-items:center; gap:8px; font-family:var(--font-label);
    font-size:11px; letter-spacing:0.14em; text-transform:uppercase; color:var(--muted); }
  .dot{ width:8px; height:8px; border-radius:50%; background:#4a4f66; }
  .dot.on{ background:#e2604f; box-shadow:0 0 0 0 rgba(226,96,79,.6); animation:pulse 1.8s infinite; }
  @media (prefers-reduced-motion: reduce){ .dot.on{ animation:none; } }
  @keyframes pulse{
    0%{ box-shadow:0 0 0 0 rgba(226,96,79,.55); }
    70%{ box-shadow:0 0 0 10px rgba(226,96,79,0); }
    100%{ box-shadow:0 0 0 0 rgba(226,96,79,0); }
  }

  #card-wrap{
    position:relative; width:100%; aspect-ratio: 3.05 / 1; min-height:220px;
    border-radius:12px; overflow:hidden; background:var(--ink-3);
    border: 1px solid var(--line-bright);
    box-shadow: 0 24px 60px -20px rgba(0,0,0,0.6);
  }

  .empty-state{
    position:absolute; inset:0; display:flex; flex-direction:column; align-items:center;
    justify-content:center; gap:10px; color:#565b70; text-align:center; padding:20px;
  }
  .empty-state .glyph{ font-family:var(--font-label); font-size:26px; color:var(--line-bright); }
  .empty-state p{ margin:0; font-size:13px; max-width:320px; }

  .card-bg{
    position:absolute; inset:0; background-size:cover; background-position:center;
    filter:saturate(1.05);
    opacity:0; transition:opacity .5s ease;
  }
  .card-bg.show{ opacity:1; }

  .card-scrim{
    position:absolute; inset:0;
    background: linear-gradient(0deg, rgba(6,7,12,0.86) 0%, rgba(6,7,12,0.35) 42%, rgba(6,7,12,0.08) 62%, transparent 100%);
  }

  .card-frame{
    position:absolute; inset:7px; border:1px solid var(--line-bright); border-radius:8px;
    pointer-events:none;
  }
  .corner{ position:absolute; width:20px; height:20px; opacity:0.85; }
  .corner svg{ width:100%; height:100%; }
  .corner.tl{ top:-1px; left:-1px; }
  .corner.tr{ top:-1px; right:-1px; transform:scaleX(-1); }
  .corner.bl{ bottom:-1px; left:-1px; transform:scaleY(-1); }
  .corner.br{ bottom:-1px; right:-1px; transform:scale(-1,-1); }

  .ribbon{
    position:absolute; top:16px; right:16px; text-align:right;
    padding:7px 14px; border-radius:5px; color:#100a04;
    font-family:var(--font-label); font-weight:600; letter-spacing:0.08em; font-size:13px;
  }
  .ribbon small{ display:block; font-family:var(--font-ui); font-weight:600; letter-spacing:0.02em;
    font-size:9.5px; opacity:0.75; margin-top:1px; }

  .card-foot{
    position:absolute; left:18px; right:18px; bottom:14px;
    display:flex; align-items:flex-end; gap:14px;
  }
  .avatar-ring{
    width:64px; height:64px; border-radius:50%; flex:0 0 auto;
    border:2px solid var(--gilt); padding:2px; background:var(--ink-2);
    box-shadow:0 4px 14px rgba(0,0,0,0.45);
  }
  .avatar-ring img{ width:100%; height:100%; border-radius:50%; object-fit:cover; display:block; }
  .avatar-fallback{
    width:100%; height:100%; border-radius:50%; display:flex; align-items:center; justify-content:center;
    background:var(--ink-3); color:var(--gilt); font-family:var(--font-display); font-size:22px;
  }

  .name-block{ min-width:0; }
  .nickname{
    font-family:var(--font-display); font-size:24px; font-weight:600; color:var(--parchment);
    margin:0; line-height:1.15; text-shadow:0 2px 10px rgba(0,0,0,0.5);
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
  }
  .meta-line{
    margin-top:4px; display:flex; align-items:center; gap:8px; flex-wrap:wrap;
    font-family:var(--font-mono); font-size:12px; color:var(--gilt-bright);
  }
  .meta-line .sep{ color:var(--line-bright); }
  .meta-line .uid{ color:var(--muted); }

  footer.note{ margin-top:16px; font-size:11.5px; color:var(--muted); text-align:right; }
</style>
</head>
<body>
<div class="app">

  <header class="top">
    <div class="brand">
      <span class="mark">Status Joki</span>
      <h1>Live GI Namecard</h1>
    </div>
    <p>Ambil nickname, foto profil &amp; namecard dari UID Genshin Impact secara langsung.</p>
  </header>

  <div class="layout">

    <section class="panel" id="control-panel">
      <p class="zone-label">Panel Kontrol</p>
      <p class="zone-hint">Bagian ini untuk kamu isi. Kalau kamu window-capture halaman ini di OBS, panel ini juga akan kelihatan — lihat tips di bawah kalau mau menyembunyikannya dari penonton.</p>

      <form id="card-form">
        <div class="field">
          <label class="field-label" for="name">Nama Joki</label>
          <input id="uid" name="uid" type="text" autocomplete="off" placeholder="Contoh: OdetteMBG">
        </div>
      
        <div class="field">
          <label class="field-label" for="uid">UID Genshin Impact</label>
          <input id="uid" name="uid" type="text" inputmode="numeric" autocomplete="off"placeholder="Contoh: 618285856" maxlength="10">
        </div>

        <div class="field">
          <label class="field-label">Jenis Joki</label>
          <div class="segmented" id="category-group" role="radiogroup" aria-label="Jenis joki">
            <button type="button" class="seg-btn" data-cat="spiral" role="radio" aria-checked="true" aria-pressed="true">SPIRAL</button>
            <button type="button" class="seg-btn" data-cat="so" role="radio" aria-checked="false" aria-pressed="false">SO</button>
            <button type="button" class="seg-btn" data-cat="it" role="radio" aria-checked="false" aria-pressed="false">IT</button>
          </div>
        </div>

        <button type="submit" id="submit-btn">Tampilkan Namecard</button>
        <button type="button" id="reset-btn" hidden>Ganti Akun</button>
      </form>

      <p class="status-msg" id="status-msg" role="status" aria-live="polite"></p>

      <div class="tip">
        <b>Tip OBS:</b> pakai <b>Window Capture</b> pada tab browser ini, lalu tambahkan filter
        <b>Crop/Pad</b> untuk memotong bagian panel kontrol ini agar penonton hanya melihat
        panel "Tampilan Live" di sebelah kanan.
      </div>
    </section>

    <section class="panel" id="stage-panel">
      <div class="stage-head">
        <p class="zone-label" style="margin:0;">Tampilan Live</p>
        <div class="live-indicator"><span class="dot" id="live-dot"></span><span id="live-label">Menunggu Akun</span></div>
      </div>

      <div id="card-wrap">
        <div class="empty-state" id="empty-state">
          <div class="glyph">✦</div>
          <p>Masukkan UID dan pilih jenis joki di panel kontrol, lalu tekan <b>Tampilkan Namecard</b> atau Enter.</p>
        </div>

        <div class="card-bg" id="card-bg"></div>
        <div class="card-scrim" id="card-scrim" style="display:none;"></div>
        <div class="card-frame" id="card-frame" style="display:none;">
          <div class="corner tl"><svg viewBox="0 0 20 20"><path d="M1 1 H14 M1 1 V14" stroke="#ecca8c" stroke-width="1.5" fill="none"/></svg></div>
          <div class="corner tr"><svg viewBox="0 0 20 20"><path d="M1 1 H14 M1 1 V14" stroke="#ecca8c" stroke-width="1.5" fill="none"/></svg></div>
          <div class="corner bl"><svg viewBox="0 0 20 20"><path d="M1 1 H14 M1 1 V14" stroke="#ecca8c" stroke-width="1.5" fill="none"/></svg></div>
          <div class="corner br"><svg viewBox="0 0 20 20"><path d="M1 1 H14 M1 1 V14" stroke="#ecca8c" stroke-width="1.5" fill="none"/></svg></div>
        </div>

        <div class="ribbon" id="ribbon" style="display:none;"></div>

        <div class="card-foot" id="card-foot" style="display:none;">
          <div class="avatar-ring" id="avatar-ring"></div>
          <div class="name-block">
            <p class="nickname" id="nickname"></p>
            <div class="meta-line">
              <span id="ar-badge"></span>
              <span class="sep">·</span>
              <span class="uid" id="uid-display"></span>
            </div>
          </div>
        </div>
      </div>

      <footer class="note">Data diambil langsung dari Enka Network (basis data yang sama dipakai Akasha System).</footer>
    </section>

  </div>
</div>

<script>
const AVATAR_ICONS = {"10000002":"UI_AvatarIcon_Ayaka","10000003":"UI_AvatarIcon_Qin","10000005":"UI_AvatarIcon_PlayerBoy","10000006":"UI_AvatarIcon_Lisa","10000007":"UI_AvatarIcon_PlayerGirl","10000014":"UI_AvatarIcon_Barbara","10000015":"UI_AvatarIcon_Kaeya","10000016":"UI_AvatarIcon_Diluc","10000020":"UI_AvatarIcon_Razor","10000021":"UI_AvatarIcon_Ambor","10000022":"UI_AvatarIcon_Venti","10000023":"UI_AvatarIcon_Xiangling","10000024":"UI_AvatarIcon_Beidou","10000025":"UI_AvatarIcon_Xingqiu","10000026":"UI_AvatarIcon_Xiao","10000027":"UI_AvatarIcon_Ningguang","10000029":"UI_AvatarIcon_Klee","10000030":"UI_AvatarIcon_Zhongli","10000031":"UI_AvatarIcon_Fischl","10000032":"UI_AvatarIcon_Bennett","10000033":"UI_AvatarIcon_Tartaglia","10000034":"UI_AvatarIcon_Noel","10000035":"UI_AvatarIcon_Qiqi","10000036":"UI_AvatarIcon_Chongyun","10000037":"UI_AvatarIcon_Ganyu","10000038":"UI_AvatarIcon_Albedo","10000039":"UI_AvatarIcon_Diona","10000041":"UI_AvatarIcon_Mona","10000042":"UI_AvatarIcon_Keqing","10000043":"UI_AvatarIcon_Sucrose","10000044":"UI_AvatarIcon_Xinyan","10000045":"UI_AvatarIcon_Rosaria","10000046":"UI_AvatarIcon_Hutao","10000047":"UI_AvatarIcon_Kazuha","10000048":"UI_AvatarIcon_Feiyan","10000049":"UI_AvatarIcon_Yoimiya","10000050":"UI_AvatarIcon_Tohma","10000051":"UI_AvatarIcon_Eula","10000052":"UI_AvatarIcon_Shougun","10000053":"UI_AvatarIcon_Sayu","10000054":"UI_AvatarIcon_Kokomi","10000055":"UI_AvatarIcon_Gorou","10000056":"UI_AvatarIcon_Sara","10000057":"UI_AvatarIcon_Itto","10000058":"UI_AvatarIcon_Yae","10000059":"UI_AvatarIcon_Heizo","10000060":"UI_AvatarIcon_Yelan","10000061":"UI_AvatarIcon_Momoka","10000062":"UI_AvatarIcon_Aloy","10000063":"UI_AvatarIcon_Shenhe","10000064":"UI_AvatarIcon_Yunjin","10000065":"UI_AvatarIcon_Shinobu","10000066":"UI_AvatarIcon_Ayato","10000067":"UI_AvatarIcon_Collei","10000068":"UI_AvatarIcon_Dori","10000069":"UI_AvatarIcon_Tighnari","10000070":"UI_AvatarIcon_Nilou","10000071":"UI_AvatarIcon_Cyno","10000072":"UI_AvatarIcon_Candace","10000073":"UI_AvatarIcon_Nahida","10000074":"UI_AvatarIcon_Layla","10000075":"UI_AvatarIcon_Wanderer","10000076":"UI_AvatarIcon_Faruzan","10000077":"UI_AvatarIcon_Yaoyao","10000078":"UI_AvatarIcon_Alhatham","10000079":"UI_AvatarIcon_Dehya","10000080":"UI_AvatarIcon_Mika","10000081":"UI_AvatarIcon_Kaveh","10000082":"UI_AvatarIcon_Baizhuer","10000083":"UI_AvatarIcon_Linette","10000084":"UI_AvatarIcon_Liney","10000085":"UI_AvatarIcon_Freminet","10000086":"UI_AvatarIcon_Wriothesley","10000087":"UI_AvatarIcon_Neuvillette","10000088":"UI_AvatarIcon_Charlotte","10000089":"UI_AvatarIcon_Furina","10000090":"UI_AvatarIcon_Chevreuse","10000091":"UI_AvatarIcon_Navia","10000092":"UI_AvatarIcon_Gaming","10000093":"UI_AvatarIcon_Liuyun","10000094":"UI_AvatarIcon_Chiori","10000095":"UI_AvatarIcon_Sigewinne","10000096":"UI_AvatarIcon_Arlecchino","10000097":"UI_AvatarIcon_Sethos","10000098":"UI_AvatarIcon_Clorinde","10000099":"UI_AvatarIcon_Emilie","10000100":"UI_AvatarIcon_Kachina","10000101":"UI_AvatarIcon_Kinich","10000102":"UI_AvatarIcon_Mualani","10000103":"UI_AvatarIcon_Xilonen","10000104":"UI_AvatarIcon_Chasca","10000105":"UI_AvatarIcon_Olorun","10000106":"UI_AvatarIcon_Mavuika","10000107":"UI_AvatarIcon_Citlali","10000108":"UI_AvatarIcon_Lanyan","10000109":"UI_AvatarIcon_Mizuki","10000110":"UI_AvatarIcon_Iansan","10000111":"UI_AvatarIcon_Varesa","10000112":"UI_AvatarIcon_Escoffier","10000113":"UI_AvatarIcon_Ifa","10000114":"UI_AvatarIcon_SkirkNew","10000115":"UI_AvatarIcon_Dahlia","10000116":"UI_AvatarIcon_Ineffa","10000119":"UI_AvatarIcon_Lauma","10000120":"UI_AvatarIcon_Flins","10000121":"UI_AvatarIcon_Aino","10000122":"UI_AvatarIcon_Nefer","10000123":"UI_AvatarIcon_Durin","10000124":"UI_AvatarIcon_Jahoda","10000901":"UI_AvatarIcon_Mavuika","10000902":"UI_AvatarIcon_Hutao","10000903":"UI_AvatarIcon_Ineffa","10000904":"UI_AvatarIcon_Columbina","11000046":"UI_AvatarIcon_Qin","10000005-502":"UI_AvatarIcon_PlayerBoy","10000005-503":"UI_AvatarIcon_PlayerBoy","10000005-504":"UI_AvatarIcon_PlayerBoy","10000005-506":"UI_AvatarIcon_PlayerBoy","10000005-507":"UI_AvatarIcon_PlayerBoy","10000005-508":"UI_AvatarIcon_PlayerBoy","10000005-501":"UI_AvatarIcon_PlayerBoy","10000007-701":"UI_AvatarIcon_PlayerGirl","10000007-702":"UI_AvatarIcon_PlayerGirl","10000007-703":"UI_AvatarIcon_PlayerGirl","10000007-704":"UI_AvatarIcon_PlayerGirl","10000007-706":"UI_AvatarIcon_PlayerGirl","10000007-707":"UI_AvatarIcon_PlayerGirl","10000007-708":"UI_AvatarIcon_PlayerGirl"};
const NAMECARD_ICONS = {"210001":"UI_NameCardPic_0_P","210002":"UI_NameCardPic_Bp1_P","210003":"UI_NameCardPic_Ambor_P","210004":"UI_NameCardPic_Klee_P","210005":"UI_NameCardPic_Diluc_P","210006":"UI_NameCardPic_Razor_P","210007":"UI_NameCardPic_Venti_P","210008":"UI_NameCardPic_Qin_P","210009":"UI_NameCardPic_Barbara_P","210010":"UI_NameCardPic_Kaeya_P","210011":"UI_NameCardPic_Lisa_P","210012":"UI_NameCardPic_Sucrose_P","210013":"UI_NameCardPic_Fischl_P","210014":"UI_NameCardPic_Noel_P","210015":"UI_NameCardPic_Mona_P","210016":"UI_NameCardPic_Bennett_P","210017":"UI_NameCardPic_Xiangling_P","210018":"UI_NameCardPic_Xingqiu_P","210019":"UI_NameCardPic_Qiqi_P","210020":"UI_NameCardPic_Keqing_P","210021":"UI_NameCardPic_Csxy1_P","210022":"UI_NameCardPic_Mxsy_P","210023":"UI_NameCardPic_Yxzl_P","210024":"UI_NameCardPic_Md_P","210025":"UI_NameCardPic_Ly_P","210026":"UI_NameCardPic_Yszj_P","210027":"UI_NameCardPic_Sss_P","210028":"UI_NameCardPic_Tzz1_P","210029":"UI_NameCardPic_Sj1_P","210030":"UI_NameCardPic_Olah1_P","210031":"UI_NameCardPic_Zdg1_P","210032":"UI_NameCardPic_Lyws1_P","210033":"UI_NameCardPic_Ysxf1_P","210038":"UI_NameCardPic_Ningguang_P","210039":"UI_NameCardPic_Beidou_P","210040":"UI_NameCardPic_Chongyun_P","210041":"UI_NameCardPic_Tzz2_P","210042":"UI_NameCardPic_Bp2_P","210043":"UI_NameCardPic_Diona_P","210044":"UI_NameCardPic_Zhongli_P","210045":"UI_NameCardPic_Xinyan_P","210046":"UI_NameCardPic_Tartaglia_P","210047":"UI_NameCardPic_Md2_P","210048":"UI_NameCardPic_Md1_P","210049":"UI_NameCardPic_Ly1_P","210050":"UI_NameCardPic_Ly2_P","210051":"UI_NameCardPic_Tzz3_P","210052":"UI_NameCardPic_Xssdlk_P","210053":"UI_NameCardPic_Ganyu_P","210054":"UI_NameCardPic_Albedo_P","210055":"UI_NameCardPic_Bp3_P","210056":"UI_NameCardPic_ElderTree_P","210057":"UI_NameCardPic_EffigyChallenge_P","210058":"UI_NameCardPic_Xiao_P","210059":"UI_NameCardPic_Hutao_P","210060":"UI_NameCardPic_Bp4_P","210061":"UI_NameCardPic_LanternRite_P","210062":"UI_NameCardPic_TheatreMechanicus_P","210063":"UI_NameCardPic_Rosaria_P","210064":"UI_NameCardPic_Bp5_P","210065":"UI_NameCardPic_RedandWhite_P","210066":"UI_NameCardPic_Razer_P","210067":"UI_NameCardPic_ChannellerSlab_P","210068":"UI_NameCardPic_HideandSeek_P","210069":"UI_NameCardPic_Feiyan_P","210070":"UI_NameCardPic_Eula_P","210071":"UI_NameCardPic_Bp6_P","210072":"UI_NameCardPic_Homeworld_P","210073":"UI_NameCardPic_Kazuha_P","210074":"UI_NameCardPic_Bp7_P","210075":"UI_NameCardPic_Homeworld1_P","210076":"UI_NameCardPic_Google_P","210077":"UI_NameCardPic_BounceConjuringChallenge_P","210078":"UI_NameCardPic_EffigyChallenge02_P","210079":"UI_NameCardPic_Oraionokami_P","210080":"UI_NameCardPic_Bp8_P","210081":"UI_NameCardPic_Ayaka_P","210082":"UI_NameCardPic_Yoimiya_P","210083":"UI_NameCardPic_Sayu_P","210084":"UI_NameCardPic_Dq1_P","210085":"UI_NameCardPic_Dq2_P","210086":"UI_NameCardPic_Ysxf2_P","210087":"UI_NameCardPic_Csxy2_P","210088":"UI_NameCardPic_Tzz4_P","210089":"UI_NameCardPic_Homeworld2_P","210090":"UI_NameCardPic_Daoqi1_P","210091":"UI_NameCardPic_TheatreMechanicus2_P","210092":"UI_NameCardPic_Shougun_P","210093":"UI_NameCardPic_Kokomi_P","210094":"UI_NameCardPic_Sara_P","210095":"UI_NameCardPic_Aloy_P","210096":"UI_NameCardPic_Bp9_P","210097":"UI_NameCardPic_Daoqi2_P","210098":"UI_NameCardPic_Fishing_P","210099":"UI_NameCardPic_Concert_P","210100":"UI_NameCardPic_Sumo_P","210101":"UI_NameCardPic_Tohma_P","210102":"UI_NameCardPic_Bp10_P","210103":"UI_NameCardPic_Daoqi3_P","210104":"UI_NameCardPic_Gorou_P","210105":"UI_NameCardPic_Itto_P","210106":"UI_NameCardPic_Bp11_P","210107":"UI_NameCardPic_Shenhe_P","210108":"UI_NameCardPic_Yunjin_P","210109":"UI_NameCardPic_Daoqi4_P","210110":"UI_NameCardPic_Bp12_P","210111":"UI_NameCardPic_Bartender_P","210112":"UI_NameCardPic_Yae1_P","210113":"UI_NameCardPic_Bp13_P","210114":"UI_NameCardPic_Ayato_P","210115":"UI_NameCardPic_LuminanceStone_P","210116":"UI_NameCardPic_Tzz5_P","210117":"UI_NameCardPic_Cenyan1_P","210118":"UI_NameCardPic_Bp14_P","210119":"UI_NameCardPic_Yelan_P","210120":"UI_NameCardPic_Shinobu_P","210121":"UI_NameCardPic_Bp15_P","210122":"UI_NameCardPic_Heizo_P","210123":"UI_NameCardPic_Bp16_P","210124":"UI_NameCardPic_Tighnari_P","210125":"UI_NameCardPic_Collei_P","210126":"UI_NameCardPic_Dori_P","210127":"UI_NameCardPic_Bp17_P","210128":"UI_NameCardPic_Csxy3_P","210129":"UI_NameCardPic_Ysxf3_P","210130":"UI_NameCardPic_Xm1_P","210131":"UI_NameCardPic_Xumi1_P","210132":"UI_NameCardPic_Xumi2_P","210133":"UI_NameCardPic_Bp18_P","210134":"UI_NameCardPic_Cyno_P","210135":"UI_NameCardPic_Candace_P","210136":"UI_NameCardPic_Nilou_P","210137":"UI_NameCardPic_Yszj2_P","210138":"UI_NameCardPic_Xm2_P","210139":"UI_NameCardPic_Tzz6_P","210140":"UI_NameCardPic_Nahida_P","210141":"UI_NameCardPic_Layla_P","210142":"UI_NameCardPic_Bp19_P","210143":"UI_NameCardPic_Wanderer_P","210144":"UI_NameCardPic_Faruzan_P","210145":"UI_NameCardPic_Gcg1_P","210146":"UI_NameCardPic_Bp20_P","210147":"UI_NameCardPic_Alhatham_P","210148":"UI_NameCardPic_Yaoyao_P","210149":"UI_NameCardPic_Cadillac_P","210150":"UI_NameCardPic_Bp21_P","210151":"UI_NameCardPic_Xm3_P","210152":"UI_NameCardPic_Dehya_P","210153":"UI_NameCardPic_Mika_P","210154":"UI_NameCardPic_Bp22_P","210155":"UI_NameCardPic_Baizhuer_P","210156":"UI_NameCardPic_Kaveh_P","210157":"UI_NameCardPic_Xm4_P","210158":"UI_NameCardPic_Tzz7_P","210159":"UI_NameCardPic_Vasara_P","210160":"UI_NameCardPic_OfferingPari_P","210161":"UI_NameCardPic_Bp23_P","210162":"UI_NameCardPic_Kirara_P","210163":"UI_NameCardPic_Bp24_P","210164":"UI_NameCardPic_Bp25_P","210165":"UI_NameCardPic_Liney_P","210166":"UI_NameCardPic_Linette_P","210167":"UI_NameCardPic_Freminet_P","210168":"UI_NameCardPic_FD1_P","210169":"UI_NameCardPic_Ysxf4_P","210170":"UI_NameCardPic_Csxy4_P","210171":"UI_NameCardPic_Fontaine1_P","210172":"UI_NameCardPic_Fontaine2_P","210173":"UI_NameCardPic_Bp26_P","210174":"UI_NameCardPic_Neuvillette_P","210175":"UI_NameCardPic_Wriothesley_P","210176":"UI_NameCardPic_Bp27_P","210177":"UI_NameCardPic_Guqin_P","210178":"UI_NameCardPic_Tzz8_P","210179":"UI_NameCardPic_FD2_P","210180":"UI_NameCardPic_Furina_P","210181":"UI_NameCardPic_Charlotte_P","210182":"UI_NameCardPic_FD3_P","210183":"UI_NameCardPic_Bp28_P","210184":"UI_NameCardPic_Navia_P","210185":"UI_NameCardPic_Chevreuse_P","210186":"UI_NameCardPic_Bp29_P","210187":"UI_NameCardPic_Liuyun_P","210188":"UI_NameCardPic_Gaming_P","210189":"UI_NameCardPic_Chenyu1_P","210190":"UI_NameCardPic_OfferingSilong_P","210191":"UI_NameCardPic_Bp30_P","210192":"UI_NameCardPic_OST4_P","210193":"UI_NameCardPic_Chiori_P","210194":"UI_NameCardPic_Bp31_P","210195":"UI_NameCardPic_Arlecchino_P","210196":"UI_NameCardPic_Deep_P","210197":"UI_NameCardPic_Tzz9_P","210198":"UI_NameCardPic_WishingPond_P","210199":"UI_NameCardPic_GreatFestivalV2_P","210200":"UI_NameCardPic_Clorinde_P","210201":"UI_NameCardPic_Sigewinne_P","210202":"UI_NameCardPic_Sethos_P","210203":"UI_NameCardPic_RoleCombat_P","210204":"UI_NameCardPic_Bp33_P","210205":"UI_NameCardPic_Emilie_P","210206":"UI_NameCardPic_Bp34_P","210207":"UI_NameCardPic_RedandWhite2_P","210208":"UI_NameCardPic_Kinich_P","210209":"UI_NameCardPic_Mualani_P","210210":"UI_NameCardPic_Kachina_P","210211":"UI_NameCardPic_NatlanSW1_P","210212":"UI_NameCardPic_NatlanSW2_P","210213":"UI_NameCardPic_Ysxf5_P","210214":"UI_NameCardPic_RoleCombat2_P","210215":"UI_NameCardPic_Natlan1_P","210216":"UI_NameCardPic_Dfcq1_P","210217":"UI_NameCardPic_Bp35_P","210218":"UI_NameCardPic_Yellow_P","210219":"UI_NameCardPic_Xilonen_P","210220":"UI_NameCardPic_Bp36_P","210221":"UI_NameCardPic_Chasca_P","210222":"UI_NameCardPic_Olorun_P","210223":"UI_NameCardPic_Natlan2_P","210224":"UI_NameCardPic_Dfcq2_P","210225":"UI_NameCardPic_Bp37_P","210226":"UI_NameCardPic_Mavuika_P","210227":"UI_NameCardPic_Citlali_P","210228":"UI_NameCardPic_Lanyan_P","210229":"UI_NameCardPic_Csxy5_P","210230":"UI_NameCardPic_Tzz10_P","210231":"UI_NameCardPic_MusicGame01_P","210232":"UI_NameCardPic_Bp38_P","210233":"UI_NameCardPic_Mizuki_P","210234":"UI_NameCardPic_TowerChallenge_P","210235":"UI_NameCardPic_Bp39_P","210236":"UI_NameCardPic_Varesa_P","210237":"UI_NameCardPic_Iansan_P","210238":"UI_NameCardPic_Natlan3_P","210239":"UI_NameCardPic_Dfcq3_P","210240":"UI_NameCardPic_Bp40_P","210241":"UI_NameCardPic_Escoffier_P","210242":"UI_NameCardPic_Ifa_P","210243":"UI_NameCardPic_Bp41_P","210244":"UI_NameCardPic_SkirkNew_P","210245":"UI_NameCardPic_Dahlia_P","210246":"UI_NameCardPic_RedandWhite3_P","210247":"UI_NameCardPic_Bp42_P","210248":"UI_NameCardPic_Ineffa_P","210249":"UI_NameCardPic_NatlanOffering_P","210250":"UI_NameCardPic_Natlan4_P","210251":"UI_NameCardPic_Bp43_P","210252":"UI_NameCardPic_Event58_P","210253":"UI_NameCardPic_Lauma_P","210254":"UI_NameCardPic_Flins_P","210255":"UI_NameCardPic_Aino_P","210256":"UI_NameCardPic_NodKraiOffering1_P","210257":"UI_NameCardPic_NodKrai1_P","210258":"UI_NameCardPic_Ysxf6_P","210259":"UI_NameCardPic_Bp44_P","210260":"UI_NameCardPic_YellowV2_P","210261":"UI_NameCardPic_Nefer_P","210262":"UI_NameCardPic_Bp45_P","210263":"UI_NameCardPic_Durin_P","210264":"UI_NameCardPic_Jahoda_P","210265":"UI_NameCardPic_Bp46_P","210266":"UI_NameCardPic_Green_P"};
const DEFAULT_NAMECARD_ICON = "UI_NameCardPic_0_P";
const ENKA_UI_BASE = "https://enka.network/ui/";
const ENKA_API_BASE = "https://enka.network/api/uid/";

const CATEGORY = {
  spiral: { label: "JOKI SPIRAL", sub: "Spiral Abyss", varName: "--spiral" },
  so:     { label: "JOKI SO",     sub: "Stygian Onslaught", varName: "--so" },
  it:     { label: "JOKI IT",     sub: "Imaginarium Theater", varName: "--it" },
};

let currentCategory = "spiral";

const els = {
  form: document.getElementById("card-form"),
  uid: document.getElementById("uid"),
  segGroup: document.getElementById("category-group"),
  submitBtn: document.getElementById("submit-btn"),
  resetBtn: document.getElementById("reset-btn"),
  status: document.getElementById("status-msg"),
  emptyState: document.getElementById("empty-state"),
  cardBg: document.getElementById("card-bg"),
  cardScrim: document.getElementById("card-scrim"),
  cardFrame: document.getElementById("card-frame"),
  ribbon: document.getElementById("ribbon"),
  cardFoot: document.getElementById("card-foot"),
  avatarRing: document.getElementById("avatar-ring"),
  nickname: document.getElementById("nickname"),
  arBadge: document.getElementById("ar-badge"),
  uidDisplay: document.getElementById("uid-display"),
  liveDot: document.getElementById("live-dot"),
  liveLabel: document.getElementById("live-label"),
};

els.segGroup.addEventListener("click", (e) => {
  const btn = e.target.closest(".seg-btn");
  if (!btn) return;
  currentCategory = btn.dataset.cat;
  [...els.segGroup.children].forEach((b) => {
    const on = b === btn;
    b.setAttribute("aria-pressed", on);
    b.setAttribute("aria-checked", on);
  });
});

els.form.addEventListener("submit", (e) => {
  e.preventDefault();
  handleSubmit();
});

els.resetBtn.addEventListener("click", () => {
  els.uid.value = "";
  setStatus("", null);
  showEmptyState();
  els.resetBtn.hidden = true;
  els.uid.focus();
});

function setStatus(msg, kind) {
  els.status.textContent = msg;
  if (kind) { els.status.dataset.kind = kind; } else { delete els.status.dataset.kind; }
}

function showEmptyState() {
  els.emptyState.style.display = "flex";
  els.cardBg.classList.remove("show");
  els.cardScrim.style.display = "none";
  els.cardFrame.style.display = "none";
  els.ribbon.style.display = "none";
  els.cardFoot.style.display = "none";
  els.liveDot.classList.remove("on");
  els.liveLabel.textContent = "Menunggu Akun";
}

async function handleSubmit() {
  const rawUid = els.uid.value.trim();
  if (!/^\d{6,10}$/.test(rawUid)) {
    setStatus("Format UID tidak valid. UID Genshin biasanya 6–10 digit angka.", "error");
    return;
  }

  els.submitBtn.disabled = true;
  setStatus("Mengambil data dari Enka Network…", "loading");

  try {
    const res = await fetch(`${ENKA_API_BASE}${rawUid}/?info`, { cache: "no-store" });

    if (!res.ok) {
      setStatus(mapHttpError(res.status), "error");
      els.submitBtn.disabled = false;
      return;
    }

    const data = await res.json();
    const info = data.playerInfo;
    if (!info) {
      setStatus("Data pemain tidak ditemukan untuk UID ini.", "error");
      els.submitBtn.disabled = false;
      return;
    }

    renderCard(info, rawUid, currentCategory);
    setStatus(`Berhasil dimuat: ${info.nickname ?? "Traveler"}.`, "ok");
    els.resetBtn.hidden = false;
  } catch (err) {
    setStatus("Gagal menghubungi Enka Network. Cek koneksi internet kamu (atau coba jalankan file ini lewat local server bila dibuka sebagai file lokal).", "error");
  } finally {
    els.submitBtn.disabled = false;
  }
}

function mapHttpError(status) {
  switch (status) {
    case 400: return "Format UID salah menurut server.";
    case 404: return "UID tidak ditemukan.";
    case 424: return "Game sedang maintenance / update, coba lagi nanti.";
    case 429: return "Terlalu banyak permintaan beruntun, tunggu sebentar lalu coba lagi.";
    case 500:
    case 503: return "Server Enka sedang bermasalah, coba lagi sebentar lagi.";
    default: return `Terjadi kesalahan (kode ${status}).`;
  }
}

function renderCard(info, uid, categoryKey) {
  const nickname = info.nickname || "Traveler";
  const ar = info.level;
  const nameCardId = String(info.nameCardId ?? info.namecardId ?? "");
  const namecardIcon = NAMECARD_ICONS[nameCardId] || DEFAULT_NAMECARD_ICON;
  const bgUrl = ENKA_UI_BASE + namecardIcon + ".png";

  const avatarId = info.profilePicture && info.profilePicture.avatarId != null
    ? String(info.profilePicture.avatarId) : null;
  const avatarIcon = avatarId ? AVATAR_ICONS[avatarId] : null;

  els.emptyState.style.display = "none";

  els.cardBg.style.backgroundImage = `url("${bgUrl}")`;
  requestAnimationFrame(() => els.cardBg.classList.add("show"));
  els.cardScrim.style.display = "block";
  els.cardFrame.style.display = "block";

  const cat = CATEGORY[categoryKey] || CATEGORY.spiral;
  els.ribbon.style.display = "block";
  els.ribbon.style.background = `var(${cat.varName})`;
  els.ribbon.innerHTML = `${cat.label}<small>${cat.sub}</small>`;

  els.avatarRing.innerHTML = "";
  if (avatarIcon) {
    const img = document.createElement("img");
    img.src = ENKA_UI_BASE + avatarIcon + ".png";
    img.alt = nickname;
    img.onerror = () => { els.avatarRing.innerHTML = fallbackAvatarHtml(nickname); };
    els.avatarRing.appendChild(img);
  } else {
    els.avatarRing.innerHTML = fallbackAvatarHtml(nickname);
  }

  els.nickname.textContent = nickname;
  els.nickname.title = nickname;
  els.arBadge.textContent = ar != null ? `AR ${ar}` : "";
  els.uidDisplay.textContent = `UID ${uid}`;
  els.cardFoot.style.display = "flex";

  els.liveDot.classList.add("on");
  els.liveLabel.textContent = "Sedang Dikerjakan";
}

function fallbackAvatarHtml(nickname) {
  const initial = (nickname || "?").trim().charAt(0).toUpperCase() || "?";
  return `<div class="avatar-fallback">${initial}</div>`;
}
</script>
</body>
</html>
