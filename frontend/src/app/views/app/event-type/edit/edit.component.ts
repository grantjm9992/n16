import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Router} from "@angular/router";
import {EventTypeApiService} from "../../../../core/services/event-type.api.service";

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {

  form: FormGroup;
  entity: any;
  id: string|null = null;

  constructor(
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private apiService: EventTypeApiService,
    private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      name: ['', Validators.required],
    });
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    if (this.id !== null && this.id !== 'new') {
      this.apiService.find(this.id).subscribe((response) => {
        this.entity = response.data;
        this.form.patchValue(response.data);
      });
    }
  }

  onSubmit() {
    const entity: any = { ...this.entity, ...this.form.value };
    if (this.id === 'new') {
      this.apiService.create(entity).subscribe(() => {
        this.router.navigate(['/entity-type']);
      }, error => {
        console.error(error);
      });
      return;
    }
    this.apiService.update(this.entity.id, entity).subscribe(() => {
      this.router.navigate(['/entity-type']);
    }, error => {
      console.error(error);
    });
  }

  delete() {
    this.apiService.remove(this.entity.id).subscribe(res => {
      this.router.navigate(['/entity-type']);
    })
  }
}
