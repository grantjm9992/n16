import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Router} from "@angular/router";
import {UserApiService} from "../../../../core/services/user.api.service";
import {CompanyApiService} from "../../../../core/services/company.api.service";
import {TeacherApiService} from "../../../../core/services/teacher.api.service";

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {

  formGroup: FormGroup;
  user: any = null;
  id: string|null = null;
  companies: any[] = [];
  colour: any;
  text_colour: any;

  constructor(
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private teacherApiService: TeacherApiService,
    private companyApiService: CompanyApiService,
    private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.formGroup = this.formBuilder.group({
      name: ['', Validators.required],
      surname: ['', Validators.required],
      email: ['', Validators.required],
      user_role: ['', Validators.required],
      company_id: ['', Validators.required],
      start_date: ['', Validators.required],
      colour: ['', Validators.required],
      text_colour: ['', Validators.required],
    });
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    if (this.id !== null && this.id !== 'new') {
      this.teacherApiService.getTeacher(this.id).subscribe((response) => {
        this.user = response.data;
        this.formGroup.patchValue(response.data);
        this.colour = this.user.colour;
        this.text_colour = this.user.text_colour;
      });
    }

    this.companyApiService.getCompanies().subscribe((res) => {
      this.companies = res.data;
    })
  }

  onSubmit() {
    const _user: any = { ...this.user, ...this.formGroup.value };
    if (this.id === 'new') {
      this.teacherApiService.createTeacher(_user).subscribe(() => {
        this.router.navigate(['/teacher']);
      }, error => {
        console.error(error);
      });
      return;
    }
    this.teacherApiService.updateTeacher(this.user.id, _user).subscribe(() => {
      this.router.navigate(['/teacher']);
    }, error => {
      console.error(error);
    });
  }

  onTextColourChange(event: any) {
    this.formGroup.patchValue({'text_colour': event});
  }

  onColourChange(event: any) {
    this.formGroup.patchValue({'colour': event});
  }

  onDateSelect(event: any) {
    let year = event.year;
    let month = event.month <= 9 ? '0' + event.month : event.month;
    let day = event.day <= 9 ? '0' + event.day : event.day;
    let finalDate = year + "-" + month + "-" + day;
    this.formGroup.patchValue({start_date: finalDate});
  }
}
