import{B as U,C as N,D as p,p as g,c as m,b as a,E as j,a6 as ne,a7 as se,A as oe,m as ae,a8 as ie,g as V,w,q as le,a9 as re,e as O,h as q,a1 as de,u as ce,G as ue,s as ge,a5 as pe,a0 as me,d as s,l as b,f as c,j as A,t as h,i as M,F as he,r as fe,a3 as be,Y as _}from"./index-DldI0psL.js";import{s as ve,a as we,b as C,c as ye,d as x,e as ke,f as L,g as R}from"./index-DSdC9Lnd.js";import{A as xe}from"./AdminLayout-C7JZzf_4.js";import{_ as ze}from"./_plugin-vue_export-helper-DlAUqK2U.js";var $e=`
    .p-textarea {
        font-family: inherit;
        font-feature-settings: inherit;
        font-size: 1rem;
        color: dt('textarea.color');
        background: dt('textarea.background');
        padding-block: dt('textarea.padding.y');
        padding-inline: dt('textarea.padding.x');
        border: 1px solid dt('textarea.border.color');
        transition:
            background dt('textarea.transition.duration'),
            color dt('textarea.transition.duration'),
            border-color dt('textarea.transition.duration'),
            outline-color dt('textarea.transition.duration'),
            box-shadow dt('textarea.transition.duration');
        appearance: none;
        border-radius: dt('textarea.border.radius');
        outline-color: transparent;
        box-shadow: dt('textarea.shadow');
    }

    .p-textarea:enabled:hover {
        border-color: dt('textarea.hover.border.color');
    }

    .p-textarea:enabled:focus {
        border-color: dt('textarea.focus.border.color');
        box-shadow: dt('textarea.focus.ring.shadow');
        outline: dt('textarea.focus.ring.width') dt('textarea.focus.ring.style') dt('textarea.focus.ring.color');
        outline-offset: dt('textarea.focus.ring.offset');
    }

    .p-textarea.p-invalid {
        border-color: dt('textarea.invalid.border.color');
    }

    .p-textarea.p-variant-filled {
        background: dt('textarea.filled.background');
    }

    .p-textarea.p-variant-filled:enabled:hover {
        background: dt('textarea.filled.hover.background');
    }

    .p-textarea.p-variant-filled:enabled:focus {
        background: dt('textarea.filled.focus.background');
    }

    .p-textarea:disabled {
        opacity: 1;
        background: dt('textarea.disabled.background');
        color: dt('textarea.disabled.color');
    }

    .p-textarea::placeholder {
        color: dt('textarea.placeholder.color');
    }

    .p-textarea.p-invalid::placeholder {
        color: dt('textarea.invalid.placeholder.color');
    }

    .p-textarea-fluid {
        width: 100%;
    }

    .p-textarea-resizable {
        overflow: hidden;
        resize: none;
    }

    .p-textarea-sm {
        font-size: dt('textarea.sm.font.size');
        padding-block: dt('textarea.sm.padding.y');
        padding-inline: dt('textarea.sm.padding.x');
    }

    .p-textarea-lg {
        font-size: dt('textarea.lg.font.size');
        padding-block: dt('textarea.lg.padding.y');
        padding-inline: dt('textarea.lg.padding.x');
    }
`,Pe={root:function(e){var n=e.instance,l=e.props;return["p-textarea p-component",{"p-filled":n.$filled,"p-textarea-resizable ":l.autoResize,"p-textarea-sm p-inputfield-sm":l.size==="small","p-textarea-lg p-inputfield-lg":l.size==="large","p-invalid":n.$invalid,"p-variant-filled":n.$variant==="filled","p-textarea-fluid":n.$fluid}]}},Se=U.extend({name:"textarea",style:$e,classes:Pe}),_e={name:"BaseTextarea",extends:ve,props:{autoResize:Boolean},style:Se,provide:function(){return{$pcTextarea:this,$parentInstance:this}}};function I(t){"@babel/helpers - typeof";return I=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol=="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},I(t)}function Ce(t,e,n){return(e=je(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function je(t){var e=Ve(t,"string");return I(e)=="symbol"?e:e+""}function Ve(t,e){if(I(t)!="object"||!t)return t;var n=t[Symbol.toPrimitive];if(n!==void 0){var l=n.call(t,e);if(I(l)!="object")return l;throw new TypeError("@@toPrimitive must return a primitive value.")}return(e==="string"?String:Number)(t)}var W={name:"Textarea",extends:_e,inheritAttrs:!1,observer:null,mounted:function(){var e=this;this.autoResize&&(this.observer=new ResizeObserver(function(){requestAnimationFrame(function(){e.resize()})}),this.observer.observe(this.$el))},updated:function(){this.autoResize&&this.resize()},beforeUnmount:function(){this.observer&&this.observer.disconnect()},methods:{resize:function(){if(this.$el.offsetParent){var e=this.$el.style.height,n=parseInt(e)||0,l=this.$el.scrollHeight,f=!n||l>n,i=n&&l<n;i?(this.$el.style.height="auto",this.$el.style.height="".concat(this.$el.scrollHeight,"px")):f&&(this.$el.style.height="".concat(l,"px"))}},onInput:function(e){this.autoResize&&this.resize(),this.writeValue(e.target.value,e)}},computed:{attrs:function(){return p(this.ptmi("root",{context:{filled:this.$filled,disabled:this.disabled}}),this.formField)},dataP:function(){return N(Ce({invalid:this.$invalid,fluid:this.$fluid,filled:this.$variant==="filled"},this.size,this.size))}}},Oe=["value","name","disabled","aria-invalid","data-p"];function Ie(t,e,n,l,f,i){return g(),m("textarea",p({class:t.cx("root"),value:t.d_value,name:t.name,disabled:t.disabled,"aria-invalid":t.invalid||void 0,"data-p":i.dataP,onInput:e[0]||(e[0]=function(){return i.onInput&&i.onInput.apply(i,arguments)})},i.attrs),null,16,Oe)}W.render=Ie;var Te=`
    .p-toggleswitch {
        display: inline-block;
        width: dt('toggleswitch.width');
        height: dt('toggleswitch.height');
    }

    .p-toggleswitch-input {
        cursor: pointer;
        appearance: none;
        position: absolute;
        top: 0;
        inset-inline-start: 0;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        opacity: 0;
        z-index: 1;
        outline: 0 none;
        border-radius: dt('toggleswitch.border.radius');
    }

    .p-toggleswitch-slider {
        cursor: pointer;
        width: 100%;
        height: 100%;
        border-width: dt('toggleswitch.border.width');
        border-style: solid;
        border-color: dt('toggleswitch.border.color');
        background: dt('toggleswitch.background');
        transition:
            background dt('toggleswitch.transition.duration'),
            color dt('toggleswitch.transition.duration'),
            border-color dt('toggleswitch.transition.duration'),
            outline-color dt('toggleswitch.transition.duration'),
            box-shadow dt('toggleswitch.transition.duration');
        border-radius: dt('toggleswitch.border.radius');
        outline-color: transparent;
        box-shadow: dt('toggleswitch.shadow');
    }

    .p-toggleswitch-handle {
        position: absolute;
        top: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: dt('toggleswitch.handle.background');
        color: dt('toggleswitch.handle.color');
        width: dt('toggleswitch.handle.size');
        height: dt('toggleswitch.handle.size');
        inset-inline-start: dt('toggleswitch.gap');
        margin-block-start: calc(-1 * calc(dt('toggleswitch.handle.size') / 2));
        border-radius: dt('toggleswitch.handle.border.radius');
        transition:
            background dt('toggleswitch.transition.duration'),
            color dt('toggleswitch.transition.duration'),
            inset-inline-start dt('toggleswitch.slide.duration'),
            box-shadow dt('toggleswitch.slide.duration');
    }

    .p-toggleswitch.p-toggleswitch-checked .p-toggleswitch-slider {
        background: dt('toggleswitch.checked.background');
        border-color: dt('toggleswitch.checked.border.color');
    }

    .p-toggleswitch.p-toggleswitch-checked .p-toggleswitch-handle {
        background: dt('toggleswitch.handle.checked.background');
        color: dt('toggleswitch.handle.checked.color');
        inset-inline-start: calc(dt('toggleswitch.width') - calc(dt('toggleswitch.handle.size') + dt('toggleswitch.gap')));
    }

    .p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover) .p-toggleswitch-slider {
        background: dt('toggleswitch.hover.background');
        border-color: dt('toggleswitch.hover.border.color');
    }

    .p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover) .p-toggleswitch-handle {
        background: dt('toggleswitch.handle.hover.background');
        color: dt('toggleswitch.handle.hover.color');
    }

    .p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover).p-toggleswitch-checked .p-toggleswitch-slider {
        background: dt('toggleswitch.checked.hover.background');
        border-color: dt('toggleswitch.checked.hover.border.color');
    }

    .p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover).p-toggleswitch-checked .p-toggleswitch-handle {
        background: dt('toggleswitch.handle.checked.hover.background');
        color: dt('toggleswitch.handle.checked.hover.color');
    }

    .p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:focus-visible) .p-toggleswitch-slider {
        box-shadow: dt('toggleswitch.focus.ring.shadow');
        outline: dt('toggleswitch.focus.ring.width') dt('toggleswitch.focus.ring.style') dt('toggleswitch.focus.ring.color');
        outline-offset: dt('toggleswitch.focus.ring.offset');
    }

    .p-toggleswitch.p-invalid > .p-toggleswitch-slider {
        border-color: dt('toggleswitch.invalid.border.color');
    }

    .p-toggleswitch.p-disabled {
        opacity: 1;
    }

    .p-toggleswitch.p-disabled .p-toggleswitch-slider {
        background: dt('toggleswitch.disabled.background');
    }

    .p-toggleswitch.p-disabled .p-toggleswitch-handle {
        background: dt('toggleswitch.handle.disabled.background');
    }
