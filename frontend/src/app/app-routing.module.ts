import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { BaseComponent } from './views/layout/base/base.component';
import { AuthGuard } from './core/guard/auth.guard';
import { ErrorPageComponent } from './views/pages/error-page/error-page.component';
import {AdminGuard} from "./core/guard/admin.guard";


const routes: Routes = [
  { path:'auth', loadChildren: () => import('./views/pages/auth/auth.module').then(m => m.AuthModule) },
  {
    path: '',
    component: BaseComponent,
    canActivate: [AuthGuard],
    children: [
      {
        path: 'dashboard',
        loadChildren: () => import('./views/pages/dashboard/dashboard.module').then(m => m.DashboardModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'calendar',
        loadChildren: () => import('./views/app/calendar/calendar.module').then(m => m.CalendarModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'calendar-by-teacher',
        loadChildren: () => import('./views/app/calendar-by-teacher/calendar.module').then(m => m.CalendarModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'classroom',
        loadChildren: () => import('./views/app/classroom/classroom.module').then(m => m.ClassroomModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'company',
        loadChildren: () => import('./views/app/company/company.module').then(m => m.CompanyModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'user',
        loadChildren: () => import('./views/app/user/user.module').then(m => m.UserModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'teacher',
        loadChildren: () => import('./views/app/teacher/teacher.module').then(m => m.TeacherModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'event',
        loadChildren: () => import('./views/app/event/event.module').then(m => m.EventModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'event-type',
        loadChildren: () => import('./views/app/event-type/event-type.module').then(m => m.EventTypeModule),
        canActivate: [AdminGuard],
      },
      {
        path: 'department',
        loadChildren: () => import('./views/app/department/department.module').then(m => m.DepartmentModule),
        canActivate: [AdminGuard],
      },
      { path: '', redirectTo: 'dashboard', pathMatch: 'full' },
    ]
  },
  {
    path: 'error',
    component: ErrorPageComponent,
    data: {
      'type': 404,
      'title': 'Page Not Found',
      'desc': 'Oopps!! The page you were looking for doesn\'t exist.'
    }
  },
  {
    path: 'error/:type',
    component: ErrorPageComponent
  },
  { path: '**', redirectTo: 'error', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { scrollPositionRestoration: 'top' })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
