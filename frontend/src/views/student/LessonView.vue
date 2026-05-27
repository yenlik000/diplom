<template>
  <div class="lms-wrap">

    <!-- ── Left Sidebar ─────────────────────────────────────── -->
    <aside class="lms-sidebar">
      <!-- <div class="sidebar-logo">
        <img src="@/assets/logo.png" alt="Bridge" class="sidebar-logo-img" />
      </div> -->

      <nav class="sidebar-nav">
        <RouterLink to="/dashboard" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#lv-home)">
              <path d="M6.56369 11.6129C5.96694 11.6129 5.37604 11.4954 4.82472 11.267C4.27339 11.0386 3.77245 10.7039 3.35049 10.282C2.92852 9.85999 2.5938 9.35905 2.36543 8.80773C2.13707 8.2564 2.01953 7.6655 2.01953 7.06875C2.01953 6.472 2.13707 5.8811 2.36543 5.32978C2.5938 4.77845 2.92852 4.27751 3.35049 3.85554C3.77245 3.43358 4.27339 3.09886 4.82472 2.87049C5.37604 2.64213 5.96694 2.52459 6.56369 2.52459C7.76888 2.52459 8.9247 3.00335 9.7769 3.85554C10.6291 4.70774 11.1079 5.86356 11.1079 7.06875C11.1079 8.27394 10.6291 9.42976 9.7769 10.282C8.9247 11.1342 7.76888 11.6129 6.56369 11.6129ZM7.0686 21.711C5.86341 21.711 4.70759 21.2323 3.85539 20.3801C3.0032 19.5279 2.52444 18.3721 2.52444 17.1669C2.52444 15.9617 3.0032 14.8059 3.85539 13.9537C4.70759 13.1015 5.86341 12.6227 7.0686 12.6227C8.27379 12.6227 9.42961 13.1015 10.2818 13.9537C11.134 14.8059 11.6128 15.9617 11.6128 17.1669C11.6128 18.3721 11.134 19.5279 10.2818 20.3801C9.42961 21.2323 8.27379 21.711 7.0686 21.711ZM17.1667 11.6129C16.57 11.6129 15.9791 11.4954 15.4278 11.267C14.8764 11.0386 14.3755 10.7039 13.9535 10.282C13.5316 9.85999 13.1968 9.35905 12.9685 8.80773C12.7401 8.2564 12.6226 7.6655 12.6226 7.06875C12.6226 6.472 12.7401 5.8811 12.9685 5.32978C13.1968 4.77845 13.5316 4.27751 13.9535 3.85554C14.3755 3.43358 14.8764 3.09886 15.4278 2.87049C15.9791 2.64213 16.57 2.52459 17.1667 2.52459C18.3719 2.52459 19.5277 3.00335 20.3799 3.85554C21.2321 4.70774 21.7109 5.86356 21.7109 7.06875C21.7109 8.27394 21.2321 9.42976 20.3799 10.282C19.5277 11.1342 18.3719 11.6129 17.1667 11.6129ZM17.1667 21.711C15.9615 21.711 14.8057 21.2323 13.9535 20.3801C13.1013 19.5279 12.6226 18.3721 12.6226 17.1669C12.6226 15.9617 13.1013 14.8059 13.9535 13.9537C14.8057 13.1015 15.9615 12.6227 17.1667 12.6227C18.3719 12.6227 19.5277 13.1015 20.3799 13.9537C21.2321 14.8059 21.7109 15.9617 21.7109 17.1669C21.7109 18.3721 21.2321 19.5279 20.3799 20.3801C19.5277 21.2323 18.3719 21.711 17.1667 21.711ZM6.56369 9.59328C7.23324 9.59328 7.87537 9.32731 8.34881 8.85387C8.82225 8.38042 9.08823 7.7383 9.08823 7.06875C9.08823 6.3992 8.82225 5.75708 8.34881 5.28364C7.87537 4.81019 7.23324 4.54422 6.56369 4.54422C5.89414 4.54422 5.25202 4.81019 4.77858 5.28364C4.30514 5.75708 4.03916 6.3992 4.03916 7.06875C4.03916 7.7383 4.30514 8.38042 4.77858 8.85387C5.25202 9.32731 5.89414 9.59328 6.56369 9.59328ZM7.0686 19.6914C7.73815 19.6914 8.38027 19.4254 8.85371 18.952C9.32716 18.4786 9.59313 17.8364 9.59313 17.1669C9.59313 16.4973 9.32716 15.8552 8.85371 15.3818C8.38027 14.9083 7.73815 14.6424 7.0686 14.6424C6.39905 14.6424 5.75693 14.9083 5.28348 15.3818C4.81004 15.8552 4.54406 16.4973 4.54406 17.1669C4.54406 17.8364 4.81004 18.4786 5.28348 18.952C5.75693 19.4254 6.39905 19.6914 7.0686 19.6914ZM17.1667 9.59328C17.8363 9.59328 18.4784 9.32731 18.9518 8.85387C19.4253 8.38042 19.6913 7.7383 19.6913 7.06875C19.6913 6.3992 19.4253 5.75708 18.9518 5.28364C18.4784 4.81019 17.8363 4.54422 17.1667 4.54422C16.4972 4.54422 15.8551 4.81019 15.3816 5.28364C14.9082 5.75708 14.6422 6.3992 14.6422 7.06875C14.6422 7.7383 14.9082 8.38042 15.3816 8.85387C15.8551 9.32731 16.4972 9.59328 17.1667 9.59328ZM17.1667 19.6914C17.8363 19.6914 18.4784 19.4254 18.9518 18.952C19.4253 18.4786 19.6913 17.8364 19.6913 17.1669C19.6913 16.4973 19.4253 15.8552 18.9518 15.3818C18.4784 14.9083 17.8363 14.6424 17.1667 14.6424C16.4972 14.6424 15.8551 14.9083 15.3816 15.3818C14.9082 15.8552 14.6422 16.4973 14.6422 17.1669C14.6422 17.8364 14.9082 18.4786 15.3816 18.952C15.8551 19.4254 16.4972 19.6914 17.1667 19.6914Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="lv-home"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Home</span>
        </RouterLink>

        <RouterLink to="/student/progress" class="nav-item nav-item--active">
          <svg width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M6 13.127H2C1.73478 13.127 1.48043 13.2333 1.29289 13.4227C1.10536 13.6121 1 13.8689 1 14.1367V22.2148C1 22.4827 1.10536 22.7395 1.29289 22.9289C1.48043 23.1182 1.73478 23.2246 2 23.2246H6C6.26522 23.2246 6.51957 23.1182 6.70711 22.9289C6.89464 22.7395 7 22.4827 7 22.2148V14.1367C7 13.8689 6.89464 13.6121 6.70711 13.4227C6.51957 13.2333 6.26522 13.127 6 13.127ZM5 21.2051H3V15.1465H5V21.2051ZM22 9.08789H18C17.7348 9.08789 17.4804 9.19428 17.2929 9.38364C17.1054 9.57301 17 9.82985 17 10.0977V22.2148C17 22.4827 17.1054 22.7395 17.2929 22.9289C17.4804 23.1182 17.7348 23.2246 18 23.2246H22C22.2652 23.2246 22.5196 23.1182 22.7071 22.9289C22.8946 22.7395 23 22.4827 23 22.2148V10.0977C23 9.82985 22.8946 9.57301 22.7071 9.38364C22.5196 9.19428 22.2652 9.08789 22 9.08789ZM21 21.2051H19V11.1074H21V21.2051ZM14 1.00977H10C9.73478 1.00977 9.48043 1.11615 9.29289 1.30552C9.10536 1.49489 9 1.75172 9 2.01953V22.2148C9 22.4827 9.10536 22.7395 9.29289 22.9289C9.48043 23.1182 9.73478 23.2246 10 23.2246H14C14.2652 23.2246 14.5196 23.1182 14.7071 22.9289C14.8946 22.7395 15 22.4827 15 22.2148V2.01953C15 1.75172 14.8946 1.49489 14.7071 1.30552C14.5196 1.11615 14.2652 1.00977 14 1.00977ZM13 21.2051H11V3.0293H13V21.2051Z" fill="currentColor"/>
          </svg>
          <span>Progress</span>
        </RouterLink>

        <RouterLink to="/student/messages" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#lv-msg)">
              <path d="M7.36247 21.0283L3.18143 21.9576C2.64028 22.0779 2.15751 21.5951 2.27779 21.054L3.20708 16.8729C2.42502 15.4101 2.01705 13.7765 2.01954 12.1177C2.01954 6.54051 6.54048 2.01958 12.1177 2.01958C17.6949 2.01958 22.2158 6.54051 22.2158 12.1177C22.2158 17.6949 17.6949 22.2158 12.1177 22.2158C10.4589 22.2183 8.8253 21.8104 7.36247 21.0283ZM7.65531 18.8946L8.31472 19.248C9.48464 19.8732 10.7912 20.199 12.1177 20.1962C13.7155 20.1962 15.2774 19.7224 16.6059 18.8347C17.9344 17.9471 18.9698 16.6854 19.5812 15.2092C20.1927 13.7331 20.3527 12.1088 20.041 10.5417C19.7292 8.9746 18.9598 7.53514 17.83 6.40534C16.7002 5.27554 15.2608 4.50614 13.6937 4.19443C12.1266 3.88272 10.5023 4.0427 9.02617 4.65414C7.55001 5.26559 6.28832 6.30103 5.40064 7.62953C4.51297 8.95804 4.03917 10.5199 4.03917 12.1177C4.03917 13.4648 4.36736 14.7614 4.98839 15.9207L5.34082 16.5801L4.78269 19.0912C4.73458 19.3077 4.92768 19.5008 5.14414 19.4527L7.65531 18.8946Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="lv-msg"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
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
        <h4 class="support-title">Support 24/7</h4>
        <p class="support-sub">Contacts us anytime</p>
        <a class="support-btn" href="https://wa.me/87766253784" target="_blank" rel="noopener">Start</a>
        <div class="support-art">
          <!-- Desk + person illustration -->
          <svg width="110" height="80" viewBox="0 0 110 80" fill="none">
            <!-- floor/shadow -->
            <ellipse cx="60" cy="74" rx="36" ry="5" fill="#f9c6c6" opacity="0.5"/>
            <!-- desk -->
            <rect x="22" y="52" width="76" height="6" rx="3" fill="#e57373"/>
            <rect x="30" y="58" width="6" height="16" rx="2" fill="#c62828"/>
            <rect x="82" y="58" width="6" height="16" rx="2" fill="#c62828"/>
            <!-- monitor -->
            <rect x="48" y="28" width="34" height="24" rx="3" fill="#1e293b"/>
            <rect x="51" y="31" width="28" height="18" rx="2" fill="#3b82f6" opacity="0.8"/>
            <rect x="62" y="52" width="10" height="4" fill="#1e293b"/>
            <rect x="58" y="55" width="18" height="2" rx="1" fill="#1e293b"/>
            <!-- chair back -->
            <rect x="14" y="35" width="10" height="22" rx="5" fill="#b91c1c"/>
            <!-- person body -->
            <rect x="20" y="46" width="18" height="14" rx="4" fill="#7f1d1d"/>
            <!-- person head -->
            <circle cx="29" cy="38" r="8" fill="#fcd5b0"/>
            <!-- hair -->
            <path d="M21 36 Q29 28 37 36" fill="#1e293b"/>
            <!-- arms -->
            <path d="M20 52 Q16 56 20 60" stroke="#fcd5b0" stroke-width="4" stroke-linecap="round"/>
            <path d="M38 52 Q44 54 48 50" stroke="#fcd5b0" stroke-width="4" stroke-linecap="round"/>
            <!-- keyboard hint -->
            <rect x="42" y="50" width="14" height="3" rx="1" fill="#94a3b8"/>
          </svg>
        </div>
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

    <!-- ── Main White Panel ──────────────────────────────────── -->
    <div class="lms-panel">

      <!-- Top bar -->
      <header class="lms-topbar">
        <div class="topbar-search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/>
            <path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input type="text" placeholder="Search..." class="search-input"/>
        </div>
        <div class="topbar-right">
          <button class="icon-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.0766 12.6241C17.2316 11.7154 18.0747 10.4692 18.4885 9.05905C18.9023 7.64887 18.8663 6.14477 18.3855 4.75601C17.9046 3.36725 17.0029 2.16289 15.8057 1.31048C14.6085 0.458069 13.1754 0 11.7058 0C10.2362 0 8.80305 0.458069 7.60587 1.31048C6.40869 2.16289 5.50696 3.36725 5.02613 4.75601C4.5453 6.14477 4.50929 7.64887 4.9231 9.05905C5.33691 10.4692 6.17997 11.7154 7.33499 12.6241C5.35584 13.417 3.62897 14.7322 2.33847 16.4293C1.04797 18.1265 0.242214 20.142 0.0071062 22.2611C-0.00991215 22.4158 0.00370915 22.5723 0.0471921 22.7218C0.090675 22.8712 0.163168 23.0107 0.260532 23.1321C0.457169 23.3773 0.743174 23.5344 1.05563 23.5688C1.36809 23.6032 1.6814 23.512 1.92664 23.3154C2.17188 23.1187 2.32897 22.8327 2.36334 22.5203C2.62203 20.2173 3.72016 18.0903 5.4479 16.5458C7.17565 15.0013 9.41189 14.1474 11.7294 14.1474C14.0468 14.1474 16.2831 15.0013 18.0108 16.5458C19.7386 18.0903 20.8367 20.2173 21.0954 22.5203C21.1274 22.8098 21.2655 23.0771 21.4831 23.2707C21.7007 23.4644 21.9822 23.5706 22.2735 23.5688H22.4031C22.7119 23.5333 22.9942 23.3771 23.1884 23.1344C23.3826 22.8916 23.4729 22.582 23.4398 22.2729C23.2036 20.1478 22.3935 18.1271 21.0964 16.4273C19.7992 14.7275 18.064 13.4128 16.0766 12.6241ZM11.7058 11.7876C10.7738 11.7876 9.86265 11.5113 9.08769 10.9934C8.31273 10.4756 7.70872 9.73964 7.35205 8.87855C6.99537 8.01746 6.90205 7.06994 7.08388 6.15581C7.26571 5.24169 7.71453 4.402 8.37358 3.74295C9.03263 3.0839 9.87231 2.63509 10.7864 2.45326C11.7006 2.27142 12.6481 2.36475 13.5092 2.72142C14.3703 3.0781 15.1063 3.6821 15.6241 4.45707C16.1419 5.23203 16.4183 6.14313 16.4183 7.07517C16.4183 8.32499 15.9218 9.52363 15.038 10.4074C14.1543 11.2911 12.9556 11.7876 11.7058 11.7876Z" fill="#181B1A"/>
            </svg>
          </button>
          <button class="icon-btn icon-btn--red">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
              <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>
      </header>

      <!-- Loading -->
      <div v-if="loading" class="center-spinner">
        <div class="spinner"></div>
      </div>

      <!-- Lesson layout -->
      <div v-else-if="lesson" class="content-grid" :class="{ 'content-grid--ai': showAiChat }">

        <!-- ── Left: Main lesson ─────────────────────────── -->
        <main class="lesson-main">

          <!-- Breadcrumb -->
          <nav class="breadcrumb">
            <span>{{ courseTitle }}</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
              <path d="M9 18l6-6-6-6" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span>{{ moduleTitle }}</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
              <path d="M9 18l6-6-6-6" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="bc-active">{{ lesson.title }}</span>
          </nav>

          <!-- Title + subtitle -->
          <h1 class="lesson-h1">{{ lesson.title }}</h1>
          <p class="lesson-desc">
            {{ stripHtml(lesson.text_content).substring(0, 130) || 'Mastering the timeline: Understanding when to use specific vs. indefinite time frames.' }}
          </p>

          <!-- Video -->
          <div v-if="lesson.video_url" class="video-box">
            <video v-show="!videoError" controls :src="lesson.video_url" class="video-el"
                   @error="videoError = true">
            </video>
            <div v-if="videoError" class="video-error">
              <svg width="28" height="28" fill="none" viewBox="0 0 24 24" style="color:#9ca3af;">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                <line x1="12" y1="8" x2="12" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="16" r="1" fill="currentColor"/>
              </svg>
              <span>Video could not be loaded</span>
            </div>
          </div>

          <!-- Audio player (MP3) -->
          <div v-if="lesson.audio_url" class="audio-box">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" style="flex-shrink:0;color:#7b1f1f;">
              <path d="M9 18V5l12-2v13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="6" cy="18" r="3" stroke="currentColor" stroke-width="2"/>
              <circle cx="18" cy="16" r="3" stroke="currentColor" stroke-width="2"/>
            </svg>
            <span style="font-size:.82rem;font-weight:600;color:#374151;">Audio Lesson</span>
            <audio controls :src="lesson.audio_url" style="flex:1;min-width:0;height:36px;"></audio>
          </div>

          <!-- Tab bar -->
          <div class="tab-bar">
            <button v-for="t in tabs" :key="t.key"
                    class="tab" :class="{ 'tab--active': activeTab === t.key }"
                    @click="t.key === 'self-check' ? goToQuiz() : activeTab = t.key">
              {{ t.label }}
              <span v-if="t.badge" class="tab-badge">{{ t.badge }}</span>
            </button>
          </div>

          <!-- Tab: Materials -->
          <div v-if="activeTab === 'materials'" class="tab-panel">
            <div class="materials-grid">
              <!-- PDF files -->
              <template v-if="lesson.materials?.length">
              <a v-for="m in lesson.materials" :key="m.id"
                 :href="m.file_url" target="_blank" class="mat-card">
                <div class="mat-ico mat-ico--red">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="#dc2626" stroke-width="2"/>
                    <polyline points="14 2 14 8 20 8" stroke="#dc2626" stroke-width="2"/>
                  </svg>
                </div>
                <div class="mat-info">
                  <span class="mat-name">{{ m.title }}</span>
                  <span class="mat-meta">2.4 MB • Essential Reading</span>
                </div>
                <svg class="mat-action" width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
                  <polyline points="7 10 12 15 17 10" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
                  <line x1="12" y1="15" x2="12" y2="3" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </a>
              </template>

              <!-- Fallback PDF card when no materials from DB -->
              <RouterLink v-if="!lesson.materials?.length"
                          :to="`/lessons/${lesson.id}/reader`" class="mat-card mat-card--link">
                <div class="mat-ico mat-ico--red">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="#dc2626" stroke-width="2"/>
                    <polyline points="14 2 14 8 20 8" stroke="#dc2626" stroke-width="2"/>
                  </svg>
                </div>
                <div class="mat-info">
                  <span class="mat-name">Lesson Notes PDF</span>
                  <span class="mat-meta">Essential Reading</span>
                </div>
                <span class="mat-read-btn">Read →</span>
              </RouterLink>

              <!-- Quiz PDF download (shown only when lesson has a quiz) -->
              <button v-if="lesson.homework" class="mat-card mat-card--btn"
                      :disabled="quizPdfLoading" @click="downloadQuizPdf">
                <div class="mat-ico mat-ico--red">
                  <svg v-if="!quizPdfLoading" width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="#dc2626" stroke-width="2"/>
                    <polyline points="14 2 14 8 20 8" stroke="#dc2626" stroke-width="2"/>
                    <line x1="12" y1="18" x2="12" y2="12" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="9 15 12 18 15 15" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  <svg v-else width="20" height="20" viewBox="0 0 24 24" fill="none" class="spin-icon">
                    <circle cx="12" cy="12" r="9" stroke="#dc2626" stroke-width="2" stroke-dasharray="28 56" stroke-linecap="round"/>
                  </svg>
                </div>
                <div class="mat-info">
                  <span class="mat-name">Quiz PDF</span>
                  <span class="mat-meta">{{ lesson.homework.title }}</span>
                </div>
                <svg class="mat-action" width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
                  <polyline points="7 10 12 15 17 10" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
                  <line x1="12" y1="15" x2="12" y2="3" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- Tab: Notes -->
          <div v-else-if="activeTab === 'notes'" class="tab-panel">
            <div v-if="lesson.text_content" class="notes-body" v-html="lesson.text_content"></div>
            <p v-else class="empty-tab">No notes available for this lesson.</p>
            <RouterLink :to="`/lessons/${lesson.id}/notes`" class="open-notes-btn">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              Open Notes Editor
            </RouterLink>
          </div>

          <!-- Tab: AI Questions -->
          <div v-else-if="activeTab === 'ai'" class="tab-panel">
            <div style="display:flex;flex-direction:column;align-items:center;gap:1rem;padding:2rem 1rem;">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                <rect x="2" y="3" width="20" height="14" rx="3" stroke="#7b1f1f" stroke-width="1.5"/>
                <path d="M8 21h8M12 17v4" stroke="#7b1f1f" stroke-width="1.5" stroke-linecap="round"/>
                <circle cx="9" cy="10" r="1.5" fill="#7b1f1f"/>
                <circle cx="15" cy="10" r="1.5" fill="#7b1f1f"/>
                <path d="M9 13s1 1.5 3 1.5 3-1.5 3-1.5" stroke="#7b1f1f" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
              <p style="font-size:.95rem;font-weight:600;color:#111827;margin:0;">Ask AI about this lesson</p>
              <p style="font-size:.82rem;color:#9ca3af;margin:0;text-align:center;">Get instant answers, explanations, and examples from your AI tutor.</p>
              <button @click="openAiChat"
                      style="background:#7b1f1f;color:#fff;border:none;border-radius:10px;padding:.6rem 1.4rem;font-size:.875rem;font-weight:600;cursor:pointer;">
                Open AI Assistant
              </button>
            </div>
          </div>

          <!-- Footer nav -->
          <div class="lesson-footer">
            <button class="btn-prev" @click="goToPrev" :disabled="!prevLesson">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              Previous Lesson
            </button>

            <button v-if="!isCurrentCompleted"
                    class="btn-complete" @click="handleComplete" :disabled="completing">
              {{ completing ? 'Saving…' : 'Complete\nLesson' }}
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <polyline points="22 4 12 14.01 9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>

            <div v-else class="done-badge">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                <polyline points="22 4 12 14.01 9 11.01" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
              </svg>
              Completed
            </div>

            <button class="btn-next" @click="goToNext" :disabled="!nextLesson">
              Next Lesson
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
        </main>

        <!-- ── Right: Module Curriculum ──────────────────── -->
        <aside class="curriculum">
          <div class="curr-head">
            <span class="curr-title">Module Curriculum</span>
            <span class="curr-pct">{{ progress?.percentage ?? 0 }}% Complete</span>
          </div>

          <div class="curr-progress-bg">
            <div class="curr-progress-fill" :style="{ width: (progress?.percentage ?? 0) + '%' }"></div>
          </div>

          <div class="curr-list">
            <template v-for="(mod, mi) in courseModules" :key="mod.id">
              <template v-for="(l, li) in mod.lessons" :key="l.id">
                <RouterLink :to="`/lessons/${l.id}`"
                            class="curr-item"
                            :class="{
                              'curr-item--done':   isCompleted(l.id),
                              'curr-item--active': l.id === lesson.id,
                            }">
                  <!-- Icon -->
                  <div class="curr-icon"
                       :class="{
                         'curr-icon--green': isCompleted(l.id),
                         'curr-icon--red':   !isCompleted(l.id),
                       }">
                    <!-- Completed: check -->
                    <svg v-if="isCompleted(l.id)" width="13" height="13" viewBox="0 0 24 24" fill="none">
                      <polyline points="20 6 9 17 4 12" stroke="#15803d" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <!-- Play icon for all other lessons -->
                    <svg v-else width="10" height="10" viewBox="0 0 24 24" fill="#fff">
                      <path d="M5 3l14 9-14 9V3z"/>
                    </svg>
                  </div>

                  <!-- Text -->
                  <div class="curr-text">
                    <span class="curr-label">
                      {{ l.id === lesson.id ? 'CURRENTLY PLAYING' : (isCompleted(l.id) ? `LESSON ${li + 1}` : `LESSON ${li + 1}`) }}
                    </span>
                    <span class="curr-name"
                          :class="{ 'curr-name--done': isCompleted(l.id), 'curr-name--red': l.id === lesson.id }">
                      {{ l.title }}
                    </span>
                  </div>

                  <!-- Completion time -->
                  <span v-if="isCompleted(l.id)" class="curr-dur">{{ completedTimes[l.id] ?? '' }}</span>
                </RouterLink>
              </template>
            </template>
          </div>

          <!-- AI Assistant button -->
          <button class="ai-btn" @click="openAiChat">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="ai-btn-text">
              <span class="ai-btn-label">AI ASSISTANT</span>
              <span class="ai-btn-sub">Stuck? Ask a Question</span>
            </div>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
        </aside>

        <!-- ── AI Chat Panel ────────────────────────────────── -->
        <div v-if="showAiChat" class="ai-chat-panel">
          <!-- Header -->
          <div class="aip-head">
            <div class="aip-head-left">
              <div class="aip-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <rect x="2" y="3" width="20" height="14" rx="3" stroke="currentColor" stroke-width="2"/>
                  <path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <circle cx="9" cy="10" r="1.5" fill="currentColor"/>
                  <circle cx="15" cy="10" r="1.5" fill="currentColor"/>
                  <path d="M9 13s1 1.5 3 1.5 3-1.5 3-1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
              </div>
              <div>
                <div class="aip-title">Bridge AI Assistant</div>
                <div class="aip-model">Connected to {{ courseTitle }} Model</div>
              </div>
            </div>
            <div class="aip-head-right">
              <button class="aip-reset" @click="resetChat">Reset Conversation</button>
              <button class="aip-close" @click="showAiChat = false">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- Messages -->
          <div class="aip-messages" ref="messagesEl">
            <div v-for="(msg, idx) in chatMessages" :key="idx"
                 class="aip-msg" :class="msg.role === 'user' ? 'aip-msg--user' : 'aip-msg--ai'">
              <!-- AI avatar -->
              <div v-if="msg.role === 'assistant'" class="aip-avatar aip-avatar--ai">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <rect x="2" y="3" width="20" height="14" rx="3" stroke="currentColor" stroke-width="2"/>
                  <circle cx="9" cy="10" r="1.5" fill="currentColor"/>
                  <circle cx="15" cy="10" r="1.5" fill="currentColor"/>
                  <path d="M9 13s1 1.5 3 1.5 3-1.5 3-1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
              </div>

              <div class="aip-bubble-wrap">
                <div class="aip-bubble">{{ msg.content }}</div>
                <div class="aip-time">
                  {{ msg.role === 'assistant' ? 'AI Assistant' : 'You' }} • {{ msg.time }}
                </div>
                <!-- Quick action pills after last AI message -->
                <div v-if="msg.role === 'assistant' && idx === chatMessages.length - 1 && quickActions.length"
                     class="aip-pills">
                  <button v-for="pill in quickActions" :key="pill" class="aip-pill"
                          @click="sendQuick(pill)">{{ pill }}</button>
                </div>
              </div>

              <!-- User avatar -->
              <div v-if="msg.role === 'user'" class="aip-avatar aip-avatar--user">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                  <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
            </div>

            <!-- Typing indicator -->
            <div v-if="chatLoading" class="aip-msg aip-msg--ai">
              <div class="aip-avatar aip-avatar--ai">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <rect x="2" y="3" width="20" height="14" rx="3" stroke="currentColor" stroke-width="2"/>
                  <circle cx="9" cy="10" r="1.5" fill="currentColor"/>
                  <circle cx="15" cy="10" r="1.5" fill="currentColor"/>
                </svg>
              </div>
              <div class="aip-bubble aip-bubble--typing">
                <span></span><span></span><span></span>
              </div>
            </div>
          </div>

          <!-- Input -->
          <div class="aip-input-area">
            <div class="aip-input-box">
              <input v-model="chatInput"
                     class="aip-input"
                     :placeholder="`Ask a question about ${lesson?.title ?? 'this lesson'}...`"
                     @keydown.enter.exact.prevent="sendMessage" />
              <div class="aip-input-icons">
                <button class="aip-icon-btn" title="Voice"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z" stroke="currentColor" stroke-width="2"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
                <button class="aip-icon-btn" title="Attach"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
                <button class="aip-icon-btn" title="Image"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
              </div>
            </div>
            <button class="aip-send" :disabled="!chatInput.trim() || chatLoading" @click="sendMessage">
              Ask AI
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M22 2L11 13M22 2L15 22l-4-9-9-4 19-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
          </div>
          <p class="aip-disclaimer">Bridge AI can make mistakes. Verify important information with your course instructor.</p>
        </div>
      </div>

      <!-- Not found -->
      <div v-else class="center-spinner">
        <p style="color:#9ca3af">Lesson not found.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch, nextTick } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { lessonsApi, progressApi, aiApi, homeworkApi } from '@/api'
