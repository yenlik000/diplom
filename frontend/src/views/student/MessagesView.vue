<template>
  <div class="lms-wrap">

    <!-- ── Sidebar ─────────────────────────────────────────── -->
    <aside class="lms-sidebar">
      <nav class="sidebar-nav">
        <RouterLink to="/dashboard" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#mv-home)">
              <path d="M6.56369 11.6129C5.96694 11.6129 5.37604 11.4954 4.82472 11.267C4.27339 11.0386 3.77245 10.7039 3.35049 10.282C2.92852 9.85999 2.5938 9.35905 2.36543 8.80773C2.13707 8.2564 2.01953 7.6655 2.01953 7.06875C2.01953 6.472 2.13707 5.8811 2.36543 5.32978C2.5938 4.77845 2.92852 4.27751 3.35049 3.85554C3.77245 3.43358 4.27339 3.09886 4.82472 2.87049C5.37604 2.64213 5.96694 2.52459 6.56369 2.52459C7.76888 2.52459 8.9247 3.00335 9.7769 3.85554C10.6291 4.70774 11.1079 5.86356 11.1079 7.06875C11.1079 8.27394 10.6291 9.42976 9.7769 10.282C8.9247 11.1342 7.76888 11.6129 6.56369 11.6129ZM7.0686 21.711C5.86341 21.711 4.70759 21.2323 3.85539 20.3801C3.0032 19.5279 2.52444 18.3721 2.52444 17.1669C2.52444 15.9617 3.0032 14.8059 3.85539 13.9537C4.70759 13.1015 5.86341 12.6227 7.0686 12.6227C8.27379 12.6227 9.42961 13.1015 10.2818 13.9537C11.134 14.8059 11.6128 15.9617 11.6128 17.1669C11.6128 18.3721 11.134 19.5279 10.2818 20.3801C9.42961 21.2323 8.27379 21.711 7.0686 21.711ZM17.1667 11.6129C16.57 11.6129 15.9791 11.4954 15.4278 11.267C14.8764 11.0386 14.3755 10.7039 13.9535 10.282C13.5316 9.85999 13.1968 9.35905 12.9685 8.80773C12.7401 8.2564 12.6226 7.6655 12.6226 7.06875C12.6226 6.472 12.7401 5.8811 12.9685 5.32978C13.1968 4.77845 13.5316 4.27751 13.9535 3.85554C14.3755 3.43358 14.8764 3.09886 15.4278 2.87049C15.9791 2.64213 16.57 2.52459 17.1667 2.52459C18.3719 2.52459 19.5277 3.00335 20.3799 3.85554C21.2321 4.70774 21.7109 5.86356 21.7109 7.06875C21.7109 8.27394 21.2321 9.42976 20.3799 10.282C19.5277 11.1342 18.3719 11.6129 17.1667 11.6129ZM17.1667 21.711C15.9615 21.711 14.8057 21.2323 13.9535 20.3801C13.1013 19.5279 12.6226 18.3721 12.6226 17.1669C12.6226 15.9617 13.1013 14.8059 13.9535 13.9537C14.8057 13.1015 15.9615 12.6227 17.1667 12.6227C18.3719 12.6227 19.5277 13.1015 20.3799 13.9537C21.2321 14.8059 21.7109 15.9617 21.7109 17.1669C21.7109 18.3721 21.2321 19.5279 20.3799 20.3801C19.5277 21.2323 18.3719 21.711 17.1667 21.711ZM6.56369 9.59328C7.23324 9.59328 7.87537 9.32731 8.34881 8.85387C8.82225 8.38042 9.08823 7.7383 9.08823 7.06875C9.08823 6.3992 8.82225 5.75708 8.34881 5.28364C7.87537 4.81019 7.23324 4.54422 6.56369 4.54422C5.89414 4.54422 5.25202 4.81019 4.77858 5.28364C4.30514 5.75708 4.03916 6.3992 4.03916 7.06875C4.03916 7.7383 4.30514 8.38042 4.77858 8.85387C5.25202 9.32731 5.89414 9.59328 6.56369 9.59328ZM7.0686 19.6914C7.73815 19.6914 8.38027 19.4254 8.85371 18.952C9.32716 18.4786 9.59313 17.8364 9.59313 17.1669C9.59313 16.4973 9.32716 15.8552 8.85371 15.3818C8.38027 14.9083 7.73815 14.6424 7.0686 14.6424C6.39905 14.6424 5.75693 14.9083 5.28348 15.3818C4.81004 15.8552 4.54406 16.4973 4.54406 17.1669C4.54406 17.8364 4.81004 18.4786 5.28348 18.952C5.75693 19.4254 6.39905 19.6914 7.0686 19.6914ZM17.1667 9.59328C17.8363 9.59328 18.4784 9.32731 18.9518 8.85387C19.4253 8.38042 19.6913 7.7383 19.6913 7.06875C19.6913 6.3992 19.4253 5.75708 18.9518 5.28364C18.4784 4.81019 17.8363 4.54422 17.1667 4.54422C16.4972 4.54422 15.8551 4.81019 15.3816 5.28364C14.9082 5.75708 14.6422 6.3992 14.6422 7.06875C14.6422 7.7383 14.9082 8.38042 15.3816 8.85387C15.8551 9.32731 16.4972 9.59328 17.1667 9.59328ZM17.1667 19.6914C17.8363 19.6914 18.4784 19.4254 18.9518 18.952C19.4253 18.4786 19.6913 17.8364 19.6913 17.1669C19.6913 16.4973 19.4253 15.8552 18.9518 15.3818C18.4784 14.9083 17.8363 14.6424 17.1667 14.6424C16.4972 14.6424 15.8551 14.9083 15.3816 15.3818C14.9082 15.8552 14.6422 16.4973 14.6422 17.1669C14.6422 17.8364 14.9082 18.4786 15.3816 18.952C15.8551 19.4254 16.4972 19.6914 17.1667 19.6914Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="mv-home"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Home</span>
        </RouterLink>

        <RouterLink to="/student/progress" class="nav-item">
          <svg width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M6 13.127H2C1.73478 13.127 1.48043 13.2333 1.29289 13.4227C1.10536 13.6121 1 13.8689 1 14.1367V22.2148C1 22.4827 1.10536 22.7395 1.29289 22.9289C1.48043 23.1182 1.73478 23.2246 2 23.2246H6C6.26522 23.2246 6.51957 23.1182 6.70711 22.9289C6.89464 22.7395 7 22.4827 7 22.2148V14.1367C7 13.8689 6.89464 13.6121 6.70711 13.4227C6.51957 13.2333 6.26522 13.127 6 13.127ZM5 21.2051H3V15.1465H5V21.2051ZM22 9.08789H18C17.7348 9.08789 17.4804 9.19428 17.2929 9.38364C17.1054 9.57301 17 9.82985 17 10.0977V22.2148C17 22.4827 17.1054 22.7395 17.2929 22.9289C17.4804 23.1182 17.7348 23.2246 18 23.2246H22C22.2652 23.2246 22.5196 23.1182 22.7071 22.9289C22.8946 22.7395 23 22.4827 23 22.2148V10.0977C23 9.82985 22.8946 9.57301 22.7071 9.38364C22.5196 9.19428 22.2652 9.08789 22 9.08789ZM21 21.2051H19V11.1074H21V21.2051ZM14 1.00977H10C9.73478 1.00977 9.48043 1.11615 9.29289 1.30552C9.10536 1.49489 9 1.75172 9 2.01953V22.2148C9 22.4827 9.10536 22.7395 9.29289 22.9289C9.48043 23.1182 9.73478 23.2246 10 23.2246H14C14.2652 23.2246 14.5196 23.1182 14.7071 22.9289C14.8946 22.7395 15 22.4827 15 22.2148V2.01953C15 1.75172 14.8946 1.49489 14.7071 1.30552C14.5196 1.11615 14.2652 1.00977 14 1.00977ZM13 21.2051H11V3.0293H13V21.2051Z" fill="currentColor"/>
          </svg>
          <span>Progress</span>
        </RouterLink>

        <RouterLink to="/student/messages" class="nav-item nav-item--active">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#mv-msg)">
              <path d="M7.36247 21.0283L3.18143 21.9576C2.64028 22.0779 2.15751 21.5951 2.27779 21.054L3.20708 16.8729C2.42502 15.4101 2.01705 13.7765 2.01954 12.1177C2.01954 6.54051 6.54048 2.01958 12.1177 2.01958C17.6949 2.01958 22.2158 6.54051 22.2158 12.1177C22.2158 17.6949 17.6949 22.2158 12.1177 22.2158C10.4589 22.2183 8.8253 21.8104 7.36247 21.0283ZM7.65531 18.8946L8.31472 19.248C9.48464 19.8732 10.7912 20.199 12.1177 20.1962C13.7155 20.1962 15.2774 19.7224 16.6059 18.8347C17.9344 17.9471 18.9698 16.6854 19.5812 15.2092C20.1927 13.7331 20.3527 12.1088 20.041 10.5417C19.7292 8.9746 18.9598 7.53514 17.83 6.40534C16.7002 5.27554 15.2608 4.50614 13.6937 4.19443C12.1266 3.88272 10.5023 4.0427 9.02617 4.65414C7.55001 5.26559 6.28832 6.30103 5.40064 7.62953C4.51297 8.95804 4.03917 10.5199 4.03917 12.1177C4.03917 13.4648 4.36736 14.7614 4.98839 15.9207L5.34082 16.5801L4.78269 19.0912C4.73458 19.3077 4.92768 19.5008 5.14414 19.4527L7.65531 18.8946Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="mv-msg"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Messages</span>
        </RouterLink>

        <RouterLink to="/student/settings" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M21.5291 9.64366L19.6206 9.00747L20.5193 7.21001C20.6104 7.02186 20.6409 6.81008 20.6065 6.60389C20.5722 6.39769 20.4747 6.20724 20.3275 6.05882L18.1766 3.90792C18.0273 3.75855 17.8351 3.65971 17.6268 3.6253C17.4184 3.59088 17.2046 3.62262 17.0153 3.71605L15.2178 4.61479L14.5816 2.70624C14.5144 2.5073 14.3869 2.33425 14.2168 2.21118C14.0466 2.0881 13.8424 2.02112 13.6324 2.01957H10.6029C10.3912 2.01902 10.1847 2.08502 10.0126 2.20824C9.84044 2.33146 9.71137 2.50567 9.64363 2.70624L9.00744 4.61479L7.20998 3.71605C7.02183 3.62495 6.81005 3.59447 6.60386 3.62884C6.39766 3.66321 6.20721 3.76072 6.05879 3.90792L3.90789 6.05882C3.75852 6.20803 3.65968 6.40031 3.62527 6.60862C3.59085 6.81692 3.62259 7.03078 3.71602 7.22011L4.61476 9.01757L2.70621 9.65376C2.50727 9.72094 2.33422 9.84848 2.21114 10.0186C2.08807 10.1887 2.02109 10.393 2.01953 10.603V13.6324C2.01899 13.8441 2.08499 14.0506 2.20821 14.2228C2.33143 14.3949 2.50564 14.524 2.70621 14.5917L4.61476 15.2279L3.71602 17.0254C3.62492 17.2135 3.59444 17.4253 3.62881 17.6315C3.66318 17.8377 3.76069 18.0282 3.90789 18.1766L6.05879 20.3275C6.208 20.4769 6.40028 20.5757 6.60859 20.6101C6.81689 20.6445 7.03075 20.6128 7.22007 20.5194L9.01754 19.6206L9.65373 21.5292C9.72147 21.7297 9.85054 21.9039 10.0227 22.0272C10.1948 22.1504 10.4013 22.2164 10.613 22.2158H13.6425C13.8542 22.2164 14.0607 22.1504 14.2329 22.0272C14.405 21.9039 14.5341 21.7297 14.6018 21.5292L15.238 19.6206L17.0355 20.5194C17.2224 20.6082 17.4321 20.6374 17.6362 20.6031C17.8403 20.5687 18.0289 20.4725 18.1766 20.3275L20.3275 18.1766C20.4768 18.0274 20.5757 17.8351 20.6101 17.6268C20.6445 17.4185 20.6128 17.2046 20.5193 17.0153L19.6206 15.2178L21.5291 14.5816C21.7281 14.5145 21.9011 14.3869 22.0242 14.2168C22.1473 14.0467 22.2142 13.8424 22.2158 13.6324V10.603C22.2164 10.3913 22.1504 10.1848 22.0271 10.0126C21.9039 9.84047 21.7297 9.7114 21.5291 9.64366ZM20.1962 12.9054L18.9844 13.3093C18.7057 13.3997 18.4501 13.5496 18.2352 13.7487C18.0203 13.9477 17.8512 14.1911 17.7398 14.4621C17.6283 14.733 17.5772 15.0249 17.5898 15.3176C17.6025 15.6102 17.6786 15.8967 17.813 16.157L18.3886 17.3081L17.2778 18.4189L16.1569 17.813C15.898 17.684 15.6143 17.6122 15.3252 17.6023C15.036 17.5924 14.7481 17.6448 14.481 17.7559C14.2138 17.867 13.9736 18.0341 13.7767 18.2461C13.5798 18.4581 13.4307 18.7098 13.3395 18.9844L12.9356 20.1962H11.33L10.9261 18.9844C10.8357 18.7058 10.6858 18.4501 10.4867 18.2352C10.2877 18.0203 10.0442 17.8512 9.77331 17.7398C9.50239 17.6284 9.21047 17.5772 8.9178 17.5898C8.62513 17.6025 8.33871 17.6786 8.07842 17.813L6.92723 18.3886L5.81643 17.2778L6.42232 16.157C6.55672 15.8967 6.63289 15.6102 6.64554 15.3176C6.65819 15.0249 6.60701 14.733 6.49557 14.4621C6.38413 14.1911 6.21509 13.9477 6.00016 13.7487C5.78524 13.5496 5.52959 13.3997 5.25094 13.3093L4.03916 12.9054V11.33L5.25094 10.9261C5.52959 10.8357 5.78524 10.6858 6.00016 10.4867C6.21509 10.2877 6.38413 10.0443 6.49557 9.77334C6.60701 9.50242 6.65819 9.2105 6.64554 8.91783C6.63289 8.62516 6.55672 8.33874 6.42232 8.07845L5.84673 6.95755L6.95752 5.84676L8.07842 6.42235C8.33871 6.55675 8.62513 6.63292 8.9178 6.64557C9.21047 6.65822 9.50239 6.60704 9.77331 6.4956C10.0442 6.38416 10.2877 6.21512 10.4867 6.00019C10.6858 5.78527 10.8357 5.52962 10.9261 5.25097L11.33 4.03919H12.9053L13.3092 5.25097C13.3996 5.52962 13.5496 5.78527 13.7486 6.00019C13.9477 6.21512 14.1911 6.38416 14.462 6.4956C14.733 6.60704 15.0249 6.65822 15.3175 6.64557C15.6102 6.63292 15.8966 6.55675 16.1569 6.42235L17.3081 5.84676L18.4189 6.95755L17.813 8.07845C17.684 8.33741 17.6121 8.62107 17.6023 8.91022C17.5924 9.19937 17.6448 9.48727 17.7559 9.75442C17.8669 10.0216 18.0341 10.2617 18.2461 10.4587C18.458 10.6556 18.7098 10.8047 18.9844 10.8958L20.1962 11.2998V12.9054ZM12.1177 8.07845C11.3188 8.07845 10.5378 8.31534 9.87358 8.75918C9.20933 9.20302 8.69161 9.83387 8.38589 10.5719C8.08016 11.31 8.00017 12.1222 8.15603 12.9057C8.31188 13.6893 8.69659 14.409 9.26149 14.9739C9.82639 15.5388 10.5461 15.9235 11.3296 16.0793C12.1132 16.2352 12.9253 16.1552 13.6634 15.8495C14.4015 15.5438 15.0323 15.026 15.4762 14.3618C15.92 13.6975 16.1569 12.9166 16.1569 12.1177C16.1569 11.0464 15.7314 10.019 14.9739 9.26152C14.2163 8.50401 13.1889 8.07845 12.1177 8.07845ZM12.1177 14.1373C11.7182 14.1373 11.3278 14.0189 10.9956 13.797C10.6635 13.575 10.4046 13.2596 10.2518 12.8906C10.0989 12.5215 10.0589 12.1155 10.1368 11.7237C10.2148 11.3319 10.4071 10.9721 10.6896 10.6896C10.972 10.4072 11.3319 10.2148 11.7237 10.1369C12.1154 10.059 12.5215 10.0989 12.8905 10.2518C13.2596 10.4047 13.575 10.6635 13.7969 10.9957C14.0188 11.3278 14.1373 11.7183 14.1373 12.1177C14.1373 12.6533 13.9245 13.167 13.5458 13.5458C13.167 13.9245 12.6533 14.1373 12.1177 14.1373Z" fill="currentColor"/>
          </svg>
          <span>Settings</span>
        </RouterLink>
      </nav>

      <!-- Support 24/7 card -->
      <div class="support-card">
        <div class="support-text">
          <h4 class="support-title">Support 24/7</h4>
          <p class="support-sub">Contacts us anytime</p>
          <a class="support-btn" href="https://wa.me/87766253784" target="_blank" rel="noopener">Start</a>
        </div>
        <svg class="support-img" width="90" height="80" viewBox="0 0 90 80" fill="none">
          <ellipse cx="52" cy="74" rx="30" ry="5" fill="#f9c6c6" opacity="0.5"/>
          <rect x="18" y="34" width="52" height="34" rx="4" fill="#1e293b"/>
          <rect x="21" y="37" width="46" height="27" rx="3" fill="#3b82f6" opacity="0.8"/>
          <rect x="34" y="68" width="20" height="4" rx="2" fill="#94a3b8"/>
          <rect x="28" y="72" width="32" height="3" rx="1.5" fill="#64748b"/>
          <circle cx="64" cy="28" r="10" fill="#fca5a5"/>
          <path d="M54 28 Q54 18 64 18 Q74 18 74 28 Q74 36 64 38 L62 46 L66 46 L64 38" fill="#ef4444"/>
          <rect x="56" y="36" width="16" height="12" rx="3" fill="#fecaca"/>
          <path d="M56 44 Q48 46 46 56 L82 56 Q80 46 72 44" fill="#dc2626"/>
          <rect x="44" y="56" width="4" height="18" rx="2" fill="#991b1b"/>
          <rect x="80" y="56" width="4" height="18" rx="2" fill="#991b1b"/>
        </svg>
      </div>

      <button class="nav-item nav-item--logout" @click="logout">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <polyline points="16 17 21 12 16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <line x1="21" y1="12" x2="9" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Log out</span>
      </button>
    </aside>

    <!-- ── Panel ─────────────────────────────────────────────── -->
    <div class="lms-panel">
      <!-- Top bar -->
      <header class="lms-topbar">
        <div class="topbar-search">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/>
            <path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input type="text" placeholder="Search..." class="search-input"/>
        </div>
        <div class="topbar-right">
          <div class="topbar-user-chip" @click="$router.push('/student/settings')">
            <div class="topbar-avatar">
              <img v-if="auth.user?.avatar_url" :src="auth.user.avatar_url" class="topbar-avatar-img" />
              <span v-else>{{ (auth.user?.full_name || auth.user?.name || '?')[0].toUpperCase() }}</span>
            </div>
            <span class="topbar-user-name">{{ auth.user?.full_name || auth.user?.name || 'Student' }}</span>
          </div>
          <button class="icon-btn icon-btn--red">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
              <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>
      </header>

      <!-- Messages layout -->
      <div class="messages-layout">

        <!-- Conversation list -->
        <div class="conv-list">
          <div class="conv-list-header">
            <h2 class="conv-title">Messages</h2>
            <button class="compose-btn" title="New message" @click.stop="newChatOpen = !newChatOpen">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>

          <div class="conv-search">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/>
              <path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <input type="text" v-model="searchQ" placeholder="Search conversations" class="conv-search-input"/>
          </div>

          <!-- New conversation picker -->
          <div v-if="newChatOpen" class="new-chat-picker" @click.stop>
            <div class="conv-search" style="margin:.5rem .75rem .3rem;">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/></svg>
              <input v-model="pickerQ" type="text" placeholder="Search users…" class="conv-search-input" />
            </div>
            <div style="max-height:220px;overflow-y:auto;">
              <div
                v-for="c in filteredPickerConvs" :key="c.id"
                class="conv-item"
                @click="startNewChat(c)"
              >
                <div class="avatar-wrap">
                  <div class="conv-avatar" :style="{ background: c.color }">{{ c.initials }}</div>
                </div>
                <div class="conv-info">
                  <span class="conv-name">{{ c.name }}</span>
                </div>
              </div>
              <p v-if="!filteredPickerConvs.length" style="font-size:.82rem;color:#9ca3af;text-align:center;padding:.75rem;">No users found</p>
            </div>
          </div>

          <div
            v-for="c in filteredConvs"
            :key="c.id"
            class="conv-item"
            :class="{ 'conv-item--active': selected === c.id }"
            @click="selected = c.id"
          >
            <div class="avatar-wrap">
              <div class="conv-avatar" :style="{ background: c.color }">
                <span v-if="!c.icon">{{ c.initials }}</span>
                <svg v-else width="18" height="18" fill="none" viewBox="0 0 24 24">
                  <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="#fff" stroke-width="1.5"/>
                </svg>
              </div>
              <span v-if="c.online" class="online-dot"></span>
            </div>
            <div class="conv-info">
              <div class="conv-name-row">
                <span class="conv-name">{{ c.name }}</span>
                <span class="conv-time">{{ c.time }}</span>
              </div>
              <p class="conv-preview">{{ c.preview }}</p>
            </div>
            <span v-if="c.unread" class="conv-badge">{{ c.unread }}</span>
          </div>
        </div>

        <!-- Chat area -->
        <div class="chat-area">
          <template v-if="activeConv">
            <!-- Chat header -->
            <div class="chat-header">
              <div class="avatar-wrap">
                <div class="conv-avatar" :style="{ background: activeConv.color }">{{ activeConv.initials }}</div>
                <span v-if="activeConv.online" class="online-dot"></span>
              </div>
              <div class="chat-header-info">
                <p class="chat-name">{{ activeConv.name }}</p>
                <p class="chat-status" :class="activeConv.online ? 'online' : ''">
                  {{ activeConv.online ? 'Online' : 'Offline' }}
                </p>
              </div>
              <div class="chat-actions">
                <button class="chat-action-btn">
                  <svg width="34" height="31" viewBox="0 0 34 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.3857 24.3857C9.83574 24.3857 9.36491 24.1899 8.97324 23.7982C8.58158 23.4066 8.38574 22.9357 8.38574 22.3857V10.3857C8.38574 9.83574 8.58158 9.36491 8.97324 8.97324C9.36491 8.58158 9.83574 8.38574 10.3857 8.38574H22.3857C22.9357 8.38574 23.4066 8.58158 23.7982 8.97324C24.1899 9.36491 24.3857 9.83574 24.3857 10.3857V14.8857L28.3857 10.8857V21.8857L24.3857 17.8857V22.3857C24.3857 22.9357 24.1899 23.4066 23.7982 23.7982C23.4066 24.1899 22.9357 24.3857 22.3857 24.3857H10.3857ZM10.3857 22.3857H22.3857V10.3857H10.3857V22.3857ZM10.3857 22.3857V10.3857V22.3857Z" fill="#808080"/>
                  </svg>
                </button>
                <button class="chat-action-btn">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.3357 26.3857C23.2524 26.3857 21.1941 25.9316 19.1607 25.0232C17.1274 24.1149 15.2774 22.8274 13.6107 21.1607C11.9441 19.4941 10.6566 17.6441 9.74824 15.6107C8.83991 13.5774 8.38574 11.5191 8.38574 9.43574C8.38574 9.13574 8.48574 8.88574 8.68574 8.68574C8.88574 8.48574 9.13574 8.38574 9.43574 8.38574H13.4857C13.7191 8.38574 13.9274 8.46491 14.1107 8.62324C14.2941 8.78158 14.4024 8.96908 14.4357 9.18574L15.0857 12.6857C15.1191 12.9524 15.1107 13.1774 15.0607 13.3607C15.0107 13.5441 14.9191 13.7024 14.7857 13.8357L12.3607 16.2857C12.6941 16.9024 13.0899 17.4982 13.5482 18.0732C14.0066 18.6482 14.5107 19.2024 15.0607 19.7357C15.5774 20.2524 16.1191 20.7316 16.6857 21.1732C17.2524 21.6149 17.8524 22.0191 18.4857 22.3857L20.8357 20.0357C20.9857 19.8857 21.1816 19.7732 21.4232 19.6982C21.6649 19.6232 21.9024 19.6024 22.1357 19.6357L25.5857 20.3357C25.8191 20.4024 26.0107 20.5232 26.1607 20.6982C26.3107 20.8732 26.3857 21.0691 26.3857 21.2857V25.3357C26.3857 25.6357 26.2857 25.8857 26.0857 26.0857C25.8857 26.2857 25.6357 26.3857 25.3357 26.3857ZM11.4107 14.3857L13.0607 12.7357L12.6357 10.3857H10.4107C10.4941 11.0691 10.6107 11.7441 10.7607 12.4107C10.9107 13.0774 11.1274 13.7357 11.4107 14.3857ZM20.3607 23.3357C21.0107 23.6191 21.6732 23.8441 22.3482 24.0107C23.0232 24.1774 23.7024 24.2857 24.3857 24.3357V22.1357L22.0357 21.6607L20.3607 23.3357Z" fill="#808080"/>
                  </svg>
                </button>
                <button class="chat-action-btn">
                  <svg width="21" height="31" viewBox="0 0 21 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.3857 24.3857C9.83574 24.3857 9.36491 24.1899 8.97324 23.7982C8.58158 23.4066 8.38574 22.9357 8.38574 22.3857C8.38574 21.8357 8.58158 21.3649 8.97324 20.9732C9.36491 20.5816 9.83574 20.3857 10.3857 20.3857C10.9357 20.3857 11.4066 20.5816 11.7982 20.9732C12.1899 21.3649 12.3857 21.8357 12.3857 22.3857C12.3857 22.9357 12.1899 23.4066 11.7982 23.7982C11.4066 24.1899 10.9357 24.3857 10.3857 24.3857ZM10.3857 18.3857C9.83574 18.3857 9.36491 18.1899 8.97324 17.7982C8.58158 17.4066 8.38574 16.9357 8.38574 16.3857C8.38574 15.8357 8.58158 15.3649 8.97324 14.9732C9.36491 14.5816 9.83574 14.3857 10.3857 14.3857C10.9357 14.3857 11.4066 14.5816 11.7982 14.9732C12.1899 15.3649 12.3857 15.8357 12.3857 16.3857C12.3857 16.9357 12.1899 17.4066 11.7982 17.7982C11.4066 18.1899 10.9357 18.3857 10.3857 18.3857ZM10.3857 12.3857C9.83574 12.3857 9.36491 12.1899 8.97324 11.7982C8.58158 11.4066 8.38574 10.9357 8.38574 10.3857C8.38574 9.83574 8.58158 9.36491 8.97324 8.97324C9.36491 8.58158 9.83574 8.38574 10.3857 8.38574C10.9357 8.38574 11.4066 8.58158 11.7982 8.97324C12.1899 9.36491 12.3857 9.83574 12.3857 10.3857C12.3857 10.9357 12.1899 11.4066 11.7982 11.7982C11.4066 12.1899 10.9357 12.3857 10.3857 12.3857Z" fill="#808080"/>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Messages -->
            <div class="chat-messages" ref="msgContainer">
              <div class="date-sep"><span>TODAY</span></div>

              <div
                v-for="(msg, i) in mappedMessages"
                :key="msg.id ?? i"
                class="msg-row"
                :class="{ 'msg-row--mine': msg.mine }"
              >
                <div v-if="!msg.mine" class="conv-avatar sm" :style="{ background: activeConv.color }">
                  {{ activeConv.initials }}
                </div>
                <div class="msg-col">
                  <div class="msg-bubble" :class="{ 'msg-bubble--mine': msg.mine }" v-html="msg.text"></div>
                  <span class="msg-time">{{ msg.time }}</span>
                </div>
              </div>
            </div>

            <!-- Input area -->
            <div class="chat-compose" @click.stop>
              <div class="compose-toolbar">
                <button @mousedown.prevent="fmt('bold')" class="toolbar-btn" :class="{ 'toolbar-btn--active': activeFormats.bold }" title="Bold"><strong>B</strong></button>
                <button @mousedown.prevent="fmt('italic')" class="toolbar-btn" :class="{ 'toolbar-btn--active': activeFormats.italic }" title="Italic"><em>I</em></button>
                <button @mousedown.prevent="fmt('underline')" class="toolbar-btn" :class="{ 'toolbar-btn--active': activeFormats.underline }" title="Underline"><u>U</u></button>
                <button @mousedown.prevent="fmt('strikeThrough')" class="toolbar-btn" title="Strike"><s>S</s></button>
                <span class="toolbar-sep"></span>
                <button @mousedown.prevent="fmt('insertUnorderedList')" class="toolbar-btn" title="Bullet list">
                  <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <button @mousedown.prevent="fmt('insertOrderedList')" class="toolbar-btn" title="Numbered list">
                  <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M10 6h11M10 12h11M10 18h11M4 6h.01M4 12h.01M4 18h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
              </div>
              <div class="compose-input-row">
                <div
                  ref="editorEl"
                  contenteditable="true"
                  class="compose-editor"
                  data-placeholder="Type your message professionally..."
                  @keydown.enter.exact.prevent="sendMessage"
                  @keyup="updateFormats"
                  @mouseup="updateFormats"
                ></div>
                <div class="compose-footer-row">
                  <div style="display:flex;align-items:center;gap:.4rem;">
                    <!-- Photo upload -->
                    <input ref="photoInputEl" type="file" accept="image/*" style="display:none" @change="onPhotoSelected" />
                    <button class="emoji-btn" title="Upload photo" @click.stop="photoInputEl.click()" :disabled="uploading">
                      <svg v-if="!uploading" width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/>
                        <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/>
                        <path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                      <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" class="spin">
                        <circle cx="12" cy="12" r="10" stroke="#d1d5db" stroke-width="2"/>
                        <path d="M12 2a10 10 0 0110 10" stroke="#7b1f1f" stroke-width="2" stroke-linecap="round"/>
                      </svg>
                    </button>
                    <!-- Emoji -->
                    <div class="emoji-wrap">
                      <button class="emoji-btn" title="Emoji" @click.stop="showEmoji = !showEmoji">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
                          <path d="M8 14s1.5 2 4 2 4-2 4-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                          <circle cx="9" cy="10" r="1" fill="currentColor"/>
                          <circle cx="15" cy="10" r="1" fill="currentColor"/>
                        </svg>
                      </button>
                      <div v-if="showEmoji" class="emoji-panel" @click.stop>
                        <div v-for="(cat, label) in emojiCategories" :key="label" class="emoji-cat">
                          <div class="emoji-cat-label">{{ label }}</div>
                          <div class="emoji-grid">
                            <button v-for="e in cat" :key="e" class="emoji-item" @mousedown.prevent="insertEmoji(e)">{{ e }}</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="send-msg-btn" @click="sendMessage">
                    Send Message
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24">
                      <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </template>

          <div v-else class="chat-empty">
            <svg width="48" height="48" fill="none" viewBox="0 0 24 24">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <p>Select a conversation to start messaging</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted, nextTick } from 'vue'
