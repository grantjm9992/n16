import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ResourceTypeEditComponent } from './resource-type-edit.component';

describe('ResourceTypeEditComponent', () => {
  let component: ResourceTypeEditComponent;
  let fixture: ComponentFixture<ResourceTypeEditComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ResourceTypeEditComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ResourceTypeEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