import { useCoursesStore } from '@/stores/courses'
import { useAuthStore } from '@/stores/auth'

const route  = useRoute()
const router = useRouter()
const store  = useCoursesStore()
const auth   = useAuthStore()

function logout() { auth.logout(); router.push('/login') }

const loading        = ref(true)
const completing     = ref(false)
const videoError     = ref(false)
const quizPdfLoading = ref(false)
const lesson         = ref(null)
const progress       = ref(null)
const completedIds   = ref([])
const completedTimes = ref({})
const courseModules  = ref([])
const activeTab     = ref('materials')

// AI Chat
const showAiChat   = ref(false)
const chatMessages = ref([])
const chatInput    = ref('')
const chatLoading  = ref(false)
const messagesEl   = ref(null)
const quickActions = ref([
  'Give me a practice sentence',
  'Show common exceptions',
  'Why is this important?',
])

const tabs = [
  { key: 'materials',  label: 'Materials' },
  { key: 'notes',      label: 'Notes' },
  { key: 'ai',         label: 'AI Questions', badge: 'New' },
  { key: 'self-check', label: 'Self Check' },
]


const courseTitle = computed(() => store.current?.title ?? 'Course')
const moduleTitle = computed(() => {
  for (const m of courseModules.value) {
    if (m.lessons?.some(l => l.id === lesson.value?.id)) return m.title
  }
  return 'Module'
})