import { useRouter } from 'vue-router'
import { messagesApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const auth   = useAuthStore()

function logout() { auth.logout(); router.push('/login') }
const selected = ref(null)
const searchQ = ref('')
const newChatOpen = ref(false)
const pickerQ = ref('')
const contacts = ref([])
const messages = ref([])
const msgContainer = ref(null)
const editorEl = ref(null)
const photoInputEl = ref(null)
const uploading = ref(false)
const showEmoji = ref(false)
const activeFormats = ref({ bold: false, italic: false, underline: false })
let pollTimer = null

const emojiCategories = {
  'Smileys': ['😀','😂','😅','😍','🥹','😎','🤔','😢','😭','😤','🥳','😇','🤩','😏','😴'],
  'Gestures': ['👍','👎','👏','🙏','🤝','✌️','🤞','💪','🙌','👋','🤜','👀'],
  'Hearts': ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','💕','💯','🔥','✨','⭐','🎉','🎊'],
  'Education': ['📚','📖','✏️','📝','🎓','🏆','💡','🔬','🧪','📊','📈','🖥️','⏰','🗓️'],
}

const COLORS = ['#4ade80', '#60a5fa', '#f472b6', '#a78bfa', '#fb923c', '#34d399']

function colorFor(id) {
  return COLORS[id % COLORS.length]
}

function initialsFor(name) {
  return (name || '?').split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase()
}

function bodyPreview(html) {
  if (!html) return ''
  if (/<img/i.test(html)) return '📷 Photo'
  return html.replace(/<[^>]+>/g, '').trim()
}

function fmtTime(iso) {
  if (!iso) return ''
  const d = new Date(iso)
  const now = new Date()
  const isToday = d.toDateString() === now.toDateString()
  if (isToday) return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
  const yesterday = new Date(now); yesterday.setDate(now.getDate() - 1)
  if (d.toDateString() === yesterday.toDateString()) return 'Yesterday'
  return d.toLocaleDateString([], { weekday: 'short' })
}

// Rich text helpers
function fmt(cmd) {
  editorEl.value?.focus()
  document.execCommand(cmd, false, null)
  updateFormats()
}

function updateFormats() {
  activeFormats.value = {
    bold: document.queryCommandState('bold'),
    italic: document.queryCommandState('italic'),
    underline: document.queryCommandState('underline'),
  }
}

function insertEmoji(emoji) {
  editorEl.value?.focus()
  document.execCommand('insertText', false, emoji)
  showEmoji.value = false
}

async function onPhotoSelected(e) {
  const file = e.target.files?.[0]
  if (!file) return
  e.target.value = ''
  uploading.value = true
  try {
    const fd = new FormData()
    fd.append('file', file)
    const res = await messagesApi.uploadImage(fd)
    const url = res.data.data?.url
    if (url && editorEl.value) {
      const img = Object.assign(document.createElement('img'), { src: url, className: 'msg-img', alt: 'photo' })
      editorEl.value.appendChild(img)
      editorEl.value.focus()
    }
  } catch (err) {
    console.error('Photo upload failed:', err?.response?.data || err)
  } finally {
    uploading.value = false
  }
}

function closeEmoji() {
  showEmoji.value = false
  newChatOpen.value = false
}

const conversations = computed(() =>
  contacts.value.map(c => {
    const myMsgs = messages.value
    const lastMsg = selected.value === c.id && myMsgs.length
      ? myMsgs[myMsgs.length - 1]
      : null
    return {
      id: c.id,
      name: c.full_name,
      initials: initialsFor(c.full_name),
      color: colorFor(c.id),
      online: false,
      time: lastMsg ? fmtTime(lastMsg.created_at) : '',
      preview: lastMsg ? bodyPreview(lastMsg.body || '') : '',
    }
  })
)

const filteredConvs = computed(() =>
  conversations.value.filter(c =>
    c.name.toLowerCase().includes(searchQ.value.toLowerCase()) ||
    c.preview.toLowerCase().includes(searchQ.value.toLowerCase())
  )
)

const filteredPickerConvs = computed(() => {
  const q = pickerQ.value.toLowerCase()
  return conversations.value.filter(c => !q || c.name.toLowerCase().includes(q))
})

function startNewChat(c) {
  selected.value = c.id
  newChatOpen.value = false
  pickerQ.value = ''
}

const activeConv = computed(() =>
  conversations.value.find(c => c.id === selected.value) || null
)

const mappedMessages = computed(() =>
  messages.value.map(m => ({
    id: m.id,
    text: m.body,
    time: fmtTime(m.created_at),
    mine: Number(m.sender_id) === Number(auth.user?.id),
  }))
)

async function loadContacts() {
  try {
    const res = await messagesApi.contacts()
    contacts.value = res.data.data || []
  } catch {
    contacts.value = []
  }
}

async function loadMessages() {
  if (!selected.value) return
  try {
    const res = await messagesApi.list(selected.value)
    messages.value = res.data.data || []
    await nextTick()
    scrollToBottom()
  } catch {
    messages.value = []
  }
}

function scrollToBottom() {
  if (msgContainer.value) {
    msgContainer.value.scrollTop = msgContainer.value.scrollHeight
  }
}

async function sendMessage() {
  const html = editorEl.value?.innerHTML?.trim()
  const hasContent = !!(editorEl.value?.innerText?.trim() || editorEl.value?.querySelector('img'))
  if (!hasContent || !selected.value) return
  if (editorEl.value) editorEl.value.innerHTML = ''
  showEmoji.value = false
  try {
    await messagesApi.send({ to_user_id: selected.value, body: html })
    await loadMessages()
  } catch {
    if (editorEl.value) editorEl.value.innerHTML = html
  }
}

watch(selected, async (id) => {
  messages.value = []
  if (editorEl.value) editorEl.value.innerHTML = ''
  if (id) await loadMessages()
})

function startPolling() {
  stopPolling()
  pollTimer = setInterval(() => {
    if (selected.value) loadMessages()
  }, 5000)
}

function stopPolling() {
  if (pollTimer) { clearInterval(pollTimer); pollTimer = null }
}

onMounted(async () => {
  await auth.init()
  await loadContacts()
  if (contacts.value.length) selected.value = contacts.value[0].id
  startPolling()
  document.addEventListener('click', closeEmoji)
})

onUnmounted(() => {
  stopPolling()
  document.removeEventListener('click', closeEmoji)
})
</script>

<style scoped>
.lms-wrap { display: flex; min-height: 100vh; background: #7b1f1f; font-family: 'Inter', system-ui, sans-serif; }

/* Sidebar */
.lms-sidebar { width: 240px; flex-shrink: 0; display: flex; flex-direction: column; padding: 1.75rem 1rem 1.5rem; }
.sidebar-logo { padding: 0 0.5rem 2rem; }
.sidebar-logo-img { height: 34px; width: auto; filter: brightness(0) invert(1); }
.sidebar-nav { display: flex; flex-direction: column; gap: 4px; flex: 1; }
.nav-item { display: flex; align-items: center; gap: .85rem; padding: .7rem 1rem; border-radius: 12px; color: rgba(255,255,255,.6); font-size: .9rem; font-weight: 500; text-decoration: none; cursor: pointer; transition: background .15s, color .15s; }
.nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
.nav-item--active { background: #fff; color: #7b1f1f !important; }
.nav-item--logout { border: none; background: none; cursor: pointer; width: 100%; margin-top: 0.5rem; }


.support-card { margin-top: 2rem; background: #fff; border-radius: 16px; padding: 1.1rem 1rem 0; overflow: hidden; }
.support-text { padding-bottom: .75rem; }
.support-title { font-size: .9rem; font-weight: 700; color: #111; margin: 0 0 .15rem; }
.support-sub { font-size: .72rem; color: #9ca3af; margin: 0 0 .6rem; }
.support-btn { background: #7b1f1f; color: #fff; border: none; padding: .35rem .9rem; border-radius: 8px; font-size: .8rem; font-weight: 600; cursor: pointer; }
.support-img { display: block; margin: 0 auto; }

/* Panel */
.lms-panel { flex: 1; background: #fff; border-radius: 24px 0 0 24px; display: flex; flex-direction: column; height: 100vh; overflow: hidden; }

.lms-topbar { display: flex; align-items: center; padding: 1.25rem 2rem; gap: 1rem; background: #fff; border-bottom: 1px solid #f3f4f6; flex-shrink: 0; }
.topbar-search { flex: 1; max-width: 480px; display: flex; align-items: center; gap: .6rem; background: #f3f4f6; border-radius: 12px; padding: .6rem 1rem; }
.search-input { border: none; background: transparent; outline: none; font-size: .9rem; color: #374151; width: 100%; }
.search-input::placeholder { color: #9ca3af; }
.topbar-right { display: flex; align-items: center; gap: .7rem; margin-left: auto; }
.icon-btn { width: 40px; height: 40px; border-radius: 50%; background: transparent; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; }
.icon-btn--red { background: #7b1f1f; }

/* Messages layout */
.messages-layout { display: flex; flex: 1; overflow: hidden; }

/* Conversation list */
.conv-list { width: 300px; flex-shrink: 0; border-right: 1px solid #f0f0f0; background: #fff; display: flex; flex-direction: column; overflow-y: auto; }
.conv-list-header { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.25rem .5rem; }
.conv-title { font-size: 1.1rem; font-weight: 800; color: #111827; margin: 0; }
.compose-btn { background: none; border: none; color: #6b7280; cursor: pointer; padding: .3rem; border-radius: 6px; }
.compose-btn:hover { background: #f3f4f6; color: #111; }

.conv-search { display: flex; align-items: center; gap: .5rem; margin: 0 1rem .75rem; background: #f3f4f6; border-radius: 10px; padding: .5rem .75rem; }
.conv-search-input { border: none; background: transparent; outline: none; font-size: .83rem; color: #374151; width: 100%; }
.conv-search-input::placeholder { color: #9ca3af; }

.conv-item { display: flex; align-items: flex-start; gap: .75rem; padding: .85rem 1.25rem; cursor: pointer; border-left: 3px solid transparent; transition: background .12s, border-color .12s; }
.conv-item:hover { background: #fafafa; }
.conv-item--active { background: #fff7f7; border-left-color: #7b1f1f; }

.avatar-wrap { position: relative; flex-shrink: 0; }
.conv-avatar { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .8rem; font-weight: 700; color: #fff; }
.conv-avatar.sm { width: 34px; height: 34px; font-size: .72rem; }
.online-dot { position: absolute; bottom: 1px; right: 1px; width: 10px; height: 10px; border-radius: 50%; background: #22c55e; border: 2px solid #fff; }

.conv-info { flex: 1; min-width: 0; }
.conv-name-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: .2rem; }
.conv-name { font-size: .875rem; font-weight: 600; color: #111827; }
.conv-time { font-size: .7rem; color: #9ca3af; white-space: nowrap; }
.conv-preview { font-size: .78rem; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0; }
.conv-badge { flex-shrink: 0; background: #7b1f1f; color: #fff; font-size: .65rem; font-weight: 700; padding: 2px 6px; border-radius: 99px; }

/* Chat area */
.chat-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; background: #fff; }

.chat-header { display: flex; align-items: center; gap: .85rem; padding: 1rem 1.5rem; border-bottom: 1px solid #f0f0f0; flex-shrink: 0; }
.chat-header-info { flex: 1; }
.chat-name { font-size: .95rem; font-weight: 700; color: #111827; margin: 0 0 .1rem; }
.chat-status { font-size: .75rem; color: #9ca3af; margin: 0; }
.chat-status.online { color: #22c55e; }
.chat-actions { display: flex; align-items: center; gap: .25rem; margin-left: auto; }
.chat-action-btn { width: 34px; height: 34px; background: none; border: none; cursor: pointer; color: #9ca3af; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
.chat-action-btn:hover { background: #f3f4f6; color: #374151; }

.chat-messages { flex: 1; overflow-y: auto; padding: 1.25rem 1.5rem; display: flex; flex-direction: column; gap: 1.1rem; }

.date-sep { display: flex; align-items: center; justify-content: center; margin: .5rem 0; }
.date-sep span { font-size: .72rem; font-weight: 600; color: #9ca3af; background: #f3f4f6; padding: .2rem .75rem; border-radius: 99px; letter-spacing: .05em; }

.msg-row { display: flex; align-items: flex-end; gap: .6rem; }
.msg-row--mine { flex-direction: row-reverse; }

.msg-col { display: flex; flex-direction: column; align-items: flex-start; gap: .25rem; max-width: 65%; }
.msg-row--mine .msg-col { align-items: flex-end; }

.msg-bubble { background: #f3f4f6; color: #111827; padding: .7rem 1rem; border-radius: 16px 16px 16px 4px; font-size: .875rem; line-height: 1.5; }
.msg-bubble--mine { background: #4b5563; color: #fff; border-radius: 16px 16px 4px 16px; }
.msg-time { font-size: .68rem; color: #9ca3af; }

.msg-file { display: flex; align-items: center; gap: .5rem; margin-top: .6rem; background: rgba(0,0,0,.06); border-radius: 10px; padding: .5rem .75rem; }
.msg-bubble--mine .msg-file { background: rgba(255,255,255,.12); }
.msg-file-info { flex: 1; }
.msg-file-name { display: block; font-size: .8rem; font-weight: 600; }
.msg-file-size { display: block; font-size: .7rem; opacity: .7; }
.msg-file-dl { background: none; border: none; cursor: pointer; color: currentColor; opacity: .7; }
.msg-file-dl:hover { opacity: 1; }

/* Compose */
.chat-compose { border-top: 1px solid #f0f0f0; flex-shrink: 0; }
.compose-toolbar { display: flex; align-items: center; gap: .15rem; padding: .6rem 1.5rem .25rem; border-bottom: 1px solid #f7f7f7; }
.toolbar-btn { width: 28px; height: 28px; background: none; border: none; cursor: pointer; color: #6b7280; border-radius: 5px; font-size: .85rem; display: flex; align-items: center; justify-content: center; }
.toolbar-btn:hover { background: #f3f4f6; color: #111; }
.toolbar-btn--active { background: #e5e7eb; color: #111; }
.toolbar-sep { width: 1px; height: 18px; background: #e5e7eb; margin: 0 .2rem; }

.compose-input-row { padding: .6rem 1.5rem .5rem; }
.compose-editor {
  width: 100%; min-height: 40px; max-height: 120px; overflow-y: auto;
  outline: none; font-size: .9rem; color: #374151; font-family: inherit;
  line-height: 1.5; padding: .2rem 0;
}
.compose-editor:empty::before { content: attr(data-placeholder); color: #9ca3af; pointer-events: none; }
.compose-editor ul, .compose-editor ol { padding-left: 1.25rem; margin: .25rem 0; }

.compose-footer-row { display: flex; align-items: center; justify-content: space-between; padding-top: .4rem; }
.emoji-wrap { position: relative; }
.emoji-btn { background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0; }
.emoji-btn:hover { color: #374151; }
.emoji-panel {
  position: absolute; bottom: calc(100% + 8px); left: 0;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
  box-shadow: 0 8px 24px rgba(0,0,0,.12); padding: .75rem;
  width: 280px; max-height: 260px; overflow-y: auto; z-index: 50;
}
.emoji-cat { margin-bottom: .6rem; }
.emoji-cat-label { font-size: .68rem; font-weight: 700; color: #9ca3af; letter-spacing: .06em; text-transform: uppercase; margin-bottom: .35rem; }
.emoji-grid { display: flex; flex-wrap: wrap; gap: 2px; }
.emoji-item { background: none; border: none; cursor: pointer; font-size: 1.2rem; padding: 3px 4px; border-radius: 6px; line-height: 1; }
.emoji-item:hover { background: #f3f4f6; }

.send-msg-btn { display: flex; align-items: center; gap: .5rem; background: #3b3b4f; color: #fff; border: none; padding: .5rem 1.25rem; border-radius: 10px; font-size: .875rem; font-weight: 600; cursor: pointer; margin-bottom: 1rem; }
.send-msg-btn:hover { background: #2d2d3e; }
.msg-bubble :deep(.msg-img) { max-width: 260px; max-height: 200px; border-radius: 10px; display: block; margin-top: .35rem; }
@keyframes spin { to { transform: rotate(360deg); } }
.spin { animation: spin .8s linear infinite; }

.chat-empty { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .75rem; color: #9ca3af; font-size: .9rem; }

.new-chat-picker { background: #fff; border-bottom: 1px solid #f0f0f0; }
.icon-btn--red { background: #7b1f1f; color: #fff; }

.topbar-user-chip { display: flex; align-items: center; gap: .55rem; padding: .3rem .75rem .3rem .3rem; border: 1px solid #e5e7eb; border-radius: 99px; cursor: pointer; transition: border-color .15s; }
.topbar-user-chip:hover { border-color: #9ca3af; }
.topbar-avatar { width: 30px; height: 30px; border-radius: 50%; background: #7b1f1f; color: #fff; display: flex; align-items: center; justify-content: center; font-size: .78rem; font-weight: 700; overflow: hidden; flex-shrink: 0; }
.topbar-avatar-img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
.topbar-user-name { font-size: .82rem; font-weight: 600; color: #374151; white-space: nowrap; max-width: 120px; overflow: hidden; text-overflow: ellipsis; }
</style>
