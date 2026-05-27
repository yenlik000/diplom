<template>
  <div class="page">

    <!-- ── Announcement bar ───────────────────────────────── -->
    <!-- <div v-if="showBar" class="announce-bar">
      <span>⚡ {{ t('landing.announcement') }}</span>
      <button class="bar-close" @click="showBar = false">✕</button>
    </div> -->

    <!-- ── Header ─────────────────────────────────────────── -->
    <header class="header">
      <div v-if="showBar" class="announce-bar">
        <span> 🚀 {{ t('landing.announcement') }}</span>
        <button class="bar-close" @click="showBar = false">✕</button>
      </div>
      <div class="header-inner">
        <RouterLink to="/" class="logo">
          <img src="@/assets/logo.png" alt="Bridge" class="logo-img" />
        </RouterLink>

        <nav class="nav">
          <RouterLink to="/" class="nav-link">{{ t('header.home') }}</RouterLink>
          <RouterLink to="/courses" class="nav-link">{{ t('header.courses') }}</RouterLink>
          <RouterLink to="/about" class="nav-link">{{ t('header.about') }}</RouterLink>
          <RouterLink v-if="auth.isLoggedIn" :to="auth.dashboardRoute()" class="nav-link">{{ t('header.myLearning') }}</RouterLink>
          <RouterLink to="/founder" class="nav-link">{{ t('about.navFounder') }}</RouterLink>
          <div class="lang-switcher" @click.stop="langOpen = !langOpen" v-click-outside="() => langOpen = false">
            <span class="lang-current">
              {{ langs.find(l => l.code === locale)?.label ?? 'EN' }}
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" :style="{ transform: langOpen ? 'rotate(180deg)' : '', transition: 'transform .2s' }"><path d="M6 9l6 6 6-6"/></svg>
            </span>
            <div v-if="langOpen" class="lang-dropdown">
              <button v-for="lang in langs" :key="lang.code"
                class="lang-option" :class="{ active: locale === lang.code }"
                @click.stop="switchLang(lang.code); langOpen = false">{{ lang.label }}</button>
            </div>
          </div>
        </nav>

        <div class="header-actions">
          <template v-if="auth.isLoggedIn">
            <RouterLink :to="auth.dashboardRoute()"><button class="btn-outline">{{ t('header.cabinet') }}</button></RouterLink>
            <button class="btn-solid" @click="handleLogout">{{ t('header.logout') }}</button>
          </template>
          <template v-else>
            <RouterLink to="/login"><button class="btn-solid">{{ t('header.login') }}</button></RouterLink>
          </template>
        </div>
      </div>
    </header>

    <!-- ── Hero ───────────────────────────────────────────── -->
    <section class="hero">
      <!-- floating avatars -->
      <div class="avatar av-tl"><img src="@/assets/image.png"  alt="" /></div>
      <div class="avatar av-tr"><img src="@/assets/image3.png" alt="" /></div>
      <div class="avatar av-bl"><img src="@/assets/image4.png" alt="" /></div>
      <div class="avatar av-br"><img src="@/assets/image2.png" alt="" /></div>

      <!-- yellow decorations -->
      <svg class="deco deco-diamond-l" width="35" height="35" viewBox="0 0 40 40" fill="none"><path d="M20 0C23.4287 9.26581 30.7342 16.5713 40 20C30.7342 23.4287 23.4287 30.7342 20 40C16.5713 30.7342 9.26581 23.4287 0 20C9.26581 16.5713 16.5713 9.26581 20 0Z" fill="#FFD700"/></svg>
      <svg class="deco deco-star-r" width="35" height="35" viewBox="0 0 40 40" fill="none"><path d="M20 0L20.9699 13.8763L26.1803 0.97887L22.8147 14.4758L31.7557 3.81966L24.3841 15.6159L36.1803 8.2443L25.5242 17.1853L39.0211 13.8197L26.1237 19.0301L40 20L26.1237 20.9699L39.0211 26.1803L25.5242 22.8147L36.1803 31.7557L24.3841 24.3841L31.7557 36.1803L22.8147 25.5242L26.1803 39.0211L20.9699 26.1237L20 40L19.0301 26.1237L13.8197 39.0211L17.1853 25.5242L8.2443 36.1803L15.6159 24.3841L3.81966 31.7557L14.4758 22.8147L0.97887 26.1803L13.8763 20.9699L0 20L13.8763 19.0301L0.97887 13.8197L14.4758 17.1853L3.81966 8.2443L15.6159 15.6159L8.2443 3.81966L17.1853 14.4758L13.8197 0.97887L19.0301 13.8763L20 0Z" fill="#FFD700"/></svg>

      <div class="hero-body">
        <h1 class="hero-title">
          {{ t('about.heroLine1') }}<br/>
          {{ t('about.heroLine2') }}
          <span class="highlight">
            {{ t('about.heroWord') }}
            <svg class="wave" viewBox="0 0 248 11" fill="none" preserveAspectRatio="none">
              <path d="M8.73613 0.143464L2.62132 1.33984C2.22525 1.41733 1.86189 1.61283 1.57899 1.90065L0.573642 2.92349C-0.241225 3.75253 -0.180051 5.09923 0.706624 5.85097L1.45364 6.48432C1.81497 6.79066 2.2733 6.9588 2.74701 6.9588H6.1415H11.0849C11.3258 6.9588 11.5647 7.00232 11.7901 7.08726L16.18 8.74142C16.5559 8.88305 16.9657 8.90823 17.3561 8.81366L24.7812 7.01502C24.9354 6.97767 25.0935 6.9588 25.2521 6.9588H32.68H38.3541C38.5025 6.9588 38.6504 6.97531 38.7952 7.00804L47.0459 8.87342C47.2953 8.92982 47.5533 8.93785 47.8058 8.89707L59.52 7.00533C59.7111 6.97447 59.9057 6.97152 60.0976 6.99655L75.1415 8.9588H87.3286C87.46 8.9588 87.591 8.97175 87.7198 8.99745L97.1483 10.8783C97.4145 10.9314 97.6887 10.9298 97.9542 10.8735L106.783 9.00227C106.919 8.97337 107.057 8.95867 107.196 8.95924C109.038 8.96678 112.567 9.07391 113.475 9.4588C114.389 9.84633 124.234 8.07503 129.495 7.05485C129.818 6.99206 130.153 7.00965 130.468 7.10683L135.886 8.77714C136.27 8.8955 136.68 8.8955 137.064 8.77714L142.418 7.1264C142.774 7.01684 143.153 7.00853 143.512 7.1024L150.38 8.89404C150.545 8.93704 150.715 8.9588 150.885 8.9588H165.794C165.906 8.9588 166.018 8.94939 166.128 8.93065L177.591 6.98695C177.701 6.96822 177.813 6.9588 177.925 6.9588H192.834C193.004 6.9588 193.174 6.98057 193.338 7.02357L200.177 8.80756C200.555 8.90622 200.954 8.8919 201.324 8.76637L205.933 7.20348C206.398 7.04588 206.904 7.06463 207.356 7.25615L210.779 8.70734C211.165 8.87084 211.592 8.9091 212.001 8.81672L219.814 7.05017C220.081 6.9899 220.357 6.98491 220.626 7.03552L230.372 8.87178C230.676 8.92901 230.989 8.91505 231.286 8.83097L237.644 7.03418C237.821 6.98417 238.004 6.9588 238.188 6.9588H247.077C248.105 6.9588 248.37 5.53506 247.411 5.16535L247.205 5.08618C246.556 4.83588 246.49 3.94282 247.096 3.60033C247.771 3.21871 247.593 2.20062 246.829 2.07096L243.42 1.49303C243.286 1.47027 243.15 1.46127 243.014 1.46618L216.154 2.43522C215.729 2.45054 215.311 2.33023 214.959 2.09171L213.256 0.936664C212.806 0.631343 212.251 0.522537 211.719 0.635321L203.732 2.32829C203.331 2.41324 202.914 2.37305 202.536 2.21313L201.405 1.73333C200.985 1.55565 200.518 1.52628 200.08 1.6501L198.055 2.22242C197.521 2.37319 196.949 2.29574 196.475 2.00855L193.705 0.330923C193.307 0.0903653 192.839 -0.00446293 192.379 0.0627063L177.058 2.30232C176.39 2.39996 175.718 2.15409 175.271 1.6485L174.911 1.24149C174.477 0.751147 173.831 0.504136 173.181 0.580176L158.808 2.26096C158.233 2.32818 157.888 1.64084 158.285 1.21991C158.684 0.796437 158.333 0.105537 157.755 0.179721L140.673 2.37404C140.245 2.42907 139.81 2.34397 139.434 2.13147L137.122 0.824376C136.704 0.588533 136.216 0.510381 135.746 0.604148L127.535 2.24217C126.86 2.37695 126.162 2.1545 125.689 1.6534L124.788 0.698544C124.35 0.233709 123.715 0.00648549 123.081 0.0871134L112.489 1.43422C112.36 1.45057 112.23 1.45439 112.101 1.44562L97.9855 0.48822C97.6997 0.468834 97.413 0.511079 97.1449 0.612095L92.7728 2.25955C92.4271 2.38984 92.052 2.42179 91.6892 2.35189L79.7083 0.0433071C79.4194 -0.0123447 79.1219 -0.00360762 78.8369 0.0688957L74.0254 1.29268C73.6017 1.40045 73.1543 1.36641 72.7518 1.19578L71.7147 0.756145C71.2629 0.564628 70.7565 0.545884 70.2918 0.70348L68.6289 1.26744C68.3001 1.37893 67.9382 1.24457 67.7619 0.945566C67.5927 0.658719 67.2515 0.521921 66.931 0.612486L64.7355 1.23295C64.3346 1.34627 63.9364 1.04501 63.9364 0.628325C63.9364 0.265637 63.6302 -0.0217274 63.2682 0.00128835L40.6881 1.43709C40.4621 1.45146 40.2353 1.42733 40.0173 1.36573L37.1391 0.552322C36.9201 0.490429 36.6921 0.46637 36.465 0.481181L21.9376 1.42862C21.687 1.44496 21.4748 1.24614 21.4748 0.995045C21.4748 0.718821 21.2205 0.512716 20.9502 0.569991L17.4654 1.30862C17.1005 1.38598 16.7569 1.1076 16.7569 0.734507C16.7569 0.345307 16.3849 0.0639142 16.0104 0.16976L12.4741 1.16915C11.8334 1.35022 11.1446 1.2006 10.6368 0.770048L10.4135 0.580735C9.94989 0.187655 9.33266 0.0267517 8.73613 0.143464Z" fill="#FFD700"/>
            </svg>
          </span>
        </h1>
        <RouterLink to="/courses">
          <button class="btn-explore">{{ t('about.exploreCourses') }}</button>
        </RouterLink>
      </div>
    </section>

    <!-- ── Space / CTA ─────────────────────────────────────── -->
    <section class="space-section">
      <img src="@/assets/second.png" alt="" class="space-img" />
      <div class="space-text">
        <h2>{{ t('about.spaceTitle1') }}<br/>{{ t('about.spaceTitle2') }}</h2>
        <p>{{ t('about.spaceDesc') }}</p>
      </div>
    </section>

    <!-- ── Team ───────────────────────────────────────────── -->
    <section class="team-section">
      <span class="team-badge">{{ t('about.teamBadge') }}</span>
      <h2 class="team-title">{{ t('about.teamTitle') }}</h2>
      <p class="team-sub">{{ t('about.teamDesc') }}</p>

      <div class="mentors-grid">
        <div v-for="m in mentors" :key="m.name" class="mentor-card">
          <div class="mentor-photo" :style="{ background: m.bg }">
            <img :src="m.img" :alt="m.name" />
          </div>
          <div class="mentor-info">
            <div class="mentor-name">{{ m.name }}</div>
            <div class="mentor-role">{{ m.role }}</div>
            <div class="mentor-stats">
              <span class="stat-star">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M8.10361 2.03003L10.0507 5.97523L14.4045 6.6079L11.2541 9.67881L11.9978 14.015L8.10361 11.9677L4.20945 14.015L4.95319 9.67881L1.80273 6.60789L6.15655 5.97523L8.10361 2.03003Z" fill="#FFD700"/><path d="M7.72559 2.25076C8.02367 2.85471 8.32175 3.45868 8.61981 4.06264C8.96522 4.76251 9.31064 5.46237 9.65604 6.16224C9.78372 6.42095 10.045 6.41314 10.2873 6.44834C10.7042 6.50893 11.1212 6.56951 11.5382 6.6301C12.4009 6.75546 13.2635 6.88082 14.1262 7.00618C14.1802 7.01401 14.2341 7.02185 14.288 7.02968C14.2236 6.78593 14.1593 6.5422 14.0949 6.29845C13.6126 6.76856 13.1304 7.23868 12.648 7.70879C12.0892 8.25356 11.5303 8.79832 10.9714 9.34312C10.9082 9.4047 10.8563 9.47376 10.832 9.56242C10.8066 9.65462 10.8229 9.74212 10.8383 9.83209C10.8558 9.93401 10.8733 10.036 10.8907 10.1379C10.9616 10.5511 11.0325 10.9644 11.1034 11.3777C11.2512 12.2397 11.3991 13.1018 11.5469 13.9638C11.5565 14.0196 11.5661 14.0754 11.5757 14.1312C11.7899 13.9666 12.0041 13.8019 12.2183 13.6372C11.6222 13.3238 11.026 13.0104 10.4299 12.6969C9.73909 12.3338 9.04826 11.9706 8.35745 11.6074C8.27775 11.5655 8.19756 11.5302 8.10334 11.5302C8.00912 11.5302 7.92894 11.5655 7.84923 11.6074C7.7577 11.6555 7.66615 11.7037 7.57462 11.7518C7.2035 11.9469 6.83236 12.142 6.46123 12.3371C5.68708 12.7441 4.9129 13.1511 4.13875 13.5581C4.08862 13.5845 4.0385 13.6108 3.98837 13.6372C4.20261 13.8019 4.41683 13.9666 4.63106 14.1313C4.74492 13.4674 4.85876 12.8036 4.97262 12.1398C5.10456 11.3706 5.23648 10.6014 5.36842 9.83212C5.38386 9.74215 5.40014 9.65467 5.37478 9.56245C5.35039 9.47379 5.29851 9.40473 5.23534 9.34315C5.16128 9.27096 5.08723 9.19878 5.01317 9.12659C4.71292 8.83392 4.41267 8.54123 4.11242 8.24857C3.48611 7.63807 2.85979 7.02756 2.23348 6.41706C2.19294 6.37753 2.15239 6.33799 2.11183 6.29848C2.04748 6.54223 1.98312 6.78596 1.91878 7.02971C2.58529 6.93285 3.25179 6.83601 3.91831 6.73917C4.69065 6.62693 5.46301 6.51471 6.23537 6.40248C6.50225 6.36371 6.58931 6.08406 6.69197 5.87604C6.87843 5.49821 7.0649 5.12037 7.25137 4.74254C7.63718 3.96082 8.02298 3.17909 8.40878 2.39737C8.43289 2.34853 8.457 2.29967 8.48111 2.25082C8.58665 2.03696 8.54051 1.77896 8.32415 1.65223C8.12945 1.53818 7.83106 1.59545 7.72558 1.80918C7.4275 2.41314 7.12943 3.0171 6.83137 3.62106C6.48597 4.32093 6.14058 5.02079 5.79517 5.72067C5.78962 5.73192 5.78408 5.74315 5.77853 5.75438C5.86568 5.68737 5.95284 5.62035 6.04 5.55332C5.37348 5.65018 4.70698 5.74703 4.04047 5.84387C3.26812 5.9561 2.49576 6.06832 1.7234 6.18056C1.711 6.18235 1.69859 6.18415 1.68619 6.18596C1.54081 6.20709 1.41717 6.35862 1.38061 6.49154C1.33961 6.6406 1.38179 6.80868 1.49312 6.9172C1.97542 7.38732 2.4577 7.85743 2.94 8.32756C3.49889 8.87232 4.05776 9.4171 4.61664 9.96189C4.62562 9.97064 4.63459 9.97939 4.64358 9.98814C4.60608 9.84624 4.56856 9.70437 4.53106 9.56248C4.4172 10.2263 4.30336 10.8901 4.1895 11.5539C4.05756 12.3232 3.92562 13.0924 3.7937 13.8616C3.79158 13.874 3.78947 13.8863 3.78734 13.8987C3.7602 14.0569 3.78123 14.2057 3.89986 14.3243C4.04353 14.468 4.25486 14.4848 4.43003 14.3927C5.02617 14.0793 5.62231 13.7659 6.21845 13.4525C6.90926 13.0893 7.60008 12.7262 8.29089 12.363C8.30198 12.3572 8.31308 12.3513 8.32417 12.3455C8.17697 12.3455 8.02975 12.3455 7.88254 12.3455C8.4787 12.6589 9.07484 12.9723 9.67098 13.2857C10.3618 13.6489 11.0526 14.0121 11.7434 14.3753C11.7545 14.3811 11.7656 14.3869 11.7767 14.3927C11.9169 14.4664 12.0787 14.4746 12.2184 14.3927C12.4001 14.2863 12.4531 14.0949 12.4194 13.8987C12.3056 13.2349 12.1917 12.571 12.0779 11.9072C11.9459 11.138 11.814 10.3688 11.6821 9.59954C11.68 9.58718 11.6778 9.57484 11.6757 9.56248C11.6382 9.70437 11.6007 9.84624 11.5632 9.98814C12.0455 9.51803 12.5278 9.0479 13.0101 8.57779C13.569 8.03303 14.1278 7.48824 14.6867 6.94348C14.6957 6.93473 14.7047 6.92598 14.7137 6.91723C14.825 6.80873 14.8672 6.64064 14.8262 6.49157C14.7896 6.35867 14.666 6.20712 14.5206 6.18599C13.8541 6.08915 13.1876 5.99229 12.5211 5.89545C11.7487 5.78321 10.9764 5.67098 10.204 5.55874C10.1916 5.55695 10.1792 5.55515 10.1668 5.55334C10.2539 5.62037 10.3411 5.68739 10.4282 5.7544C10.1302 5.15045 9.83209 4.54648 9.53403 3.94253C9.18862 3.24265 8.8432 2.54279 8.49779 1.84292C8.49226 1.83167 8.4867 1.82043 8.48115 1.80918C8.37567 1.59545 8.07728 1.53818 7.88258 1.65223C7.6662 1.77892 7.62004 2.0369 7.72559 2.25076Z" fill="#FFD700"/></svg>
                {{ m.rating }}
              </span>
              <span class="stat-sep">|</span>
              <span class="stat-courses">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M2.66663 7.99989V5.62656C2.66663 2.67989 4.75329 1.47322 7.30663 2.94656L9.36663 4.13322L11.4266 5.31989C13.98 6.79322 13.98 9.20656 11.4266 10.6799L9.36663 11.8666L7.30663 13.0532C4.75329 14.5266 2.66663 13.3199 2.66663 10.3732V7.99989Z" stroke="#141219" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ m.courses }} {{ t('about.teamCourses') }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Divider ─────────────────────────────────────────── -->
    <div class="hr"></div>

    <!-- ── Start Learning ─────────────────────────────────── -->
    <section class="learn-section">
      <div class="learn-inner">

        <!-- left: photo collage -->
        <div class="collage">
          <div class="collage-badge badge-best">
            <span class="cb-icon-wrap">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18 7.16C17.94 7.15 17.87 7.15 17.81 7.16C16.43 7.11 15.33 5.98 15.33 4.58C15.33 3.15 16.48 2 17.91 2C19.34 2 20.49 3.16 20.49 4.58C20.48 5.98 19.38 7.11 18 7.16Z" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M16.97 14.4399C18.34 14.6699 19.85 14.4299 20.91 13.7199C22.32 12.7799 22.32 11.2399 20.91 10.2999C19.84 9.58992 18.31 9.34991 16.94 9.58991" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M5.96998 7.16C6.02998 7.15 6.09998 7.15 6.15998 7.16C7.53998 7.11 8.63998 5.98 8.63998 4.58C8.63998 3.15 7.48998 2 6.05998 2C4.62998 2 3.47998 3.16 3.47998 4.58C3.48998 5.98 4.58998 7.11 5.96998 7.16Z" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M7 14.4399C5.63 14.6699 4.12 14.4299 3.06 13.7199C1.65 12.7799 1.65 11.2399 3.06 10.2999C4.13 9.58992 5.66 9.34991 7.03 9.58991" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 14.63C11.94 14.62 11.87 14.62 11.81 14.63C10.43 14.58 9.32996 13.45 9.32996 12.05C9.32996 10.62 10.48 9.46997 11.91 9.46997C13.34 9.46997 14.49 10.63 14.49 12.05C14.48 13.45 13.38 14.59 12 14.63Z" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9.08997 17.7799C7.67997 18.7199 7.67997 20.2599 9.08997 21.1999C10.69 22.2699 13.31 22.2699 14.91 21.1999C16.32 20.2599 16.32 18.7199 14.91 17.7799C13.32 16.7199 10.69 16.7199 9.08997 17.7799Z" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            <span class="cb-text"><strong>BEST</strong><br/>Mentors</span>
          </div>

          <img :src="irek2" alt="" class="col-img col-img--left" />
          <img :src="irek1" alt="" class="col-img col-img--right" />

          <div class="collage-badge badge-video">
            <span class="cb-icon-wrap">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 5C15 5 17 5.625 17 12C17 18.375 15.5 19 10 19C4.5 19 3 18 3 12C3 6 4.5 5 10 5Z" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17 8.76613C20 6.01346 21 6.01345 21 12.1383C21 17.8981 20 17.8981 17 15.4455" stroke="#FF393F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </span>
            <span class="cb-text"><strong>VIDEO</strong><br/>Lessons</span>
          </div>
        </div>

        <!-- right: text -->
        <div class="learn-text">
          <h2 class="learn-title">{{ t('about.learnTitle1') }}<br/>{{ t('about.learnTitle2') }}<br/>{{ t('about.learnTitle3') }}</h2>
          <p class="learn-desc">{{ t('about.learnDesc') }}</p>

          <div class="checklist">
            <div class="check-item">
              <span class="check-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="#e53030" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              {{ t('about.check1') }}
            </div>
            <div class="check-item">
              <span class="check-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="#e53030" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              {{ t('about.check2') }}
            </div>
            <div class="check-item">
              <span class="check-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="#e53030" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              {{ t('about.check3') }}
            </div>
            <div class="check-item">
              <span class="check-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="#e53030" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              {{ t('about.check4') }}
            </div>
          </div>

          <RouterLink to="/courses">
            <button class="btn-start">{{ t('about.learnBtn') }}</button>
          </RouterLink>
        </div>

      </div>
    </section>

    <!-- ── Footer ─────────────────────────────────────────── -->
    <footer class="footer">
      <div class="footer-top">
        <RouterLink to="/" class="footer-logo">
          <img src="@/assets/logo.png" alt="Bridge" class="footer-logo-img" />
        </RouterLink>

        <nav class="footer-nav">
          <RouterLink to="/">{{ t('header.home') }}</RouterLink>
          <span>{{ t('header.courses') }}</span>
          <RouterLink to="/">{{ t('about.footerContact') }}</RouterLink>
          <RouterLink to="/dashboard">{{ t('header.myLearning') }}</RouterLink>
        </nav>
      </div>

      <div class="footer-bottom">
        <span class="footer-copy">{{ t('about.footerCopy') }}</span>
        <div class="footer-social">
          <a href="#" aria-label="YouTube">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.812 5.01711H6.145C3.855 5.01711 2 6.85211 2 9.11611V14.8841C2 17.1481 3.856 18.9841 6.145 18.9841H17.812C20.102 18.9841 21.957 17.1481 21.957 14.8841V9.11611C21.957 6.85211 20.101 5.01611 17.812 5.01611V5.01711ZM15.009 12.2801L9.552 14.8551C9.51872 14.8711 9.48192 14.8785 9.44503 14.8765C9.40815 14.8744 9.37237 14.8631 9.34103 14.8436C9.3097 14.824 9.28382 14.7968 9.2658 14.7646C9.24779 14.7323 9.23822 14.6961 9.238 14.6591V9.35011C9.23867 9.31299 9.24872 9.27663 9.26722 9.24444C9.28573 9.21224 9.31208 9.18526 9.34382 9.16599C9.37556 9.14673 9.41167 9.13581 9.44877 9.13425C9.48587 9.1327 9.52276 9.14057 9.556 9.15711L15.014 11.8921C15.0504 11.9102 15.0809 11.9383 15.102 11.9729C15.1232 12.0076 15.1341 12.0476 15.1336 12.0882C15.1331 12.1288 15.1211 12.1685 15.0991 12.2026C15.077 12.2367 15.0458 12.2639 15.009 12.2811V12.2801Z" fill="#0F161E"/>
            </svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.017 2H7.947C6.37015 2.00185 4.85844 2.62914 3.74353 3.74424C2.62862 4.85933 2.00159 6.37115 2 7.948L2 16.018C2.00185 17.5948 2.62914 19.1066 3.74424 20.2215C4.85933 21.3364 6.37115 21.9634 7.948 21.965H16.018C17.5948 21.9631 19.1066 21.3359 20.2215 20.2208C21.3364 19.1057 21.9634 17.5938 21.965 16.017V7.947C21.9631 6.37015 21.3359 4.85844 20.2208 3.74353C19.1057 2.62862 17.5938 2.00159 16.017 2V2ZM19.957 16.017C19.957 16.5344 19.8551 17.0468 19.6571 17.5248C19.4591 18.0028 19.1689 18.4371 18.803 18.803C18.4371 19.1689 18.0028 19.4591 17.5248 19.6571C17.0468 19.8551 16.5344 19.957 16.017 19.957H7.947C6.90222 19.9567 5.90032 19.5415 5.16165 18.8026C4.42297 18.0638 4.008 17.0618 4.008 16.017V7.947C4.00827 6.90222 4.42349 5.90032 5.16235 5.16165C5.90122 4.42297 6.90322 4.008 7.948 4.008H16.018C17.0628 4.00827 18.0647 4.42349 18.8034 5.16235C19.542 5.90122 19.957 6.90322 19.957 7.948V16.018V16.017Z" fill="#0F161E"/>
            <path d="M11.9821 6.81909C10.6135 6.82121 9.3016 7.36588 8.33397 8.3337C7.36633 9.30152 6.82192 10.6135 6.82007 11.9821C6.82166 13.351 7.36609 14.6634 8.33397 15.6315C9.30185 16.5996 10.6142 17.1442 11.9831 17.1461C13.3522 17.1445 14.6647 16.5999 15.6328 15.6318C16.6009 14.6637 17.1455 13.3512 17.1471 11.9821C17.145 10.6132 16.6 9.30098 15.6318 8.33329C14.6635 7.3656 13.351 6.82141 11.9821 6.82009V6.81909ZM11.9821 15.1381C11.1453 15.1381 10.3428 14.8057 9.75115 14.214C9.15947 13.6223 8.82707 12.8198 8.82707 11.9831C8.82707 11.1463 9.15947 10.3438 9.75115 9.75217C10.3428 9.16049 11.1453 8.82809 11.9821 8.82809C12.8188 8.82809 13.6213 9.16049 14.213 9.75217C14.8047 10.3438 15.1371 11.1463 15.1371 11.9831C15.1371 12.8198 14.8047 13.6223 14.213 14.214C13.6213 14.8057 12.8188 15.1381 11.9821 15.1381Z" fill="#0F161E"/>
            <path d="M17.1559 8.09509C17.8391 8.09509 18.3929 7.54127 18.3929 6.85809C18.3929 6.17492 17.8391 5.62109 17.1559 5.62109C16.4728 5.62109 15.9189 6.17492 15.9189 6.85809C15.9189 7.54127 16.4728 8.09509 17.1559 8.09509Z" fill="#0F161E"/>
            </svg>
          </a>
        </div>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import img1 from '@/assets/image.png'