`,Be={root:{position:"relative"}},Fe={root:function(e){var n=e.instance,l=e.props;return["p-toggleswitch p-component",{"p-toggleswitch-checked":n.checked,"p-disabled":l.disabled,"p-invalid":n.$invalid}]},input:"p-toggleswitch-input",slider:"p-toggleswitch-slider",handle:"p-toggleswitch-handle"},Ae=U.extend({name:"toggleswitch",style:Te,classes:Fe,inlineStyles:Be}),Le={name:"BaseToggleSwitch",extends:we,props:{trueValue:{type:null,default:!0},falseValue:{type:null,default:!1},readonly:{type:Boolean,default:!1},tabindex:{type:Number,default:null},inputId:{type:String,default:null},inputClass:{type:[String,Object],default:null},inputStyle:{type:Object,default:null},ariaLabelledby:{type:String,default:null},ariaLabel:{type:String,default:null}},style:Ae,provide:function(){return{$pcToggleSwitch:this,$parentInstance:this}}},G={name:"ToggleSwitch",extends:Le,inheritAttrs:!1,emits:["change","focus","blur"],methods:{getPTOptions:function(e){var n=e==="root"?this.ptmi:this.ptm;return n(e,{context:{checked:this.checked,disabled:this.disabled}})},onChange:function(e){if(!this.disabled&&!this.readonly){var n=this.checked?this.falseValue:this.trueValue;this.writeValue(n,e),this.$emit("change",e)}},onFocus:function(e){this.$emit("focus",e)},onBlur:function(e){var n,l;this.$emit("blur",e),(n=(l=this.formField).onBlur)===null||n===void 0||n.call(l,e)}},computed:{checked:function(){return this.d_value===this.trueValue},dataP:function(){return N({checked:this.checked,disabled:this.disabled,invalid:this.$invalid})}}},Ue=["data-p-checked","data-p-disabled","data-p"],Ne=["id","checked","tabindex","disabled","readonly","aria-checked","aria-labelledby","aria-label","aria-invalid"],De=["data-p"],Me=["data-p"];function Re(t,e,n,l,f,i){return g(),m("div",p({class:t.cx("root"),style:t.sx("root")},i.getPTOptions("root"),{"data-p-checked":i.checked,"data-p-disabled":t.disabled,"data-p":i.dataP}),[a("input",p({id:t.inputId,type:"checkbox",role:"switch",class:[t.cx("input"),t.inputClass],style:t.inputStyle,checked:i.checked,tabindex:t.tabindex,disabled:t.disabled,readonly:t.readonly,"aria-checked":i.checked,"aria-labelledby":t.ariaLabelledby,"aria-label":t.ariaLabel,"aria-invalid":t.invalid||void 0,onFocus:e[0]||(e[0]=function(){return i.onFocus&&i.onFocus.apply(i,arguments)}),onBlur:e[1]||(e[1]=function(){return i.onBlur&&i.onBlur.apply(i,arguments)}),onChange:e[2]||(e[2]=function(){return i.onChange&&i.onChange.apply(i,arguments)})},i.getPTOptions("input")),null,16,Ne),a("div",p({class:t.cx("slider")},i.getPTOptions("slider"),{"data-p":i.dataP}),[a("div",p({class:t.cx("handle")},i.getPTOptions("handle"),{"data-p":i.dataP}),[j(t.$slots,"handle",{checked:i.checked})],16,Me)],16,De)],16,Ue)}G.render=Re;var Ee=`
    .p-message {
        display: grid;
        grid-template-rows: 1fr;
        border-radius: dt('message.border.radius');
        outline-width: dt('message.border.width');
        outline-style: solid;
    }

    .p-message-content-wrapper {
        min-height: 0;
    }

    .p-message-content {
        display: flex;
        align-items: center;
        padding: dt('message.content.padding');
        gap: dt('message.content.gap');
    }

    .p-message-icon {
        flex-shrink: 0;
    }

    .p-message-close-button {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-inline-start: auto;
        overflow: hidden;
        position: relative;
        width: dt('message.close.button.width');
        height: dt('message.close.button.height');
        border-radius: dt('message.close.button.border.radius');
        background: transparent;
        transition:
            background dt('message.transition.duration'),
            color dt('message.transition.duration'),
            outline-color dt('message.transition.duration'),
            box-shadow dt('message.transition.duration'),
            opacity 0.3s;
        outline-color: transparent;
        color: inherit;
        padding: 0;
        border: none;
        cursor: pointer;
        user-select: none;
    }

    .p-message-close-icon {
        font-size: dt('message.close.icon.size');
        width: dt('message.close.icon.size');
        height: dt('message.close.icon.size');
    }

    .p-message-close-button:focus-visible {
        outline-width: dt('message.close.button.focus.ring.width');
        outline-style: dt('message.close.button.focus.ring.style');
        outline-offset: dt('message.close.button.focus.ring.offset');
    }

    .p-message-info {
        background: dt('message.info.background');
        outline-color: dt('message.info.border.color');
        color: dt('message.info.color');
        box-shadow: dt('message.info.shadow');
    }

    .p-message-info .p-message-close-button:focus-visible {
        outline-color: dt('message.info.close.button.focus.ring.color');
        box-shadow: dt('message.info.close.button.focus.ring.shadow');
    }

    .p-message-info .p-message-close-button:hover {
        background: dt('message.info.close.button.hover.background');
    }

    .p-message-info.p-message-outlined {
        color: dt('message.info.outlined.color');
        outline-color: dt('message.info.outlined.border.color');
    }

    .p-message-info.p-message-simple {
        color: dt('message.info.simple.color');
    }

    .p-message-success {
        background: dt('message.success.background');
        outline-color: dt('message.success.border.color');
        color: dt('message.success.color');
        box-shadow: dt('message.success.shadow');
    }

    .p-message-success .p-message-close-button:focus-visible {
        outline-color: dt('message.success.close.button.focus.ring.color');
        box-shadow: dt('message.success.close.button.focus.ring.shadow');
    }

    .p-message-success .p-message-close-button:hover {
        background: dt('message.success.close.button.hover.background');
    }

    .p-message-success.p-message-outlined {
        color: dt('message.success.outlined.color');
        outline-color: dt('message.success.outlined.border.color');
    }

    .p-message-success.p-message-simple {
        color: dt('message.success.simple.color');
    }

    .p-message-warn {
        background: dt('message.warn.background');
        outline-color: dt('message.warn.border.color');
        color: dt('message.warn.color');
        box-shadow: dt('message.warn.shadow');
    }

    .p-message-warn .p-message-close-button:focus-visible {
        outline-color: dt('message.warn.close.button.focus.ring.color');
        box-shadow: dt('message.warn.close.button.focus.ring.shadow');
    }

    .p-message-warn .p-message-close-button:hover {
        background: dt('message.warn.close.button.hover.background');
    }

    .p-message-warn.p-message-outlined {
        color: dt('message.warn.outlined.color');
        outline-color: dt('message.warn.outlined.border.color');
    }

    .p-message-warn.p-message-simple {
        color: dt('message.warn.simple.color');
    }

    .p-message-error {
        background: dt('message.error.background');
        outline-color: dt('message.error.border.color');
        color: dt('message.error.color');
        box-shadow: dt('message.error.shadow');
    }

    .p-message-error .p-message-close-button:focus-visible {
        outline-color: dt('message.error.close.button.focus.ring.color');
        box-shadow: dt('message.error.close.button.focus.ring.shadow');
    }

    .p-message-error .p-message-close-button:hover {
        background: dt('message.error.close.button.hover.background');
    }

    .p-message-error.p-message-outlined {
        color: dt('message.error.outlined.color');
        outline-color: dt('message.error.outlined.border.color');
    }

    .p-message-error.p-message-simple {
        color: dt('message.error.simple.color');
    }

    .p-message-secondary {
        background: dt('message.secondary.background');
        outline-color: dt('message.secondary.border.color');
        color: dt('message.secondary.color');
        box-shadow: dt('message.secondary.shadow');
    }

    .p-message-secondary .p-message-close-button:focus-visible {
        outline-color: dt('message.secondary.close.button.focus.ring.color');
        box-shadow: dt('message.secondary.close.button.focus.ring.shadow');
    }

    .p-message-secondary .p-message-close-button:hover {
        background: dt('message.secondary.close.button.hover.background');
    }

    .p-message-secondary.p-message-outlined {
        color: dt('message.secondary.outlined.color');
        outline-color: dt('message.secondary.outlined.border.color');
    }

    .p-message-secondary.p-message-simple {
        color: dt('message.secondary.simple.color');
    }

    .p-message-contrast {
        background: dt('message.contrast.background');
        outline-color: dt('message.contrast.border.color');
        color: dt('message.contrast.color');
        box-shadow: dt('message.contrast.shadow');
    }

    .p-message-contrast .p-message-close-button:focus-visible {
        outline-color: dt('message.contrast.close.button.focus.ring.color');
        box-shadow: dt('message.contrast.close.button.focus.ring.shadow');
    }

    .p-message-contrast .p-message-close-button:hover {
        background: dt('message.contrast.close.button.hover.background');
    }

    .p-message-contrast.p-message-outlined {
        color: dt('message.contrast.outlined.color');
        outline-color: dt('message.contrast.outlined.border.color');
    }

    .p-message-contrast.p-message-simple {
        color: dt('message.contrast.simple.color');
    }

    .p-message-text {
        font-size: dt('message.text.font.size');
        font-weight: dt('message.text.font.weight');
    }

    .p-message-icon {
        font-size: dt('message.icon.size');
        width: dt('message.icon.size');
        height: dt('message.icon.size');
    }

    .p-message-sm .p-message-content {
        padding: dt('message.content.sm.padding');
    }

    .p-message-sm .p-message-text {
        font-size: dt('message.text.sm.font.size');
    }

    .p-message-sm .p-message-icon {
        font-size: dt('message.icon.sm.size');
        width: dt('message.icon.sm.size');
        height: dt('message.icon.sm.size');
    }

    .p-message-sm .p-message-close-icon {
        font-size: dt('message.close.icon.sm.size');
        width: dt('message.close.icon.sm.size');
        height: dt('message.close.icon.sm.size');
    }

    .p-message-lg .p-message-content {
        padding: dt('message.content.lg.padding');
    }

    .p-message-lg .p-message-text {
        font-size: dt('message.text.lg.font.size');
    }

    .p-message-lg .p-message-icon {
        font-size: dt('message.icon.lg.size');
        width: dt('message.icon.lg.size');
        height: dt('message.icon.lg.size');
    }

    .p-message-lg .p-message-close-icon {
        font-size: dt('message.close.icon.lg.size');
        width: dt('message.close.icon.lg.size');
        height: dt('message.close.icon.lg.size');
    }

    .p-message-outlined {
        background: transparent;
        outline-width: dt('message.outlined.border.width');
    }

    .p-message-simple {
        background: transparent;
        outline-color: transparent;
        box-shadow: none;
    }

    .p-message-simple .p-message-content {
        padding: dt('message.simple.content.padding');
    }

    .p-message-outlined .p-message-close-button:hover,
    .p-message-simple .p-message-close-button:hover {
        background: transparent;
    }

    .p-message-enter-active {
        animation: p-animate-message-enter 0.3s ease-out forwards;
        overflow: hidden;
    }

    .p-message-leave-active {
        animation: p-animate-message-leave 0.15s ease-in forwards;
        overflow: hidden;
    }

    @keyframes p-animate-message-enter {
        from {
            opacity: 0;
            grid-template-rows: 0fr;
        }
        to {
            opacity: 1;
            grid-template-rows: 1fr;
        }
    }

    @keyframes p-animate-message-leave {
        from {
            opacity: 1;
            grid-template-rows: 1fr;
        }
        to {
            opacity: 0;
            margin: 0;
            grid-template-rows: 0fr;
        }
    }