const allLessons = computed(() => courseModules.value.flatMap(m => m.lessons ?? []))

const isCurrentCompleted = computed(() =>
  completedIds.value.includes(Number(route.params.id))
)

const prevLesson = computed(() => {
  const idx = allLessons.value.findIndex(l => l.id === lesson.value?.id)
  return idx > 0 ? allLessons.value[idx - 1] : null
})

const nextLesson = computed(() => {
  const idx = allLessons.value.findIndex(l => l.id === lesson.value?.id)
  return idx >= 0 && idx < allLessons.value.length - 1 ? allLessons.value[idx + 1] : null
})

function isCompleted(id) {
  return completedIds.value.includes(Number(id))
}

function stripHtml(html) {
  return html ? html.replace(/<[^>]*>/g, '') : ''
}

function goToPrev() {
  if (prevLesson.value) router.push(`/lessons/${prevLesson.value.id}`)
}

function goToNext() {
  if (nextLesson.value) router.push(`/lessons/${nextLesson.value.id}`)
}

function goToQuiz() {
  if (!lesson.value?.homework?.id) return
  const mod = moduleTitle.value || courseTitle.value
  router.push({
    path: `/quiz/${lesson.value.homework.id}`,
    query: { module: mod, courseId: lesson.value.course_id },
  })
}

