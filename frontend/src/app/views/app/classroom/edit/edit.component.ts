import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {ClassroomApiService} from "../../../../core/services/classroom.api.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {

  classroomForm: FormGroup;
  classroom: any = null;
  fill_colour: any;
  text_colour: any;

  constructor(
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private classroomApiService: ClassroomApiService,
    private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.classroomForm = this.formBuilder.group({
      name: ['', Validators.required],
      order: ['', Validators.required],
      capacity: ['', Validators.required],
      text_colour: ['', Validators.required],
      fill_colour: ['', Validators.required],
    });
    let id = this.activatedRoute.snapshot.paramMap.get('id');
    if (id === null) {
      return;
    }
    this.classroomApiService.getClassroom(id).subscribe((response) => {
      this.classroom = response.data;
      this.classroomForm.patchValue(response.data);
      this.fill_colour = this.classroom.fill_colour;
      this.text_colour = this.classroom.text_colour;
    });
  }

  onTextColourChange(event: any) {
    this.classroomForm.patchValue({'text_colour': event});
  }

  onFillColourChange(event: any) {
    this.classroomForm.patchValue({'fill_colour': event});
  }


  onSubmit() {
    const updatedClassroom: any = { ...this.classroom, ...this.classroomForm.value };
    this.classroomApiService.updateClassroom(this.classroom.id, updatedClassroom).subscribe(() => {
      this.router.navigate(['/classroom']);
    }, error => {
      console.error(error);
    });
  }
}
