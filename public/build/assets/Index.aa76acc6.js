import{H as g,b as h,c as o,f as a,g as s,j as t,F as b,y as p,q as _,k as r,m as i,n as c}from"./main.697461d8.js";import v from"./Layout.e5424df6.js";import w from"./BarChart.c2767509.js";import k from"./Stats.82133164.js";import{_ as C}from"./_plugin-vue_export-helper.cdc0426e.js";import"./Logo.4bb5d3c0.js";import"./Icon.db034cca.js";import"./Dropdown.0df41cec.js";import"./MainMenu.dad7eefd.js";import"./FlashMessages.5663986e.js";const N={components:{Head:g,BarChart:w,Stats:k},layout:v,props:{traffic:Object,latestPosts:Array,activeAuthors:Object,postsCount:Number,usersCount:Number,AuthorsCount:Number,AdminsCount:Number}},A=t("h1",{class:"mb-8 text-3xl font-bold text-gray-700"},"Dashboard",-1),P={class:"flex content-between my-4"},L={class:"my-4"},V=t("h1",{class:"font-bold my-4 text-bold text-2xl text-gray-700"},"Latest Posts",-1),B={class:"bg-white rounded-md shadow overflow-x-auto"},H={class:"w-full whitespace-nowrap"},j=t("tr",{class:"text-left font-bold"},[t("th",{class:"pb-4 pt-6 px-6"},"Title"),t("th",{class:"pb-4 pt-6 px-6"},"User"),t("th",{class:"pb-4 pt-6 px-6"},"Views")],-1),D={class:"border-t"},$=["src"],E={class:"border-t"},F={class:"border-t"},O={key:0},S=t("td",{class:"px-6 py-4 border-t",colspan:"4"},"No Posts found.",-1),T=[S],U={class:"flex content-between"},q={class:"my-10 bg-white p-4 w-1/2"},I=t("h1",{class:"font-bold my-4 text-bold text-2xl text-gray-700 inline"},"Posts views",-1),M={class:"my-10 bg-white w-1/2 inline-block ml-3 p-4"},z=t("h1",{class:"font-bold my-4 text-bold text-2xl text-gray-700 inline"},"Most Active Authors",-1),G={class:"bg-white rounded-md shadow overflow-x-auto"},J={class:"w-full whitespace-nowrap"},K=t("tr",{class:"text-left font-bold"},[t("th",{class:"pb-4 pt-6 px-6"},"Name"),t("th",{class:"pb-4 pt-6 px-6"},"Email"),t("th",{class:"pb-4 pt-6 px-6"},"Posts")],-1),Q={class:"border-t"},R=["src"],W={class:"border-t"},X={class:"border-t"},Y={key:0},Z=t("td",{class:"px-6 py-4 border-t",colspan:"4"},"No users found.",-1),tt=[Z];function et(u,st,l,ot,at,lt){var m,f;const x=h("Head"),d=h("stats"),n=h("Link"),y=h("bar-chart");return o(),a("div",null,[s(x,{title:"Dashboard"}),A,t("div",P,[s(d,{title:"Posts",value:l.postsCount},null,8,["value"]),s(d,{title:"Users",value:l.usersCount},null,8,["value"]),s(d,{title:"Authors",value:u.authorsCount},null,8,["value"]),s(d,{title:"Admins",value:u.adminsCount},null,8,["value"])]),t("div",L,[V,t("div",B,[t("table",H,[j,(o(!0),a(b,null,p(l.latestPosts.data,e=>(o(),a("tr",{key:e.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[t("td",D,[s(n,{class:"flex items-center px-6 py-4 focus:text-indigo-500",href:`/panel/categories/${e.slug}/edit`},{default:r(()=>[e.thubmnail?(o(),a("img",{key:0,class:"block -my-2 mr-2 w-10 h-10 rounded-full",src:e.thubmnail},null,8,$)):_("",!0),i(" "+c(e.title),1)]),_:2},1032,["href"])]),t("td",E,[s(n,{class:"flex items-center px-6 py-4",href:`/panel/categories/${e.user.id}/edit`,tabindex:"-1"},{default:r(()=>[i(c(e.user.name),1)]),_:2},1032,["href"])]),t("td",F,[s(n,{class:"flex items-center px-6 py-4",href:`/panel/categories/${e.slug}/edit`,tabindex:"-1"},{default:r(()=>[i(c(e.title),1)]),_:2},1032,["href"])])]))),128)),((m=l.latestPosts.data)==null?void 0:m.length)===0?(o(),a("tr",O,T)):_("",!0)])])]),t("div",U,[t("div",q,[I,s(y,{styles:{position:u.relative},data:l.traffic},null,8,["styles","data"])]),t("div",M,[z,t("div",G,[t("table",J,[K,(o(!0),a(b,null,p(l.activeAuthors.data,e=>(o(),a("tr",{key:e.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[t("td",Q,[s(n,{class:"flex items-center px-6 py-4 focus:text-indigo-500",href:`/panel/categories/${e.id}/edit`},{default:r(()=>[e.avatar?(o(),a("img",{key:0,class:"block -my-2 mr-2 w-10 h-10 rounded-full",src:e.avatar},null,8,R)):_("",!0),i(" "+c(e.name),1)]),_:2},1032,["href"])]),t("td",W,[s(n,{class:"flex items-center px-6 py-4",href:`/panel/categories/${e.id}/edit`,tabindex:"-1"},{default:r(()=>[i(c(e.email),1)]),_:2},1032,["href"])]),t("td",X,[s(n,{class:"flex items-center px-6 py-4",href:`/panel/categories/${e.id}/edit`,tabindex:"-1"},{default:r(()=>[i(c(e.posts_count),1)]),_:2},1032,["href"])])]))),128)),((f=l.activeAuthors)==null?void 0:f.length)===0?(o(),a("tr",Y,tt)):_("",!0)])])])])])}const bt=C(N,[["render",et]]);export{bt as default};
