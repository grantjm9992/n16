"use strict";(self.webpackChunknobleui_angular=self.webpackChunknobleui_angular||[]).push([[989],{9632:(h,_,c)=>{c.d(_,{n:()=>e});var d=c(5384),l=c(4650);let e=(()=>{class g extends d.s{getAll(r=""){return this.get(`${this.getUrl()}?${r}`)}find(r){return this.get(`${this.getUrl()}/${r}`)}create(r){return this.post(`${this.getUrl()}`,r)}update(r,m){return this.post(`${this.getUrl()}/${r}`,m)}remove(r){return this.delete(`${this.getUrl()}/${r}`)}}return g.\u0275fac=function(){let p;return function(m){return(p||(p=l.n5z(g)))(m||g)}}(),g.\u0275prov=l.Yz7({token:g,factory:g.\u0275fac,providedIn:"root"}),g})()},5954:(h,_,c)=>{c.d(_,{s:()=>e});var d=c(5384),l=c(4650);let e=(()=>{class g extends d.s{getCompanies(){return this.get("/companies")}getCompany(r){return this.get(`/companies/${r}`)}updateCompany(r,m){return this.post(`/companies/${r}`,m)}createCompany(r){return this.post("/companies",r)}}return g.\u0275fac=function(){let p;return function(m){return(p||(p=l.n5z(g)))(m||g)}}(),g.\u0275prov=l.Yz7({token:g,factory:g.\u0275fac,providedIn:"root"}),g})()},6989:(h,_,c)=>{c.r(_),c.d(_,{LogsModule:()=>D});var d=c(6895),l=c(9585),e=c(4650),g=c(9632);let p=(()=>{class t extends g.n{getUrl(){return"/history-log"}}return t.\u0275fac=function(){let i;return function(o){return(i||(i=e.n5z(t)))(o||t)}}(),t.\u0275prov=e.Yz7({token:t,factory:t.\u0275fac,providedIn:"root"}),t})();var r=c(3599),m=c(8782),P=c(5954);function b(t,i){1&t&&e._UZ(0,"div",9)}function j(t,i){if(1&t&&(e.TgZ(0,"span",10),e._uU(1),e.qZA()),2&t){const n=e.oxw().$implicit;e.xp6(1),e.Oqu(n.description)}}function w(t,i){if(1&t&&(e.TgZ(0,"section",11),e._UZ(1,"ngx-json-viewer",12),e.qZA()),2&t){const n=e.oxw().$implicit,o=e.oxw();e.xp6(1),e.Q6J("json",n.value)("expanded",o.expanded)("depth",o.depth)("_currentDepth",o._currentDepth+1)}}const A=function(t){return["segment",t]},U=function(t,i){return{"segment-main":!0,expandable:t,expanded:i}};function Z(t,i){if(1&t){const n=e.EpF();e.TgZ(0,"section",2)(1,"section",3),e.NdJ("click",function(){const a=e.CHM(n).$implicit,u=e.oxw();return e.KtG(u.toggle(a))}),e.YNc(2,b,1,0,"div",4),e.TgZ(3,"span",5),e._uU(4),e.qZA(),e.TgZ(5,"span",6),e._uU(6,": "),e.qZA(),e.YNc(7,j,2,1,"span",7),e.qZA(),e.YNc(8,w,2,4,"section",8),e.qZA()}if(2&t){const n=i.$implicit,o=e.oxw();e.Q6J("ngClass",e.VKq(6,A,"segment-type-"+n.type)),e.xp6(1),e.Q6J("ngClass",e.WLB(8,U,o.isExpandable(n),n.expanded)),e.xp6(1),e.Q6J("ngIf",o.isExpandable(n)),e.xp6(2),e.Oqu(n.key),e.xp6(3),e.Q6J("ngIf",!n.expanded||!o.isExpandable(n)),e.xp6(1),e.Q6J("ngIf",n.expanded&&o.isExpandable(n))}}let J=(()=>{class t{constructor(){this.expanded=!0,this.depth=-1,this._currentDepth=0,this.segments=[]}ngOnChanges(){this.segments=[],this.json=this.decycle(this.json),"object"==typeof this.json?Object.keys(this.json).forEach(n=>{this.segments.push(this.parseKeyValue(n,this.json[n]))}):this.segments.push(this.parseKeyValue(`(${typeof this.json})`,this.json))}isExpandable(n){return"object"===n.type||"array"===n.type}toggle(n){this.isExpandable(n)&&(n.expanded=!n.expanded)}parseKeyValue(n,o){const s={key:n,value:o,type:void 0,description:""+o,expanded:this.isExpanded()};switch(typeof s.value){case"number":s.type="number";break;case"boolean":s.type="boolean";break;case"function":s.type="function";break;case"string":s.type="string",s.description='"'+s.value+'"';break;case"undefined":s.type="undefined",s.description="undefined";break;case"object":null===s.value?(s.type="null",s.description="null"):Array.isArray(s.value)?(s.type="array",s.description="Array["+s.value.length+"] "+JSON.stringify(s.value)):s.value instanceof Date?s.type="date":(s.type="object",s.description="Object "+JSON.stringify(s.value))}return s}isExpanded(){return this.expanded&&!(this.depth>-1&&this._currentDepth>=this.depth)}decycle(n){const o=new WeakMap;return function s(a,u){let f,C;return"object"!=typeof a||null===a||a instanceof Boolean||a instanceof Date||a instanceof Number||a instanceof RegExp||a instanceof String?a:(f=o.get(a),void 0!==f?{$ref:f}:(o.set(a,u),Array.isArray(a)?(C=[],a.forEach(function(v,O){C[O]=s(v,u+"["+O+"]")})):(C={},Object.keys(a).forEach(function(v){C[v]=s(a[v],u+"["+JSON.stringify(v)+"]")})),C))}(n,"$")}}return t.\u0275fac=function(n){return new(n||t)},t.\u0275cmp=e.Xpm({type:t,selectors:[["ngx-json-viewer"]],inputs:{json:"json",expanded:"expanded",depth:"depth",_currentDepth:"_currentDepth"},features:[e.TTD],decls:2,vars:1,consts:[[1,"ngx-json-viewer"],[3,"ngClass",4,"ngFor","ngForOf"],[3,"ngClass"],[3,"ngClass","click"],["class","toggler",4,"ngIf"],[1,"segment-key"],[1,"segment-separator"],["class","segment-value",4,"ngIf"],["class","children",4,"ngIf"],[1,"toggler"],[1,"segment-value"],[1,"children"],[3,"json","expanded","depth","_currentDepth"]],template:function(n,o){1&n&&(e.TgZ(0,"section",0),e.YNc(1,Z,9,11,"section",1),e.qZA()),2&n&&(e.xp6(1),e.Q6J("ngForOf",o.segments))},dependencies:[d.mk,d.sg,d.O5,t],styles:['@charset "UTF-8";.ngx-json-viewer[_ngcontent-%COMP%]{font-family:var(--ngx-json-font-family, monospace);font-size:var(--ngx-json-font-size, 1em);width:100%;height:100%;overflow:hidden;position:relative}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]{padding:2px;margin:1px 1px 1px 12px}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .segment-main[_ngcontent-%COMP%]{word-wrap:break-word}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .segment-main[_ngcontent-%COMP%]   .toggler[_ngcontent-%COMP%]{position:absolute;margin-left:-14px;margin-top:3px;font-size:.8em;line-height:1.2em;vertical-align:middle;color:var(--ngx-json-toggler, #787878)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .segment-main[_ngcontent-%COMP%]   .toggler[_ngcontent-%COMP%]:after{display:inline-block;content:"\\25ba";transition:transform .1s ease-in}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .segment-main[_ngcontent-%COMP%]   .segment-key[_ngcontent-%COMP%]{color:var(--ngx-json-key, #4E187C)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .segment-main[_ngcontent-%COMP%]   .segment-separator[_ngcontent-%COMP%]{color:var(--ngx-json-separator, #999)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .segment-main[_ngcontent-%COMP%]   .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-value, #000)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment[_ngcontent-%COMP%]   .children[_ngcontent-%COMP%]{margin-left:12px}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-string[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-string, #FF6B6B)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-number[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-number, #009688)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-boolean[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-boolean, #B938A4)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-date[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-date, #05668D)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-array[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-array, #999)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-object[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-object, #999)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-function[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-function, #999)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-null[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-null, #fff)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-undefined[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{color:var(--ngx-json-undefined, #fff)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-null[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{background-color:var(--ngx-json-null-bg, red)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-undefined[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-key[_ngcontent-%COMP%]{color:var(--ngx-json-undefined-key, #999)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-undefined[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%] > .segment-value[_ngcontent-%COMP%]{background-color:var(--ngx-json-undefined-key, #999)}.ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-object[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%], .ngx-json-viewer[_ngcontent-%COMP%]   .segment-type-array[_ngcontent-%COMP%] > .segment-main[_ngcontent-%COMP%]{white-space:nowrap}.ngx-json-viewer[_ngcontent-%COMP%]   .expanded[_ngcontent-%COMP%] > .toggler[_ngcontent-%COMP%]:after{transform:rotate(90deg)}.ngx-json-viewer[_ngcontent-%COMP%]   .expandable[_ngcontent-%COMP%], .ngx-json-viewer[_ngcontent-%COMP%]   .expandable[_ngcontent-%COMP%] > .toggler[_ngcontent-%COMP%]{cursor:pointer}']}),t})(),T=(()=>{class t{}return t.\u0275fac=function(n){return new(n||t)},t.\u0275mod=e.oAB({type:t}),t.\u0275inj=e.cJS({imports:[d.ez]}),t})();var M=c(9177),x=c(433);const y=function(t){return{entity:t}};function S(t,i){1&t&&e._UZ(0,"ngx-json-viewer",22),2&t&&e.Q6J("json",e.VKq(2,y,i.row.original_entity))("expanded",!1)}function E(t,i){1&t&&e._UZ(0,"ngx-json-viewer",22),2&t&&e.Q6J("json",e.VKq(2,y,i.row.updated_entity))("expanded",!1)}const N=[{path:"",component:(()=>{class t{constructor(n,o,s,a,u,f){this.historyService=n,this.router=o,this.activatedRoute=s,this.datePipe=a,this.userApiService=u,this.companyApiService=f,this.rows=[],this.loadingIndicator=!0,this.reorderable=!0,this.ColumnMode=l.hq,this.companies=[],this.users=[],this.selectedCompany=null,this.selectedUser=null,this.dateStart="",this.dateEnd=""}makeDate(n){return this.datePipe.transform(n,"d/M/Y H:mm:ss")}pipeEntity(n){return JSON.stringify(n)}ngOnInit(){this.historyService.getAll().subscribe(n=>{this.rows=n.data,this.loadingIndicator=!1}),this.userApiService.getUsers().subscribe(n=>{this.users=n.data}),this.companyApiService.getCompanies().subscribe(n=>{this.companies=n.data})}buildQueryString(){let n="&";return this.selectedUser&&(n+=`user_id=${this.selectedUser}&`),this.selectedCompany&&(n+=`company_id=${this.selectedCompany}&`),n}filter(){this.loadingIndicator=!0,console.log(this.selectedUser);let n=this.buildQueryString();this.historyService.getAll(n).subscribe(o=>{this.rows=o.data,this.loadingIndicator=!1})}}return t.\u0275fac=function(n){return new(n||t)(e.Y36(p),e.Y36(r.F0),e.Y36(r.gz),e.Y36(d.uU),e.Y36(m.Q),e.Y36(P.s))},t.\u0275cmp=e.Xpm({type:t,selectors:[["app-logs"]],decls:30,vars:7,consts:[[1,"page-breadcrumb"],[1,"breadcrumb"],[1,"breadcrumb-item"],["routerLink","."],["aria-current","page",1,"breadcrumb-item","active"],[1,"row"],[1,"col-md-12","stretch-card"],[1,"card"],[1,"card-body"],[1,"card-title","d-flex","justify-content-between"],["routerLink","new","tabindex","-1","role","button",1,"btn","btn-primary"],[1,"col-12","col-md-6"],["bindLabel","name","bindValue","id",3,"items","ngModel","change","ngModelChange"],[1,"table-responsive"],["rowHeight","auto",1,"bootstrap",3,"rows","loadingIndicator","columnMode","footerHeight","limit"],["name","User","prop","user"],["name","Action","prop","action"],["name","Entity","prop","entity"],["name","Updated at","prop","updated_at"],["name","Original entity"],["ngx-datatable-cell-template",""],["name","Updated entity"],[3,"json","expanded"]],template:function(n,o){1&n&&(e.TgZ(0,"nav",0)(1,"ol",1)(2,"li",2)(3,"a",3),e._uU(4,"Logs"),e.qZA()(),e.TgZ(5,"li",4),e._uU(6,"Log of changes"),e.qZA()()(),e.TgZ(7,"div",5)(8,"div",6)(9,"div",7)(10,"div",8)(11,"h6",9),e._uU(12," Logs "),e.TgZ(13,"a",10),e._uU(14,"New"),e.qZA()(),e.TgZ(15,"div",5)(16,"div",11)(17,"label"),e._uU(18,"User"),e.qZA(),e.TgZ(19,"ng-select",12),e.NdJ("change",function(){return o.filter()})("ngModelChange",function(a){return o.selectedUser=a}),e.qZA()()(),e.TgZ(20,"div",13)(21,"ngx-datatable",14),e._UZ(22,"ngx-datatable-column",15)(23,"ngx-datatable-column",16)(24,"ngx-datatable-column",17)(25,"ngx-datatable-column",18),e.TgZ(26,"ngx-datatable-column",19),e.YNc(27,S,1,4,"ng-template",20),e.qZA(),e.TgZ(28,"ngx-datatable-column",21),e.YNc(29,E,1,4,"ng-template",20),e.qZA()()()()()()()),2&n&&(e.xp6(19),e.Q6J("items",o.users)("ngModel",o.selectedUser),e.xp6(2),e.Q6J("rows",o.rows)("loadingIndicator",o.loadingIndicator)("columnMode",o.ColumnMode.force)("footerHeight",50)("limit",10))},dependencies:[r.yS,l.nE,l.UC,l.vq,J,M.w9,x.JJ,x.On]}),t})()}];let D=(()=>{class t{}return t.\u0275fac=function(n){return new(n||t)},t.\u0275mod=e.oAB({type:t}),t.\u0275inj=e.cJS({imports:[d.ez,r.Bz.forChild(N),l.xD,T,M.A0,x.u5]}),t})()}}]);