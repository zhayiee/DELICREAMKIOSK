"use strict";(self.modernJsonp=self.modernJsonp||[]).push([[6881],{25690:(e,t,n)=>{n.d(t,{default:()=>r});var i=n(718222);let a=`pulsing {
  0% {
    opacity: 1;
  }

  50% {
    opacity: 0.4;
  }

  100% {
    opacity: 1;
  }
}`,r={css:(0,i.Ll)([a]),animation:"pulsing 2s infinite"}},718222:(e,t,n)=>{n.d(t,{CC:()=>i,Ll:()=>r,XF:()=>a});let i=(e,t)=>{let n=2*Math.random()*Math.PI;return{x:Math.floor(t/2*Math.cos(n)),y:Math.floor(e/2*Math.sin(n))}},a=(e,t)=>Math.floor(Math.random()*(t-e+1))+e,r=e=>["@-webkit-keyframes","@keyframes"].map(t=>e.map(e=>t+" "+e).join(`
`)).join(`
`)},633569:(e,t,n)=>{n.r(t),n.d(t,{default:()=>E});var i=n(667294),a=n(20256),r=n(569681),o=n(19963),l=n(756064);function s(e,t,n){var i;return(t="symbol"==typeof(i=function(e,t){if("object"!=typeof e||!e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var i=n.call(e,t||"default");if("object"!=typeof i)return i;throw TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(t,"string"))?i:i+"")in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}let d={},u=e=>{let t=e.__id||e.id;return"string"==typeof t&&t||null};class p{constructor(){s(this,"idMap",new Map),s(this,"objMap",new WeakMap)}get(e){let t=u(e);return this.objMap.get(e)??(t?this.idMap.get(t):void 0)}has(e){let t=u(e);return this.objMap.has(e)??(!!t&&this.idMap.has(t))}set(e,t){let n=u(e);n&&this.idMap.set(n,t),this.objMap.set(e,t)}reset(){this.idMap=new Map,this.objMap=new WeakMap}}function m(e,t){return"number"==typeof e?e:"lg1"===t?e[t]??e.lg??1:e[t]??1}var c=n(399083),h=n(824834),y=n(830811),f=n(25690),g=n(970601),b=n(785893);let{css:_,animation:x}=f.default,w={backgroundColor:y._VP,animation:x,borderRadius:y.Ev2};function v({data:e}){let{height:t}=e;return(0,b.jsxs)(i.Fragment,{children:[(0,b.jsx)(g.Z,{unsafeCSS:_}),(0,b.jsx)(a.xu,{dangerouslySetInlineStyle:{__style:w},"data-test-id":"skeleton-pin",children:(0,b.jsx)(a.xu,{height:t})})]})}var M=n(56063),C=n(967312),S=n(174646),$=n(538645),R=n(992114),k=n(349167),j=n(438596);function E(e){let{align:t,cacheKey:n,id:s,isFetching:u,isGridCentered:y=!0,items:f,layout:_,loadItems:x,masonryRef:w,optOutFluidGridExperiment:E=!1,renderItem:I,scrollContainerRef:W,virtualize:G=!0,getColumnSpanConfig:P,_getResponsiveModuleConfigForSecondItem:z,isLoadingStateEnabled:A,initialLoadingStatePinCount:F,isLoadingAccessibilityLabel:Z,isLoadedAccessibilityLabel:O}=e,D=(0,$.ZP)(),H=(0,S.B)(),{isAuthenticated:T,isRTL:X}=H,{logContextEvent:N}=(0,o.u)(),B=(0,C.FJ)(),L="desktop"===D,Q=(0,j.Zv)(),{group:J}=(0,k.DB)(),V=((0,i.useRef)(f.map(()=>({fetchTimestamp:Date.now(),measureTimestamp:Date.now(),hasRendered:!1,pageCount:0}))),L&&!E),{experimentalColumnWidth:Y,experimentalGutter:q}=(0,c.Z)(V),K=e.serverRender??!!L,U="flexible"===_||"uniformRowFlexible"===_||"desktop"!==D||V,ee=(U&&_?.startsWith("uniformRow")?"uniformRowFlexible":void 0)??(K?"serverRenderedFlexible":"flexible"),et=e.columnWidth??Y??M.yF;U&&(et=Math.floor(et));let en=e.gutterWidth??q??(L?M.oX:1),ei=e.minCols??M.yc,ea=(0,i.useRef)(0),er=et+en,eo=function(e){if(null==e)return;let t=function(e){let t=d[e];return t&&t.screenWidth===window.innerWidth||(d[e]={screenWidth:window.innerWidth}),d[e]}(e);return t.measurementCache||(t.measurementCache=new p),t.measurementCache}(n),el=(0,i.useCallback)(()=>W?.current||window,[W]),es=(0,i.useRef)(!0),{anyEnabled:ed}=B.checkExperiment("web_masonry_pin_overlap_calculation_and_logging"),{anyEnabled:eu}=B.checkExperiment("web_masonry_fluid_reflow"),ep=y&&es.current?"centered":"",{className:em,styles:ec}=function(e){let t=`m_${Object.keys(e).sort().reduce((t,n)=>{let i=e[n];return null==i||"object"==typeof i||"function"==typeof i?t:"boolean"==typeof i?t+(i?"t":"f"):t+i},"").replace(/\:/g,"\\:")}`,{flexible:n,gutterWidth:i,isRTL:a,itemWidth:r,maxColumns:o,minColumns:l,items:s,getColumnSpanConfig:d,_getResponsiveModuleConfigForSecondItem:u}=e,p=d?s.map((e,t)=>({index:t,columnSpanConfig:d(e)??1})).filter(e=>1!==e.columnSpanConfig):[],c=r+i,h=Array.from({length:o+1-l},(e,t)=>t+l).map(e=>{let h,y,f=e===l?0:e*c,g=e===o?null:(e+1)*c-.01;d&&u&&s.length>1&&(h=d(s[0]),y=u(s[1]));let{styles:b,numberOfVisibleItems:_}=p.reduce((a,o)=>{let{columnSpanConfig:l}=o,d=Math.min(function({columnCount:e,columnSpanConfig:t,firstItemColumnSpanConfig:n,isFlexibleWidthItem:i,secondItemResponsiveModuleConfig:a}){let r=e<=2?"sm":e<=4?"md":e<=6?"lg1":e<=8?"lg":"xl",o=m(t,r);if(i){let t=m(n,r);o="number"==typeof a?a:a?Math.max(a.min,Math.min(a.max,e-t)):1}return o}({columnCount:e,columnSpanConfig:l,isFlexibleWidthItem:!!y&&o===s[1],firstItemColumnSpanConfig:h??1,secondItemResponsiveModuleConfig:y??1}),e),u=null!=o.index&&a.numberOfVisibleItems>=d+o.index,p=n?100/e*d:r*d+i*(d-1),{numberOfVisibleItems:c}=a;return u?c-=d-1:o.index<c&&(c+=1),{styles:a.styles.concat(function({className:e,index:t,columnSpanConfig:n,visible:i,width:a,flexible:r}){let o="number"==typeof n?n:btoa(JSON.stringify(n));return r?`
      .${e} .static[data-column-span="${o}"]:nth-child(${t+1}) {
        visibility: ${i?"visible":"hidden"} !important;
        position: ${i?"inherit":"absolute"} !important;
        width: ${a}% !important;
      }`:`
      .${e} .static[data-column-span="${o}"]:nth-child(${t+1}) {
        visibility: ${i?"visible":"hidden"} !important;
        position: ${i?"inherit":"absolute"} !important;
        width: ${a}px !important;
      }`}({className:t,index:o.index,columnSpanConfig:l,visible:u,width:p,flexible:n})),numberOfVisibleItems:c}},{styles:"",numberOfVisibleItems:e}),x=n?`
      .${t} .static {
        box-sizing: border-box;
        width: calc(100% / ${e}) !important;
      }
    `:`
      .${t} {
        max-width: ${e*c}px;
      }

      .${t} .static {
        width: ${r}px !important;
      }
    `;return{minWidth:f,maxWidth:g,styles:`
      .${t} .static:nth-child(-n+${_}) {
        position: static !important;
        visibility: visible !important;
        float: ${a?"right":"left"};
        display: block;
      }

      .${t} .static {
        padding: 0 ${i/2}px;
      }

      ${x}

      ${b}
    `}}),y=h.map(({minWidth:e,maxWidth:t,styles:n})=>`
    @container (min-width: ${e}px) ${t?`and (max-width: ${t}px)`:""} {
      ${n}
    }
  `),f=h.map(({minWidth:e,maxWidth:t,styles:n})=>`
    @media (min-width: ${e}px) ${t?`and (max-width: ${t}px)`:""} {
      ${n}
    }
  `),g=`
    ${y.join("")}
    @supports not (container-type: inline-size) {
      ${f.join("")}
    }
  `;return{className:t,styles:`
    .masonryContainer:has(.${t}) {
      container-type: inline-size;
    }

    .masonryContainer > .centered {
      margin-left: auto;
      margin-right: auto;
    }

    .${t} .static {
      position: absolute !important;
      visibility: hidden !important;
    }

    ${g}
  `}}({gutterWidth:en,flexible:U,items:f,isRTL:X,itemWidth:et,maxColumns:e.maxColumns??Math.max(f.length,M.g5),minColumns:ei,getColumnSpanConfig:P,_getResponsiveModuleConfigForSecondItem:z}),eh=`${ep} ${em}`.trim(),{anyEnabled:ey,expName:ef,group:eg,isMeasureAllEnabled:eb}=(0,h.Z)(),e_=((0,i.useRef)(void 0),(0,i.useRef)(f.length)),ex=(0,i.useRef)(0),ew=(0,i.useRef)(null);(0,i.useEffect)(()=>{e_.current=f.length,ex.current+=1},[f]),(0,i.useEffect)(()=>{if(es.current&&(es.current=!1),window.earlyGridRenderStats){let e=(0,k.M3)({earlyHydrationGroup:J,handlerId:Q,requestContext:H});(0,R.nP)("earlyHydrationDebug.masonry.earlyGridRender.status",{tags:e}),(0,R.LY)("earlyHydrationDebug.masonry.earlyGridRender.init",window.earlyGridRenderStats.init,{tags:e}),window.earlyGridRenderStats.start&&(0,R.LY)("earlyHydrationDebug.masonry.earlyGridRender.start",window.earlyGridRenderStats.start,{tags:e}),window.earlyGridRenderStats.end&&(0,R.LY)("earlyHydrationDebug.masonry.earlyGridRender.end",window.earlyGridRenderStats.end,{tags:e})}},[]),(0,i.useEffect)(()=>()=>{},[]);let ev=(0,i.useCallback)(e=>{let t=e.reduce((e,t)=>e+t),n=t/e.length;(0,R.S0)("webapp.masonry.multiColumnWhitespace.average",n,{sampleRate:1,tags:{experimentalMasonryGroup:eg||"unknown",handlerId:Q,isAuthenticated:T,multiColumnItemSpan:e.length}}),(0,R.S0)("webapp.masonry.twoColWhitespace",n,{sampleRate:1,tags:{columnWidth:et,minCols:ei}}),N({event_type:15878,component:14468,aux_data:{total_whitespace_px:t}}),N({event_type:16062,component:14468,aux_data:{average_whitespace_px:n}}),N({event_type:16063,component:14468,aux_data:{max_whitespace_px:Math.max(...e)}}),e.forEach(t=>{t>=50&&((0,R.nP)("webapp.masonry.multiColumnWhitespace.over50",{sampleRate:1,tags:{experimentalMasonryGroup:eg||"unknown",handlerId:Q,isAuthenticated:T,multiColumnItemSpan:e.length}}),N({event_type:16261,component:14468})),t>=100&&((0,R.nP)("webapp.masonry.multiColumnWhitespace.over100",{sampleRate:1,tags:{experimentalMasonryGroup:eg||"unknown",handlerId:Q,isAuthenticated:T,multiColumnItemSpan:e.length}}),N({event_type:16262,component:14468}))}),(0,R.nP)("webapp.masonry.multiColumnWhitespace.count",{sampleRate:1,tags:{experimentalMasonryGroup:eg||"unknown",handlerId:Q,isAuthenticated:T,multiColumnItemSpan:e.length}})},[et,N,ei,T,Q,eg]),{_items:eM,_renderItem:eC}=function({initialLoadingStatePinCount:e=50,infiniteScrollPinCount:t=10,isFetching:n,items:a=[],renderItem:r,isLoadingStateEnabled:o}){let l=+(a.filter(e=>"object"==typeof e&&null!==e&&"type"in e&&"closeup_module"===e.type).length>0),s=o&&n,d=(0,i.useMemo)(()=>Array.from({length:a.length>l?t:e}).reduce((e,t,n)=>[...e,{height:n%2==0?356:236,key:`skeleton-pin-${n}`,isSkeleton:!0}],[]),[a.length,l,t,e]);return{_items:(0,i.useMemo)(()=>s?[...a,...d]:a,[s,a,d]),_renderItem:(0,i.useMemo)(()=>o?e=>{let{itemIdx:t,data:n}=e;return t>=a.length&&n&&"object"==typeof n&&"key"in n&&"height"in n?(0,b.jsx)(v,{data:n},n.key):r(e)}:r,[o,r,a.length])}}({isLoadingStateEnabled:A,items:f,renderItem:(0,i.useCallback)(e=>(0,b.jsx)(l.Z,{name:"MasonryItem",children:I(e)}),[I]),isFetching:u,initialLoadingStatePinCount:F}),eS=A&&u,e$=(0,i.useRef)(new Set);(0,i.useEffect)(()=>{if(!ed)return;let e=setTimeout(()=>{requestAnimationFrame(()=>{let e=Array.from(ew.current?.querySelectorAll("[data-grid-item-idx]")??[]);if(0===e.length)return;let t=e.map(e=>{let t=e.getAttribute("data-grid-item-idx");return{rect:e.getBoundingClientRect(),itemIdx:t}}),n=0,i=0,a=0,r=0,o=0,l=0;for(let e=0;e<t.length;e+=1){let s=t[e]?.rect,d=t[e]?.itemIdx;for(let u=e+1;u<t.length;u+=1){let e=t[u]?.rect,p=t[u]?.itemIdx;if(s&&e&&d&&p){let t=[d,p].sort().join("|");if(!e$.current.has(t)&&s.right>=e.left&&s.left<=e.right&&s.bottom>=e.top&&s.top<=e.bottom&&s.height>0&&e.height>0){e$.current.add(t),n+=1;let d=Math.max(0,Math.min(s.right,e.right)-Math.max(s.left,e.left))*Math.max(0,Math.min(s.bottom,e.bottom)-Math.max(s.top,e.top));d>8e4?l+=1:d>4e4?o+=1:d>1e4?r+=1:d>5e3?a+=1:d>2500&&(i+=1)}}}}n>0&&(0,R.QX)("webapp.masonry.pinOverlapHits",n,{tags:{isAuthenticated:T,isDesktop:L,handlerId:Q,experimentalMasonryGroup:eg||"unknown",fluidResizeExperiment:eu?"true":"false"}}),i>0&&(0,R.QX)("webapp.masonry.pinOverlap.AreaPx.over2500",i,{tags:{isAuthenticated:T,isDesktop:L,handlerId:Q,experimentalMasonryGroup:eg||"unknown",fluidResizeExperiment:eu?"true":"false"}}),a>0&&(0,R.QX)("webapp.masonry.pinOverlap.AreaPx.over5000",a,{tags:{isAuthenticated:T,isDesktop:L,handlerId:Q,experimentalMasonryGroup:eg||"unknown",fluidResizeExperiment:eu?"true":"false"}}),r>0&&(0,R.QX)("webapp.masonry.pinOverlap.AreaPx.over10000",r,{tags:{isAuthenticated:T,isDesktop:L,handlerId:Q,experimentalMasonryGroup:eg||"unknown",fluidResizeExperiment:eu?"true":"false"}}),o>0&&(0,R.QX)("webapp.masonry.pinOverlap.AreaPx.over40000",o,{tags:{isAuthenticated:T,isDesktop:L,handlerId:Q,experimentalMasonryGroup:eg||"unknown",fluidResizeExperiment:eu?"true":"false"}}),l>0&&(0,R.QX)("webapp.masonry.pinOverlap.AreaPx.over80000",l,{tags:{isAuthenticated:T,isDesktop:L,handlerId:Q,experimentalMasonryGroup:eg||"unknown",fluidResizeExperiment:eu?"true":"false"}})})},1e3);return()=>{clearTimeout(e)}},[et,eg,eu,T,L,ed,f,Q]);let eR=(0,r.Z)(),ek=(0,i.useCallback)(e=>{w&&(w.current=e)},[w]);return(0,b.jsxs)(i.Fragment,{children:[A&&!es.current&&(0,b.jsx)(a.xu,{"aria-live":"polite",display:"visuallyHidden",children:eS?Z:O}),(0,b.jsx)("div",{ref:ew,"aria-busy":A?!!eS:void 0,className:"masonryContainer","data-test-id":"masonry-container",id:s,style:V?{padding:`0 ${en/2}px`}:void 0,children:(0,b.jsxs)("div",{className:eh,children:[K&&es.current?(0,b.jsx)(g.Z,{"data-test-id":"masonry-ssr-styles",unsafeCSS:ec}):null,(0,b.jsx)(a.xu,{"data-test-id":"max-width-container",marginBottom:0,marginEnd:"auto",marginStart:"auto",marginTop:0,maxWidth:e.maxColumns?er*e.maxColumns:void 0,children:ey?(0,b.jsx)(a.GX,{ref:eR?ek:e=>{w&&(w.current=e)},_dynamicHeights:!0,_getResponsiveModuleConfigForSecondItem:z,_logTwoColWhitespace:ev,_measureAll:eb,align:t,columnWidth:et,getColumnSpanConfig:P,gutterWidth:en,items:eM,layout:U?ee:_??"basic",loadItems:x,measurementStore:eo,minCols:ei,renderItem:eC,scrollContainer:el,virtualBufferFactor:.3,virtualize:G}):(0,b.jsx)(a.Rk,{ref:eR?ek:e=>{w&&(w.current=e)},_dynamicHeights:!0,_fluidResize:eu,_getResponsiveModuleConfigForSecondItem:z,_logTwoColWhitespace:ev,align:t,columnWidth:et,getColumnSpanConfig:P,gutterWidth:en,items:eM,layout:U?ee:_??"basic",loadItems:x,measurementStore:eo,minCols:ei,renderItem:eC,scrollContainer:el,virtualBufferFactor:.3,virtualize:G})})]})})]})}},399083:(e,t,n)=>{n.d(t,{Z:()=>i});function i(e=!0){let t=e?16:void 0,n=t?Math.floor(t/4):void 0;return{experimentalColumnWidth:e?221:void 0,experimentalGutter:t,experimentalGutterBoints:n}}},824834:(e,t,n)=>{n.d(t,{Z:()=>a});var i=n(967312);function a(e){let{expName:t,anyEnabled:n,group:a}=function({experimentsClient:e,skipActivation:t}){let{checkExperiment:n}=e,i=n("web_masonry_v2",{dangerouslySkipActivation:t});return i.group?{expName:"web_masonry_v2",...i}:{expName:"",anyEnabled:!1,group:""}}({experimentsClient:(0,i.FJ)(),skipActivation:e?.skipActivation??!1});return{expName:t,anyEnabled:n,group:a,isMeasureAllEnabled:"enabled_measure_all"===a||"enabled_measure_all_impression_fix"===a,isImpressionFixEnabled:"control_impression_fix"===a||"enabled_impression_fix"===a||"enabled_measure_all_impression_fix"===a}}},940897:(e,t,n)=>{n.d(t,{Z:()=>o});var i=n(667294),a=n(349167);let r=(0,i.createContext)(null);function o(){return(0,i.use)(r)??a.g5}},349167:(e,t,n)=>{n.d(t,{DB:()=>o,M3:()=>l,SS:()=>r,g5:()=>a});var i=n(720038);let a={anyEnabled:!1,group:"",scriptPlacement:"head",optimizedClient:!1,moduleScripts:!1};function r({experimentsClient:e,handlerId:t,skipActivation:n=!1}){let{site:r}=(0,i.ac)(t??"");if("www"!==r)return a;let{group:o}=e?.checkExperiment("web_early_hydration",{dangerouslySkipActivation:n})??{group:""},l=o.includes("optimized_client");switch(o){case"enabled":case"enabled_optimized_client":return{anyEnabled:!0,group:o,scriptPlacement:"head",optimizedClient:l,moduleScripts:!1};case"employees":case"enabled_preload_and_body_scripts":case"enabled_preload_and_body_scripts_optimized_client":return{anyEnabled:!0,group:o,scriptPlacement:"body",preloadScripts:"low",optimizedClient:l,moduleScripts:!1};case"enabled_preload_high_and_body_scripts":case"enabled_preload_high_and_body_scripts_optimized_client":return{anyEnabled:!0,group:o,scriptPlacement:"body",preloadScripts:"high",optimizedClient:l,moduleScripts:!1};case"enabled_preload_and_body_module_scripts":case"enabled_preload_and_body_module_scripts_optimized_client":return{anyEnabled:!0,group:o,scriptPlacement:"body",preloadScripts:"low",optimizedClient:l,moduleScripts:!0};case"enabled_preload_high_and_body_module_scripts":case"enabled_preload_high_and_body_module_scripts_optimized_client":return{anyEnabled:!0,group:o,scriptPlacement:"body",preloadScripts:"high",optimizedClient:l,moduleScripts:!0};case"control":return{...a,group:o};default:return a}}let o=n(940897).Z;function l({earlyHydrationGroup:e,handlerId:t,requestContext:n}){let{isAuthenticated:i,isBot:a,userAgent:r}=n;return{earlyHydrationGroup:e||"unknown",environment:"client",handlerId:t,isAuthenticated:i,isBot:a,isDesktop:!r.isMobile&&!r.isTablet,isFromInstantLoadingIndicatorAppShell:window.isFromInstantLoadingIndicatorAppShell||!1}}}}]);
//# sourceMappingURL=https://sm.pinimg.com/webapp/6881-3527cdbbd7d55219.mjs.map