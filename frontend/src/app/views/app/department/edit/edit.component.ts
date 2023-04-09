import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Router} from "@angular/router";
import {DepartmentApiService} from "../../../../core/services/department.api.service";

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {

  form: FormGroup;
  department: any;
  id: string|null = null;

  constructor(
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private apiService: DepartmentApiService,
    private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      name: ['', Validators.required],
    });
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    if (this.id !== null && this.id !== 'new') {
      this.apiService.find(this.id).subscribe((response) => {
        this.department = response.data;
        this.form.patchValue(response.data);
      });
    }
  }

  onSubmit() {
    const department: any = { ...this.department, ...this.form.value };
    if (this.id === 'new') {
      this.apiService.create(department).subscribe(() => {
        this.router.navigate(['/department']);
      }, error => {
        console.error(error);
      });
      return;
    }
    this.apiService.update(this.department.id, department).subscribe(() => {
      this.router.navigate(['/department']);
    }, error => {
      console.error(error);
    });
  }

  delete() {
    this.apiService.remove(this.department.id).subscribe(res => {
      this.router.navigate(['/department']);
    })
  }
}