import img2 from '@/assets/image2.png'
import img3 from '@/assets/image3.png'
import img4 from '@/assets/image4.png'
import irek1 from '@/assets/irek1.png'
import irek2 from '@/assets/irek2.png'

const vClickOutside = {
  mounted(el, binding) {
    el._outsideHandler = e => { if (!el.contains(e.target)) binding.value(e) }
    document.addEventListener('click', el._outsideHandler)
  },
  unmounted(el) { document.removeEventListener('click', el._outsideHandler) },
}

const { t, locale } = useI18n()
const auth   = useAuthStore()
const router = useRouter()

const langs = [
  { code: 'en', label: 'EN' },
  { code: 'kz', label: 'KZ' },
  { code: 'ru', label: 'RU' },
]

const langOpen = ref(false)
const showBar = ref(true)

function switchLang(code) {
  locale.value = code
  localStorage.setItem('locale', code)
}

function handleLogout() {
  auth.logout()
  router.push('/')
}

const mentors = [
  { name: 'Colin Munro',    role: 'AI/ML Expert\nMentor',  rating: 4.7, courses: 20, img: img1, bg: '#fef3c7' },
  { name: 'Adolf Stalin',   role: 'UX Specialist\nMentor', rating: 4.7, courses: 20, img: img2, bg: '#fee2e2' },
  { name: 'Sophie Johnson', role: 'Data Analyst Mentor',   rating: 4.7, courses: 20, img: img3, bg: '#dbeafe' },
  { name: 'John Braun',     role: 'Marketing Mentor',      rating: 4.7, courses: 20, img: img4, bg: '#d1fae5' },
]
</script>

