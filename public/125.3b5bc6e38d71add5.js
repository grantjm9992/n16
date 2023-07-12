"use strict";(self.webpackChunknobleui_angular=self.webpackChunknobleui_angular||[]).push([[125],{9632:(f,g,c)=>{c.d(g,{n:()=>h});var u=c(5384),l=c(4650);let h=(()=>{class o extends u.s{getAll(i=""){return this.get(`${this.getUrl()}?${i}`)}find(i){return this.get(`${this.getUrl()}/${i}`)}create(i){return this.post(`${this.getUrl()}`,i)}update(i,a){return this.post(`${this.getUrl()}/${i}`,a)}remove(i){return this.delete(`${this.getUrl()}/${i}`)}}return o.\u0275fac=function(){let e;return function(a){return(e||(e=l.n5z(o)))(a||o)}}(),o.\u0275prov=l.Yz7({token:o,factory:o.\u0275fac,providedIn:"root"}),o})()},6347:(f,g,c)=>{c.d(g,{s:()=>h});var u=c(9632),l=c(4650);let h=(()=>{class o extends u.n{getClassrooms(i=""){return this.get(`/classroom?company_id=${i}`)}getClassroom(i){return this.get(`/classroom/${i}`)}createClassroom(i){return this.post("/classroom",i)}updateClassroom(i,a){return this.post(`/classroom/${i}`,a)}getUrl(){return"/classroom"}}return o.\u0275fac=function(){let e;return function(a){return(e||(e=l.n5z(o)))(a||o)}}(),o.\u0275prov=l.Yz7({token:o,factory:o.\u0275fac,providedIn:"root"}),o})()},5954:(f,g,c)=>{c.d(g,{s:()=>h});var u=c(5384),l=c(4650);let h=(()=>{class o extends u.s{getCompanies(){return this.get("/companies")}getCompany(i){return this.get(`/companies/${i}`)}updateCompany(i,a){return this.post(`/companies/${i}`,a)}createCompany(i){return this.post("/companies",i)}}return o.\u0275fac=function(){let e;return function(a){return(e||(e=l.n5z(o)))(a||o)}}(),o.\u0275prov=l.Yz7({token:o,factory:o.\u0275fac,providedIn:"root"}),o})()},3688:(f,g,c)=>{c.d(g,{L:()=>h});var u=c(5384),l=c(4650);let h=(()=>{class o extends u.s{getEvents(i="",a="",p="",y=""){return this.get(`/events?date=${i}&by_teacher=${a}&company_id=${p}&my_calendar=${y}`)}getEvent(i){return this.get(`/events/${i}`)}updateEvent(i,a){return this.post(`/events/${i}`,a)}updateEventForGroup(i,a){return this.post(`/events/update-events-for-group/${i}`,a)}deleteEventsForGroup(i,a){return this.post(`/events/delete-events-for-group/${i}`,{date_range_start:a})}deleteEvent(i){return this.delete(`/events/${i}`)}updateEventClassroom(i,a){return this.post(`/events/update-classroom/${i}/${a}`)}updateEventStart(i,a){return this.post(`/events/update-dates/${i}`,a)}updateEventTeacher(i,a){return this.post(`/events/update-teacher/${i}/${a}`)}updateEventTeacherForGroup(i,a){return this.post(`/events/update-teacher-for-group/${i}/${a}`)}updateEventClassroomForGroup(i,a){return this.post(`/events/update-classroom-for-group/${i}/${a}`)}createEvent(i){return this.post("/events",i)}getEventTypes(){return this.get("/event-type")}suspendForDay(i,a){return this.post(`/events/suspend-events/${i}/${a}`)}}return o.\u0275fac=function(){let e;return function(a){return(e||(e=l.n5z(o)))(a||o)}}(),o.\u0275prov=l.Yz7({token:o,factory:o.\u0275fac,providedIn:"root"}),o})()},5902:(f,g,c)=>{c.d(g,{O:()=>h});var u=c(5384),l=c(4650);let h=(()=>{class o extends u.s{getTeachers(i=""){return this.get(`/teacher?company_id=${i}`)}getTeacher(i){return this.get(`/teacher/${i}`)}updateTeacher(i,a){return this.post(`/teacher/${i}`,a)}createTeacher(i){return this.post("/teacher",i)}deleteTeacher(i,a){return this.delete(`/teacher/${i}`)}}return o.\u0275fac=function(){let e;return function(a){return(e||(e=l.n5z(o)))(a||o)}}(),o.\u0275prov=l.Yz7({token:o,factory:o.\u0275fac,providedIn:"root"}),o})()},4125:(f,g,c)=>{c.r(g),c.d(g,{EventModule:()=>R});var u=c(6895),l=c(3599),h=c(5226),o=c.n(h),e=c(4650),i=c(5954),a=c(3688),p=c(433),y=c(9177),v=c(9061);function T(r,d){if(1&r&&(e.TgZ(0,"p",20),e._uU(1),e.qZA()),2&r){const t=d.$implicit;e.xp6(1),e.Oqu(t)}}let A=(()=>{class r{constructor(t,n,s){this.companyApiService=t,this.eventApiService=n,this.router=s,this.error=[],this.companies=[],this.company_id=null,this.date=""}ngOnInit(){this.companyApiService.getCompanies().subscribe(t=>{this.companies=t.data})}onSubmit(){this.company_id&&this.date&&this.eventApiService.suspendForDay(this.company_id,this.date).subscribe(t=>{o().fire({icon:"success",title:"Success",text:`Classes have been suspended on ${this.date}`})},t=>{this.error.push(t.message)})}dateChange(t){this.date=this.getDateString(t)}getDateString(t){return`${t.year}-${this.pad(t.month)}-${this.pad(t.day)}`}pad(t,n=2){let s=t+"";for(;s.length<n;)s="0"+s;return s}}return r.\u0275fac=function(t){return new(t||r)(e.Y36(i.s),e.Y36(a.L),e.Y36(l.F0))},r.\u0275cmp=e.Xpm({type:r,selectors:[["app-event"]],decls:29,vars:3,consts:[[1,"page-breadcrumb"],[1,"breadcrumb"],[1,"breadcrumb-item","active"],["routerLink","."],[1,"row"],[1,"col-md-12","grid-margin","stretch-card"],[1,"card"],[1,"card-body"],[1,"card-title"],[1,"col-md-6"],[1,"mb-3"],[1,"form-label"],["bindLabel","name","bindValue","id",3,"items","ngModel","ngModelChange"],[1,"input-group"],["placeholder","yyyy-mm-dd","ngbDatepicker","",1,"form-control",3,"dateSelect"],["date","ngbDatepicker"],["type","button",1,"input-group-text",3,"click"],[1,"feather","icon-calendar","icon-md","text-muted"],["type","submit",1,"btn","btn-primary","me-2",3,"click"],["class","text-danger mt-1",4,"ngFor","ngForOf"],[1,"text-danger","mt-1"]],template:function(t,n){if(1&t){const s=e.EpF();e.TgZ(0,"nav",0)(1,"ol",1)(2,"li",2)(3,"a",3),e._uU(4,"Events"),e.qZA()()()(),e.TgZ(5,"div",4)(6,"div",5)(7,"div",6)(8,"div",7)(9,"h6",8),e._uU(10,"Suspend classes by academy and date"),e.qZA(),e.TgZ(11,"div",4)(12,"div",9)(13,"div",10)(14,"label",11),e._uU(15,"Company"),e.qZA(),e.TgZ(16,"ng-select",12),e.NdJ("ngModelChange",function(_){return n.company_id=_}),e.qZA()()(),e.TgZ(17,"div",9)(18,"div",10)(19,"label",11),e._uU(20,"Date"),e.qZA(),e.TgZ(21,"div",13)(22,"input",14,15),e.NdJ("dateSelect",function(_){return n.dateChange(_)}),e.qZA(),e.TgZ(24,"button",16),e.NdJ("click",function(){e.CHM(s);const _=e.MAs(23);return e.KtG(_.toggle())}),e._UZ(25,"i",17),e.qZA()()()(),e.TgZ(26,"button",18),e.NdJ("click",function(){return n.onSubmit()}),e._uU(27,"Submit"),e.qZA()(),e.YNc(28,T,2,1,"p",19),e.qZA()()()()}2&t&&(e.xp6(16),e.Q6J("items",n.companies)("ngModel",n.company_id),e.xp6(12),e.Q6J("ngForOf",n.error))},dependencies:[u.sg,l.yS,p.JJ,p.On,y.w9,v.J4]}),r})();var Z=c(3116),b=c(5384);let C=(()=>{class r extends b.s{getGroups(){return this.get("/groups")}}return r.\u0275fac=function(){let d;return function(n){return(d||(d=e.n5z(r)))(n||r)}}(),r.\u0275prov=e.Yz7({token:r,factory:r.\u0275fac,providedIn:"root"}),r})();var E=c(5902),S=c(40),U=c(6347),x=c(8386);const q=["date_range_end"];function M(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.name.errors.error)}}function I(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.event_type_id.errors.error)}}function $(r,d){1&r&&e._UZ(0,"input",40),2&r&&e.Q6J("hidden",!0)}function N(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw(2);e.xp6(1),e.Oqu(t.form.controls.company_id.errors.error)}}function O(r,d){if(1&r){const t=e.EpF();e.TgZ(0,"div",11)(1,"div",12)(2,"label",13),e._uU(3,"Company"),e.qZA(),e.TgZ(4,"ng-select",41),e.NdJ("change",function(){e.CHM(t);const s=e.oxw();return e.KtG(s.filterSelects())})("ngModelChange",function(s){e.CHM(t);const m=e.oxw();return e.KtG(m.selectedSimpleItem=s)}),e.qZA(),e.YNc(5,N,2,1,"p",15),e.qZA()()}if(2&r){const t=e.oxw();e.xp6(4),e.Q6J("items",t.companies)("ngModel",t.selectedSimpleItem),e.xp6(1),e.Q6J("ngIf",t.form.controls.company_id.errors)}}function J(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.classroom_id.errors.error)}}function D(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.teacher_id.errors.error)}}function Y(r,d){if(1&r&&(e.TgZ(0,"option",42),e._uU(1),e.qZA()),2&r){const t=d.$implicit;e.Q6J("value",t.id),e.xp6(1),e.Oqu(t.name)}}function F(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.date_range_start.errors.error)}}function k(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.date_range_end.errors.error)}}function Q(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.days_of_the_week.errors.error)}}function L(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.time_start.errors.error)}}function P(r,d){if(1&r&&(e.TgZ(0,"p",39),e._uU(1),e.qZA()),2&r){const t=e.oxw();e.xp6(1),e.Oqu(t.form.controls.time_end.errors.error)}}function B(r,d){if(1&r&&(e.TgZ(0,"p",43),e._uU(1),e.qZA()),2&r){const t=d.$implicit;e.xp6(1),e.Oqu(t)}}const G=function(r){return{error:r}};let K=(()=>{class r{constructor(t,n,s,m,_,V,H,j,X,ee,te,re){this.eventApiService=t,this.eventTypeApiService=n,this.groupApiService=s,this.teacherApiService=m,this.departmentApiService=_,this.classroomApiService=V,this.formBuilder=H,this.router=j,this.companyApiService=X,this.userService=ee,this.config=te,this.datePipe=re,this.error=[],this.selectedSimpleItem=null,this.companies=[],this.groups=[],this.teachers=[],this.eventTypes=[],this.classrooms=[],this.departments=[],this.filtered_companies=[],this.filtered_groups=[],this.filtered_teachers=[],this.filtered_eventTypes=[],this.filtered_classrooms=[],this.filtered_departments=[],this.event=null,this.daysOfTheWeek=[{name:"Monday",id:1},{name:"Tuesday",id:2},{name:"Wednesday",id:3},{name:"Thursday",id:4},{name:"Friday",id:5},{name:"Saturday",id:6}]}ngOnInit(){this.activeUser=this.userService.getUser(),this.form=this.formBuilder.group({name:["",p.kI.required],description:["",p.kI.required],classroom_id:[null,p.kI.required],company_id:[null,p.kI.required],teacher_id:[null,p.kI.required],event_type_id:[null,p.kI.required],group_id:[null,p.kI.required],department_id:["not_set",p.kI.required],date_range_start:["",p.kI.required],date_range_end:["",p.kI.required],days_of_the_week:["",p.kI.required],time_start:[null,p.kI.required],time_end:[null,p.kI.required],status_id:1}),this.form.get("start_date")?.valueChanges.subscribe(t=>{t&&(this.minEndDate=t,this.config.minDate=t,this.date_range_end.navigateTo({year:t.year,month:t.month}))}),("super_admin"===this.activeUser.user_role||"admin"===this.activeUser.user_role)&&this.companyApiService.getCompanies().subscribe(t=>{this.companies=t.data}),this.groupApiService.getGroups().subscribe(t=>{this.groups=t.data,this.filtered_groups=t.data}),this.teacherApiService.getTeachers().subscribe(t=>{let s=[{id:"not_set",name:"Unassigned"}].concat(t.data);this.teachers=s,this.filtered_teachers=s}),this.eventTypeApiService.getAll().subscribe(t=>{this.eventTypes=t.data,this.filtered_eventTypes=t.data}),this.departmentApiService.getAll().subscribe(t=>{let s=[{id:"not_set",name:"Unassigned"}].concat(t.data);this.departments=s,this.filtered_departments=s}),this.classroomApiService.getClassrooms().subscribe(t=>{this.classrooms=t.data,this.filtered_classrooms=t.data})}onSubmit(){this.error=[];let t=this.createEvent();this._submit(t)}onSubmitAndStay(){this.error=[];let t=this.createEvent();this._submit(t,!0)}fireSwal(){o().fire({icon:"success",title:"Success",text:"Event(s) added correctly"})}_submit(t,n=!1){this.eventApiService.createEvent(t).subscribe(s=>n?void this.fireSwal():void this.router.navigate(["/event"]),s=>{if(s.errors)for(let m in s.errors)this.form.controls[m].setErrors({error:s.errors[m]});else this.error.push(s.message)})}createEvent(){let t=this.form.value;return t.date_range_end=this.getDateString(t.date_range_end),t.date_range_start=this.getDateString(t.date_range_start),t.time_start=this.getTimeString(t.time_start),t.time_end=this.getTimeString(t.time_end),t}getDateString(t){return`${t.year}-${this.pad(t.month)}-${this.pad(t.day)}`}filterDepartments(t){}stringToDateObject(t){return{year:Number(this.datePipe.transform(t,"yyyy")),month:Number(this.datePipe.transform(t,"MM")),day:Number(this.datePipe.transform(t,"dd"))}}stringToTimeObject(t){const n=t.split(":");return{hour:parseInt(n[0]),minute:parseInt(n[1])}}updateName(){let t=this.groups.filter(n=>n.id===this.form.get("group_id")?.value);if(t.length>0){const n=t[0];console.log(this.stringToTimeObject(n.start_time)),this.form.patchValue({name:n.name,days_of_the_week:n.days_of_the_week,date_range_start:this.stringToDateObject(n.date_start),date_range_end:this.stringToDateObject(n.date_end),time_start:this.stringToTimeObject(n.start_time),time_end:this.stringToTimeObject(n.end_time)})}}getTimeString(t,n=!1){let s=`${this.pad(t.hour)}:${this.pad(t.minute)}`;return n&&(s+=`:${this.pad(t.second)}`),s}pad(t,n=2){let s=t+"";for(;s.length<n;)s="0"+s;return s}filterSelects(){this.classrooms=this.filtered_classrooms.filter(t=>t.company_id===this.selectedSimpleItem)}}return r.\u0275fac=function(t){return new(t||r)(e.Y36(a.L),e.Y36(Z.L),e.Y36(C),e.Y36(E.O),e.Y36(S.N),e.Y36(U.s),e.Y36(p.qu),e.Y36(l.F0),e.Y36(i.s),e.Y36(x.K),e.Y36(v.M4),e.Y36(u.uU))},r.\u0275cmp=e.Xpm({type:r,selectors:[["app-edit"]],viewQuery:function(t,n){if(1&t&&e.Gf(q,5),2&t){let s;e.iGM(s=e.CRH())&&(n.date_range_end=s.first)}},decls:97,vars:26,consts:[[1,"page-breadcrumb"],[1,"breadcrumb"],[1,"breadcrumb-item"],["routerLink","."],["aria-current","page",1,"breadcrumb-item","active"],[1,"row"],[1,"col-md-12","grid-margin","stretch-card"],[1,"card"],[1,"card-body"],[1,"card-title"],[1,"forms-sample",3,"formGroup","ngSubmit"],[1,"col-md-6"],[1,"mb-3"],["for","name",1,"form-label"],["type","text","id","name","autocomplete","off","placeholder","Name","formControlName","name",1,"form-control",3,"ngClass"],["class","text-danger",4,"ngIf"],["bindLabel","name","bindValue","id","placeholder","type to search","formControlName","event_type_id",3,"items","ngModel","change","ngModelChange"],["class","form-control wd-150","formControlName","company_id",3,"hidden",4,"ngIf"],["class","col-md-6",4,"ngIf"],["bindLabel","name","bindValue","id","placeholder","type to search","formControlName","classroom_id",3,"items"],["bindLabel","name","bindValue","id","placeholder","type to search","formControlName","teacher_id",3,"items"],["bindLabel","name","bindValue","id","placeholder","type to search","formControlName","group_id",3,"items","change"],["id","department_id","formControlName","department_id",1,"form-select"],[3,"value",4,"ngFor","ngForOf"],[1,"input-group"],["placeholder","yyyy-mm-dd","formControlName","date_range_start","ngbDatepicker","",1,"form-control"],["date_range_start","ngbDatepicker"],["type","button",1,"input-group-text",3,"click"],[1,"feather","icon-calendar","icon-md","text-muted"],["placeholder","yyyy-mm-dd","formControlName","date_range_end","ngbDatepicker","",1,"form-control",3,"minDate"],["date_range_end","ngbDatepicker"],[1,"col-md-12"],["bindLabel","name","bindValue","id","placeholder","type to search","formControlName","days_of_the_week",3,"items","multiple"],["formControlName","time_start"],["formControlName","time_end"],["type","submit",1,"btn","btn-primary","me-2"],[1,"btn","btn-inverse-primary","me-2",3,"click"],["routerLink","../",1,"btn","btn-secondary"],["class","text-danger mt-1",4,"ngFor","ngForOf"],[1,"text-danger"],["formControlName","company_id",1,"form-control","wd-150",3,"hidden"],["bindLabel","name","bindValue","id","placeholder","type to search","formControlName","company_id",3,"items","ngModel","change","ngModelChange"],[3,"value"],[1,"text-danger","mt-1"]],template:function(t,n){if(1&t){const s=e.EpF();e.TgZ(0,"nav",0)(1,"ol",1)(2,"li",2)(3,"a",3),e._uU(4,"Events"),e.qZA()(),e.TgZ(5,"li",4),e._uU(6),e.qZA()()(),e.TgZ(7,"div",5)(8,"div",6)(9,"div",7)(10,"div",8)(11,"h6",9),e._uU(12,"Event"),e.qZA(),e.TgZ(13,"form",10),e.NdJ("ngSubmit",function(){return n.onSubmit()}),e.TgZ(14,"div",5)(15,"div",11)(16,"div",12)(17,"label",13),e._uU(18,"Name"),e.qZA(),e._UZ(19,"input",14),e.YNc(20,M,2,1,"p",15),e.qZA()(),e.TgZ(21,"div",11)(22,"div",12)(23,"label",13),e._uU(24,"Event type"),e.qZA(),e.TgZ(25,"ng-select",16),e.NdJ("change",function(_){return n.filterDepartments(_)})("ngModelChange",function(_){return n.eventType=_}),e.qZA(),e.YNc(26,I,2,1,"p",15),e.qZA()(),e.YNc(27,$,1,1,"input",17),e.YNc(28,O,6,3,"div",18),e.TgZ(29,"div",11)(30,"div",12)(31,"label",13),e._uU(32,"Classroom"),e.qZA(),e._UZ(33,"ng-select",19),e.YNc(34,J,2,1,"p",15),e.qZA()(),e.TgZ(35,"div",11)(36,"div",12)(37,"label",13),e._uU(38,"Teacher"),e.qZA(),e._UZ(39,"ng-select",20),e.YNc(40,D,2,1,"p",15),e.qZA()(),e.TgZ(41,"div",11)(42,"div",12)(43,"label",13),e._uU(44,"Group"),e.qZA(),e.TgZ(45,"ng-select",21),e.NdJ("change",function(){return n.updateName()}),e.qZA()()(),e.TgZ(46,"div",11)(47,"div",12)(48,"label",13),e._uU(49,"Department"),e.qZA(),e.TgZ(50,"select",22),e.YNc(51,Y,2,2,"option",23),e.qZA()()(),e.TgZ(52,"div",11)(53,"div",12)(54,"label",13),e._uU(55,"Start date"),e.qZA(),e.TgZ(56,"div",24),e._UZ(57,"input",25,26),e.TgZ(59,"button",27),e.NdJ("click",function(){e.CHM(s);const _=e.MAs(58);return e.KtG(_.toggle())}),e._UZ(60,"i",28),e.qZA()(),e.YNc(61,F,2,1,"p",15),e.qZA()(),e.TgZ(62,"div",11)(63,"div",12)(64,"label",13),e._uU(65,"End date"),e.qZA(),e.TgZ(66,"div",24),e._UZ(67,"input",29,30),e.TgZ(69,"button",27),e.NdJ("click",function(){e.CHM(s);const _=e.MAs(68);return e.KtG(_.toggle())}),e._UZ(70,"i",28),e.qZA()(),e.YNc(71,k,2,1,"p",15),e.qZA()(),e.TgZ(72,"div",31)(73,"div",12)(74,"label",13),e._uU(75,"Days of the week"),e.qZA(),e._UZ(76,"ng-select",32),e.YNc(77,Q,2,1,"p",15),e.qZA()(),e.TgZ(78,"div",11)(79,"div",12)(80,"label",13),e._uU(81,"Start time"),e.qZA(),e._UZ(82,"ngb-timepicker",33),e.YNc(83,L,2,1,"p",15),e.qZA()(),e.TgZ(84,"div",11)(85,"div",12)(86,"label",13),e._uU(87,"End time"),e.qZA(),e._UZ(88,"ngb-timepicker",34),e.YNc(89,P,2,1,"p",15),e.qZA()()(),e.TgZ(90,"button",35),e._uU(91,"Submit"),e.qZA(),e.TgZ(92,"div",36),e.NdJ("click",function(){return n.onSubmitAndStay()}),e._uU(93,"Submit and add similar"),e.qZA(),e.TgZ(94,"div",37),e._uU(95,"Cancel"),e.qZA()(),e.YNc(96,B,2,1,"p",38),e.qZA()()()()}2&t&&(e.xp6(6),e.Oqu(null===n.event?"New":"Edit"),e.xp6(7),e.Q6J("formGroup",n.form),e.xp6(6),e.Q6J("ngClass",e.VKq(24,G,n.form.controls.name.hasError("error"))),e.xp6(1),e.Q6J("ngIf",n.form.controls.name.errors),e.xp6(5),e.Q6J("items",n.eventTypes)("ngModel",n.eventType),e.xp6(1),e.Q6J("ngIf",n.form.controls.event_type_id.errors),e.xp6(1),e.Q6J("ngIf","super_admin"!==n.activeUser.user_role&&"admin"!==n.activeUser.user_role),e.xp6(1),e.Q6J("ngIf","super_admin"==n.activeUser.user_role||"admin"),e.xp6(5),e.Q6J("items",n.classrooms),e.xp6(1),e.Q6J("ngIf",n.form.controls.classroom_id.errors),e.xp6(5),e.Q6J("items",n.teachers),e.xp6(1),e.Q6J("ngIf",n.form.controls.teacher_id.errors),e.xp6(5),e.Q6J("items",n.groups),e.xp6(6),e.Q6J("ngForOf",n.departments),e.xp6(10),e.Q6J("ngIf",n.form.controls.date_range_start.errors),e.xp6(6),e.Q6J("minDate",n.form.value.date_range_start),e.xp6(4),e.Q6J("ngIf",n.form.controls.date_range_end.errors),e.xp6(5),e.Q6J("items",n.daysOfTheWeek)("multiple",!0),e.xp6(1),e.Q6J("ngIf",n.form.controls.days_of_the_week.errors),e.xp6(6),e.Q6J("ngIf",n.form.controls.time_start.errors),e.xp6(6),e.Q6J("ngIf",n.form.controls.time_end.errors),e.xp6(7),e.Q6J("ngForOf",n.error))},dependencies:[u.mk,u.sg,u.O5,l.rH,l.yS,p._Y,p.YN,p.Kr,p.Fj,p.EJ,p.JJ,p.JL,p.sg,p.u,y.w9,v.J4,v.Pm]}),r})();var w=c(9585);const W=[{path:"",component:A,canActivate:[c(8237).c]},{path:":id",component:K}];let R=(()=>{class r{}return r.\u0275fac=function(t){return new(t||r)},r.\u0275mod=e.oAB({type:r}),r.\u0275inj=e.cJS({providers:[u.uU],imports:[u.ez,l.Bz.forChild(W),w.xD,p.u5,p.UX,y.A0,v.M,v.UL]}),r})()}}]);