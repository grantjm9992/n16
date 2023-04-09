import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {RouterModule, Routes} from "@angular/router";
import {EventComponent} from "./event.component";
import { EditComponent } from './edit/edit.component';
import {NgxDatatableModule} from "@swimlane/ngx-datatable";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {NgSelectModule} from "@ng-select/ng-select";
import {NgbDatepickerModule, NgbTimepickerModule} from "@ng-bootstrap/ng-bootstrap";

const routes: Routes = [
  {
    path: '',
    component: EventComponent,
  },
  {
    path: ':id',
    component: EditComponent,
  },
]

@NgModule({
  declarations: [
    EventComponent,
    EditComponent,
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    NgxDatatableModule,
    FormsModule,
    ReactiveFormsModule,
    NgSelectModule,
    NgbDatepickerModule,
    NgbTimepickerModule,
  ]
})
export class EventModule { }