async function downloadQuizPdf() {
  if (!lesson.value?.homework?.id || quizPdfLoading.value) return
  quizPdfLoading.value = true
  try {
    const res = await homeworkApi.get(lesson.value.homework.id)
    const hw  = res.data.data
    const letterLabels = ['A', 'B', 'C', 'D']

    const questionsHtml = hw.questions.map((q, qi) => `
      <div class="question">
        <p class="q-text">${qi + 1}. ${q.question_text}</p>
        <ul class="options">
          ${(q.options || []).map((o, oi) => `
            <li><span class="opt-label">${letterLabels[oi] || oi + 1})</span> ${o.option_text}</li>
          `).join('')}
        </ul>
      </div>
    `).join('')

    const html = `<!DOCTYPE html><html><head>
      <meta charset="utf-8"/>
      <title>${hw.title}</title>
      <style>
        body { font-family: Georgia, serif; max-width: 720px; margin: 40px auto; color: #111; font-size: 14px; }
        h1   { font-size: 20px; margin-bottom: 4px; }
        h2   { font-size: 13px; font-weight: normal; color: #555; margin-bottom: 28px; }
        .question { margin-bottom: 22px; page-break-inside: avoid; }
        .q-text   { font-weight: bold; margin: 0 0 8px; line-height: 1.5; }
        .options  { list-style: none; margin: 0; padding: 0; }
        .options li { margin: 5px 0 5px 12px; line-height: 1.5; }
        .opt-label { display: inline-block; width: 20px; font-weight: bold; }
        hr { border: none; border-top: 1px solid #ddd; margin: 24px 0; }
        @media print { body { margin: 20mm; } }
      </style>
    </head><body>
      <h1>${hw.title}</h1>
      <h2>${lesson.value.title}</h2>
      <hr/>
      ${questionsHtml}
      <script>window.onload = () => { window.print() }<\/script>
    </body></html>`

    const blob = new Blob([html], { type: 'text/html' })
    const url  = URL.createObjectURL(blob)
    const win  = window.open(url, '_blank')
    win?.addEventListener('unload', () => URL.revokeObjectURL(url), { once: true })
  } catch (e) {
    console.error('Quiz PDF error', e)
  } finally {
    quizPdfLoading.value = false
  }
}

