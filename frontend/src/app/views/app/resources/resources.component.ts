import { Component, OnInit } from '@angular/core';
import { ColumnMode } from '@swimlane/ngx-datatable';
import {ResourceApiService} from "../../../core/services/resource.api.service";

@Component({
  selector: 'app-resources',
  templateUrl: './resources.component.html',
  styleUrls: ['./resources.component.scss']
})
export class ResourcesComponent implements OnInit {

  rows = [];
  loadingIndicator = true;
  reorderable = true;
  ColumnMode = ColumnMode;

  constructor(private resourceApiService: ResourceApiService) { }

  ngOnInit(): void {
    this.resourceApiService.getResources().subscribe((data) => {
      console.log(data);
      this.rows = data;
      this.loadingIndicator = false;
    });
  }

}
