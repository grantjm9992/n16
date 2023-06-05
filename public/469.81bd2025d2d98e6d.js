"use strict";(self.webpackChunknobleui_angular=self.webpackChunknobleui_angular||[]).push([[469],{9632:(v,h,s)=>{s.d(h,{n:()=>t});var p=s(5384),u=s(4650);let t=(()=>{class l extends p.s{getAll(r=""){return this.get(`${this.getUrl()}?${r}`)}find(r){return this.get(`${this.getUrl()}/${r}`)}create(r){return this.post(`${this.getUrl()}`,r)}update(r,_){return this.post(`${this.getUrl()}/${r}`,_)}remove(r){return this.delete(`${this.getUrl()}/${r}`)}}return l.\u0275fac=function(){let m;return function(_){return(m||(m=u.n5z(l)))(_||l)}}(),l.\u0275prov=u.Yz7({token:l,factory:l.\u0275fac,providedIn:"root"}),l})()},5954:(v,h,s)=>{s.d(h,{s:()=>t});var p=s(5384),u=s(4650);let t=(()=>{class l extends p.s{getCompanies(){return this.get("/companies")}getCompany(r){return this.get(`/companies/${r}`)}updateCompany(r,_){return this.post(`/companies/${r}`,_)}createCompany(r){return this.post("/companies",r)}}return l.\u0275fac=function(){let m;return function(_){return(m||(m=u.n5z(l)))(_||l)}}(),l.\u0275prov=u.Yz7({token:l,factory:l.\u0275fac,providedIn:"root"}),l})()},3469:(v,h,s)=>{s.r(h),s.d(h,{HolidayModule:()=>F});var p=s(6895),u=s(9585),t=s(4650),l=s(9632);let m=(()=>{class o extends l.n{getUrl(){return"/holidays"}accept(e){return this.get(`${this.getUrl()}/${e}/accept`)}reject(e){return this.get(`${this.getUrl()}/${e}/reject`)}revoke(e){return this.get(`${this.getUrl()}/${e}/revoke`)}}return o.\u0275fac=function(){let n;return function(a){return(n||(n=t.n5z(o)))(a||o)}}(),o.\u0275prov=t.Yz7({token:o,factory:o.\u0275fac,providedIn:"root"}),o})();var r=s(3599),_=s(5954),y=s(8386),f=s(9061);function A(o,n){if(1&o&&t._uU(0),2&o){const e=n.value;t.AsE(" ",e.name," ",e.surname," ")}}function T(o,n){1&o&&(t.TgZ(0,"ngx-datatable-column",20),t.YNc(1,A,1,2,"ng-template",18),t.qZA())}function Z(o,n){1&o&&(t.TgZ(0,"button",21),t._UZ(1,"i",22),t.qZA()),2&o&&t.s9C("ngbPopover",n.row.notes)}function C(o,n){if(1&o){const e=t.EpF();t.TgZ(0,"button",25),t.NdJ("click",function(){t.CHM(e);const i=t.oxw().row,c=t.oxw(2);return t.KtG(c.accept(i.id))}),t._uU(1," Accept "),t.qZA()}}function x(o,n){if(1&o){const e=t.EpF();t.TgZ(0,"button",25),t.NdJ("click",function(){t.CHM(e);const i=t.oxw().row,c=t.oxw(2);return t.KtG(c.reject(i.id))}),t._uU(1," Reject "),t.qZA()}}function U(o,n){if(1&o){const e=t.EpF();t.TgZ(0,"button",25),t.NdJ("click",function(){t.CHM(e);const i=t.oxw().row,c=t.oxw(2);return t.KtG(c.revoke(i.id))}),t._uU(1," Revoke "),t.qZA()}}function S(o,n){if(1&o&&(t.YNc(0,C,2,0,"button",24),t.YNc(1,x,2,0,"button",24),t.YNc(2,U,2,0,"button",24)),2&o){const e=n.row;t.Q6J("ngIf","accepted"!==e.status),t.xp6(1),t.Q6J("ngIf","pending"===e.status),t.xp6(1),t.Q6J("ngIf","accepted"===e.status)}}function H(o,n){1&o&&(t.TgZ(0,"ngx-datatable-column",23),t.YNc(1,S,3,3,"ng-template",18),t.qZA()),2&o&&t.Q6J("sortable",!1)}let w=(()=>{class o{constructor(e,a,i,c,g){this.holidayApiService=e,this.router=a,this.activatedRoute=i,this.companyApiService=c,this.userService=g,this.rows=[],this.loadingIndicator=!0,this.reorderable=!0,this.ColumnMode=u.hq}ngOnInit(){this.user=this.userService.getUser(),this.loadData()}loadData(){this.loadingIndicator=!0,this.holidayApiService.getAll().subscribe(e=>{this.rows=e.data,this.loadingIndicator=!1})}onSelect(e){console.log(e)}accept(e){this.holidayApiService.accept(e).subscribe(a=>{this.loadData()})}reject(e){this.holidayApiService.reject(e).subscribe(a=>{this.loadData()})}revoke(e){this.holidayApiService.revoke(e).subscribe(a=>{this.loadData()})}onRowClicked(e){"click"===e.type&&this.router.navigate([e.row.id],{relativeTo:this.activatedRoute})}}return o.\u0275fac=function(e){return new(e||o)(t.Y36(m),t.Y36(r.F0),t.Y36(r.gz),t.Y36(_.s),t.Y36(y.K))},o.\u0275cmp=t.Xpm({type:o,selectors:[["app-holiday"]],decls:24,vars:7,consts:[[1,"page-breadcrumb"],[1,"breadcrumb"],[1,"breadcrumb-item"],["routerLink","."],["aria-current","page",1,"breadcrumb-item","active"],[1,"row"],[1,"col-md-12","stretch-card"],[1,"card"],[1,"card-body"],[1,"card-title","d-flex","justify-content-between"],["routerLink","new","tabindex","-1","role","button",1,"btn","btn-primary"],[1,"table-responsive"],["rowHeight","auto",1,"bootstrap",3,"rows","loadingIndicator","columnMode","footerHeight","limit","activate"],["name","Teacher","prop","teacher",4,"ngIf"],["name","Date start","prop","start_date"],["name","Date end","prop","end_date"],["name","Status","prop","status"],["name","Information"],["ngx-datatable-cell-template",""],["name","Actions","prop","id",3,"sortable",4,"ngIf"],["name","Teacher","prop","teacher"],["type","button","placement","start",1,"btn","btn-primary",3,"ngbPopover"],[1,"feather","icon-info"],["name","Actions","prop","id",3,"sortable"],["class","btn btn-dark mx-1",3,"click",4,"ngIf"],[1,"btn","btn-dark","mx-1",3,"click"]],template:function(e,a){1&e&&(t.TgZ(0,"nav",0)(1,"ol",1)(2,"li",2)(3,"a",3),t._uU(4,"Holidays"),t.qZA()(),t.TgZ(5,"li",4),t._uU(6,"List"),t.qZA()()(),t.TgZ(7,"div",5)(8,"div",6)(9,"div",7)(10,"div",8)(11,"h6",9),t._uU(12," Holiday requests "),t.TgZ(13,"a",10),t._uU(14,"New"),t.qZA()(),t.TgZ(15,"div",11)(16,"ngx-datatable",12),t.NdJ("activate",function(c){return a.onRowClicked(c)}),t.YNc(17,T,2,0,"ngx-datatable-column",13),t._UZ(18,"ngx-datatable-column",14)(19,"ngx-datatable-column",15)(20,"ngx-datatable-column",16),t.TgZ(21,"ngx-datatable-column",17),t.YNc(22,Z,2,1,"ng-template",18),t.qZA(),t.YNc(23,H,2,1,"ngx-datatable-column",19),t.qZA()()()()()()),2&e&&(t.xp6(16),t.Q6J("rows",a.rows)("loadingIndicator",a.loadingIndicator)("columnMode",a.ColumnMode.force)("footerHeight",50)("limit",10),t.xp6(1),t.Q6J("ngIf","teacher"!==a.user.user_role),t.xp6(6),t.Q6J("ngIf","teacher"!==a.user.user_role))},dependencies:[p.O5,r.yS,u.nE,u.UC,u.vq,f.o8]}),o})();var d=s(433),k=s(5902),b=s(9177);function I(o,n){if(1&o&&t._uU(0),2&o){const e=n.item,a=t.oxw(2);t.hij(" ",a.getUser(e)," ")}}function E(o,n){if(1&o&&(t.TgZ(0,"div",12)(1,"label",13),t._uU(2,"Teacher"),t.qZA(),t.TgZ(3,"ng-select",25),t.YNc(4,I,1,1,"ng-template",26),t.qZA()()),2&o){const e=t.oxw();t.xp6(3),t.Q6J("items",e.teachers)("searchFn",e.customSearchFn)}}function N(o,n){if(1&o&&(t.TgZ(0,"p",27),t._uU(1),t.qZA()),2&o){const e=n.$implicit;t.xp6(1),t.Oqu(e)}}let M=(()=>{class o{constructor(e,a,i,c,g,J,q){this.userService=e,this.teacherApiService=a,this.holidayApiService=i,this.formBuilder=c,this.activatedRoute=g,this.router=J,this.datePipe=q,this.teachers=[],this.error=[]}ngOnInit(){this.activeUser=this.userService.getUser(),this.teacherApiService.getTeachers().subscribe(e=>{this.teachers=e.data}),this.id=this.activatedRoute.snapshot.paramMap.get("id"),this.form=this.formBuilder.group("teacher"===this.activeUser.user_role?{start_date:["",d.kI.required],end_date:["",d.kI.required],notes:[""]}:{teacher_id:[null,d.kI.required],start_date:["",d.kI.required],end_date:["",d.kI.required],notes:[""]}),null!==this.id&&"new"!==this.id&&this.holidayApiService.find(this.id).subscribe(e=>{this.holiday=e.data,this.form.patchValue(e.data),console.log(this.holiday.start_date),this.form.patchValue({start_date:this.stringToDateObject(this.holiday.start_date),end_date:this.stringToDateObject(this.holiday.end_date)})})}onSubmit(){this.error=[];let e=this.form.value;e.start_date=this.getDateString(e.start_date),e.end_date=this.getDateString(e.end_date),"new"===this.id?this.holidayApiService.create(e).subscribe(a=>{this.router.navigate(["/holiday"])},a=>{if(a.errors)for(let i in a.errors)a.errors[i].forEach(c=>{this.error.push(c)});else this.error.push(a.message)}):this.holidayApiService.update(this.id,e).subscribe(a=>{this.router.navigate(["/holiday"])},a=>{if(a.errors)for(let i in a.errors)a.errors[i].forEach(c=>{this.error.push(c)});else this.error.push(a.message)})}getUser(e){return e.name+" "+e.surname}getDateString(e){return`${e.year}-${this.pad(e.month)}-${this.pad(e.day)}`}pad(e,a=2){let i=e+"";for(;i.length<a;)i="0"+i;return i}customSearchFn(e,a){return e=e.toLocaleLowerCase(),a.name.toLocaleLowerCase().indexOf(e)>-1||a.surname.toLocaleLowerCase().indexOf(e)>-1}stringToDateObject(e){return{year:Number(this.datePipe.transform(e,"yyyy")),month:Number(this.datePipe.transform(e,"MM")),day:Number(this.datePipe.transform(e,"dd"))}}}return o.\u0275fac=function(e){return new(e||o)(t.Y36(y.K),t.Y36(k.O),t.Y36(m),t.Y36(d.qu),t.Y36(r.gz),t.Y36(r.F0),t.Y36(p.uU))},o.\u0275cmp=t.Xpm({type:o,selectors:[["app-edit"]],decls:40,vars:3,consts:[[1,"page-breadcrumb"],[1,"breadcrumb"],[1,"breadcrumb-item"],["routerLink","../"],["aria-current","page",1,"breadcrumb-item","active"],[1,"row"],[1,"col-md-6","grid-margin","stretch-card"],[1,"card"],[1,"card-body"],[1,"card-title"],[1,"forms-sample",3,"formGroup","ngSubmit"],["class","mb-3",4,"ngIf"],[1,"mb-3"],[1,"form-label"],[1,"input-group"],["placeholder","yyyy-mm-dd","formControlName","start_date","ngbDatepicker","",1,"form-control"],["start_date","ngbDatepicker"],["type","button",1,"input-group-text",3,"click"],[1,"feather","icon-calendar","icon-md","text-muted"],["placeholder","yyyy-mm-dd","formControlName","end_date","ngbDatepicker","",1,"form-control"],["end_date","ngbDatepicker"],["id","notes","formControlName","notes","rows","5",1,"form-control"],["type","submit",1,"btn","btn-primary","me-2"],["routerLink","../",1,"btn","btn-secondary","me-2"],["class","text-danger mt-1",4,"ngFor","ngForOf"],["bindValue","id","formControlName","teacher_id",3,"items","searchFn"],["ng-option-tmp","","ng-label-tmp",""],[1,"text-danger","mt-1"]],template:function(e,a){if(1&e){const i=t.EpF();t.TgZ(0,"nav",0)(1,"ol",1)(2,"li",2)(3,"a",3),t._uU(4,"Holidays"),t.qZA()(),t.TgZ(5,"li",4),t._uU(6,"New request"),t.qZA()()(),t.TgZ(7,"div",5)(8,"div",6)(9,"div",7)(10,"div",8)(11,"h6",9),t._uU(12,"Holiday request"),t.qZA(),t.TgZ(13,"form",10),t.NdJ("ngSubmit",function(){return a.onSubmit()}),t.YNc(14,E,5,2,"div",11),t.TgZ(15,"div",12)(16,"label",13),t._uU(17,"From"),t.qZA(),t.TgZ(18,"div",14),t._UZ(19,"input",15,16),t.TgZ(21,"button",17),t.NdJ("click",function(){t.CHM(i);const g=t.MAs(20);return t.KtG(g.toggle())}),t._UZ(22,"i",18),t.qZA()()(),t.TgZ(23,"div",12)(24,"label",13),t._uU(25,"To"),t.qZA(),t.TgZ(26,"div",14),t._UZ(27,"input",19,20),t.TgZ(29,"button",17),t.NdJ("click",function(){t.CHM(i);const g=t.MAs(28);return t.KtG(g.toggle())}),t._UZ(30,"i",18),t.qZA()()(),t.TgZ(31,"div",12)(32,"label",13),t._uU(33,"Notes"),t.qZA(),t._UZ(34,"textarea",21),t.qZA(),t.TgZ(35,"button",22),t._uU(36,"Submit"),t.qZA(),t.TgZ(37,"div",23),t._uU(38,"Cancel"),t.qZA()(),t.YNc(39,N,2,1,"p",24),t.qZA()()()()}2&e&&(t.xp6(13),t.Q6J("formGroup",a.form),t.xp6(1),t.Q6J("ngIf","teacher"!==a.activeUser.user_role),t.xp6(25),t.Q6J("ngForOf",a.error))},dependencies:[p.sg,p.O5,r.rH,r.yS,d._Y,d.Fj,d.JJ,d.JL,d.sg,d.u,b.w9,b.ir,b.mR,f.J4]}),o})();var Y=s(9628);const D=[{path:"",component:w},{path:":id",component:M}];let F=(()=>{class o{}return o.\u0275fac=function(e){return new(e||o)},o.\u0275mod=t.oAB({type:o}),o.\u0275inj=t.cJS({imports:[p.ez,r.Bz.forChild(D),u.xD,d.u5,d.UX,b.A0,f.M,Y.L,f.HK,f.dT]}),o})()}}]);