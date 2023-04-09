import { Component, OnInit } from '@angular/core';
import { ColumnMode } from '@swimlane/ngx-datatable';
import {ResourceTypeApiService} from "../../../../core/services/resource-type.api.service";

@Component({
  selector: 'app-resource-type-list',
  templateUrl: './resource-type-list.component.html',
  styleUrls: ['./resource-type-list.component.scss']
})
export class ResourceTypeListComponent implements OnInit {

  rows = [];
  loadingIndicator = true;
  reorderable = true;
  ColumnMode = ColumnMode;

  constructor(private resourceApiService: ResourceTypeApiService) { }

  ngOnInit(): void {
    this.resourceApiService.getResourceTypes().subscribe((data) => {
      console.log(data);
      this.rows = data;
      this.loadingIndicator = false;
    });
  }

}