<style scoped>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.page {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background: #fff;
  color: #111;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* ── Announce bar ──────────────────────────────────────── */
.announce-bar {
  background: #fef9c3;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  font-size: 0.84rem;
  font-weight: 500;
  color: #78350f;
  position: relative;
}
.bar-close {
  position: absolute;
  right: 1rem;
  background: none;
  border: none;
  font-size: 1rem;
  cursor: pointer;
  color: #78350f;
  line-height: 1;
}

/* ── Header ────────────────────────────────────────────── */
.header {
  background: #fff;
  border-bottom: 1px solid #f0f0f0;
  position: sticky;
  top: 0;
  z-index: 100;
}
.header-inner {
  width: 100%;
  padding: 0 2.5rem;
  height: 60px;
  display: flex;
  align-items: center;
  gap: 2.5rem;
}
.logo { display: flex; align-items: center; text-decoration: none; flex-shrink: 0; }
.logo-img { height: 32px; width: auto; }

.nav {
  display: flex;
  align-items: center;
  gap: 1.75rem;
  flex: 1;
  justify-content: center;
}
.nav-link {
  font-size: 0.9rem;
  font-weight: 500;
  color: #444;
  text-decoration: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.2rem;
  white-space: nowrap;
  transition: color .15s;
}
.nav-link:hover { color: #111; }

.lang-switcher {
  position: relative;
  cursor: pointer;
  user-select: none;
}
.lang-current {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 0.9rem;
  font-weight: 600;
  color: #1a1a4e;
  padding: 4px 2px;
}
.lang-dropdown {
  position: absolute;
  top: calc(100% + 6px);
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  box-shadow: 0 4px 16px rgba(0,0,0,.1);
  overflow: hidden;
  z-index: 200;
  min-width: 64px;
}
.lang-option {
  display: block;
  width: 100%;
  padding: 7px 16px;
  background: none;
  border: none;
  font-size: 0.85rem;
  font-weight: 600;
  color: #444;
  cursor: pointer;
  text-align: center;
  font-family: inherit;
  transition: background .12s, color .12s;
}
.lang-option:hover { background: #f5f5f5; color: #111; }
.lang-option.active { color: #e53030; }

.header-actions { display: flex; gap: 0.6rem; margin-left: auto; flex-shrink: 0; }

.btn-outline {
  border: 1.5px solid #e53030;
  background: transparent;
  color: #e53030;
  border-radius: 2rem;
  padding: 0.42rem 1.25rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: all .15s;
}
.btn-outline:hover { background: #e53030; color: #fff; }

.btn-solid {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.42rem 1.25rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: background .15s;
}
.btn-solid:hover { background: #c72020; }

/* ── Hero ──────────────────────────────────────────────── */
.hero {
  position: relative;
  min-height: 600px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 6rem 2rem 5rem;
  background: #fff;
}

.avatar {
  position: absolute;
  width: 88px;
  height: 88px;
  border-radius: 50%;
  overflow: hidden;
}
.avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
.av-tl { top: 14%;    left: 7%; }
.av-tr { top: 9%;     right: 7%; }
.av-bl { bottom: 14%; left: 18%; }
.av-br { bottom: 12%; right: 17%; }

.deco { position: absolute; user-select: none; }
.deco-diamond-l { top: 48%; left: 16%; }
.deco-star-r    { top: 52%; right: 10%; }

.hero-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: 2.75rem;
  position: relative;
  z-index: 2;
  max-width: 780px;
}

.hero-title {
  font-size: clamp(2.4rem, 6vw, 4.5rem);
  font-weight: 650;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: #111;
  margin-top: -50px;
}

.highlight {
  position: relative;
  display: inline-block;
  white-space: nowrap;
}
.wave {
  position: absolute;
  left: 0;
  bottom: -16px;
  width: 100%;
  height: 11px;
  display: block;
}

.btn-explore {
  background: #cce8f4;
  border: none;
  color: #4b7a8a;
  border-radius: 2rem;
  padding: 0.8rem 2.75rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: all .15s;
  margin-top: 150px;
}
.btn-explore:hover { background: #aad6ec; color: #2c5a6a; }

/* ── Space / CTA ───────────────────────────────────────── */
.space-section {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  flex-shrink: 0;
}
.space-img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}
.space-text {
  position: absolute;
  top: 10rem;
  left: 10rem;
  width: 55%;
}
.space-text h2 {
  font-size: clamp(2.5rem, 6vw, 5rem);
  font-weight: 600;
  color: #fff;
  line-height: 1.15;
  margin-bottom: 1rem;
  letter-spacing: -0.02em;
}
.space-text p {
  font-size: 1.05rem;
  color: rgba(255,255,255,.85);
  max-width: 500px;
}

/* ── Team ──────────────────────────────────────────────── */
.team-section {
  padding: 5rem 2rem;
  text-align: center;
  background: #fff;
}
.team-badge {
  display: inline-block;
  background: #e0f2fe;
  color: #0369a1;
  font-size: 0.82rem;
  font-weight: 700;
  border-radius: 2rem;
  padding: 0.3rem 1.2rem;
  margin-bottom: 1.25rem;
}
.team-title {
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 600;
  color: #111;
  margin-bottom: 0.85rem;
  letter-spacing: -0.02em;
}
.team-sub {
  font-size: 0.95rem;
  color: #6b7280;
  line-height: 1.7;
  margin-bottom: 3rem;
}

.mentors-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 420px));
  gap: 1.25rem;
  justify-content: center;
  max-width: 880px;
  margin: 0 auto;
}
.mentor-card {
  display: flex;
  align-items: center;
  gap: 1.25rem;
  border: 1px solid #e5e7eb;
  border-radius: 1rem;
  padding: 1.5rem 1.75rem;
  text-align: left;
  background: #fafafa;
}
.mentor-photo {
  width: 96px;
  height: 96px;
  border-radius: 50%;
  overflow: hidden;
  flex-shrink: 0;
}
.mentor-photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}
.mentor-name  { font-size: 1.15rem; font-weight: 700; color: #111; margin-bottom: 0.3rem; }
.mentor-role  { font-size: 0.875rem; color: #6b7280; margin-bottom: 0.6rem; white-space: pre-line; line-height: 1.5; }
.mentor-stats { display: flex; align-items: center; gap: 0.6rem; font-size: 0.85rem; color: #374151; }
.stat-star    { display: flex; align-items: center; gap: 4px; font-weight: 600; }
.stat-courses { display: flex; align-items: center; gap: 4px; }
.stat-sep     { color: #d1d5db; line-height: 1; }

/* ── Divider ───────────────────────────────────────────── */
.hr { height: 1px; background: #ededee; margin: 0 11rem; }

/* ── Start Learning ────────────────────────────────────── */
.learn-section { padding: 5rem 2rem; background: #fff; }
.learn-inner {
  max-width: 1000px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 5rem;
  align-items: center;
}

/* collage */
.collage {
  position: relative;
  width: 360px;
  height: 400px;
  flex-shrink: 0;
}

.col-img {
  position: absolute;
  display: block;
}
.col-img--left {
  bottom: 0;
  left: 0;
  width: 200px;
  height: auto;
}
.col-img--right {
  top: 0;
  right: 0;
  width: 200px;
  height: auto;
}

.collage-badge {
  position: absolute;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 2rem;
  padding: 0.55rem 3rem 0.55rem 0.55rem;
  display: flex;
  align-items: center;
  gap: 0.65rem;
  color: #111;
  line-height: 0.7;
  z-index: 3;
}
.badge-best  { top: 10px;    left: 0; }
.badge-video { bottom: 10px; right: 0; }

.cb-icon-wrap {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #e0f2fe;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.cb-text { font-size: 0.8rem; color: #111; }
.cb-text strong { font-weight: 800; display: block; }

/* learn text */
.learn-title {
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800;
  color: #111;
  line-height: 1.15;
  letter-spacing: -0.02em;
  margin-bottom: 1.25rem;
}
.learn-desc {
  font-size: 0.95rem;
  color: #6b7280;
  line-height: 1.8;
  margin-bottom: 2rem;
}
.checklist {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.85rem 1.5rem;
  margin-bottom: 2.5rem;
}
.check-item {
  display: flex;
  align-items: center;
  gap: 0.55rem;
  font-size: 0.9rem;
  color: #374151;
}
.check-icon {
  width: 22px;
  height: 22px;
  border-radius: 50%;
  border: 1.5px solid #e53030;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.check-icon svg { width: 12px; height: 12px; }

.btn-start {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.9rem 2.75rem;
  font-size: 1rem;
  font-weight: 700;
  cursor: pointer;
  font-family: inherit;
  transition: background .15s;
}
.btn-start:hover { background: #c72020; }

/* ── Footer ────────────────────────────────────────────── */
.footer { background: #fff; border-top: 1px solid #f0f0f0; margin-top: auto; }
.footer-top {
  padding: 1.75rem 2.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
  flex-wrap: wrap;
}
.footer-logo { display: flex; align-items: center; text-decoration: none; flex-shrink: 0; }
.footer-logo-img { height: 34px; width: auto; }

.footer-nav { display: flex; gap: 1.75rem; font-size: 0.875rem; align-items: center; }
.footer-nav a, .footer-nav span {
  color: #444;
  text-decoration: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.2rem;
}
.footer-nav a:hover { color: #111; }

.footer-bottom {
  padding: 0.9rem 2.5rem;
  border-top: 1px solid #f0f0f0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.footer-copy {
  font-size: 0.78rem;
  color: #9ca3af;
}

.footer-social { display: flex; gap: 1rem; align-items: center; }
.footer-social a { display: flex; opacity: 0.6; transition: opacity .15s; }
.footer-social a:hover { opacity: 1; }

/* ── Responsive ────────────────────────────────────────── */
@media (max-width: 900px) {
  .nav { display: none; }
  .space-text { width: 60%; padding: 1.5rem 2rem; }
  .mentors-grid { grid-template-columns: 1fr; max-width: 380px; }
  .learn-inner { grid-template-columns: 1fr; gap: 2.5rem; }
  .collage { height: 260px; }
  .col-photo { width: 110px; height: 160px; }
}
@media (max-width: 600px) {
  .hero { padding: 4rem 1.5rem; }
  .av-tl, .av-tr, .av-bl, .av-br, .deco { display: none; }
  .hero-title { font-size: 1.75rem; }
  .space-text { width: 100%; padding: 1.5rem; background: rgba(0,0,0,.4); }
  .team-section { padding: 3rem 1.25rem; }
  .learn-section { padding: 3rem 1.25rem; }
}
</style>