async function loadLesson(id) {
  loading.value = true
  videoError.value = false
  try {
    const res = await lessonsApi.get(id)
    lesson.value = res.data.data
    await store.fetchCourse(lesson.value.course_id)
    courseModules.value = store.current?.modules ?? []
    try {
      const prog = await progressApi.course(lesson.value.course_id)
      progress.value       = prog.data.data
      completedIds.value   = (prog.data.data.completed_ids ?? []).map(Number)
      completedTimes.value = prog.data.data.completed_times ?? {}
    } catch { /* not enrolled — progress stays empty */ }
  } finally {
    loading.value = false
  }
}

async function handleComplete() {
  completing.value = true
  try {
    await progressApi.completeLesson(lesson.value.id)
    completedIds.value.push(lesson.value.id)
    const prog = await progressApi.course(lesson.value.course_id)
    progress.value = prog.data.data
  } catch (e) {
    console.error(e)
  } finally {
    completing.value = false
  }
}

function timeLabel() {
  const now = new Date()
  return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

function scrollToBottom() {
  nextTick(() => {
    if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight
  })
}

function openAiChat() {
  showAiChat.value = true
  if (!chatMessages.value.length) {
    chatMessages.value = [{
      role: 'assistant',
      content: `Hello! I'm here to help you with "${lesson.value?.title ?? 'this lesson'}". What would you like to know?`,
      time: 'Just now',
    }]
  }
  scrollToBottom()
}

function resetChat() {
  chatMessages.value = [{
    role: 'assistant',
    content: `Conversation reset. Ask me anything about "${lesson.value?.title ?? 'this lesson'}"!`,
    time: 'Just now',
  }]
}

async function sendMessage() {
  const text = chatInput.value.trim()
  if (!text || chatLoading.value) return
  chatInput.value = ''
  const history = chatMessages.value.slice(-12).map(m => ({ role: m.role, content: m.content }))
  chatMessages.value.push({ role: 'user', content: text, time: timeLabel() })
  scrollToBottom()
  chatLoading.value = true
  try {
    const res = await aiApi.chat({
      lesson_id: lesson.value?.id,
      message:   text,
      history,
    })
    chatMessages.value.push({ role: 'assistant', content: res.data.data?.reply || 'Sorry, I could not generate a response.', time: timeLabel() })
  } catch {
    chatMessages.value.push({ role: 'assistant', content: 'Sorry, something went wrong. Please try again.', time: timeLabel() })
  } finally {
    chatLoading.value = false
    scrollToBottom()
  }
}

function sendQuick(text) {
  chatInput.value = text
  sendMessage()
}

onMounted(() => loadLesson(Number(route.params.id)))
watch(() => route.params.id, id => loadLesson(Number(id)))
</script>

<style scoped>
/* ── Root ───────────────────────────────────────────────── */
.lms-wrap {
  display: flex;
  min-height: 100vh;
  background: #7b1f1f;
  font-family: 'Inter', system-ui, sans-serif;
}

/* ── Sidebar ────────────────────────────────────────────── */
.lms-sidebar {
  width: 240px;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  padding: 1.75rem 1rem 1.5rem;
}

.sidebar-logo { padding: 0 0.5rem 2rem; }
.sidebar-logo-img { height: 34px; width: auto; filter: brightness(0) invert(1); }

.sidebar-nav { display: flex; flex-direction: column; gap: 4px; }

.nav-item {
  display: flex; align-items: center; gap: 0.85rem;
  padding: 0.7rem 1rem; border-radius: 12px;
  color: rgba(255,255,255,.6);
  font-size: 0.9rem; font-weight: 500;
  text-decoration: none; cursor: pointer;
  transition: background .15s, color .15s;
}
.nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
.nav-item--active { background: #fff; color: #7b1f1f !important; }
.nav-item--logout { border: none; background: none; cursor: pointer; width: 100%; margin-top: 0.5rem; }


/* Support card */
.support-card {
  margin-top: auto;
  background: #fff;
  border-radius: 18px;
  padding: 1.25rem 1.25rem 0;
  overflow: hidden;
}
.support-title { font-size: .95rem; font-weight: 700; color: #111; margin: 0 0 .2rem; }
.support-sub   { font-size: .75rem; color: #9ca3af; margin: 0 0 .75rem; }
.support-btn {
  background: #7b1f1f; color: #fff; border: none;
  padding: .4rem 1.1rem; border-radius: 8px;
  font-size: .82rem; font-weight: 600; cursor: pointer;
  display: block; margin-bottom: .5rem;
}
.support-art { display: block; margin: 0 auto; }

/* ── Main Panel ─────────────────────────────────────────── */
.lms-panel {
  flex: 1;
  background: #fff;
  border-radius: 24px 0 0 0;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  min-height: 100vh;
}

/* Top bar */
.lms-topbar {
  display: flex; align-items: center;
  padding: 1.25rem 2rem; gap: 1rem;
  border-bottom: 1px solid #f3f4f6;
  flex-shrink: 0;
}

.topbar-search {
  flex: 1; max-width: 560px;
  display: flex; align-items: center; gap: .65rem;
  background: #f3f4f6; border-radius: 14px;
  padding: .65rem 1.1rem;
}
.search-input {
  border: none; background: transparent; outline: none;
  font-size: .9rem; color: #374151; width: 100%;
}
.search-input::placeholder { color: #9ca3af; }

.topbar-right { display: flex; align-items: center; gap: .7rem; margin-left: auto; }
.icon-btn {
  width: 40px; height: 40px; border-radius: 50%;
  background: transparent; border: none;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: #374151;
}
.icon-btn--red { background: #7b1f1f; }

/* Spinner */
.center-spinner {
  flex: 1; display: flex; align-items: center; justify-content: center;
}
.spinner {
  width: 36px; height: 36px; border-radius: 50%;
  border: 3px solid #f3f4f6; border-top-color: #7b1f1f;
  animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ── Content Grid ───────────────────────────────────────── */
.content-grid {
  flex: 1;
  display: grid;
  grid-template-columns: 1fr 290px;
  overflow: hidden;
}

/* ── Lesson Main ────────────────────────────────────────── */
.lesson-main {
  padding: 2rem 2rem 1.5rem;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
}

/* Breadcrumb */
.breadcrumb {
  display: flex; align-items: center; flex-wrap: wrap;
  gap: .35rem; margin-bottom: .85rem;
  font-size: .78rem; color: #6b7280;
}
.bc-active { color: #374151; font-weight: 500; }

/* Title */
.lesson-h1 {
  font-size: 1.75rem; font-weight: 800; color: #111827;
  margin: 0 0 .4rem; line-height: 1.2;
}
.lesson-desc {
  font-size: .85rem; color: #6b7280; margin: 0 0 1.5rem; line-height: 1.6;
}

/* Video */
.audio-box {
  display: flex; align-items: center; gap: .75rem;
  background: #fdf2f2; border: 1px solid #f5c6c6; border-radius: 12px;
  padding: .75rem 1rem; margin-bottom: 1rem;
}
.video-box {
  border-radius: 14px; overflow: hidden; background: #c8c8c8;
  aspect-ratio: 16/9; margin-bottom: 1.5rem; flex-shrink: 0;
}
.video-el { width: 100%; height: 100%; object-fit: contain; display: block; background: #000; }
.video-error {
  position: absolute; inset: 0;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  gap: .5rem; color: #6b7280; font-size: .85rem;
  background: #1a1a1a;
}
.video-box { position: relative; }

/* Tabs */
.tab-bar {
  display: flex; gap: 0;
  border-bottom: 1.5px solid #f3f4f6;
  margin-bottom: 1.25rem;
}
.tab {
  background: none; border: none;
  padding: .6rem 1.2rem;
  font-size: .88rem; font-weight: 500; color: #6b7280;
  cursor: pointer;
  border-bottom: 2.5px solid transparent;
  margin-bottom: -1.5px;
  display: flex; align-items: center; gap: .4rem;
  white-space: nowrap;
  transition: color .15s, border-color .15s;
}
.tab:hover { color: #374151; }
.tab--active { color: #7b1f1f; border-bottom-color: #7b1f1f; }
.tab-badge {
  background: #7b1f1f; color: #fff;
  font-size: .62rem; font-weight: 700;
  padding: 1px 6px; border-radius: 10px;
}

/* Tab panel */
.tab-panel { margin-bottom: 1rem; }

/* Materials grid */
.materials-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: .85rem;
}

.mat-card {
  display: flex; align-items: center; gap: .85rem;
  padding: 1.1rem 1.1rem;
  text-decoration: none; color: #111827;
  border: 1.5px solid #f3f4f6;
  border-radius: 14px;
  background: #fff;
  cursor: pointer;
  transition: background .15s, border-color .15s, box-shadow .15s;
}
.mat-card:hover {
  background: #fafafa;
  border-color: #e5e7eb;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
}

.mat-ico {
  width: 40px; height: 40px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.mat-ico--red  { background: #fef2f2; }
.mat-ico--blue { background: #eff6ff; }

.mat-info { flex: 1; min-width: 0; }
.mat-name { display: block; font-size: .85rem; font-weight: 600; color: #111827; }
.mat-meta { display: block; font-size: .75rem; color: #9ca3af; margin-top: 1px; }

.mat-action { flex-shrink: 0; }
.mat-card--link { text-decoration: none; }
.mat-card--btn { width: 100%; border: none; text-align: left; }
.mat-card--btn:disabled { opacity: .6; cursor: wait; }
.spin-icon { animation: spin .8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.mat-read-btn {
  flex-shrink: 0; font-size: .78rem; font-weight: 700; color: #7f1d1d;
  background: #fef2f2; border-radius: 8px; padding: 4px 10px;
}

/* Notes */
.notes-body { font-size: .9rem; line-height: 1.8; color: #374151; margin-bottom: 14px; }
.open-notes-btn {
  display: inline-flex; align-items: center; gap: 7px;
  background: #111827; color: #fff; text-decoration: none;
  font-size: .82rem; font-weight: 600; padding: 9px 18px;
  border-radius: 10px; margin-top: 8px; transition: background .15s;
}
.open-notes-btn:hover { background: #1f2937; }

/* Empty tab */
.empty-tab {
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: .65rem; padding: 2.5rem 1rem;
  color: #9ca3af; font-size: .875rem; text-align: center;
}

/* Footer */
.lesson-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding-top: 1.25rem; border-top: 1px solid #f3f4f6;
  margin-top: auto;
}

.btn-prev {
  display: flex; align-items: center; gap: .5rem;
  background: none; border: none;
  font-size: .88rem; font-weight: 500; color: #6b7280;
  cursor: pointer; transition: color .15s;
}
.btn-prev:hover:not(:disabled) { color: #111; }
.btn-prev:disabled { opacity: .4; cursor: not-allowed; }

.btn-complete {
  display: flex; align-items: center; gap: .55rem;
  background: #7b1f1f; color: #fff; border: none;
  padding: .7rem 1.5rem; border-radius: 12px;
  font-size: .88rem; font-weight: 600;
  cursor: pointer; transition: background .15s;
  white-space: pre-line; text-align: center; line-height: 1.3;
}
.btn-complete:hover:not(:disabled) { background: #6b1a1a; }
.btn-complete:disabled { opacity: .6; cursor: not-allowed; }

.done-badge {
  display: flex; align-items: center; gap: .5rem;
  color: #16a34a; font-weight: 600; font-size: .88rem;
}

.btn-next {
  display: flex; align-items: center; gap: .5rem;
  background: none; border: none;
  font-size: .88rem; font-weight: 500; color: #6b7280;
  cursor: pointer; transition: color .15s;
}
.btn-next:hover:not(:disabled) { color: #7b1f1f; }
.btn-next:disabled { opacity: .4; cursor: not-allowed; }

/* ── Curriculum Panel ───────────────────────────────────── */
.curriculum {
  border-left: 1.5px solid #f3f4f6;
  display: flex; flex-direction: column;
  overflow: hidden;
}

.curr-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1.5rem 1.25rem .6rem;
  flex-shrink: 0;
}
.curr-title { font-size: .9rem; font-weight: 700; color: #111827; }
.curr-pct {
  font-size: .7rem; font-weight: 700; color: #7b1f1f;
  background: #fef2f2; padding: 2px 8px; border-radius: 20px;
}

.curr-progress-bg {
  height: 4px; background: #f3f4f6;
  margin: 0 1.25rem .75rem; border-radius: 99px;
  flex-shrink: 0;
}
.curr-progress-fill {
  height: 100%; background: #7b1f1f; border-radius: 99px;
  transition: width .4s ease;
}

.curr-list { flex: 1; overflow-y: auto; padding: 0 .75rem; }

.curr-item {
  display: flex; align-items: center; gap: .65rem;
  padding: .65rem .75rem; border-radius: 10px;
  text-decoration: none; margin-bottom: 2px;
  transition: background .15s; cursor: pointer;
}
.curr-item:hover { background: #f9fafb; }
.curr-item--active { background: #fce7e7 !important; }

.curr-icon {
  width: 28px; height: 28px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.curr-icon--green { background: #dcfce7; }
.curr-icon--red   { background: #7b1f1f; }
.curr-icon--gray  { background: #f3f4f6; }

.curr-text { flex: 1; min-width: 0; }
.curr-label {
  display: block;
  font-size: .62rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .05em;
  margin-bottom: 1px;
  color: #9ca3af;
}
.curr-item--active .curr-label { color: #dc2626; }

.curr-name {
  display: block; font-size: .8rem; font-weight: 500; color: #374151;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.curr-name--done { text-decoration: line-through; color: #9ca3af; }
.curr-name--red  { color: #374151; font-weight: 600; }

.curr-dur { font-size: .7rem; color: #9ca3af; flex-shrink: 0; }

/* ── Content grid AI mode ───────────────────────────────── */
.content-grid--ai {
  grid-template-columns: 1fr 420px;
}

/* ── AI Chat Panel ──────────────────────────────────────── */
.ai-chat-panel {
  border-left: 1.5px solid #f3f4f6;
  display: flex; flex-direction: column;
  overflow: hidden; background: #fff;
}

.aip-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 1.25rem; border-bottom: 1px solid #f3f4f6;
  flex-shrink: 0;
}
.aip-head-left { display: flex; align-items: center; gap: .7rem; }
.aip-icon {
  width: 36px; height: 36px; border-radius: 10px;
  background: #7b1f1f; color: #fff;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.aip-title { font-size: .9rem; font-weight: 700; color: #111827; }
.aip-model { font-size: .72rem; color: #9ca3af; }

.aip-head-right { display: flex; align-items: center; gap: .5rem; }
.aip-reset {
  font-size: .72rem; font-weight: 600; color: #7b1f1f;
  background: none; border: none; cursor: pointer;
  padding: .25rem .5rem; border-radius: 6px;
  transition: background .15s;
}
.aip-reset:hover { background: #fef2f2; }
.aip-close {
  width: 28px; height: 28px; border-radius: 8px;
  background: none; border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  color: #9ca3af; transition: background .15s, color .15s;
}
.aip-close:hover { background: #f3f4f6; color: #374151; }

.aip-messages {
  flex: 1; overflow-y: auto;
  padding: 1rem .85rem;
  display: flex; flex-direction: column; gap: .85rem;
  scroll-behavior: smooth;
}

.aip-msg { display: flex; align-items: flex-start; gap: .6rem; }
.aip-msg--user { flex-direction: row-reverse; }

.aip-avatar {
  width: 30px; height: 30px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.aip-avatar--ai   { background: #7b1f1f; color: #fff; }
.aip-avatar--user { background: #1e3a5f; color: #fff; }

.aip-bubble-wrap { flex: 1; min-width: 0; }
.aip-msg--user .aip-bubble-wrap { display: flex; flex-direction: column; align-items: flex-end; }

.aip-bubble {
  background: #fff; border: 1px solid #f3f4f6;
  border-radius: 14px 14px 14px 4px;
  padding: .75rem .9rem;
  font-size: .85rem; color: #374151; line-height: 1.65;
  box-shadow: 0 1px 4px rgba(0,0,0,.05);
  max-width: 95%;
  white-space: pre-wrap;
}
.aip-msg--user .aip-bubble {
  background: #7b1f1f; color: #fff;
  border-color: #7b1f1f;
  border-radius: 14px 14px 4px 14px;
}

.aip-time {
  font-size: .65rem; color: #9ca3af;
  margin-top: .3rem; padding: 0 .25rem;
}

.aip-pills { display: flex; flex-wrap: wrap; gap: .4rem; margin-top: .6rem; }
.aip-pill {
  font-size: .75rem; font-weight: 500; color: #374151;
  background: #fff; border: 1px solid #e5e7eb;
  border-radius: 20px; padding: .3rem .75rem;
  cursor: pointer; transition: background .15s, border-color .15s;
}
.aip-pill:hover { background: #fef2f2; border-color: #7b1f1f; color: #7b1f1f; }

/* Typing dots */
.aip-bubble--typing {
  display: flex; align-items: center; gap: 4px;
  padding: .7rem .9rem; min-width: 56px;
}
.aip-bubble--typing span {
  display: block; width: 7px; height: 7px; border-radius: 50%;
  background: #9ca3af; animation: dot-bounce .9s infinite ease-in-out;
}
.aip-bubble--typing span:nth-child(2) { animation-delay: .15s; }
.aip-bubble--typing span:nth-child(3) { animation-delay: .3s; }
@keyframes dot-bounce { 0%,80%,100% { transform: scale(.8); opacity:.5; } 40% { transform: scale(1.15); opacity:1; } }

/* Input area */
.aip-input-area {
  padding: .75rem .85rem .4rem;
  border-top: 1px solid #f3f4f6;
  display: flex; gap: .5rem; align-items: flex-end;
  flex-shrink: 0;
}
.aip-input-box {
  flex: 1; border: 1.5px solid #e5e7eb; border-radius: 14px;
  overflow: hidden; background: #fafafa;
  display: flex; flex-direction: column;
  transition: border-color .15s;
}
.aip-input-box:focus-within { border-color: #7b1f1f; background: #fff; }
.aip-input {
  border: none; background: transparent; outline: none;
  padding: .7rem .9rem .4rem;
  font-size: .875rem; color: #374151; font-family: inherit;
  resize: none; min-height: 40px;
}
.aip-input::placeholder { color: #9ca3af; }
.aip-input-icons {
  display: flex; gap: .25rem; padding: .25rem .6rem .45rem;
}
.aip-icon-btn {
  width: 26px; height: 26px; border-radius: 6px;
  background: none; border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  color: #9ca3af; transition: color .15s, background .15s;
}
.aip-icon-btn:hover { color: #374151; background: #f3f4f6; }
.aip-send {
  display: flex; align-items: center; gap: .4rem;
  padding: .65rem 1rem; border-radius: 12px;
  background: #7b1f1f; color: #fff; border: none;
  font-size: .82rem; font-weight: 700; cursor: pointer;
  white-space: nowrap; transition: background .15s;
  align-self: flex-end; margin-bottom: 4px;
}
.aip-send:hover:not(:disabled) { background: #6b1a1a; }
.aip-send:disabled { opacity: .5; cursor: not-allowed; }
.aip-disclaimer {
  font-size: .65rem; color: #9ca3af; text-align: center;
  padding: .3rem .85rem .75rem; flex-shrink: 0;
}

/* AI Assistant button */
.ai-btn {
  display: flex; align-items: center; gap: .8rem;
  padding: 1.1rem 1.25rem;
  background: #1e3a5f; color: #fff;
  border: none; cursor: pointer;
  text-align: left; flex-shrink: 0;
  transition: background .15s;
}
.ai-btn:hover { background: #1a3352; }

.ai-btn-text { flex: 1; display: flex; flex-direction: column; }
.ai-btn-label {
  font-size: .62rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase;
  color: rgba(255,255,255,.55);
}
.ai-btn-sub { font-size: .875rem; font-weight: 600; }
</style>