`,He={root:function(e){var n=e.props;return["p-message p-component p-message-"+n.severity,{"p-message-outlined":n.variant==="outlined","p-message-simple":n.variant==="simple","p-message-sm":n.size==="small","p-message-lg":n.size==="large"}]},contentWrapper:"p-message-content-wrapper",content:"p-message-content",icon:"p-message-icon",text:"p-message-text",closeButton:"p-message-close-button",closeIcon:"p-message-close-icon"},Ke=U.extend({name:"message",style:Ee,classes:He}),qe={name:"BaseMessage",extends:oe,props:{severity:{type:String,default:"info"},closable:{type:Boolean,default:!1},life:{type:Number,default:null},icon:{type:String,default:void 0},closeIcon:{type:String,default:void 0},closeButtonProps:{type:null,default:null},size:{type:String,default:null},variant:{type:String,default:null}},style:Ke,provide:function(){return{$pcMessage:this,$parentInstance:this}}};function T(t){"@babel/helpers - typeof";return T=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol=="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},T(t)}function E(t,e,n){return(e=We(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function We(t){var e=Ge(t,"string");return T(e)=="symbol"?e:e+""}function Ge(t,e){if(T(t)!="object"||!t)return t;var n=t[Symbol.toPrimitive];if(n!==void 0){var l=n.call(t,e);if(T(l)!="object")return l;throw new TypeError("@@toPrimitive must return a primitive value.")}return(e==="string"?String:Number)(t)}var Y={name:"Message",extends:qe,inheritAttrs:!1,emits:["close","life-end"],timeout:null,data:function(){return{visible:!0}},mounted:function(){var e=this;this.life&&setTimeout(function(){e.visible=!1,e.$emit("life-end")},this.life)},methods:{close:function(e){this.visible=!1,this.$emit("close",e)}},computed:{closeAriaLabel:function(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.close:void 0},dataP:function(){return N(E(E({outlined:this.variant==="outlined",simple:this.variant==="simple"},this.severity,this.severity),this.size,this.size))}},directives:{ripple:se},components:{TimesIcon:ne}};function B(t){"@babel/helpers - typeof";return B=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol=="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},B(t)}function H(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(t);e&&(l=l.filter(function(f){return Object.getOwnPropertyDescriptor(t,f).enumerable})),n.push.apply(n,l)}return n}function K(t){for(var e=1;e<arguments.length;e++){var n=arguments[e]!=null?arguments[e]:{};e%2?H(Object(n),!0).forEach(function(l){Ye(t,l,n[l])}):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):H(Object(n)).forEach(function(l){Object.defineProperty(t,l,Object.getOwnPropertyDescriptor(n,l))})}return t}function Ye(t,e,n){return(e=Je(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function Je(t){var e=Qe(t,"string");return B(e)=="symbol"?e:e+""}function Qe(t,e){if(B(t)!="object"||!t)return t;var n=t[Symbol.toPrimitive];if(n!==void 0){var l=n.call(t,e);if(B(l)!="object")return l;throw new TypeError("@@toPrimitive must return a primitive value.")}return(e==="string"?String:Number)(t)}var Xe=["data-p"],Ze=["data-p"],et=["data-p"],tt=["aria-label","data-p"],nt=["data-p"];function st(t,e,n,l,f,i){var y=ae("TimesIcon"),v=ie("ripple");return g(),V(de,p({name:"p-message",appear:""},t.ptmi("transition")),{default:w(function(){return[f.visible?(g(),m("div",p({key:0,class:t.cx("root"),role:"alert","aria-live":"assertive","aria-atomic":"true","data-p":i.dataP},t.ptm("root")),[a("div",p({class:t.cx("contentWrapper")},t.ptm("contentWrapper")),[t.$slots.container?j(t.$slots,"container",{key:0,closeCallback:i.close}):(g(),m("div",p({key:1,class:t.cx("content"),"data-p":i.dataP},t.ptm("content")),[j(t.$slots,"icon",{class:le(t.cx("icon"))},function(){return[(g(),V(re(t.icon?"span":null),p({class:[t.cx("icon"),t.icon],"data-p":i.dataP},t.ptm("icon")),null,16,["class","data-p"]))]}),t.$slots.default?(g(),m("div",p({key:0,class:t.cx("text"),"data-p":i.dataP},t.ptm("text")),[j(t.$slots,"default")],16,et)):O("",!0),t.closable?q((g(),m("button",p({key:1,class:t.cx("closeButton"),"aria-label":i.closeAriaLabel,type:"button",onClick:e[0]||(e[0]=function($){return i.close($)}),"data-p":i.dataP},K(K({},t.closeButtonProps),t.ptm("closeButton"))),[j(t.$slots,"closeicon",{},function(){return[t.closeIcon?(g(),m("i",p({key:0,class:[t.cx("closeIcon"),t.closeIcon],"data-p":i.dataP},t.ptm("closeIcon")),null,16,nt)):(g(),V(y,p({key:1,class:[t.cx("closeIcon"),t.closeIcon],"data-p":i.dataP},t.ptm("closeIcon")),null,16,["class","data-p"]))]})],16,tt)),[[v]]):O("",!0)],16,Ze))],16)],16,Xe)):O("",!0)]}),_:3},16)}Y.render=st;const ot={style:{margin:"0","font-size":"1.25rem","font-weight":"700",color:"#1a1a1a"}},at={class:"page-header"},it={class:"table-card"},lt={key:0,class:"teacher-chip"},rt={key:1,style:{color:"#9ca3af","font-size":".85rem"}},dt=["onClick","title"],ct={width:"22",height:"22",viewBox:"0 0 24 24",fill:"none"},ut=["fill","stroke"],gt={style:{display:"flex",gap:".5rem"}},pt={class:"field"},mt={class:"field"},ht={class:"field-row"},ft={class:"field"},bt={class:"field"},vt={class:"field"},wt=["value"],yt={key:0,style:{"font-size":".8rem",color:"#9ca3af",margin:"2px 0 0"}},kt={class:"field"},xt={class:"cover-wrap"},zt=["src"],$t={key:1,class:"cover-empty"},Pt={class:"cover-upload-btn"},St={class:"field-row"},_t={class:"field"},Ct={class:"field"},jt={class:"field field-check"},Vt={style:{display:"flex","justify-content":"flex-end",gap:".75rem","margin-top":"1rem"}},Ot={__name:"AdminCourses",setup(t){const{t:e}=ce(),n=ue(),l=b(!0),f=b([]),i=b([]),y=b(!1),v=b(null),$=b(!1),z=b(""),D=()=>({title:"",description:"",subject:"",level:"",price:0,original_price:null,is_published:!1,teacher_id:null,cover_image:null}),d=b(D()),P=b(null),S=b("");function J(u){const o=u.target.files[0];o&&(P.value=o,S.value=URL.createObjectURL(o))}ge(async()=>{const[,u]=await Promise.all([F(),pe.teachers()]);i.value=u.data.data||[]});async function F(){l.value=!0;const u=await me.myCourses();f.value=u.data.data||[],l.value=!1}function Q(){v.value=null,d.value=D(),P.value=null,S.value="",z.value="",y.value=!0}function X(u){v.value=u.id,P.value=null,S.value="",d.value={...u,price:Number(u.price),teacher_id:u.teacher_id??null},z.value="",y.value=!0}async function Z(){var u,o,r;z.value="",$.value=!0;try{let k=v.value;v.value?(await _.update(v.value,d.value),n.add({severity:"success",summary:e("toast.saved"),life:3e3})):(k=(u=(await _.create(d.value)).data.data)==null?void 0:u.id,n.add({severity:"success",summary:e("toast.created"),life:3e3})),P.value&&k&&await _.uploadCover(k,P.value),y.value=!1,await F()}catch(k){z.value=((r=(o=k.response)==null?void 0:o.data)==null?void 0:r.error)||e("toast.saveError")}finally{$.value=!1}}async function ee(u){await _.update(u.id,{...u,is_published:!u.is_published}),await F()}async function te(u){confirm(e("admin.deleteConfirm",{title:u.title}))&&(await _.remove(u.id),n.add({severity:"warn",summary:e("toast.deleted"),life:3e3}),await F())}return(u,o)=>(g(),V(xe,{title:s(e)("admin.courses")},{"header-left":w(()=>[a("div",null,[a("h1",ot,h(s(e)("admin.courses")),1),o[10]||(o[10]=a("p",{style:{margin:"2px 0 0","font-size":".8rem",color:"#9ca3af"}},"Manage all platform courses",-1))])]),default:w(()=>[a("div",at,[o[11]||(o[11]=a("div",null,null,-1)),c(s(C),{label:s(e)("admin.createCourse"),icon:"pi pi-plus",onClick:Q},null,8,["label"])]),a("div",it,[c(s(ye),{value:f.value,loading:l.value,stripedRows:"","table-style":"min-width: 50rem"},{default:w(()=>[c(s(x),{field:"id",header:s(e)("common.id"),style:{width:"60px"}},null,8,["header"]),c(s(x),{field:"title",header:s(e)("common.title")},null,8,["header"]),c(s(x),{field:"subject",header:s(e)("common.subject")},null,8,["header"]),c(s(x),{field:"level",header:s(e)("common.level")},null,8,["header"]),c(s(x),{field:"price",header:s(e)("common.price")},null,8,["header"]),c(s(x),{header:"Teacher"},{body:w(({data:r})=>[r.teacher_name?(g(),m("span",lt,[o[12]||(o[12]=a("i",{class:"pi pi-user",style:{"font-size":".72rem"}},null,-1)),A(" "+h(r.teacher_name),1)])):(g(),m("span",rt,"— Unassigned —"))]),_:1}),c(s(x),{header:s(e)("common.status"),style:{width:"90px"}},{body:w(({data:r})=>[a("button",{class:"star-btn",onClick:M(k=>ee(r),["stop"]),title:r.is_published?s(e)("common.published"):s(e)("common.draft")},[(g(),m("svg",ct,[a("path",{d:"M12 2l2.9 5.9 6.5.9-4.7 4.6 1.1 6.4L12 17l-5.8 3.1 1.1-6.4L2.6 9l6.5-.9L12 2z",fill:r.is_published?"#FFD700":"none",stroke:r.is_published?"#FFD700":"#aaa","stroke-width":"1.8","stroke-linejoin":"round"},null,8,ut)]))],8,dt)]),_:1},8,["header"]),c(s(x),{header:s(e)("common.actions"),style:{width:"120px"}},{body:w(({data:r})=>[a("div",gt,[c(s(C),{icon:"pi pi-pencil",size:"small",outlined:"",onClick:k=>X(r)},null,8,["onClick"]),c(s(C),{icon:"pi pi-trash",size:"small",severity:"danger",outlined:"",onClick:k=>te(r)},null,8,["onClick"])])]),_:1},8,["header"])]),_:1},8,["value","loading"])]),c(s(ke),{visible:y.value,"onUpdate:visible":o[9]||(o[9]=r=>y.value=r),header:v.value?s(e)("admin.editCourse"):s(e)("admin.createCourse"),modal:"",style:{width:"540px"}},{default:w(()=>[a("form",{onSubmit:M(Z,["prevent"]),class:"dialog-form"},[a("div",pt,[a("label",null,h(s(e)("admin.courseTitle")),1),c(s(L),{modelValue:d.value.title,"onUpdate:modelValue":o[0]||(o[0]=r=>d.value.title=r),class:"w-full",required:""},null,8,["modelValue"])]),a("div",mt,[a("label",null,h(s(e)("common.description")),1),c(s(W),{modelValue:d.value.description,"onUpdate:modelValue":o[1]||(o[1]=r=>d.value.description=r),rows:"3",class:"w-full",autoResize:""},null,8,["modelValue"])]),a("div",ht,[a("div",ft,[a("label",null,h(s(e)("common.subject")),1),c(s(L),{modelValue:d.value.subject,"onUpdate:modelValue":o[2]||(o[2]=r=>d.value.subject=r),placeholder:s(e)("admin.subjectPlaceholder"),class:"w-full"},null,8,["modelValue","placeholder"])]),a("div",bt,[a("label",null,h(s(e)("common.level")),1),c(s(L),{modelValue:d.value.level,"onUpdate:modelValue":o[3]||(o[3]=r=>d.value.level=r),placeholder:s(e)("admin.levelPlaceholder"),class:"w-full"},null,8,["modelValue","placeholder"])])]),a("div",vt,[o[14]||(o[14]=a("label",null,"Assign Teacher",-1)),q(a("select",{"onUpdate:modelValue":o[4]||(o[4]=r=>d.value.teacher_id=r),class:"teacher-select"},[o[13]||(o[13]=a("option",{value:null},"— No teacher assigned —",-1)),(g(!0),m(he,null,fe(i.value,r=>(g(),m("option",{key:r.id,value:r.id},h(r.full_name)+" (@"+h(r.username)+") ",9,wt))),128))],512),[[be,d.value.teacher_id]]),i.value.length?O("",!0):(g(),m("p",yt,' No teachers found. Create a user with role "Teacher" first. '))]),a("div",kt,[o[17]||(o[17]=a("label",null,"Cover Image",-1)),a("div",xt,[S.value||d.value.cover_image?(g(),m("img",{key:0,src:S.value||d.value.cover_image,class:"cover-preview"},null,8,zt)):(g(),m("div",$t,"No image")),a("label",Pt,[o[15]||(o[15]=a("svg",{width:"14",height:"14",viewBox:"0 0 24 24",fill:"none"},[a("path",{d:"M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})],-1)),o[16]||(o[16]=A(" Upload ",-1)),a("input",{type:"file",accept:"image/*",style:{display:"none"},onChange:J},null,32)])])]),a("div",St,[a("div",_t,[a("label",null,h(s(e)("admin.priceLabel")),1),c(s(R),{modelValue:d.value.price,"onUpdate:modelValue":o[5]||(o[5]=r=>d.value.price=r),min:0,class:"w-full"},null,8,["modelValue"])]),a("div",Ct,[o[18]||(o[18]=a("label",null,[A("Original Price "),a("span",{style:{"font-size":".75rem",color:"#9ca3af"}},"(for strikethrough)")],-1)),c(s(R),{modelValue:d.value.original_price,"onUpdate:modelValue":o[6]||(o[6]=r=>d.value.original_price=r),min:0,class:"w-full"},null,8,["modelValue"])]),a("div",jt,[a("label",null,h(s(e)("admin.isPublished")),1),c(s(G),{modelValue:d.value.is_published,"onUpdate:modelValue":o[7]||(o[7]=r=>d.value.is_published=r)},null,8,["modelValue"])])]),z.value?(g(),V(s(Y),{key:0,severity:"error",closable:!1},{default:w(()=>[A(h(z.value),1)]),_:1})):O("",!0),a("div",Vt,[c(s(C),{label:s(e)("common.cancel"),severity:"secondary",outlined:"",onClick:o[8]||(o[8]=r=>y.value=!1),type:"button"},null,8,["label"]),c(s(C),{label:v.value?s(e)("common.save"):s(e)("common.create"),type:"submit",loading:$.value},null,8,["label","loading"])])],32)]),_:1},8,["visible","header"])]),_:1},8,["title"]))}},Lt=ze(Ot,[["__scopeId","data-v-be6a8757"]]);export{Lt as default};
