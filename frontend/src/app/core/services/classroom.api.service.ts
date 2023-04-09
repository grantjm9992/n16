import { Injectable } from '@angular/core';
import { ApiService } from './api.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ClassroomApiService extends ApiService {

  getClassrooms(): Observable<any> {
    return this.get('/classroom');
  }

  getClassroom(id: string): Observable<any> {
    return this.get(`/classroom/${id}`);
  }

  createClassroom(id: string, classroom: any) {
    return this.post(`/classroom`, classroom);
  }

  updateClassroom(id: string, classroom: any) {
    return this.post(`/classroom/${id}`, classroom);
  }
}
