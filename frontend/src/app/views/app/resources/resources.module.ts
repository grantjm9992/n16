import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ResourcesComponent } from './resources.component';
import {RouterModule, Routes} from "@angular/router";
import {NgxDatatableModule} from "@swimlane/ngx-datatable";
import { EditComponent } from './edit/edit.component';
import { ResourceTypeListComponent } from './resource-type-list/resource-type-list.component';
import { ResourceTypeEditComponent } from './resource-type-edit/resource-type-edit.component';


const routes: Routes = [
  {
    path: '',
    component: ResourcesComponent,
    children: [
      {
        path: ':id',
        component: EditComponent
      }
    ],
  },
  {
    path: 'resource-type',
    component: ResourceTypeListComponent,
    children: [
      {
        path: ':id',
        component: ResourceTypeEditComponent
      }
    ]
  }
]

@NgModule({
  declarations: [
    ResourcesComponent,
    EditComponent,
    ResourceTypeListComponent,
    ResourceTypeEditComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    NgxDatatableModule
  ]
})
export class ResourcesModule { }
