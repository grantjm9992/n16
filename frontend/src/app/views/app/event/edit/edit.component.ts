import { Component, OnInit } from '@angular/core';
import {EventApiService} from "../../../../core/services/event.api.service";
import {GroupApiService} from "../../../../core/services/group.api.service";
import {TeacherApiService} from "../../../../core/services/teacher.api.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {EventTypeApiService} from "../../../../core/services/event-type.api.service";
import {DepartmentApiService} from "../../../../core/services/department.api.service";
import {ClassroomApiService} from "../../../../core/services/classroom.api.service";

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {

  form: FormGroup;
  groups: any[] = [];
  teachers: any[] = [];
  eventTypes: any[] = [];
  classrooms: any[] = [];
  departments: any[] = [];
  event: any = null;
  daysOfTheWeek = [{
    name: 'Monday',
    id: 1
  }, {
    name: 'Tuesday',
    id: 2
  }, {
    name: 'Wednesday',
    id: 3
  },{
    name: 'Thursday',
    id: 4
  }, {
    name: 'Friday',
    id: 5
  }, {
    name: 'Saturday',
    id: 6
  }];

  constructor(
    private eventApiService: EventApiService,
    private eventTypeApiService: EventTypeApiService,
    private groupApiService: GroupApiService,
    private teacherApiService: TeacherApiService,
    private departmentApiService: DepartmentApiService,
    private classroomApiService: ClassroomApiService,
    private formBuilder: FormBuilder,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      name: ['', Validators.required],
      description: ['', Validators.required],
      classroom_id: ['', Validators.required],
      teacher_id: ['', Validators.required],
      event_type_id: ['', Validators.required],
      group_id: ['', Validators.required],
      department_id: ['', Validators.required],
      date_range_start: ['', Validators.required],
      date_range_end: ['', Validators.required],
      days_of_the_week: ['', Validators.required],
      time_start: ['', Validators.required],
      time_end: ['', Validators.required],
      status_id: 1,
    });
    this.groupApiService.getGroups().subscribe(res => {
      this.groups = res.data;
    });

    this.teacherApiService.getTeachers().subscribe(res => {
      this.teachers = res.data;
    });

    this.eventTypeApiService.getAll().subscribe(res => {
      this.eventTypes = res.data;
    })

    this.departmentApiService.getAll().subscribe(res => {
      this.departments = res.data;
    });

    this.classroomApiService.getClassrooms().subscribe(res => {
      this.classrooms = res.data;
    })
  }

  public onSubmit(): void {
    let event = this.form.value;
    event.date_range_end = this.getDateString(event.date_range_end)
    event.date_range_start = this.getDateString(event.date_range_start)
    event.time_start = this.getTimeString(event.time_start);
    event.time_end = this.getTimeString(event.time_end);
    this.eventApiService.createEvent(event).subscribe(res => {
      this.router.navigate(['/event']);
    }, error => {
      console.error(error);
    });
  }

  private getDateString(dateObject: any): string {
    return `${dateObject.year}-${this.pad(dateObject.month)}-${this.pad(dateObject.day)}`;
  }

  private getTimeString(timeObject: any, seconds: boolean = false): string {
    let string = `${this.pad(timeObject.hour)}:${this.pad(timeObject.minute)}`;
    if (seconds) {
      string += `:${this.pad(timeObject.second)}`;
    }
    return string;
  }

  private pad(num:number, size: number = 2): string {
    let s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
  }
}
