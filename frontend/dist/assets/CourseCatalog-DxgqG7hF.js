import{B as R,A as j,C as F,p as a,c as l,D as _,E as G,j as m,t as s,e as f,u as I,m as T,g as L,w as h,b as t,d as o,f as C,a as J,s as Q,h as W,i as z,n as e1,F as y,r as S,k as t1,l as V,z as E,o as n1,q as Z}from"./index-DldI0psL.js";import{_ as N}from"./logo-BFtGSJwt.js";import{u as s1}from"./courses-BdwMzXpI.js";import{_ as A}from"./_plugin-vue_export-helper-DlAUqK2U.js";var a1=`
    .p-skeleton {
        display: block;
        overflow: hidden;
        background: dt('skeleton.background');
        border-radius: dt('skeleton.border.radius');
    }

    .p-skeleton::after {
        content: '';
        animation: p-skeleton-animation 1.2s infinite;
        height: 100%;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transform: translateX(-100%);
        z-index: 1;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0), dt('skeleton.animation.background'), rgba(255, 255, 255, 0));
    }

    [dir='rtl'] .p-skeleton::after {
        animation-name: p-skeleton-animation-rtl;
    }

    .p-skeleton-circle {
        border-radius: 50%;
    }

    .p-skeleton-animation-none::after {
        animation: none;
    }

    @keyframes p-skeleton-animation {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(100%);
        }
    }

    @keyframes p-skeleton-animation-rtl {
        from {
            transform: translateX(100%);
        }
        to {
            transform: translateX(-100%);
        }
    }
`,r1={root:{position:"relative"}},o1={root:function(r){var n=r.props;return["p-skeleton p-component",{"p-skeleton-circle":n.shape==="circle","p-skeleton-animation-none":n.animation==="none"}]}},i1=R.extend({name:"skeleton",style:a1,classes:o1,inlineStyles:r1}),l1={name:"BaseSkeleton",extends:j,props:{shape:{type:String,default:"rectangle"},size:{type:String,default:null},width:{type:String,default:"100%"},height:{type:String,default:"1rem"},borderRadius:{type:String,default:null},animation:{type:String,default:"wave"}},style:i1,provide:function(){return{$pcSkeleton:this,$parentInstance:this}}};function w(e){"@babel/helpers - typeof";return w=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(r){return typeof r}:function(r){return r&&typeof Symbol=="function"&&r.constructor===Symbol&&r!==Symbol.prototype?"symbol":typeof r},w(e)}function d1(e,r,n){return(r=c1(r))in e?Object.defineProperty(e,r,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[r]=n,e}function c1(e){var r=u1(e,"string");return w(r)=="symbol"?r:r+""}function u1(e,r){if(w(e)!="object"||!e)return e;var n=e[Symbol.toPrimitive];if(n!==void 0){var v=n.call(e,r);if(w(v)!="object")return v;throw new TypeError("@@toPrimitive must return a primitive value.")}return(r==="string"?String:Number)(e)}var X={name:"Skeleton",extends:l1,inheritAttrs:!1,computed:{containerStyle:function(){return this.size?{width:this.size,height:this.size,borderRadius:this.borderRadius}:{width:this.width,height:this.height,borderRadius:this.borderRadius}},dataP:function(){return F(d1({},this.shape,this.shape))}}},p1=["data-p"];function h1(e,r,n,v,i,d){return a(),l("div",_({class:e.cx("root"),style:[e.sx("root"),d.containerStyle],"aria-hidden":"true"},e.ptmi("root"),{"data-p":d.dataP}),null,16,p1)}X.render=h1;var m1=`
    .p-progressbar {
        display: block;
        position: relative;
        overflow: hidden;
        height: dt('progressbar.height');
        background: dt('progressbar.background');
        border-radius: dt('progressbar.border.radius');
    }

    .p-progressbar-value {
        margin: 0;
        background: dt('progressbar.value.background');
    }

    .p-progressbar-label {
        color: dt('progressbar.label.color');
        font-size: dt('progressbar.label.font.size');
        font-weight: dt('progressbar.label.font.weight');
    }

    .p-progressbar-determinate .p-progressbar-value {
        height: 100%;
        width: 0%;
        position: absolute;
        display: none;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: width 1s ease-in-out;
    }

    .p-progressbar-determinate .p-progressbar-label {
        display: inline-flex;
    }

    .p-progressbar-indeterminate .p-progressbar-value::before {
        content: '';
        position: absolute;
        background: inherit;
        inset-block-start: 0;
        inset-inline-start: 0;
        inset-block-end: 0;
        will-change: inset-inline-start, inset-inline-end;
        animation: p-progressbar-indeterminate-anim 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
    }

    .p-progressbar-indeterminate .p-progressbar-value::after {
        content: '';
        position: absolute;
        background: inherit;
        inset-block-start: 0;
        inset-inline-start: 0;
        inset-block-end: 0;
        will-change: inset-inline-start, inset-inline-end;
        animation: p-progressbar-indeterminate-anim-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
        animation-delay: 1.15s;
    }

    @keyframes p-progressbar-indeterminate-anim {
        0% {
            inset-inline-start: -35%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
        100% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
    }
    @-webkit-keyframes p-progressbar-indeterminate-anim {
        0% {
            inset-inline-start: -35%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
        100% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
    }

    @keyframes p-progressbar-indeterminate-anim-short {
        0% {
            inset-inline-start: -200%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
        100% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
    }
    @-webkit-keyframes p-progressbar-indeterminate-anim-short {
        0% {
            inset-inline-start: -200%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
        100% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
    }
`,v1={root:function(r){var n=r.instance;return["p-progressbar p-component",{"p-progressbar-determinate":n.determinate,"p-progressbar-indeterminate":n.indeterminate}]},value:"p-progressbar-value",label:"p-progressbar-label"},g1=R.extend({name:"progressbar",style:m1,classes:v1}),C1={name:"BaseProgressBar",extends:j,props:{value:{type:Number,default:null},mode:{type:String,default:"determinate"},showValue:{type:Boolean,default:!0}},style:g1,provide:function(){return{$pcProgressBar:this,$parentInstance:this}}},D={name:"ProgressBar",extends:C1,inheritAttrs:!1,computed:{progressStyle:function(){return{width:this.value+"%",display:"flex"}},indeterminate:function(){return this.mode==="indeterminate"},determinate:function(){return this.mode==="determinate"},dataP:function(){return F({determinate:this.determinate,indeterminate:this.indeterminate})}}},b1=["aria-valuenow","data-p"],f1=["data-p"],k1=["data-p"],y1=["data-p"];function _1(e,r,n,v,i,d){return a(),l("div",_({role:"progressbar",class:e.cx("root"),"aria-valuemin":"0","aria-valuenow":e.value,"aria-valuemax":"100","data-p":d.dataP},e.ptmi("root")),[d.determinate?(a(),l("div",_({key:0,class:e.cx("value"),style:d.progressStyle,"data-p":d.dataP},e.ptm("value")),[e.value!=null&&e.value!==0&&e.showValue?(a(),l("div",_({key:0,class:e.cx("label"),"data-p":d.dataP},e.ptm("label")),[G(e.$slots,"default",{},function(){return[m(s(e.value+"%"),1)]})],16,k1)):f("",!0)],16,f1)):d.indeterminate?(a(),l("div",_({key:1,class:e.cx("value"),"data-p":d.dataP},e.ptm("value")),null,16,y1)):f("",!0)],16,b1)}D.render=_1;const w1={class:"card-img"},$1=["src","alt"],S1=["src"],V1={key:2,class:"card-img-placeholder"},L1={class:"card-body"},B1={class:"card-meta"},M1={class:"subject-badge"},x1={key:0,class:"price-wrap"},P1={key:0,class:"price-old"},H1={class:"price-now"},z1={key:1,class:"price-now"},E1={class:"card-title"},Z1={class:"author-row"},N1={class:"author-name"},R1={key:0,class:"author-reviews"},j1={class:"card-stats"},F1={class:"stat-item"},I1={class:"stat-item"},T1={class:"stat-item"},A1={key:0,class:"card-progress"},X1={class:"progress-info"},D1={__name:"CourseCard",props:{course:{type:Object,required:!0},progress:{type:Number,default:void 0}},setup(e){const{t:r}=I();function n(v){const i=Number(v)||0,d=Math.floor(i/3600),b=Math.floor(i%3600/60);return!d&&!b?"—":d?b?`${d}h ${b}m`:`${d}h`:`${b}m`}return(v,i)=>{const d=T("RouterLink");return a(),L(d,{to:`/courses/${e.course.id}`,class:"course-card"},{default:h(()=>[t("div",w1,[e.course.cover_image?(a(),l("img",{key:0,src:e.course.cover_image,alt:e.course.title,class:"card-img-el"},null,8,$1)):e.course.first_video_url?(a(),l("video",{key:1,src:e.course.first_video_url,class:"card-img-el",muted:"",preload:"metadata",onLoadedmetadata:i[0]||(i[0]=b=>{b.target.currentTime=1})},null,40,S1)):(a(),l("div",V1,[...i[1]||(i[1]=[t("svg",{width:"40",height:"40",viewBox:"0 0 24 24",fill:"none"},[t("path",{d:"M15 10l4.553-2.277A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z",stroke:"#ccc","stroke-width":"1.5","stroke-linecap":"round","stroke-linejoin":"round"})],-1)])]))]),t("div",L1,[t("div",B1,[t("span",M1,s(e.course.subject||o(r)("common.general")),1),e.course.price>0?(a(),l("div",x1,[e.course.original_price&&e.course.original_price>e.course.price?(a(),l("span",P1," $"+s(Number(e.course.original_price).toFixed(2)),1)):f("",!0),t("span",H1,"$"+s(Number(e.course.price).toFixed(2)),1)])):(a(),l("span",z1,s(o(r)("common.free")),1))]),t("h3",E1,s(e.course.title),1),t("div",Z1,[i[2]||(i[2]=t("div",{class:"author-avatar"},null,-1)),t("span",N1,s(e.course.teacher_name||"Bridge"),1),e.course.students_count>0?(a(),l("span",R1," ("+s(e.course.students_count)+" "+s(o(r)("admin.students"))+") ",1)):f("",!0)])]),i[8]||(i[8]=t("div",{class:"card-divider"},null,-1)),t("div",j1,[t("span",F1,[i[3]||(i[3]=t("svg",{width:"14",height:"17",viewBox:"0 0 16 19",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[t("path",{d:"M2.83088 13.8532H12.4077C13.1706 13.8532 13.8332 13.5722 14.3953 13.01C14.9575 12.4478 15.2386 11.7853 15.2386 11.0224V2.83088C15.2386 2.02779 14.9575 1.35521 14.3953 0.813124C13.8332 0.27104 13.1706 -1.90735e-06 12.4077 -1.90735e-06H2.83088C2.06795 -1.90735e-06 1.4054 0.27104 0.843241 0.813124C0.28108 1.35521 0 2.02779 0 2.83088V15.2386C0 16.0417 0.28108 16.7142 0.843241 17.2563C1.4054 17.7984 2.06795 18.0694 2.83088 18.0694H12.4077C13.1706 18.0694 13.8332 17.7984 14.3953 17.2563C14.9575 16.7142 15.2386 16.0417 15.2386 15.2386C15.2386 15.0378 15.1683 14.8671 15.0278 14.7266C14.8872 14.5861 14.7166 14.5158 14.5158 14.5158C14.315 14.5158 14.1544 14.5861 14.0339 14.7266C13.9135 14.8671 13.8532 15.0378 13.8532 15.2386C13.8532 15.6401 13.7127 15.9814 13.4316 16.2625C13.1505 16.5436 12.8092 16.6841 12.4077 16.6841H2.83088C2.46949 16.6841 2.14826 16.5436 1.86718 16.2625C1.5861 15.9814 1.44556 15.6401 1.44556 15.2386C1.44556 14.837 1.5861 14.5057 1.86718 14.2447C2.14826 13.9837 2.46949 13.8532 2.83088 13.8532ZM1.44556 2.83088C1.44556 2.42933 1.5861 2.08802 1.86718 1.80694C2.14826 1.52586 2.46949 1.38532 2.83088 1.38532H12.4077C12.8092 1.38532 13.1505 1.52586 13.4316 1.80694C13.7127 2.08802 13.8532 2.42933 13.8532 2.83088V11.0224C13.8532 11.4239 13.7127 11.7552 13.4316 12.0162C13.1505 12.2772 12.8092 12.4077 12.4077 12.4077H2.83088C2.34903 12.4077 1.88725 12.5482 1.44556 12.8293V2.83088ZM4.27644 4.75829C4.27644 4.55751 4.34671 4.38686 4.48725 4.24632C4.62779 4.10578 4.79844 4.03551 4.99921 4.03551H10.2996C10.5004 4.03551 10.671 4.10578 10.8116 4.24632C10.9521 4.38686 11.0224 4.55751 11.0224 4.75829C11.0224 4.95906 10.9521 5.12971 10.8116 5.27025C10.671 5.41079 10.5004 5.48106 10.2996 5.48106H4.99921C4.79844 5.48106 4.62779 5.41079 4.48725 5.27025C4.34671 5.12971 4.27644 4.95906 4.27644 4.75829Z",fill:"#7F7E97"})],-1)),m(" "+s(e.course.lessons_count??0),1)]),i[6]||(i[6]=t("span",{class:"stat-dot"},"•",-1)),t("span",I1,[i[4]||(i[4]=t("svg",{width:"15",height:"15",viewBox:"0 0 16 16",fill:"none"},[t("circle",{cx:"8",cy:"8",r:"6",stroke:"#777","stroke-width":"1.4"}),t("path",{d:"M8 5v3.2l2 1.5",stroke:"#777","stroke-width":"1.3","stroke-linecap":"round","stroke-linejoin":"round"})],-1)),m(" "+s(n(e.course.total_duration_seconds)),1)]),i[7]||(i[7]=t("span",{class:"stat-dot"},"•",-1)),t("span",T1,[i[5]||(i[5]=t("svg",{width:"16",height:"13",viewBox:"0 0 19 15",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[t("path",{d:"M16.7444 2.95135C14.6162 2.06796 12.5081 1.16449 10.42 0.240936C9.97835 0.0803194 9.51657 1.04904e-05 9.03472 1.04904e-05C8.55287 1.04904e-05 8.0911 0.0803194 7.6494 0.240936L1.32509 2.95135C0.923549 3.15213 0.602315 3.42317 0.361389 3.76448C0.120463 4.10579 0 4.49729 0 4.93899C0 5.38069 0.120463 5.77219 0.361389 6.11351C0.602315 6.45482 0.923549 6.70578 1.32509 6.8664L2.83088 7.52895V11.9861C2.83088 12.5884 3.03165 13.0903 3.43319 13.4919C3.83474 13.8934 4.33667 14.0942 4.93898 14.0942H13.1305C13.7328 14.0942 14.2347 13.8934 14.6363 13.4919C15.0378 13.0903 15.2386 12.5884 15.2386 11.9861V10.1189C15.2386 9.91813 15.1683 9.74747 15.0278 9.60693C14.8872 9.46639 14.7266 9.39612 14.5459 9.39612C14.3652 9.39612 14.2046 9.46639 14.0641 9.60693C13.9235 9.74747 13.8532 9.91813 13.8532 10.1189V11.9861C13.8532 12.1868 13.783 12.3575 13.6424 12.498C13.5019 12.6386 13.3312 12.7089 13.1305 12.7089H4.93898C4.73821 12.7089 4.56755 12.6386 4.42701 12.498C4.28647 12.3575 4.2162 12.1868 4.2162 11.9861V8.13126L7.6494 9.57682C8.0911 9.77759 8.55287 9.87797 9.03472 9.87797C9.51657 9.87797 9.97835 9.77759 10.42 9.57682L16.7444 6.8664C17.1459 6.70578 17.4671 6.45482 17.7081 6.11351C17.949 5.77219 18.0694 5.38069 18.0694 4.93899C18.0694 4.49729 17.949 4.10579 17.7081 3.76448C17.4671 3.42317 17.1459 3.15213 16.7444 2.95135ZM16.2023 5.60154C14.0741 6.48493 11.9459 7.38841 9.81773 8.31195C9.57681 8.39226 9.3158 8.43242 9.03472 8.43242C8.75364 8.43242 8.49264 8.39226 8.25171 8.31195L1.86718 5.60154C1.70656 5.52123 1.5861 5.42084 1.50579 5.30038C1.42548 5.17992 1.38532 5.04942 1.38532 4.90888C1.38532 4.76834 1.42548 4.63783 1.50579 4.51737C1.5861 4.39691 1.70656 4.3166 1.86718 4.27645L8.25171 1.56603C8.49264 1.44557 8.75364 1.38533 9.03472 1.38533C9.3158 1.38533 9.57681 1.44557 9.81773 1.56603L16.2023 4.27645C16.3629 4.3166 16.4834 4.39691 16.5637 4.51737C16.644 4.63783 16.6841 4.76834 16.6841 4.90888C16.6841 5.04942 16.644 5.17992 16.5637 5.30038C16.4834 5.42084 16.3629 5.52123 16.2023 5.60154ZM17.3467 8.19149C17.1459 8.19149 16.9853 8.26176 16.8648 8.4023C16.7444 8.54284 16.6841 8.7135 16.6841 8.91427V11.9861C16.6841 12.1868 16.7444 12.3575 16.8648 12.498C16.9853 12.6386 17.1459 12.7089 17.3467 12.7089C17.5474 12.7089 17.7181 12.6386 17.8586 12.498C17.9992 12.3575 18.0694 12.1868 18.0694 11.9861V8.91427C18.0694 8.7135 17.9992 8.54284 17.8586 8.4023C17.7181 8.26176 17.5474 8.19149 17.3467 8.19149Z",fill:"#7F7E97"})],-1)),m(" "+s(e.course.students_count??0),1)])]),e.progress!==void 0?(a(),l("div",A1,[t("div",X1,[t("span",null,s(o(r)("courseCard.progress")),1),t("span",null,s(e.progress)+"%",1)]),C(o(D),{value:e.progress,class:"slim-bar"},null,8,["value"])])):f("",!0)]),_:1},8,["to"])}}},O1=A(D1,[["__scopeId","data-v-9b88b642"]]),q1={class:"page"},K1={class:"header"},U1={key:0,class:"announce-bar"},Y1={class:"header-inner"},G1={class:"nav"},J1={class:"nav-link"},Q1={class:"lang-current"},W1={key:0,class:"lang-dropdown"},ee=["onClick"],te={class:"header-actions"},ne={class:"btn-outline"},se={class:"btn-solid"},ae={class:"catalog-hero"},re={class:"catalog-title"},oe={key:0,class:"catalog-sub"},ie={class:"tabs-wrap"},le={class:"tabs"},de=["onClick"],ce={class:"catalog-body"},ue={key:0,class:"courses-grid"},pe={key:1,class:"empty-state"},he={key:2,class:"courses-grid"},me={class:"see-all-wrap"},ve={class:"btn-see-all"},ge={class:"footer"},Ce={class:"footer-top"},be={class:"footer-nav"},fe={href:"#"},ke={class:"footer-bottom"},ye={class:"footer-copy"},_e={__name:"CourseCatalog",setup(e){const r={mounted(g,u){g._outsideHandler=p=>{g.contains(p.target)||u.value(p)},document.addEventListener("click",g._outsideHandler)},unmounted(g){document.removeEventListener("click",g._outsideHandler)}},{t:n,locale:v}=I(),i=J(),d=n1(),b=s1(),B=[{code:"en",label:"EN"},{code:"kz",label:"KZ"},{code:"ru",label:"RU"}],k=V(!1),M=V(!0),x=V(!0),$=V("all"),O=E(()=>[{key:"all",label:n("courses.tabPopular")},{key:"ielts",label:n("courses.tabEnglish")},{key:"math",label:n("courses.tabMath")},{key:"sat",label:n("courses.tabSat")}]),q={ielts:["english","ielts"],math:["math","mathematics"],sat:["sat","nuet"]},P=E(()=>{if($.value==="all")return b.courses;const g=q[$.value]??[];return b.courses.filter(u=>g.some(p=>(u.subject??"").toLowerCase().includes(p)))});function K(g){v.value=g,localStorage.setItem("locale",g)}function U(){i.logout(),d.push("/")}return Q(async()=>{await b.fetchCourses(),x.value=!1}),(g,u)=>{var H;const p=T("RouterLink");return a(),l("div",q1,[t("header",K1,[M.value?(a(),l("div",U1,[t("span",null,"🚀 "+s(o(n)("landing.announcement")),1),t("button",{class:"bar-close",onClick:u[0]||(u[0]=c=>M.value=!1)},"✕")])):f("",!0),t("div",Y1,[C(p,{to:"/",class:"logo"},{default:h(()=>[...u[2]||(u[2]=[t("img",{src:N,alt:"Bridge",class:"logo-img"},null,-1)])]),_:1}),t("nav",G1,[C(p,{to:"/",class:"nav-link"},{default:h(()=>[m(s(o(n)("header.home")),1)]),_:1}),C(p,{to:"/courses",class:"nav-link"},{default:h(()=>[m(s(o(n)("header.courses")),1)]),_:1}),C(p,{to:"/about",class:"nav-link"},{default:h(()=>[m(s(o(n)("header.about")),1)]),_:1}),o(i).isLoggedIn?(a(),L(p,{key:0,to:o(i).dashboardRoute(),class:"nav-link"},{default:h(()=>[m(s(o(n)("header.myLearning")),1)]),_:1},8,["to"])):f("",!0),t("span",J1,s(o(n)("about.navFounder")),1),W((a(),l("div",{class:"lang-switcher",onClick:u[1]||(u[1]=z(c=>k.value=!k.value,["stop"]))},[t("span",Q1,[m(s(((H=B.find(c=>c.code===o(v)))==null?void 0:H.label)??"EN")+" ",1),(a(),l("svg",{width:"12",height:"12",viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":"2.5",style:e1({transform:k.value?"rotate(180deg)":"",transition:"transform .2s"})},[...u[3]||(u[3]=[t("path",{d:"M6 9l6 6 6-6"},null,-1)])],4))]),k.value?(a(),l("div",W1,[(a(),l(y,null,S(B,c=>t("button",{key:c.code,class:Z(["lang-option",{active:o(v)===c.code}]),onClick:z(Y=>{K(c.code),k.value=!1},["stop"])},s(c.label),11,ee)),64))])):f("",!0)])),[[r,()=>k.value=!1]])]),t("div",te,[o(i).isLoggedIn?(a(),l(y,{key:0},[C(p,{to:o(i).dashboardRoute()},{default:h(()=>[t("button",ne,s(o(n)("header.cabinet")),1)]),_:1},8,["to"]),t("button",{class:"btn-solid",onClick:U},s(o(n)("header.logout")),1)],64)):(a(),L(p,{key:1,to:"/login"},{default:h(()=>[t("button",se,s(o(n)("header.login")),1)]),_:1}))])])]),t("section",ae,[t("h1",re,s(o(n)("courses.heroTitle")),1),o(n)("courses.heroSub")?(a(),l("p",oe,s(o(n)("courses.heroSub")),1)):f("",!0)]),t("div",ie,[t("div",le,[(a(!0),l(y,null,S(O.value,c=>(a(),l("button",{key:c.key,class:Z(["tab-btn",{active:$.value===c.key}]),onClick:Y=>$.value=c.key},s(c.label),11,de))),128))])]),t("main",ce,[x.value?(a(),l("div",ue,[(a(),l(y,null,S(4,c=>C(o(X),{key:c,height:"340px","border-radius":"16px"})),64))])):P.value.length===0?(a(),l("div",pe,[t("p",null,s(o(n)("student.comingSoon")),1)])):(a(),l("div",he,[(a(!0),l(y,null,S(P.value,c=>(a(),L(O1,{key:c.id,course:c},null,8,["course"]))),128))])),t("div",me,[t("button",ve,s(o(n)("landing.allCourses"))+" ↓",1)])]),t("footer",ge,[t("div",Ce,[C(p,{to:"/",class:"footer-logo"},{default:h(()=>[...u[4]||(u[4]=[t("img",{src:N,alt:"Bridge",class:"footer-logo-img"},null,-1)])]),_:1}),t("nav",be,[C(p,{to:"/"},{default:h(()=>[m(s(o(n)("header.home")),1)]),_:1}),C(p,{to:"/courses"},{default:h(()=>[m(s(o(n)("header.courses")),1)]),_:1}),t("a",fe,s(o(n)("about.footerContact")),1),C(p,{to:"/dashboard"},{default:h(()=>[m(s(o(n)("header.myLearning")),1)]),_:1})])]),t("div",ke,[t("span",ye,s(o(n)("about.footerCopy")),1),u[5]||(u[5]=t1('<div class="footer-social" data-v-0428accd><a href="#" aria-label="YouTube" data-v-0428accd><svg width="24" height="24" viewBox="0 0 24 24" fill="none" data-v-0428accd><path d="M17.812 5.01711H6.145C3.855 5.01711 2 6.85211 2 9.11611V14.8841C2 17.1481 3.856 18.9841 6.145 18.9841H17.812C20.102 18.9841 21.957 17.1481 21.957 14.8841V9.11611C21.957 6.85211 20.101 5.01611 17.812 5.01611V5.01711ZM15.009 12.2801L9.552 14.8551C9.51872 14.8711 9.48192 14.8785 9.44503 14.8765C9.40815 14.8744 9.37237 14.8631 9.34103 14.8436C9.3097 14.824 9.28382 14.7968 9.2658 14.7646C9.24779 14.7323 9.23822 14.6961 9.238 14.6591V9.35011C9.23867 9.31299 9.24872 9.27663 9.26722 9.24444C9.28573 9.21224 9.31208 9.18526 9.34382 9.16599C9.37556 9.14673 9.41167 9.13581 9.44877 9.13425C9.48587 9.1327 9.52276 9.14057 9.556 9.15711L15.014 11.8921C15.0504 11.9102 15.0809 11.9383 15.102 11.9729C15.1232 12.0076 15.1341 12.0476 15.1336 12.0882C15.1331 12.1288 15.1211 12.1685 15.0991 12.2026C15.077 12.2367 15.0458 12.2639 15.009 12.2811V12.2801Z" fill="#0F161E" data-v-0428accd></path></svg></a><a href="#" aria-label="Instagram" data-v-0428accd><svg width="24" height="24" viewBox="0 0 24 24" fill="none" data-v-0428accd><path d="M16.017 2H7.947C6.37015 2.00185 4.85844 2.62914 3.74353 3.74424C2.62862 4.85933 2.00159 6.37115 2 7.948L2 16.018C2.00185 17.5948 2.62914 19.1066 3.74424 20.2215C4.85933 21.3364 6.37115 21.9634 7.948 21.965H16.018C17.5948 21.9631 19.1066 21.3359 20.2215 20.2208C21.3364 19.1057 21.9634 17.5938 21.965 16.017V7.947C21.9631 6.37015 21.3359 4.85844 20.2208 3.74353C19.1057 2.62862 17.5938 2.00159 16.017 2V2ZM19.957 16.017C19.957 17.0618 19.5418 18.0638 18.803 18.8026C18.0642 19.5415 17.0622 19.9567 16.017 19.957H7.947C6.90222 19.9567 5.90032 19.5415 5.16165 18.8026C4.42297 18.0638 4.008 17.0618 4.008 16.017V7.947C4.00827 6.90222 4.42349 5.90032 5.16235 5.16165C5.90122 4.42297 6.90322 4.008 7.948 4.008H16.018C17.0628 4.00827 18.0647 4.42349 18.8034 5.16235C19.542 5.90122 19.957 6.90322 19.957 7.948V16.018V16.017Z" fill="#0F161E" data-v-0428accd></path><path d="M11.9821 6.81909C10.6135 6.82121 9.3016 7.36588 8.33397 8.3337C7.36633 9.30152 6.82192 10.6135 6.82007 11.9821C6.82166 13.351 7.36609 14.6634 8.33397 15.6315C9.30185 16.5996 10.6142 17.1442 11.9831 17.1461C13.3522 17.1445 14.6647 16.5999 15.6328 15.6318C16.6009 14.6637 17.1455 13.3512 17.1471 11.9821C17.145 10.6132 16.6 9.30098 15.6318 8.33329C14.6635 7.3656 13.351 6.82141 11.9821 6.82009V6.81909ZM11.9821 15.1381C11.1453 15.1381 10.3428 14.8057 9.75115 14.214C9.15947 13.6223 8.82707 12.8198 8.82707 11.9831C8.82707 11.1463 9.15947 10.3438 9.75115 9.75217C10.3428 9.16049 11.1453 8.82809 11.9821 8.82809C12.8188 8.82809 13.6213 9.16049 14.213 9.75217C14.8047 10.3438 15.1371 11.1463 15.1371 11.9831C15.1371 12.8198 14.8047 13.6223 14.213 14.214C13.6213 14.8057 12.8188 15.1381 11.9821 15.1381Z" fill="#0F161E" data-v-0428accd></path><path d="M17.1559 8.09509C17.8391 8.09509 18.3929 7.54127 18.3929 6.85809C18.3929 6.17492 17.8391 5.62109 17.1559 5.62109C16.4728 5.62109 15.9189 6.17492 15.9189 6.85809C15.9189 7.54127 16.4728 8.09509 17.1559 8.09509Z" fill="#0F161E" data-v-0428accd></path></svg></a></div>',1))])])])}}},Le=A(_e,[["__scopeId","data-v-0428accd"]]);export{Le as default};
