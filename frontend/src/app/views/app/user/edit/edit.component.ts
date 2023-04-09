import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Router} from "@angular/router";
import {CompanyApiService} from "../../../../core/services/company.api.service";
import {UserApiService} from "../../../../core/services/user.api.service";

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

  constructor(
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private userApiService: UserApiService,
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
    });
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    if (this.id !== null && this.id !== 'new') {
      this.userApiService.getUser(this.id).subscribe((response) => {
        this.user = response.data;
        this.formGroup.patchValue(response.data);
      });
    }

    this.companyApiService.getCompanies().subscribe((res) => {
      this.companies = res.data;
    })
  }

  onSubmit() {
    const _user: any = { ...this.user, ...this.formGroup.value };
    if (this.id === 'new') {
      this.userApiService.createUser(_user).subscribe(() => {
        this.router.navigate(['/user']);
      }, error => {
        console.error(error);
      });
      return;
    }
    this.userApiService.updateUser(this.user.id, _user).subscribe(() => {
      this.router.navigate(['/user']);
    }, error => {
      console.error(error);
    });
  }
}
