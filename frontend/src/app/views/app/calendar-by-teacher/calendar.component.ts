import {Component, OnInit} from '@angular/core';
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import resourceTimeGridPlugin from '@fullcalendar/resource-timegrid';
import {ClassroomApiService} from "../../../core/services/classroom.api.service";
import {EventApiService} from "../../../core/services/event.api.service";
import {CompanyApiService} from "../../../core/services/company.api.service";
import {TeacherApiService} from "../../../core/services/teacher.api.service";


@Component({
  selector: 'app-calendar',
  templateUrl: './calendar.component.html',
  styleUrls: ['./calendar.component.scss']
})
export class CalendarComponent implements OnInit {
  resources: any[] = [];
  simpleItems: any = [];
  selectedSimpleItem: any = null;
  calendarOptions: any = {
    editable: true,
    eventStartEditable: false,
    eventDurationEditable: false,
    eventDrop: this.updateEvent.bind(this),
    resourceEditable: true,
    startParam: 'start_date',
    endParam: 'end_date',
    titleParam: 'description',
    slotMinTime: '08:00:00',
    slotMaxTime: '23:00:00',
    allDaySlot: false,
    datesSet: this.getEventsForDate.bind(this),
    initialView: 'resourceTimeGrid',
    events: [],
    resources: this.resources,
    plugins: [
      dayGridPlugin,
      timeGridPlugin,
      listPlugin,
      interactionPlugin,
      resourceTimeGridPlugin,
    ],
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives'
  };

  companies: any[] = [];

  constructor(
    private classroomApiService: ClassroomApiService,
    private eventApiService: EventApiService,
    private companyApiService: CompanyApiService,
    private teacherApiService: TeacherApiService
  ) { }

  public getEventsForDate(dateInfo: any) {
    let date = dateInfo.startStr.substring(0, 10);
    this.eventApiService.getEvents(date).subscribe(res => {
      this.calendarOptions.events = res.data;
    });
  }

  updateEvent(info: any): void {
    this.eventApiService.updateEventTeacher(info.event.id, info.newResource.id).subscribe(res => {
      console.log('updated');
    });
  }

  filterResources() {
    this.calendarOptions.resources = this.resources.filter((r) => {
      return r.company_id === this.selectedSimpleItem;
    });
  }

  ngOnInit(): void {
    // Get companies
    this.companyApiService.getCompanies().subscribe(res => {
      this.simpleItems = res.data;
      // Set first as selected
      // Get classrooms
      this.teacherApiService.getTeachers().subscribe(res => {
        this.resources = res.data;
      });
      // Get events
      this.eventApiService.getEvents().subscribe((res) => {
        this.calendarOptions.events = res.data;
      });
    });
  }

}
