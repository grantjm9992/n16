import { Injectable } from '@angular/core';
import { ApiService } from './api.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TeacherApiService extends ApiService {

  getTeachers(): Observable<any> {
    return this.get('/teacher');
  }

  getTeacher(id: string):  Observable<any> {
    return this.get(`/teacher/${id}`);
  }

  updateTeacher(id: string, teacher: any) {
    return this.post(`/teacher/${id}`, teacher);
  }

  createTeacher(teacher: any) {
    return this.post(`/teacher`, teacher);
  }
}
