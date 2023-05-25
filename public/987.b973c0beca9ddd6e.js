"use strict";(self.webpackChunknobleui_angular=self.webpackChunknobleui_angular||[]).push([[987],{4987:(E,i,o)=>{o.r(i),o.d(i,{CalendarModule:()=>S});var r=o(6895),v=o(7552),p=o(3401),u=o(7778),f=o(821),h=o(7789),e=o(4650),d=o(9061),Z=o(6347);let g=(()=>{class n{constructor(t,a,s){this.activeModal=t,this.datePipe=a,this.classroomApiService=s,this.classroom=""}ngOnInit(){this.classroomApiService.getClassroom(this.event._def.extendedProps.classroom_id).subscribe(t=>{this.classroom=t.data.name})}getTeacher(t){return t._def.extendedProps.teacher?.name+" "+t._def.extendedProps.teacher?.surname}getClassroom(t){return t._def.extendedProps.classroom?.name}}return n.\u0275fac=function(t){return new(t||n)(e.Y36(d.Kz),e.Y36(r.uU),e.Y36(Z.s))},n.\u0275cmp=e.Xpm({type:n,selectors:[["app-view-event-modal"]],inputs:{event:"event"},decls:25,vars:5,consts:[[1,"modal-header"],["id","exampleModalLabel",1,"modal-title"],["type","button","aria-label","Close",1,"btn-close",3,"click"],[1,"modal-body"],[1,"mb-3"],["for","description",1,"form-label"],["type","text","id","description","disabled","",1,"form-control",3,"value"],["for","start_date",1,"form-label"],["type","text","id","start_date","disabled","",1,"form-control",3,"value"],["for","end_date",1,"form-label"],["type","text","id","end_date","disabled","",1,"form-control",3,"value"],["for","teacher",1,"form-label"],["type","text","id","classroom","disabled","",1,"form-control",3,"value"],["type","text","id","teacher","disabled","",1,"form-control",3,"value"]],template:function(t,a){1&t&&(e.TgZ(0,"div",0)(1,"h5",1),e._uU(2,"Class summary"),e.qZA(),e.TgZ(3,"button",2),e.NdJ("click",function(){return a.activeModal.close("by: close icon")}),e.qZA()(),e.TgZ(4,"div",3)(5,"div",4)(6,"label",5),e._uU(7,"Name"),e.qZA(),e._UZ(8,"input",6),e.qZA(),e.TgZ(9,"div",4)(10,"label",7),e._uU(11,"Start"),e.qZA(),e._UZ(12,"input",8),e.qZA(),e.TgZ(13,"div",4)(14,"label",9),e._uU(15,"End"),e.qZA(),e._UZ(16,"input",10),e.qZA(),e.TgZ(17,"div",4)(18,"label",11),e._uU(19,"Classroom"),e.qZA(),e._UZ(20,"input",12),e.qZA(),e.TgZ(21,"div",4)(22,"label",11),e._uU(23,"Teacher"),e.qZA(),e._UZ(24,"input",13),e.qZA()()),2&t&&(e.xp6(8),e.Q6J("value",a.event.title),e.xp6(4),e.Q6J("value",a.datePipe.transform(a.event.start,"d/M/Y H:mm")),e.xp6(4),e.Q6J("value",a.datePipe.transform(a.event.end,"d/M/Y H:mm")),e.xp6(4),e.Q6J("value",a.classroom),e.xp6(4),e.Q6J("value",a.getTeacher(a.event)))}}),n})();var C=o(3688),b=o(8386),c=o(9476);let y=(()=>{class n{constructor(t,a,s){this.eventApiService=t,this.modalService=a,this.userService=s,this.simpleItems=[],this.selectedSimpleItem=null,this.calendarOptions={editable:!1,eventStartEditable:!1,eventDurationEditable:!1,startParam:"start_date",endParam:"end_date",titleParam:"description",slotMinTime:"07:00:00",slotMaxTime:"23:00:00",allDaySlot:!1,datesSet:this.getEventsForDate.bind(this),eventClick:this.clickEvent.bind(this),initialView:"timeGridWeek",events:[],headerToolbar:{left:"title",center:"",right:"timeGridDay,timeGridWeek today prev,next"},plugins:[v.Z,p.Z,u.Z,f.ZP,h.Z],schedulerLicenseKey:"CC-Attribution-NonCommercial-NoDerivatives"},this.companies=[]}getEventsForDate(t){let a=t.startStr.substring(0,10);this.eventApiService.getEvents(a,"","","true").subscribe(s=>{this.calendarOptions.events=s.data})}ngOnInit(){this.eventApiService.getEvents("","","","true").subscribe(t=>{this.calendarOptions.events=t.data})}clickEvent(t){this.modalService.open(g).componentInstance.event=t.event}}return n.\u0275fac=function(t){return new(t||n)(e.Y36(C.L),e.Y36(d.FF),e.Y36(b.K))},n.\u0275cmp=e.Xpm({type:n,selectors:[["app-calendar"]],decls:1,vars:1,consts:[[3,"options"]],template:function(t,a){1&t&&e._UZ(0,"full-calendar",0),2&t&&e.Q6J("options",a.calendarOptions)},dependencies:[c.w]}),n})();var A=o(3599),m=o(433),M=o(9177);const T=[{path:"",component:y}];let S=(()=>{class n{}return n.\u0275fac=function(t){return new(t||n)},n.\u0275mod=e.oAB({type:n}),n.\u0275inj=e.cJS({imports:[r.ez,c.z,A.Bz.forChild(T),m.u5,m.UX,M.A0]}),n})()}}]);