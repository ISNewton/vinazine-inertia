import{L as i,b as o,c as r,f as p,j as e,g as s,k as a,n as _,p as f}from"./main.4a6f243a.js";import h from"./Logo.5cc1eb61.js";import w from"./Icon.d1bc1079.js";import x from"./Dropdown.5c540676.js";import u from"./MainMenu.622d5cb0.js";import v from"./FlashMessages.e98316ad.js";import{_ as g}from"./_plugin-vue_export-helper.cdc0426e.js";const b={components:{Dropdown:x,FlashMessages:v,Icon:w,Link:i,Logo:h,MainMenu:u},computed:{user(){return this.$page.props.user.data}}},y=e("div",{id:"dropdown"},null,-1),k={class:"md:flex md:flex-col"},V={class:"md:flex md:flex-col md:h-screen"},$={class:"md:flex md:flex-shrink-0"},j={class:"flex items-center justify-between px-6 py-4 bg-slate-700 md:flex-shrink-0 md:justify-center md:w-56"},z=e("div",{no:"",class:"mt-1"},[e("h1",{class:"text-xl text-white whitespace-nowrap"},"Vinazine dashboard")],-1),B=e("svg",{class:"w-6 h-6 fill-white",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},[e("path",{d:"M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"})],-1),L={class:"mt-2 px-8 py-4 bg-slate-800 rounded shadow-lg"},M={class:"md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b md:px-12 md:py-0"},H={class:"mr-4 mt-1"},C={class:"md:flex md:flex-grow md:overflow-hidden"},D={class:"px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto","scroll-region":""};function N(m,S,E,F,I,l){var n;const t=o("main-menu"),d=o("dropdown"),c=o("flash-messages");return r(),p("div",null,[y,e("div",k,[e("div",V,[e("div",$,[e("div",j,[z,s(d,{class:"md:hidden",placement:"bottom-end"},{default:a(()=>[B]),dropdown:a(()=>[e("div",L,[s(t)])]),_:1})]),e("div",M,[e("div",H,"Welcome back "+_((n=l.user)==null?void 0:n.name),1),s(d,{class:"mt-1",placement:"bottom-end"})])]),e("div",C,[s(t,{class:"hidden flex-shrink-0 p-12 w-56 bg-slate-800 overflow-y-auto md:block"}),e("div",D,[s(c),f(m.$slots,"default")])])])])])}const P=g(b,[["render",N]]);export{P as default};
